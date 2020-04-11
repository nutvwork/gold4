@extends('layouts.admin')

@section('content-title')
	ตรวจสอบรายการสั่งซื้อ
@endsection
@section('content')
<div class="m-invoice-2">
	<div class="m-invoice__wrapper">
		<div class="m-invoice__head">
			<div class="m-invoice__container m-invoice__container--centered">
				<div class="m-invoice__logo _pdv-30">
					<a href="#">
						<h1>INVOICE</h1>
					</a>
					<a href="#">
						<img src="{{asset("app/images/logos/logo-bg-white-cl.jpg")}}" width="100px">
					</a>
				</div>
				<div class="m-invoice__items">
					<div class="m-invoice__item">
						<span class="m-invoice__subtitle">วันที่สั่งซื้อ</span>
						<span class="m-invoice__text">{{dateTh($order->created_at)}}</span>
					</div>
					<div class="m-invoice__item">
						<span class="m-invoice__subtitle">เลขที่ใบเสร็จ</span>
						<span class="m-invoice__text">#{{$order->id}}</span>
					</div>
					<div class="m-invoice__item">
						<span class="m-invoice__subtitle">ที่อยู่ในการส่งสินค้า: </span>
						<span>ชื่อ: {{$order->name}}</span>
						<span>ที่อยู่: {{$order->address1}} {{$order->address2}}</span>
						<span>อำเภอ: {{$order->amphoe}}</span>
						<span>จังหวัด: {{$order->provinceData->name}}</span>
						<span>เบอร์โทร: {{$order->phone}}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="m-invoice__body m-invoice__body--centered">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>รหัสสินค้า</th>
							<th>ชื่อสินค้า</th>
							<th>น้ำหนัก</th>
							<th>จำนวน</th>
							<th>ราคา</th>
							<th>รวม</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($order->details as $item)
							<tr>
								<td>{{$item->product->sku}}</td>
								<td>{{$item->product->name}}</td>
								<td>{{$item->weight_text}} {{$item->weight_type}}</td>
								<td>{{$item->quantity}}</td>
								<td>{{number_format($item->price, 2)}}</td>
								<td>{{number_format($item->subtotal_order, 2)}}</td>
							</tr>
						@empty
							<tr>
								<td class="text-center" colspan="6">ไม่มีรายการสั่งซื้อ</td>
							</tr>
						@endforelse
						<tr>
							<td colspan="4"></td>
							<td class="_tal-r">รวม</td>
							<td class="_tal-r">{{number_format($order->total, 2)}}</td>
						</tr>
						<tr>
							<td colspan="4"></td>
							<td class="_tal-r">ค่าส่ง</td>
							<td class="_tal-r">{{number_format($order->shipping_price, 2)}}</td>
						</tr>
						<tr>
							<td colspan="4"></td>
							<td class="_tal-r">ยอดสุทธิ</td>
							<td class="_tal-r">{{number_format($order->total + $order->shipping_price, 2)}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="m-invoice__footer">
			<div class="m-invoice__table m-invoice__table--centered table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>ชื่อธนาคาร</th>
							<th>วันที่โอน</th>
							<th>ยอดแจ้งโอน</th>
							<th>สลิป</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($order->payments as $item)
							<tr>
								<td>{{$item->bank->bank_name}}</td>
								<td>{{$item->payment_date}}</td>
								<td>{{number_format($item->price, 2)}}</td>
								<td>
									<a class="_fs-16 _fw-400" href="{{asset($item->url_slip)}}" data-lightbox="image-1">
										ดูสลิปโอนเงิน
									</a>
								</td>
							</tr>
						@empty
							<tr>
								<td class="text-center" colspan="3">ไม่มีรายการแจ้งชำระเงิน</td>
							</tr>
						@endforelse
					</tbody>
				</table>

				@if ($order->status == 1)
				<div class="d-flex mt-5">
					<form action="{{route('admin.order.update')}}" method="POST"
					onsubmit="return confirm('ต้องการ **ยกเลิก** การแจ้งโอนเงินใช่ หรือไม่')">
						@csrf
						<input type="hidden" name="order_id" value="{{$order->id}}">
						<button class="btn btn-danger" type="submit" name="action" value="reject">ยกเลิก</button>
					</form>
					<form class="ml-4" action="{{route('admin.order.update')}}" method="POST"
					onsubmit="return confirm('**ยืนยัน** การแจ้งโอนเงินใช่ หรือไม่')">
						@csrf
						<input type="hidden" name="order_id" value="{{$order->id}}">
						<button class="btn btn-success" type="submit" name="action" value="approve">ยืนยันการชำระเงิน</button>
					</form>
				</div>
				@elseif ($order->status == 2)
				<div class="d-flex _mgt-60">
					<form class="_w-50pct" action="{{route('admin.order.update')}}" method="POST"
					onsubmit="return confirm('ยืนยันการจัดส่ง')">
						@csrf
						<input type="hidden" name="order_id" value="{{$order->id}}">
						<div class="form-group">
							<label for="">เลขที่พัสดุ</label>
							<input class="form-control" type="text" name="no" placeholder="ตัวอย่าง: ETH027422367" required>
						</div>
						<button class="btn btn-success" type="submit">บันทึกเลขพัสดุ</button>
					</form>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@section('main.style')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css">
@endsection

@section('main.script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script>
@endsection