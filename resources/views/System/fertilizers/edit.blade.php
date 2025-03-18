@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <h5 class="card-title">تعديل السماد</h5>

        <div class="card-body">
            <form action="{{ route('crops.updateFertilizer', [$crop->id, $Fertilizer->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="fertilizer_name">اسم السماد:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name=" name" value="{{ $Fertilizer->name }}" id="name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="quantity">الكمية:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="quantity" value="{{ $Fertilizer->quantity }}" id="quantity"
                            required>
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
                    <label class="col-sm-2 col-form-label" for="date_received">تاريخ الحصول على السماد:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="acquired_date" value="{{ $Fertilizer->acquired_date }}"
                            id="acquired_date" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">تعديل السماد</button>
            </form>
        </div>
    </div>
@endsection
