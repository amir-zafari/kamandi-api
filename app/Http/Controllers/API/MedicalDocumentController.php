<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MedicalDocument;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MedicalDocumentController extends Controller
{
//    public function index(Request $request)
//    {
//        $user = $request->user();
//
//        $validator = Validator::make($request->all(), [
//            'doctor_id'  => 'required|exists:doctors,id',
//            'patient_id' => 'required|exists:patients,id',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => 'error',
//                'errors' => $validator->errors()
//            ], 422);
//        }
//
//        // چک دسترسی کاربر به بیمار
//        $patient = Patient::find($request->patient_id);
//        $hasAccess = $patient->users()
//            ->where('users.id', $user->id)
//            ->exists();
//
//        if (!$hasAccess) {
//            return response()->json([
//                'status' => 'error',
//                'message' => 'You do not have permission to access this patient'
//            ], 403);
//        }
//
//        // گرفتن مدارک
//        $items = MedicalDocument::where('doctor_id', $request->doctor_id)
//            ->where('patient_id', $request->patient_id)
//            ->get();
//
//        return response()->json([
//            'status' => 'success',
//            'documents' => $items
//        ], 200);
//    }


    public function store(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id'      => 'required|exists:doctors,id',
            'patient_id'     => 'required|exists:patients,id',
            'document_date'  => 'required|date_format:Y-m-d',
            'document_type'  => 'required|string|max:255',
            'file'           => 'required|file|mimes:jpg,png,pdf,doc,docx|max:20480',
            'notes'          => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // دسترسی
        $patient = Patient::find($request->patient_id);
        $hasAccess = $patient->users()
            ->where('users.id', $user->id)
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to upload documents for this patient'
            ], 403);
        }

        // ذخیره فایل
        $filePath = $request->file('file')->store('documents', 'public');

        // ذخیره در دیتابیس
        $document = MedicalDocument::create([
            'doctor_id'     => $request->doctor_id,
            'patient_id'    => $request->patient_id,
            'document_date' => $request->document_date,
            'document_type' => $request->document_type,
            'file_path'     => $filePath,
            'notes'         => $request->notes,
        ]);

        return response()->json([
            'status' => 'success',
            'document' => $document
        ], 201);
    }
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
        $hasAccess = $patient->users()
            ->where('users.id', $user->id)
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to access this patient'
            ], 403);
        }
        $documents = MedicalDocument::where('doctor_id', $doctor_id)
            ->where('patient_id', $patient_id)
            ->get();
        return response()->json([
            'status' => 'success',
            'documents' => $documents
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $doc = MedicalDocument::find($id);

        if (!$doc) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not found'
            ], 404);
        }

        // چک دسترسی
        $patient = Patient::find($doc->patient_id);
        $hasAccess = $patient->users()
            ->where('users.id', $user->id)
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to update this document'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'document_date'  => 'required|date_format:Y-m-d',
            'document_type'  => 'required|string|max:255',
            'file'           => 'required|file|mimes:jpg,png,pdf,doc,docx|max:20480',
            'notes'          => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // اگر فایل جدید ارسال شده
        if ($request->hasFile('file')) {

            // حذف فایل قبلی
            if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }

            // ذخیره فایل جدید
            $newFilePath = $request->file('file')->store('documents', 'public');
            $doc->file_path = $newFilePath;
        }

        // سایر فیلدها
        $doc->update($request->only([
            'result',
            'status',
            'notes'
        ]));

        return response()->json([
            'status' => 'success',
            'document' => $doc
        ], 200);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $doc = MedicalDocument::find($id);

        if (!$doc) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not found'
            ], 404);
        }

        // چک دسترسی
        $patient = Patient::find($doc->patient_id);
        $hasAccess = $patient->users()
            ->where('users.id', $user->id)
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to delete this document'
            ], 403);
        }

        // حذف فایل از storage
        if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        // حذف رکورد
        $doc->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Document deleted successfully'
        ], 200);
    }

}
