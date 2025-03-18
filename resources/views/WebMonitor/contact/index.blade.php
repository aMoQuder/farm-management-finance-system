@extends('layouts.dashboard')

@section('content')
    <section class="section">

        @if (session('massege'))
            <h4 class="alert alert-success text-center">{{ session('massege') }}
            </h4>
        @endif
        @if (session('delete'))
        <h4 class="alert alert-danger text-center">{{ session('delete') }}</h4>
    @endif

        <div class="pagetitle">
            <h1>عرض جميع راسائل</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a>
                    </li>
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active">راسائل </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">عرض كل راسائل الموقع</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">الاسم</th>
                            <th scope="col">الايميل</th>
                            <th scope="col">الموضوع</th>
                            <th scope="col">الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($contacts as $contact)
                            <tr>
                                <td>
                                    {{ $contact->name }}
                                </td>
                                <td>
                                    {{ $contact->email }}
                                </td>
                                <td>
                                    {{ $contact->subject }}
                                </td>

                                <td>

                                    <a href="{{ route('deletContact', $contact->id) }} " class="table-btn"><i
                                            class="bi bi-trash"></i></a>
                                    <a href=" {{ route('showContact', $contact->id) }}" class="table-btn"><i
                                            class="bi bi-eye-slash"></i></a>
                                </td>




                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>





    </section>
@endsection
