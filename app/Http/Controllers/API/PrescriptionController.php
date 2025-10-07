<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
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


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'medical_record_id' => 'required|exists:medical_records,id',
            'visit_id' => 'nullable|exists:visits,id',
            'medication_name' => 'required|string',
            'dosage' => 'nullable|string',
            'instructions' => 'nullable|string',
            'duration_days' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) return response()->json(['status'=>'error','errors'=>$validator->errors()], 422);

        $presc = Prescription::create($request->all());
        return response()->json(['status'=>'success','prescription'=>$presc], 201);
    }

    public function show($id)
    {
        $p = Prescription::find($id);
        if (!$p) return response()->json(['status'=>'error','message'=>'Not found'], 404);
        return response()->json(['status'=>'success','prescription'=>$p], 200);
    }

    public function update(Request $request, $id)
    {
        $p = Prescription::find($id);
        if (!$p) return response()->json(['status'=>'error','message'=>'Not found'], 404);

        $validator = Validator::make($request->all(), [
            'medication_name' => 'sometimes|string',
            'dosage' => 'sometimes|string',
            'instructions' => 'sometimes|string',
            'duration_days' => 'sometimes|integer|min:1',
        ]);
        if ($validator->fails()) return response()->json(['status'=>'error','errors'=>$validator->errors()], 422);

        $p->update($request->only(['medication_name','dosage','instructions','duration_days']));
        return response()->json(['status'=>'success','prescription'=>$p], 200);
    }

    public function destroy($id)
    {
        $p = Prescription::find($id);
        if (!$p) return response()->json(['status'=>'error','message'=>'Not found'], 404);
        $p->delete();
        return response()->json(['status'=>'success','message'=>'Deleted'], 200);
    }
}
