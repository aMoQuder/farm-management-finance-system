<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Model\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * عرض جميع المخازن
     */
    public function index()
    {
        return StoreResource::collection(Store::all());
    }

    /**
     * إضافة مخزن جديد
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'store_date' => 'required|date',
            'type_quantity' => 'required|string',
            'type_store' => 'required|string',
        ]);

        $store = Store::create($validatedData);

        return new StoreResource($store);
    }

    /**
     * عرض بيانات مخزن معين
     */
    public function show(Store $store)
    {
        return new StoreResource($store);
    }

    /**
     * تحديث بيانات المخزن
     */
    public function update(Request $request, Store $store)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'store_date' => 'required|date',
            'type_quantity' => 'required|string',
            'type_store' => 'required|string',
        ]);

        $store->update($validatedData);

        return new StoreResource($store);
    }

    /**
     * حذف مخزن معين
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return response()->json(['message' => 'تم حذف المخزن بنجاح'], 200);
    }
}
