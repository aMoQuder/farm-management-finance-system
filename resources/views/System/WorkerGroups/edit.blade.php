@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">تعديل شغل العمال</h5>

        <div class="card-body">

            <form action="{{ route('crops.updateWorkerGroup', [$crop->id, $WorkerGroup->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($session)
                    <input type="hidden" name="supervisor_id" value="{{ $WorkerGroup->supervisor_id }}">
                    <input type="hidden" name="bage" value="subervisorBage">
                @else
                    <div class="row mb-3">

                        <label class="col-sm-2 col-form-label" for="person_name">اسم المقاول:</label>
                        <div class="col-sm-10">
                            <select name="person_name" class="form-control" required>
                                @foreach ($Workervisours as $Workervisour)
                                    <option value="{{ $Workervisour->name }}">{{ $Workervisour->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="person_name">اسم المقاول:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>
                    @if ($updatesission)
                        <input type="hidden" name="bage" value="bageallworkergroup">
                    @else
                        <input type="hidden" name="bage" value="nnn">
                    @endif
                @endif


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="work"> الشغل :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name=" work" value="{{ $WorkerGroup->work }}"id="work" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="work"> نوع حساب الشغل :</label>
                    <div class="col-sm-10">
                        <input type="radio" name="type_work" value="يومية" checked>يومية
                        <input type="radio" name="type_work" class="mr-4" value="جامبو">جامبو
                        <input type="radio" name="type_work" class="mr-4" value="فدان">فدان
                        <input type="radio" name="type_work" class="mr-4" value="شكارة">شكارة
                    </div>
                </div>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="worker_count">عدد العمال او الافدنة او الجامبوهات او الشكاير
                        :</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="worker_count" value="{{ $WorkerGroup->worker_count }}"
                            id="worker_count" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="daily_wage">اليومية او سعر الجامبو او الشيكارة :</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="daily_wage" value="{{ $WorkerGroup->daily_wage }}"
                            id="daily_wage" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="work_date">يوم الشغل:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="work_date" value="{{ $WorkerGroup->work_date }}" id="work_date"
                            required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">تعديل</button>
            </form>
        </div>
    </div>
@endsection
