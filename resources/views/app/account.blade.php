@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-20">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">ข้อมูลส่วนตัว</li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container">
	<div class="row">
		@include('app.components.sidebar-account' , ['routeName' => 'account']   )
		<div class="col-lg-9 order-lg-last dashboard-content">
			<h2>แก้ไขข้อมูล</h2>

			@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="_mg-0">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			@if (session('success'))
				<div class="alert alert-success">
					{{session('success')}}
				</div>
			@endif

			<form action="{{route('account')}}" method="POST">
				@csrf

				<div class="form-group required-field">
					<label for="">ชื่อ-นามสกุล</label>
					<input class="form-control" type="text" name="name" value="{{old('name') ?? $user->name}}" required>
				</div>

				<div class="form-group required-field">
					<label>อีเมล</label>
					<input type="email" class="form-control" name="email" value="{{old('email') ?? $user->email}}" required>
				</div><!-- End .form-group -->

				<div class="form-group required-field">
					<label>เบอร์โทรศัพท์</label>
					<input type="tel" class="form-control" name="phone" value="{{old('phone') ?? $user->phone}}" required>
				</div><!-- End .form-group -->

				<div class="mb-2"></div><!-- margin -->

				<div class="custom-control custom-checkbox _pdl-30">
					<input type="checkbox" name="is_change_password" class="custom-control-input" id="change-pass-checkbox">
					<label class="custom-control-label" for="change-pass-checkbox">เปลี่ยนรหัสผ่าน</label>
				</div><!-- End .custom-checkbox -->

				<div id="account-chage-pass" class="_mgt-20">
					<h3 class="mb-2">เปลี่ยนรหัสผ่าน</h3>
					<div class="form-group required-field">
						<label for="old-pass">รหัสผ่านเดิม</label>
						<input type="password" class="form-control" id="old-pass" name="old_password">
					</div><!-- End .form-group -->

					<div class="form-group required-field">
						<label for="new-pass">รหัสผ่านใหม่</label>
						<input type="password" class="form-control" id="new-pass" name="password">
					</div><!-- End .form-group -->

					<div class="form-group required-field">
						<label for="confirm-pass">ยืนยันรหัสผ่านใหม่</label>
						<input type="password" class="form-control" id="confirm-pass" name="password_confirmation">
					</div><!-- End .form-group -->
				</div><!-- End #account-chage-pass -->

				<div class="form-footer">
					<a href="" class="btn _bgcl-gray _cl-second">ยกเลิก</a>

					<div class="form-footer-right">
						<button type="submit" class="btn btn-secondary">บันทึกข้อมูล</button>
					</div>
				</div><!-- End .form-footer -->
			</form>
		</div><!-- End .col-lg-9 -->
	</div>
</div>
@endsection