@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">إضافة ارض جديدة</h5>

        <div class="card-body">
            <form action="{{ route('lands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                      <label  class="col-sm-2 col-form-label" for="name">اسم الارض:</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" name="name" id="name">
                        @error('name')
                            <div class="alert alert-danger ">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="area">مساحة الارض:</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" name="area" id="area">
                        @error('area')
                            <div class="alert alert-danger ">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">

                      <label class="col-sm-2 col-form-label" for="subervisor">العامل المشرف على الارض:</label>
                    <div class="col-sm-10">

                        <select name="supervisor_id" class="form-control">
                            @foreach ($workers as $worker)
                                <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                            @endforeach
                        </select>
                        @error('supervisor_id')
                            <div class="alert alert-danger ">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
    </div>
@endsection
