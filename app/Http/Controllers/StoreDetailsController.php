<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Land;
use App\Model\Crop;
use App\Model\Store;
use Illuminate\Support\Facades\DB;

class StoreDetailsController extends Controller
{
    public function addStoreDetail(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        // التحقق من صحة البيانات
        $request->validate([
            'getter_name' => 'required|string',
            'acquired_date' => 'required|date',
            'quantity' => 'required|numeric',
            'land_id' => 'required|exists:lands,id',
            'crop_id' => 'required|exists:crops,id',
        ]);

        // تخزين البيانات في جدول StoreDetails
        $store->StoreDetails()->create([
            'getter_name' => $request->getter_name,
            'get_date' => $request->acquired_date, // اسم الحقل في الفورم
            'quantity' => $request->quantity,
            'land_id' => $request->land_id,
            'crop_id' => $request->crop_id,
        ]);
    }

    public function updateStoreDetail( Request $request, $storeId, $StoreDetailId ) {
        $store = Store::findOrFail( $storeId );
        $StoreDetail = $store->StoreDetails()->findOrFail( $StoreDetailId );

         $request->validate( [
            'getter_name' => 'required|string',
            'get_date' => 'required|date',
            'quantity' => 'required',
            'land_id' => 'required|exists:lands,id',
            'crop_id' => 'required|exists:crops,id',
        ] );


        $StoreDetail->update( [
           'getter_name' => $request->getter_name,
            'get_date' => $request->get_date,
            'quantity' => $request->quantity,
            'land_id' => $request->land_id,
            'crop_id' => $request->crop_id,
        ] );

        return redirect()->route( 'stores.show', $storeId )->with( 'massage', 'تم تعديل السماد بنجاح' );
    }

    public function deleteStoreDetail( $storeId, $StoreDetailId ) {
        $store = Store::findOrFail( $storeId );
        $StoreDetail = $store->StoreDetails()->findOrFail( $StoreDetailId );
        $StoreDetail->delete();

        return redirect()->route( 'stores.show', $storeId )->with( 'delete', 'تم حذف السماد بنجاح' );
    }

    public function deleteAllStoreDetails( $storeId ) {
        $store = Store::findOrFail( $storeId );
        // حذف جميع السمادات المرتبطة بالعامل
        $store->StoreDetails()->delete();
        return redirect()->route( 'stores.show', $storeId )->with( 'delete', 'تم حذف جميع السمادات بنجاح' );
    }

    public function editStoreDetail( $storeId, $StoreDetailId ) {
        $store = Store::findOrFail( $storeId );
        $StoreDetail = $store->StoreDetails()->findOrFail( $StoreDetailId );

        return view('System.stores.editStoreDetail', compact( 'store', 'StoreDetail' ) );
    }

}
