@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">تعديل شغل الالة</h5>

        <div class="card-body">
            <form action="{{ route('crops.updateMachineJob', [$crop->id, $MachineJob->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="machine_name">اسم الآلة:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="machine_name" id="machine_name"
                            value="{{ $MachineJob->machine_name }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="Work_name"> نوع الشغل:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="Work_name" id="Work_name" value="{{ $MachineJob->Work_name }}"
                            required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="Count_hour">  عدد  الافدنة:</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" name="Count_hour" value="{{ $MachineJob->Count_hour}}"
                            required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="worker_id">اسم العامل الذي يقود الآلة:</label>
                    <div class="col-sm-10">
                        <select name="driver_id" class="form-control" required>
                            @foreach ($workers as $worker)
                                <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="date">يوم الشغل :</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="Work_day" id="Work_day" value="{{ $MachineJob->Work_day }}"
                            required>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>

        </div>
    </div>
@endsection
