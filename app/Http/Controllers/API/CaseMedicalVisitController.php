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
            'visit_reason' => 'nullable|string|max:255',
            'symptoms' => 'nullable|string|max:500',
            'prescribed_medications' => 'nullable|string',
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
                'visit_reason' => $request->visit_reason,
                'symptoms' => $request->symptoms,
                'prescribed_medications' => $request->prescribed_medications,
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
            'visit_reason' => 'nullable|string|max:255',
            'symptoms' => 'nullable|string|max:500',
            'prescribed_medications' => 'nullable|string',
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
                    'visit_reason' => $request->visit_reason ?? $caseMedical->visit->visit_reason,
                    'symptoms' => $request->symptoms ?? $caseMedical->visit->symptoms,
                    'prescribed_medications' => $request->prescribed_medications ?? $caseMedical->visit->prescribed_medications,
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

    // ======== متدهای مخصوص گزارش ویزیت (Type ID: 4) ========

    /**
     * ایجاد گزارش ویزیت (CaseMedical + Visit)
     * @authenticated
     * @group Visit Reports
     */
    public function storeVisitReport(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'title' => 'required|string|max:255',
            'case_date' => 'nullable|date_format:Y-m-d',
            'notes' => 'nullable|string',
            // فیلدهای Visit
            'visit_reason' => 'nullable|string|max:255',
            'symptoms' => 'nullable|string|max:500',
            'diagnosis' => 'nullable|string',
            'prescribed_medications' => 'nullable|string',
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
                'message' => 'You do not have permission to create visit report for this patient'
            ], 403);
        }

        try {
            $result = DB::transaction(function () use ($request) {
                // ✅ ایجاد رکورد CaseMedical با تایپ گزارش ویزیت
                $caseMedical = CaseMedical::create([
                    'doctor_id' => $request->doctor_id,
                    'patient_id' => $request->patient_id,
                    'title' => $request->title,
                    'case_medical_type_id' => 4, // تایپ گزارش ویزیت ثابت
                    'case_date' => $request->case_date ?? now()->format('Y-m-d'),
                    'notes' => $request->notes,
                    'pin' => false,
                ]);

                // ✅ ایجاد رکورد Visit مرتبط با CaseMedical
                $visit = Visit::create([
                    'case_medical_id' => $caseMedical->id,
                    'visit_reason' => $request->visit_reason,
                    'symptoms' => $request->symptoms,
                    'diagnosis' => $request->diagnosis,
                    'prescribed_medications' => $request->prescribed_medications,
                    'follow_up_date' => $request->follow_up_date,
                ]);

                return $caseMedical;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Visit report created successfully',
                'visit_report' => $result->load(['patient', 'doctor.user', 'type', 'visit'])
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating visit report: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * دریافت گزارش‌های ویزیت
     * @authenticated
     * @group Visit Reports
     */
    public function getVisitReports($doctor_id, $patient_id)
    {
        $user = auth()->user();
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

        try {
            $visitReports = CaseMedical::with(['patient', 'doctor.user', 'type', 'visit'])
                ->where('doctor_id', $doctor_id)
                ->where('patient_id', $patient_id)
                ->where('case_medical_type_id', 4) // فقط گزارش ویزیت
                ->orderBy('case_date', 'desc')
                ->get();

            return response()->json([
                'status' => 'success',
                'visit_reports' => $visitReports,
                'count' => $visitReports->count()
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving visit reports'
            ], 500);
        }
    }

    /**
     * بروزرسانی گزارش ویزیت
     * @authenticated
     * @group Visit Reports
     */
    public function updateVisitReport(Request $request, $id)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'case_date' => 'nullable|date_format:Y-m-d',
            'notes' => 'nullable|string',
            // فیلدهای Visit
            'visit_reason' => 'nullable|string|max:255',
            'symptoms' => 'nullable|string|max:500',
            'diagnosis' => 'nullable|string',
            'prescribed_medications' => 'nullable|string',
            'follow_up_date' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // یافتن CaseMedical با تایپ گزارش ویزیت
            $caseMedical = CaseMedical::where('id', $id)
                ->where('case_medical_type_id', 4)
                ->with('visit')
                ->first();

            if (!$caseMedical) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Visit report not found'
                ], 404);
            }

            $patient = Patient::find($caseMedical->patient_id);
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to update this visit report'
                ], 403);
            }

            $result = DB::transaction(function () use ($request, $caseMedical) {
                // آپدیت CaseMedical
                $caseMedical->update([
                    'title' => $request->title ?? $caseMedical->title,
                    'case_date' => $request->case_date ?? $caseMedical->case_date,
                    'notes' => $request->notes ?? $caseMedical->notes,
                ]);

                // آپدیت Visit
                if ($caseMedical->visit) {
                    $caseMedical->visit->update([
                        'visit_reason' => $request->visit_reason ?? $caseMedical->visit->visit_reason,
                        'symptoms' => $request->symptoms ?? $caseMedical->visit->symptoms,
                        'diagnosis' => $request->diagnosis ?? $caseMedical->visit->diagnosis,
                        'prescribed_medications' => $request->prescribed_medications ?? $caseMedical->visit->prescribed_medications,
                        'follow_up_date' => $request->follow_up_date ?? $caseMedical->visit->follow_up_date,
                    ]);
                } else {
                    // اگر Visit وجود ندارد، یکی ایجاد کن
                    Visit::create([
                        'case_medical_id' => $caseMedical->id,
                        'visit_reason' => $request->visit_reason,
                        'symptoms' => $request->symptoms,
                        'diagnosis' => $request->diagnosis,
                        'prescribed_medications' => $request->prescribed_medications,
                        'follow_up_date' => $request->follow_up_date,
                    ]);
                }

                return $caseMedical;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Visit report updated successfully',
                'visit_report' => $result->load(['patient', 'doctor.user', 'type', 'visit'])
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating visit report: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * حذف گزارش ویزیت
     * @authenticated
     * @group Visit Reports
     */
    public function destroyVisitReport($id)
    {
        $user = auth()->user();

        try {
            $caseMedical = CaseMedical::where('id', $id)
                ->where('case_medical_type_id', 4)
                ->with('visit')
                ->first();

            if (!$caseMedical) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Visit report not found'
                ], 404);
            }

            $patient = Patient::find($caseMedical->patient_id);
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to delete this visit report'
                ], 403);
            }

            DB::transaction(function () use ($caseMedical) {
                // حذف Visit مرتبط (اگر وجود دارد)
                if ($caseMedical->visit) {
                    $caseMedical->visit->delete();
                }

                // حذف CaseMedical
                $caseMedical->delete();
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Visit report deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting visit report: ' . $e->getMessage()
            ], 500);
        }
    }
}
