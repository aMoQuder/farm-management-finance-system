<?php

namespace App\Http\Controllers;
use App\Model\Worker;

use App\Model\CashBox;
use App\Model\ExpenseDetail;
use Illuminate\Http\Request;

class ExpenseDetailsController extends Controller
{
    // // دالة لإضافة مصاريف للعامل

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
