<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicalRecordController extends Controller
{
    // لیست پرونده‌ها (برای admin یا doctor)
    public function index()
    {
        $records = MedicalRecord::with(['doctor.user', 'patient'])->get();
        return response()->json(['status' => 'success', 'records' => $records], 200);
    }

    // گرفتن یا ساخت پرونده براساس doctor_id و patient_id
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'summary' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors'=>$validator->errors()], 422);
        }

        // اگر پرونده وجود داشت برگردان
        $existing = MedicalRecord::where('doctor_id', $request->doctor_id)
            ->where('patient_id', $request->patient_id)
            ->first();

        if ($existing) {
            return response()->json(['status'=>'success','record'=>$existing], 200);
        }

        // تولید شماره 4 رقمی یکتا (تلاش تا 10 بار)
        $recordNumber = null;
        for ($i=0; $i<10; $i++) {
            $candidate = str_pad((string)random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            if (!MedicalRecord::where('record_number', $candidate)->exists()) {
                $recordNumber = $candidate;
                break;
            }
        }

        if (!$recordNumber) {
            return response()->json(['status'=>'error','message'=>'Could not generate unique record number.'], 500);
        }

        $record = MedicalRecord::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'record_number' => $recordNumber,
            'summary' => $request->summary,
        ]);

        return response()->json(['status'=>'success','record'=>$record], 201);
    }

    public function show($id)
    {
        $record = MedicalRecord::with(['doctor.user', 'patient', 'visits', 'prescriptions', 'labTests'])->find($id);
        if (!$record) return response()->json(['status'=>'error','message'=>'Record not found'], 404);
        return response()->json(['status'=>'success','record'=>$record], 200);
    }

    public function update(Request $request, $id)
    {
        $record = MedicalRecord::find($id);
        if (!$record) return response()->json(['status'=>'error','message'=>'Record not found'], 404);

        $validator = Validator::make($request->all(), [
            'summary' => 'nullable|string',
        ]);

        if ($validator->fails()) return response()->json(['status'=>'error','errors'=>$validator->errors()], 422);

        $record->update($request->only(['summary']));

        return response()->json(['status'=>'success','record'=>$record], 200);
    }

    public function destroy($id)
    {
        $record = MedicalRecord::find($id);
        if (!$record) return response()->json(['status'=>'error','message'=>'Record not found'], 404);
        $record->delete();
        return response()->json(['status'=>'success','message'=>'Record deleted'], 200);
    }
}
