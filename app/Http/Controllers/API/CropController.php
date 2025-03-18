<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CropResourse;
use App\Model\Crop;
use App\Model\Land;
use Illuminate\Http\Request;

class CropController extends Controller
{
    // جلب جميع المحاصيل
    public function index()
    {
        $crops = Crop::all();
        return CropResourse::collection($crops);
    }

    // عرض محصول معين
    public function show($landId, $cropId)
    {
        $land = Land::findOrFail($landId);
        $crop = $land->LandCrops()->findOrFail($cropId);
        return new CropResourse($crop);
    }

    // إضافة محصول جديد
    public function store(Request $request)
    {
        $request->validate([
            'Land_id' => 'required|exists:lands,id',
            'name' => 'required|string',
            'seed_quantity' => 'required|numeric',
            'seed_price' => 'required|numeric',
            'seed_acquired_date' => 'required|date',
        ]);

        $land = Land::findOrFail($request->Land_id);

        $crop = $land->LandCrops()->create([
            'name' => $request->name,
            'seed_quantity' => $request->seed_quantity,
            'seed_price' => $request->seed_price,
            'seed_acquired_date' => $request->seed_acquired_date,
        ]);

        return response()->json([
            'message' => 'تمت إضافة المحصول بنجاح',
            'crop' => new CropResourse($crop)
        ], 201);
    }

    // تعديل بيانات محصول
    public function update(Request $request, $landId, $cropId)
    {
        $land = Land::findOrFail($landId);
        $crop = $land->LandCrops()->findOrFail($cropId);

        $request->validate([
            'name' => 'required|string',
            'seed_quantity' => 'required|numeric',
            'seed_price' => 'required|numeric',
            'seed_acquired_date' => 'required|date',
        ]);

        $crop->update([
            'name' => $request->name,
            'seed_quantity' => $request->seed_quantity,
            'seed_price' => $request->seed_price,
            'seed_acquired_date' => $request->seed_acquired_date,
        ]);

        return response()->json([
            'message' => 'تم تعديل المحصول بنجاح',
            'crop' => new CropResourse($crop)
        ]);
    }

    // حذف محصول معين
    public function destroy($landId, $cropId)
    {
        $land = Land::findOrFail($landId);
        $crop = $land->LandCrops()->findOrFail($cropId);

        $crop->FertilizerCrop()->delete();
        $crop->MachineJobCrop()->delete();
        $crop->WorkerGroupCrop()->delete();
        $crop->delete();

        return response()->json(['message' => 'تم حذف المحصول بنجاح']);
    }

    // حذف جميع المحاصيل لأرض معينة
    public function deleteAllCrops($landId)
    {
        $land = Land::findOrFail($landId);
        $crops = $land->LandCrops();

        foreach ($crops as $crop) {
            $crop->FertilizerCrop()->delete();
            $crop->MachineJobCrop()->delete();
            $crop->WorkerGroupCrop()->delete();
        }

        $land->LandCrops()->delete();

        return response()->json(['message' => 'تم حذف جميع المحاصيل لهذه الأرض بنجاح']);
    }
}
