<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CashBox;

class CashBoxController extends Controller
{

    public function index()
    {
        $CashBoxs = CashBox::where('status','Deposit')->get();
        $pullCash = CashBox::where('status','pull')->get();
        $TotalPull = CashBox::where('status','pull')->sum('amount');

        $TotalDeposit = CashBox::where('status','Deposit')->sum('amount');
        $diffrance=$TotalDeposit-$TotalPull;
        return view('System.CashBoxs.index', compact('CashBoxs','pullCash','TotalPull','TotalDeposit','diffrance'));
    }

    public function create()
    {
        return view('System.CashBoxs.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate( [
            'amount' => 'required',
            'source' => 'required',
            'description' => 'required',
            'date' => 'required',
        ], [
            'amount.required'=>'مطلوووووووووووووووووووووب',
            'source.required'=>'مطلوووووووووووووووووووووب',
            'description.required'=>'مطلوووووووووووووووووووووب',
            'date.required'=>'مطلوووووووووووووووووووووب',
        ] );
        CashBox::create( [
            'amount' => $request->amount,
            'source' => $request->source,
            'receiver' => $request->receiver,
            'description' => $request->description,
            'date' => $request->date,
        ] );

        return redirect()->route('CashBoxs.index');
    }


    public function edit($id)
    {
        $CashBox = CashBox::findOrFail($id);
        return view('System.CashBoxs.edit', compact('CashBox'));
    }

    public function updatesource(Request $request, $id)
    {

        $CashBox = CashBox::findOrFail($id);
        $CashBox->update( [ 'source' => $CashBox->source - $request->source ] );
        return redirect()->route('CashBoxs.index');
    }
    public function editsource( $id)
    {

        $CashBox = CashBox::findOrFail($id);
        return view('System.CashBoxs.drow', compact('CashBox'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate( [
            'amount' => 'required',
            'source' => 'required',
            'description' => 'required',
            'date' => 'required',
        ], [
            'amount.required'=>'مطلوووووووووووووووووووووب',
            'source.required'=>'مطلوووووووووووووووووووووب',
            'description.required'=>'مطلوووووووووووووووووووووب',
            'date.required'=>'مطلوووووووووووووووووووووب',
        ] );
        $CashBox = CashBox::findOrFail($id);
        $CashBox->update([
            'amount' => $request->amount,
            'source' => $request->source,
            'receiver' => $request->receiver,
            'description' => $request->description,
            'date' => $request->date,

        ]);

        return redirect()->route('CashBoxs.index');
    }

    public function destroy($id)
    {
        $CashBox = CashBox::findOrFail($id);
        
        $CashBox->delete();

        return redirect()->route('CashBoxs.index');
    }
}
