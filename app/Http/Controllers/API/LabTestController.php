<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LabTestController extends Controller
{
    public function index($record_id = null)
    {
        $query = LabTest::query();

        if (!is_null($record_id)) {
            $query->where('medical_record_id', $record_id);
        }

        $items = $query->get();

        return response()->json([
            'status' => 'success',
            'lab_tests' => $items
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'medical_record_id' => 'required|exists:medical_records,id',
            'visit_id' => 'nullable|exists:visits,id',
            'test_name' => 'required|string',
            'result' => 'nullable|string',
            'file_path' => 'nullable|string', // یا file upload handling
        ]);

        if ($validator->fails()) return response()->json(['status'=>'error','errors'=>$validator->errors()], 422);

        $lab = LabTest::create($request->all());

        return response()->json(['status'=>'success','lab_test'=>$lab], 201);
    }

    public function show($id)
    {
        $lab = LabTest::find($id);
        if (!$lab) return response()->json(['status'=>'error','message'=>'Not found'], 404);
        return response()->json(['status'=>'success','lab_test'=>$lab], 200);
    }

    // بروزرسانی (مثلاً ثبت نتیجه و آپلود فایل جواب)
    public function update(Request $request, $id)
    {
        $lab = LabTest::find($id);
        if (!$lab) return response()->json(['status'=>'error','message'=>'Not found'], 404);

        $validator = Validator::make($request->all(), [
            'result' => 'nullable|string',
            'status' => 'nullable|in:pending,completed',
            'file_path' => 'nullable|string', // یا handle uploaded file
        ]);

        if ($validator->fails()) return response()->json(['status'=>'error','errors'=>$validator->errors()], 422);

        $lab->update($request->only(['result','status','file_path']));

        return response()->json(['status'=>'success','lab_test'=>$lab], 200);
    }

    public function destroy($id)
    {
        $lab = LabTest::find($id);
        if (!$lab) return response()->json(['status'=>'error','message'=>'Not found'], 404);
        $lab->delete();
        return response()->json(['status'=>'success','message'=>'Deleted'], 200);
    }
}
