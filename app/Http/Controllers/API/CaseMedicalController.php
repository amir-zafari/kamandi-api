<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CaseMedical;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CaseMedicalController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'doctor_id'        => 'required|exists:doctors,id',
            'patient_id'       => 'required|exists:patients,id',
            'title'            => 'required|string',
            'case_type_id' => 'required|exists:case_types,id',
            'case_date'    => 'required|date_format:Y-m-d',
            'file'             => 'required|file|mimes:jpg,png,pdf,doc,docx|max:20480',
            'notes'            => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // بررسی دسترسی کاربر به بیمار
        $patient = Patient::find($request->patient_id);
        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to upload documents for this patient'
            ], 403);
        }

        // ذخیره فایل
        $filePath = $request->file('file')->store('documents', 'public');

        // ذخیره در دیتابیس
        $document = CaseMedical::create([
            'doctor_id'        => $request->doctor_id,
            'patient_id'       => $request->patient_id,
            'case_type_id' => $request->case_type_id,
            'case_date'    => $request->case_date,
            'file_path'        => $filePath,
            'notes'            => $request->notes,
        ]);

        return response()->json([
            'status' => 'success',
            'document' => $document->load('documentType')
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

        if (!$patient->users()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to access this patient'
            ], 403);
        }

        $documents = CaseMedical::where('doctor_id', $doctor_id)
            ->where('patient_id', $patient_id)
            ->with('caseType')
            ->get();

        return response()->json([
            'status' => 'success',
            'documents' => $documents
        ], 200);
    }

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
                'message' => 'You do not have permission to update this document'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'case_type_id'     => 'required|exists:case_types,id',
            'case_date'        => 'required|date_format:Y-m-d',
            'file'             => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:20480',
            'notes'            => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // آپلود فایل جدید در صورت وجود
        if ($request->hasFile('file')) {
            if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }
            $doc->file_path = $request->file('file')->store('documents', 'public');
        }

        $doc->update($request->only([
            'case_type_id',
            'case_date',
            'notes'
        ]));

        return response()->json([
            'status' => 'success',
            'document' => $doc->load('documentType')
        ], 200);
    }
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

        if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $doc->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Document deleted successfully'
        ], 200);
    }
}
