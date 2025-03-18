@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif

    <div class="pagetitle">
        <h1>عرض جميع شغل الآلات</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">شغل الآلات</li>
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


                            <li><a class="dropdown-item" href="{{ route('machine-jobs.create') }}">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table12')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table12')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table12')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table12')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table12')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">جميع شغل الآلات المستخدمة لصالح الشركة</h5>

                        <table class="table datatable table-responsive " id="table12">
                            <thead>
                                <tr>
                                    <th>الآلة</th>
                                    <th>الشغل</th>
                                    <th>السواق</th>
                                    <th>الزرع</th>
                                    <th>الارض</th>
                                    <th>عدد الافدنة</th>
                                    <th class="demoshow">يوم الشغل</th>
                                    <th class="demo">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($MachineJobCrop as $machine)
                                    <tr>
                                        <td>{{ $machine->machine_name }}</td>
                                        <td>{{ $machine->Work_name }}</td>
                                            <td>
                                                {{$machine->driver->name}}
                                            </td>
                                        <td >
                                            @foreach ($crops as $crop)
                                                @if ($machine->MachineJobable_id == $crop->id)
                                                    {{ $crop->name }}
                                                @endif
                                            @endforeach

                                        </td>
                                        <td>
                                            {{$machine->landMachine->name}}
                                        </td>                                        <td >{{ $machine->Count_hour }} فدان</td>
                                        <td class="demoshow">{{ $machine->Work_day }}</td>


                                        <td class="demo">
                                            <a href="{{ route('crops.editMachineJob', [$machine->MachineJobable_id, $machine->id]) }}"
                                                class="table-btn"><i class="bi bi-pencil-square"></i></a>
                                            <form
                                                action="{{ route('crops.deleteMachineJob', [$machine->MachineJobable_id, $machine->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="10" name="id_session">
                                                <button type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الشغل   انت ستحذفه من كل شئ له علاقة بهذالشغل')"class="table-btn"><i
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
