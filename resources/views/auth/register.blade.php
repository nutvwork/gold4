@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<div class="heading text-center">
				<h2 class="title">สมัครสมาชิก เพื่อซื้อสินค้า</h2>
				<p>กรุณากรอกข้อมูลให้ครบถ้วน</p>
			</div><!-- End .heading -->

			<form method="POST" action="{{ route('register') }}">
				@csrf

				<div class="form-group row">
					<label for="name" class="col-md-4 col-form-label text-md-right">ชื่อ-นามสกุล</label>
					<div class="col-md-6">
						<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

						@if ($errors->has('name'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('อีเมล') }}</label>
					<div class="col-md-6">
						<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

						@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('เบอร์โทรศัพท์') }}</label>
					<div class="col-md-6">
						<input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

						@if ($errors->has('phone'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('phone') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>
					<div class="col-md-6">
						<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

						@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="password-confirm" class="col-md-4 col-form-label text-md-right">ยืนยันรหัสผ่าน</label>

					<div class="col-md-6">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
					</div>
				</div>

				<div class="form-footer row mb-0">
					<div class="col-md-6 offset-md-4">
						<button type="submit" class="btn btn-primary">
							{{ __('ลงทะเบียน') }}
						</button>
						<a class="forget-pass" href="{{ route('login') }}">
							{{ __('หรือเข้าสู่ระบบ') }}
						</a>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>
@endsection
