@extends('layouts.admin')

@section('content-title')
	สร้างบทความ
@endsection
@section('content')
@if ($errors->any())
	<div class="alert alert-danger">
		<ul class="_mgbt-0">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<form action="{{route('admin.blog.create')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label>หัวข้อบทความ</label>
		<input type="text" name="title" class="form-control" required>
	</div>
	<div class="form-group">
		<label>รูปภาพ</label>
		<input id="customFile" type="file" name="cover" accept="image/*" class="form-control" required>
		<div class="_fs-14 _mgt-2">ขนาดแนะนำ 1200 x 500 px</div>
	</div>
	<div class="form-group">
		<img id="view" class="img-fluid">
	</div>
	<div class="form-group">
		<label>คำอธิบาย</label>
		<textarea class="form-control" name="body" rows="30" required></textarea>
	</div>
	<div class="form-group">
		<button class="btn btn-success px-5 mr-4">บันทึก</button>
		<a href="{{route('admin.blog')}}" class="btn btn-secondary">ยกเลิก</a>
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