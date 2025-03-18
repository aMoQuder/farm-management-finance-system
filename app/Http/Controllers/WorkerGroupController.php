<?php

namespace App\Http\Controllers;

use App\Model\Crop;
use App\Model\Land;
use App\Model\WorkerGroup;
use App\Model\Workervisour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkerGroupController extends Controller {
    public function index() {
        $crops = Crop::all();
        $WorkerGroupCrop = WorkerGroup::with( 'landWorking','supervisor' )->get();

        return view('System.WorkerGroups.index', compact(  'WorkerGroupCrop', 'crops' ) );
    }

    public function create() {

        $Workervisours = Workervisour::all();

        $crops = Crop::all();
        return view('System.WorkerGroups.create', compact( 'crops', 'Workervisours' ) );
    }

    public function addWorkerGroup( Request $request ) {
        $id = $request->crop_id;

        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $id )
        ->value( 'Landable_id' );
        $crop = Crop::findOrFail( $id );

        $request->validate( [
            'type_work' => 'required',
            'work' => 'required|string',
            'worker_count' => 'required|numeric',
            'daily_wage' => 'required|numeric',
            'work_date' => 'required|date',
        ] );
        if ( $request->has( 'name' ) ) {
            $Workervisours = Workervisour::all();
            $condition = true;
            foreach ( $Workervisours as $item ) {
                if ( $item->name == $request->name ) {
                    $condition = false;
                    $supervisor_id = $item->id;
                    break;
                }
            }
            if ( $condition ) {
                $request->validate( [
                    'name' => 'required|string',
                ] );
                $supervisor =    Workervisour::create( [
                    'name' => $request->name,
                ] );

                $supervisor_id = $supervisor->id;
            }

        } else {
            $supervisor_id = $request->supervisor_id;
        }

        $crop->WorkerGroupCrop()->create( [
            'supervisor_id' => $supervisor_id,
            'type_work' => $request->type_work,
            'work' => $request->work,
            'worker_count' => $request->worker_count,
            'daily_wage' => $request->daily_wage,
            'work_date' => $request->work_date,
            'Land_id' => $land_id,
        ] );

        return redirect()->route( 'lands.showCrop', [ $land_id, $id ] )->with( 'massage', 'تم إضافة شغل عمال بنجاح' );
    }

    public function editWorkerGroup( Request $request, $CropId, $WorkerGroupId ) {
        $crop = Crop::findOrFail( $CropId );
        $WorkerGroup = $crop->WorkerGroupCrop()->findOrFail( $WorkerGroupId );
        $Workervisours = Workervisour::all();
        $session = true;
        $updatesission = true;

        if ( request()->isMethod( 'post' ) ) {
            $session = false;
            if(($request->has( 'sessionBage' ))) {
                $updatesission = false;
                return view('System.WorkerGroups.edit', compact( 'crop', 'WorkerGroup', 'Workervisours', 'session','updatesission' ) );
            }
            return view('System.WorkerGroups.edit', compact( 'crop', 'WorkerGroup', 'Workervisours', 'session' ,'updatesission') );
        }else{
            return view('System.WorkerGroups.edit', compact( 'crop', 'WorkerGroup', 'Workervisours', 'session','updatesission' ) );
        }
    }

    public function updateWorkerGroup( Request $request, $CropId, $WorkerGroupId ) {
        $crop = Crop::findOrFail( $CropId );
        $WorkerGroup = $crop->WorkerGroupCrop()->findOrFail( $WorkerGroupId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );
        $request->validate( [
            'type_work' => 'required',
            'work' => 'required|string',
            'worker_count' => 'required|numeric',
            'daily_wage' => 'required|numeric',
            'work_date' => 'required|date',
        ] );

        if ( $request->has( 'name' ) ) {
            $Workervisours = Workervisour::all();
            $condition = true;
            foreach ( $Workervisours as $item ) {
                if ( $item->name == $request->name ) {
                    $condition = false;
                    $supervisor_id = $item->id;
                    break;
                }
            }
            if ( $condition ) {
                $request->validate( [
                    'name' => 'required|string',
                ] );
                $supervisor =    Workervisour::create( [
                    'name' => $request->name,
                ] );
                $supervisor_id = $supervisor->id;
            }

        } else {
            $supervisor_id = $request->supervisor_id;
        }
        $WorkerGroup->update( [
            'supervisor_id' => $supervisor_id,
            'type_work' => $request->type_work,
            'work' => $request->work,
            'worker_count' => $request->worker_count,
            'daily_wage' => $request->daily_wage,
            'work_date' => $request->work_date,
        ] );
        if ( $request->bage == 'subervisorBage' ) {
            return redirect()->route( 'displaysupervisor', $supervisor_id )->with( 'massage', 'تم تعديل شغل هذا المقاول بنجاح' );
        } elseif ( $request->bage == 'bageallworkergroup' ) {
            return redirect()->route( 'WorkerGroups.index' )->with( 'massage', 'تم تعديل شغل هذا المقاول بنجاح' );
        }else {
            return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'massage', 'تم تعديل شغل عمال بنجاح' );
        }
    }

    public function deleteWorkerGroup( Request $request, $CropId, $WorkerGroupId ) {
        $crop = Crop::findOrFail( $CropId );
        $WorkerGroup = $crop->WorkerGroupCrop()->findOrFail( $WorkerGroupId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );

        $id_session = $request->id_session;
        $WorkerGroup->delete();

        return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'delete', ' تم حذف شغل عمال بنجاح' );

    }

    public function deleteAllWorkerGroup( $CropId ) {
        // حذف جميع الاسمدة المرتبطة بالزرع

        $Crop = Crop::findOrFail( $CropId );
        $land_id = DB::table( 'crops' ) // اسم الجدول
        ->where( 'id', $CropId )
        ->value( 'Landable_id' );
        $Crop->WorkerGroupCrop()->delete();
        return redirect()->route( 'lands.showCrop', [ $land_id, $CropId ] )->with( 'delete', ' تم حذف كل  شغل العمال لهذا الزرع بنجاح' );
    }

    public function displaysupervisor( $id ) {
        $crops = Crop::all();
        $Workervisour = Workervisour::FindOrFail( $id );
        $WorkerGroupCrop = DB::table( 'worker_groups' ) // اسم الجدول
        ->where( 'supervisor_id', $id )
        ->get();
        return view('System.WorkerGroups.subervisor', compact( 'WorkerGroupCrop', 'Workervisour', 'crops' ) );
    }

}
