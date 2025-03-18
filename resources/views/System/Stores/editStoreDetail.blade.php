@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif
    <div class="card">
        <h5 class="card-title">تعديل تفاصايل المخزون</h5>
        <div class="card-body">
            <form id="storeForm" action="{{ route('fertilizer.storeFromStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="price" id="price_from_store" value="">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="quantity">الكمية:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="quantity" id="quantity_from_store" required>
                        <small id="quantity_error" class="text-danger" style="display: none;">الكمية المدخلة أكبر من
                            المتاحة.</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="getter_name">المستلم :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="getter_name" id="getter_name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date_received">تاريخ الحصول على السماد:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="acquired_date" id="acquired_date_from_store"
                            required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
    </div>
@endsection
