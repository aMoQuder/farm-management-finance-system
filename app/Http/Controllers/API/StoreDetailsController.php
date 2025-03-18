<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreDetails;
use Illuminate\Http\Request;

class StoreDetailsController extends Controller
{
    public function index($storeId)
    {
        $store = Store::findOrFail($storeId);
        $storeDetails = $store->StoreDetails;
        return response()->json(['store_details' => $storeDetails], 200);
    }

    public function store(Request $request, $storeId)
    {
        $store = Store::findOrFail($storeId);

        $validated = $request->validate([
            'getter_name' => 'required|string',
            'get_date' => 'required|date',
            'quantity' => 'required|numeric',
            'land_id' => 'required|exists:lands,id',
            'crop_id' => 'required|exists:crops,id',
        ]);

        $storeDetail = $store->StoreDetails()->create($validated);

        return response()->json([
            'message' => 'تم إضافة تفاصيل التخزين بنجاح',
            'store_detail' => $storeDetail
        ], 201);
    }

    public function show($storeId, $storeDetailId)
    {
        $store = Store::findOrFail($storeId);
        $storeDetail = $store->StoreDetails()->findOrFail($storeDetailId);

        return response()->json(['store_detail' => $storeDetail], 200);
    }

    public function update(Request $request, $storeId, $storeDetailId)
    {
        $store = Store::findOrFail($storeId);
        $storeDetail = $store->StoreDetails()->findOrFail($storeDetailId);

        $validated = $request->validate([
            'getter_name' => 'sometimes|string',
            'get_date' => 'sometimes|date',
            'quantity' => 'sometimes|numeric',
            'land_id' => 'sometimes|exists:lands,id',
            'crop_id' => 'sometimes|exists:crops,id',
        ]);

        $storeDetail->update($validated);

        return response()->json([
            'message' => 'تم تعديل تفاصيل التخزين بنجاح',
            'store_detail' => $storeDetail
        ], 200);
    }

    public function destroy($storeId, $storeDetailId)
    {
        $store = Store::findOrFail($storeId);
        $storeDetail = $store->StoreDetails()->findOrFail($storeDetailId);
        $storeDetail->delete();

        return response()->json(['message' => 'تم حذف تفاصيل التخزين بنجاح'], 200);
    }

    public function destroyAll($storeId)
    {
        $store = Store::findOrFail($storeId);
        $store->StoreDetails()->delete();

        return response()->json(['message' => 'تم حذف جميع تفاصيل التخزين بنجاح'], 200);
    }
}
