@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-20">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">ตะกร้าสินค้า</li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<div class="cart-table-container">
				<table class="table table-cart">
					<thead>
						<tr>
							<th class="product-col">สินค้า</th>
							<th class="price-col">น้ำหนัก</th>
							<th class="qty-col">จำนวน</th>
							<th class="price-col">ราคา/หน่วย</th>
							<th>รวม</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($cartTable as $item)
						<tr class="product-row">
							<td class="product-col _fdrt-cl">
								<figure class="product-image-container _mgl-0 _mgbt-16">
									<a href="{{route('product', ['product' => $item['attributes']['product_slug']])}}" class="product-image">
										<img src="{{asset($item['attributes']['product_cover'])}}" alt="product image">
									</a>
								</figure>
								<h2 class="product-title">
									<a href="{{route('product', ['product' => $item['attributes']['product_slug']])}}">{{$item['name']}}</a>
								</h2>
							</td>
							<td>{{$item['attributes']['fee_text']}} {{$item['attributes']['fee_type']}}</td>
							<td>
								{{$item['quantity']}}
							</td>
							<td>{{number_format($item['price'], 2)}}</td>
							<td>{{number_format($item['price'] * $item['quantity'], 2)}}</td>
						</tr>
						<tr class="product-action-row">
							<td colspan="5" class="clearfix">
								<div class="float-right">
									<a href="#" title="Remove product"  class="btn-remove cart-item js-cart-page"
									data-item-id="{{$item['id']}}"><span class="sr-only">Remove</span></a>
								</div><!-- End .float-right -->
							</td>
						</tr>
						@empty
						<tr class="product-action-row">
							<td colspan="5" class="_tal-ct">
								คุณยังไม่มีสินค้าในตะกร้า
							</td>
						</tr>
						@endforelse
					</tbody>

					<tfoot>
						<tr>
							<td colspan="5" class="clearfix">
								<div class="float-left">
									<a href="{{route('cart.clear')}}" class="btn btn-outline-secondary btn-clear-cart">ลบสินค้าในตะกร้าทั้งหมด</a>
								</div>
								<div class="float-right">
									<a href="" class="btn btn-outline-secondary btn-update-cart">อัพเดทราคา</a>
								</div><!-- End .float-right -->
							</td>
						</tr>
					</tfoot>
				</table>
			</div><!-- End .cart-table-container -->

		</div><!-- End .col-lg-8 -->

		<div class="col-lg-4">
			<div class="cart-summary">
				<h3>สรุปราคา</h3>

				<table class="table table-totals">
					<tbody>
						<tr>
							<td>ยอดรวม</td>
							<td>{{number_format($subTotal, 2)}}</td>
						</tr>

						<tr>
							<td>ค่าจัดส่ง</td>
							<td>{{number_format($shippingPrice, 2)}}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td>ยอดที่ต้องชำระ</td>
							<td>{{number_format($total, 2)}}</td>
						</tr>
					</tfoot>
				</table>
				@if (count($cartTable))
				<div class="checkout-methods">
					<a href="{{route('checkout')}}" class="btn btn-block btn-sm _bgcl-gold-2 _cl-white _fs-18">ยืนยันการสั่งซื้อ</a>
				</div><!-- End .checkout-methods -->
				@endif
			</div><!-- End .cart-summary -->
		</div><!-- End .col-lg-4 -->
	</div><!-- End .row -->
</div><!-- End .container -->

@endsection