<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CashBox;

class CashBoxController extends Controller
{
    // عرض جميع العمليات النقدية
    public function index()
    {
        $CashBoxes = CashBox::all();
        $TotalDeposit = CashBox::where('status', 'Deposit')->sum('amount');
        $TotalPull = CashBox::where('status', 'pull')->sum('amount');
        $difference = $TotalDeposit - $TotalPull;

        return response()->json([
            'status' => true,
            'message' => 'جميع العمليات النقدية',
            'data' => [
                'CashBoxes' => $CashBoxes,
                'TotalDeposit' => $TotalDeposit,
                'TotalPull' => $TotalPull,
                'difference' => $difference
            ]
        ]);
    }

    // إضافة عملية نقدية جديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'source' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $CashBox = CashBox::create([
            'amount' => $request->amount,
            'source' => $request->source,
            'receiver' => $request->receiver ?? null,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تمت إضافة العملية النقدية بنجاح',
            'data' => $CashBox
        ], 201);
    }

    // عرض عملية نقدية معينة
    public function show($id)
    {
        $CashBox = CashBox::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'تفاصيل العملية النقدية',
            'data' => $CashBox
        ]);
    }

    // تحديث بيانات العملية النقدية
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'source' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $CashBox = CashBox::findOrFail($id);
        $CashBox->update([
            'amount' => $request->amount,
            'source' => $request->source,
            'receiver' => $request->receiver ?? null,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تحديث العملية النقدية بنجاح',
            'data' => $CashBox
        ]);
    }

    // تعديل المصدر النقدي
    public function updateSource(Request $request, $id)
    {
        $CashBox = CashBox::findOrFail($id);
        $CashBox->update([
            'source' => $CashBox->source - $request->source
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل المصدر النقدي بنجاح',
            'data' => $CashBox
        ]);
    }

    // حذف عملية نقدية معينة
    public function destroy($id)
    {
        $CashBox = CashBox::findOrFail($id);
        $CashBox->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم حذف العملية النقدية بنجاح'
        ]);
    }
}
