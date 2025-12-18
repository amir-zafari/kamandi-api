<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorShiftController extends Controller
{
    /**
     * List all shifts for a doctor | لیست شیفت‌های پزشک
     * 
     * Get all scheduled shifts for a specific doctor with calculated slot information.
     * 
     * @authenticated
     * @group Doctor Shifts
     * 
     * @urlParam doctor_id integer required Doctor's ID. Example: 1
     * 
     * @response 200 {
     *   "status": "success",
     *   "shifts": [
     *     {
     *       "id": 1,
     *       "day": 1,
     *       "start_time": "09:00",
     *       "end_time": "17:00",
     *       "duration": 30,
     *       "slots": 16
     *     }
     *   ]
     * }
     * 
     * @response 404 {
     *   "status": "error",
     *   "message": "Doctor not found."
     * }
     */
    public function index($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        if (!$doctor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found.'
            ], 404);
        }
        $shifts = Shift::where('doctor_id', $doctor_id)
            ->orderBy('date')
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();
        $data = [];
        foreach ($shifts as $shift) {
            $start = strtotime($shift->start_time);
            $end = strtotime($shift->end_time);
            $duration_seconds = $shift->duration * 60;
            $number_of_slots = floor(($end - $start) / $duration_seconds);
            $data[] = [
                'id' => $shift->id,
                'service_type' => $shift->service_type,
                'day' => $shift->day,
                'date' => $shift->date,
                'is_recurring' => (bool)$shift->is_recurring,
                'repeat_until' => $shift->repeat_until,
                'start_time' => $shift->start_time,
                'end_time' => $shift->end_time,
                'duration' => $shift->duration,
                'capacity_per_slot' => $shift->capacity_per_slot,
                'slots' => $number_of_slots,
            ];
        }
        return response()->json([
            'status' => 'success',
            'shifts' => $data
        ], 200);
    }
    /**
     * Create a new shift for a doctor | ایجاد شیفت جدید برای پزشک
     * @authenticated
     * @group Doctor Shifts
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'service_type' => 'required|in:doctor,injection',
            // Either a specific date, or a recurring weekly day must be provided
            'date' => 'nullable|date_format:Y-m-d',
            'day' => 'nullable|integer|min:0|max:6',
            'is_recurring' => 'boolean',
            'repeat_until' => 'nullable|date_format:Y-m-d|after_or_equal:date',
            'start_time' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'], // HH:MM 24h
            'end_time' => [
                'required',
                'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/',
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) <= strtotime($request->start_time)) {
                        $fail('The end time must be after the start time.');
                    }
                }
            ],
            'duration' => 'required|integer|min:1|max:60',
            'capacity_per_slot' => 'nullable|integer|min:1|max:100',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Business rules: either one-off date OR recurring by weekday must be provided
        if (!$request->filled('date') && !$request->boolean('is_recurring') && !$request->filled('day')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Provide either a specific date for one-off shift, or set is_recurring with a weekday (day).'
            ], 422);
        }
        if ($request->boolean('is_recurring') && !$request->filled('day')) {
            return response()->json([
                'status' => 'error',
                'message' => 'For recurring shifts, the weekday (day) field is required.'
            ], 422);
        }
        if ($request->filled('date') && $request->boolean('is_recurring')) {
            return response()->json([
                'status' => 'error',
                'message' => 'A shift cannot be both date-based and recurring. Choose one.'
            ], 422);
        }

        $payload = [
            'doctor_id' => $request->doctor_id,
            'service_type' => $request->service_type,
            'day' => $request->day,
            'date' => $request->date,
            'is_recurring' => (bool)$request->boolean('is_recurring'),
            'repeat_until' => $request->repeat_until,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => (int)$request->duration,
            'capacity_per_slot' => (int)($request->capacity_per_slot ?? ($request->service_type === 'doctor' ? 1 : 1)),
        ];

        $shift = Shift::create($payload);

        return response()->json([
            'status' => 'success',
            'shift' => $shift
        ], 201);
    }
    /**
     * Show available slots for a doctor on a specific date | نمایش اسلات‌های خالی پزشک در تاریخ مشخص
     * 
     * Get available appointment slots for a doctor on a specific date, excluding already booked slots.
     * 
     * @authenticated
     * @group Doctor Shifts
     * 
     * @urlParam doctor_id integer required Doctor's ID. Example: 1
     * @urlParam date string required Date in Y-m-d format. Example: 2024-01-15
     * 
     * @response 200 {
     *   "status": "success",
     *   "shifts": [
     *     {
     *       "shift_id": 1,
     *       "start_time": "09:00",
     *       "end_time": "17:00",
     *       "duration": 30,
     *       "slots": ["09:00", "09:30", "10:00", "10:30"]
     *     }
     *   ]
     * }
     * 
     * @response 404 {
     *   "status": "error",
     *   "message": "No shifts found for this doctor on this date."
     * }
     * 
     * @response 422 {
     *   "status": "error",
     *   "message": "Invalid date format."
     * }
     */
    public function show($doctor_id, $date)
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
                'message' => 'Invalid date format.'
            ], 422);
        }

        $serviceType = request('service_type'); // optional filter
        if ($serviceType && !in_array($serviceType, ['doctor', 'injection'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid service_type. Allowed: doctor,injection'
            ], 422);
        }

        // محاسبه روز هفته
        $day = (date('w', strtotime($date)) == 6) ? 0 : date('w', strtotime($date)) + 1;

        // Combine date-specific and recurring shifts for that date
        $query = Shift::where('doctor_id', $doctor_id)
            ->where(function ($q) use ($date, $day) {
                $q->whereDate('date', $date)
                  ->orWhere(function ($q2) use ($day, $date) {
                      $q2->where('is_recurring', true)
                         ->where('day', $day)
                         ->where(function ($q3) use ($date) {
                             $q3->whereNull('repeat_until')
                                ->orWhereDate('repeat_until', '>=', $date);
                         });
                  });
            });
        if ($serviceType) {
            $query->where('service_type', $serviceType);
        }

        $shifts = $query->orderBy('start_time')->get();

        if ($shifts->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No shifts found for this doctor on this date.'
            ], 404);
        }

        $data = [];
        foreach ($shifts as $shift) {
            $start = strtotime($shift->start_time);
            $end = strtotime($shift->end_time);
            $duration = $shift->duration * 60;

            $slots = [];
            for ($time = $start; $time + $duration <= $end; $time += $duration) {
                $slotTime = date('H:i', $time);
                // Count existing active appointments for this slot and service type
                $count = Appointment::where('doctor_id', $doctor_id)
                    ->where('date', $date)
                    ->where('start_time', $slotTime)
                    ->when($shift->service_type, function ($q) use ($shift) {
                        $q->where('service_type', $shift->service_type);
                    })
                    ->whereNotIn('status', ['canceled'])
                    ->count();
                $remaining = max(0, ($shift->capacity_per_slot ?? 1) - $count);
                if ($remaining > 0) {
                    $slots[] = [
                        'time' => $slotTime,
                        'remaining' => $remaining,
                    ];
                }
            }

            $data[] = [
                'shift_id' => $shift->id,
                'service_type' => $shift->service_type,
                'date' => $date,
                'start_time' => $shift->start_time,
                'end_time' => $shift->end_time,
                'duration' => $shift->duration,
                'capacity_per_slot' => $shift->capacity_per_slot,
                'slots' => $slots,
            ];
        }

        return response()->json([
            'status' => 'success',
            'shifts' => $data
        ], 200);
    }
    /**
     * Update a doctor's shift | بروزرسانی شیفت پزشک
     * @authenticated
     * @group Doctor Shifts
     */
    public function update(Request $request, $id)
    {
        $shift = Shift::find($id);

        if (!$shift) {
            return response()->json([
                'status' => 'error',
                'message' => 'Shift not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'day' => 'required|integer|min:0|max:6',
            'start_time' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'], // HH:MM 24h
            'end_time' => [
                'required',
                'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/',
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) <= strtotime($request->start_time)) {
                        $fail('The end time must be after the start time.');
                    }
                }
            ],
            'duration' => 'required|integer|min:1|max:60',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $shift->update($request->all());

        return response()->json([
            'status' => 'success',
            'shift' => $shift
        ], 200);
    }
    /**
     * Delete a doctor's shift | حذف شیفت پزشک
     * @authenticated
     * @group Doctor Shifts
     */
    public function destroy($id)
    {
        $shift = Shift::find($id);

        if (!$shift) {
            return response()->json([
                'status' => 'error',
                'message' => 'Shift not found.'
            ], 404);
        }

        $shift->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Shift deleted successfully.'
        ], 200);
    }
}
