@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">تعديل المخزن</h5>

        <div class="card-body">


            <form action="{{ route('stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">

                    <label class="col-sm-2 col-form-label" for="type_store">تصنيف المخزون:</label>
                    <div class="col-sm-10">
                        <select name="type_store" class="form-control">
                            <option value="سماد">سماد</option>
                            <option value="ماسورة">ماسورة</option>
                            <option value="كابل">كابل</option>
                            <option value="خردة">خردة</option>
                            <option value="حديد">حديد</option>
                            <option value="مواتير">مواتير</option>
                            <option value="عدة">عدة</option>
                            <option value="شكاير">شكاير</option>
                            <option value="الات">الات</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">اسم المخزون:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" value="{{ $store->name }}" required>
                    </div>
                </div>
                <div class="row mb-3">

                    <label class="col-sm-2 col-form-label" for="type_quantity"> نوع الكمية:</label>
                    <div class="col-sm-10">

                        <select name="type_quantity" class="form-control">
                            <option value="طن">طن</option>
                            <option value="كيلو">كيلو</option>
                            <option value="لتر">لتر</option>
                            <option value="شكارة">شكارة</option>
                            <option value="متر">متر</option>
                            <option value="كرتونة">كرتونة</option>
                            <option value="نفس المخزون">نفس المخزون</option>
                        </select>
                        @error('type_quantity')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="quantity">الكمية:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $store->quantity }}"
                            required>
                    </div>
                </div>



                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date">تاريخ التخزين:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="store_date" id="Store_date"
                            value="{{ $store->store_date }}" required>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
    </div>
@endsection
