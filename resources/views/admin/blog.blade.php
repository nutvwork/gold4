@extends('layouts.admin')

@section('content-title')
	แสดงบทความ
@endsection
@section('content')
<div class="table-responsive mt-4">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>หัวข้อ</th>
				<th>คำอธิบาย</th>
				<th>วันที่สร้าง</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@forelse ($blogs as $item)
				<tr>
					<td>{{$item->title}}</td>
					<td>{{str_limit($item->body, 30)}}</td>
					<td>{{dateThTime($item->created_at)}}</td>
					<td>
						<a href="{{route('admin.blog.update', ['id' => $item->id])}}" class="btn btn-sm btn-warning m-btn m-btn--custom m-btn--icon">
							<span>
								<i class="la la-pencil"></i>
								<span>แก้ไข</span>
							</span>
						</a>
						<form class="ml-0 ml-md-4 mt-4 mt-md-0 d-inline-block" action="{{route('admin.blog.delete')}}" method="POST"
						onsubmit="return confirm('ต้องการลบบทความนี้ใช่ หรือไม่')">
							@csrf
							<input type="hidden" name="blog_id" value="{{$item->id}}">
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
					<td class="text-center" colspan="4">ไม่มีบทความ</td>
				</tr>
			@endforelse

		</tbody>
	</table>
</div>
@endsection