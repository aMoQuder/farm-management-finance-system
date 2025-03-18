<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;


use Illuminate\Http\JsonResponse;
use App\Http\Resources\BlogResourse;

use App\Model\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class BlogController extends Controller
{   ///////////////////// Get All Blogs ///////////////////////
    public function index(): JsonResponse
    {
        $blogs = BlogResourse::collection (Blog::orderBy('created_at', 'desc')->paginate(3));
        return response()->json([
            'success' => true,
            'message' => 'Blogs retrieved successfully',
            'data' => $blogs
        ], 200);
    }

    ///////////////////// Store Blog ///////////////////////
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|min:5',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = "";
        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path("blog/img/"), $imageName);
        }

        $blog = Blog::create([
            "title" => $request->title,
            "image" => $imageName,
            "description" => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully',
            'data' => $blog
        ], 201);
    }

    ///////////////////// Show Single Blog ///////////////////////
    public function show($id): JsonResponse
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['success' => false, 'message' => 'Blog not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Blog retrieved successfully',
            'data'=>new BlogResourse( $blog ),
        ], 200);
    }

    ///////////////////// Update Blog ///////////////////////
    public function update(Request $request, $id): JsonResponse
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['success' => false, 'message' => 'Blog not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|min:5',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $blog->image;

        if ($request->hasFile('image')) {
            if (!empty($blog->image) && File::exists(public_path('blog/img/' . $blog->image))) {
                File::delete(public_path('blog/img/' . $blog->image));
            }
            $image = $request->file("image");
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path("blog/img/"), $imageName);
        }

        $blog->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully',
            'data'=>new BlogResourse( $blog ),
        ], 200);
    }

    ///////////////////// Delete Blog ///////////////////////
    public function destroy($id): JsonResponse
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['success' => false, 'message' => 'Blog not found'], 404);
        }

        if (!empty($blog->image) && File::exists(public_path('blog/img/' . $blog->image))) {
            File::delete(public_path('blog/img/' . $blog->image));
        }

        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully',
            'data'=>new BlogResourse( $blog ),

        ], 200);
    }
}
