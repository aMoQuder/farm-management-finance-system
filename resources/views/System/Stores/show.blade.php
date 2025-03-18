@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif


    <div class="pagetitle">
        <h1>تفاصيل مخزون ال{{ $store->name }}</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">المخزون</li>
                <li class="breadcrumb-item active">{{ $store->name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-3">


                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <h3><strong>الكمية   :</strong> {{ $store->quantity }} {{$store->type_quantity}}</h3>
                        <h3><strong>التصنيف:</strong> {{ $store->type_store }}</h3>
                        <h3><strong>تاريخ التخزين:</strong> {{ $store->store_date }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-9">

                <div class="card  recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>اعدادت اخرى</h6>
                            </li>


                            <li><a class="dropdown-item">


                                    <form action="{{ route('stores.deleteAllStoreDetails', $store->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('هل أنت متأكد من حذف جميع الاسمدة الخاصة بهذا الزرع')">حذف
                                            جميع المصروفات</button>
                                    </form>

                                </a></li>
                            <li><a class="dropdown-item" onclick="printTable('table14')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table14')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table14')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table14')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table14')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">جميع الاراضي المستخدمة لصالح الشركة</h5>

                        <table class="table datatable table-responsive " id="table14">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الكمية  </th>

                                    <th>تاريخ التسميد</th>
                                    <th class="demoshow">المستلم </th>
                                    <th class="demo">الاجراء </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($store->StoreDetails as $StoreDetail)
                                    <tr>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $StoreDetail->quantity }} {{ $store->type_quantity }}</td>
                                        <td>{{ $StoreDetail->get_date }}</td>
                                        <td class="demoshow">{{ $StoreDetail->getter_name }}</td>
                                        <td class="demo">
                                            <a href="{{ route('stores.editStoreDetails', [$store->id, $StoreDetail->id]) }}"
                                                class="table-btn"><i class="bi bi-pencil-square"></i></a>
                                            <form
                                                action="{{ route('stores.deleteStoreDetail', [$store->id, $StoreDetail->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا السماد؟')"
                                                    class="table-btn"><i class="bi bi-trash"></i></button>
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
