@extends('layouts.admin')

@section('content-title')
	แก้ไขบทความ
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

<form action="{{route('admin.blog.update')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="blog_id" value="{{$blog->id}}">
	<div class="form-group">
		<label>หัวข้อบทความ</label>
		<input type="text" name="title" class="form-control" value="{{old('title') ?? $blog->title}}">
	</div>
	<div class="form-group">
		<label>หัวข้อบทความ</label>
		<input id="customFile" type="file" name="cover" accept="image/*" class="form-control">
	</div>
	<div class="form-group">
		<img id="view" class="img-fluid" src="{{$blog->cover_full}}">
	</div>
	<div class="form-group">
		<label>คำอธิบาย</label>
		<textarea class="form-control" name="body" rows="30">{{old('title') ?? $blog->body}}</textarea>
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