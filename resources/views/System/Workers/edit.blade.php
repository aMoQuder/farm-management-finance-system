<!-- resources/views/workers/edit.blade.php -->
@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <h5 class="card-title">تعديل بيانات الموظف</h5>

        <div class="card-body">
            <form action="{{ route('saveWorkers') }}" method="post" enctype="multipart/form-data">
                @csrf


                <div class="row mb-3">
                    <input type="hidden" name="old_id" value="{{ $worker->id }}">
                    <label class="col-sm-2 col-form-label" for="name" class="form-label">اسم الموظف</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $worker->name }}" required>
                    </div>
                </div>
                @error('name')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="job">مهنة الموظف:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="job" id="job" value="{{$worker->job}}" required>
                    </div>
                </div>
                @error('job')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="salary" class="form-label">المرتب</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="salary" name="salary" value="{{ $worker->salary }}" required>
                    </div>
                </div>
                @error('salary')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">تعديل</button>
            </form>

        </div>
    </div>
@endsection
