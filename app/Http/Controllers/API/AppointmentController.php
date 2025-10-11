<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor.user', 'patient'])->orderBy('date')->get();

        return response()->json([
            'status' => 'success',
            'appointments' => $appointments
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'], // HH:MM
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $doctor_id = $request->doctor_id;
        $patient_id = $request->patient_id;
        $date = $request->date;
        $start_time = $request->start_time;

        // 🗓 گرفتن شماره روز هفته (0 تا 6)
        $dayIndex = ($day = date('w', strtotime($date))) == 6 ? 0 : $day + 1;


        // 🔍 بررسی اینکه دکتر در آن روز شیفت دارد یا نه
        $shift = \App\Models\Shift::where('doctor_id', $doctor_id)
            ->where('day', $dayIndex)
            ->first();

        if (!$shift) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor does not have a shift on this day.'
            ], 400);
        }

        // ⏰ بررسی اینکه ساعت انتخاب‌شده داخل بازه شیفت هست یا نه
        if (strtotime($start_time) < strtotime($shift->start_time) || strtotime($start_time) >= strtotime($shift->end_time)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Start time is not within doctor’s shift hours.'
            ], 400);
        }

        // ⏳ بررسی اینکه ساعت دقیق نوبت داخل یکی از اسلات‌های شیفت هست
        $start = strtotime($shift->start_time);
        $end = strtotime($shift->end_time);
        $duration = $shift->duration * 60;

        $validSlots = [];
        for ($time = $start; $time + $duration <= $end; $time += $duration) {
            $validSlots[] = date('H:i', $time);
        }

        if (!in_array($start_time, $validSlots)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Start time does not match any available slot in doctor’s shift.'
            ], 400);
        }

        // 👤 بررسی اینکه بیمار در این روز نوبت دیگری ندارد
        $hasPatientConflict = \App\Models\Appointment::where('patient_id', $patient_id)
            ->where('date', $date)
            ->exists();

        if ($hasPatientConflict) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient already has an appointment on this date.'
            ], 409);
        }

        // 🩺 بررسی اینکه دکتر در این ساعت نوبت دیگری ندارد
        $hasDoctorConflict = \App\Models\Appointment::where('doctor_id', $doctor_id)
            ->where('date', $date)
            ->where('start_time', $start_time)
            ->exists();

        if ($hasDoctorConflict) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor already has an appointment at this time.'
            ], 409);
        }

        // ✅ در صورت بدون تداخل، نوبت ذخیره می‌شود
        $appointment = \App\Models\Appointment::create([
            'doctor_id' => $doctor_id,
            'patient_id' => $patient_id,
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => date('H:i', strtotime($start_time) + $duration), // محاسبه خودکار پایان
            'attended' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment booked successfully.',
            'appointment' => $appointment
        ], 201);
    }
    public function show($id)
    {
        $appointment = Appointment::with(['doctor.user', 'patient'])->find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'appointment' => $appointment
        ], 200);
    }
    public function show_day(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $appointments = Appointment::with(['doctor.user', 'patient'])
            ->where('doctor_id', $request->doctor_id)
            ->where('date', $request->date)
            ->orderBy('start_time')
            ->get();

        if ($appointments->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No appointments found for this doctor on this date.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'appointments' => $appointments
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'start_time' => 'sometimes',
            'end_time' => 'sometimes|after:start_time',
            'attended' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment->update($request->all());

        return response()->json([
            'status' => 'success',
            'appointment' => $appointment
        ], 200);
    }

    // 🗑 حذف نوبت
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        $appointment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment deleted successfully.'
        ], 200);
    }
}
