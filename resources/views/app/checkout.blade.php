@extends('layouts.app')

@section('content')
<section class="_pdv-40 _bgcl-gold-2">
	<div class="container">
		<h1 class="_cl-white _mgbt-0 _fw-400 _fs-30">ยืนยันการสั่งซื้อสินค้า</h1>
	</div>
</section>

<div class="container">
	<h2 class="step-title _bdw-0 _mgt-30 _mgbt-20">ที่อยู่ในการส่งสินค้า</h2>
</div>

<div class="container _mgv-50">
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul class="_mg-0">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="row">
		<div class="col-lg-6">

			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>รายการ</th>
							<th class="_tal-ct">จำนวน</th>
							<th class="_tal-r">ราคารวม</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($cartTable as $item)
						<tr>
							<td class="_vtcal-md">
								<figure class="_mg-0">
									<a href="{{route('product', ['product' => $item['attributes']['product_slug']])}}" target="_blank">
										<img class="_img-ct" src="{{asset($item['attributes']['product_cover'])}}" alt="product image" width="60px">
									</a>
								</figure>
							</td>
							<td class="_vtcal-md">
								<h2 class="product-title _cl-font-3 _fs-14 _mgbt-0">
									<a href="{{route('product', ['product' => $item['attributes']['product_slug']])}}" target="_blank">{{$item['name']}}</a>
								</h2>
								<span class="product-qty _cl-font-3 _fs-14">น้ำหนัก {{$item['attributes']['fee_text']}} {{$item['attributes']['fee_type']}}</span>
							</td>
							<td class="_vtcal-md _tal-ct _cl-font-3">{{$item['quantity']}}</td>
							<td class="_vtcal-md _tal-r _cl-font-3">{{number_format($item['price'] * $item['quantity'], 2)}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>

			<h4 class="_cl-font-1 _fs-24 _fw-400 _mgt-40 _mgbt-30">รวมยอดสุทธิ</h4>
			<div class="table-responsive">
				<table class="table">
					<tbody>
						<tr>
							<td class="_cl-font-3">ยอดรวม</td>
							<td class="_cl-font-3" style="width: 150px;">{{number_format($subTotal, 2)}}</td>
							<td class="_cl-font-3">บาท</td>
						</tr>
						<tr>
							<td class="_cl-font-3">ค่าจัดส่ง</td>
							<td class="_cl-font-3" style="width: 150px;">{{number_format($shippingPrice, 2)}}</td>
							<td class="_cl-font-3">บาท</td>
						</tr>
						<tr>
							<td class="_cl-font-3">ยอดสุทธิ</td>
							<td class="_cl-font-3" style="width: 150px;">{{number_format($total, 2)}}</td>
							<td class="_cl-font-3">บาท</td>
						</tr>
					</tbody>
				</table>
			</div>
			<button id="submitBtn" class="btn _bgcl-third _cl-font-1 _fs-18 float-right _pv-10 _mgt-50 _pdh-30">แจ้งชำระเงิน</button>

		</div><!-- End .col-lg-6 -->

		<div class="col-lg-6 order-lg-first">
			<div class="checkout-payment">

				<div id="new-checkout-address" class="show">
					<form id="submitForm" action="{{route('checkout.confirm')}}" method="POST">
						@csrf
						<div class="form-group required-field">
							<label>ชื่อ-นามสกุล</label>
							<input type="text" name="name" class="form-control" value="{{old('name') ?? Auth::user()->name}}" required>
						</div><!-- End .form-group -->

						<div class="form-group required-field">
							<label>ที่อยู่</label>
							<input type="text" class="form-control" name="address1" value="{{old('address1')}}" required>
							<input type="text" class="form-control" name="address2" value="{{old('address2')}}" required>
						</div><!-- End .form-group -->

						<div class="form-group required-field">
							<label>อำเภอ</label>
							<input type="text" class="form-control" name="amphoe" value="{{old('amphoe')}}" required>
						</div><!-- End .form-group -->

						<div class="form-group">
							<label>จังหวัด</label>
							<div class="select-custom">
								<select class="form-control" name="province" required>
									<option value="">เลือกจังหวัด</option>
									@foreach ($provinces as $item)
										@if ($item->code === old('province'))
										<option value="{{$item->code}}" selected>{{$item->name}}</option>
										@else
										<option value="{{$item->code}}">{{$item->name}}</option>
										@endif
									@endforeach
								</select>
							</div><!-- End .select-custom -->
						</div><!-- End .form-group -->

						<div class="form-group required-field">
							<label>รหัสไปรษณีย์</label>
							<input type="text" class="form-control" name="zip" required>
						</div><!-- End .form-group -->

						<div class="form-group required-field">
							<label>เบอร์โทรศัพท์</label>
							<input type="tel" class="form-control" name="phone" value="{{Auth::user()->phone}}" required>
						</div><!-- End .form-group -->
						<input id="submit-hidden" type="submit" style="display: none">
					</form>
				</div><!-- End #new-checkout-address -->
			</div><!-- End .checkout-payment -->

		</div><!-- End .col-lg-6 -->
	</div><!-- End .row -->
</div><!-- End .container -->

@endsection

@section('main.script')
	<script>
		$form = $('#submitForm')
		$("#submitBtn").on("click", function() {
			$form.find("#submit-hidden").click();
		})
	</script>
@endsection