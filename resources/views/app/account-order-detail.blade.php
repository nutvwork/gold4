@extends('layouts.app')

@section('content')
<?php
    /*	function dateTh($strDate)
 {
     $strYear = date("Y", strtotime($strDate)) + 543;
     $strMonth = date("n", strtotime($strDate));
     $strDay = date("j", strtotime($strDate));
     $strMonthThai = getMonth($strMonth);
     return "$strDay $strMonthThai พ.ศ. $strYear";
 }

	function  timeFromDate22 ($sdate)  {

             return '11:11';
    }

	 function getMonth($index, $cut = false)
 {
     $full_month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม",
     );
     $cut_month = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
     if ($cut) {
         return $cut_month[$index];
     }
     return $full_month[$index];
 }

 function dateThTime($strDate)
 {
     $strYear = date("Y", strtotime($strDate)) + 543;
     $strMonth = date("n", strtotime($strDate));
     $strDay = date("j", strtotime($strDate));
     $strHour = date("H", strtotime($strDate));
     $strMinute = date("i", strtotime($strDate));
     $strSeconds = date("s", strtotime($strDate));
     $strMonthThai = getMonth($strMonth, true);
     return "$strDay $strMonthThai $strYear $strHour:$strMinute";
 }

  function timeFromDate($strDate)
 {
     $strHour = date("H", strtotime($strDate));
     $strMinute = date("i", strtotime($strDate));
     $strSeconds = date("s", strtotime($strDate));

     return "$strHour:$strMinute:$strSeconds";
 }
*/


