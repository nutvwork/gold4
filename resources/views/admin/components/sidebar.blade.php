<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">

	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__section m-menu__section--first">
				<h4 class="m-menu__section-text">Managements</h4>
				<i class="m-menu__section-icon flaticon-more-v2"></i>
			</li>
			<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
				<a href="{{route('admin.index')}}" class="m-menu__link">
					<i class="m-menu__link-icon flaticon-pie-chart-1"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">ข้อมูลการขาย</span>
						</span>
					</span>
				</a>
			</li>
			<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
				<a href="{{route('admin.order')}}" class="m-menu__link">
					<i class="m-menu__link-icon flaticon-alert"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">ใบสั่งซื้อ</span>
							@if(isset($orderNotification) )
							<span class="m-menu__link-badge">
								<span class="m-badge m-badge--danger">{{$orderNotification}}</span>
							</span>
							@endif
						</span>
					</span>
				</a>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-business"></i><span class="m-menu__link-text">สินค้า</span><i
					 class="m-menu__ver-arrow la la-angle-right"></i></a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.product')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">สินค้าทั้งหมด</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.product.create')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">สร้างสินค้า</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-clipboard"></i><span class="m-menu__link-text">หมวดหมู่</span><i
					 class="m-menu__ver-arrow la la-angle-right"></i></a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.topic')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">แสดงหมวดหมู่</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.topic.create')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">สร้างหมวดหมู่</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-doc"></i><span class="m-menu__link-text">บทความ</span><i
					 class="m-menu__ver-arrow la la-angle-right"></i></a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.blog')}}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">บทความทั้งหมด</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.blog.create')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">สร้างบทความใหม่</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-graphic"></i>
					<span class="m-menu__link-text">ภาพสไลด์</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.slide')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">แสดงภาพสไลด์</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.slide.create')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">สร้างสไลด์</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-piggy-bank"></i>
					<span class="m-menu__link-text">ธนาคาร</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.bank')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">ธนาคารทั้งหมด</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.bank.create')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">สร้างธนาคาร</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-presentation"></i>
					<span class="m-menu__link-text">ภาพโปรโมชั่น</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.promotion')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">แสดงภาพโปรโมชั่น</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
							<a href="{{route('admin.promotion.create')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">สร้างโปรโมชั่น</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	</div>

	<!-- END: Aside Menu -->
</div>