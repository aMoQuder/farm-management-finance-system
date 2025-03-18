<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Workervisour;
use App\Model\CashBox;

class WorkerPaymentController extends Controller {
    public function addpayment( Request $request, $id ) {
        $Workervisour = Workervisour::findOrFail( $id );

        $request->validate( [
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'receiver' => 'nullable|string',
        ] );
        // تعريف متغير cash_id بقيمة افتراضية
        $cash_id = null;

        // إذا كانت المصاريف مأخوذة من الخزنة
        if ( $request->workercash == 'cash' ) {
            $cashbox = CashBox::create( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $request->receiver,
                'description' => $request->description,
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
        $Workervisour->payments()->create( [
            'amount' => $request->amount,
            'date' => $request->date,
            'receiver' => $request->receiver,
            'cash_id' => $cash_id,
        ] );

        return redirect()-> route( 'displaysupervisor', $id )->with( 'massage', 'تم إضافة على حساب هذا المقاول بنجاح' );
    }

    public function updatepayment( Request $request, $WorkervisourId, $paymentId ) {
        $Workervisour = Workervisour::findOrFail( $WorkervisourId );
        $payment = $Workervisour->payments()->findOrFail( $paymentId );

        $request->validate( [
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'receiver' => 'nullable|string',
        ] );

        $payment->update( [
            'amount' => $request->amount,
            'date' => $request->date,
            'receiver' => $request->receiver,
        ] );
        if ( $request->workercash == 'cash' && $payment->cash_id != null ) {

            $Cash_id = $payment->cash_id;
            $CashBox = CashBox::findOrFail( $Cash_id );
            $CashBox->update( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $request->receiver,
                'description' => $request->description,
                'date' => $request->date,

            ] );

        } elseif ( $request->workercash == 'cash' && $payment->cash_id == null ) {

            $CashBox = CashBox::create( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $request->receiver,
                'description' => $request->description,
                'date' => $request->date,
            ] );
            $Cash_id = $CashBox->id;

            $cashBox = CashBox::findOrFail( $Cash_id );
            $cashBox->status = $request->input( 'status' );
            $payment->cash_id = $Cash_id;
            $cashBox->save();
            $payment->save();

        } elseif ( $request->workercash == 'nocash' && $payment->cash_id != null ) {

            $Cash_id = $payment->cash_id;
            $CashBox = CashBox::findOrFail( $Cash_id );
            $payment->cash_id = null;
            $CashBox->delete();
        }

        return redirect()->route( 'displaysupervisor', $WorkervisourId )->with( 'massage', 'تم تعديل حساب المقاول بنجاح' );
    }

    public function deletepayment( $WorkervisourId, $paymentId ) {
        $Workervisour = Workervisour::findOrFail( $WorkervisourId );
        $payment = $Workervisour->payments()->findOrFail( $paymentId );
        $payment->delete();

        return redirect()->route( 'displaysupervisor', $WorkervisourId )->with( 'delete', 'تم حذف حساب المقاول بنجاح' );
    }

    public function deleteAllpayments( $WorkervisourId ) {
        $Workervisour = Workervisour::findOrFail( $WorkervisourId );

        // حذف جميع حساب المقاولات المرتبطة المقاول
        $Workervisour->payments()->delete();

        return redirect()->route( 'displaysupervisor', $WorkervisourId )->with( 'delete', 'تم حذف جميع حساب المقاولات بنجاح' );
    }

    public function editpayment( $WorkervisourId, $paymentId ) {
        $Workervisour = Workervisour::findOrFail( $WorkervisourId );
        $payment = $Workervisour->payments()->findOrFail( $paymentId );

        return view( 'System.WorkerGroups.editpayment', compact( 'Workervisour', 'payment' ) );
    }

}
