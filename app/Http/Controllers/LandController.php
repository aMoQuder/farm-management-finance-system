<?php

namespace App\Http\Controllers;

use App\Model\Land;
use App\Model\Crop;
use App\Model\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Fertilizer;
use App\Http\Controllers\CropController; // استدعاء CropController

class LandController extends Controller {

    public function index() {
        $lands = Land::with( 'supervisor' )->get();
        return view('System.lands.index', compact( 'lands' ) );
    }

    public function create() {
        $workers = Worker::all();
        return view('System.lands.create', compact( 'workers' ) );
    }

    public function store( Request $request ) {
        $validated = $request->validate( [
            'name' => 'required|string',
            'area' => 'required|numeric',
            'supervisor_id' => 'required|exists:workers,id',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'area.required'=>'مطلوووووووووووووووووووووب',
            'supervisor_id.required'=>'  اختر عامل من اجل هذه الارض او قم باضافة عامل  ',
        ] );
        Land::create( [
            'name' => $request->name,
            'area' => $request->area,
            'supervisor_id' => $request->supervisor_id,
        ] );
        return redirect()->route( 'lands.index' )->with( 'massage', 'لفد تم اضافة ارض جديدة الى نيولاند' );
    }

    public function show( $id ) {
        $land = Land::with( [ 'supervisor' ] )->findOrFail( $id );
        return view('System.lands.show', compact( 'land' ) );
    }

    public function edit( $id ) {
        $land = Land::findOrFail( $id );
        $workers = Worker::all();
        return view('System.lands.edit', compact( 'land', 'workers' ) );
    }

    public function update( Request $request, $id ) {
        $validated = $request->validate( [
            'name' => 'required|string',
            'area' => 'required|numeric',
            'supervisor_id' => 'required|exists:workers,id',
        ] );
        $land = Land::findOrFail( $id );
        $land->update( $validated );
        return redirect()->route( 'lands.index' );
    }

    public function destroy( $landId ) {
        $land = Land::findOrFail( $landId );
          // استدعاء deleteAllCrops من CropController
        $cropController = new CropController();
        $cropController->deleteAllCrops($landId);

        $land->delete();

        return redirect()->route( 'lands.index' )->with( 'delete', 'لفد تم حذف ارض من نيولاند' );
    }

}
