<?php

namespace App\Http\Controllers;
use App\Model\Crop;
use App\Model\Land;
use App\Model\Store;
use App\Model\Fertilizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FertilizerController extends Controller {
    public function addFertilizer( Request $request ) {
        $id = $request->crop_id;

        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $id )
        ->value( 'Landable_id' );
        $crop = Crop::findOrFail( $id );

        $request->validate( [
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'type_quantity' => 'required',
            'acquired_date' => 'required|date',
        ] );

        $crop->FertilizerCrop()->create( [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'type_quantity' => $request->type_quantity,
            'acquired_date' => $request->acquired_date,
            'land_id'=>$land_id
        ] );

        return redirect()->route( 'lands.showCrop', [ $land_id, $id ] )->with( 'massage', 'تم إضافة سماد بنجاح' );
    }
    public function storeFromStore( Request $request ) {
        $store = Store::findOrFail( $request->name );
        $request->validate( [
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'type_quantity' => 'required',
            'acquired_date' => 'required|date',
        ] );

        // التحقق من الكمية
        if ( $store->quantity < $request->quantity ) {

            return back()->withErrors( [ 'quantity' => 'الكمية المدخلة أكبر من المتوفرة في المخزن.' ] );
        }
        // تحديث الكمية في المخزن
        $store->update( [ 'quantity' => $store->quantity - $request->quantity ] );
        $id = $request->crop_id ;
        // تخزين السحب في StoreDetails
        $storeDetailsController = new StoreDetailsController();
        $storeDetailsController->addStoreDetail( $request, $store->id );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $id )
        ->value( 'Landable_id' );
        // تخزين السماد في FertilizerCrop
        $crop = Crop::findOrFail($id);
        $crop->FertilizerCrop()->create( [
            'name' => $store->name,
            'quantity' => $request->quantity,
            'type_quantity' => $request->type_quantity,
            'acquired_date' => $request->acquired_date,
            'land_id'=>$land_id

        ] );

        return redirect()->route( 'lands.showCrop', [ $request->land_id, $request->crop_id ] )
        ->with( 'message', 'تم إضافة السماد من المخزن بنجاح.' );
    }

    public function index() {
        $FertilizerCrop = Fertilizer::with( 'landFertilizer' )->get();
        $crops = Crop::all();
        return view( 'System.fertilizers.index', compact( 'FertilizerCrop', 'crops' ) );
    }

    public function create() {
        $lands = Land::all();
        $stores = Store::all();
        $crops = Crop::all();
        return view( 'System.fertilizers.create', compact( 'crops', 'stores', 'lands' ) );
    }

    public function editFertilizer( $CropId, $FertilizerId ) {
        $crop = Crop::findOrFail( $CropId );
        $Fertilizer = $crop->FertilizerCrop()->findOrFail( $FertilizerId );

        return view( 'System.fertilizers.edit', compact( 'crop', 'Fertilizer' ) );
    }

    public function updateFertilizer( Request $request, $CropId, $FertilizerId ) {
        $crop = Crop::findOrFail( $CropId );
        $Fertilizer = $crop->FertilizerCrop()->findOrFail( $FertilizerId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );
        $request->validate( [
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'type_quantity' => 'required',
            'acquired_date' => 'required|date',
        ] );
        $Fertilizer->update( [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'type_quantity' => $request->type_quantity,
            'acquired_date' => $request->acquired_date,
        ] );

        return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'massage', 'تم تعديل سماد بنجاح' );
    }

    public function deleteFertilizer( Request $request, $CropId, $FertilizerId ) {
        $crop = Crop::findOrFail( $CropId );
        $Fertilizer = $crop->FertilizerCrop()->findOrFail( $FertilizerId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );

        $id_session = $request->id_session;
        $Fertilizer->delete();

        return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'delete', ' تم حذف سماد بنجاح' );

    }

    public function deleteAllFertilizer( $CropId ) {
        // حذف جميع الاسمدة المرتبطة بالزرع

        $Crop = Crop::findOrFail( $CropId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );
        $Crop->FertilizerCrop()->delete();
        return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'delete', ' تم حذف سماد بنجاح' );
    }

}
