<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CashBox;
use App\Model\Worker;
use App\Model\Land;
use App\Http\Resources\WorkerResourse;

class WorkerController extends Controller {

    public function index() {
        $workers = WorkerResourse::collection ( Worker::all() );
        $data = [
            'msg'=>'all empolyee in company',
            'status'=>1,
            'data'=>    $workers,
        ];
        return response()->json( $data );

    }



    
    public function show( $id ) {
        $workers = Worker::find( $id );
        if ( $workers ) {
            $expense = $workers->expenses;

            $data = [
                'msg'=>'this empolyee in company',
                'status'=>1,
                'data'=>new WorkerResourse( $workers ),
            ];
        } else {
            $data = [
                'msg'=>'this empolyee is not found  in company',
                'status'=>0,
                'data'=> NULL,
            ];
        }
        return response()->json( $data );

    }

    public function delet( $id ) {
        $workers = Worker::find( $id );
        if ( $workers ) {
            $expense = $workers->expenses;
            Land::where( 'supervisor_id', $workers->id )->update( [ 'supervisor_id' => 0 ] );
            $workers->expenses()->delete();
            $workers->delete();

            $data = [
                'msg'=>'this empolyee is deleted',
                'status'=>1,
                'data'=> NULL,
            ];
        } else {
            $data = [
                'msg'=>'this empolyee is not found  in company',
                'status'=>0,
                'data'=> NULL,
            ];
        }
        return response()->json( $data );

    }



    public function update( $request ) {
        $old_id = $request->old_id;
        $worker = Worker::find( $old_id );
        if ( $workers ) {

            $validatedData = validator( $request->all(), [
                'name' => 'required|string',
                'salary' => 'required|numeric',
                'job' => 'required',
            ], [
                'name.required'=>'مطلوووووووووووووووووووووب',
                'salary.required'=>'مطلوووووووووووووووووووووب',
                'job.required'=>'مطلوووووووووووووووووووووب',
                'name.string'=>'اسنخدم حروف فقط ',

            ] );
            if ( $validatedData->fails() ) {
                $data = [
                    'msg' => 'validation required',
                    'status' => 0,
                    'data' => $validatedData->errors()
                ];
                return response()->json( $data );
            }
            $worker->update( [
                'name' => $request->name,
                'salary' => $request->salary,
                'job' => $request->job,
            ] );
            $data = [
                'msg'=>'this empolyee is update',
                'status'=>1,
                'data'=>new WorkerResourse( $workers ),
            ];
        } else {
            $data = [
                'msg'=>'this empolyee is not found  in company',
                'status'=>0,
                'data'=> NULL,
            ];
        }
        return response()->json( $data );

    }

    public function store( $request ) {

        $validatedData = validator( $request->all(), [
            'name' => 'required|string',
            'salary' => 'required|numeric',
            'job' => 'required',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'salary.required'=>'مطلوووووووووووووووووووووب',
            'job.required'=>'مطلوووووووووووووووووووووب',
            'name.string'=>'اسنخدم حروف فقط ',

        ] );
        if ( $validatedData->fails() ) {
            $data = [
                'msg' => 'validation required',
                'status' => 0,
                'data' => $validatedData->errors()
            ];

            return response()->json( $data );
        }

        worker::create( [
            'name' => $request->name,
            'salary' => $request->salary,
            'job' => $request->job,
        ] );
        $data = [
            'msg'=>'this empolyee is update',
            'status'=>1,
            'data'=>new WorkerResourse( $workers ),
        ];
        return response()->json( $data );

    }





    public function addExpense( Request $request, $id ) {
        $worker = Worker::find( $id );
        if ( $worker ) {

            $validatedData = validator( $request->all(), [
                'amount' => 'required|numeric',
                'date' => 'required|date',
                'reason' => 'nullable|string',

            ], [
                'amount.required'=>'مطلوووووووووووووووووووووب',
                'date.required'=>'مطلوووووووووووووووووووووب',
                'reason.required'=>'مطلوووووووووووووووووووووب',
            ] );
            if ( $validatedData->fails() ) {
                $data = [
                    'msg' => 'validation required',
                    'status' => 0,
                    'data' => $validatedData->errors()
                ];

                return response()->json( $data );
            }
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

                $cashBox = CashBox::find( $Cash_id );
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
            $data = [
                'msg'=>'this empolyee is update',
                'status'=>1,
                'data'=>new WorkerResourse( $worker ),
            ];

        } else {
            $data = [
                'msg'=>'this empolyee is not found  in company',
                'status'=>0,
                'data'=> NULL,
            ];
        }
    }

    public function updateExpense( Request $request, $workerId, $expenseId ) {
        $worker = Worker::find( $workerId );

        if ( $worker ) {
            $expense = $worker->expenses()->find( $expenseId );
            if ( $expense ) {

                $validatedData = validator( $request->all(), [
                    'amount' => 'required|numeric',
                    'date' => 'required|date',
                    'reason' => 'nullable|string',

                ], [
                    'amount.required'=>'مطلوووووووووووووووووووووب',
                    'date.required'=>'مطلوووووووووووووووووووووب',
                    'reason.required'=>'مطلوووووووووووووووووووووب',
                ] );
                if ( $validatedData->fails() ) {
                    $data = [
                        'msg' => 'validation required',
                        'status' => 0,
                        'data' => $validatedData->errors()
                    ];

                    return response()->json( $data );
                }
                $expense->update( [
                    'amount' => $request->amount,
                    'date' => $request->date,
                    'reason' => $request->reason,
                ] );
                if ( $request->workercash == 'cash' && $expense->cash_id != null ) {

                    $Cash_id = $expense->cash_id;
                    $CashBox = CashBox::find( $Cash_id );
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
                    $cashBox = CashBox::find( $Cash_id );
                    $cashBox->status = $request->input( 'status' );
                    $expense->cash_id = $Cash_id;
                    $cashBox->save();
                    $expense->save();

                } elseif ( $request->workercash == 'nocash' && $expense->cash_id != null ) {

                    $Cash_id = $expense->cash_id;
                    $CashBox = CashBox::find( $Cash_id );
                    $expense->cash_id = null;
                    $CashBox->delete();
                }

                $data = [
                    'msg'=>'this expense is updated',
                    'status'=>1,
                    'data'=>new WorkerResourse( $worker ),
                ];
            }
        } else {
            $data = [
                'msg'=>'this Expense is not found ',
                'status'=>0,
                'data'=> NULL,
            ];
        }
        return response()->json( $data );

    }






    public function deleteExpense( $workerId, $expenseId ) {
        $worker = Worker::find( $workerId );

        if ( $worker ) {

            $expense = $worker->expenses()->find( $expenseId );
            if ( $expense ) {
                $expense->delete();

                $data = [
                    'msg'=>'this expense is deleted',
                    'status'=>1,
                    'data'=>new WorkerResourse( $worker ),
                ];
            }
        } else {
            $data = [
                'msg'=>'this Expense is not found ',
                'status'=>0,
                'data'=> NULL,
            ];
        }
        return response()->json( $data );

    }

    public function deleteAllExpenses( $workerId ) {
        $worker = Worker::find( $workerId );

        if ( $worker ) {
            // حذف جميع المصروفات المرتبطة بالعامل
            $worker->expenses()->delete();

            $data = [
                'msg'=>'all  expense is deleted',
                'status'=>1,
                'data'=>new WorkerResourse( $worker ),
            ];

        } else {
            $data = [
                'msg'=>'this empolyee is not found ',
                'status'=>0,
                'data'=> NULL,
            ];
        }
        return response()->json( $data );
    }

}
