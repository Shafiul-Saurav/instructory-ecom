@extends('frontend.layouts.master')
@section('frontend_title')
    Shop Page
@endsection

@section('frontend_content')
@include('frontend.layouts.inc.breadcrumb', ['pagename' => 'Blog'])

<!-- blog-area start -->
<div class="blog-area">
    <div class="container">
        <div class="col-lg-12">
            <div class="section-title  text-center">
                <h2>Latest News</h2>
                <img src="{{ asset('assets/frontend') }}/images/section-title.png" alt="">
            </div>
        </div>
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-lg-4  col-md-6 col-12">
                <div class="blog-wrap">
                    <div class="blog-image">
                        <img src="{{ asset('uploads/posts') }}/{{ $post->post_image }}" alt="">
                        <ul>
                            <li>{{ $post->created_at->format('d') }}</li>
                            <li>{{ $post->created_at->format('M') }}</li>
                        </ul>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> {{ $post->user->name }}</a></li>
                                <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i> {{ $post->created_at->format('d M Y') }}</a></li>
                            </ul>
                        </div>
                        <h3><a href="{{ route('single.post', ['post_slug' => $post->post_slug]) }}">{{ $post->post_name }}</a></h3>
                        <p>{{ $post->post_description }}</p>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-12 text-center d-flex justify-content-center">
                <div class="py-3">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog-area end -->

@endsection
