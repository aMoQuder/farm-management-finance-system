<!-- machines/show.blade.php -->
@extends('layouts.dashboard')

@section('content')
    {{-- <div class="container"> --}}
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif




    <div class="pagetitle">
        <h1>عرض كل محتويات الزرع</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">تفاصيل زرع {{ $crop->name }}</li>
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


                            <li><a class="dropdown-item" onclick="printTable('table4')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table4')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table4')">
                                    تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table4')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table4')">
                                    تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title"> عرض بعض التفاصيل لهذا الزرع</h5>

                        <table class="table datatable table-responsive table-dark " id="table4">

                            <thead>
                                <tr>
                                    <th>الارض </th>
                                    <th>الزرع </th>
                                    <th>العامل المشرف </th>
                                    <th>الكمية</th>
                                    <th>سعر الطن</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">تاريخ الزراعة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $land->name }}</td>
                                    <td>{{ $crop->name }}</td>
                                    <td>
                                        @foreach ($workers as $worker)
                                            @if ($worker->id == $land->supervisor_id)
                                                {{ $worker->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $crop->seed_quantity }} طن </td>
                                    <td>{{ $crop->seed_price }} جنية</td>
                                    <td>{{ $crop->seed_acquired_date }}</td>


                                </tr>
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


                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" id="fertilizer"> اضافة جديد</a>
                            </li>
                            <li><a class="dropdown-item">
                                    <form action="{{ route('crops.deleteAllFertilizer', $crop->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('هل أنت متأكد من حذف جميع الاسمدة؟')">حذف جميع
                                            الاسمدة</button>
                                    </form>


                                </a></li>



                            <li><a class="dropdown-item" onclick="printTable('table5')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table5')"> تحويل
                                    الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table5')">
                                    تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table1')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table5')">
                                    تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">عرض جميع الاسمدة الذي تخص هذا الزرع</h5>

                        <table class="table datatable table-responsive " id="table5">
                            <thead>
                                <tr>
                                    <th>اسم السماد</th>
                                    <th>الكمية</th>
                                    <th class="demoshow" data-type="date" data-format="YYYY/DD/MM">تاريخ التسميد</th>
                                    <th class="demo">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($crop->FertilizerCrop as $fertilize)
                                    <tr>
                                        <td>{{ $fertilize->name }}</td>
                                        <td>{{ $fertilize->quantity }} {{ $fertilize->type_quantity }}</td>
                                        <td class="demoshow">{{ $fertilize->acquired_date }}</td>

                                        <td class="demo">

                                            <a href="{{ route('crops.editFertilizer', [$fertilize->Fertilizerable_id, $fertilize->id]) }}"
                                                class="table-btn"><i class="bi bi-pencil-square"></i></a>
                                            <form
                                                action="{{ route('crops.deleteFertilizer', [$fertilize->Fertilizerable_id, $fertilize->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="10" name="id_session">
                                                <button type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا السماد انت ستحذفه من كل شئ له علاقة بهذا السماد')"class="table-btn"><i
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


                            <li><a class="dropdown-item" data-bs-toggle="modal" id="MachineJob" data-bs-target="#largeModal"> اضافة
                                    جديد</a></li>
                            <li><a class="dropdown-item" href="">
                                    <form action="{{ route('crops.deleteAllMachineJob', $crop->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('هل أنت متأكد من حذف جميع شغل الالات ؟')">حذف
                                            جميع شغل الالات</button>
                                    </form>
                                </a></li>
                            <li><a class="dropdown-item" onclick="printTable('table6')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table6')">
                                    تحويل الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table6')">
                                    تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table1')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table6')">
                                    تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">عرض جميع شغل الالات الذي تخص هذا الزرع</h5>

                        <table class="table datatable table-responsive" id="table6">
                            <thead>
                                <tr>
                                    <th>الالة </th>
                                    <th>نوع الشغل </th>
                                    <th>السواق</th>
                                    <th>عدد الافدنة</th>
                                    <th class="demoshow">يوم الشغل </th>
                                    <th class="demo">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($crop->MachineJobCrop as $machine)
                                    <tr>
                                        <td>{{ $machine->machine_name }}</td>
                                        <td>{{ $machine->Work_name }}</td>
                                        <td>
                                            @foreach ($workers as $worker)
                                                @if ($worker->id == $machine->driver_id)
                                                    {{ $worker->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $machine->Count_hour }} فدان</td>
                                        <td class="demoshow">{{ $machine->Work_day }}</td>

                                        <td class="demo">

                                            <a href="{{ route('crops.editMachineJob', [$machine->MachineJobable_id, $machine->id]) }}"
                                                class="table-btn"><i class="bi bi-pencil-square"></i></a>
                                            <form
                                                action="{{ route('crops.deleteMachineJob', [$machine->MachineJobable_id, $machine->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="10" name="id_session">
                                                <button type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الشغل   انت ستحذفه من كل شئ له علاقة بهذالشغل')"
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


            <div class="col-lg-12">
                <div class="card  recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>اعدادت اخرى</h6>
                            </li>

                            <li><a class="dropdown-item" id="Workergruop" data-bs-toggle="modal" data-bs-target="#largeModal"> اضافة
                                    جديد</a></li>

                            <li><a class="dropdown-item" href="">
                                    <form action="{{ route('crops.deleteAllWorkerGroup', $crop->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('هل أنت متأكد من حذف جميع شغل العمال ؟')">حذف
                                            جميع شغل العمال</button>
                                    </form>
                                </a></li>
                            <li><a class="dropdown-item" onclick="printTable('table7')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table7')">
                                    تحويل الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table7')">
                                    تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table7')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table7')">
                                    تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">عرض جميع شغل العمال الذي تخص هذا الزرع</h5>

                        <table class="table datatable table-responsive " id="table7">
                            <thead>
                                <tr>
                                    <th>اسم المقاول</th>
                                    <th>عدد الشغل </th>
                                    <th>سعر </th>
                                    <th>الشغل</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">يوم الشغل</th>
                                    <th>حساب الشغل</th>
                                    <th class="demoshow">الزرع</th>
                                    <th class="demo">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($crop->WorkerGroupCrop as $WorkerGroup)
                                    <tr>
                                        <td>

                                            @foreach ($Workervisours as $Workervisour)
                                                @if ($Workervisour->id == $WorkerGroup->supervisor_id)
                                                    <a href="{{ route('displaysupervisor', $Workervisour->id) }}">
                                                        {{ $Workervisour->name }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $WorkerGroup->worker_count }}{{ $WorkerGroup->type_work }}</td>
                                        <td>{{ $WorkerGroup->daily_wage }}</td>
                                        <td>{{ $WorkerGroup->work }}</td>
                                        <td>{{ $WorkerGroup->work_date }}</td>
                                        <td>{{ $WorkerGroup->worker_count * $WorkerGroup->daily_wage }}</td>
                                        <td class="demoshow">
                                            {{ $crop->name }}
                                        </td>

                                        <td class="demo">


                                            <form
                                                action="{{ route('crops.editWorkerGroupsupervisor', [$WorkerGroup->WorkerGroupable_id, $WorkerGroup->id]) }}"
                                                method="post" style="display: inline-block;"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="sessionBage">
                                                <button type="submit"class="table-btn"><i
                                                        class="bi bi-pencil-square"></i></button>
                                            </form>

                                            <form
                                                action="{{ route('crops.deleteWorkerGroup', [$WorkerGroup->WorkerGroupable_id, $WorkerGroup->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="10" name="id_session">
                                                <button type="submit" class="table-btn"
                                                    onclick="return confirm('هل أنت متأكد من حذف شغل العمال لهذا الزرع')">
                                                    <i class="bi bi-trash"></i></button>
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


    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="card-body">
                        <div class="fertilizer-crop" id="fertilizer">

                            <h2>إضافة سماد جديد</h2>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="work">إضافة سماد من
                                    خلال:</label>
                                <div class="col-sm-10">

                                    <input type="radio" name="type_work" id="from_store" value="store"> المخزن
                                    <input type="radio" name="type_work" id="not_from_store" value="not_store"
                                        class="mr-4" checked> غير
                                    المخزن
                                </div>
                            </div>
                            <!-- Form for adding fertilizer not from store -->
                            <form id="notStoreForm" action="{{ route('fertilizerStore') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="name">اسم
                                        السماد:</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" name="name" id="name"
                                            required>
                                    </div>

                                </div>
                                <input type="hidden" name="crop_id" value="{{ $crop->id }}">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="quantity">الكمية:</label>
                                    <div class="col-sm-10">

                                        <input type="number" class="form-control" name="quantity"
                                            id="quantity_not_store" required>
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <label class="col-sm-2 col-form-label" for="type_quantity"> نوع
                                        الكمية:</label>
                                    <div class="col-sm-10">

                                        <select name="type_quantity" class="form-control">
                                            <option value="كيس">بالكياس</option>
                                            <option value="كرتونة">بالكراتين</option>
                                            <option value="لتر">باللتر</option>
                                            <option value="شكارة">شكاير</option>
                                        </select>
                                        @error('type_quantity')
                                            <div class="alert alert-danger m-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="date_received">تاريخ
                                        الحصول على
                                        السماد:</label>
                                    <div class="col-sm-10">

                                        <input type="date" class="form-control" name="acquired_date"
                                            id="acquired_date_not_store" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">إضافة</button>
                            </form>

                            <!-- Form for adding fertilizer from store -->
                            <form id="storeForm" action="{{ route('fertilizer.storeFromStore') }}" method="POST"
                                enctype="multipart/form-data" style="display: none;">

                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="name">اختر سماد من
                                        المخزن:</label>
                                    <div class="col-sm-10">

                                        <select name="name" class="form-control" id="storeSelect">
                                            <option value="">اختر السماد</option>
                                            @foreach ($stores as $store)
                                                @if ($store->type_store == 'سماد')
                                                    <option value="{{ $store->id }}" data-price="{{ $store->price }}"
                                                        data-quantity="{{ $store->quantity }}">
                                                        {{ $store->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="land_id" value="{{ $land->id }}">
                                <input type="hidden" name="crop_id" value="{{ $crop->id }}">
                                <input type="hidden" name="price" id="price_from_store" value="">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="quantity">الكمية:</label>
                                    <div class="col-sm-10">

                                        <input type="number" class="form-control" name="quantity"
                                            id="quantity_from_store" required>
                                    </div>
                                    <small id="quantity_error" class="text-danger" style="display: none;">الكمية المدخلة
                                        أكبر من
                                        المتاحة.</small>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="getter_name">المستلم
                                        :</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" name="getter_name" id="getter_name"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label class="col-sm-2 col-form-label" for="type_quantity"> نوع
                                        الكمية:</label>
                                    <div class="col-sm-10">

                                        <select name="type_quantity" class="form-control">
                                            <option value="كيس">بالكياس</option>
                                            <option value="كرتونة">بالكراتين</option>
                                            <option value="لتر">باللتر</option>
                                            <option value="شكارة">شكاير</option>
                                        </select>
                                        @error('type_quantity')
                                            <div class="alert alert-danger m-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="date_received">تاريخ
                                        الحصول على
                                        السماد:</label>
                                    <div class="col-sm-10">

                                        <input type="date" class="form-control" name="acquired_date"
                                            id="acquired_date_from_store" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">إضافة</button>
                            </form>
                        </div>


                        <div class="MachineJob-crop"  id="MachineJob">

                            <h2>إضافة شغل آلة جديد</h2>
                            <form action="{{ route('MachineJobStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="machine_name">اسم
                                        الآلة:</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" name="machine_name" id="machine_name"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="Count_hour"> عدد
                                        الافدنة:</label>
                                    <div class="col-sm-10">

                                        <input type="number" class="form-control" name="Count_hour" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="Work_name"> نوع
                                        الشغل:</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" name="Work_name" id="machine_name"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="worker_id">اسم العامل الذي
                                        يقود الآلة:</label>
                                    <div class="col-sm-10">

                                        <select name="driver_id" class="form-control" required>
                                            @foreach ($workers as $worker)
                                                <option value="{{ $worker->id }}">{{ $worker->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="date">يوم الشغل
                                        :</label>
                                    <div class="col-sm-10">

                                        <input type="date" class="form-control" name="Work_day" id="Work_day"
                                            value="" required>
                                    </div>
                                </div>

                                <input type="hidden" name="crop_id" value="{{ $crop->id }}">



                                <button type="submit" class="btn btn-primary">إضافة</button>
                            </form>
                        </div>


                        <div class="Workergruop-crop" id="Workergruop">

                            <h2>إضافة شغل عمال جديد</h2>
                            <form action="{{ route('WorkerGroupStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($Workervisours->count() > 0)
                                    <div class="row mb-3">

                                        <label class="col-sm-2 col-form-label" for="person_name">اسم
                                            المقاول:</label>
                                        <div class="col-sm-10">

                                            <select name="supervisor_id" class="form-control">
                                                @foreach ($Workervisours as $Workervisour)
                                                    <option value="{{ $Workervisour->id }}">
                                                        {{ $Workervisour->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="person_name">اسم
                                        الشخص:</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" name=" person_name" id="person_name"
                                            required>
                                    </div>
                                </div>
                                <input type="hidden" name="crop_id" value="{{ $crop->id }}">


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="work"> الشغل :</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" name=" work" id="work"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="work"> نوع حساب الشغل
                                        :</label>
                                    <div class="col-sm-10">

                                        <input type="radio" name="type_work" value="يومية" checked>يومية
                                        <input type="radio" name="type_work" class="mr-4" value="جامبو">جامبو
                                        <input type="radio" name="type_work" class="mr-4" value="فدان">فدان
                                        <input type="radio" name="type_work" class="mr-4" value="شكارة">شكارة
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="worker_count">عدد العمال
                                        او الافدنة او
                                        الجامبوهات او الشكاير :</label>
                                    <div class="col-sm-10">

                                        <input type="number" class="form-control" name="worker_count" id="worker_count"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="daily_wage">اليومية او سعر
                                        الجامبو او الشيكارة
                                        :</label>
                                    <div class="col-sm-10">

                                        <input type="number" class="form-control" name="daily_wage" id="daily_wage"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="work_date">يوم
                                        الشغل:</label>
                                    <div class="col-sm-10">

                                        <input type="date" class="form-control" name="work_date" id="work_date"
                                            required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">إضافة</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div><!-- End Large Modal-->
@endsection
