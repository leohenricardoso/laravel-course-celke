<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillRequest;
use App\Models\Bill;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index():JsonResponse {
        //$bills = Bill::orderBy('id', 'DESC')->get();
        $bills = Bill::orderBy('id', 'DESC')->paginate(20);

        return response()->json([
            'status' => true,
            'bills' => $bills
        ]);
    }

    public function show(Bill $bill): JsonResponse {
        return response()->json([
            'status' => true,
            'bill' => $bill
        ]);
    }

    public function store(BillRequest $request): JsonResponse
    {

        DB::beginTransaction();
        try {
            $bill = Bill::create([
                'name' => $request->name,
                'bill_value' => $request->bill_value,
                'due_date' => $request->due_date,
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'bill' => $bill
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false
            ], 400);
        }
    }

    public function update(BillRequest $request, Bill $bill): JsonResponse
    {
        DB::beginTransaction();
        try {
            $bill->update([
                'name' => $request->name,
                'bill_value' => $request->bill_value,
                'due_date' => $request->due_date
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Bill updated successfully',
                'bill' => $bill
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(Bill $bill): JsonResponse
    {
        DB::beginTransaction();
        try {
            $bill->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Bill deleted successfully',
                'bill' => $bill
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
