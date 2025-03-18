<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Workervisour;
use App\Model\CashBox;
use Illuminate\Http\Request;

class WorkerPaymentController extends Controller
{
    public function index($workervisourId)
    {
        $workervisour = Workervisour::find($workervisourId);
        $payments = $workervisour->payments;
        return response()->json(['payments' => $payments], 200);
    }

    public function store(Request $request, $workervisourId)
    {
        $workervisour = Workervisour::find($workervisourId);

        $validated = $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'receiver' => 'nullable|string',
            'description' => 'nullable|string',
            'workercash' => 'nullable|in:cash,nocash',
        ]);

        $cash_id = null;
        if ($request->workercash == 'cash') {
            $cashbox = CashBox::create([
                'amount' => $validated['amount'],
                'source' => 'الخزنة',
                'receiver' => $validated['receiver'] ?? null,
                'description' => $validated['description'] ?? null,
                'date' => $validated['date'],
            ]);
            $cash_id = $cashbox->id;
        }

        $payment = $workervisour->payments()->create([
            'amount' => $validated['amount'],
            'date' => $validated['date'],
            'receiver' => $validated['receiver'] ?? null,
            'cash_id' => $cash_id,
        ]);

        return response()->json([
            'message' => 'تم إضافة الدفعة بنجاح',
            'payment' => $payment
        ], 201);
    }

    public function show($workervisourId, $paymentId)
    {
        $workervisour = Workervisour::find($workervisourId);
        $payment = $workervisour->payments()->find($paymentId);

        return response()->json(['payment' => $payment], 200);
    }

    public function update(Request $request, $workervisourId, $paymentId)
    {
        $workervisour = Workervisour::find($workervisourId);
        $payment = $workervisour->payments()->find($paymentId);

        $validated = $request->validate([
            'amount' => 'sometimes|numeric',
            'date' => 'sometimes|date',
            'receiver' => 'sometimes|string',
            'description' => 'sometimes|string',
            'workercash' => 'sometimes|in:cash,nocash',
        ]);

        $payment->update($validated);

        if ($request->workercash == 'cash' && !$payment->cash_id) {
            $cashbox = CashBox::create([
                'amount' => $validated['amount'] ?? $payment->amount,
                'source' => 'الخزنة',
                'receiver' => $validated['receiver'] ?? $payment->receiver,
                'description' => $validated['description'] ?? null,
                'date' => $validated['date'] ?? $payment->date,
            ]);
            $payment->update(['cash_id' => $cashbox->id]);
        } elseif ($request->workercash == 'nocash' && $payment->cash_id) {
            CashBox::find($payment->cash_id)->delete();
            $payment->update(['cash_id' => null]);
        }

        return response()->json([
            'message' => 'تم تعديل الدفعة بنجاح',
            'payment' => $payment
        ], 200);
    }

    public function destroy($workervisourId, $paymentId)
    {
        $workervisour = Workervisour::find($workervisourId);
        $payment = $workervisour->payments()->find($paymentId);
        $payment->delete();

        return response()->json(['message' => 'تم حذف الدفعة بنجاح'], 200);
    }

    public function destroyAll($workervisourId)
    {
        $workervisour = Workervisour::find($workervisourId);
        $workervisour->payments()->delete();

        return response()->json(['message' => 'تم حذف جميع الدفعات بنجاح'], 200);
    }
}
