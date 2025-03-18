@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">سحب مصاريف </h5>

        <div class="card-body">

            <form action="{{ route('ExpenCompanys.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="type_store"> اضافة المصاريف من خلال </label>
                    <div class="col-sm-10">

                        <select name="workercash" class="form-control">
                            <option value="cash">الخزنة</option>
                            <option value="nocash" selected>غير الخزنة</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" value="pull" name="status">

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="amount"> المبلغ:</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" name="amount" id="amount">
                    </div>
                </div>
                @error('amount')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="receiver">المستلم :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="receiver" id="receiver">

                    </div>
                </div>
                @error('receiver')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="reason">غرض المبلغ :</label>
                    <div class="col-sm-10">
                        <textarea name="reason" class="form-control" id="reason"></textarea>
                    </div>
                </div>
                @error('reason')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date"> التاريخ:</label>
                    <div class="col-sm-10">

                        <input type="date" class="form-control" name="date" id="date">
                    </div>
                </div>
                @error('date')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror


                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
    </div>
@endsection
