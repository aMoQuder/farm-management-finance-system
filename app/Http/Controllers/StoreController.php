<?php

namespace App\Http\Controllers;

use App\Model\Store;
use App\Model\StoreDetails;
use Illuminate\Http\Request;
use App\Model\Land;
use App\Model\Crop;
use App\Model\Worker;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller {
    public function index() {
        $stores = Store::all();
        return view( 'System.stores.index', compact( 'stores' ) );
    }

    public function create() {
        return view( 'System.stores.create' );
    }

    public function store( Request $request ) {

        $validated = $request->validate( [
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'store_date' => 'required',
            'type_quantity' => 'required',
            'type_store' => 'required',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'quantity.required'=>'مطلوووووووووووووووووووووب',
            'store_date.required'=>'مطلوووووووووووووووووووووب',
        ] );
        Store::create( [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'store_date' => $request->store_date,
            'type_quantity' => $request->type_quantity,
            'type_store' => $request->type_store,

        ] );

        return redirect()->route( 'stores.index' );
    }

    public function show( $id ) {
        $store = Store::findOrFail( $id );
        return view( 'System.stores.show', compact( 'store' ) );
    }

    public function edit( $id ) {
        $store = Store::findOrFail( $id );
        return view( 'System.stores.edit', compact( 'store' ) );
    }

    public function updateQuantity( Request $request, $id ) {

        $store = Store::findOrFail( $id );
        $store->update( [ 'quantity' => $store->quantity - $request->quantity ] );
        return redirect()->route( 'stores.index' );
    }

    public function editQuantity( $id ) {

        $store = Store::findOrFail( $id );
        return view( 'System.stores.drow', compact( 'store' ) );
    }

    public function update( Request $request, $id ) {
        $validated = $request->validate( [
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'store_date' => 'required',
            'type_quantity' => 'required',
            'type_store' => 'required',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'quantity.required'=>'مطلوووووووووووووووووووووب',
            'store_date.required'=>'مطلوووووووووووووووووووووب',
        ] );
        $store = Store::findOrFail( $id );
        $store->update( [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'type_quantity' => $request->type_quantity,
            'type_store' => $request->type_store,
            'store_date' => $request->store_date,
        ] );
        return redirect()->route( 'stores.index' );
    }

    public function destroy( $id ) {
        $store = Store::findOrFail( $id );
        $store->delete();
        return redirect()->route( 'stores.index' );
    }
}
