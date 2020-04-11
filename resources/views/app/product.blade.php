@extends('layouts.app')

@section('content')
@include('app.components.gold-panel')

<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-30">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item"><a href="{{route("topic", ['slug' => $product->topic->name])}}">{{$product->topic->name}}</a></li>
			<li class="breadcrumb-item"><a>{{$product->name}}</a></li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container _mgv-50">
	<div class="row">
		<div class="col-lg-12">
			<div class="product-single-container product-single-default">
				<div class="row">
					<div class="col-lg-5 col-md-6 product-single-gallery">
						<div class="product-slider-container product-item">
							<div class="product-single-carousel owl-carousel owl-theme">
								<div class="product-item">
									<img class="product-single-image" src="{{asset($product->cover)}}" data-zoom-image="{{asset($product->cover)}}"/>
								</div>
								@foreach ($product->images as $item)
								<div class="product-item">
									<img class="product-single-image" src="{{asset($item->url)}}" data-zoom-image="{{asset($item->url)}}"/>
								</div>
								@endforeach
							</div>
							<!-- End .product-single-carousel -->
							<span class="prod-full-screen">
								<i class="icon-plus"></i>
							</span>
						</div>
						<div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
							<div class="col-3 owl-dot">
								<img src="{{asset($product->cover)}}" />
							</div>
							@foreach ($product->images as $item)
							<div class="col-3 owl-dot">
								<img src="{{asset($item->url)}}" />
							</div>
							@endforeach
						</div>
					</div><!-- End .col-lg-7 -->

					<div class="col-lg-7 col-md-6">
						<div class="product-single-details">
							<h1 class="product-title">{{$product->name}}</h1>
							<h4 class="_fs-14 _cl-font-3 _fw-400">รหัสสินค้า - {{$product->sku}}</h4>

							<div class="product-desc">
								<p class="_wsp-pw">{{$product->description}}</p>
								<div class="_mgt-50 _cl-font-3 _fs-18">
									ติดต่อสอบถาม: <br>
									Line: @ybkkgold <br>
									<a href="https://line.me/R/ti/p/@ybkkgold">
										<img class="" src="https://scdn.line-apps.com/n/line_add_friends/btn/en.png" alt="เพิ่มเพื่อน" width="116" height="33" border="0">
									</a>
								</div>
								<div class="_mgt-16 _cl-font-3 _fs-18">
									ติดตามทองคำอัพเดท ได้ที่ : <br>
									<a href="https://www.facebook.com/bangkokyaowaratgoldshop/" target="_blank">เพจห้างทองเยาวราชบางกอก</a>
								</div>
							</div><!-- End .product-desc -->

							<div class="product-single-share">
								<label>แชร์สินค้า:</label>

								<a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank">
									<i class="icon-facebook"></i>
									<span>แชร์สินค้า</span>
								</a>

							</div><!-- End .product single-share -->
						</div><!-- End .product-single-details -->
					</div><!-- End .col-lg-5 -->
				</div><!-- End .row -->
			</div><!-- End .product-single-container -->

			<div class="row">
				<div class="col-md-9">
					<div class="product-single-tabs _mgt-40">
						<h3 class="_fs-24 _fw-400 _cl-font-1">ตารางราคา</h3>
						<span class="_fs-18 _cl-font-3">คำแนะนำ : ราคาอ้างอิงประกาศ ประจำวันที่  เวลา  น. กรุณาโหลดหน้านี้อีกครั้งเพื่ออัพเดทราคาล่าสุด</span>

						<div class="table-responsive _mgt-24" id="product-buy">
							<table class="table gold-table">
								<thead>
									<tr>
										<th class="_tal-ct">น้ำหนัก</th>
										<th>ราคา</th>
										<th class="th-amount">ระบุจำนวน</th>
										<th class="_tal-ct">กดสั่งซื้อ</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($product->fees as $item)
									<tr>
										<td class="_tal-ct _vtcal-md">{{$item->weight_text}} {{$item->weight_type}}</td>
										<td class="_vtcal-md">{{number_format($item->price, 2)}}</td>
										<td class="_vtcal-md">
											<div class="product-single-qty">
												<input class="horizontal-quantity form-control amount" type="text">
											</div><!-- End .product-single-qty -->
										</td>
										<td class="_tal-ct _vtcal-md">
											<button class="btn btn-gold-click _fs-14 _fs-18-md _bdrd-3 btn-sm"
											data-product="{{$product->id}}" data-fee="{{$item->id}}">สั่งซื้อ</button>
										</td>
									</tr>
									@empty
										<tr>
											<td colspan="4" class="_tal-ct">ไม่มีสินค้า</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</div>
					</div><!-- End .product-single-tabs -->
				</div>
			</div>
		</div><!-- End .col-lg-12 -->
	</div><!-- End .row -->

	<h3 class="_cl-font-1 _fs-24 _fw-400 _mgbt-40">สินค้าที่คล้ายกัน</h3>
	<div class="row row-sm">
		@foreach ($relates as $item)
			<div class="col-6 col-md-3 col-xl-3">
				<div class="product">
					<figure class="product-image-container _mgbt-10">
						<a href="{{route('product', ['product' => $item->slug])}}" class="product-image">
							<img src="{{asset($item->cover)}}" alt="product-image">
						</a>
					</figure>
					<div class="product-details">
						@if ($item->fees[0]->weight === $item->fees[count($item->fees) - 1]->weight
						&& $item->fees[0]->weight_type === $item->fees[count($item->fees) - 1]->weight_type)
						<h4 class="_fs-14 _cl-font-2 _tal-ct _mgbt-2 _fw-400">
							น้ำหนัก:
							{{$item->fees[0]->weightText}} {{$item->fees[0]->weight_type}}
						</h4>
						@else
						<h4 class="_fs-14 _cl-font-2 _tal-ct _mgbt-2 _fw-400">
							น้ำหนัก: {{$item->fees[0]->weightText}} {{$item->fees[0]->weight_type}}
							-
							{{$item->fees[count($item->fees) - 1]->weightText}} {{$item->fees[count($item->fees) - 1]->weight_type}}
						</h4>
						@endif
						<h2 class="product-title _fs-18 _cl-font-2 _tal-ct">
							<a href="{{route('product', ['product' => $item->slug])}}">{{str_limit($item->name, 50)}}</a>
						</h2>
					</div><!-- End .product-details -->
				</div><!-- End .product -->
			</div><!-- End .col-xl-3 -->
		@endforeach
	</div>

