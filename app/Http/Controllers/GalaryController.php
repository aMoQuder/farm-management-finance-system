<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Galary;
use Illuminate\Support\Facades\File;

class GalaryController extends Controller
{
    public function Galary()
    {
        $Galarys = Galary::orderBy('created_at', 'desc')->paginate(12);;
        return view('website.Galary', compact('Galarys'));
    }
    public function index()
    {
        $Galarys = Galary::all();
        return view('WebMonitor.Galary.index', compact('Galarys'));
    }

    /////////////////////create///////////////////////

    public function create()
    {
        return view('WebMonitor.Galary.create');
    }
    ///////////////////// store  //////////////////////

    public function store(Request $request)
    {

        $imageName = "";
        $validated = $request->validate( [
            'title' => 'required|string',
            'image' => 'required',
        ], [
            'title.required'=>'مطلوووووووووووووووووووووب',
            'image.required'=>'مطلوووووووووووووووووووووب',
        ] );
        if ($request->hasFile("image")) {
            $image = $request->image;
            $imageName = rand(1, 1000) . time() . "." . $image->extension();
            $image->move(public_path("Galary/img/"), $imageName);
        }
        Galary::create([
            "title" => $request->title,
            "image" => $imageName,
        ]);
        return redirect()->route('allGalary')->with("massege", "successfully adding new Galary");
    }

    ///////////////////// Delete ///////////////////////
    public function delete($id)
    {
        $Galary = Galary::findOrFail($id);
        if (File::exists(public_path('Galary/img/' . $Galary->image))) {
            File::delete(public_path('Galary/img/' . $Galary->image));
        }
        $Galary->delete();
        return redirect()->back()->with("delete", "successfully deleted Galary");
    }



    /////////////////////  Edit ///////////////////////
    public function edit($id)
    {
        $Galary = Galary::findOrFail($id);
        return view("WebMonitor.Galary.edit", ['Galary' => $Galary]);
    }




    ///////////////////// update ///////////////////////


    public function update(Request $request)
    {
        $imageName = "";
        $old_id = $request->old_id;

        $validated = $request->validate( [
            'title' => 'required|string',
        ], [
            'title.required'=>'مطلوووووووووووووووووووووب',
        ] );
        $Galary = Galary::findOrFail($old_id);

        if ($request->hasFile('image')) {
            if (File::exists(public_path('Galary/img/' . $Galary->image))) {
                File::delete(public_path('Galary/img/' . $Galary->image));
            }
            $image = $request->image;
            $imageName = rand(1, 1000) . time() . "." . $image->extension();
            $image->move(public_path("Galary/img/"), $imageName);
        } else {
            $imageName = $request->old_img;
        }

        $Galary->update([
            'image' => $imageName,
            'title' => $request->title,
        ]);
        return redirect()->route('allGalary')->with("massege", "successfully updated new Galary");
    }
}
