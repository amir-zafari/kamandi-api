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
        $users = User::orderBy('id', 'desc')->get(['id', 'first_name', 'last_name', 'email', 'phone','roll']);

        return response()->json([
            'status' => 'success',
            'users' => $users
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'gender'      => 'required|in:male,female',
            'email'       => 'nullable|email|unique:users,email',
            'phone'       => 'required|string|unique:users,phone',
            'roll'        => 'required|in:patient,nurse,doctor,superadmin',
            'national_id' => 'required|string|unique:users,national_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'gender'       => $request->gender,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'national_id' => $request->national_id,
            'roll'        => $request->roll,
        ]);

        return response()->json([
            'status' => 'success',
            'user'   => [
                'id'            => $user->id,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'gender'        => $user->gender,
                'email'         => $user->email,
                'phone'         => $user->phone,
                'national_id'   => $user->national_id,
                'roll'          => $user->roll,
                'created_at'    => $user->created_at->toDateTimeString(),
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
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'national_id' => $user->national_id,
                'gender'       => $user->gender,
                'roll' => $user->roll,
                'created_at' => $user->created_at->toDateTimeString(),
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
            'first_name'  => 'nullable|string|max:255',
            'last_name'   => 'nullable|string|max:255',
            'gender'      => 'nullable|in:male,female',
            'email'       => 'nullable|email|unique:users,email,' . $id,
            'phone'       => 'nullable|string|unique:users,phone,' . $id,
            'roll'        => 'nullable|in:patient,nurse,doctor,superadmin',
            'national_id' => 'nullable|string|unique:users,national_id,' . $id,
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->update([
            'first_name'  => $request->first_name ?? $user->first_name,
            'last_name'   => $request->last_name ?? $user->last_name,
            'gender'       => $request->gender ?? $user->gender,
            'email'       => $request->email ?? $user->email,
            'phone'       => $request->phone ?? $user->phone,
            'national_id' => $request->national_id ?? $user->national_id,
            'roll'        => $request->roll ?? $user->roll,
        ]);

        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'first_name'  => $user->first_name,
                'last_name'   => $user->last_name,
                'gender'      => $user->gender,
                'email'       => $user->email,
                'phone'       => $user->phone,
                'national_id' => $user->national_id,
                'roll'        => $user->roll,
                'created_at' => $user->created_at->toDateTimeString(),
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

//---------------------------------------
    public function profile(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found or invalid token.'
            ], 401);
        }
        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }

}
