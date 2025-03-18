<?php

namespace App\Http\Controllers;
use App\Model\ExpenCompany;
use App\Model\CashBox;

use Illuminate\Http\Request;

class ExpenCompanyController extends Controller {


    public function index() {
        $ExpenCompanys = ExpenCompany::all();
        return view( 'System.ExpenCompanys.index', compact( 'ExpenCompanys' ) );
    }

    public function create() {
        return view( 'System.ExpenCompanys.create' );
    }

    public function store( Request $request ) {
        $validated = $request->validate( [
            'receiver' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'reason' => 'required|string',
        ], [
            'receiver.required' => 'مطلوووووووووووووووووووووب',
            'amount.required' => 'مطلوووووووووووووووووووووب',
            'reason.required' => 'مطلوووووووووووووووووووووب',
            'date.required' => 'مطلوووووووووووووووووووووب',
            'reason.string' => 'استخدم حروف فقط',
        ] );

        // تعريف متغير cash_id بقيمة افتراضية
        $cash_id = null;

        // إذا كانت المصاريف مأخوذة من الخزنة
        if ( $request->workercash == 'cash' ) {
            $cashbox = CashBox::create( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $request->receiver,
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

        // إنشاء سجل في جدول المصاريف وربطه بالخزنة إذا وجدت
        ExpenCompany::create( [
            'receiver' => $request->receiver,
            'amount' => $request->amount, // تأكد أن هذا الحقل يخزن المبلغ وليس cash_id
            'date' => $request->date,
            'reason' => $request->reason,
            'cash_id' => $cash_id, // ربط المصروف بالخزنة
        ] );

        return redirect()->route( 'ExpenCompanys.index' )->with( 'message', 'تمت إضافة مصاريف الشركة بنجاح.' );
    }

    public function edit( $id ) {
        $ExpenCompany = ExpenCompany::findOrFail( $id );
        return view( 'System.ExpenCompanys.edit', compact( 'ExpenCompany' ) );
    }

    public function update( Request $request ) {
        $id = $request->old_id;
        $validated = $request->validate( [
            'receiver' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'reason' => 'required|string',
        ], [
            'receiver.required' => 'مطلوووووووووووووووووووووب',
            'amount.required' => 'مطلوووووووووووووووووووووب',
            'reason.required' => 'مطلوووووووووووووووووووووب',
            'reason.string' => 'استخدم حروف فقط',
        ] );
        $ExpenCompany = ExpenCompany::findOrFail( $id );
        $ExpenCompany->update( [
            'receiver' => $request->receiver,
            'amount' => $request->amount,
            'date' => $request->date,
            'reason' => $request->reason,
        ] );
        if ( $request->workercash == 'cash' && $ExpenCompany->cash_id != null ) {

            $Cash_id = $ExpenCompany->cash_id;
            $CashBox = CashBox::findOrFail( $Cash_id );
            $CashBox->update( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $request->receiver,
                'description' => $request->reason,
                'date' => $request->date,

            ] );

        } elseif ( $request->workercash == 'cash' && $ExpenCompany->cash_id == null ) {

            $CashBox = CashBox::create( [
                'amount' => $request->amount,
                'source' => 'الخزنة',
                'receiver' => $request->receiver,
                'description' => $request->reason,
                'date' => $request->date,
            ] );
            $Cash_id = $CashBox->id;

            $cashBox = CashBox::findOrFail( $Cash_id );
            $cashBox->status = $request->input( 'status' );
            $ExpenCompany->cash_id = $Cash_id;
            $cashBox->save();
            $ExpenCompany->save();

        } elseif ( $request->workercash == 'nocash' && $ExpenCompany->cash_id != null ) {

            $Cash_id = $ExpenCompany->cash_id;
            $CashBox = CashBox::findOrFail( $Cash_id );
            $ExpenCompany->cash_id = null;
            $CashBox->delete();
        }

        return redirect()->route( 'ExpenCompanys.index' )->with( 'massage', '  لفد تم تعديل بيانات هذه المصاريف وتم تعديل المطلوب' );
    }

    public function destroy( $id ) {
        $ExpenCompany = ExpenCompany::find( $id );
        $ExpenCompany->delete();
        return redirect()->route( 'ExpenCompanys.index' )->with( 'delete', ' تم الحذف بنجاح!' );
    }

}
