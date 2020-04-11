<?php
   use App\Topic;
  $allTopics = Topic::all();
?>
@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav _mgt-20">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page">{{$blog->title}}</li>
		</ol>
	</div><!-- End .container -->
</nav>

<div class="container">
	<div class="row">
		<div class="col-lg-9">
			<article class="entry single">
				<div class="entry-media">
					<img src="{{$blog->cover_full}}" alt="blog cover">
				</div><!-- End .entry-media -->

				<div>

					<h2 class="entry-title">
						{{$blog->title}}
					</h2>

					<div class="entry-meta">
						<span><i class="icon-calendar"></i>{{dateTh($blog->created_at)}}</span>
					</div><!-- End .entry-meta -->

					<div class="entry-content">
						<p class="_wsp-pw">{{$blog->body}}</p>
					</div><!-- End .entry-content -->

					<div class="entry-share">
						<h3>
							<i class="icon-forward"></i>
							แชร์บทความ
						</h3>

						<div class="social-icons">
							<a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank">
								<i class="icon-facebook"></i>
								<span>facebook</span>
							</a>
						</div><!-- End .social-icons -->
					</div><!-- End .entry-share -->
				</div><!-- End .entry-body -->
			</article><!-- End .entry -->

			@if(count($relateBlog))
			<div class="related-posts">
				<h4 class="light-title">บทความอื่นๆ</h4>

				<div class="owl-carousel owl-theme related-posts-carousel">
					@foreach ($relateBlog as $item)
					<article class="entry">
						<div class="entry-media">
							<a href="{{route('blog.single', ['blog' => $item->slug])}}">
								<img src="{{asset($item->cover)}}" alt="blog cover">
							</a>
						</div><!-- End .entry-media -->

						<h2 class="entry-title">
							<a href="{{route('blog.single', ['blog' => $item->slug])}}">{{$item->title}}</a>
						</h2>
					</article>
					@endforeach
				</div><!-- End .owl-carousel -->
			</div><!-- End .related-posts -->
			@endif
		</div><!-- End .col-lg-9 -->

		<aside class="sidebar col-lg-3">
			<div class="sidebar-wrapper">

				<div class="widget widget-categories">
					<h4 class="widget-title">หมวดหมู่สินค้า</h4>

					<ul class="list">
						@foreach ($allTopics as $item)
						<li><a href="/topic/{{$item->slug}}">{{$item->name}}</a></li>
						@endforeach
					</ul>
				</div><!-- End .widget -->
			</div><!-- End .sidebar-wrapper -->
		</aside><!-- End .col-lg-3 -->
	</div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-6"></div><!-- margin -->
@endsection