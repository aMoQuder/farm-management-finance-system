@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif



    <div class="pagetitle">
        <h1>عرض المخزن</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">المخزن</li>
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


                            <li><a class="dropdown-item" href="{{ route('stores.create') }}">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table13')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table13')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table13')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table13')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table13')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">جميع المنتجات المخزنة </h5>

                        <table class="table datatable table-responsive " id="table13">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الكمية او الطول</th>
                                    <th>التصنيف</th>
                                    <th class="demoshow">تاريخ التخزين</th>
                                    <th class="demo">الاجراء </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    <tr>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->quantity }}
                                            @if ($store->type_quantity == 'نفس المخزون')
                                                {{ $store->name }}
                                            @else
                                                {{ $store->type_quantity }}
                                            @endif
                                        </td>

                                        <td>{{ $store->type_store }}</td>
                                        <td class="demoshow">{{ $store->store_date }}</td>


                                        <td class="demo">
                                            <a href="{{ route('stores.editQuantity', $store->id) }}" class="table-btn"><i
                                                    class="bi bi-dice-5"></i></a>
                                            <a href="{{ route('stores.show', $store->id) }}" class="table-btn"><i
                                                    class="bi bi-eye-slash"></i></a>
                                            <form action="{{ route('stores.destroy', $store->id) }}" method="POST"
                                                style="display:inline;" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="table-btn"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                            <a href="{{ route('stores.edit', $store->id) }}" class="table-btn"><i
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
