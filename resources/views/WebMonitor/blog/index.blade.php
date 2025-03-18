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
        <h1>عرض جميع المدونات</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">المدونات </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">


                <!-- Card with an image on left -->
                @foreach ($blogs as $blog)
                    <div class="card mb-3">



                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('blog/img/' . $blog->image) }}" class="img-fluid rounded-start w-100"
                                    alt="..." style="height:180px;  ">
                            </div>
                            <div class="col-md-8">
                                <div class="filter filter-blog">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">


                                        <li><a class="dropdown-item" href="{{ route('deletblog', $blog->id) }}">حذف</a></li>
                                        <li><a class="dropdown-item" href="{{ route('updateblog', $blog->id) }}">تعديل</a></li>


                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog->title }}</h5>
                                    <p class="card-text">
                                        {{ $blog->description }}.</p>
                                </div>
                            </div>
                        </div>

                    </div><!-- End Card with an image on left -->
                @endforeach
            </div>



        </div>
    </section>




    {{-- -----------------------end code ------------------------- --}}
@endsection
