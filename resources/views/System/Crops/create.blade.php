<!-- resources/views/crops/create.blade.php -->
@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <h5 class="card-title">إضافة زرع جديدة</h5>

        <div class="card-body">
            <form action="{{ route('lands.addCrops') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name" >الاسم</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="name" name="name" required>
                        @error('name')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="seed_quantity" >الكمية بالطن
                        الواحد</label>
                    <div class="col-sm-10">

                        <input type="number" step="0.01" class="form-control" id="seed_quantity" name="seed_quantity"
                            required>
                            @error('seed_quantity')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="seed_price" >سعر الطن الواحد</label>
                    <div class="col-sm-10">

                        <input type="number" step="0.01" class="form-control" id="seed_price" name="seed_price"
                            required>
                            @error('seed_price')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="seed_acquired_date" >  تاريخ الزراعة </label>
                    <div class="col-sm-10">

                        <input type="date" class="form-control" id="seed_acquired_date" name="seed_acquired_date"
                            required>
                            @error('seed_acquired_date')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="seed_acquired_date" > اختر الارض  </label>
                    <div class="col-sm-10">
                        <select name="Land_id" class="form-control">
                            @foreach ($lands as $land)
                                <option value="{{ $land->id }}">{{ $land->name }}</option>
                            @endforeach
                        </select>
                        @error('Land_id')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror

                    </div>
                </div>
                {{-- <input type="hidden" name="Land_id" value="{{ $land->id }}"> --}}


                <div class="row mb-3">

                    <div class="col-sm-12 ">
                        <button type="submit" class="btn btn-primary d-block">إضافة زرع</button>
                    </div>

                </div>


            </form>
        </div>
    </div>
@endsection
