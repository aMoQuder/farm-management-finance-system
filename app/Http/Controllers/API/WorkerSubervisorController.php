<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Workervisour;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WorkerSubervisorController extends Controller {

    public function index(): JsonResponse {
        $workervisours = Workervisour::all();
        return response()->json([
            'status' => true,
            'message' => 'تم جلب جميع المقاولين بنجاح',
            'data' => $workervisours
        ], 200);
    }

    public function store(Request $request): JsonResponse {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $workervisour = Workervisour::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تمت إضافة المقاول بنجاح',
            'data' => $workervisour
        ], 201);
    }

    public function show($id): JsonResponse {
        $workervisour = Workervisour::find($id);
        return response()->json([
            'status' => true,
            'message' => 'تم جلب بيانات المقاول بنجاح',
            'data' => $workervisour
        ], 200);
    }

    public function update(Request $request, $id): JsonResponse {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $workervisour = Workervisour::find($id);
        $workervisour->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تحديث بيانات المقاول بنجاح',
            'data' => $workervisour
        ], 200);
    }

    public function destroy($id): JsonResponse {
        $workervisour = Workervisour::find($id);
        $workervisour->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم حذف المقاول بنجاح'
        ], 200);
    }
}
