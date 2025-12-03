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
}
