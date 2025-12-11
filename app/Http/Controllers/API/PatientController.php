<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Process and resize photo to 48x48 and convert to base64
     */
    private function processPhoto($photoData)
    {
        try {
            // Remove data:image/jpeg;base64, prefix if exists
            if (strpos($photoData, 'data:image/') === 0) {
                $photoData = substr($photoData, strpos($photoData, ',') + 1);
            }

            // Decode base64
            $imageData = base64_decode($photoData);

            if ($imageData === false) {
                return null;
            }

            // Create image resource from string
            $sourceImage = imagecreatefromstring($imageData);
            if ($sourceImage === false) {
                return null;
            }

            // Get original dimensions
            $originalWidth = imagesx($sourceImage);
            $originalHeight = imagesy($sourceImage);

            // Create new 48x48 image
            $resizedImage = imagecreatetruecolor(48, 48);

            // Handle transparency for PNG images
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
            $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
            imagefill($resizedImage, 0, 0, $transparent);

            // Resize image
            imagecopyresampled(
                $resizedImage, $sourceImage,
                0, 0, 0, 0,
                48, 48, $originalWidth, $originalHeight
            );

            // Start output buffering
            ob_start();
            imagejpeg($resizedImage, null, 90);
            $resizedImageData = ob_get_contents();
            ob_end_clean();

            // Clean up memory
            imagedestroy($sourceImage);
            imagedestroy($resizedImage);

            // Convert to base64
            return base64_encode($resizedImageData);
        } catch (\Exception $e) {
            return null;
        }
    }
    /**
     * List all patients with special appointments
     * @authenticated
     * @group Patients
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // بیماران مربوط به کاربر + نوبت‌هایی با وضعیت‌های خاص
        $patients = $user->patient()
            ->with('specialAppointment')
            ->get()
            ->map(function ($patient) {
                return [
                    'id' => $patient->id,
                    'first_name' => $patient->first_name,
                    'last_name' => $patient->last_name,
                    'national_id' => $patient->national_id,
                    'photo' => "data:image/webp;base64,". $patient->photo,
                    'appointment_date' => $patient->specialAppointment->date ?? null,
                    'appointment_status' => $patient->specialAppointment->status ?? null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'patients' => $patients
        ], 200);
    }
    /**
     * List all patients related to the user
     * @authenticated
     * @group Patients
     */
    public function patient_index(Request $request)
    {
        $user = $request->user();
        $patients = $user->patient()->get();
        return response()->json([
            'status' => 'success',
            'patients' => $patients
        ], 200);
    }

    /**
     * Create or update a patient
     *
     * Create a new patient record or update existing one. Can link patient to current user.
     *
     * @authenticated
     * @group Patients
     *
     * @bodyParam for integer required 1=for self, 2=for others. Example: 1
     * @bodyParam first_name string required Patient's first name. Example: احمد
     * @bodyParam last_name string required Patient's last name. Example: محمدی
     * @bodyParam national_id string required National identification number. Example: 1234567890
     * @bodyParam birth_date date required Birth date (Y-m-d format). Example: 1990-01-15
     * @bodyParam gender string required Gender (male/female). Example: male
     * @bodyParam blood_type string Blood type. Example: A+
     * @bodyParam allergies string Patient's allergies. Example: آلرژی به پنی‌سیلین
     * @bodyParam chronic_diseases string Chronic diseases. Example: دیابت نوع 2
     * @bodyParam emergency_contact string Emergency contact info. Example: 09123456789
     * @bodyParam address string Patient's address. Example: تهران، خیابان ولیعصر
     * @bodyParam photo string Base64 encoded photo (will be resized to 48x48). Example: iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==
     *
     * @response 201 {
     *   "status": "success",
     *   "action": "created",
     *   "patient": {
     *     "id": 1,
     *     "first_name": "احمد",
     *     "last_name": "محمدی",
     *     "national_id": "1234567890",
     *     "birth_date": "1990-01-15",
     *     "gender": "male",
     *     "blood_type": "A+",
     *     "allergies": "آلرژی به پنی‌سیلین"
     *   }
     * }
     *
     * @response 422 {
     *   "status": "error",
     *   "errors": {
     *     "national_id": ["The national id field is required."]
     *   }
     * }
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated.'
            ], 401);
        }
        $validator = Validator::make($request->all(), [
            'for'               => 'required|in:1,2',
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'national_id'       => 'required|string',
            'birth_date'        => 'required|date',
            'gender'            => 'required|in:male,female',
            'blood_type'        => 'nullable|string|max:3',
            'allergies'         => 'nullable|string|max:500',
            'chronic_diseases'  => 'nullable|string|max:500',
            'emergency_contact' => 'nullable|string|max:500',
            'address'           => 'nullable|string|max:500',
            'photo'             => 'nullable|string', // Base64 encoded photo
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Process photo if provided
        $processedPhoto = null;
        if ($request->has('photo') && !empty($request->photo)) {
            $processedPhoto = $this->processPhoto($request->photo);
            if ($processedPhoto === null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid photo format or processing failed'
                ], 422);
            }
        }

        $patient = Patient::where('national_id', $request->national_id)->first();
        if ($patient) {
            $updateData = [
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'gender'            => $request->gender,
                'birth_date'        => $request->birth_date,
                'blood_type'        => $request->blood_type,
                'allergies'         => $request->allergies,
                'chronic_diseases'  => $request->chronic_diseases,
                'emergency_contact' => $request->emergency_contact,
                'address'           => $request->address,
            ];

            // Only update photo if provided
            if ($processedPhoto !== null) {
                $updateData['photo'] = $processedPhoto;
            }

            $patient->update($updateData);
            $action = 'updated';
        } else {
            $patient = Patient::create([
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'national_id'       => $request->national_id,
                'gender'            => $request->gender,
                'birth_date'        => $request->birth_date,
                'blood_type'        => $request->blood_type,
                'allergies'         => $request->allergies,
                'chronic_diseases'  => $request->chronic_diseases,
                'emergency_contact' => $request->emergency_contact,
                'address'           => $request->address,
                'photo'             => $processedPhoto,
            ]);
            $action = 'created';
        }
        if ($request->for == 1) {
            $user->update([
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'national_id'       => $request->national_id,
                'gender'            => $request->gender,
            ]);
        }

        $alreadyExists = \DB::table('patient_user')
            ->where('user_id', $user->id)
            ->where('patient_id', $patient->id)
            ->exists();

        if (!$alreadyExists) {
            \DB::table('patient_user')->insert([
                'user_id'    => $user->id,
                'patient_id' => $patient->id,
                'created_at' => now(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'action' => $action,
            'patient' => $patient
        ], $action === 'created' ? 201 : 200);
    }

    /**
     * Show patient details
     * @authenticated
     * @group Patients
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated.'
            ], 401);
        }
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }
        $hasAccess = \DB::table('patient_user')
            ->where('user_id', $user->id)
            ->where('patient_id', $patient->id)
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access denied'
            ], 403);
        }
        return response()->json([
            'status' => 'success',
            'patient' => $patient
        ], 200);
    }
    /**
     * Update patient information
     * @authenticated
     * @group Patients
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated.'
            ], 401);
        }
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }
        $hasAccess = \DB::table('patient_user')
            ->where('user_id', $user->id)
            ->where('patient_id', $patient->id)
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access denied'
            ], 403);
        }
        $validator = Validator::make($request->all(), [
            'first_name'        => 'sometimes|string|max:255',
            'last_name'         => 'sometimes|string|max:255',
            'national_id'       => 'sometimes|string|unique:patients,national_id,' . $patient->id,
            'birth_date'        => 'sometimes|date',
            'gender'            => 'sometimes|in:male,female',

            'blood_type'        => 'sometimes|nullable|string|max:3',
            'allergies'         => 'sometimes|nullable|string|max:500',
            'chronic_diseases'  => 'sometimes|nullable|string|max:500',
            'emergency_contact' => 'sometimes|nullable|string|max:500',
            'address'           => 'sometimes|nullable|string|max:500',
            'photo'             => 'sometimes|nullable|string', // Base64 encoded photo
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Process photo if provided
        if ($request->has('photo') && !empty($request->photo)) {
            $processedPhoto = $this->processPhoto($request->photo);
            if ($processedPhoto === null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid photo format or processing failed'
                ], 422);
            }
            $request->merge(['photo' => $processedPhoto]);
        }

        $allowed = [
            'first_name', 'last_name', 'national_id', 'birth_date', 'gender',
            'blood_type', 'allergies', 'chronic_diseases',
            'emergency_contact', 'address', 'photo'
        ];
        $data = $request->only($allowed);
        $patient->update($data);
        return response()->json([
            'status' => 'success',
            'patient' => $patient
        ], 200);
    }
    /**
     * Delete a patient
     * @authenticated
     * @group Patients
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }
        $isOwner = $patient->users()
            ->where('users.id', $user->id)
            ->exists();
        if (!$isOwner) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to delete this patient'
            ], 403);
        }

        $patient->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Patient deleted successfully'
        ], 200);
    }
    /**
     * List the logged-in user's patients
     * @authenticated
     * @group Patients
     */
    public function listmypatient(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found or invalid token.'
            ], 401);
        }

        $patients = $user->patients;

        return response()->json([
            'status' => 'success',
            'patients' => $patients->map(function ($p) {
                return [
                    'id' => $p->id,
                    'first_name' => $p->first_name,
                    'last_name' => $p->last_name,
                    'national_id' => $p->national_id,
                    'phone' => $p->phone,
                    'birth_date' => $p->birth_date,
                    'gender' => $p->gender,
                    'created_at' => $p->created_at->toDateTimeString(),
                ];
            })
        ], 200);
    }
    /**
     * Search patients
     *
     * Search through patients by name or national ID. Results depend on user role permissions.
     *
     * @authenticated
     * @group Patients
     *
     * @queryParam q string required Search query (name or national ID). Example: احمد
     *
     * @response 200 {
     *   "status": "success",
     *   "patients": [
     *     {
     *       "id": 1,
     *       "first_name": "احمد",
     *       "last_name": "محمدی",
     *       "national_id": "1234567890",
     *       "birth_date": "1990-01-15",
     *       "gender": "male"
     *     }
     *   ]
     * }
     *
     * @response 422 {
     *   "status": "error",
     *   "message": "Search query (q) is required."
     * }
     *
     * @response 401 {
     *   "status": "error",
     *   "message": "Unauthenticated."
     * }
     */
    public function search(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $search = $request->input('q');

        if (!$search) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search query (q) is required.'
            ], 422);
        }

        // تعیین سطح دسترسی بر اساس نقش کاربر
        $query = Patient::query();

        if ($user->role === 'patient') {
            // فقط بیمارانی که به کاربر patient وصل هستند
            $patientIds = \DB::table('patient_user')
                ->where('user_id', $user->id)
                ->pluck('patient_id');

            $query->whereIn('id', $patientIds);
        }
        // doctor, nurse, admin → بدون محدودیت نیازی نیست هیچ شرطی بگذاریم

        // فیلتر سرچ
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('national_id', 'like', "%$search%");
        });

        $patients = $query->get();

        return response()->json([
            'status' => 'success',
            'patients' => $patients
        ], 200);
    }

}
