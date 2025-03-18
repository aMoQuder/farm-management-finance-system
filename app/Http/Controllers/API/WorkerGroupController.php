<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Crop;
use App\Model\WorkerGroup;
use App\Model\Workervisour;
use Illuminate\Http\Request;
use App\Http\Resources\WorkerGroupResourse;

use Illuminate\Support\Facades\DB;

class WorkerGroupController extends Controller {

    // جلب جميع مجموعات العمال
    public function index() {
        $WorkerGroups = WorkerGroupResourse::collection ( WorkerGroup::with('landWorking', 'supervisor')->get());
        return response()->json([
            'status' => true,
            'message' => 'جميع مجموعات العمال',
            'data' => $WorkerGroups
        ]);
    }

    // إضافة مجموعة عمال جديدة
    public function addWorkerGroup(Request $request) {
        $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'type_work' => 'required',
            'work' => 'required|string',
            'worker_count' => 'required|numeric',
            'daily_wage' => 'required|numeric',
            'work_date' => 'required|date',
        ]);

        $land_id = DB::table('crops')->where('id', $request->crop_id)->value('Landable_id');
        $crop = Crop::findOrFail($request->crop_id);

        // التحقق من وجود المشرف أو إنشائه
        if ($request->has('name')) {
            $supervisor = Workervisour::firstOrCreate(['name' => $request->name]);
        } else {
            $supervisor = Workervisour::findOrFail($request->supervisor_id);
        }

        $WorkerGroup = $crop->WorkerGroupCrop()->create([
            'supervisor_id' => $supervisor->id,
            'type_work' => $request->type_work,
            'work' => $request->work,
            'worker_count' => $request->worker_count,
            'daily_wage' => $request->daily_wage,
            'work_date' => $request->work_date,
            'Land_id' => $land_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تمت إضافة مجموعة عمال بنجاح',
            'data' => $WorkerGroup
        ], 201);
    }

    // عرض مجموعة عمال معينة
    public function showWorkerGroup($id) {
        $WorkerGroup = WorkerGroup::with('landWorking', 'supervisor')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'تفاصيل مجموعة العمال',
            'data' => $WorkerGroup
        ]);
    }

    // تعديل بيانات مجموعة العمال
    public function updateWorkerGroup(Request $request, $id) {
        $WorkerGroup = WorkerGroup::findOrFail($id);

        $request->validate([
            'type_work' => 'required',
            'work' => 'required|string',
            'worker_count' => 'required|numeric',
            'daily_wage' => 'required|numeric',
            'work_date' => 'required|date',
        ]);

        // التحقق من وجود المشرف أو إنشائه
        if ($request->has('name')) {
            $supervisor = Workervisour::firstOrCreate(['name' => $request->name]);
        } else {
            $supervisor = Workervisour::findOrFail($request->supervisor_id);
        }

        $WorkerGroup->update([
            'supervisor_id' => $supervisor->id,
            'type_work' => $request->type_work,
            'work' => $request->work,
            'worker_count' => $request->worker_count,
            'daily_wage' => $request->daily_wage,
            'work_date' => $request->work_date,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل مجموعة العمال بنجاح',
            'data' => $WorkerGroup
        ]);
    }

    // حذف مجموعة عمال معينة
    public function deleteWorkerGroup($id) {
        $WorkerGroup = WorkerGroup::findOrFail($id);
        $WorkerGroup->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم حذف مجموعة العمال بنجاح',
        ]);
    }

    // حذف جميع مجموعات العمال المرتبطة بزرع معين
    public function deleteAllWorkerGroup($CropId) {
        $Crop = Crop::findOrFail($CropId);
        $Crop->WorkerGroupCrop()->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم حذف جميع مجموعات العمال لهذا الزرع بنجاح',
        ]);
    }

    // عرض جميع الأعمال التي يشرف عليها مقاول معين
    public function displaySupervisor($id) {
        $Workervisour = Workervisour::findOrFail($id);
        $WorkerGroups = WorkerGroup::where('supervisor_id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => 'جميع الأعمال التي يشرف عليها المقاول',
            'data' => $WorkerGroups,
            'supervisor' => $Workervisour
        ]);
    }
}
