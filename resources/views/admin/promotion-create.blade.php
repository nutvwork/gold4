@extends('layouts.admin')

@section('content-title')
	สร้างโปรโมชั่น
@endsection
@section('content')
@if(session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>
@endif

@if ($errors->any())
	<div class="alert alert-danger">
		<ul class="_mgbt-0">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<form action="{{route('admin.promotion.create')}}" method="POST" enctype="multipart/form-data">
	@csrf

	<div class="form-group">
		<label>ลิงก์</label>
		<input type="text" class="form-control" name="url">
	</div>
	<div class="form-group">
		<label>เลือกรูปภาพ</label>
		<input id="customFile" type="file" name="image" class="form-control" readonly>
		<small>ขนาดไม่เกิน 350x180 px</small>
	</div>

	<img class="img-fluid" id="view">

	<div class="form-group mt-5">
		<button class="btn btn-success px-5 mr-4">บันทึก</button>
		<a href="{{route('admin.promotion')}}" class="btn btn-secondary">ยกเลิก</a>
	</div>
</form>
@endsection

@section('main.script')
	<script>
		$(document).ready(function() {
			bindFileInputImage(
				document.querySelector('#customFile'),
				document.querySelector('#view')
			)
		})
	</script>
@endsection