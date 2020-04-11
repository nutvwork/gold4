@extends('layouts.admin')

@section('content-title')
	แก้ไขธนาคาร
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

<form action="{{route('admin.bank.update')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="id" value="{{$bank->id}}">
	<div class="form-group">
		<label>ขื่อธนาคาร</label>
		<select name="bank_name" class="form-control" required>
			<option value="">เลือกธนาคาร</option>
			<option value="กรุงเทพ" @if($bank->bank_name === 'กรุงเทพ') selected @endif>กรุงเทพ</option>
			<option value="กสิกรไทย" @if($bank->bank_name === 'กสิกรไทย') selected @endif>กสิกรไทย</option>
			<option value="กรุงไทย" @if($bank->bank_name === 'กรุงไทย') selected @endif>กรุงไทย</option>
			<option value="ทหารไทย" @if($bank->bank_name === 'ทหารไทย') selected @endif>ทหารไทย</option>
			<option value="ไทยพาณิชย์" @if($bank->bank_name === 'ไทยพาณิชย์') selected @endif>ไทยพาณิชย์</option>
			<option value="กรุงศรีอยุธยา" @if($bank->bank_name === 'กรุงศรีอยุธยา') selected @endif>กรุงศรีอยุธยา</option>
			<option value="เกียรตินาคิน" @if($bank->bank_name === 'เกียรตินาคิน') selected @endif>เกียรตินาคิน</option>
			<option value="ซีไอเอ็มบีไทย" @if($bank->bank_name === 'ซีไอเอ็มบีไทย') selected @endif>ซีไอเอ็มบีไทย</option>
			<option value="ทิสโก้" @if($bank->bank_name === 'ทิสโก้') selected @endif>ทิสโก้</option>
			<option value="ธนชาต" @if($bank->bank_name === 'ธนชาต') selected @endif>ธนชาต</option>
			<option value="ยูโอบี" @if($bank->bank_name === 'ยูโอบี') selected @endif>ยูโอบี</option>
			<option value="แลนด์ แอนด์ เฮาส์" @if($bank->bank_name === 'แลนด์ แอนด์ เฮาส์') selected @endif>แลนด์ แอนด์ เฮาส์</option>
			<option value="ออมสิน" @if($bank->bank_name === 'ออมสิน') selected @endif>ออมสิน</option>
		</select>
	</div>
	<div class="form-group">
		<label>ชื่อบัญชี</label>
		<input type="text" class="form-control" name="account_name" value="{{$bank->account_name}}" required>
	</div>
	<div class="form-group">
		<label>เลขที่บัญชี</label>
		<input type="text" class="form-control" name="account_no" placeholder="ตัวอย่าง: xxx-x-xxxxx-x" value="{{$bank->account_no}}" required>
	</div>
	<div class="form-group">
		<label for="">รูปภาพ</label>
		<div class="custom-file">
			<input type="file" name="image" class="custom-file-input" id="customFile" lang="th" accept="image/*">
			<label class="custom-file-label form-control-sm _dp-ilb" id="btn-customFile" for="customFile">รูปภาพ</label>
		</div>
		<small class="form-text text-muted">ขนาดรูปภาพที่แนะนำ 100x100 px</small>
	</div>
	<div class="_bdrd-4 _ovf-hd _mgbt-16">
		<img id="imgShow" class="img-fluid _dp-b _mgh-at" src="{{asset($bank->url_image)}}">
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