<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->
<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li><a href="/">หน้าแรก</a></li>
                <li>
                    <a href="{{route('product.all')}}">สินค้า</a>
                    <ul>

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
		</nav><!-- End .mobile-nav -->

    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->
