@extends('layouts.app')

@section('content')
    @include('temp.navbarApp')
    {{-- ///////////////main\\\\\\\\\\\\\\\\  --}}



	<!-- Contact form -->
	<section class="section-contact bg1-pattern p-t-90 p-b-113">
	
		<div class="container">

            @if (session('success'))
            <h4 class="alert alert-success text-center">{{ session('success') }}</h4>
        @endif
			<h3 class="tit7 t-center p-b-62 p-t-105">
				Send us a Message
			</h3>

			<form class="wrap-form-reservation size22 m-l-r-auto"action="{{route('contactSave')}}" method="post" enctype="multipart/form-data">
                @csrf
				<div class="row">
					<div class="col-md-4">
						<!-- Name -->
						<span class="txt9">
							Name
						</span>

						<div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
							<input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="name" placeholder="Name" required>
						</div>
                        @error('name')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
					</div>

					<div class="col-md-4">
						<!-- Email -->
						<span class="txt9">
							Email
						</span>

						<div class="wrap-inputemail size12 bo2 bo-rad-10 m-t-3 m-b-23">
							<input class="bo-rad-10 sizefull txt10 p-l-20" type="email" required name="email" placeholder="Email">
						</div>
                        @error('email')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
					</div>

					<div class="col-md-4">
						<!-- Phone -->
						<span class="txt9">
							subject
						</span>

						<div class="wrap-inputphone size12 bo2 bo-rad-10 m-t-3 m-b-23">
							<input class="bo-rad-10 sizefull txt10 p-l-20" required type="text" name="subject" placeholder="subject">
						</div>
                        @error('subject')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
					</div>

					<div class="col-12">
						<!-- Message -->
						<span class="txt9">
							Message
						</span>
						<textarea class="bo-rad-10 size35 bo2 txt10 p-l-20 p-t-15 m-b-10 m-t-3" name="message" required placeholder="Message"></textarea>

                        @error('message')
                        <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
					</div>
				</div>

				<div class="wrap-btn-booking flex-c-m m-t-13">
					<!-- Button3 -->
					<button type="submit" class="btn3 flex-c-m size36 txt11 trans-0-4">
						Submit
					</button>
				</div>
			</form>

		</div>
	</section>

    {{-- ///////////////main\\\\\\\\\\\\\\\\  --}}
@endsection
