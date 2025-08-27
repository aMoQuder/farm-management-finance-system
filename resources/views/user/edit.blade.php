@extends('layouts.dashboard')

@section('content')
    <!--Main container start -->
    <div class="pagetitle">
        <h1>صفحة المستخدم</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item active">المستخدم</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="card">
                    <div class="wc-title">
                        <h4>User Profile</h4>
                    </div>
                    <div class="widget-inner">
                        <form class="edit-profile m-b30" action="{{ route('saveUser') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <div class="form-group row">
                                    <div class="col-sm-10  ml-auto">
                                        <h3>1. Personal Details</h3>
                                    </div>
                                </div>
                                <input type="hidden" name="old_id" value="{{ $user->id }}">
                                <input type="hidden" name="Old_role" value="{{ $user->role }}">
                                <input type="hidden" name="Old_status" value="{{ $user->status }}">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="text" placeholder="Name" name="name"
                                            value="{{ $user->name }}">
                                        @error('name')
                                            <div class="alert alert-danger my-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="seperator"></div>

                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <h3>2. Email</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $user->email }}">
                                        @error('email')
                                            <div class="alert alert-danger my-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <h3 class="m-form__section">3. status and role</h3>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">status</label>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mail-list-info d-flex">
                                                    <div class="checkbox-list">
                                                        <div class="custom-control custom-checkbox checkbox-st1">
                                                            <input type="radio" class="custom-control-input"
                                                                name="status" value="active" id="check3">
                                                            <label class="custom-control-label" for="check3"></label>
                                                        </div>
                                                    </div>
                                                    <div class="mail-rateing ">
                                                        <span><i class="fa fa-star-o"></i></span>
                                                    </div>
                                                    <div class="mail-list-title">
                                                        <h6>active
                                                        </h6>
                                                    </div>



                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mail-list-info d-flex">
                                                    <div class="checkbox-list">
                                                        <div class="custom-control custom-checkbox checkbox-st1">
                                                            <input type="radio" class="custom-control-input"
                                                                name="status" value="block" id="check4">
                                                            <label class="custom-control-label" for="check4"></label>
                                                        </div>
                                                    </div>
                                                    <div class="mail-rateing ">
                                                        <span><i class="fa fa-star-o"></i></span>
                                                    </div>
                                                    <div class="mail-list-title">
                                                        <h6>block
                                                        </h6>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">role</label>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mail-list-info d-flex">
                                                    <div class="checkbox-list">
                                                        <div class="custom-control custom-checkbox checkbox-st1">
                                                            <input type="radio" class="custom-control-input"
                                                                name="role" value="user" id="check1">
                                                            <label class="custom-control-label" for="check1"></label>
                                                        </div>
                                                    </div>
                                                    <div class="mail-rateing ">
                                                        <span><i class="fa fa-star-o"></i></span>
                                                    </div>
                                                    <div class="mail-list-title">
                                                        <h6>user
                                                        </h6>
                                                    </div>



                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mail-list-info d-flex">
                                                    <div class="checkbox-list">
                                                        <div class="custom-control custom-checkbox checkbox-st1">
                                                            <input type="radio" class="custom-control-input"
                                                                name="role" value="admin" id="check2">
                                                            <label class="custom-control-label" for="check2"></label>
                                                        </div>
                                                    </div>
                                                    <div class="mail-rateing ">
                                                        <span><i class="fa fa-star-o"></i></span>
                                                    </div>
                                                    <div class="mail-list-title">
                                                        <h6>admin
                                                        </h6>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <h3>4. Password</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="password" name="password"
                                            value="{{ $user->password }}">
                                        @error('password')
                                            <div class="alert alert-danger my-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-7">
                                    <button type="submit" class="btn">Save changes</button>
                                    <a href="{{ route('home') }}" class="btn-secondry">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- Your Profile Views Chart END-->
        </div>
    </section>
    <div class="ttr-overlay"></div>
@endsection
