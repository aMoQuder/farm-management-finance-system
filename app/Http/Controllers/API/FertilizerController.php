<?php

namespace App\Http\Controllers\API;

use App\Model\Crop;
use App\Model\Land;
use App\Model\Store;
use App\Model\Fertilizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FertilizerController extends Controller
{
    // إضافة سماد لمحصول معين
    public function addFertilizer(Request $request)
    {
        $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'type_quantity' => 'required|string',
            'acquired_date' => 'required|date',
        ]);

        $crop = Crop::findOrFail($request->crop_id);
        $land_id = $crop->Landable_id;

        $fertilizer = $crop->FertilizerCrop()->create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'type_quantity' => $request->type_quantity,
            'acquired_date' => $request->acquired_date,
            'land_id' => $land_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم إضافة السماد بنجاح',
            'data' => $fertilizer
        ], 201);
    }

    // إضافة سماد من المخزن
    public function storeFromStore(Request $request)
    {
        $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'name' => 'required|exists:stores,id',
            'quantity' => 'required|numeric',
            'type_quantity' => 'required|string',
            'acquired_date' => 'required|date',
        ]);

        $store = Store::findOrFail($request->name);
        if ($store->quantity < $request->quantity) {
            return response()->json(['error' => 'الكمية المدخلة أكبر من المتوفرة في المخزن.'], 400);
        }

        $store->update(['quantity' => $store->quantity - $request->quantity]);

        $crop = Crop::findOrFail($request->crop_id);
        $land_id = $crop->Landable_id;

        $fertilizer = $crop->FertilizerCrop()->create([
            'name' => $store->name,
            'quantity' => $request->quantity,
            'type_quantity' => $request->type_quantity,
            'acquired_date' => $request->acquired_date,
            'land_id' => $land_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم إضافة السماد من المخزن بنجاح',
            'data' => $fertilizer
        ]);
    }

    // عرض جميع الأسمدة
    public function index()
    {
        $fertilizers = Fertilizer::with('landFertilizer')->get();
        return response()->json([
            'status' => true,
            'message' => 'جميع الأسمدة',
            'data' => $fertilizers
        ]);
    }

    // تعديل بيانات السماد
    public function updateFertilizer(Request $request, $crop_id, $fertilizer_id)
    {
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'type_quantity' => 'required|string',
            'acquired_date' => 'required|date',
        ]);

        $crop = Crop::findOrFail($crop_id);
        $fertilizer = $crop->FertilizerCrop()->findOrFail($fertilizer_id);

        $fertilizer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل السماد بنجاح',
            'data' => $fertilizer
        ]);
    }

    // حذف سماد معين
    public function deleteFertilizer($crop_id, $fertilizer_id)
    {
        $crop = Crop::findOrFail($crop_id);
        $fertilizer = $crop->FertilizerCrop()->findOrFail($fertilizer_id);

        $fertilizer->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم حذف السماد بنجاح'
        ]);
    }

    // حذف جميع الأسمدة المرتبطة بالمحصول
    public function deleteAllFertilizer($crop_id)
    {
        $crop = Crop::findOrFail($crop_id);
        $crop->FertilizerCrop()->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم حذف جميع الأسمدة المرتبطة بالمحصول'
        ]);
    }
}
