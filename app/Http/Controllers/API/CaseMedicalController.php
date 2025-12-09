<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CaseMedical;
use App\Models\CaseMedicalFile;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CaseMedicalController extends Controller
{
    /**
     * Create a new medical case with optional files
     * @authenticated
     * @group Medical Cases
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id'            => 'required|exists:doctors,id',
            'patient_id'           => 'required|exists:patients,id',
            'title'                => 'required|string',
            'case_medical_type_id' => 'required|exists:case_medical_types,id',
            'case_date'            => 'nullable|date_format:Y-m-d',
            'files.*'              => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:20480',
            'notes'                => 'nullable|string',
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
                'message' => 'You do not have permission to upload documents for this patient'
            ], 403);
        }

        // ذخیره رکورد اصلی
        $doc = CaseMedical::create([
            'doctor_id'            => $request->doctor_id,
            'patient_id'           => $request->patient_id,
            'title'                => $request->title,
            'case_medical_type_id' => $request->case_medical_type_id,
            'case_date'            => $request->case_date,
            'notes'                => $request->notes,
        ]);

        // ذخیره چندین فایل در جدول CaseMedicalFile
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('case_medicals', 'public');

                $doc->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'format'    => $file->getClientOriginalExtension(),
                    'size'      => $file->getSize(),
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'document' => $doc->load(['type', 'files'])
        ], 201);
    }

    /**
     * List all medical cases for a doctor and patient
     * @authenticated
     * @group Medical Cases
     */
    public function show($doctor_id, $patient_id)
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

        $documents = CaseMedical::where('doctor_id', $doctor_id)
            ->where('patient_id', $patient_id)
            ->with(['type', 'files'])
            ->get();

        return response()->json([
            'status' => 'success',
            'documents' => $documents
        ], 200);
    }
    /**
     * Update a medical case and optionally add files
     * @authenticated
     * @group Medical Cases
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $doc = CaseMedical::find($id);

        if (!$doc) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not found'
            ], 404);
        }

        $patient = Patient::find($doc->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'title'                => 'nullable|string',
            'case_medical_type_id' => 'nullable|exists:case_medical_types,id',
            'case_date'            => 'nullable|date_format:Y-m-d',
            'files.*'              => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:20480',
            'notes'                => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // آپدیت فیلدهای اصلی
        $doc->update($request->only(['title', 'case_medical_type_id', 'case_date', 'notes']));

        // افزودن فایل‌های جدید به جدول CaseMedicalFile
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('case_medicals', 'public');
                $doc->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'format'    => $file->getClientOriginalExtension(),
                    'size'      => $file->getSize(),
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'document' => $doc->load(['type', 'files'])
        ], 200);
    }
    /**
     * Toggle the pin status of a medical case
     * @authenticated
     * @group Medical Cases
     */
    public function togglePin(Request $request, $id)
    {
        $user = auth()->user();
        $doc = CaseMedical::find($id);

        if (!$doc) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not found'
            ], 404);
        }

        $patient = Patient::find($doc->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to update this document'
            ], 403);
        }

        $doc->pin = !$doc->pin;
        $doc->save();

        return response()->json([
            'status' => 'success',
            'pin' =>  $doc->pin
        ], 200);
    }
    /**
     * Delete a medical case and all associated files
     * @authenticated
     * @group Medical Cases
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $doc = CaseMedical::find($id);

        if (!$doc) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not found'
            ], 404);
        }

        $patient = Patient::find($doc->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to delete this document'
            ], 403);
        }

        // حذف تمام فایل‌های مرتبط از جدول CaseMedicalFile
        foreach ($doc->files as $file) {
            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }
            $file->delete();
        }

        $doc->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Document deleted successfully'
        ], 200);
    }
    /**
     * Delete a specific file from a medical case
     * @authenticated
     * @group Medical Cases
     */
    public function deleteFile($id)
    {
        $user = auth()->user();
        $file = CaseMedicalFile::find($id);

        if (!$file) {
            return response()->json([
                'status' => 'error',
                'message' => 'File not found'
            ], 404);
        }

        // بررسی دسترسی کاربر به این فایل
        $caseMedical = $file->caseMedical;
        if (!$caseMedical) {
            return response()->json([
                'status' => 'error',
                'message' => 'Case medical not found'
            ], 404);
        }

        $patient = Patient::find($caseMedical->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to delete this file'
            ], 403);
        }

        // حذف فایل از استوریج
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        $file->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'File deleted successfully'
        ], 200);
    }
    /**
     * Filter medical cases by doctor, patient and type
     *
     * Examples:
     * - Filter by doctor_id:
     *   GET /api/medicaldocument/filter?doctor_id=1
     *
     * - Filter by patient_id:
     *   GET /api/medicaldocument/filter?patient_id=5
     *
     * - Filter by case_medical_type_id:
     *   GET /api/medicaldocument/filter?case_medical_type_id=2
     *
     * - Combined filters:
     *   GET /api/medicaldocument/filter?doctor_id=1&patient_id=5&case_medical_type_id=2
     *
     * - Without filters (get all):
     *   GET /api/medicaldocument/filter
     *
     * @authenticated
     * @group Medical Cases
     */
    public function filter(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id'            => 'nullable|exists:doctors,id',
            'patient_id'           => 'nullable|exists:patients,id',
            'case_medical_type_id' => 'nullable|exists:case_medical_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // شروع کوئری
        $query = CaseMedical::query();

        // اعمال فیلتر doctor_id
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        // اعمال فیلتر patient_id
        if ($request->filled('patient_id')) {
            $patientId = $request->patient_id;
            $patient = Patient::find($patientId);

            if (!$patient) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Patient not found'
                ], 404);
            }

            // بررسی دسترسی کاربر به بیمار
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to access this patient'
                ], 403);
            }

            $query->where('patient_id', $patientId);
        }

        // اعمال فیلتر case_medical_type_id
        if ($request->filled('case_medical_type_id')) {
            $query->where('case_medical_type_id', $request->case_medical_type_id);
        }

        // دریافت نتایج با روابط
        $documents = $query->with(['type', 'files', 'doctor', 'patient'])
            ->orderBy('case_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $documents->count(),
            'documents' => $documents
        ], 200);
    }
    /**
     * Search in medical cases
     *
     * Search in: title, notes, diagnosis, symptoms, visit_reason
     *
     * Examples:
     * - Search with keyword:
     *   GET /api/medicaldocument/search?q=سردرد
     *
     * - Search with filters:
     *   GET /api/medicaldocument/search?q=آزمایش&doctor_id=1&patient_id=5
     *
     * - Search by date range:
     *   GET /api/medicaldocument/search?q=کرونا&date_from=2024-01-01&date_to=2024-12-31
     *
     * - Search by type:
     *   GET /api/medicaldocument/search?q=خون&case_medical_type_id=2
     *
     * @authenticated
     * @group Medical Cases
     */
    public function search(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'q'                    => 'required|string|min:2',
            'doctor_id'            => 'nullable|exists:doctors,id',
            'patient_id'           => 'nullable|exists:patients,id',
            'case_medical_type_id' => 'nullable|exists:case_medical_types,id',
            'date_from'            => 'nullable|date_format:Y-m-d',
            'date_to'              => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $searchTerm = $request->q;

        // شروع کوئری
        $query = CaseMedical::query();

        // جستجو در فیلدهای CaseMedical
        $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'LIKE', "%{$searchTerm}%")
                ->orWhere('notes', 'LIKE', "%{$searchTerm}%");
        });

        // جستجو در جدول Visit مرتبط
        $query->orWhereHas('visit', function ($q) use ($searchTerm) {
            $q->where('visit_reason', 'LIKE', "%{$searchTerm}%")
                ->orWhere('symptoms', 'LIKE', "%{$searchTerm}%")
                ->orWhere('diagnosis', 'LIKE', "%{$searchTerm}%")
                ->orWhere('notes', 'LIKE', "%{$searchTerm}%");
        });

        // فیلتر بر اساس doctor_id
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        // فیلتر بر اساس patient_id
        if ($request->filled('patient_id')) {
            $patientId = $request->patient_id;
            $patient = Patient::find($patientId);

            if (!$patient) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Patient not found'
                ], 404);
            }

            // بررسی دسترسی کاربر به بیمار
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to access this patient'
                ], 403);
            }

            $query->where('patient_id', $patientId);
        }

        // فیلتر بر اساس case_medical_type_id
        if ($request->filled('case_medical_type_id')) {
            $query->where('case_medical_type_id', $request->case_medical_type_id);
        }

        // فیلتر بر اساس بازه تاریخ
        if ($request->filled('date_from')) {
            $query->where('case_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('case_date', '<=', $request->date_to);
        }

        // دریافت نتایج با روابط
        $documents = $query->with(['type', 'files', 'doctor', 'patient', 'visit'])
            ->orderBy('case_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($doc) use ($searchTerm) {
                // هایلایت کردن کلمات جستجو شده
                $highlighted = [];

                if (stripos($doc->title, $searchTerm) !== false) {
                    $highlighted[] = 'title';
                }
                if (stripos($doc->notes, $searchTerm) !== false) {
                    $highlighted[] = 'notes';
                }
                if ($doc->visit) {
                    if (stripos($doc->visit->visit_reason, $searchTerm) !== false) {
                        $highlighted[] = 'visit_reason';
                    }
                    if (stripos($doc->visit->symptoms, $searchTerm) !== false) {
                        $highlighted[] = 'symptoms';
                    }
                    if (stripos($doc->visit->diagnosis, $searchTerm) !== false) {
                        $highlighted[] = 'diagnosis';
                    }
                    if (stripos($doc->visit->notes, $searchTerm) !== false) {
                        $highlighted[] = 'visit_notes';
                    }
                }

                return [
                    'id' => $doc->id,
                    'title' => $doc->title,
                    'case_date' => $doc->case_date,
                    'notes' => $doc->notes,
                    'pin' => $doc->pin,
                    'doctor' => $doc->doctor,
                    'patient' => $doc->patient,
                    'type' => $doc->type,
                    'files' => $doc->files,
                    'visit' => $doc->visit,
                    'highlighted_fields' => $highlighted, // فیلدهایی که کلمه جستجو در آنها یافت شد
                    'match_count' => count($highlighted), // تعداد تطابق‌ها
                ];
            })
            ->sortByDesc('match_count') // مرتب‌سازی بر اساس تعداد تطابق‌ها
            ->values();

        return response()->json([
            'status' => 'success',
            'search_term' => $searchTerm,
            'count' => $documents->count(),
            'documents' => $documents
        ], 200);
    }

    // ======== متدهای مخصوص تایپ متن (ID: 1) ========

    /**
     * ذخیره پرونده متنی
     * @authenticated
     * @group Text Records
     */
    public function storeTextRecord(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id'  => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'title'      => 'required|string',
            'case_date'  => 'nullable|date_format:Y-m-d',
            'notes'      => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $patient = Patient::find($request->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
        }

        try {
            $caseMedical = CaseMedical::create([
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
                'title' => $request->title,
                'case_medical_type_id' => 1, // تایپ متن ثابت
                'case_date' => $request->case_date ?? now()->format('Y-m-d'),
                'notes' => $request->notes,
                'pin' => false,
            ]);

            $caseMedical->load(['patient', 'doctor.user', 'type']);

            return response()->json(['status' => 'success', 'text_record' => $caseMedical], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در ایجاد پرونده متنی'], 500);
        }
    }

    /**
     * دریافت پرونده‌های متنی
     * @authenticated
     * @group Text Records
     */
    public function getTextRecords($doctor_id, $patient_id)
    {
        $user = auth()->user();
        $patient = Patient::find($patient_id);
        
        if (!$patient || !$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
        }

        try {
            $textRecords = CaseMedical::with(['patient', 'doctor.user', 'type', 'files'])
                ->where('doctor_id', $doctor_id)
                ->where('patient_id', $patient_id)
                ->where('case_medical_type_id', 1) // فقط تایپ متن
                ->orderBy('case_date', 'desc')
                ->get();

            return response()->json(['status' => 'success', 'text_records' => $textRecords], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در دریافت پرونده‌های متنی'], 500);
        }
    }

    /**
     * بروزرسانی پرونده متنی
     * @authenticated
     * @group Text Records
     */
    public function updateTextRecord(Request $request, $id)
    {
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'title'     => 'nullable|string',
            'case_date' => 'nullable|date_format:Y-m-d',
            'notes'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        try {
            $caseMedical = CaseMedical::where('id', $id)
                ->where('case_medical_type_id', 1) // فقط تایپ متن
                ->first();

            if (!$caseMedical) {
                return response()->json(['status' => 'error', 'message' => 'پرونده متنی یافت نشد'], 404);
            }

            $patient = Patient::find($caseMedical->patient_id);
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
            }

            $caseMedical->update($request->only(['title', 'case_date', 'notes']));
            $caseMedical->load(['patient', 'doctor.user', 'type']);

            return response()->json(['status' => 'success', 'text_record' => $caseMedical], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در بروزرسانی پرونده متنی'], 500);
        }
    }

    /**
     * حذف پرونده متنی
     * @authenticated
     * @group Text Records
     */
    public function destroyTextRecord($id)
    {
        $user = auth()->user();
        
        try {
            $caseMedical = CaseMedical::where('id', $id)
                ->where('case_medical_type_id', 1) // فقط تایپ متن
                ->first();

            if (!$caseMedical) {
                return response()->json(['status' => 'error', 'message' => 'پرونده متنی یافت نشد'], 404);
            }

            $patient = Patient::find($caseMedical->patient_id);
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
            }

            $caseMedical->delete();

            return response()->json(['status' => 'success', 'message' => 'پرونده متنی با موفقیت حذف شد'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در حذف پرونده متنی'], 500);
        }
    }

    // ======== متدهای مخصوص تایپ دست‌نویس (ID: 2) ========

    /**
     * ذخیره پرونده دست‌نویس
     * @authenticated
     * @group Handwritten Records
     */
    public function storeHandwrittenRecord(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id'  => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'title'      => 'required|string',
            'case_date'  => 'nullable|date_format:Y-m-d',
            'files.*'    => 'nullable|file|mimes:jpg,png,pdf|max:20480',
            'notes'      => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $patient = Patient::find($request->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
        }

        try {
            $caseMedical = CaseMedical::create([
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
                'title' => $request->title,
                'case_medical_type_id' => 2, // تایپ دست‌نویس ثابت
                'case_date' => $request->case_date ?? now()->format('Y-m-d'),
                'notes' => $request->notes,
                'pin' => false,
            ]);

            // آپلود فایل‌ها اگر وجود دارند
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('case_medicals', 'public');
                    $caseMedical->files()->create([
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'format' => $file->getClientOriginalExtension(),
                        'size' => $file->getSize(),
                    ]);
                }
            }

            $caseMedical->load(['patient', 'doctor.user', 'type', 'files']);

            return response()->json(['status' => 'success', 'handwritten_record' => $caseMedical], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در ایجاد پرونده دست‌نویس'], 500);
        }
    }

    /**
     * دریافت پرونده‌های دست‌نویس
     * @authenticated
     * @group Handwritten Records
     */
    public function getHandwrittenRecords($doctor_id, $patient_id)
    {
        $user = auth()->user();
        $patient = Patient::find($patient_id);
        
        if (!$patient || !$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
        }

        try {
            $handwrittenRecords = CaseMedical::with(['patient', 'doctor.user', 'type', 'files'])
                ->where('doctor_id', $doctor_id)
                ->where('patient_id', $patient_id)
                ->where('case_medical_type_id', 2) // فقط تایپ دست‌نویس
                ->orderBy('case_date', 'desc')
                ->get();

            return response()->json(['status' => 'success', 'handwritten_records' => $handwrittenRecords], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در دریافت پرونده‌های دست‌نویس'], 500);
        }
    }

    /**
     * بروزرسانی پرونده دست‌نویس
     * @authenticated
     * @group Handwritten Records
     */
    public function updateHandwrittenRecord(Request $request, $id)
    {
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'title'     => 'nullable|string',
            'case_date' => 'nullable|date_format:Y-m-d',
            'files.*'   => 'nullable|file|mimes:jpg,png,pdf|max:20480',
            'notes'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        try {
            $caseMedical = CaseMedical::where('id', $id)
                ->where('case_medical_type_id', 2) // فقط تایپ دست‌نویس
                ->first();

            if (!$caseMedical) {
                return response()->json(['status' => 'error', 'message' => 'پرونده دست‌نویس یافت نشد'], 404);
            }

            $patient = Patient::find($caseMedical->patient_id);
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
            }

            $caseMedical->update($request->only(['title', 'case_date', 'notes']));

            // آپلود فایل‌های جدید اگر وجود دارند
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('case_medicals', 'public');
                    $caseMedical->files()->create([
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'format' => $file->getClientOriginalExtension(),
                        'size' => $file->getSize(),
                    ]);
                }
            }

            $caseMedical->load(['patient', 'doctor.user', 'type', 'files']);

            return response()->json(['status' => 'success', 'handwritten_record' => $caseMedical], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در بروزرسانی پرونده دست‌نویس'], 500);
        }
    }

    /**
     * حذف پرونده دست‌نویس
     * @authenticated
     * @group Handwritten Records
     */
    public function destroyHandwrittenRecord($id)
    {
        $user = auth()->user();
        
        try {
            $caseMedical = CaseMedical::where('id', $id)
                ->where('case_medical_type_id', 2) // فقط تایپ دست‌نویس
                ->with('files')
                ->first();

            if (!$caseMedical) {
                return response()->json(['status' => 'error', 'message' => 'پرونده دست‌نویس یافت نشد'], 404);
            }

            $patient = Patient::find($caseMedical->patient_id);
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
            }

            // حذف فایل‌ها از storage
            foreach ($caseMedical->files as $file) {
                if (Storage::disk('public')->exists($file->file_path)) {
                    Storage::disk('public')->delete($file->file_path);
                }
            }

            $caseMedical->delete();

            return response()->json(['status' => 'success', 'message' => 'پرونده دست‌نویس با موفقیت حذف شد'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در حذف پرونده دست‌نویس'], 500);
        }
    }

    // ======== متدهای مخصوص تایپ اسناد (ID: 3) ========

    /**
     * ذخیره پرونده اسناد
     * @authenticated
     * @group Document Records
     */
    public function storeDocumentRecord(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id'  => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'title'      => 'required|string',
            'case_date'  => 'nullable|date_format:Y-m-d',
            'files.*'    => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:20480',
            'notes'      => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $patient = Patient::find($request->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
        }

        try {
            $caseMedical = CaseMedical::create([
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
                'title' => $request->title,
                'case_medical_type_id' => 3, // تایپ اسناد ثابت
                'case_date' => $request->case_date ?? now()->format('Y-m-d'),
                'notes' => $request->notes,
                'pin' => false,
            ]);

            // آپلود فایل‌ها اگر وجود دارند
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('case_medicals', 'public');
                    $caseMedical->files()->create([
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'format' => $file->getClientOriginalExtension(),
                        'size' => $file->getSize(),
                    ]);
                }
            }

            $caseMedical->load(['patient', 'doctor.user', 'type', 'files']);

            return response()->json(['status' => 'success', 'document_record' => $caseMedical], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در ایجاد پرونده اسناد'], 500);
        }
    }

    /**
     * دریافت پرونده‌های اسناد
     * @authenticated
     * @group Document Records
     */
    public function getDocumentRecords($doctor_id, $patient_id)
    {
        $user = auth()->user();
        $patient = Patient::find($patient_id);
        
        if (!$patient || !$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
        }

        try {
            $documentRecords = CaseMedical::with(['patient', 'doctor.user', 'type', 'files'])
                ->where('doctor_id', $doctor_id)
                ->where('patient_id', $patient_id)
                ->where('case_medical_type_id', 3) // فقط تایپ اسناد
                ->orderBy('case_date', 'desc')
                ->get();

            return response()->json(['status' => 'success', 'document_records' => $documentRecords], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در دریافت پرونده‌های اسناد'], 500);
        }
    }

    /**
     * بروزرسانی پرونده اسناد
     * @authenticated
     * @group Document Records
     */
    public function updateDocumentRecord(Request $request, $id)
    {
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'title'     => 'nullable|string',
            'case_date' => 'nullable|date_format:Y-m-d',
            'files.*'   => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:20480',
            'notes'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        try {
            $caseMedical = CaseMedical::where('id', $id)
                ->where('case_medical_type_id', 3) // فقط تایپ اسناد
                ->first();

            if (!$caseMedical) {
                return response()->json(['status' => 'error', 'message' => 'پرونده اسناد یافت نشد'], 404);
            }

            $patient = Patient::find($caseMedical->patient_id);
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
            }

            $caseMedical->update($request->only(['title', 'case_date', 'notes']));

            // آپلود فایل‌های جدید اگر وجود دارند
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('case_medicals', 'public');
                    $caseMedical->files()->create([
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'format' => $file->getClientOriginalExtension(),
                        'size' => $file->getSize(),
                    ]);
                }
            }

            $caseMedical->load(['patient', 'doctor.user', 'type', 'files']);

            return response()->json(['status' => 'success', 'document_record' => $caseMedical], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در بروزرسانی پرونده اسناد'], 500);
        }
    }

    /**
     * حذف پرونده اسناد
     * @authenticated
     * @group Document Records
     */
    public function destroyDocumentRecord($id)
    {
        $user = auth()->user();
        
        try {
            $caseMedical = CaseMedical::where('id', $id)
                ->where('case_medical_type_id', 3) // فقط تایپ اسناد
                ->with('files')
                ->first();

            if (!$caseMedical) {
                return response()->json(['status' => 'error', 'message' => 'پرونده اسناد یافت نشد'], 404);
            }

            $patient = Patient::find($caseMedical->patient_id);
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'دسترسی به این بیمار ندارید'], 403);
            }

            // حذف فایل‌ها از storage
            foreach ($caseMedical->files as $file) {
                if (Storage::disk('public')->exists($file->file_path)) {
                    Storage::disk('public')->delete($file->file_path);
                }
            }

            $caseMedical->delete();

            return response()->json(['status' => 'success', 'message' => 'پرونده اسناد با موفقیت حذف شد'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'خطا در حذف پرونده اسناد'], 500);
        }
    }

}
