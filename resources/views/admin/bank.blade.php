@extends('layouts.admin')

@section('content-title')
	แสดงธนาคาร
@endsection
@section('content')
@if(session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>
@endif
<div class="table-responsive mt-4">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ธนาคาร</th>
				<th>ชื่อบัญชี</th>
				<th>เลขที่บัญชี</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@forelse ($banks as $item)
				<tr>
					<td>{{$item->bank_name}}</td>
					<td>{{$item->account_name}}</td>
					<td>{{$item->account_no}}</td>
					<td>
						<a href="{{route('admin.bank.update', ['id' => $item->id])}}" class="btn btn-sm btn-warning m-btn m-btn--custom m-btn--icon">
							<span>
								<i class="la la-pencil"></i>
								<span>แก้ไข</span>
							</span>
						</a>
					</td>
				</tr>
			@empty
				<tr>
					<td class="text-center" colspan="4">ยังไม่ได้เพิ่ม ธนาคาร</td>
				</tr>
			@endforelse

		</tbody>
	</table>
</div>
@endsection