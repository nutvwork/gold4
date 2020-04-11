@extends('layouts.app')

@section('content')
	<div class="container _mgt-50 _mgbt-80">
		<div class="row">
			<div class="col-lg-9">
				<nav class="toolbox _bdbtw-1 _bdcl-border _mgbt-30">
					<div class="toolbox-left">
						<h1 class="_fs-30 _cl-font-2 _fw-400">{{$topic->name}}</h1>
					</div><!-- End .toolbox-left -->
				</nav>

				<div class="row row-sm">
					@forelse ($products as $item)
						<div class="col-6 col-md-4 col-xl-4">
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
					@empty
						<h4 class="_fs-24 _cl-font-2 _fw-400 _tal-ct _w-100pct">ยังไม่มีสินค้าในหมวดหมู่นี้</h4>
					@endforelse
				</div><!-- End .row -->

				<nav class="toolbox toolbox-pagination _bdtw-0">
					{{ $products->links() }}
				</nav>
			</div><!-- End .col-lg-9 -->

			<aside class="sidebar-shop col-lg-3" style="margin-top: 52px;">
				<div class="sidebar-wrapper">
					<div class="widget topic">
						<ul class="_lst-n _cl-font-3">
							<li class="_fs-18 _fw-400 _pd-16">หมวดหมู่: {{$topic->name}}</li>

						</ul>
					</div><!-- End .widget -->
				</div><!-- End .sidebar-wrapper -->
			</aside><!-- End .col-lg-3 -->
		</div><!-- End .row -->
	</div><!-- End .container -->
@endsection

@section('main.script')
	<script src="{{asset("js/themes/nouislider.min.js")}}"></script>
@endsection