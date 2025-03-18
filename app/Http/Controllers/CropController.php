<?php

namespace App\Http\Controllers;

use App\Model\Land;
use App\Model\Crop;
use App\Model\Fertilizer;
use App\Model\Worker;
use App\Model\Workervisour;
use App\Model\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CropController extends Controller {
    public function index() {
        $lands = Land::all();
        $crops = Crop::all();
        return view( 'System.Crops.index', compact( 'crops', 'lands' ) );
    }

    public function createCrop() {
        $lands = Land::all();
        return view( 'System.Crops.create', compact( 'lands' ) );
    }

    public function addCrops( Request $request ) {
        if ( $request->has( 'Land_id' ) ) {
            $id = $request->Land_id;

            $land = Land::findOrFail( $id );

            $request->validate( [
                'name' => 'required|string',
                'seed_quantity' => 'required|numeric',
                'seed_price' => 'required|numeric',
                'seed_acquired_date' => 'required|date',
            ] );

            $land->LandCrops()->create( [
                'name' => $request->name,
                'seed_quantity' => $request->seed_quantity,
                'type_quantity' => $request->type_quantity,
                'seed_price' => $request->seed_price,
                'seed_acquired_date' => $request->seed_acquired_date,
            ] );
            return redirect()->route( 'lands.show', $id )->with( 'massage', 'تم إضافة زرع بنجاح' );
        } else {
            $request->validate( [
                'Land_id' => 'required',
            ], [

                'Land_id.required'=>'يرجى انشاء ارض قبل الزرع '
            ] );
        }

    }

    public function editCrop( $landId, $CropId ) {
        $land = Land::findOrFail( $landId );
        $crop = $land->LandCrops()->findOrFail( $CropId );
        return view( 'System.Crops.editCrops', compact( 'land', 'crop' ) );
    }

    public function updateCrop( Request $request, $landId, $CropId ) {
        $land = Land::findOrFail( $landId );
        $crop = $land->LandCrops()->findOrFail( $CropId );

        $request->validate( [
            'name' => 'required|string',
            'seed_quantity' => 'required|numeric',
            'seed_price' => 'required|numeric',
            'seed_acquired_date' => 'required|date',
        ] );
        $crop->update( [
            'name' => $request->name,
            'seed_quantity' => $request->seed_quantity,
            'seed_price' => $request->seed_price,
            'type_quantity' => $request->type_quantity,
            'seed_acquired_date' => $request->seed_acquired_date,
        ] );

        return redirect()->route( 'lands.show', $land )->with( 'massage', 'تم تعديل الزرع بنجاح' );
    }

    public function showCrop( $landId, $CropId ) {
        $land = Land::findOrFail( $landId );
        $crop = $land->LandCrops()->findOrFail( $CropId );
        $workers = Worker::all();
        $stores = Store::all();
        $Workervisours = Workervisour::all();

        return view( 'System.Crops.show', compact( 'land', 'crop', 'workers', 'stores', 'Workervisours' ) );
    }

    public function deleteCrop( Request $request, $landId, $CropId ) {
        $land = Land::findOrFail( $landId );
        $crop = $land->LandCrops()->findOrFail( $CropId );
        $crop->FertilizerCrop()->delete();
        $crop->MachineJobCrop()->delete();
        $crop->WorkerGroupCrop()->delete();

        $id_session = $request->id_session;
        $crop->delete();
        if ( $id_session == 10 ) {
            return redirect()->route( 'crops.index' )->with( 'delete', 'تم حذف الزرع بنجاح' );
        } else {
            return redirect()->route( 'lands.show', $landId )->with( 'delete', 'تم حذف الزرع بنجاح' );
        }
    }

    public function deleteAllCrops( $landId ) {
        $land = Land::findOrFail( $landId );
        // حذف جميع المزروعات المرتبطة بالارض
        $crops = Crop::where( 'Landable_id', $landId )->get();
        foreach ( $crops as $crop ) {
            // التأكد من أن $crop هو نموذج Eloquent
            if ( $crop instanceof Crop ) {
                // حذف جميع الأسمدة المرتبطة بالمحصول
                $crop->FertilizerCrop()->delete();
                $crop->MachineJobCrop()->delete();
                $crop->WorkerGroupCrop()->delete();
            }
        }

        $land->LandCrops()->delete();

        if ( request()->isMethod( 'delete' ) ) {
            return redirect()->route( 'lands.show', $landId )->with( 'delete', 'تم حذف جميع الزرع بنجاح' );
        }

    }
}
