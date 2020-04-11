<?php
   use App\Http\Controllers\Controller;
   use Illuminate\Support\Facades\DB;
   use App\GoldPrice;
   use Carbon\Carbon ;
   $goldPrice = DB::table('gold_prices')->first() ;

    $url = 'http://www.thaigold.info/RealTimeDataV2/gtdata_.txt';
	$data = "fn=login&test=1";

    try{
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    $content = curl_exec( $ch );
    curl_close($ch);

   // print_r($content);

  }catch(Exception $ex){

    echo $ex;
  }

  $obj = json_decode($content) ;

  foreach($obj as $val) {
	  if ($val->name=='สมาคมฯ') {
          $Sale = $val->ask ;
		  $Buy = $val->bid  ;
		  $diffSale = $val->diff ;
		  $diffBuy = $val->diff  ;

	  }
  }




  $date = Carbon::now('Asia/Bangkok') ;



 // $carbon = Carbon::now('Aca/New_York');

  $pdo =   DB::getPdo();
  $sql = 'update gold_prices set buy=?,sell=?,buy_change=?,sell_change=?,time_update=?,updated_at=?';
  try {
      $stmt = $pdo->prepare($sql) ;
      $params = array($Buy,$Sale,$diffBuy,$diffSale,$date,$date);
      $stmt->execute($params);

  } catch (Exception $e) {
      echo 'Message: ' .$e->getMessage();
  }

/*
  for (each $s as $a) {
    echo $a->ask . '::' ;
    echo $a->diff . '<br>';
  }
 // echo $s['ask'] . '::' ;
 // echo $s['diff'] . '<br>';
*/



?>
<div class="gold-price _pdt-50 _pdbt-90">
	<div class="container">
		<div class="row">
			<div class="col-12 _dp-f _fdrt-cl _fdrt-r-md _alit-bl _mgbt-30">
				<div class="_dp-ilf _fdrt-cl _fdrt-r-md _alit-bl">
					<h2 class="_fs-30 _cl-font-1 _fw-400 _mgbt-0 _mgbt-10">ราคาทองวันนี้</h2>
					<h4 class="_fs-18 _cl-font-1 _fw-400 _mgl-24-md _mgbt-0">ประจำวันที่ {{dateTh($goldPrice->time_update)}}</h4>
				</div>
				<div class="_mgl-at-md _cl-font-1 _fs-18">อัพเดทล่าสุด {{timeFromDate($goldPrice->updated_at)}} น.</div>
			</div>
			<div class="col-12 _dp-f _jtfct-ct _mgbt-24">
				<h2 class="_cl-second _fw-400 _fs-24 _fs-40-md _mgbt-0">ห้างทองเยาวราชบางกอก</h2>
			</div>
			<div class="col-12 _dp-f _jtfct-ct _alit-fe _fw-w _mgbt-40">
				<div class="_bgcl-third _cl-second gold-item _fs-40 _mgr-16-md _bdrd-5">ราคาทองแท่ง</div>
				<div class="_mgt-10 _mgt-0-md _mgr-16-md">
					<div class="_cl-gold _tal-ct">รับซื้อ (บาท)</div>
					<div class="_bgcl-second _cl-third gold-item _fs-50 _bdrd-5">{{number_format($goldPrice->buy)}}</div>
				</div>
				<div class="_mgt-10 _mgt-0-md _mgr-16-md">
					<div class="_cl-gold _tal-ct">ขายออก (บาท)</div>
					<div class="_bgcl-second _cl-third gold-item _fs-50 _bdrd-5">{{number_format($goldPrice->sell)}}</div>
				</div>
			</div>
			<div class="col-12 _dp-f _jtfct-ct">
				<div class="gold-item change _fw-w _bdw-5 _pdh-50 _bdrd-5">
					<div class="_cl-second _fs-40 _fw-400">วันนี้ทองปรับ</div>
					<div class="_mgl-at-md _dp-f _alit-ct">
						@if ($goldPrice->buy_change > 0)
							<i class="fas fa-caret-up _fs-30 _cl-success"></i>
							<div class="_cl-success _fs-40 _mgl-20">{{number_format($goldPrice->buy_change)}}</div>
						@else
							<i class="fas fa-caret-down _fs-30 _cl-primary"></i>
							<div class="_cl-primary _fs-40 _mgl-20">{{number_format(abs($goldPrice->buy_change))}}</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>