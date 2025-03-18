<?php

namespace App\Http\Controllers;
use App\Model\MachineJob;
use App\Model\Crop;
use App\Model\Land;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Worker;

class MachineJobController extends Controller {
    public function index() {
        $MachineJobCrop = MachineJob::with( 'landMachine','driver' )->get();
        $crops = Crop::all();
        return view('System.MachineJobs.index', compact( 'MachineJobCrop', 'crops' ) );
    }


    public function create() {
        $crops = Crop::all();
        $workers = Worker::all();
        return view('System.MachineJobs.create', compact( 'crops','workers') );
    }

    public function addMachineJob( Request $request ) {
        $id = $request->crop_id;

        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $id )
        ->value( 'Landable_id' );
        $crop = Crop::findOrFail( $id );

        $request->validate( [
            'machine_name' => 'required|string',
            'Work_name' => 'required|string',
            'Count_hour' => 'required',
            'driver_id' => 'required',
            'Work_day' => 'required',
        ] );

        $crop->MachineJobCrop()->create( [
            'machine_name' => $request->machine_name,
            'Count_hour' => $request->Count_hour,
            'Work_name' => $request->Work_name,
            'driver_id' => $request->driver_id,
            'Work_day' => $request->Work_day,
            'Land_id' => $land_id,
        ] );

        return redirect()->route( 'lands.showCrop', [ $land_id, $id ] )->with( 'massage', 'تم إضافة هذا الجرار بنجاح' );
    }



    public function editMachineJob( $CropId, $MachineJobId ) {
        $workers=Worker::all();
        $crop = Crop::findOrFail( $CropId );
        $MachineJob = $crop->MachineJobCrop()->findOrFail( $MachineJobId );

        return view('System.MachineJobs.edit', compact( 'crop', 'MachineJob','workers' ) );
    }

    public function updateMachineJob( Request $request, $CropId, $MachineJobId ) {
        $crop = Crop::findOrFail( $CropId );
        $MachineJob = $crop->MachineJobCrop()->findOrFail( $MachineJobId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );
        $request->validate( [
            'machine_name' => 'required|string',
            'Work_name' => 'required|string',
            'driver_id' => 'required',
            'Count_hour' => 'required',
            'Work_day' => 'required',
        ] );
        $MachineJob->update( [
            'machine_name' => $request->machine_name,
            'Count_hour' => $request->Count_hour,
            'Work_name' => $request->Work_name,
            'driver_id' => $request->driver_id,
            'Work_day' => $request->Work_day,
        ] );

        return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'massage', 'تم تعديل هذا الجرار بنجاح' );
    }



    public function deleteMachineJob( Request $request, $CropId, $MachineJobId ) {
        $crop = Crop::findOrFail( $CropId );
        $MachineJob = $crop->MachineJobCrop()->findOrFail( $MachineJobId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );

        $id_session = $request->id_session;
        $MachineJob->delete();


        return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'delete', ' تم حذف شغل هذا الجرار بنجاح' );

    }

    public function deleteAllMachineJob( $CropId ) {
                // حذف جميع الاسمدة المرتبطة بالزرع

        $Crop = Crop::findOrFail( $CropId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );
        $Crop->MachineJobCrop()->delete();
        return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'delete', ' تم حذف كل شغل الجرارات لهذه الارض بنجاح' );
    }

}
