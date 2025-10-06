<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->get();

        $data = $doctors->map(function ($doctor) {
            return [
                'id' => $doctor->user->id,
                'name' => $doctor->user->name,
                'specialty' => $doctor->specialty,
            ];
        });
        return response()->json([
            'status' => 'success',
            'doctors' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'specialty' => 'nullable|string|max:255',
            'code_nzam' => 'required|string|unique:doctors,code_nzam',
            'work_experience' => 'nullable|string|max:255',
            'national_id' => 'required|string|unique:users,national_id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }
        $user->national_id = $request->national_id;
        $user->roll = 1;
        $user->save();
        Doctor::create([
            'user_id' => $user->id,
            'specialty' => $request->specialty,
            'code_nzam' => $request->code_nzam,
            'work_experience' => $request->work_experience,
        ]);
        return response()->json([
            'status' => 'success',
        ], 201);
    }
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
                'name' => $doctor->user->name,
                'email' => $doctor->user->email,
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
