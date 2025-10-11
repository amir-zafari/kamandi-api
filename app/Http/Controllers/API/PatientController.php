<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
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
        $patients = Patient::all();
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

        // 🧩 اعتبارسنجی پایه
        $validator = Validator::make($request->all(), [
            'for_type'   => 'required|in:1,2',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'national_id'=> 'required|string',
            'birth_date' => 'required|date',
            'gender'     => 'required|in:male,female',
        ]);

        // اگر for_type = 2، phone الزامی است
        $validator->sometimes('phone', 'required|string', function ($input) {
            return $input->for_type == 2;
        });

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $phone = $request->for_type == 1 ? $user->phone : $request->phone;
        $patient = Patient::where('national_id', $request->national_id)->first();
        if ($patient) {
            $patient->update([
                'for_type'   => $request->for_type,
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'phone'      => $phone,
                'birth_date' => $request->birth_date,
                'gender'     => $request->gender,
            ]);
            $action = 'updated';
        } else {
            // ➕ اگر وجود ندارد → بساز
            $patient = Patient::create([
                'user_id'    => $user->id,
                'for_type'   => $request->for_type,
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'national_id'=> $request->national_id,
                'phone'      => $phone,
                'birth_date' => $request->birth_date,
                'gender'     => $request->gender,
            ]);
            $action = 'created';
        }

        // 👤 اگر for_type = 1 → اطلاعات کاربر هم بروزرسانی شود
        if ($request->for_type == 1) {
            $user->update([
                'name'        => $request->first_name . ' ' . $request->last_name,
                'national_id' => $request->national_id,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'action' => $action,
            'patient' => $patient
        ], $action === 'created' ? 201 : 200);
    }


    public function show($id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'patient' => $patient
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'national_id' => 'sometimes|string|unique:patients,national_id,' . $patient->id,
            'phone' => 'sometimes|string|unique:patients,phone,' . $patient->id,
            'birth_date' => 'sometimes|date',
            'gender' => 'sometimes|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $patient->update($request->all());

        return response()->json([
            'status' => 'success',
            'patient' => $patient
        ], 200);
    }
    public function destroy($id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }

        $patient->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Patient deleted successfully'
        ], 200);
    }
}
