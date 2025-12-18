<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    /**
     * List prescriptions | لیست نسخه‌ها
     * 
     * Get all prescriptions or filter by medical record ID.
     * 
     * @authenticated
     * @group Prescriptions
     * 
     * @urlParam record_id integer optional Filter by medical record ID. Example: 5
     * 
     * @response 200 {
     *   "status": "success",
     *   "prescriptions": [
     *     {
     *       "id": 1,
     *       "medical_record_id": 5,
     *       "visit_id": 3,
     *       "medication_name": "آسپرین",
     *       "dosage": "100mg",
     *       "instructions": "روزی دو بار با غذا",
     *       "duration_days": 7
     *     }
     *   ]
     * }
     */
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


    /**
     * Create a new prescription | ایجاد نسخه جدید
     * 
     * Create a prescription for a patient's medical record.
     * 
     * @authenticated
     * @group Prescriptions
     * 
     * @bodyParam medical_record_id integer required Medical record ID. Example: 5
     * @bodyParam visit_id integer Optional visit ID. Example: 3
     * @bodyParam medication_name string required Name of medication. Example: آسپرین
     * @bodyParam dosage string Medication dosage. Example: 100mg
     * @bodyParam instructions string Usage instructions. Example: روزی دو بار با غذا
     * @bodyParam duration_days integer Duration in days. Example: 7
     * 
     * @response 201 {
     *   "status": "success",
     *   "prescription": {
     *     "id": 1,
     *     "medical_record_id": 5,
     *     "medication_name": "آسپرین",
     *     "dosage": "100mg",
     *     "instructions": "روزی دو بار با غذا",
     *     "duration_days": 7
     *   }
     * }
     * 
     * @response 422 {
     *   "status": "error",
     *   "errors": {
     *     "medication_name": ["The medication name field is required."]
     *   }
     * }
     */
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

    /**
     * Show a prescription | نمایش جزئیات نسخه
     * 
     * Get details of a specific prescription by ID.
     * 
     * @authenticated
     * @group Prescriptions
     * 
     * @urlParam id integer required Prescription ID. Example: 1
     * 
     * @response 200 {
     *   "status": "success",
     *   "prescription": {
     *     "id": 1,
     *     "medical_record_id": 5,
     *     "medication_name": "آسپرین",
     *     "dosage": "100mg",
     *     "instructions": "روزی دو بار با غذا",
     *     "duration_days": 7
     *   }
     * }
     * 
     * @response 404 {
     *   "status": "error",
     *   "message": "Not found"
     * }
     */
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
