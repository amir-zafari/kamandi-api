<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
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

                    'appointment_date' => $patient->specialAppointment->date ?? null,
                    'appointment_status' => $patient->specialAppointment->status ?? null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'patients' => $patients
        ], 200);
    }

    public function patient_index(Request $request)
    {
        $user = $request->user();
        $patients = $user->patient()->get();
        return response()->json([
            'status' => 'success',
            'patients' => $patients
        ], 200);
    }
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
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $patient = Patient::where('national_id', $request->national_id)->first();
        if ($patient) {
            $patient->update([
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'gender'            => $request->gender,
                'birth_date'        => $request->birth_date,
                'blood_type'        => $request->blood_type,
                'allergies'         => $request->allergies,
                'chronic_diseases'  => $request->chronic_diseases,
                'emergency_contact' => $request->emergency_contact,
                'address'           => $request->address,
            ]);
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $allowed = [
            'first_name', 'last_name', 'national_id', 'birth_date', 'gender',
            'blood_type', 'allergies', 'chronic_diseases',
            'emergency_contact', 'address'
        ];
        $data = $request->only($allowed);
        $patient->update($data);
        return response()->json([
            'status' => 'success',
            'patient' => $patient
        ], 200);
    }

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
