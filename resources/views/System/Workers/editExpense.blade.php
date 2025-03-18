@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">تعديل المصروف</h5>

        <div class="card-body">
            <form action="{{ route('workers.updateExpense', [$worker->id, $expense->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="type_store"> اضافة المصاريف من خلال </label>
                    <div class="col-sm-10">

                        <select name="workercash" class="form-control">
                            @if ($expense->cash_id !=null)
                                <option value="cash" selected>الخزنة</option>
                                <option value="nocash" >غير الخزنة</option>
                                @else
                                <option value="cash">الخزنة</option>
                                <option value="nocash" selected>غير الخزنة</option>
                            @endif
                        </select>
                    </div>
                </div>
                <input type="hidden" value="pull" name="status">


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="amount" class="form-label">المبلغ</label>
                    <div class="col-sm-10">
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                            value="{{ $expense->amount }}" required>
                            @error('amount')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date" class="form-label">التاريخ</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $expense->date }}" required>
                            @error('date')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="reason" class="form-label">السبب</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reason" name="reason"
                            value="{{ $expense->reason }}">
                            @error('reason')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </form>

        </div>
    </div>
@endsection
