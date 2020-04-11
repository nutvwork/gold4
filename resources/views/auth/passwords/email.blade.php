@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
		<div class="col-md-6">
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif
			<div class="heading mb-2">
				<h2 class="title">{{ __('Reset Password') }}</h2>
				<p>กรุณากรอกอีเมลที่ใช้สมัคร เพื่อรับรหัสลิงก์ในการเปลี่ยนรหัส</p>
			</div><!-- End .heading -->
			<form method="POST" action="{{ route('password.email') }}">
				@csrf
				<input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" value="{{ old('email') }}" required>
				@if ($errors->has('email'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif

				<div class="form-footer">
					<button type="submit" class="btn btn-primary">รับลิงก์เปลี่ยนรหัสรหัสผ่าน</button>
				</div><!-- End .form-footer -->
			</form>
		</div>
    </div>
</div>
@endsection
