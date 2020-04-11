@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-20">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">รายการสั่งซื้อ</li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container">
	<div class="row">
		@include('app.components.sidebar-account')
		<div class="col-lg-9 order-lg-last dashboard-content" style="min-height: 50vh;">

			@if (session('success'))
				<div class="alert alert-success">
					{{session('success')}}
				</div>
			@endif
			<h2>รายการสั่งซื้อ</h2>

			<table class="table">
				<thead>
					<tr>
						<th class="_tal-ct">เลขที่สั่งซื้อ</th>
						<th>เวลาหมดอายุใบสั่งซื้อ</th>
						<th>ยอดสั่งซื้อ</th>
						<th>สถานะ</th>
						<th>ตรวจสอบ</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($orders as $item)
						<tr>
							<td class="_tal-ct _vtcal-md" style="width: 100px;">{{$item->id}}</td>
							<td class="_vtcal-md _cl-primary">{{dateTh($item->created_at)}} {{timeFromDate($item->due_date())}}</td>
							<td class="_vtcal-md">{{number_format($item->total + $item->shipping_price, 2)}}</td>
							<td class="_vtcal-md">{{$item->status_text}}</td>
							<td class="_vtcal-md">
								<a href="{{route('account.order', ['id' => $item->id])}}" class="btn btn-sm _bgcl-gray _cl-second _pd-10">แจ้งชำระเงิน</a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="5" class="_tal-ct">ยังไม่มีใบสั่งซื้อ</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div><!-- End .col-lg-9 -->
	</div>
</div>
@endsection