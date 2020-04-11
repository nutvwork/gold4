@extends('layouts.admin')


@section('content-title')
	แดชบอร์ด
@endsection

@section('content')
<div class="row m-row--no-padding m-row--col-separator-xl">
	<div class="col-md-12 col-lg-6 col-xl-3">

		<!--begin::Total Profit-->
		<div class="m-widget24 _pdh-20 _pdv-40">
			<h4 class="_cl-font-2 _fs-14 _fw-600">ยอดขายวันนี้</h4>
			<div class="m--font-brand _fw-600 _fs-24">
				{{number_format($totalToday->total, 2)}}
			</div>
		</div>

		<!--end::Total Profit-->
	</div>
	<div class="col-md-12 col-lg-6 col-xl-3">
		<div class="m-widget24 _pdh-20 _pdv-40">
			<h4 class="_cl-font-2 _fs-14 _fw-600">ยอดขายเดือนนี้</h4>
			<div class="m--font-info _fw-600 _fs-24">
				{{number_format($totalMonth->total, 2)}}
			</div>
		</div>
	</div>
	<div class="col-md-12 col-lg-6 col-xl-3">
		<div class="m-widget24 _pdh-20 _pdv-40">
			<h4 class="_cl-font-2 _fs-14 _fw-600">ยอดขายปีนี้</h4>
			<div class="m--font-danger _fw-600 _fs-24">
				{{number_format($totalYear->total, 2)}}
			</div>
		</div>
	</div>
	<div class="col-md-12 col-lg-6 col-xl-3">
		<div class="m-widget24 _pdh-20 _pdv-40">
			<h4 class="_cl-font-2 _fs-14 _fw-600">จำนวนคนสมัคร</h4>
			<div class="m--font-warning _fw-600 _fs-24">
				{{number_format($userCount)}}
			</div>
		</div>
	</div>
</div>
@endsection
