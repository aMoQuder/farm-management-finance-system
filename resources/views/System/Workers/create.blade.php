@extends('layouts.dashboard')

@section('content')


    <div class="card">
        <h5 class="card-title">إضافة موظف جديد</h5>

        <div class="card-body">
            <form action="{{ route('workers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">اسم الموظف:</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                </div>
                @error('name')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="job">مهنة الموظف:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="job" id="job" required>
                    </div>
                </div>
                @error('job')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="salary">الراتب الشهري:</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" name="salary" id="salary" required>
                    </div>
                </div>
                @error('salary')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror


                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
    </div>
@endsection
