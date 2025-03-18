@extends('layouts.dashboard')

@section('content')
    <div class="card">


        <div class="card-body">
            <h5 class="card-title">إضافة سماد جديد</h5>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="work">إضافة سماد من خلال:</label>
                <div class="col-sm-10">

                    <input type="radio" name="type_work" id="from_store" value="store"> المخزن
                    <input type="radio" name="type_work" id="not_from_store" value="not_store" class="mr-4" checked>
                    غير
                    المخزن
                </div>
            </div>


            <!-- Form for adding fertilizer not from store -->
            <form id="notStoreForm" action="{{ route('fertilizerStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">اسم السماد:</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="quantity">الكمية:</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" name="quantity" id="quantity_not_store" required>
                    </div>
                </div>
                <div class="row mb-3">

                    <label class="col-sm-2 col-form-label" for="type_quantity"> نوع الكمية:</label>
                    <div class="col-sm-10">

                        <select name="type_quantity" class="form-control">
                            <option value="كيس">بالكياس</option>
                            <option value="كرتونة">بالكراتين</option>
                            <option value="لتر">باللتر</option>
                            <option value="شكارة">شكاير</option>
                        </select>
                        @error('type_quantity')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">اختر الارض</label>
                    <div class="col-sm-10">

                        <select name="name" class="form-control" id="storeSelect">
                            <option value="">اختر الارض</option>
                            @foreach ($lands as $land)
                                <option value="{{ $land->id }}">
                                    {{ $land->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date_received">اسم الزرع:</label>
                    <div class="col-sm-10">
                        <select name="crop_id" class="form-control" required>
                            @foreach ($crops as $crop)
                                <option value="{{ $crop->id }}">{{ $crop->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date_received">تاريخ الحصول على
                        السماد:</label>
                    <div class="col-sm-10">

                        <input type="date" class="form-control" name="acquired_date" id="acquired_date_not_store"
                            required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>


            <!-- Form for adding fertilizer from store -->
            <form id="storeForm" action="{{ route('fertilizer.storeFromStore',) }}" method="POST"
                enctype="multipart/form-data" style="display: none;">

                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">اختر سماد من
                        المخزن:</label>
                    <div class="col-sm-10">

                        <select name="name" class="form-control" id="storeSelect">
                            <option value="">اختر السماد</option>
                            @foreach ($stores as $store)
                                @if ($store->type_store == 'سماد')
                                    <option value="{{ $store->id }}" data-price="{{ $store->price }}"
                                        data-quantity="{{ $store->quantity }}">
                                        {{ $store->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">اختر الارض</label>
                    <div class="col-sm-10">

                        <select name="land_id" class="form-control" id="storeSelect">
                            <option value="">اختر الارض</option>
                            @foreach ($lands as $land)
                                <option value="{{ $land->id }}">
                                    {{ $land->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date_received">اسم الزرع:</label>
                    <div class="col-sm-10">
                        <select name="crop_id" class="form-control" required>
                            @foreach ($crops as $crop)
                                <option value="{{ $crop->id }}">{{ $crop->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="price" id="price_from_store" value="">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="quantity">الكمية:</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" name="quantity" id="quantity_from_store" required>
                    </div>
                    <small id="quantity_error" class="text-danger" style="display: none;">الكمية المدخلة
                        أكبر من
                        المتاحة.</small>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="getter_name">المستلم
                        :</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" name="getter_name" id="getter_name" required>
                    </div>
                </div>
                <div class="row mb-3">

                    <label class="col-sm-2 col-form-label" for="type_quantity"> نوع
                        الكمية:</label>
                    <div class="col-sm-10">

                        <select name="type_quantity" class="form-control">
                            <option value="كيس">بالكياس</option>
                            <option value="كرتونة">بالكراتين</option>
                            <option value="لتر">باللتر</option>
                            <option value="شكارة">شكاير</option>
                        </select>
                        @error('type_quantity')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date_received">تاريخ
                        الحصول على
                        السماد:</label>
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
