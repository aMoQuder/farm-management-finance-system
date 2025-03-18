@extends('layouts.dashboard')

@section('content')
    {{-- -----------------------start code ------------------------- --}}


    @if (session('massege'))
        <h4 class="alert alert-success text-center">{{ session('massege') }}</h4>
    @endif
    @if (session('delete'))
    <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
@endif




    <div class="pagetitle">
        <h1>عرض جميع الجلاري</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">الجلاري </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row align-items-top">
            @foreach ($Galarys as $Galary)
            <div class="col-lg-3">


                <!-- Card with an image on left -->


                    <div class="card mb-3">


                        <div class="filter filter-Galary" >
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li><a class="dropdown-item" href="{{ route('deletGalary', $Galary->id) }}">حذف</a></li>
                                <li><a class="dropdown-item" href="{{ route('editGalary', $Galary->id) }}">تعديل</a></li>

                            </ul>
                        </div>


                        <img src="{{ asset('Galary/img/' . $Galary->image) }}" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{ $Galary->title }}</h5>
                        </div>

                    </div>
            </div>

            @endforeach
        </div><!-- End Card with an image on left -->
        </div>



        </div>
    </section>




    {{-- -----------------------end code ------------------------- --}}
@endsection
