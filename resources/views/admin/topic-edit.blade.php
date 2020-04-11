@extends('layouts.admin')

@section('content-title')
	แก้ไขหมวดหมู่
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
<form action="{{route('admin.topic.update')}}" method="POST">
	@csrf
	<input type="hidden" name="id" value="{{$topic->id}}">
	<div class="form-group">
		<label>ชื่อหมวดหมู่</label>
		<input type="text" name="name" class="form-control" value="{{$topic->name}}">
	</div>
	<div class="form-group">
		<button class="btn btn-success px-5 mr-4">บันทึก</button>
		<a href="{{route('admin.topic')}}" class="btn btn-secondary">ยกเลิก</a>
	</div>
</form>
@endsection