@extends('layouts.dashboard')

@section('content')
    @if (session('massage'))
        <h4 class="alert alert-success text-center">{{ session('massage') }}</h4>
    @endif
    @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif


    <div class="pagetitle">
        <h1>عرض جميع الاسمدة</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">الاسمدة</li>
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


                            <li><a class="dropdown-item" href="{{ route('createFertilizer') }}">اضافة جديد</a></li>
                            <li><a class="dropdown-item" onclick="printTable('table9')"> طباعة</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table9')"> تحويل الى
                                    pdf </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table9')"> تحويل
                                    الى exel </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table9')">
                                    تحويل الى powerpoint </a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table9')"> تحويل
                                    الى word </a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">جميع الاسمدة المستهلكة لصالح الشركة</h5>

                        <table class="table datatable table-responsive " id="table9">
                            <thead>
                                <tr>
                                    <th>اسم السماد</th>
                                    <th>الكمية</th>
                                    <th>الزرع</th>
                                    <th>الارض</th>
                                    <th class="demoshow">تاريخ التسميد</th>
                                    <th class="demo">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($FertilizerCrop as $fertilize)
                                    <tr>
                                        <td>{{ $fertilize->name }}</td>
                                        <td>{{ $fertilize->quantity }} {{$fertilize->type_quantity }}</td>
                                        <td >
                                            @foreach ($crops as $crop)
                                            @if ($fertilize->Fertilizerable_id == $crop->id)
                                            {{ $crop->name }}
                                                @endif
                                                @endforeach

                                            </td>
                                        <td>{{ $fertilize->landFertilizer->name }}</td>
                                            <td class="demoshow"> {{ $fertilize->acquired_date}}</td>

                                        <td class="demo">

                                            <a href="{{ route('crops.editFertilizer', [$fertilize->Fertilizerable_id, $fertilize->id]) }}"
                                                class="table-btn"><i
                                                class="bi bi-pencil-square"></i></a>
                                            <form
                                                action="{{ route('crops.deleteFertilizer', [$fertilize->Fertilizerable_id, $fertilize->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="10" name="id_session">
                                                <button type="submit"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا السماد انت ستحذفه من كل شئ له علاقة بهذا السماد')" class="table-btn"><i
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
