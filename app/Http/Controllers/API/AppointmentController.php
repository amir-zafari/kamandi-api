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
     * List all appointments with status filter
     * @authenticated
     * @group Appointments
     */
    public function index(Request $request)
    {
        $query = Appointment::with(['doctor.user', 'patient.users', 'creator', 'canceledBy', 'markedAttendedBy']);

        // فیلتر بر اساس وضعیت
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // فیلتر بر اساس حضور
        if ($request->filled('attended')) {
            $query->where('attended', $request->attended);
        }

        // فیلتر بر اساس تاریخ
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        // فیلتر بر اساس دکتر
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        $appointments = $query->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
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
                    'attended_label' => $appointment->getAttendedStatusLabel(),
                    'appointment_type' => $appointment->appointment_type,
                    'service_type' => $appointment->service_type,
                    'is_cancelable' => $appointment->isCancelable(),
                    'is_editable' => $appointment->isEditable(),
                    'arrival_time' => $appointment->arrival_time,
                    'waiting_time' => $appointment->waiting_time,
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

        // بررسی اینکه تاریخ نوبت در گذشته نباشد
        $appointmentDateTime = strtotime($date . ' ' . $start_time);
        if ($appointmentDateTime < time()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot book appointment in the past.'
            ], 400);
        }

        // گرفتن شماره روز هفته
        $dayIndex = (date('w', strtotime($date)) == 6) ? 0 : date('w', strtotime($date)) + 1;

        // بررسی شیفت دکتر
        $shift = \App\Models\Shift::where('doctor_id', $doctor_id)
            ->where('day', $dayIndex)
            ->first();

        if (!$shift) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor does not have a shift on this day.'
            ], 400);
        }

        // بررسی ساعت
        if (strtotime($start_time) < strtotime($shift->start_time) || strtotime($start_time) >= strtotime($shift->end_time)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Start time is not within doctors shift hours.'
            ], 400);
        }

        // بررسی اسلات‌های موجود
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

        // بررسی تداخل بیمار (فقط نوبت‌های فعال)
        $existingPatientAppointment = Appointment::where('patient_id', $patient_id)
            ->where('date', $date)
            ->whereNotIn('status', ['canceled'])
            ->first();

        if ($existingPatientAppointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient already has an active appointment on this date.'
            ], 409);
        }

        // بررسی تداخل دکتر (فقط نوبت‌های فعال)
        $existingDoctorAppointment = Appointment::where('doctor_id', $doctor_id)
            ->where('date', $date)
            ->where('start_time', $start_time)
            ->whereNotIn('status', ['canceled'])
            ->first();

        if ($existingDoctorAppointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor already has an appointment at this time.'
            ], 409);
        }

        // ذخیره نوبت
        $appointment = Appointment::create([
            'doctor_id' => $doctor_id,
            'patient_id' => $patient_id,
            'user_id' => auth()->id(),
            'date' => $date,
            'start_time' => $start_time,
            'attended' => 'not_arrived',
            'appointment_type' => $request->appointment_type ?? 'online',
            'service_type' => $request->service_type ?? 'doctor',
            'status' => 'waiting',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment booked successfully.',
            'appointment' => $appointment->load(['doctor.user', 'patient', 'creator'])
        ], 201);
    }

    /**
     * Show a specific appointment
     * @authenticated
     * @group Appointments
     */
    public function show($id)
    {
        $appointment = Appointment::with(['doctor.user', 'patient.users', 'creator', 'canceledBy', 'markedAttendedBy'])->find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'appointment' => array_merge($appointment->toArray(), [
                'attended_label' => $appointment->getAttendedStatusLabel(),
                'is_cancelable' => $appointment->isCancelable(),
                'is_editable' => $appointment->isEditable(),
                'can_mark_attended' => $appointment->canMarkAttended(),
                'can_start_visit' => $appointment->canStartVisit(),
            ])
        ], 200);
    }

    /**
     * List all appointments for a specific patient
     * @authenticated
     * @group Appointments
     */
    public function show_patient_appointments($patient_id)
    {
        $user = auth()->user();
        $patient = Patient::find($patient_id);

        if (!$patient) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found.'
            ], 404);
        }

        // بررسی دسترسی - بیمار فقط می‌تواند نوبت‌های خودش را ببیند
        if ($user->hasRole('patient')) {
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to access this patient appointments.'
                ], 403);
            }
        }

        $appointments = Appointment::with(['doctor.user', 'patient', 'canceledBy', 'markedAttendedBy'])
            ->where('patient_id', $patient_id)
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get()
            ->map(function ($appointment) {
                return array_merge($appointment->toArray(), [
                    'attended_label' => $appointment->getAttendedStatusLabel(),
                    'is_cancelable' => $appointment->isCancelable(),
                    'is_editable' => $appointment->isEditable(),
                ]);
            });

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

        $appointments = Appointment::with(['doctor.user', 'patient', 'canceledBy', 'markedAttendedBy'])
            ->where('doctor_id', $doctor_id)
            ->where('date', $date)
            ->orderBy('start_time')
            ->get()
            ->map(function ($appointment) {
                return array_merge($appointment->toArray(), [
                    'attended_label' => $appointment->getAttendedStatusLabel(),
                    'is_cancelable' => $appointment->isCancelable(),
                    'is_editable' => $appointment->isEditable(),
                    'can_mark_attended' => $appointment->canMarkAttended(),
                    'can_start_visit' => $appointment->canStartVisit(),
                ]);
            });

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
        $user = auth()->user();
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        // بررسی اینکه نوبت قابل ویرایش است
        if (!$appointment->isEditable()) {
            return response()->json([
                'status' => 'error',
                'message' => 'This appointment cannot be edited. Status: ' . $appointment->status
            ], 403);
        }

        // بررسی دسترسی
        $patient = Patient::find($appointment->patient_id);

        if ($user->hasRole('patient')) {
            // بیمار فقط می‌تواند نوبت‌های خودش را ویرایش کند
            if (!$patient->users()->where('users.id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to edit this appointment.'
                ], 403);
            }

            // بیمار نمی‌تواند وضعیت و attended را تغییر دهد
            $request->request->remove('status');
            $request->request->remove('attended');
        }

        $validator = Validator::make($request->all(), [
            'start_time' => 'sometimes|regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/',
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

        // اگر زمان تغییر کند، باید تداخل چک شود
        if ($request->filled('start_time') && $request->start_time != $appointment->start_time) {
            $existingAppointment = Appointment::where('doctor_id', $appointment->doctor_id)
                ->where('date', $appointment->date)
                ->where('start_time', $request->start_time)
                ->where('id', '!=', $id)
                ->whereNotIn('status', ['canceled'])
                ->first();

            if ($existingAppointment) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Doctor already has an appointment at this time.'
                ], 409);
            }
        }

        $appointment->update($request->only([
            'start_time',
            'appointment_type',
            'service_type',
            'status'
        ]));

        return response()->json([
            'status' => 'success',
            'appointment' => $appointment->load(['doctor.user', 'patient', 'creator', 'canceledBy', 'markedAttendedBy'])
        ], 200);
    }

    /**
     * Cancel an appointment
     * @authenticated
     * @group Appointments
     */
    public function cancel(Request $request, $id)
    {
        $user = auth()->user();
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        // بررسی اینکه نوبت قابل لغو است
        if (!$appointment->isCancelable()) {
            $reason = '';
            if ($appointment->status === 'canceled') {
                $reason = 'This appointment is already canceled.';
            } elseif ($appointment->status === 'visited') {
                $reason = 'This appointment has already been visited.';
            } elseif ($appointment->attended === 'completed') {
                $reason = 'Cannot cancel completed appointments.';
            } else {
                $appointmentDateTime = strtotime($appointment->date . ' ' . $appointment->start_time);
                if ($appointmentDateTime < time()) {
                    $reason = 'Cannot cancel past appointments.';
                }
            }

            return response()->json([
                'status' => 'error',
                'message' => 'This appointment cannot be canceled. ' . $reason
            ], 403);
        }

        // بررسی دسترسی
        $patient = Patient::find($appointment->patient_id);
        $canCancel = false;
        $canceledByRole = '';

        if ($user->hasRole('patient')) {
            // بیمار فقط می‌تواند نوبت‌های خودش را لغو کند
            if ($patient->users()->where('users.id', $user->id)->exists()) {
                $canCancel = true;
                $canceledByRole = 'patient';

                // بررسی زمان - بیمار فقط می‌تواند تا 2 ساعت قبل از نوبت، آن را لغو کند
                $appointmentDateTime = strtotime($appointment->date . ' ' . $appointment->start_time);
                $twoHoursBeforeAppointment = $appointmentDateTime - (2 * 60 * 60);

                if (time() > $twoHoursBeforeAppointment) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Patients can only cancel appointments at least 2 hours before the scheduled time.'
                    ], 403);
                }
            }
        } elseif ($user->hasRole('doctor') || $user->hasRole('nurse') || $user->hasRole('superadmin')) {
            // دکتر، پرستار و ادمین می‌توانند هر نوبتی را لغو کنند
            $canCancel = true;
            if ($user->hasRole('doctor')) {
                $canceledByRole = 'doctor';
            } elseif ($user->hasRole('nurse')) {
                $canceledByRole = 'nurse';
            } else {
                $canceledByRole = 'superadmin';
            }
        }

        if (!$canCancel) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to cancel this appointment.'
            ], 403);
        }

        // اعتبارسنجی دلیل لغو
        $validator = Validator::make($request->all(), [
            'cancel_reason' => 'required|string|min:3|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // لغو نوبت
        $appointment->update([
            'status' => 'canceled',
            'canceled_by' => $user->id,
            'canceled_at' => now(),
            'cancel_reason' => $request->cancel_reason,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment canceled successfully.',
            'appointment' => $appointment->load(['doctor.user', 'patient', 'creator', 'canceledBy']),
            'canceled_by_role' => $canceledByRole
        ], 200);
    }

    /**
     * Mark patient as arrived (Step 1: Patient arrival)
     * @authenticated
     * @group Appointments - Attendance
     */
    public function markArrived(Request $request, $id)
    {
        $user = auth()->user();
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        // فقط دکتر، پرستار و ادمین می‌توانند حضور را ثبت کنند
        if (!$user->hasRole(['doctor', 'nurse', 'superadmin'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to mark attendance.'
            ], 403);
        }

        // بررسی امکان ثبت حضور
        if (!$appointment->canMarkAttended()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot mark attendance for this appointment. Current status: ' . $appointment->status . ', Attended: ' . $appointment->attended
            ], 403);
        }

        // اعتبارسنجی
        $validator = Validator::make($request->all(), [
            'attendance_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // ثبت ورود بیمار
        $appointment->update([
            'attended' => 'arrived',
            'marked_attended_by' => $user->id,
            'arrival_time' => now(),
            'attendance_notes' => $request->attendance_notes,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Patient marked as arrived successfully.',
            'appointment' => $appointment->load(['doctor.user', 'patient', 'markedAttendedBy']),
            'marked_by' => [
                'id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'role' => $user->roles->first()->name ?? 'unknown'
            ]
        ], 200);
    }

    /**
     * Start the visit and mark as completed (Step 2: Visit begins and completes)
     * @authenticated
     * @group Appointments - Attendance
     */
    public function startVisit(Request $request, $id)
    {
        $user = auth()->user();
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found.'
            ], 404);
        }

        // فقط دکتر و ادمین می‌توانند ویزیت را شروع کنند
        if (!$user->hasRole(['doctor', 'superadmin'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Only doctors can start visits.'
            ], 403);
        }

        // بررسی امکان شروع ویزیت
        if (!$appointment->canStartVisit()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot start visit. Patient must be marked as arrived first. Current attended status: ' . $appointment->attended
            ], 403);
        }

        // اعتبارسنجی
        $validator = Validator::make($request->all(), [
            'visit_notes' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // شروع و تکمیل ویزیت
        $appointment->visit_start_time = now();
        $appointment->attended = 'completed';
        $appointment->status = 'visited';
        $appointment->calculateWaitingTime();

        if ($request->filled('visit_notes')) {
            $appointment->attendance_notes = ($appointment->attendance_notes ? $appointment->attendance_notes . "\n\n" : '') .
                "Visit notes: " . $request->visit_notes;
        }

        $appointment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Visit completed successfully.',
            'appointment' => $appointment->load(['doctor.user', 'patient', 'markedAttendedBy']),
            'waiting_time_minutes' => $appointment->waiting_time
        ], 200);
    }

    /**
     * Get attendance statistics for a doctor on a specific date
     * @authenticated
     * @group Appointments - Attendance
     */
    public function attendanceStatistics($doctor_id, $date)
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

        $appointments = Appointment::where('doctor_id', $doctor_id)
            ->where('date', $date)
            ->get();

        $statistics = [
            'total_appointments' => $appointments->count(),
            'not_arrived' => $appointments->where('attended', 'not_arrived')->count(),
            'arrived' => $appointments->where('attended', 'arrived')->count(),
            'completed' => $appointments->where('attended', 'completed')->count(),
            'canceled' => $appointments->where('status', 'canceled')->count(),
            'average_waiting_time' => round($appointments->where('waiting_time', '>', 0)->avg('waiting_time'), 2),
        ];

        return response()->json([
            'status' => 'success',
            'doctor_id' => $doctor_id,
            'date' => $date,
            'statistics' => $statistics
        ], 200);
    }

    /**
     * Delete an appointment (soft delete - only for admins)
     * @authenticated
     * @group Appointments
     */
    public function destroy($id)
    {
        $user = auth()->user();

        // فقط ادمین می‌تواند نوبت را حذف کند
        if (!$user->hasRole('superadmin')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Only administrators can delete appointments. Use cancel endpoint instead.'
            ], 403);
        }

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
