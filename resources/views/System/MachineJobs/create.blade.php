@extends('layouts.dashboard')

@section('content')


        <div class="card">

            <h5 class="card-title">إضافة شغل آلة جديد</h5>
            <div class="card-body">

                <form action="{{ route('MachineJobStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="machine_name">اسم الآلة:</label>
                        <div class="col-sm-10">

                            <input type="text" class="form-control" name="machine_name" id="machine_name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="Count_hour">  عدد الافدنة:</label>
                        <div class="col-sm-10">

                            <input type="number" class="form-control" name="Count_hour"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="machine_name"> نوع الشغل:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Work_name" id="machine_name" required>
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
                        <label class="col-sm-2 col-form-label" for="crop_id">اسم الزرع:</label>
                        <div class="col-sm-10">
                            <select name="crop_id" class="form-control" required>
                                @foreach ($crops as $crop)
                                    <option value="{{ $crop->id }}">{{ $crop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="date">يوم الشغل :</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="Work_day" id="Work_day" value="" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">إضافة</button>
                </form>
            </div>
        </div>
@endsection
