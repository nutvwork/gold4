@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-20">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">ข้อมูลใบสั่งซื้อ</li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container">
	<div class="row">
		@include('app.components.sidebar-account')
		<div class="col-lg-9 order-lg-last dashboard-content">
			<h2 class="_mgbt-0">ข้อมูลใบสั่งซื้อ <small>เลขที่ใบเสร็จ #{{$order->id}}</small></h2>

			<div class="row _mgt-30">
				<div class="col-md-3 _mgbt-10 _dp-f _fdrt-cl">
					<div class="_fs-16 _cl-font-3 _fw-600">วันที่สั่งซื้อ</div>
					<div>{{dateTh($order->created_at)}}</div>
					<div>เวลา: {{timeFromDate($order->created_at)}}</div>
					<div class="_cl-second">สถานะ: {{$order->status_text}}</div>
					@if ($order->shipping_track != "")
					<div class="_cl-font-1">เลขพัสดุ: {{$order->shipping_track}}</div>
					@endif

				</div>
				<div class="col-md-3 _mgbt-10 _dp-f _fdrt-cl">
					<div class="_fs-16 _cl-font-3 _fw-600">เลขที่ใบเสร็จ</div>
					#{{$order->id}}
				</div>
				<div class="col-md-5 _mgbt-10 _dp-f _fdrt-cl">
					<div class="_fs-16 _cl-font-3 _fw-600">ที่อยู่ในการส่งสินค้า</div>
					<span>ชื่อ: {{$order->name}}</span>
					<span>ที่อยู่: {{$order->address1}} {{$order->address2}}</span>
					<span>อำเภอ: {{$order->amphoe}}</span>
					<span>จังหวัด: {{$order->provinceData->name}}</span>
					<span>เบอร์โทร: {{$order->phone}}</span>
				</div>
			</div>

			<div class="table-responsive _mgt-30 _mgbt-50">
				<table class="table">
					<thead>
						<tr>
							<th>ชื่อสินค้า</th>
							<th>น้ำหนัก</th>
							<th class="_tal-ct">จำนวน</th>
							<th>ราคา</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($order->details as $item)
							<tr>
								<td>
									<a href="{{route('product', ['product' => $item->product->slug])}}" target="_blank">
										{{$item->product->name}}
									</a>
								</td>
								<td>{{$item->weight_text}} {{$item->weight_type}}</td>
								<td class="_tal-ct">{{$item->quantity}}</td>
								<td>{{number_format($item->price, 2)}}</td>
							</tr>
						@endforeach

						<tr>
							<td colspan="2"></td>
							<td class="_tal-r">รวม</td>
							<td>{{number_format($order->total, 2)}}</td>
						</tr>
						<tr>
							<td colspan="2" class="_bdw-0"></td>
							<td class="_tal-r _bdw-0">ค่าส่ง</td>
							<td>{{number_format($order->shipping_price, 2)}}</td>
						</tr>
						<tr>
							<td colspan="2" class="_bdw-0"></td>
							<td class="_tal-r _bdw-0">ราคาสุทธิ</td>
							<td>{{number_format($order->total + $order->shipping_price, 2)}}</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div><!-- End .col-lg-9 -->
	</div>
</div>
@endsection

@section('main.script')
	<script>
		$('#select-img').click(function () {
			$('#customFile').click();
		})

		function bindFileInputImage(input, img) {
			if (!input || !img) return
			input.onchange = () => {
				const fp = input.files && input.files[0]
				if (fp) {
					const reader = new window.FileReader()
					reader.onload = (e) => {
						img.src = e.target.result
					}
					reader.readAsDataURL(fp)
				}
			}
		}

		bindFileInputImage(
			document.querySelector('#customFile'),
            document.querySelector('#imgShow')
		)
	</script>
@endsection