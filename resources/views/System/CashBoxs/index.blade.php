@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif
    <div class="pagetitle">
        <h1>عرض كل محتويات الخزنة</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">الخزنة</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <h2> الرصيد المتبقي : {{ $diffrance }}</h2>

        <div class="row">
            <div class="col-lg-12">

                <div class="card  recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>اعدادت اخرى</h6>
                            </li>


                            <li><a class="dropdown-item" href="{{ route('CashBoxs.create') }}">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table1')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table1')"> تحويل الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table1')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table1')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table1')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">المبالغ المحصلة في الخزنة </h5>

                        <table class="table datatable table-responsive " id="table1">
                            <thead>
                                <tr>
                                    <th>المبلغ</th>
                                    <th> المصدر او المرسل </th>
                                    <th>وصف المبلغ</th>
                                    <th>المستلم</th>
                                    <th class="demoshow">تاريخ الاستلام</th>
                                    <th class="demohead">الاجراء </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($CashBoxs as $CashBox)
                                    <tr>
                                        <td>{{ $CashBox->amount }}</td>
                                        <td>{{ $CashBox->source }}</td>
                                        <td>{{ $CashBox->description }}</td>
                                        <td>{{ $CashBox->receiver }}</td>
                                        <td class="demoshow">{{ $CashBox->date }}</td>


                                        <td class="demo">

                                            <form action="{{ route('CashBoxs.destroy', $CashBox->id) }}" method="POST"
                                                style="display:inline;" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="table-btn"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                            <a href="{{ route('CashBoxs.edit', $CashBox->id) }}" class="table-btn"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h2> مجموع المبالغ المحصلة في الخزنة : {{ $TotalDeposit }}</h2>
                    </div>
                </div>

            </div>

            <div class="col-lg-12">

                <div class="card recent-sales overflow-auto">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>اعدادت اخرى</h6>
                            </li>


                            <li><a class="dropdown-item" onclick="printTable('table2')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table2')"> تحويل الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table2')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table2')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table2')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">المسحوب من الخزنة </h5>

                        <table class="table  datatable table-responsive" id="table2">
                            <thead>
                                <tr>
                                    <th>المبلغ</th>
                                    <th>وصف المبلغ</th>
                                    <th>المستلم</th>
                                    <th class="demoshow">تاريخ الاستلام</th>
                                    <th class="demo"> الاجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pullCash as $CashBox)
                                    <tr>
                                        <td>{{ $CashBox->amount }}</td>
                                        <td>{{ $CashBox->description }}</td>
                                        <td>{{ $CashBox->receiver }}</td>
                                        <td class="demoshow">{{ $CashBox->date }}</td>
                                        <td class="demo">

                                            <form action="{{ route('CashBoxs.destroy', $CashBox->id) }}" method="POST"
                                                style="display:inline;" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="table-btn"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                            <a href="{{ route('CashBoxs.edit', $CashBox->id) }}" class="table-btn"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h2> كل المسحوب من الخزنة : {{ $TotalPull }}</h2>

                    </div>
                </div>

            </div>



        </div>
    </section>
@endsection
