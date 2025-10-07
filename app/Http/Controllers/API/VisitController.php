<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Visit;
use App\Models\MedicalRecord;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    public function index($record_id = null)
    {
        if (!is_null($record_id)) {
            $items = Prescription::where('medical_record_id', $record_id)->get();
        } else {
            $items = Prescription::all();
        }

        return response()->json([
            'status' => 'success',
            'prescriptions' => $items
        ], 200);
    }



    // ساخت ویزیت (بر اساس appointment یا دستی)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'visit_date' => 'nullable|date_format:Y-m-d',
            'notes' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'follow_up_date' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) return response()->json(['status'=>'error','errors'=>$validator->errors()], 422);

        // استفاده از تراکنش برای اطمینان
        $visit = DB::transaction(function () use ($request) {

            // پیدا کردن یا ساخت پرونده بین این doctor و patient
            $record = MedicalRecord::firstOrCreate(
                ['doctor_id' => $request->doctor_id, 'patient_id' => $request->patient_id],
                ['record_number' => $this->generateUniqueRecordNumber()]
            );

            // اگر appointment_id داده شده، مطمئن شو appointment مال همین patient/doctor هست (اختیاری)
            if ($request->filled('appointment_id')) {
                $appointment = Appointment::find($request->appointment_id);
                if ($appointment && $appointment->doctor_id != $request->doctor_id) {
                    throw new \Exception('Appointment does not belong to this doctor.');
                }
            }

            $visit = Visit::create([
                'medical_record_id' => $record->id,
                'appointment_id' => $request->appointment_id,
                'visit_date' => $request->visit_date ?? now()->toDateString(),
                'notes' => $request->notes,
                'diagnosis' => $request->diagnosis,
                'follow_up_date' => $request->follow_up_date,
            ]);

            return $visit;
        });

        return response()->json(['status'=>'success','visit'=>$visit], 201);
    }

    // تابع کمکی تولید شماره 4 رقمی
    protected function generateUniqueRecordNumber()
    {
        for ($i=0;$i<10;$i++) {
            $candidate = str_pad((string)random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            if (!MedicalRecord::where('record_number', $candidate)->exists()) {
                return $candidate;
            }
        }
        throw new \Exception('Unable to generate unique record number.');
    }

    public function show($id)
    {
        $visit = Visit::with(['record.doctor.user','record.patient','prescriptions','labTests','appointment'])->find($id);
        if (!$visit) return response()->json(['status'=>'error','message'=>'Visit not found'], 404);
        return response()->json(['status'=>'success','visit'=>$visit], 200);
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::find($id);
        if (!$visit) return response()->json(['status'=>'error','message'=>'Visit not found'], 404);

        $validator = Validator::make($request->all(), [
            'notes' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'follow_up_date' => 'nullable|date_format:Y-m-d',
            'visit_date' => 'nullable|date_format:Y-m-d',
        ]);
        if ($validator->fails()) return response()->json(['status'=>'error','errors'=>$validator->errors()], 422);

        $visit->update($request->only(['notes','diagnosis','follow_up_date','visit_date']));
        return response()->json(['status'=>'success','visit'=>$visit], 200);
    }

    public function destroy($id)
    {
        $visit = Visit::find($id);
        if (!$visit) return response()->json(['status'=>'error','message'=>'Visit not found'], 404);
        $visit->delete();
        return response()->json(['status'=>'success','message'=>'Visit deleted'], 200);
    }
}
