@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-50">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">ติดต่อเรา</li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container _mgbt-80">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62043.38097238781!2d100.54540149806515!3d13.614435665198101!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a143f6c10de1%3A0x3996d961ae548f3e!2z4Lir4LmJ4Liy4LiH4LiX4Lit4LiH4LmA4Lii4Liy4Lin4Lij4Liy4LiK4Lia4Liy4LiH4LiB4Lit4LiB!5e0!3m2!1sth!2sth!4v1546614301449" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

	<h2 class="light-title _mgv-30">ข้อมูลติดต่อ <strong>ห้างทองเยาวราชบางกอก</strong></h2>
	<div class="row">
		<div class="col-md-4">
			<div class="contact-info">
				<div class="_dp-f _alit-ct">
					<i class="icon-phone"></i>
					<p class="_mgl-10"><a class="_fs-16" href="tel:026898928">02-689-8928</a></p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="contact-info">
				<div class="_dp-f _alit-ct">
					<img src="{{asset('app/images/logos/line-logo.png')}}" alt="line logo" width="43px" height="43px">
					<p class="_mgl-10 _cl-gold-2 _fs-16">@ybkkgold</p>
				</div>
			</div>
		</div>
	</div>

	<h2 class="light-title _mgv-30">เลขบัญชีธนาคาร</h2>
	<div class="row _mgbt-50">
		<div class="col-md-8">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>ธนาคาร</th>
							<th>ชื่อบัญชี</th>
							<th>เลขที่บัญชี</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($banks as $item)
						<tr>
							<td>
								<img class="_img-ct" src="{{asset($item->url_image)}}" alt="bank images" width="40px" height="40px">
							</td>
							<td class="_vtcal-md">{{$item->bank_name}}</td>
							<td class="_vtcal-md">{{$item->account_name}}</td>
							<td class="_vtcal-md">{{$item->account_no}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<h2 class="light-title _mgbt-30">สาขาของ <strong>ห้างทองเยาวราชบางกอก</strong></h2>

	<div class="row _mgbt-30">
		<div class="col-12 col-md-6">
			<h4 class="light-title _fs-18">ห้างทองเยาวราชบางกอก <strong>สาขาวัดไทร (สำนักงานใหญ่)</strong></h4>
			<address>
				611/116 ตรอกวัดจันทร์ใน ถนนพระราม 3 แขวงบางโคล่ เขตบางคอแหลม กรุงเทพฯ 10120 <br>
				โทร : 02-689-8928
			</address>
		</div>
	</div>

	<div class="row _mgbt-30">
		<div class="col-12 col-md-6">
			<h4 class="light-title _fs-18">ห้างทองเยาวราชบางกอก <strong>สาขาตลาดรวยมาร์เก็ต (ประชาอุทิศ 90)</strong></h4>
			<address>
				9/8 หมู่ที่ 2 ตำบลคลองสวน อำเภอพระสมุทรเจดีย์ สมุทรปราการ 10290 <br>
				โทร : 083-684-7424
			</address>
		</div>
	</div>
	
	<div class="row _mgbt-30">
		<div class="col-12 col-md-6">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d124047.47000797665!2d100.4731175!3d13.6891447!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29fb9e1de7e79%3A0x4182d5613816e28!2z4Lir4LmJ4Liy4LiH4LiX4Lit4LiH4LmA4Lii4Liy4Lin4Lij4Liy4LiK4Lia4Liy4LiH4LiB4Lit4LiBIOC4quC4suC4guC4suC4reC4meC4uOC4quC4suC4p-C4o-C4teC4ouC5jOC4iuC4seC4og!5e0!3m2!1sth!2sth!4v1557303600812!5m2!1sth!2sth" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="col-12 col-md-6">
			<h4 class="light-title _fs-18">ห้างทองเยาวราชบางกอก <strong>สาขาอนุสาวรีย์ชัย</strong></h4>
			<address>
				438/34 ถนนราชวิถี แขวงถนนพญาไท เขตราชเทวี กรุงเทพฯ 10400 <br>
				โทร : 02-245-0280
			</address>
		</div>
	</div>
	<div class="row _mgbt-30">
		<div class="col-12 col-md-6">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3877.7125477422837!2d100.5437145!3d13.6143602!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a143f6c10de1%3A0x3996d961ae548f3e!2z4Lir4LmJ4Liy4LiH4LiX4Lit4LiH4LmA4Lii4Liy4Lin4Lij4Liy4LiK4Lia4Liy4LiH4LiB4Lit4LiB!5e0!3m2!1sth!2sth!4v1557303777745!5m2!1sth!2sth" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="col-12 col-md-6">
			<h4 class="light-title _fs-18">ห้างทองเยาวราชบางกอก <strong>สาขาสุขสวัสดิ์ 78</strong></h4>
			<address>
				888 หมู่ 8 ถนนสุขสวัสดิ์ 78 ตำบลบางจาก อำเภอพระประแดง สมุทรปราการ 10130 <br>
				โทร : 095-542-4542
			</address>
		</div>
	</div>
	<div class="row _mgbt-30">
		<div class="col-12 col-md-6">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.4001485382664!2d100.49300041482978!3d13.694197890384741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2988330874f2f%3A0x9d839f0d50d5eaa6!2z4Lir4LmJ4Liy4LiH4LiX4Lit4LiH4LmA4Lii4Liy4Lin4Lij4Liy4LiKIOC4muC4suC4h-C4geC4reC4gSDguKrguLLguILguLLguJXguKXguLLguJTguYDguKrguKPguLUgMg!5e0!3m2!1sth!2sth!4v1557303892712!5m2!1sth!2sth" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="col-12 col-md-6">
			<h4 class="light-title _fs-18">ห้างทองเยาวราชบางกอก <strong>สาขาตลาดเสรี 2</strong></h4>
			<address>
				10 ซอยเจริญกรุง 109 ถนนเจริญกรุง แขวงบางโคล่ เขตบางคอแหลม กรุงเทพฯ 10120 <br>
				โทร : 02-689-0677
			</address>
		</div>
	</div>
</div>
@endsection