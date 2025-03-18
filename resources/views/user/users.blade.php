<!-- resources/views/items/index.blade.php -->
@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif

    <div class="pagetitle">
        <h1>عرض جميع المستخدمين</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">المستخدمين </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-md-9">

                <div class="card  recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>اعدادت اخرى</h6>
                            </li>


                            <li><a class="dropdown-item" href="">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table20')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table20')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table20')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table20')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table20')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">ادارة كل المستخدمين </h5>

                        <table class="table datatable table-responsive " id="table20">

                            <thead>
                                <tr>
                                    <th>اسم </th>
                                    <th>الايميل </th>
                                    <th>الهيئة</th>
                                    <th class="demoshow">صالحية </th>
                                    <th class="demo">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>

                                            {{ $item->role }}

                                        </td>
                                        <td class="demoshow">{{ $item->status }}</td>
                                        <td class="demo"> <a href="{{ route('deletuser', $item->id) }}" class="table-btn"><i
                                                    class="bi bi-trash"></i></a>


                                            <a href="{{ route('editUser', $item->id) }}" class="table-btn"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        <div class="col-md-3">

            <div class="card  recent-sales overflow-auto">



                <div class="card-body">
                    <h5 class="card-title">ادارة كل </h5>


                </div>
            </div>
        </div>



        </div>
    </section>
@endsection
