@extends('layouts.app')

@section('content')
<div class="container _mgt-50 _mgbt-80">
	<nav class="toolbox _bdbtw-1 _bdcl-border _mgbt-30">
		<div class="toolbox-left">
			<h1 class="_fs-30 _cl-font-2 _fw-400">บทความ</h1>
		</div><!-- End .toolbox-left -->
	</nav>

	<div class="row _mgv-40">
		@foreach ($blogs as $item)
		<div class="col-md-4 _mgbt-16 _mgbt-20-lg">
			<a class="_bdrd-2 _ovf-hd _dp-b" href="{{route('blog.single', ['blog' => $item->slug])}}">
				<img src="{{asset($item->cover)}}">
			</a>
			<div class="_mgt-20 _fs-24 _lh-125pct">
				<a class="_cl-font-1" href="{{route('blog.single', ['blog' => $item->slug])}}">
					{{str_limit($item->title, 60)}}
				</a>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection