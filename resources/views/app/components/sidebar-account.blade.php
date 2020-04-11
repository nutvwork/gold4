<?php
$routeName = 'account.order' ;
?>
<aside class="sidebar col-lg-3">
	<div class="widget widget-dashboard">
		<h3 class="widget-title">จัดการบัญชี</h3>
		<ul class="list">
			<li class="{{ $routeName === 'account' ? 'active' : '' }}"><a href="{{route('account')}}">แก้ไขข้อมูล</a></li>
			<li class="{{ $routeName === 'account.order' ? 'active' : '' }}"><a href="{{route('account.order')}}">รายการสั่งซื้อ</a></li>
			<li class="{{ $routeName === 'account.history' ? 'active' : '' }}"><a href="{{route('account.history')}}">ประวัติการสั่งซื้อ</a></li>
		</ul>
	</div><!-- End .widget -->
</aside><!-- End .col-lg-3 -->