<?php

namespace App\Http\Controllers;
use App\Model\Worker;
use App\Model\Land;
use App\Model\CashBox;
use App\Model\ExpenseDetail;
use Illuminate\Http\Request;

class WorkerController extends Controller {
    public function index() {
        $workers = Worker::all();
        return view( 'System.workers.index', compact( 'workers' ) );
    }

    public function show( $id ) {
        $worker = Worker::findOrFail( $id );
        // $allexpen=$worker->expenses::where('expensable_id',$id)->sum('amount');
        $diffsalary=$worker->salary ;
        return view( 'System.workers.show', compact( 'worker','diffsalary' ) );
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


    // دالة لإضافة مصاريف للعامل

    public function addExpense( Request $request, $id ) {
        $worker = Worker::findOrFail( $id );

        $request->validate( [
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'reason' => 'nullable|string',

        ], [
            'amount.required'=>'مطلوووووووووووووووووووووب',
            'date.required'=>'مطلوووووووووووووووووووووب',
            'reason.required'=>'مطلوووووووووووووووووووووب',
        ] );
        // تعريف متغير cash_id بقيمة افتراضية
        $cash_id = null;

        // إذا كانت المصاريف مأخوذة من الخزنة
        if ( $request->workercash == 'cash' ) {
            $cashbox = CashBox::create( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $worker->name,
                'description' => $request->reason,
                'date' => $request->date,
            ] );
            $Cash_id = $cashbox->id;

            $cashBox = CashBox::findOrFail( $Cash_id );
            $cashBox->status = $request->input( 'status' );
            $cashBox->save();
            if ( $cashbox ) {
                // حفظ الـ cash_id بعد إدخال البيانات في الخزنة
                $cash_id = $Cash_id;
            }
        }
        $worker->expenses()->create( [
            'amount' => $request->amount,
            'date' => $request->date,
            'reason' => $request->reason,
            'cash_id' => $cash_id,
        ] );

        return redirect()->route( 'workers.show', $id )->with( 'massage', 'تم إضافة المصاريف بنجاح' );
    }

    public function updateExpense( Request $request, $workerId, $expenseId ) {
        $worker = Worker::findOrFail( $workerId );
        $expense = $worker->expenses()->findOrFail( $expenseId );

        $request->validate( [
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'reason' => 'nullable|string',

        ], [
            'amount.required'=>'مطلوووووووووووووووووووووب',
            'date.required'=>'مطلوووووووووووووووووووووب',
            'reason.required'=>'مطلوووووووووووووووووووووب',
        ] );
        $expense->update( [
            'amount' => $request->amount,
            'date' => $request->date,
            'reason' => $request->reason,
        ] );
        if ( $request->workercash == 'cash' && $expense->cash_id != null ) {

            $Cash_id = $expense->cash_id;
            $CashBox = CashBox::findOrFail( $Cash_id );
            $CashBox->update( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $worker->name,
                'description' => $request->reason,
                'date' => $request->date,

            ] );

        } elseif ( $request->workercash == 'cash' && $expense->cash_id == null ) {

            $CashBox = CashBox::create( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $worker->name,
                'description' => $request->reason,
                'date' => $request->date,
            ] );
            $Cash_id = $CashBox->id;
            $cashBox = CashBox::findOrFail( $Cash_id );
            $cashBox->status = $request->input( 'status' );
            $expense->cash_id = $Cash_id;
            $cashBox->save();
            $expense->save();

        } elseif ( $request->workercash == 'nocash' && $expense->cash_id != null ) {

            $Cash_id = $expense->cash_id;
            $CashBox = CashBox::findOrFail( $Cash_id );
            $expense->cash_id = null;
            $CashBox->delete();
        }

        return redirect()->route( 'workers.show', $workerId )->with( 'massage', 'تم تعديل المصروف بنجاح' );
    }

    public function deleteExpense( $workerId, $expenseId ) {
        $worker = Worker::findOrFail( $workerId );
        $expense = $worker->expenses()->findOrFail( $expenseId );
        $expense->delete();

        return redirect()->route( 'workers.show', $workerId )->with( 'delete', 'تم حذف المصروف بنجاح' );
    }

    public function deleteAllExpenses( $workerId ) {
        $worker = Worker::findOrFail( $workerId );

        // حذف جميع المصروفات المرتبطة بالعامل
        $worker->expenses()->delete();

        return redirect()->route( 'workers.show', $workerId )->with( 'delete', 'تم حذف جميع المصروفات بنجاح' );
    }

    public function editExpense( $workerId, $expenseId ) {
        $worker = Worker::findOrFail( $workerId );
        $expense = $worker->expenses()->findOrFail( $expenseId );

        return view( 'System.workers.editExpense', compact( 'worker', 'expense' ) );
    }

}
