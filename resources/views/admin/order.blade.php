@extends('layouts.admin')

@section('content-title')
	ตรวจสอบรายการสั่งซื้อ
@endsection
@section('content')
<div class="table-responsive mt-4">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>เลขที่</th>
				<th>ชื่อ-สกุล</th>
				<th>เบอร์โทรศัพท์</th>
				<th>สถานะ</th>
				<th>วันที่สร้าง</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@forelse ($orders as $item)
				<tr>
					<td class="_vtcal-md">{{$item->id}}</td>
					<td class="_vtcal-md">{{$item->name}}</td>
					<td class="_vtcal-md">{{$item->phone}}</td>
					<td class="_vtcal-md">{{$item->status_text}}</td>
					<td class="_vtcal-md">{{dateThTime($item->created_at)}}</td>
					<td class="_vtcal-md">
						<a href="{{route('admin.order.update', ['id' => $item->id])}}"
						class="btn {{$item->status === 1 ? 'btn-warning' : 'btn-success'}} m-btn m-btn--custom m-btn--icon">
							<span>
								<i class="la la-pencil"></i>
								@if ($item->status === 1)
									<span>ตรวจสอบ</span>
								@else
									<span>แจ้งเลขพัสดุ</span>
								@endif
							</span>
						</a>
					</td>
				</tr>
			@empty
				<tr>
					<td class="text-center" colspan="6">ไม่มีรายการสั่งซื้อ</td>
				</tr>
			@endforelse

		</tbody>
	</table>
</div>
@endsection