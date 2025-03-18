@extends('layouts.dashboard')

@section('content')


<div class="card">
    <h5 class="card-title">تعديل الجلاري </h5>

    <div class="card-body">
        <form action="{{ route('updateGalary') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="old_id" value="{{ $Galary->id }}">
            <input type="hidden" name="old_img" value="{{ $Galary->image }}">
            <div class="row mb-3">
                <div class="col-sm-9">
                    <input type="text" class="form-control  " name="title" value="{{$Galary->title}}" id="title" required>
                    @error('title')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror

                    <input type="file"  class="form-control mt-5"  name="image" id="updateImage" onchange=" previewFile()"
                        accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple />
                    @error('image')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-sm-3">
                    <img src="{{asset('Galary/img/'.$Galary->image)}}" class="w-100 mb-2" id="image_preview" style="height: 200px;" alt="">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-primary" value="اضافة" required>
                </div>
            </div>
        </form>
    </div>
</div>






@endsection
