<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LandResourse;
use App\Model\Land;
use Illuminate\Http\Request;

class LandController extends Controller
{
    // جلب جميع الأراضي
    public function index()
    {
        $lands = Land::with('supervisor')->get();
        return response()->json([
            'status' => true,
            'message' => 'جميع الأراضي',
            'data' => LandResourse::collection($lands)
        ]);
    }

    // عرض أرض معينة
    public function show($id)
    {
        $land = Land::with('supervisor')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'تفاصيل الأرض',
            'data' => new LandResourse($land)
        ]);
    }

    // إضافة أرض جديدة
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'area' => 'required|numeric',
            'supervisor_id' => 'required|exists:workers,id',
        ]);

        $land = Land::create([
            'name' => $request->name,
            'area' => $request->area,
            'supervisor_id' => $request->supervisor_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تمت إضافة الأرض بنجاح',
            'data' => new LandResourse($land)
        ], 201);
    }

    // تعديل بيانات الأرض
    public function update(Request $request, $id)
    {
        $land = Land::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'area' => 'required|numeric',
            'supervisor_id' => 'required|exists:workers,id',
        ]);

        $land->update([
            'name' => $request->name,
            'area' => $request->area,
            'supervisor_id' => $request->supervisor_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل بيانات الأرض بنجاح',
            'data' => new LandResourse($land)
        ]);
    }

    // حذف أرض معينة
    public function destroy($id)
    {
        $land = Land::findOrFail($id);
        $land->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم حذف الأرض بنجاح',
        ]);
    }
}
