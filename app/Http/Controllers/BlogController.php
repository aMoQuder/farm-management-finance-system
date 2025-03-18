<?php

namespace App\Http\Controllers;

use App\Model\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = blog::orderBy('created_at', 'desc')->paginate(3);;
        return view('website.blog', compact('blogs'));
    }
    public function index()
    {
        $blogs = blog::all();
        return view('WebMonitor.blog.index', compact('blogs'));
    }

    /////////////////////create///////////////////////

    public function create()
    {
        return view('WebMonitor.blog.create');
    }
    /////////////////////save created//////////////////////

    public function store(Request $request)
    {

        $imageName = "";
        $validated = $request->validate( [
            'title' => 'required|string',
            'description' => 'required|min:5',
            'image' => 'required',
        ], [
            'title.required'=>'مطلوووووووووووووووووووووب',
            'description.required'=>'مطلوووووووووووووووووووووب',
            'image.required'=>'مطلوووووووووووووووووووووب',
        ] );
        if ($request->hasFile("image")) {
            $image = $request->image;
            $imageName = rand(1, 1000) . time() . "." . $image->extension();
            $image->move(public_path("blog/img/"), $imageName);
        }


        blog::create([
            "title" => $request->title,
            "image" => $imageName,
            "description" => $request->description,
        ]);
        return redirect()->route('allblog')->with("massege", "successfully adding new blog");
    }

    /////////////////////Delete///////////////////////
    public function delete($id)
    {
        $blog = blog::findOrFail($id);
        if (File::exists(public_path('blog/img/' . $blog->image))) {
            File::delete(public_path('blog/img/' . $blog->image));
        }
        $blog->delete();
        return redirect()->back()->with("delete", "successfully deleted blog");
    }



    /////////////////////  Edit///////////////////////
    public function edit($id)
    {
        $blog = blog::findOrFail($id);
        return view("WebMonitor.blog.edit", ['blog' => $blog]);
    }




    ///////////////////// Save Edit///////////////////////


    public function save(Request $request)
    {

        $validated = $request->validate( [
            'title' => 'required|string',
            'description' => 'required|min:5',
        ], [
            'title.required'=>'مطلوووووووووووووووووووووب',
            'description.required'=>'مطلوووووووووووووووووووووب',
        ] );
        $imageName = "";
        $old_id = $request->old_id;


        $blog = blog::findOrFail($old_id);

        if ($request->hasFile('image')) {
            if (File::exists(public_path('blog/img/' . $blog->image))) {
                File::delete(public_path('blog/img/' . $blog->image));
            }
            $image = $request->image;
            $imageName = rand(1, 1000) . time() . "." . $image->extension();
            $image->move(public_path("blog/img/"), $imageName);
        } else {
            $imageName = $request->old_img;
        }

        $blog->update([
            'image' => $imageName,
            'title' => $request->title,
            "description" =>  $request->description,
        ]);
        return redirect()->route('allblog')->with("massege", "successfully updated new blog");
    }
}
