@extends('web.layouts.app')
@section('content')
    @push('styles')
    <style>
        .blog-item.large-blog {
            box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            background: #f5f5f5;
            border-bottom: 3px solid #f57200;
        }
        .blog-item .bi-text {
            padding: 31px;
        }
        .blog-item.large-blog .bi-pic img{ max-height: 400px;}
        .blog-sidebar {
            -webkit-box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            background: #fff;
            padding: 25px;
            margin-top: 55px;
        }
        .blog-pagination {
                padding-bottom: 0
        }
        .blog-item .bi-text ul li {
            font-size: 15px;
            display: block;
        }
        .blog-details-content .bc-quote {
    overflow: hidden;
    margin-bottom: 6px;
}
.blog-details-content .bc-quote .bq-icon {
    width: 75px;
    height: 75px;
    border: 1px solid #e1e1e1;
    border-radius: 50%;
    line-height: 75px;
    text-align: center;
    font-size: 30px;
    color: #f57200;
    float: left;
    margin-right: 20px;
}
.blog-details-content .bc-quote .bq-text {
    overflow: hidden;
}
.blog-details-content .bc-quote .bq-text p {
    color: #111111;
    font-size: 16px;
    font-weight: 600;
    font-style: italic;
    line-height: 30px;
}
.bc-pic img{
    cursor: default;
    width: 100%;
    max-height: 400px;
}
.blog-details-content .bc-widget .comment-option .co-item {
    overflow: hidden;
    margin-bottom: 20px;
}
.blog-details-content .bc-widget .comment-option .co-item .ci-pic {
    float: left;
    margin-right: 25px;
}
.blog-details-content .bc-widget .comment-option .co-item .ci-pic img {
    height: 90px;
    width: 90px;
    border-radius: 50%;
}
.blog-details-content .bc-widget .comment-option .co-item .ci-text {
    overflow: hidden;
    position: relative;
}
.blog-details-content .bc-widget .comment-option .co-item .ci-text h5 {
    color: #111111;
    font-weight: 700;
    margin-bottom: 13px;
}
.blog-details-content .bc-widget .comment-option .co-item .ci-text p {
    font-size: 15px;
    line-height: 26px;
}
.blog-details-content .bc-widget .comment-option .co-item .ci-text ul {
    position: absolute;
    right: 0;
    top: 0;
}
.blog-details-content .bc-widget .comment-option .co-item .ci-text ul li {
    list-style: none;
    font-size: 12px;
    color: #888888;
    margin-right: 25px;
    display: inline-block;
}
.blog-details-content .bc-widget .comment-option .co-item .ci-text ul li i {
    font-size: 14px;
    color: #f57200;
    margin-right: 5px;
}
.blog-hero-section {
    height: 400px;
}
@media only screen and (max-width: 767px){
    .blog-details-content .bc-widget .comment-option .co-item .ci-text ul {
        position: relative !important;
    }
}
        @media (max-width: 991px){
            .mainleft {
                padding: 0;
                margin-top: 0;
            }
            .blog-sidebar {margin-top: 0;}
        }
    </style>
    @endpush
    <section class="blog-hero-section set-bg" data-setbg="{{asset('web/new')}}/img/blog.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bh-text">
                        <h4>{{$blog->name}}</h4>
                        <ul>
                            <li><i class="fa fa-user"></i> {{ trans('web.by') }} {{$blog->user->name}}</li>
                            <li><i class="fa fa-clock-o"></i> {{$blog->time_ago}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!--end hero section-->
<!-- Blog Hero Section Begin -->
<!-- Blog Details Section Begin -->
<section class="blog-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 p-0">
                <div class="blog-details-content">
                    <div class="bc-details">
                        <div class="bc-pic">
                            <img src="{{$blog->image->url}}" alt="">
                        </div>
                        <div class="bc-text mt-4">
                            <div class="bc-quote">
                                <div class="bq-icon">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="bq-text mt-3">
                                    <h3>{{$blog->name}}</h3>
                                </div>
                            </div>
                            <p>{!!$blog->text!!}</p>
                    </div>
                    @if ($blog->allow_comment == 1)
                    <div class="bc-widget mt-5 mb-3">
                        <div class="section-title sidebar-title-b">
                            <h4>{{ trans('web.Comments') }}</h4>
                        </div>
                        <div class="comment-option">
                            @foreach ($comments as $comment)
                            <div class="co-item">
                                <div class="ci-pic">
                                    <img src="{{$comment->user ? $comment->user->image : 'http://localhost/deelmy/deelmy/web/images/person.png'}}" alt="">
                                </div>
                                <div class="ci-text">
                                    <h5>{{$comment->user ? $comment->user->name : $comment->user_name}}</h5>
                                    <p>{{$comment->comment}}</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i>{{$comment->time_ago}}</li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                    <div class="bc-widget mt-5">
                        <div class="section-title sidebar-title-b">
                            <h4>{{ trans('web.Leave a Reply') }}</h4>
                        </div>
                        <form action="{{url('blog/sendMessage')}}" class="leave-comment-form" method="POST">
                            @csrf
                            <input type="hidden" name="ads_id" value="{{$blog->id}}">
                            @if (Auth::guest())
                            <div class="group-input">
                                <input type="text" name="name" id="name"  placeholder="{{trans('web.Name')}}">
                                <input type="text"  name="email" id="email" placeholder="{{trans('web.Email')}}">
                            </div>
                            @endif
                            <textarea placeholder="{{trans('web.Comment')}}" name="message"></textarea>
                            <button type="submit" class="site-btn">{{trans('web.Submit')}}</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="blog-sidebar">
                <div class="feature-post">
                    <div class="section-title sidebar-title-b">
                        <h4>{{trans('web.Latest Blogs')}}</h4>
                    </div>
                    <div class="recent-post">
                        @foreach ($latestblogs as $latestblog)
                        <div class="rp-item row">
                            <div class="rp-pic m-0 col-4 p-0">
                                <img src="{{$latestblog->image->url}}" width="100%">
                            </div>
                            <div class="rp-text col-8">
                                <h6><a href="{{url('blogDetails/'.$latestblog->id)}}">{!! \Illuminate\Support\Str::limit($latestblog->name, 30,'...') !!}</a></h6>
                                <i class="fa fa-user"></i> {{$latestblog->user->name}} <br>
                                <i class="fa fa-clock-o"></i> {{$latestblog->time_ago}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- Blog Details Section End -->
	<!--================Blog Area =================-->