?>
<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-20">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">ข้อมูลใบสั่งซื้อ</li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container">
	<div class="row">
		@include('app.components.sidebar-account')
		<div class="col-lg-9 order-lg-last dashboard-content">
			<h2 class="_mgbt-0">แจ้งชำระเงิน <small>เลขที่ใบเสร็จ #{{$order->id}}</small></h2>
			<div class="_cl-primary _fs-16 _mgt-10">*ใบสั่งซื้อจะถูกยกเลิกภายใน 1 ชั่วโมงเนื่องจากราคาทองอาจจะเปลี่ยนแปลงได้ตลอดเวลา
				กรุณาชำระเงินภายใน 1 ชั่วโมง</div>

			<div class="_bdbtw-1 _mgv-20 _bdcl-gray"></div>

			@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="_mg-0">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			@if (session('success'))
				<div class="alert alert-success">
					{{session('success')}}
				</div>
			@endif

			<div class="_mgv-40">
				<form action="{{route('account.order')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="order_id" value="{{$order->id}}">
					<div class="form-row form-group _alit-ct">
						<label for="" class="col-md-2 col-form-label">ธนาคาร</label>
						<div class="col-md-6">
							<select name="bank_id" class="form-control form-control-sm" required>
								<option value="">เลือกธนาคาร</option>
								@foreach ($banks as $item)
									@if (old('bank_id') == $item->id)
									<option value="{{$item->id}}" selected>{{$item->bank_name}} ({{$item->account_no}})</option>
									@else
									<option value="{{$item->id}}">{{$item->bank_name}} ({{$item->account_no}})</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>
                    <?php
                         $transfer = number_format($order->total + $order->shipping_price,0) ;
						 $transfer = number_format($order->total + $order->shipping_price,2) ;
						 $transfer = $order->total + $order->shipping_price;



					?>
					<div class="form-row form-group _alit-ct">
						<label for="" class="col-md-2 col-form-label">จำนวนที่โอน</label>
						<div class="col-md-6">
							<input name="amount" type="text"  pattern="([0-9]+.{0,1}[0-9]*,{0,1})*[0-9]"  step="1" class="form-control form-control-sm"
							value="{{$order->total + $order->shipping_price }}" required>
						</div>
					</div>

					<div class="form-row form-group _alit-ct">
						<label for="" class="col-md-2 col-form-label">วันที่โอน</label>
						<div class="col-md-2 _mgbt-10">
							<select name="day" class="form-control form-control-sm" required>
								<option value="">วันที่</option>
								@for ($i = 1; $i <= 31; $i++)
									<option value="{{$i}}"
									@if($i === $now->day) selected @endif>{{$i < 10 ? '0'.$i : $i}}</option>
								@endfor
							</select>
						</div>
						<div class="col-md-2 _mgbt-10">
							<select name="month" class="form-control form-control-sm" required>
								<option value="">เดือน</option>

								@for ($i = 1; $i <= 12; $i++)
									<option value="{{$i}}"
									@if($i === $now->month) selected @endif>{{$i < 10 ? '0'.$i : $i}}</option>
								@endfor
							</select>
						</div>
						<div class="col-md-2 _mgbt-10">
							<select name="year" class="form-control form-control-sm" required>
								<option value="{{$now->year}}" selected>{{$now->year}}</option>
							</select>
						</div>
					</div>

					<div class="form-row form-group _alit-ct">
						<label for="" class="col-md-2 col-form-label">เวลาที่โอน</label>
						<div class="col-5 col-md-2">
							<select name="hour" class="form-control form-control-sm" required>
								@for ($i = 0; $i <= 23; $i++)
									@if(empty(old('hour')))
										<option value="{{$i}}"
										@if($i === $now->hour) selected @endif
										>{{$i < 10 ? '0'.$i : $i}}</option>
									@else
										<option value="{{$i}}"
										@if(old('hour') == $i) selected @endif
										>{{$i < 10 ? '0'.$i : $i}}</option>
									@endif
								@endfor
							</select>
						</div>
						<span class="_fw-600">:</span>
						<div class="col-5 col-md-2">
							<select name="minute" class="form-control form-control-sm" required>
								@for ($i = 0; $i <= 59; $i++)
									@if(empty(old('minute')))
										<option value="{{$i}}"
										@if($i === $now->minute) selected @endif
										>{{$i < 10 ? '0'.$i : $i}}</option>
									@else
										<option value="{{$i}}"
										@if(old('minute') == $i) selected @endif
										>{{$i < 10 ? '0'.$i : $i}}</option>
									@endif
								@endfor
							</select>
						</div>
					</div>

					<div class="form-row form-group _alit-ct">
						<label for="" class="col-md-2 col-form-label">อัพโหลดสลิป</label>
						<div class="col-md-6">
							<button id="select-img" type="button" class="btn _bgcl-gray _cl-second">เลือกรูปภาพ</button>
							<input type="file" name="slip" class="_dp-n" id="customFile" accept="image/*">
						</div>
					</div>

					<div class="_bdrd-4 _ovf-hd form-group">
						<img id="imgShow" class="img-fluid _dp-b _mgh-at" src="" style="max-width: 350px;">
					</div>

					<button type="submit" class="btn btn-secondary _mgt-10">แจ้งชำระเงิน</button>
				</form>
			</div>

			<div class="table-responsive _mgt-30">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>ธนาคาร</th>
							<th>เลขที่บัญชี</th>
							<th>ชื่อบัญชี</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($banks as $item)
							<tr>
								<td class="_vtcal-md">
									<img src="{{asset($item->url_image)}}" alt="bank images" width="40px">
								</td>
								<td class="_vtcal-md">{{$item->bank_name}}</td>
								<td class="_vtcal-md">{{$item->account_no}}</td>
								<td class="_vtcal-md">{{$item->account_name}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="_bdbtw-1 _mgv-20 _bdcl-gray"></div>

			<div class="row _mgt-30">
				<div class="col-md-3 _mgbt-10 _dp-f _fdrt-cl">
					<div class="_fs-16 _cl-font-3 _fw-600">วันที่สั่งซื้อ</div>
					<div>{{dateTh($order->created_at)}}</div>
					<div>เวลา: {{timeFromDate($order->created_at)}}</div>
					<div class="_cl-primary">หมดอายุเวลา: {{timeFromDate($order->due_date())}}</div>

				</div>
				<div class="col-md-3 _mgbt-10 _dp-f _fdrt-cl">
					<div class="_fs-16 _cl-font-3 _fw-600">เลขที่ใบเสร็จ</div>
					#{{$order->id}}
				</div>
				<div class="col-md-5 _mgbt-10 _dp-f _fdrt-cl">
					<div class="_fs-16 _cl-font-3 _fw-600">ที่อยู่ในการส่งสินค้า</div>
					<span>ชื่อ: {{$order->name}}</span>
					<span>ที่อยู่: {{$order->address1}} {{$order->address2}}</span>
					<span>อำเภอ: {{$order->amphoe}}</span>
					<span>จังหวัด: {{$order->provinceData->name}}</span>
					<span>เบอร์โทร: {{$order->phone}}</span>
				</div>
			</div>

			<div class="table-responsive _mgt-30 _mgbt-50">
				<table class="table">
					<thead>
						<tr>
							<th>ชื่อสินค้า</th>
							<th>น้ำหนัก</th>
							<th class="_tal-ct">จำนวน</th>
							<th>ราคารวม</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($order->details as $item)
							<tr>
								<td>
									<a href="{{route('product', ['product' => $item->product->slug])}}" target="_blank">
										{{$item->product->name}}
									</a>
								</td>
								<td>{{$item->weight_text}} {{$item->weight_type}}</td>
								<td class="_tal-ct">{{$item->quantity}}</td>
								<td>{{number_format($item->price * $item->quantity, 2)}}</td>
							</tr>
						@endforeach

						<tr>
							<td colspan="2"></td>
							<td class="_tal-r">รวม</td>
							<td>{{number_format($order->total, 2)}}</td>
						</tr>
						<tr>
							<td colspan="2" class="_bdw-0"></td>
							<td class="_tal-r _bdw-0">ค่าส่ง</td>
							<td>{{number_format($order->shipping_price, 2)}}</td>
						</tr>
						<tr>
							<td colspan="2" class="_bdw-0"></td>
							<td class="_tal-r _bdw-0">ราคาสุทธิ</td>
							<td>{{number_format($order->total + $order->shipping_price, 2)}}</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div><!-- End .col-lg-9 -->
	</div>
</div>
@endsection

@section('main.script')
	<script>
		$('#select-img').click(function () {
			$('#customFile').click();
		})

		function bindFileInputImage(input, img) {
			if (!input || !img) return
			input.onchange = () => {
				const fp = input.files && input.files[0]
				if (fp) {
					const reader = new window.FileReader()
					reader.onload = (e) => {
						img.src = e.target.result
					}
					reader.readAsDataURL(fp)
				}
			}
		}

		bindFileInputImage(
			document.querySelector('#customFile'),
            document.querySelector('#imgShow')
		)
	</script>
@endsection