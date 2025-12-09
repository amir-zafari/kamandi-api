<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * List all doctors
     * 
     * Get a list of all doctors with their basic information and specialties.
     * 
     * @authenticated
     * @group Doctors
     * 
     * @response 200 {
     *   "status": "success",
     *   "doctors": [
     *     {
     *       "id": 1,
     *       "user_id": 5,
     *       "first_name": "احمد",
     *       "last_name": "محمدی",
     *       "specialty": "قلب و عروق"
     *     }
     *   ]
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function index()
    {
        $doctors = Doctor::with('user')->get();

        $data = $doctors->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'user_id' => $doctor->user->id,
                'first_name' => $doctor->user->first_name,
                'last_name' => $doctor->user->last_name,
                'specialty' => $doctor->specialty,
            ];
        });
        return response()->json([
            'status' => 'success',
            'doctors' => $data
        ], 200);
    }
    /**
     * Create or update a doctor
     * 
     * Create a new doctor record or update existing one. Changes user role to 'doctor'.
     * 
     * @authenticated
     * @group Doctors
     * 
     * @bodyParam user_id integer required The user's ID to make doctor. Example: 5
     * @bodyParam specialty string Doctor's specialty. Example: قلب و عروق
     * @bodyParam code_nzam string required Medical council registration number (unique). Example: 12345
     * @bodyParam work_experience string Doctor's work experience description. Example: 10 سال تجربه کار
     * 
     * @response 201 {
     *   "status": "success"
     * }
     * 
     * @response 404 {
     *   "status": "error",
     *   "message": "User not found."
     * }
     * 
     * @response 422 {
     *   "status": "error",
     *   "errors": {
     *     "code_nzam": ["The code nzam has already been taken."]
     *   }
     * }
     */
    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        // ابتدا دکتر را پیدا می‌کنیم
        $doctor = Doctor::where('user_id', $request->user_id)->first();

        $doctorId = $doctor ? $doctor->id : null;

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'specialty' => 'nullable|string|max:255',
            'code_nzam' => 'required|string|unique:doctors,code_nzam,' . $doctorId,
            'work_experience' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // تغییر رول
        $user->roll = "doctor";
        $user->save();

        if ($doctor) {
            // update
            $doctor->update([
                'specialty' => $request->specialty,
                'code_nzam' => $request->code_nzam,
                'work_experience' => $request->work_experience,
            ]);
        } else {
            // create
            Doctor::create([
                'user_id' => $user->id,
                'specialty' => $request->specialty,
                'code_nzam' => $request->code_nzam,
                'work_experience' => $request->work_experience,
            ]);
        }

        return response()->json([
            'status' => 'success'
        ], 201);
    }
    /**
     * Show doctor details
     * @authenticated
     * @group Doctors
     */
    public function show($id)
    {
        // دکتر با اطلاعات کاربر مرتبط را پیدا کن
        $doctor = Doctor::with('user')->find($id);

        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found.'
            ], 404);
        }

        // ساختار مرتب برای JSON
        $data = [
            'user' => [
                'id' => $doctor->user->id,
                'first_name' => $doctor->user->first_name,
                'last_name' => $doctor->user->last_name,
                'phone' => $doctor->user->phone,
                'national_id' => $doctor->user->national_id,
            ],
            'doctor' => [
                'id' => $doctor->id,
                'specialty' => $doctor->specialty,
                'code_nzam' => $doctor->code_nzam,
                'work_experience' => $doctor->work_experience,
            ],
        ];

        return response()->json([
            'status' => 'success',
            'doctor' => $data
        ], 200);
    }
    /**
     * Update doctor information
     * @authenticated
     * @group Doctors
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::with('user')->find($id);

        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'specialty' => 'nullable|string|max:255',
            'code_nzam' => 'nullable|string|unique:doctors,code_nzam,' . $doctor->id,
            'work_experience' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|unique:users,national_id,' . $doctor->user->id,
            'phone' => 'nullable|string|max:20', // اگر میخوای شماره تلفن هم آپدیت شود
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $doctor->user->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // آپدیت اطلاعات دکتر
        $doctor->update([
            'specialty' => $request->specialty ?? $doctor->specialty,
            'code_nzam' => $request->code_nzam ?? $doctor->code_nzam,
            'work_experience' => $request->work_experience ?? $doctor->work_experience,
        ]);

        // آپدیت اطلاعات کاربر مرتبط
        $doctor->user->update([
            'national_id' => $request->national_id ?? $doctor->user->national_id,
            'phone' => $request->phone ?? $doctor->user->phone,
            'name' => $request->name ?? $doctor->user->name,
            'email' => $request->email ?? $doctor->user->email,
        ]);

        return response()->json([
            'status' => 'success',
            'doctor' => $doctor->load('user') // برای نمایش آپدیت شده
        ], 200);
    }
    /**
     * Delete a doctor
     * @authenticated
     * @group Doctors
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::with('user')->find($id);
        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found.'
            ], 404);
        }
        $user = $doctor->user;
        if ($user) {
            $user->roll = 0;
            $user->save();
        }
        $doctor->delete();
        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
