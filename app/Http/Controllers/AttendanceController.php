<?php

namespace App\Http\Controllers;

use App\Model\Worker;
use App\Model\Absent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttendanceController extends Controller {
    public function storeAttendance( Request $request ) {
        $today = $request->today;

        $absents = [];

        foreach ( $request->all() as $key => $value ) {
            if ( Str::startsWith( $key, 'status' ) ) {
                $workerId = Str::after( $key, 'status' );
                $status = $value;

                $worker = Worker::find( $workerId );
                if ( !$worker ) continue;

                if ( $status === 'حضور' ) {
                    $worker->increment( 'days_worked' );
                } elseif ( $status === 'غياب' ) {



                        Absent::create( [
                            'worker_id' => $worker->id,
                            'date' => $today,
                        ] );


                }
                // 'اجازة' => لا شيء
            }
        }

        return redirect()->back()->with('success', 'تم تسجيل الحضور بنجاح');


    }

    public function getAttendanceData() {
        $absents = Absent::with( 'worker' )->get();

        $grouped = [];

        foreach ( $absents as $absent ) {
            $date = $absent->date;
            $name = $absent->worker->name;

            if ( !isset( $grouped[ $date ] ) ) {
                $grouped[ $date ] = [];
            }

            $grouped[ $date ][] = $name;
        }

        return response()->json( $grouped );
    }

}
