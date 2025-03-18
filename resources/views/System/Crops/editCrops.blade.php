@extends('layouts.dashboard')

@section('content')


    <div class="card">
        <h5 class="card-title">تعديل الزرع</h5>

        <div class="card-body">

            <form action="{{ route('lands.updateCrop', [$land->id, $crop->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name" class="form-label">الاسم</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $crop->name }}" id="name" name="name" required>
                    </div>
                </div>
                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="seed_quantity" class="form-label">الكمية بالطن
                        الواحد</label>
                    <div class="col-sm-10">
                        <input type="number" step="0.01" value="{{ $crop->seed_quantity }}" class="form-control" id="seed_quantity"
                            name="seed_quantity" required>
                    </div>
                </div>
                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="seed_price" class="form-label">سعر الطن الواحد</label>
                    <div class="col-sm-10">
                        <input type="number" step="0.01" value="{{ $crop->seed_price }}" class="form-control" id="seed_price"
                            name="seed_price" required>
                    </div>
                </div>
                <div  class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="seed_acquired_date" class="form-label"> تاريخ الزراعة </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" value="{{ $crop->seed_acquired_date }}" id="seed_acquired_date"
                            name="seed_acquired_date" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">نعديل هذا الزرع</button>
            </form>
        </div>
    </div>
@endsection
