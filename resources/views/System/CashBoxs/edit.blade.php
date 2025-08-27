@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">تعديل تفاصايل المبلغ</h5>

        <div class="card-body">

            <form action="{{ route('CashBoxs.update', $CashBox->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="amount"> كمية المبلغ:</label>
                    <div class="col-sm-10">
                        <input type="number" value="{{ $CashBox->amount }}" class="form-control" name="amount" id="amount">
                    </div>

                    @error('amount')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>



                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="source">المصدر او المرسل:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $CashBox->source }}" name="source" id="source">
                    </div>

                    @error('source')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>


                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="receiver">المستلم:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $CashBox->receiver }}" name="receiver" id="receiver">
                    </div>

                    @error('receiver')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>


                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="description">وصف المبلغ:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" placeholder="{{ $CashBox->description }}" id="description">{{ $CashBox->description }}</textarea>
                    </div>


                    @error('description')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>

                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date">تاريخ التسجيل:</label>
                    <div class="col-sm-10">
                        <input type="date" value="{{ $CashBox->date }}" class="form-control" name="date" id="date"
                            required>
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
