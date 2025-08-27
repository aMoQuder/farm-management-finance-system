<?php

namespace App\Http\Controllers;
use App\Model\Worker;
use App\Model\Land;
use App\Model\CashBox;
use App\Model\ExpenseDetail;
use Illuminate\Http\Request;
use App\Model\Absent;

class WorkerController extends Controller {
    public function index() {
        $workers = Worker::all();
        return view( 'System.workers.index', compact( 'workers' ) );
    }

    public function show( $id ) {
        $worker = Worker::findOrFail( $id );
        $allexpen = $worker->expenses->where( 'expensable_id', $id )->sum( 'amount' );
        $days_absent = 2;

        $diffsalary = $worker->salary - $allexpen - ( $days_absent * 100 )  ;
        return view( 'System.workers.show', compact( 'worker', 'diffsalary', 'days_absent' ) );
    }

    public function attendes() {
        $absents=Absent::all();
        return view( 'System.workers.attends' ,compact('absents'))->with('attends','you are in bage attends ');
    }

    public function create() {
        return view( 'System.workers.create' );
    }

    public function store( Request $request ) {
        $validated = $request->validate( [
            'name' => 'required|string',
            'salary' => 'required|numeric',
            'job' => 'required',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'salary.required'=>'مطلوووووووووووووووووووووب',
            'job.required'=>'مطلوووووووووووووووووووووب',
            'name.string'=>'اسنخدم حروف فقط ',
        ] );
        Worker::create( [
            'name' => $request->name,
            'salary' => $request->salary,
            'job' => $request->job,
        ] );
        return redirect()->route( 'workers.index' )->with( 'massage', 'لفد تم اضافة عامل الى نيولاند' );
    }

    public function edit( $id ) {
        $worker = Worker::findOrFail( $id );
        return view( 'System.workers.edit', compact( 'worker' ) );
    }

    public function update( Request $request ) {
        $id = $request->old_id;
        $validated = $request->validate( [
            'name' => 'required|string',
            'salary' => 'required|numeric',
            'job' => 'required',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'salary.required'=>'مطلوووووووووووووووووووووب',
            'job.required'=>'مطلوووووووووووووووووووووب',
            'name.string'=>'اسنخدم حروف فقط ',

        ] );
        $worker = Worker::findOrFail( $id );
        $worker->update( [
            'name' => $request->name,
            'salary' => $request->salary,
            'job' => $request->job,
        ] );
        return redirect()->route( 'workers.index' )->with( 'massage', 'لفد تم تعديل بيانات هذا العامل' );
    }

    public function delete( $id ) {
        // الحصول على العامل
        $worker = Worker::find( $id );
        // تحديث جميع الأراضي التي يشرف عليها العامل إلى supervisor_id = 0
        Land::where( 'supervisor_id', $worker->id )->update( [ 'supervisor_id' => 0 ] );
        // حذف العامل
        $worker->expenses()->delete();
        $worker->delete();
        // إعادة التوجيه إلى الصفحة المناسبة ( مثلاً: صفحة عرض جميع العمال )
        return redirect()->route( 'workers.index' )->with( 'success', 'العامل تم حذفه بنجاح!' );
    }

    // دالة لتسجيل غياب للعامل

    public function attendesGetting( Request $request ) {

        $workers = Worker::all();
        foreach ( $workers as $workerAttend ) {
            $status = "status{$workerAttend->id}";
            $id = $workerAttend->id;
            $worker = Worker::findOrFail( $id );

            if ( $request->has( ( $status ) ) == 'غياب' ) {
                $worker->days_worked --;

            } elseif ( $request->has( ( $status ) ) == 'اجازة' ) {

            } elseif ( $request->has( ( $status ) ) == 'حضور' ) {
                $worker->days_worked = 10;
                $worker->save();
                echo "{$worker->days_worked}";
            }

            // return redirect()->route( 'home' )->with( 'massage', 'تم إضافة المصاريف بنجاح' );

        }

    }

}
