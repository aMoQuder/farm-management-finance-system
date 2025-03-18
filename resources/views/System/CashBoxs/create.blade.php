@extends('layouts.dashboard')

@section('content')

        <div class="card">
            <h5 class="card-title">إضافة مبلغ جديد إلى الخزنة</h5>

            <div class="card-body">

                <form action="{{ route('CashBoxs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="amount"> كمية المبلغ:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="amount" id="amount">
                        </div>
                        @error('amount')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="source">المصدر او المرسل:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="source" id="source">
                        </div>
                        @error('source')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="receiver">المستلم:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="receiver" id="receiver">
                        </div>
                        @error('receiver')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="description">وصف المبلغ:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>

                        @error('description')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="date">تاريخ التسجيل:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="date" id="date" required>
                        </div>
                        @error('date')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">إضافة</button>
                </form>
            </div>
        </div>
@endsection
