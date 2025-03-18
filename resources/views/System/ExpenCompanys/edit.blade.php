@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">تعديل المصاريف</h5>

        <div class="card-body">

            <form action="{{ route('ExpenCompanys.update') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="old_id" value="{{ $ExpenCompany->id }}">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="type_store"> اضافة المصاريف من خلال </label>
                    <div class="col-sm-10">

                        <select name="workercash" class="form-control">
                            @if ($ExpenCompany->cash_id !=null)
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
                    <label class="col-sm-2 col-form-label" for="receiver">المستلم :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $ExpenCompany->receiver }}" name="receiver" id="receiver">
                    </div>
                    @error('receiver')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="reason">السبب :</label>
                    <div class="col-sm-10">
                        <textarea name="reason" class="form-control" id="reason">{{ $ExpenCompany->reason }}</textarea>
                    </div>

                    @error('reason')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="amount">الراتب الشهري:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" value="{{ $ExpenCompany->amount }}" name="amount" id="amount">
                    </div>
                    @error('amount')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date"> التاريخ:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" value="{{ $ExpenCompany->date }}" name="date" id="date">
                    </div>
                    @error('date')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">تعديل</button>
            </form>
        </div>
    </div>
@endsection
