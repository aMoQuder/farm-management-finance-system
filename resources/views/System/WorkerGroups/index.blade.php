 @extends('layouts.dashboard')

 @section('content')
 @if (session('massage'))
 <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
@endif
@if (session('delete'))
 <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
@endif



<div class="pagetitle">
    <h1>عرض جميع شغل العمال</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
        <li class="breadcrumb-item"></li>
        <li class="breadcrumb-item active">شغل العمال</li>
    </ol>
</nav>
</div><!-- End Page Title -->
<section class="section">
<div class="row">
    <div class="col-lg-12">

        <div class="card  recent-sales overflow-auto">

            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>اعدادت اخرى</h6>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('createWorkerGroup') }}">اضافة جديد</a></li>
                    <li><a class="dropdown-item" onclick="printTable('table15')"> طباعة</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table15')"> تحويل
                            الى
                            pdf </a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table15')"> تحويل
                            الى exel </a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table15')">
                            تحويل الى powerpoint </a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table15')"> تحويل
                            الى word </a></li>
                </ul>
            </div>

            <div class="card-body">
                <h5 class="card-title">جميع شغل العمال المستخدم لصالح الشركة</h5>

                <table class="table datatable table-responsive " id="table15">
                    <thead>
                        <tr>
                            <th>يوم الشغل</th>
                            <th>اسم المقاول</th>
                            <th>عدد الشغل </th>
                            <th>سعر </th>
                            <th>حساب الشغل</th>
                            <th>الشغل</th>
                            <th>الارض</th>
                            <th class="demoshow">الزرع</th>
                            <th class="demo">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($WorkerGroupCrop as $WorkerGroup)
                            <tr>
                               <td>{{ $WorkerGroup->work_date }}</td>

                                <td>
                                    <a href="{{ route('displaysupervisor', $WorkerGroup->supervisor->id) }}">
                                        {{$WorkerGroup->supervisor->name}}
                                    </a>
                                </td>

                                <td>{{ $WorkerGroup->worker_count }}{{ $WorkerGroup->type_work }}</td>
                                <td>{{ $WorkerGroup->daily_wage }}</td>
                                <td>{{ $WorkerGroup->worker_count * $WorkerGroup->daily_wage }}جنية</td>
                                <td>{{ $WorkerGroup->work }}</td>
                                <td>
                                    {{$WorkerGroup->landWorking->name}}
                                </td>
                                <td class="demoshow">
                                    @foreach ($crops as $crop)
                                        @if ($WorkerGroup->WorkerGroupable_id == $crop->id)
                                            {{ $crop->name }}
                                        @endif
                                    @endforeach

                                </td>


                                <td class="demo">

                                    <form
                                        action="{{ route('crops.editWorkerGroupsupervisor', [$WorkerGroup->WorkerGroupable_id, $WorkerGroup->id]) }}"
                                        method="post" style="display: inline-block;" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit"  class="table-btn"><i
                                           class="bi bi-pencil-square"></i></button>
                                    </form>
                                    <form
                                        action="{{ route('crops.deleteWorkerGroup', [$WorkerGroup->WorkerGroupable_id, $WorkerGroup->id]) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="10" name="id_session">
                                        <button type="submit"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا السماد انت ستحذفه من كل شئ له علاقة بهذا السماد')"class="table-btn"><i
                                            class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>




</div>
</section>

 @endsection
