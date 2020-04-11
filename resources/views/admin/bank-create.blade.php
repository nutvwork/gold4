@extends('layouts.admin')

@section('content-title')
	สร้างธนาคาร
@endsection

@section('content')
@if(session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>
@endif

@if ($errors->any())
	<div class="alert alert-danger">
		<ul class="_mgbt-0">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<form action="{{route('admin.bank.create')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label>ขื่อธนาคาร</label>
		<select name="bank_name" class="form-control" required>
			<option value="">เลือกธนาคาร</option>
			<option value="กรุงเทพ">กรุงเทพ</option>
			<option value="กสิกรไทย">กสิกรไทย</option>
			<option value="กรุงไทย">กรุงไทย</option>
			<option value="ทหารไทย">ทหารไทย</option>
			<option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
			<option value="กรุงศรีอยุธยา">กรุงศรีอยุธยา</option>
			<option value="เกียรตินาคิน">เกียรตินาคิน</option>
			<option value="ซีไอเอ็มบีไทย">ซีไอเอ็มบีไทย</option>
			<option value="ทิสโก้">ทิสโก้</option>
			<option value="ธนชาต">ธนชาต</option>
			<option value="ยูโอบี">ยูโอบี</option>
			<option value="แลนด์ แอนด์ เฮาส์">แลนด์ แอนด์ เฮาส์</option>
			<option value="ออมสิน">ออมสิน</option>
		</select>
	</div>
	<div class="form-group">
		<label>ชื่อบัญชี</label>
		<input type="text" class="form-control" name="account_name" required>
	</div>
	<div class="form-group">
		<label>เลขที่บัญชี</label>
		<input type="text" class="form-control" name="account_no" placeholder="ตัวอย่าง: xxx-x-xxxxx-x" required>
	</div>
	<div class="form-group">
		<label for="">รูปภาพ</label>
		<div class="custom-file">
			<input type="file" name="image" class="custom-file-input" id="customFile" lang="th" accept="image/*" required>
			<label class="custom-file-label form-control-sm _dp-ilb" id="btn-customFile" for="customFile">รูปภาพ</label>
		</div>
		<small class="form-text text-muted">ขนาดรูปภาพที่แนะนำ 100x100 px</small>
	</div>
	<div class="_bdrd-4 _ovf-hd _mgbt-16">
		<img id="imgShow" class="img-fluid _dp-b _mgh-at" src="">
	</div>
	<div class="form-group">
		<button class="btn btn-success px-5 mr-4">บันทึก</button>
		<a href="{{route('admin.bank')}}" class="btn btn-secondary">ยกเลิก</a>
	</div>
</form>
@endsection

@section('main.script')
    <script>
        $(document).ready(function() {
            bindFileInputImage(
                document.querySelector('#customFile'),
                document.querySelector('#imgShow')
            )
        })
    </script>
@endsection