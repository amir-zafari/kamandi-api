<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * List all users
     * 
     * Get a list of all users in the system with their basic information.
     * 
     * @authenticated
     * @group Users
     * 
     * @response 200 {
     *   "status": "success",
     *   "users": [
     *     {
     *       "id": 1,
     *       "first_name": "احمد",
     *       "last_name": "محمدی",
     *       "email": "ahmad@example.com",
     *       "mobile": "09123456789",
     *       "roll": "patient"
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
        $users = User::orderBy('id', 'desc')->get(['id', 'first_name', 'last_name', 'email', 'mobile','roll']);

        return response()->json([
            'status' => 'success',
            'users' => $users
        ], 200);
    }
    /**
     * Create a new user
     * 
     * Create a new user account with specified role and information.
     * 
     * @authenticated
     * @group Users
     * 
     * @bodyParam first_name string required User's first name. Example: احمد
     * @bodyParam last_name string required User's last name. Example: محمدی
     * @bodyParam gender string required User's gender (male/female). Example: male
     * @bodyParam email string User's email address (optional, must be unique). Example: ahmad@example.com
     * @bodyParam password string User's password (minimum 6 characters). Example: password123
     * @bodyParam mobile string required User's mobile number (must be unique). Example: 09123456789
     * @bodyParam roll string required User's role (patient/nurse/doctor/superadmin). Example: patient
     * @bodyParam national_id string required National ID (must be unique). Example: 1234567890
     * 
     * @response 201 {
     *   "status": "success",
     *   "user": {
     *     "id": 1,
     *     "first_name": "احمد",
     *     "last_name": "محمدی",
     *     "gender": "male",
     *     "email": "ahmad@example.com",
     *     "mobile": "09123456789",
     *     "national_id": "1234567890",
     *     "roll": "patient",
     *     "created_at": "2024-01-15T10:30:00"
     *   }
     * }
     * 
     * @response 422 {
     *   "status": "error",
     *   "errors": {
     *     "mobile": ["The mobile has already been taken."]
     *   }
     * }
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'gender'      => 'required|in:male,female',
            'email'       => 'nullable|email|unique:users,email',
            'password'    => 'nullable|string|min:6',
            'mobile'       => 'required|string|unique:users,mobile',
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
            'gender'      => $request->gender,
            'email'       => $request->email,
            'mobile'       => $request->mobile,
            'national_id' => $request->national_id,
            'roll'        => $request->roll,
            'password'    => bcrypt($request->password), // افزودن پسورد هش‌شده
        ]);

        return response()->json([
            'status' => 'success',
            'user'   => [
                'id'            => $user->id,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'gender'        => $user->gender,
                'email'         => $user->email,
                'mobile'         => $user->mobile,
                'national_id'   => $user->national_id,
                'roll'          => $user->roll,
                'created_at'    => $user->created_at->toDateTimeString(),
            ]
        ], 201);
    }
    /**
     * Show user details
     * @authenticated
     * @group Users
     */
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
                'mobile' => $user->mobile,
                'national_id' => $user->national_id,
                'gender'       => $user->gender,
                'roll' => $user->roll,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }
    /**
     * Update user information
     * @authenticated
     * @group Users
     */
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
            'mobile'       => 'nullable|string|unique:users,mobile,' . $id,
            'roll'        => 'nullable|in:patient,nurse,doctor,superadmin',
            'national_id' => 'nullable|string|unique:users,national_id,' . $id,
            'password'    => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = [
            'first_name'  => $request->first_name ?? $user->first_name,
            'last_name'   => $request->last_name ?? $user->last_name,
            'gender'      => $request->gender ?? $user->gender,
            'email'       => $request->email ?? $user->email,
            'mobile'       => $request->mobile ?? $user->mobile,
            'national_id' => $request->national_id ?? $user->national_id,
            'roll'        => $request->roll ?? $user->roll,
        ];

        // اگر پسورد ارسال شد آن را هش کن
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'user' => [
                'id'          => $user->id,
                'first_name'  => $user->first_name,
                'last_name'   => $user->last_name,
                'gender'      => $user->gender,
                'email'       => $user->email,
                'mobile'       => $user->mobile,
                'national_id' => $user->national_id,
                'roll'        => $user->roll,
                'created_at'  => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }
    /**
     * Delete a user
     * @authenticated
     * @group Users
     */
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

    /**
     * Show the logged-in user's profile
     * @authenticated
     * @group Users
     */
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
                'mobile' => $user->mobile,
                'national_id' => $user->national_id,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ], 200);
    }
}
