<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>ระบบจัดการ | Yaowaratbangkok</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<!--end::Web font -->

		<!--begin::Global Theme Styles -->
		<link href="{{asset("admin-asset/vendors/base/vendors.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{asset("admin-asset/demo/demo11/base/style.bundle.css")}}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles -->

		<!--begin::Page Vendors Styles -->
		<link href="{{asset("admin-asset/vendors/custom/fullcalendar/fullcalendar.bundle.css")}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles -->

		<link rel="stylesheet" href="{{asset("admin-asset/css/admin.css")}}">
		<link rel="stylesheet" href="{{mix("app/css/atomic.css")}}">

		<link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="{{asset("app/images/logos/favicon.png")}}">

		@yield('main.style')
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-content--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			@include('admin.components.navbar')

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				@include('admin.components.sidebar')

				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content py-0">
						<div class="m-portlet m-portlet--tab">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											@yield('content-title')
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								@yield('content')
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end:: Body -->

			@include('admin.components.footer')
		</div>

		<!-- end:: Page -->

		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scroll Top -->

		<!--begin::Global Theme Bundle -->
		<script src="{{asset("admin-asset/vendors/base/vendors.bundle.js")}}" type="text/javascript"></script>
		<script src="{{asset("admin-asset/demo/demo11/base/scripts.bundle.js")}}" type="text/javascript"></script>
		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors -->
		<script src="{{asset("admin-asset/vendors/custom/fullcalendar/fullcalendar.bundle.js")}}" type="text/javascript"></script>
		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script src="{{asset("admin-asset/app/js/dashboard.js")}}" type="text/javascript"></script>
		<!--end::Page Scripts -->
		<script src="{{mix("admin-asset/js/admin.js")}}" type="text/javascript"></script>

		@yield('config.data')
		@yield('main.script')
	</body>
	<!-- end::Body -->
</html>