</div><!-- End .container -->


<section class="_pdv-30 _bgcl-gold-2">
	<div class="container">
		<div class="row">
			<div class="col-12 _dp-f _alit-ct _fw-w _jtfct-ct">
				<div class="_cl-white _fs-18"><span class="_fs-30">สั่งซื้อทองออนไลน์ 24 ชม.</span> ที่ห้างทองเยาวราชบางกอก เรามีบริการสั่งซื้อทองออนไลน์ หรือต้องการสั่งทำทองแบบพิเศษ</div>
				<a class="btn _bgcl-gray _fs-18 _bdrd-3 btn-sm _cl-second _mgl-40-lg" href="{{route('contact')}}">ติดต่อเรา</a>
			</div>
		</div>
	</div>
</section>

@endsection

@section('main.script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script>
		let isLoading = false
		$('.btn-gold-click').on('click', function () {
			if (isLoading) return
			isLoading = true
			const product_id = $(this).data('product')
			const fee_id = $(this).data('fee')
			const amount = $(this).closest('tr').find('.amount').val();

			axios.post('/cart/add', {
				product_id,
				fee_id,
				amount
			}).then(function (res) {
				isLoading = false
				swal("", "เพิ่มสินค้าในตะกร้าเรียบร้อย", "success").then(function () {
					displayCart()
				})
			}).catch(function () {
				isLoading = false
			})
		})
	</script>
@endsection
