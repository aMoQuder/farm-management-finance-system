@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif

    <div class="pagetitle">
        <h1>عرض جميع الاراضي</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">الاراضي</li>
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


                            <li><a class="dropdown-item" href="{{ route('lands.create') }}">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table10')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table10')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table10')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table10')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table10')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">جميع الاراضي المستخدمة لصالح الشركة</h5>

                        <table class="table datatable table-responsive " id="table10">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>المساحة</th>
                                    <th class="demoshow">العامل المشرف </th>
                                    <th class="demo">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lands as $land)
                                    <tr>
                                        <td>{{ $land->name }}</td>
                                        <td>{{ $land->area }} فدان</td>
                                        <td class="demoshow">{{ optional($land->supervisor)->name ?? 'لا يوجد مشرف' }}</td>

                                        <td class="demo">
                                            <a href="{{ route('lands.show', $land->id) }}" class="table-btn"><i
                                                    class="bi bi-eye-slash"></i></a>
                                            <form action="{{ route('lands.destroy', $land->id) }}" method="POST"
                                                style="display:inline;" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="table-btn"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                            <a href="{{ route('lands.edit', $land->id) }}" class="table-btn"><i
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
