<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 📋 نمایش لیست کاربران
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

    // ➕ ایجاد کاربر جدید
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'email'       => 'nullable|email|unique:users,email',
            'phone'       => 'required|string|unique:users,phone',
            'password'    => 'nullable|string|min:6',
            'roll'        => 'nullable|integer|min:0',
            'superadmin'  => 'nullable|boolean',
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
            'roll'        => $request->roll ?? 0,
            'superadmin'  => $request->superadmin ?? 0,
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
                'roll' => $user->roll,
                'superadmin' => $user->superadmin,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 201);
    }

    // 👁 نمایش یک کاربر خاص
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
                'roll' => $user->roll,
                'superadmin' => $user->superadmin,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }

    // ✏️ بروزرسانی کاربر
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
            'roll'        => 'nullable|integer|min:0|max:3',
            'superadmin'  => 'nullable|boolean',
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
            'roll'        => $request->roll ?? $user->roll,
            'superadmin'  => $request->superadmin ?? $user->superadmin,
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
                'roll' => $user->roll,
                'superadmin' => $user->superadmin,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }

    // 🗑 حذف کاربر
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
