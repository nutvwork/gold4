<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	{!! SEO::generate(true) !!}

    <!-- Favicon -->
	<link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="{{asset("app/images/logos/favicon.png")}}">

    <!-- Plugins CSS File -->
	<link rel="stylesheet" href="{{asset("app/css/bootstrap.min.css")}}">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	@yield('main.style')
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{mix("app/css/app.css")}}">
    <link rel="stylesheet" href="{{mix("app/css/atomic.css")}}">
</head>
<body>
    <div class="page-wrapper">
		@include('app.components.navbar')
        <main class="main">
			@yield('content')
        </main><!-- End .main -->
		@include('app.components.footer')
    </div><!-- End .page-wrapper -->

	@include('app.components.navbar-mobile')

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="{{asset("app/js/themes/jquery.min.js")}}"></script>
    <script src="{{asset("app/js/themes/bootstrap.bundle.min.js")}}"></script>
	<script src="{{asset("app/js/themes/plugins.min.js")}}"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

	@yield('main.script')

    <!-- Main JS File -->
	<script src="{{asset("app/js/themes/main.js")}}"></script>
	<script src="{{mix("app/js/app.js")}}"></script>

	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '1734160366661857');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=1734160366661857&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
</body>
</html>