@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <h5 class="card-title">إضافة شغل عمال جديد</h5>

        <div class="card-body">
            <form action="{{ route('WorkerGroupStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($Workervisours->count() > 0)
                    <div class="row mb-3">

                        <label class="col-sm-2 col-form-label" for="person_name">اسم المقاول:</label>
                        <div class="col-sm-10">

                            <select name="supervisor_id" class="form-control">
                                @foreach ($Workervisours as $Workervisour)
                                    <option value="{{ $Workervisour->id }}">{{ $Workervisour->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="person_name">اسم المقاول:</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="work"> الشغل :</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" name=" work" id="work" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="work"> نوع حساب الشغل :</label>
                    <div class="col-sm-10">

                        <input type="radio" name="type_work" value="يومية" checked>يومية
                        <input type="radio" name="type_work" class="m-3" value="جامبو">جامبو
                        <input type="radio" name="type_work" class="m-3" value="فدان">فدان
                        <input type="radio" name="type_work" class="m-3" value="شكارة">شكارة
                    </div>
                </div>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="worker_count">عدد العمال او الافدنة او الجامبوهات او الشكاير
                        :</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" name="worker_count" id="worker_count" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="daily_wage">اليومية او سعر الجامبو او الشيكارة :</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" name="daily_wage" id="daily_wage" required>
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
                    <label class="col-sm-2 col-form-label" for="work_date">يوم الشغل:</label>
                    <div class="col-sm-10">

                        <input type="date" class="form-control" name="work_date" id="work_date" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
    </div>
@endsection
