<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'users' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'roll' => $user->roll,
                'superadmin' => $user->superadmin,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'email'       => 'nullable|email|unique:users,email',
            'phone'       => 'required|string|unique:users,phone',
            'password'    => 'nullable|string|min:6',
            'national_id' => 'nullable|string|unique:users,national_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'national_id' => $request->national_id,
            'password'    => $request->password ? Hash::make($request->password) : null,
        ]);

        return response()->json([
            'status' => 'success',
            'user'   => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 201);
    }
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }
    public function patient_show(Request $request)
    {
        // 🔹 کاربر از توکن
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found or invalid token.'
            ], 401);
        }

        // 🔹 گرفتن مدل patient مربوط به کاربر
        $patient = $user->patient;

        // اگر هنوز patient نداشت
        if (!$patient) {
            return response()->json([
                'status' => 'success',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'national_id' => $user->national_id,
                    'created_at' => $user->created_at->toDateTimeString(),
                    'patient' => null
                ]
            ], 200);
        }

        // 🔹 اگر patient وجود داشت، فیلدهایش را در خروجی بریز
        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
                'patient' => [
                    'id' => $patient->id,
                    'for_type' => $patient->for_type,
                    'first_name' => $patient->first_name,
                    'last_name' => $patient->last_name,
                    'national_id' => $patient->national_id,
                    'phone' => $patient->phone,
                    'birth_date' => $patient->birth_date,
                    'gender' => $patient->gender,
                    'created_at' => $patient->created_at->toDateTimeString(),
                ],
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'nullable|string|max:255',
            'email'       => 'nullable|email|unique:users,email,' . $id,
            'phone'       => 'nullable|string|unique:users,phone,' . $id,
            'password'    => 'nullable|string|min:6',
            'national_id' => 'nullable|string|unique:users,national_id,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->update([
            'name'        => $request->name ?? $user->name,
            'email'       => $request->email ?? $user->email,
            'phone'       => $request->phone ?? $user->phone,
            'national_id' => $request->national_id ?? $user->national_id,
            'password'    => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }
    public function patient_update(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'nullable|string|max:255',
            'email'       => 'nullable|email|unique:users,email,' . $user->id,
            'password'    => 'nullable|string|min:6',
            'national_id' => 'nullable|string|unique:users,national_id,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->update([
            'name'        => $request->name ?? $user->name,
            'email'       => $request->email ?? $user->email,
            'national_id' => $request->national_id ?? $user->national_id,
            'password'    => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json([
            'status' => 'success',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'national_id' => $user->national_id,
            ]
        ], 200);
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully.'
        ], 200);
    }
}
