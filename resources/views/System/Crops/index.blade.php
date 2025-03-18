<!-- resources/views/crops/index.blade.php -->
@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif
    <div class="pagetitle">
        <h1>عرض جميع الزرع</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">الزرع </li>
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


                            <li><a class="dropdown-item" href="{{ route('lands.CreateCrop') }}">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table3')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table3')"> تحويل الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table3')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table3')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table3')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">ادارة كل المزروعات   </h5>

                        <table class="table datatable table-responsive " id="table3">

                            <thead>
                                <tr>
                                    <th>اسم الزرع</th>
                                    <th>كمية التقاوي</th>
                                    <th>الارض</th>
                                    <th class="demoshow" data-type="date" data-format="YYYY/DD/MM">تاريخ الزراعة</th>
                                    <th class="demo">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($crops as $crop)
                                    <tr>
                                        <td>{{ $crop->name }}</td>
                                        <td>{{ $crop->seed_quantity }}طن {{ $crop->name }}</td>
                                        <td>
                                            @foreach ($lands as $land)
                                                @if ($crop->Landable_id == $land->id)
                                                    {{ $land->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="demoshow">{{ $crop->seed_acquired_date }}</td>
                                        <td class="demo"> <a href="{{ route('lands.showCrop', [$crop->Landable_id, $crop->id]) }}"
                                                class="table-btn"><i
                                                class="bi bi-eye-slash"></i></a> 

                                                <form action="{{ route('lands.deleteCrop', [$crop->Landable_id, $crop->id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="10" name="id_session">
                                                    <button type="submit" class="table-btn"
                                                        onclick="return confirm('هل أنت متأكد من حذف هذا الزرع انت ستحذف كل شئ له علاقة بهذا الزرع')"><i
                                                        class="bi bi-trash"></i></button>
                                                </form>
                                            <a href="{{ route('lands.editCrop', [$crop->Landable_id, $crop->id]) }}"
                                                class="table-btn"><i
                                                class="bi bi-pencil-square"></i></a>
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
