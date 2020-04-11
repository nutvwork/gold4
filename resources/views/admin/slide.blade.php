@extends('layouts.admin')

@section('content-title')
	แสดงสไลด์
@endsection
@section('content')
@if(session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>
@endif

<!--begin::Content-->
<div class="tab-content">
	<!--begin::m-widget5-->
	<div class="m-widget5">
		@forelse ($slides as $item)
			<div class="m-widget5__item">
				<div class="m-widget5__content">
					<div class="m-widget5__pic">
						<img class="m-widget7__img" src="{{asset($item->value)}}">
					</div>
					<div class="m-widget5__section">
						<div class="m-widget5__info">
							<span class="m-widget5__info-label">
								สร้างเมื่อ:
							</span>
							<span class="m-widget5__info-date m--font-info">
								{{dateThTime($item->created_at)}}
							</span>
						</div>
					</div>
				</div>
				<div class="m-widget5__content">
					<form class="ml-0 ml-md-4 mt-4 mt-md-0 d-inline-block" action="{{route('admin.slide.delete')}}" method="POST"
					onsubmit="return confirm('ต้องการลบภาพสไลด์ใช่ หรือไม่')">
						@csrf
						<input type="hidden" name="slide_id" value="{{$item->id}}">
						<button type="submit" class="btn btn-sm btn-danger m-btn m-btn--custom m-btn--icon">
							<span>
								<i class="la la-trash"></i>
								<span>ลบ</span>
							</span>
						</button>
					</form>
				</div>
			</div>
		@empty
			<div class="text-center">ยังไม่มีรูปสไลด์</div>
		@endforelse
	</div>

	<!--end::m-widget5-->
</div>

<!--end::Content-->
@endsection