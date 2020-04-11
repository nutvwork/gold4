@extends('layouts.admin')

@section('content-title')
	แสดงสินค้า
@endsection
@section('content')
<div class="table-responsive mt-4">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ชื่อสินค้า</th>
				<th>รหัสสินค้า</th>
				<th>วันที่สร้าง</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@forelse ($products as $item)
				<tr>
					<td>{{$item->name}}</td>
					<td>{{$item->sku}}</td>
					<td>{{dateThTime($item->created_at)}}</td>
					<td>
						<a href="{{route('admin.product.update', ['id' => $item->id])}}" class="btn btn-sm btn-warning m-btn m-btn--custom m-btn--icon">
							<span>
								<i class="la la-pencil"></i>
								<span>แก้ไข</span>
							</span>
						</a>
						<form class="ml-0 ml-md-4 mt-4 mt-md-0 d-inline-block" action="{{route('admin.product.delete')}}" method="POST"
						onsubmit="return confirm('ต้องการลบสินค้าใช่ หรือไม่')">
							@csrf
							<input type="hidden" name="product_id" value="{{$item->id}}">
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

	{{$products->links()}}
</div>
@endsection