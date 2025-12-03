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
    /**
     * List all appointments
     * @authenticated
     * @group Appointments
     */
    public function index()
    {
        $appointments = Appointment::with(['doctor.user', 'patient.users'])
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($appointment) {
                $user = $appointment->patient->users->first();
                return [
                    'id' => $appointment->id,
                    'patient_name' => $appointment->patient->first_name . ' ' . $appointment->patient->last_name,
                    'national_code' => $appointment->patient->national_id,
                    'mobile' => $user ? $user->mobile : null,
                    'date' => $appointment->date,
                    'start_time' => $appointment->start_time,
                    'status' => $appointment->status,
                    'attended' => $appointment->attended,
                ];
            });

        return response()->json([
            'status' => 'success',
            'appointments' => $appointments
        ], 200);
    }
    /**
     * Create a new appointment
     * @authenticated
     * @group Appointments
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|integer|exists:doctors,id',
            'patient_id' => 'required|integer|exists:patients,id',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'],
            'appointment_type' => 'sometimes|in:online,phone,in_person,referral',
            'service_type' => 'sometimes|in:doctor,injection',
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
        $dayIndex = (date('w', strtotime($date)) == 6) ? 0 : date('w', strtotime($date)) + 1;

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
                'message' => 'Start time is not within doctors shift hours.'
            ], 400);
        }

        // ⏳ بررسی اسلات‌های موجود
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
                'message' => 'Start time does not match any available slot in doctors shift.'
            ], 400);
        }

        // 👤 بررسی تداخل بیمار
        if (Appointment::where('patient_id', $patient_id)->where('date', $date)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient already has an appointment on this date.'
            ], 409);
        }

        // 🩺 بررسی تداخل دکتر
        if (Appointment::where('doctor_id', $doctor_id)->where('date', $date)->where('start_time', $start_time)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor already has an appointment at this time.'
            ], 409);
        }

        // ✅ ذخیره نوبت
        $appointment = Appointment::create([
            'doctor_id' => $doctor_id,
            'patient_id' => $patient_id,
            'user_id' => auth()->id(),
            'date' => $date,
            'start_time' => $start_time,
            'attended' => false,
            'appointment_type' => $request->appointment_type ?? 'online',
            'service_type' => $request->service_type ?? 'doctor',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment booked successfully.',
            'appointment' => $appointment
        ], 201);
    }
    /**
     * Show a specific appointment
     * @authenticated
     * @group Appointments
     */
    public function show($id)
    {
        $appointment = Appointment::with(['doctor.user', 'patient.users', 'creator'])->find($id);

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
    /**
     * List all appointments for a specific patient
     * @authenticated
     * @group Appointments
     */
    public function show_patient_appointments($patient_id)
    {
        $appointments = Appointment::with(['doctor.user', 'patient'])
            ->where('patient_id', $patient_id)
            ->orderBy('date', 'desc')
            ->get();

        if ($appointments->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No appointments found for this patient.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'appointments' => $appointments
        ], 200);
    }
    /**
     * List all appointments for a doctor on a specific date
     * @authenticated
     * @group Appointments
     */
    public function show_day($doctor_id, $date)
    {
        if (!is_numeric($doctor_id) || !Doctor::find($doctor_id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid doctor ID.'
            ], 422);
        }

        if (!strtotime($date)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid date format. Use Y-m-d.'
            ], 422);
        }

        $appointments = Appointment::with(['doctor.user', 'patient'])
            ->where('doctor_id', $doctor_id)
            ->where('date', $date)
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
            'doctor_id' => $doctor_id,
            'date' => $date,
            'appointments' => $appointments
        ], 200);
    }
    /**
     * Update an appointment
     * @authenticated
     * @group Appointments
     */
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
            'start_time' => 'sometimes|regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/',
            'attended' => 'sometimes|boolean',
            'appointment_type' => 'sometimes|in:online,phone,in_person,referral',
            'service_type' => 'sometimes|in:doctor,injection',
            'status' => 'sometimes|in:waiting,canceled,visited,no_show',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment->update($request->only([
            'start_time',
            'attended',
            'appointment_type',
            'service_type',
            'status'
        ]));

        return response()->json([
            'status' => 'success',
            'appointment' => $appointment
        ], 200);
    }

    /**
     * Mark an appointment as attended
     * @authenticated
     * @group Appointments
     */
    public function toggleAttended($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        if ($appointment->attended == 1) {
            return response()->json([
                'status' => 'success',
                'message' => 'Attended is already set to 1.',
                'appointment' => $appointment
            ], 200);
        }

        $appointment->attended = 1;
        $appointment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Attended updated to 1.',
            'appointment' => $appointment
        ], 200);
    }
    /**
     * Delete an appointment
     * @authenticated
     * @group Appointments
     */
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
