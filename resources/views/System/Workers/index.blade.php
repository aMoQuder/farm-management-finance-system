<!-- resources/views/workers/index.blade.php -->
@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif


    <div class="pagetitle">
        <h1>عرض جميع الموظفين</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">الموظفين</li>
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


                            <li><a class="dropdown-item" href="{{ route('workers.create') }}">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table18')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table18')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table18')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table18')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table18')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">جميع الموظفين  لصالح الشركة</h5>

                        <table class="table datatable table-responsive " id="table18">
                            <thead>
                                <tr>
                                    <th>اسم الموظف</th>
                                    <th>المرتبات</th>
                                    <th>الوظيفة</th>
                                    <th>الإجراءات</th>
                                    <th style="display: none"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workers as $worker)
                                    <tr>
                                        <td style="display: none"></td>
                                        <td>{{ $worker->name }}</td>
                                        <td>{{ $worker->salary }}</td>
                                        <td>{{ $worker->job }}</td>
                                        <td>
                                            <a href="{{ route('ShowWorker', $worker->id) }}" class="table-btn"><i
                                                class="bi bi-eye-slash"></i></a>
                                            <form action="{{ route('workers.destory', $worker->id) }}" method="post" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"  class="table-btn"><i
                                                    class="bi bi-trash"></i></button>
                                            </form>
                                            <a href="{{ route('workers.edit', $worker->id) }}" class="table-btn"><i
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

