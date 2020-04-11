<?php


   use App\Topic;
   $allTopics = Topic::all() ;
   $listCart = Cart::getContent();
   print_r($listCart);
 //  echo $listCart->count();
   $NumCount = $listCart->count();

?>

<header class="header">
	<div class="header-top">
		<div class="container">
			<a class="logo" href="/">
				<img class="img-fluid" src="{{asset("app/images/logos/logo-ybkk.png")}}" alt="yaowaratbangkok Logo">
			</a>
		</div>
	</div>
	<div class="header-bottom sticky-header">
		<div class="container">
			<div class="header-left">
				<a class="_pdv-10 _dp-n-lg" href="/">
					<img class="_h-50" src="{{asset("app/images/logos/mini-logo-ybkk.png")}}" alt="yaowaratbangkok Logo">
				</a>
				<ul class="menu sf-arrows">
					<li>
						<a href="/">หน้าแรก</a>
					</li>
					<li>

						<a href="{{route('product.all')}}" class="sf-with-ul">สินค้า</a>
						<ul>
						  @foreach ($allTopics as $item)
							<li><a href="/topic/{{$item->slug}}">{{$item->name}}</a></li>
							@endforeach
						</ul>
					</li>
					<li>
						<a href="{{route('gold-saving')}}">ออมทองกับเรา</a>
					</li>
					<li>
						<a href="{{route('blog')}}">บทความ</a>
					</li>
					<li>
						<a href="{{route('contact')}}">ติดต่อเรา</a>
					</li>
					@auth
					<li>
						<a href="{{route('account')}}" class="sf-with-ul">บัญชีของฉัน</a>
						<ul>

							<li><a href="{{route('account.order')}}">รายการสั่งซื้อ</a></li>
							<li><a href="{{route('account.history')}}">ประวัติการสั่งซื้อ</a></li>
							<li><a href="{{route('cart')}}">ตะกร้าสินค้า</a></li>
							<li><a href="{{route('account')}}">จัดการบัญชี</a></li>
							<li><a href="{{ route('logout') }}"
								onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">ออกจากระบบ</a></li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</ul>
					</li>
					@if (Auth::user()->isAdmin())
					<li><a href="{{route('admin.index')}}" target="_blank"><strong>ผู้ดูแลระบบ</strong></a></li>
					@endif
					@else
						<li><a href="{{route('login')}}">เข้าสู่ระบบ</a></li>
					@endauth
				</ul>

			</div><!-- End .header-left -->
			<?php
                $listCart = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
			?>

			<nav class="header-right">

				<div class="dropdown cart-dropdown">
					<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
						<span class="cart-count">
						   {{$NumCount}}
						</span>
					</a>

					<div class="dropdown-menu" >
						<div class="dropdownmenu-wrapper">
							<div class="dropdown-cart-header">
								<span class="cart-count"></span>
								<span class="_mgl-10">รายการ</span>

								<a href="{{route('cart')}}">ดูตะกร้า</a>
							</div><!-- End .dropdown-cart-header -->
							<div class="dropdown-cart-products">
							<?php
                                $listCart = Cart::getContent();
							?>

							@if($NumCount  > 0 )
							   @foreach ($listCart as $item)
								<div class="product">
									<div class="product-details">
										<h4 class="product-title _cl-font-1">
											<a href="{{route('product', ['product' => $item->attributes->product_slug])}}">{{$item->name}}</a>
										</h4>

										<span class="cart-product-info _cl-font-3">
											<span class="cart-product-qty">{{$item->quantity}}</span>
											x {{number_format($item->price, 2)}}
										</span>
									</div><!-- End .product-details -->

									<figure class="product-image-container">
										<a href="{{route('product', ['product' => $item->attributes->product_slug])}}" class="product-image">
											<img src="{{asset($item->attributes->product_cover)}}" alt="product image">
										</a>
										<a href="#" class="btn-remove cart-item" title="Remove Product"
										data-item-id="{{$item->id}}"><i class="icon-cancel"></i></a>
									</figure>
								</div><!-- End .product -->
								@endforeach
                             @endif
							</div><!-- End .cart-product -->

							<div class="dropdown-cart-action _mgt-40">
								<a href="{{route('cart')}}" class="btn btn-block _bgcl-gold-2 _fs-18 _bdw-0">ตรวจสอบตะกร้า</a>
							</div><!-- End .dropdown-cart-total -->
						</div><!-- End .dropdownmenu-wrapper -->
					</div><!-- End .dropdown-menu -->
				</div><!-- End .dropdown -->

				<button class="mobile-menu-toggler" type="button">
					<i class="icon-menu"></i>
				</button>
			</nav>

		</div><!-- End .header-bottom -->
	</div><!-- End .header-bottom -->
</header><!-- End .header -->
