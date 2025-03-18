<!-- resources/views/ExpenCompanys/index.blade.php -->
@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif


    <div class="pagetitle">
        <h1>عرض جميع المصاريف</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">المصاريف</li>
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


                            <li><a class="dropdown-item" href="{{ route('ExpenCompanys.create') }}">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table8')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table8')"> تحويل الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table8')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table8')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table8')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">جميع المصاريف المستهلكة لصالح الشركة</h5>

                        <table class="table datatable table-responsive " id="table8">
                            <thead>
                                <tr>
                                    <th> المبلغ</th>
                                    <th>الغرض</th>
                                    <th>المستلم</th>
                                    <th class="demoshow">التاريخ</th>
                                    <th class="demo">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ExpenCompanys as $ExpenCompany)
                                    <tr>
                                        <td>{{ $ExpenCompany->amount }}</td>
                                        <td>{{ $ExpenCompany->reason }}</td>
                                        <td>{{ $ExpenCompany->receiver }}</td>
                                        <td class="demoshow">{{ $ExpenCompany->date }}</td>
                                        <td class="demo">
                                            <a href="{{ route('ExpenCompanys.edit', $ExpenCompany->id) }}"
                                                class="table-btn"><i class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('ExpenCompanys.delete', $ExpenCompany->id) }}"
                                                method="post" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="table-btn"><i
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
