
@extends('layouts.app')
@section('content')

	@include('app.components.gold-panel')

	<section class="_pdv-60">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="_mgbt-20 _tal-ct">
						<span class="_fs-24">ทองรูปพรรณแนะนำ</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-4 _mgbt-16 _mgbt-0-lg">
					<a href="{{route('topic', ['topic' => 'สร้อยคอทองคำ'])}}" class="recomend-item _bdrd-3 _ovf-hd">
						<img src="{{asset('app/images/category/image-category3.jpg')}}">
						<div class="info">
							<div class="_fs-40 name">สร้อยคอทองคำ</div>
							<button class="btn btn-outline-light _fs-16 btn-sm _mgt-20 _pdh-30 _bdrd-5">ดูสินค้า</button>
						</div>
					</a>
				</div>
				<div class="col-12 col-md-4 _mgbt-16 _mgbt-0-lg">
					<a href="{{route('topic', ['topic' => 'แหวนทองคำ'])}}" class="recomend-item _bdrd-3 _ovf-hd">
						<img src="{{asset('app/images/category/0e33c96ef7bebdd9.jpg')}}">
						<div class="info">
							<div class="_fs-40 name">แหวนทองคำ</div>
							<button class="btn btn-outline-light _fs-16 btn-sm _mgt-20 _pdh-30 _bdrd-5">ดูสินค้า</button>
						</div>
					</a>
				</div>
				<div class="col-12 col-md-4 _mgbt-16 _mgbt-0-lg">
					<a href="{{route('topic', ['topic' => 'สร้อยข้อมือทองคำ'])}}" class="recomend-item _bdrd-3 _ovf-hd">
						<img src="{{asset('app/images/category/image-category1.jpg')}}">
						<div class="info">
							<div class="_fs-40 name">สร้อยข้อมือทองคำ</div>
							<button class="btn btn-outline-light _fs-16 btn-sm _mgt-20 _pdh-30 _bdrd-5">ดูสินค้า</button>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="_pdv-60 _bgcl-section">
		<h3 class="_tal-ct _dp-f _alit-ct _jtfct-ct _cl-font-1">
			<span class="_fs-24 _mgh-10 _fw-400">สินค้าขายดี</span>
		</h3>
		<div class="partners-container">
			<div class="container">
				<div class="partners-carousel owl-carousel owl-theme">
					@foreach ($productTopSelling as $item)
						<a href="/product/{{$item->slug}}" class="partner">
							<img src="{{$item->cover}}" alt="product {{$item->name}}">
						</a>
					@endforeach
				</div><!-- End .partners-carousel -->
			</div><!-- End .container -->
		</div><!-- End .partners-container -->
	</section>

	<section class="_pdv-60">
		<div class="container">
			<div class="row">
				@foreach ($promotions as $item)
					<div class="col-md-4">
						@if($item->value_2 != "")
						<a href="{{$item->value_2}}" target="_blank" class="banner banner-image _mgbt-0 _mgbt-24 _mgbt-0-md _bdrd-2 _ovf-hd">
							<img src="{{asset($item->value)}}" alt="promotion">
						</a>
						@else
						<div class="banner banner-image _mgbt-0 _mgbt-24 _mgbt-0-md _bdrd-2 _ovf-hd">
							<img src="{{asset($item->value)}}" alt="promotion">
						</div>
						@endif
					</div>
				@endforeach
			</div>
		</div>
	</section>

	<div class="info-boxes-container">
		<div class="container">
			<div class="info-box">
				<i class="icon-shipping"></i>

				<div class="info-box-content">
					<h4>จัดส่งรวดเร็วภายใน 24 ชั่วโมง</h4>
					<p>จันทร์ ถึง ศุกร์ ส่งด่วน ค่าบริการ 250 บาท</p>
				</div><!-- End .info-box-content -->
			</div><!-- End .info-box -->

			<div class="info-box _bdvw-1 _bdvw-0-md _bdhw-1-md _bdcl-white">
				<i class="icon-us-dollar"></i>

				<div class="info-box-content">
					<h4>จ่ายออนไลน์ สะดวกรวดเร็ว</h4>
					<p>สั่งซื้อทองออนไลน์ สะดวกรวดเร็วได้รับสินค้าชัวร์</p>
				</div><!-- End .info-box-content -->
			</div><!-- End .info-box -->

			<div class="info-box">
				<i class="icon-support"></i>

				<div class="info-box-content">
					<h4>มีเจ้าหน้าที่ดูแล การสั่งซื้อ</h4>
					<p>สามารถติดต่อเพื่อสอบถามสถานะสินค้าได้ตลอด</p>
				</div><!-- End .info-box-content -->
			</div><!-- End .info-box -->
		</div><!-- End .container -->
	</div><!-- End .info-boxes-container -->

	<section class="_pdv-40 _bgcl-section">
		<div class="container">
			<div class="row">
				<div class="col-12 _dp-f _alit-ct _fw-w _jtfct-ct">
					<div class="_cl-font-1 _fs-24 _fs-24 _fs-30-lg _lh-125pct _tal-ct _tal-l-lg"><span class="_fs-30 _fs-40-lg">ซื้อทองออนไลน์</span> ได้แล้ววันนี้ ที่ ห้างทองเยาวราชบางกอก</div>
					<a class="btn _bgcl-third _fs-24 _bdrd-3 btn-sm _cl-font-1 _mgl-40-lg _mgt-20 _mgt-0-lg" href="{{route('product.all')}}">ซื้อทองออนไลน์</a>
				</div>
			</div>
		</div>
	</section>

	<section class="_pdt-80 _pdbt-30 _bgcl-blog">
		<div class="container">
			@if (count($blogs))
			<h3 class="_cl-font-1 _fs-24 _mgbt-0 _fw-400 _tal-ct">สาระความรู้เกี่ยวกับทอง</h3>
			<h5 class="_cl-font-2 _fs-18 _fw-400 _tal-ct">จาก ห้างทองเยาวราชบางกอก</h5>

			<div class="row _mgt-40">
				@foreach ($blogs as $item)
					<div class="col-md-4 _mgbt-16 _mgbt-0-lg">
						<a class="_bdrd-2 _ovf-hd _dp-b" href="{{route('blog.single', ['blog' => $item->slug])}}">
							<img src="{{asset($item->cover)}}">
						</a>
						<div class="_mgt-20 _fs-22 _fs-24-lg _lh-125pct">
							<a class="_cl-font-1" href="{{route('blog.single', ['blog' => $item->slug])}}">
								{{str_limit($item->title, 60)}}
							</a>
						</div>
					</div>
				@endforeach
			</div>

			<div class="row _jtfct-ct _mgv-50">
				<div class="col-6 _tal-ct">
					<a class="_cl-font-2 _cl-font-3-hover _fs-18 _fw-400 _tdcrt-udl" href="{{route('blog')}}">ดูเพิ่มเติม</a>
				</div>
			</div>
			@endif

			<div class="row">
				<div class="col-12 _dp-f _fw-w _alit-ct _jtfct-ct">
					<div class="_cl-white _fs-24 _fs-22-md _fs-30-lg _lh-125pct _tal-ct _tal-l-lg">ต้องการเป็นตัวแทนจำหน่ายกับห้างทองเยาวราชบางกอก สนใจคลิก..</div>
					<a class="btn _bgcl-gray _fs-24 _bdrd-3 btn-sm _cl-second _mgl-40-lg _mgt-20 _mgt-0-lg" href="{{route('register')}}">สมัครเป็นตัวแทน</a>
				</div>
			</div>
		</div>
	</section>
@endsection
