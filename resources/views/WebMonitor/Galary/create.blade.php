@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h5 class="card-title">إضافة جلاري جديد</h5>

        <div class="card-body">
            <form action="{{ route('storeGalary') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-3" placeholder="title" name="title" id="title" required>
                        @error('title')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror
                        <input type="file" name="image" class="form-control mt-3" id="updateImage" onchange=" previewFile()"
                            accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple />
                        @error('image')
                            <div class="alert alert-danger m-2">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-sm-3">
                        <img src="" class="w-100 " id="image_preview" style="height: 200px;" alt="">
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
