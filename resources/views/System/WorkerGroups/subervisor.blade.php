<!-- resources/views/Workervisours/show.blade.php -->
@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif
    <div class="pagetitle">
        <h1>تفاصيل المقاول </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">حساب شغل</li>
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


                            <li><a class="dropdown-item">
                                    <form action="{{ route('Workervisours.deleteAllpayments', $Workervisour->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('هل أنت متأكد من حذف جميع المصروفات؟')">حذف جميع
                                            المصروفات</button>
                                    </form>
                                </a></li>
                            <li><a class="dropdown-item" onclick="printTable('table16')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table16')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table16')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table16')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table16')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">تفاصيل شغل {{ $Workervisour->name }}</h5>

                        <table class="table datatable table-responsive " id="table16">
                            <thead>
                                <tr>
                                    <th>عدد الشغل </th>
                                    <th>سعر </th>
                                    <th>الشغل</th>
                                    <th>يوم الشغل</th>
                                    <th>حساب الشغل</th>
                                    <th class="demoshow">الزرع</th>
                                    <th class="demo">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($WorkerGroupCrop as $WorkerGroup)
                                    <tr>

                                        <td>{{ $WorkerGroup->worker_count }}{{ $WorkerGroup->type_work }}</td>
                                        <td>{{ $WorkerGroup->daily_wage }}</td>
                                        <td>{{ $WorkerGroup->work }}</td>
                                        <td>{{ $WorkerGroup->work_date }}</td>
                                        <td>{{ $WorkerGroup->worker_count * $WorkerGroup->daily_wage }}جنية</td>
                                        <td class="demoshow">
                                            @foreach ($crops as $crop)
                                                @if ($WorkerGroup->WorkerGroupable_id == $crop->id)
                                                    {{ $crop->name }}
                                                @endif
                                            @endforeach

                                        </td>


                                        <td class="demo">


                                            <a href="{{ route('crops.editWorkerGroup', [$WorkerGroup->WorkerGroupable_id, $WorkerGroup->id]) }}"
                                                class="table-btn"><i class="bi bi-pencil-square"></i></a>
                                            <form
                                                action="{{ route('crops.deleteWorkerGroup', [$WorkerGroup->WorkerGroupable_id, $WorkerGroup->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="10" name="id_session">
                                                <button type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الشغل انت ستحذفه من كل شئ له علاقة بهذا الشغل')"class="table-btn"><i
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
                                    <form action="{{ route('Workervisours.deleteAllpayments', $Workervisour->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('هل أنت متأكد من حذف جميع المصروفات؟')">حذف جميع
                                            المصروفات</button>
                                    </form>
                                </a></li>
                            <li><a class="dropdown-item" onclick="printTable('table17')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table17')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table17')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table17')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table17')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">تفاصيل للمبالغ المقاول {{ $Workervisour->name }}</h5>

                        <table class="table datatable table-responsive " id="table17">
                            <thead>
                                <tr>
                                    <th>المبلغ</th>
                                    <th>التاريخ</th>
                                    <th class="demoshow">المستلم</th>
                                    <th class="demo">الاجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($Workervisour->payments->count() > 0)
                                @endif
                                @foreach ($Workervisour->payments as $payment)
                                    <tr>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->date }}</td>
                                        <td class="demoshow">{{ $payment->receiver }}</td>
                                        <td class="demo">
                                            <a href="{{ route('Workervisours.editpayment', [$Workervisour->id, $payment->id]) }}"
                                                class="table-btn"><i class="bi bi-pencil-square"></i></a>
                                            <form
                                                action="{{ route('Workervisours.deletepayment', [$Workervisour->id, $payment->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الحساب')"
                                                    class="table-btn"><i class="bi bi-trash"></i></button>
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
                                        <h5 class="modal-title">إضافة مبلغ جديد لهذا المقاول<//h5>
                                    </div>
                                    <div class="modal-body">

                                        <div class="card-body">
                                            <form action="{{ route('Workervisours.addpayment', $Workervisour->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="work">إضافة المبلغ من خلال:</label>
                                                    <div class="col-sm-10">

                                                        <input type="radio" name="workercash" id="from_store" value="cash"> الخزنة
                                                        <input type="radio" name="workercash" id="not_from_store" value="not_store"
                                                            class="mr-4" checked> غير الخزنة
                                                    </div>
                                                </div>
                                                <input type="hidden" value="pull" name="status">

                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="amount" class="form-label">المبلغ</label>
                                                    <div class="col-sm-10">

                                                        <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                                            required>
                                                    </div>
                                                </div>


                                                <div id="storeForm" style="display: none;" class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="description">وصف المبلغ:</label>
                                                    <div class="col-sm-10">

                                                        <textarea class="form-control" name="description" id="description"></textarea>
                                                    </div>

                                                </div>
                                                @error('description')
                                                    <div class="alert alert-danger m-2">{{ $message }}</div>
                                                @enderror


                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="date" class="form-label">التاريخ</label>
                                                    <div class="col-sm-10">

                                                        <input type="date" class="form-control" id="date" name="date" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="receiver" class="form-label">المستلم</label>
                                                    <div class="col-sm-10">

                                                        <input type="text" class="form-control" id="receiver" name="receiver">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">إضافة المصاريف</button>
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
