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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:patients,national_id',
            'phone' => 'required|string|unique:patients,phone',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $patient = Patient::create($request->all());

        return response()->json([
            'status' => 'success',
            'patient' => $patient
        ], 201);
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
