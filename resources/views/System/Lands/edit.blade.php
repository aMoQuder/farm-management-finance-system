@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">تعديل الارض</h5>

        <div class="card-body">
            <form action="{{ route('lands.update', $land->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">اسم الارض:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name=" name" value="{{ $land->name }}" id="name"
                            required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="area">مساحة الارض:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="area" value="{{ $land->area }}" id="quantity"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="supervisor_id">العامل المشرف :</label>
                    <div class="col-sm-10">
                        <select name="supervisor_id" class="form-control">
                            @foreach ($workers as $worker)
                                <option value="{{ $worker->id }}"
                                    {{ $land->supervisor_id == $worker->id ? 'selected' : '' }}>{{ $worker->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">تعديل السماد</button>
            </form>
        </div>
    </div>
@endsection
