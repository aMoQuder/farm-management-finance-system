<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;


use Illuminate\Http\JsonResponse;
use App\Http\Resources\GalaryResourse;

use App\Model\Galary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class GalaryController extends Controller
{   ///////////////////// Get All Galarys ///////////////////////
    public function index(): JsonResponse
    {
        $Galarys = GalaryResourse::collection (Galary::orderBy('created_at', 'desc')->paginate(3));
        return response()->json([
            'success' => true,
            'message' => 'Galarys retrieved successfully',
            'data' => $Galarys
        ], 200);
    }

    ///////////////////// Store Galary ///////////////////////
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = "";
        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path("Galary/img/"), $imageName);
        }

        $Galary = Galary::create([
            "title" => $request->title,
            "image" => $imageName,

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Galary created successfully',
            'data' => $Galary
        ], 201);
    }

    ///////////////////// Show Single Galary ///////////////////////
    public function show($id): JsonResponse
    {
        $Galary = Galary::find($id);

        if (!$Galary) {
            return response()->json(['success' => false, 'message' => 'Galary not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Galary retrieved successfully',
            'data'=>new GalaryResourse( $Galary ),
        ], 200);
    }

    ///////////////////// Update Galary ///////////////////////
    public function update(Request $request, $id): JsonResponse
    {
        $Galary = Galary::find($id);

        if (!$Galary) {
            return response()->json(['success' => false, 'message' => 'Galary not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $Galary->image;

        if ($request->hasFile('image')) {
            if (!empty($Galary->image) && File::exists(public_path('Galary/img/' . $Galary->image))) {
                File::delete(public_path('Galary/img/' . $Galary->image));
            }
            $image = $request->file("image");
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path("Galary/img/"), $imageName);
        }

        $Galary->update([
            'title' => $request->title,
            'image' => $imageName,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Galary updated successfully',
            'data'=>new GalaryResourse( $Galary ),
        ], 200);
    }

    ///////////////////// Delete Galary ///////////////////////
    public function destroy($id): JsonResponse
    {
        $Galary = Galary::find($id);

        if (!$Galary) {
            return response()->json(['success' => false, 'message' => 'Galary not found'], 404);
        }

        if (!empty($Galary->image) && File::exists(public_path('Galary/img/' . $Galary->image))) {
            File::delete(public_path('Galary/img/' . $Galary->image));
        }

        $Galary->delete();

        return response()->json([
            'success' => true,
            'message' => 'Galary deleted successfully',
            'data'=>new GalaryResourse( $Galary ),

        ], 200);
    }
}
