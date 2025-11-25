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
            ->orderBy('day')
            ->get();
        $data = [];
        foreach ($shifts as $shift) {
            $start = strtotime($shift->start_time);
            $end = strtotime($shift->end_time);
            $duration_seconds = $shift->duration * 60;
            $number_of_slots = floor(($end - $start) / $duration_seconds);
            $data[] = [
                'id' => $shift->id,
                'day' => $shift->day,
                'start_time' => $shift->start_time,
                'end_time' => $shift->end_time,
                'duration' => $shift->duration,
                'slots' => $number_of_slots,
            ];
        }
        return response()->json([
            'status' => 'success',
            'shifts' => $data
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
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

        $shift = Shift::create($request->all());

        return response()->json([
            'status' => 'success',
            'shift' => $shift
        ], 201);
    }
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

        // محاسبه روز هفته مطابق سیستمی که خودت ساختی
        $day = (date('w', strtotime($date)) == 6) ? 0 : date('w', strtotime($date)) + 1;

        $shifts = Shift::where('doctor_id', $doctor_id)
            ->where('day', $day)
            ->get();

        if ($shifts->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No shifts found for this doctor on this date.'
            ], 404);
        }

        // نوبت‌های رزرو شده در همین تاریخ
        $reserved = Appointment::where('doctor_id', $doctor_id)
            ->where('date', $date)
            ->pluck('start_time')
            ->map(function ($time) {
                return date('H:i', strtotime($time)); // تبدیل به فرمت اسلات‌ها
            })
            ->toArray();

        $data = [];

        foreach ($shifts as $shift) {
            $start = strtotime($shift->start_time);
            $end = strtotime($shift->end_time);
            $duration = $shift->duration * 60;

            $slots = [];
            for ($time = $start; $time + $duration <= $end; $time += $duration) {
                $slots[] = date('H:i', $time);
            }

            // حذف اسلات‌های رزرو شده
            $slots = array_values(array_diff($slots, $reserved));

            $data[] = [
                'shift_id' => $shift->id,
                'start_time' => $shift->start_time,
                'end_time' => $shift->end_time,
                'duration' => $shift->duration,
                'slots' => $slots
            ];
        }

        return response()->json([
            'status' => 'success',
            'shifts' => $data
        ], 200);
    }



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
