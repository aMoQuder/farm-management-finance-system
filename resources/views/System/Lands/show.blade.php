@extends('layouts.dashboard')

@section('content')
    <div class="pagetitle">
        <h1>تفاصيل المزروعات</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">المزروعات</li>
                <li class="breadcrumb-item active"> {{ $land->name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <p>مساحة: {{ $land->area }} فدان</p>
        <p>العامل المشرف: {{ optional($land->supervisor)->name ?? 'لا يوجد مشرف' }}</p>
        <div class="row">
            <div class="col-lg-12">

                <div class="card  recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>اعدادت اخرى</h6>
                            </li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"> اضافة جديد</a></li>


                            <li><a class="dropdown-item">
                                    <form action="{{ route('lands.deleteAllCrops', $land->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('هل أنت متأكد من حذف كل  زرع يخص هذج الارض')">حذف كل زرع
                                        </button>
                                    </form>
                                </a></li>
                            <li><a class="dropdown-item" onclick="printTable('table11')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table11')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table11')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table11')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table11')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">








                        <h5 class="card-title">جميع المزروعات المستخدمة لصالح هذه الارض</h5>

                        <table class="table datatable table-responsive " id="table11">
                            <thead>
                                <tr>
                                    <th> الزرع</th>
                                    <th>كمية التقاوي</th>
                                    <th>تاريخ الزراعة</th>
                                    <th class="demoshow">سعر طن الواحد </th>
                                    <th class="demo"> الاجراء </th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($land->LandCrops as $crops)
                                    <tr>
                                        <td>{{ $crops->name }}</td>
                                        <td>{{ $crops->seed_quantity }} طن</td>
                                        <td>{{ $crops->seed_acquired_date }}</td>
                                        <td class="demoshow">{{ $crops->seed_price }} جنية</td>
                                        <td class="demo"> <a
                                                href="{{ route('lands.showCrop', [$land->id, $crops->id]) }}"class="table-btn"><i
                                                    class="bi bi-eye-slash"></i></a>

                                            <a
                                                href="{{ route('lands.editCrop', [$land->id, $crops->id]) }}"class="table-btn"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('lands.deleteCrop', [$land->id, $crops->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id_session" id="id_session" value="20">
                                                <button type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الزرع انت ستحذف كل شئ له علاقة بهذا الزرع')"class="table-btn"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>




                        <div class="modal fade" id="largeModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <h5 class="modal-title">إضافة زرع جديدة</h5>
                                    </div>
                                    <div class="modal-body">

                                        <div class="card-body">
                                            <form action="{{ route('lands.addCrops') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="name"
                                                        class="form-label">الاسم</label>
                                                    <div class="col-sm-10">

                                                        <input type="text" class="form-control" id="name" name="name"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="seed_quantity"
                                                        class="form-label">الكمية بالطن
                                                        الواحد</label>
                                                    <div class="col-sm-10">

                                                        <input type="number" step="0.01" class="form-control"
                                                            id="seed_quantity" name="seed_quantity" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="seed_price"
                                                        class="form-label">سعر الطن الواحد</label>
                                                    <div class="col-sm-10">

                                                        <input type="number" step="0.01" class="form-control"
                                                            id="seed_price" name="seed_price" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="seed_acquired_date"
                                                        class="form-label"> تاريخ الزراعة </label>
                                                    <div class="col-sm-10">

                                                        <input type="date" class="form-control" id="seed_acquired_date"
                                                            name="seed_acquired_date" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">

                                                    <div class="col-sm-12 ">
                                                        <button type="submit" class="btn btn-primary d-block" >إضافة زرع</button>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="Land_id" value="{{ $land->id }}">


                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div><!-- End Large Modal-->





                    </div>
                </div>

            </div>




        </div>
    </section>
@endsection
