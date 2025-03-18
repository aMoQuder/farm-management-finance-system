@extends('layouts.dashboard')

@section('content')
    <section class="section">

        @if (session('massege'))
            <h4 class="alert alert-success text-center">{{ session('massege') }}
            </h4>
        @endif

        <div class="pagetitle">
            <h1>عرض الرسالة</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a>
                    </li>
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرسائل</a>
                    </li>
                    <li class="breadcrumb-item active">عرض الرسالة</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">محتويات الرسالة </h5>


              <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">{{ $contact->name }}</h4>
                <p>
                    {{ $contact->subject }}
                </p>
                <hr>
                <p class="mb-0">
                    {{ $contact->message }}
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>



            </div>
          </div>




    </section>
@endsection

