@extends('layouts.app')

@section('content')
<div class="container my-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="heading">
				<h2 class="title">เข้าสู่ระบบ หรือ <a href="{{ route('register') }}">สมัครสมาชิกเพื่อซื้อสินค้า</a></h2>
			</div><!-- End .heading -->

			<form method="POST" action="{{ route('login') }}">
				@csrf

				<div class="form-group">
					<input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" value="{{old('email')}}" required>
					@if ($errors->has('email'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				</div>


				<div class="form-footer">
					<button type="submit" class="btn btn-secondary">เข้าสู่ระบบ</button>
					<a href="{{ route('register') }}">
						สมัครสมาชิก
					</a>
				</div><!-- End .form-footer -->


				<div class="mb-3">หรือ</div>

				@if (Route::has('password.request'))
					<a class="forget-pass" href="{{ route('password.request') }}">
						ลืมรหัสผ่าน ?
					</a>
				@endif
			</form>
		</div><!-- End .col-md-6 -->
	</div>
</div>
@endsection
