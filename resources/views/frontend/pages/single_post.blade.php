@extends('frontend.layouts.master')
@section('frontend_title')
    Shop Page
@endsection

@section('frontend_content')
@include('frontend.layouts.inc.breadcrumb', ['pagename' => $post->post_name])
<!-- blog-details-area start-->
<div class="blog-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-details-wrap">
                    <img src="{{ asset('uploads/posts') }}/{{ $post->post_image }}" alt="">
                    <h3>{{ $post->post_name }}</h3>
                    <ul class="meta">
                        <li>{{ $post->created_at->format('d M Y') }}</li>
                        <li>By {{ $post->user->name }}</li>
                    </ul>
                    <p>{{ $post->post_description }}</p>
                    <p>{{ $post->long_description }}</p>
                    <div class="share-wrap">
                        <div class="row">
                            <div class="col-sm-7 ">
                                <ul class="socil-icon d-flex">
                                    <li>share it on :</li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <div class="col-sm-5 text-right">
                                <a href="javascript:void(0);">Next Post <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-form-area">
                    <div class="comment-main">
                        <h3 class="blog-title">Comments:</h3>
                        <ol class="comments">
                            <li class="comment even thread-even depth-1">
                                @foreach ($post->comments as $comment)
                                <div class="comment-wrap">
                                    <div class="comment-theme">
                                        <div class="comment-image">
                                            <img src="{{ asset('uploads/users') }}/{{ $comment->user->profile->user_image }}"
                                class="img-fluid rounded-circle" alt="" style="width:80px; height:80px;">
                                        </div>
                                    </div>
                                    <div class="comment-main-area">
                                        <div class="comment-wrapper">
                                            <div class="sewl-comments-meta">
                                                <h4>{{ $comment->user->name }} </h4>
                                                <span>{{ $comment->created_at->format('d M Y') }} | --{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="comment-area">
                                                <p>{{ $comment->commentor_comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </li>
                        </ol>
                    </div>
                    <div id="respond" class="sewl-comment-form comment-respond form-style">
                        <h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
                        <form action="{{ route('post_comment.store') }}" method="post" id="commentform" class="comment-form">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="sewl-form-textarea no-padding-right">
                                        <input type="hidden" value="{{ $post->id }}" name="post_slug">
                                        <textarea id="comment" name="commentor_comment" tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..."></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-submit">
                                        <input name="submit" id="submit" value="Send" type="submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <aside class="sidebar-area">
                    <div class="widget widget_categories">
                        <h4 class="widget-title">All Categories</h4>
                        <ul>
                            @foreach ($postCategories as $postCategory)
                            <li><a href="#">{{ $postCategory->category_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget_categories">
                        <h4 class="widget-title">Related Category</h4>
                        <ul>
                            <li><a href="#">{{ $post->category->category_name }}</a></li>
                        </ul>
                    </div>
                    <div class="widget widget_categories">
                        <h4 class="widget-title">Related Subcategory</h4>
                        <ul>
                            <li><a href="#">{{ $post->subcategory->subcategory_name }}</a></li>
                        </ul>
                    </div>
                    <div class="widget widget_recent_entries recent_post">
                        <h4 class="widget-title">Recent Post</h4>
                        <ul>
                            @foreach ($recent_posts as $recent_post)
                            <li>
                                <div class="post-img">
                                    <img src="{{ asset('uploads/posts') }}/{{ $recent_post->post_image }}" alt="" style="width:90px; height:70px;">
                                </div>
                                <div class="post-content">
                                    <a href="{{ route('single.post', ['post_slug' => $recent_post->post_slug]) }}"> {{ $recent_post->post_name }}</a>
                                    <p>{{ $recent_post->created_at->format('d M Y') }}</p>
                                </div>
                            </li>
                            @endforeach


                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- blog-details-area end -->

@endsection
