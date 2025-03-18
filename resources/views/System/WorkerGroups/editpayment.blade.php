@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">تعديل حساب المقاول</h5>

        <div class="card-body">

            <form action="{{ route('Workervisours.updatepayment', [$Workervisour->id, $payment->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="work">إضافة المبلغ من خلال:</label>
                    <div class="col-sm-10">
                        @if ($payment->cash_id != null)

                        <input type="radio" name="workercash" id="from_store" value="cash"> الخزنة
                        <input type="radio" name="workercash" id="not_from_store" checked value="nocash" class="mr-4"
                        > غير الخزنة
                        @else
                        <input type="radio" name="workercash" id="from_store" value="cash"> الخزنة
                        <input type="radio" name="workercash" id="not_from_store" value="nocash" class="mr-4"
                        checked> غير الخزنة
                        @endif

                    </div>
                </div>
                <input type="hidden" value="pull" name="status">
                <div id="storeForm" style="display: none;" class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="description">وصف المبلغ:</label>
                    <div class="col-sm-10">

                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>

                </div>
                @error('description')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror

                <div id="storeForm" style="display: none;" class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="description">وصف المبلغ:</label>
                    <div class="col-sm-10">

                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>

                </div>
                @error('description')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="amount" class="form-label">المبلغ</label>
                    <div class="col-sm-10">
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                            value="{{ $payment->amount }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date" class="form-label">التاريخ</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $payment->date }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="receiver" class="form-label">المستلم</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="receiver" name="receiver"
                            value="{{ $payment->receiver }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </form>
        </div>
    </div>
@endsection
