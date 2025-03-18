<?php

namespace App\Http\Controllers;
use App\Model\Workervisour;
use Illuminate\Http\Request;

class WorkerSubervisorController extends Controller {
    public function index() {
        $Workervisours = Workervisour::all();
        return view( 'System.Workervisours.index', compact( 'Workervisours' ) );
    }

    public function create() {
        return view( 'System.Workervisours.create' );
    }

    public function store( Request $request ) {
        $validated = $request->validate( [
            'name' => 'required|string',
        ] );
        Workervisour::create( [
            'name' => $request->name,
        ] );
        return redirect()->route( 'Workervisours.index' )->with( 'massage', 'لفد تم اضافة عامل الى نيولاند' );
    }

    public function edit( $id ) {
        $Workervisour = Workervisour::findOrFail( $id );
        return view( 'System.Workervisours.edit', compact( 'Workervisour' ) );
    }

    public function update( Request $request ) {
        $id = $request->old_id;
        $validated = $request->validate( [
            'name' => 'required|string',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
        ] );
        $Workervisour = Workervisour::findOrFail( $id );
        $Workervisour->update( [
            'name' => $request->name,
        ] );
        return redirect()->route( 'Workervisours.index' )->with( 'massage', 'لفد تم تعديل بيانات هذا العامل' );
    }

    public function delete( $id ) {
        // الحصول على العامل
        $Workervisour = Workervisour::find( $id );
        $Workervisour->delete();
        // إعادة التوجيه إلى الصفحة المناسبة ( مثلاً: صفحة عرض جميع العمال )
        return redirect()->route( 'Workervisours.index' )->with( 'success', 'العامل تم حذفه بنجاح!' );
    }

}
