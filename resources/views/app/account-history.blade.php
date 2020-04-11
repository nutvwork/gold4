@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-20">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">ประวัติการสั่งซื้อ</li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container">
	<div class="row">
		@include('app.components.sidebar-account')
		<div class="col-lg-9 order-lg-last dashboard-content" style="min-height: 50vh;">
			<h2>ประวัติการสั่งซื้อ</h2>

			<table class="table">
				<thead>
					<tr>
						<th class="_tal-ct">เลขที่สั่งซื้อ</th>
						<th>วันที่สั่งซื้อ</th>
						<th>สถานะ</th>
						<th>ตรวจสอบ</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($orders as $item)
						<tr>
							<td class="_tal-ct _vtcal-md" style="width: 100px;">{{$item->id}}</td>
							<td class="_vtcal-md">{{dateTh($item->created_at)}}</td>
							<td class="_vtcal-md">{{$item->status_text}}</td>
							<td class="_vtcal-md">
								<a href="{{route('account.history', ['id' => $item->id])}}" class="btn btn-sm _bgcl-gray _cl-second _pd-10">ดูใบสั่งซื้อ</a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4" class="_tal-ct">ยังไม่มีใบสั่งซื้อ</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div><!-- End .col-lg-9 -->
	</div>
</div>
@endsection