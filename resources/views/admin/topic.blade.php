@extends('layouts.admin')

@section('content-title')
	แสดงหมวดหมู่
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
<div class="table-responsive mt-4">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ชื่อหมวดหมู่</th>
				<th>วันที่สร้าง</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@forelse ($topics as $item)
				<tr>
					<td>{{$item->name}}</td>
					<td>{{dateThTime($item->created_at)}}</td>
					<td>
						<a href="{{route('admin.topic.update', ['id' => $item->id])}}" class="btn btn-sm btn-warning m-btn m-btn--custom m-btn--icon">
							<span>
								<i class="la la-pencil"></i>
								<span>แก้ไข</span>
							</span>
						</a>
						<form class="ml-0 ml-md-4 mt-4 mt-md-0 d-inline-block" action="{{route('admin.topic.delete')}}" method="POST" onsubmit="return confirm('**สินค้าทั้งหมดในหมวดหมู่นี้จะย้ายไปอยู่หมวดหมู่อื่น ต้องการลบหมวดหมู่ใช่ หรือไม่')">
							@csrf
							<input type="hidden" name="topic_id" value="{{$item->id}}">
							<button type="submit" class="btn btn-sm btn-danger m-btn m-btn--custom m-btn--icon">
								<span>
									<i class="la la-trash"></i>
									<span>ลบ</span>
								</span>
							</button>
						</form>

					</td>
				</tr>
			@empty
				<tr>
					<td class="text-center" colspan="4">ไม่มีสินค้า</td>
				</tr>
			@endforelse

		</tbody>
	</table>
</div>
@endsection