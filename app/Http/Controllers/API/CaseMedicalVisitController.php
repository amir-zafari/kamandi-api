<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CaseMedical;
use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CaseMedicalVisitController extends Controller
{
    /**
     * List medical visits
     * @authenticated
     * @group Medical Visits
     */
    public function index($doctor_id = null, $patient_id = null)
    {
        $user = auth()->user();

        if ($patient_id) {
            $patient = Patient::find($patient_id);

            if (!$patient) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Patient not found'
                ], 404);
            }

            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to access this patient'
                ], 403);
            }

            $query = CaseMedical::where('case_medical_type_id', 3)
                ->where('patient_id', $patient_id);

            if ($doctor_id) {
                $query->where('doctor_id', $doctor_id);
            }

            $visits = $query->with(['type', 'visit'])->get();
        } else {
            $visits = CaseMedical::where('case_medical_type_id', 3)
                ->with(['type', 'visit'])
                ->get();
        }

        return response()->json([
            'status' => 'success',
            'visits' => $visits
        ], 200);
    }
    /**
     * Create a new medical visit
     * @authenticated
     * @group Medical Visits
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'nullable|date_format:Y-m-d',
            'notes' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'follow_up_date' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $patient = Patient::find($request->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to create visit for this patient'
            ], 403);
        }

        // استفاده از تراکنش برای اطمینان
        $result = DB::transaction(function () use ($request) {

            // ✅ ایجاد رکورد در CaseMedical با case_medical_type_id = 3
            $caseMedical = CaseMedical::create([
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
                'title' => 'گزارش ویزیت - ' . ($request->visit_date ?? now()->toDateString()),
                'case_medical_type_id' => 3,
                'case_date' => $request->visit_date ?? now()->toDateString(),
                'notes' => $request->notes,
            ]);

            // ✅ ایجاد رکورد ویزیت مرتبط با CaseMedical
            $visit = Visit::create([
                'case_medical_id' => $caseMedical->id,
                'diagnosis' => $request->diagnosis,
                'follow_up_date' => $request->follow_up_date,
            ]);

            return [
                'case_medical' => $caseMedical,
                'visit' => $visit
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Visit created successfully',
            'case_medical' => $result['case_medical']->load(['type', 'visit']),
        ], 201);
    }
    /**
     * Show a specific medical visit
     * @authenticated
     * @group Medical Visits
     */
    public function show($id)
    {
        $user = auth()->user();
        $caseMedical = CaseMedical::with(['type', 'visit', 'doctor.user', 'patient'])
            ->where('case_medical_type_id', 3)
            ->find($id);

        if (!$caseMedical) {
            return response()->json([
                'status' => 'error',
                'message' => 'Visit not found'
            ], 404);
        }

        $patient = Patient::find($caseMedical->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to access this visit'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'visit' => $caseMedical
        ], 200);
    }
    /**
     * Update a medical visit
     * @authenticated
     * @group Medical Visits
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $caseMedical = CaseMedical::where('case_medical_type_id', 3)->find($id);

        if (!$caseMedical) {
            return response()->json([
                'status' => 'error',
                'message' => 'Visit not found'
            ], 404);
        }

        $patient = Patient::find($caseMedical->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to update this visit'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'notes' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'follow_up_date' => 'nullable|date_format:Y-m-d',
            'visit_date' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::transaction(function () use ($request, $caseMedical) {
            // آپدیت CaseMedical
            $caseMedical->update([
                'case_date' => $request->visit_date ?? $caseMedical->case_date,
                'notes' => $request->notes ?? $caseMedical->notes,
            ]);

            // آپدیت Visit
            if ($caseMedical->visit) {
                $caseMedical->visit->update([
                    'diagnosis' => $request->diagnosis ?? $caseMedical->visit->diagnosis,
                    'follow_up_date' => $request->follow_up_date ?? $caseMedical->visit->follow_up_date,
                ]);
            }
        });

        return response()->json([
            'status' => 'success',
            'visit' => $caseMedical->load(['type', 'visit'])
        ], 200);
    }
    /**
     * Delete a medical visit
     * @authenticated
     * @group Medical Visits
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $caseMedical = CaseMedical::where('case_medical_type_id', 3)->find($id);

        if (!$caseMedical) {
            return response()->json([
                'status' => 'error',
                'message' => 'Visit not found'
            ], 404);
        }

        $patient = Patient::find($caseMedical->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to delete this visit'
            ], 403);
        }

        DB::transaction(function () use ($caseMedical) {
            // حذف ویزیت
            if ($caseMedical->visit) {
                $caseMedical->visit->delete();
            }

            // حذف CaseMedical
            $caseMedical->delete();
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Visit deleted successfully'
        ], 200);
    }
}
