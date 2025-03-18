<!-- resources/views/workers/show.blade.php -->
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
                <li class="breadcrumb-item ">الموظفين</li>
                <li class="breadcrumb-item active">تفاصيل {{$worker->name}} {{$worker->job}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="/assets/img/profile-img.png" alt="Profile" class="rounded-circle">
                    <h2>{{ $worker->name }}</h2>
                    <h3>{{ $worker->job }}</h3>
                    <div class="social-links mt-2">
                      <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <h2> المرتب :{{ $worker->salary }} </h2>
                    <h3> عدد ايام العمل : {{ $worker->work_days}}</h3>
                    {{-- <h2>{{ $allexpen}} :كل المصاريف</h2> --}}
                    <h2>المبلغ المتبقي :{{ $diffsalary }} </h2>

                  </div>
                </div>

              </div>

          <div class="col-xl-8">
            <div class="card  recent-sales overflow-auto">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>اعدادت اخرى</h6>
                        </li>


                        <li><a class="dropdown-item">

                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"> اضافة جديد</a>
                        </li>

                        <form action="{{ route('workers.deleteAllExpenses', $worker->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item"
                                onclick="return confirm('هل أنت متأكد من حذف جميع المصروفات؟')">حذف جميع
                                المصروفات</button>
                        </form>
                        </a></li>
                        <li><a class="dropdown-item" onclick="printTable('table19')"> طباعة</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPDF('table19')"> تحويل
                                الى
                                pdf </a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportExcel('table19')"> تحويل
                                الى exel </a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportPowerPoint('table19')">
                                تحويل الى powerpoint </a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="exportWord('table19')"> تحويل
                                الى word </a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">جميع المصاريف المستخدمة لصالح الموظف</h5>

                    <table class="table datatable table-responsive " id="table19">
                        <thead>
                            <tr>
                                <th>المبلغ</th>
                                <th>التاريخ</th>
                                <th>السبب</th>
                                <th>الاجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($worker->expenses->count() > 0)
                            @endif
                            @foreach ($worker->expenses as $expense)
                                <tr>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->date }}</td>
                                    <td>{{ $expense->reason }}</td>
                                    <td>
                                        <a href="{{ route('workers.editExpense', [$worker->id, $expense->id]) }}"
                                            class="table-btn"><i class="bi bi-pencil-square"></i></a>
                                        <form
                                            action="{{ route('workers.deleteExpense', [$worker->id, $expense->id]) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا المصروف؟')"
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
                                    <h5 class="modal-title">إضافة مصاريف جديدة</ /h5>
                                </div>
                                <div class="modal-body">

                                    <div class="card-body">
                                        <form action="{{ route('workers.addExpense', $worker->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="type_store"> اضافة المصاريف من خلال </label>
                                                <div class="col-sm-10">

                                                    <select name="workercash" class="form-control">
                                                        <option value="cash">الخزنة</option>
                                                        <option value="nocash" selected>غير الخزنة</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" value="pull" name="status">


                                            <input type="hidden" name="workername" value="{{ $worker->name }}">
                                            <div class="row mb-3">
                                              <label class="col-sm-2 col-form-label" for="amount" class="form-label">المبلغ</label>
                                                <div class="col-sm-10">

                                                    <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                                        required>
                                                        @error('amount')
                                                        <div class="alert alert-danger m-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" value="pull" name="status">

                                            <div class="row mb-3">
                                              <label class="col-sm-2 col-form-label" for="date" class="form-label">التاريخ</label>
                                                <div class="col-sm-10">

                                                    <input type="date" class="form-control" id="date" name="date" required>
                                                    @error('date')
                                                    <div class="alert alert-danger m-2">{{ $message }}</div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                              <label class="col-sm-2 col-form-label" for="reason" class="form-label">السبب</label>
                                                <div class="col-sm-10">

                                                    <input type="text" class="form-control" id="reason" name="reason">
                                                    @error('reason')
                                                    <div class="alert alert-danger m-2">{{ $message }}</div>
                                                @enderror
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
