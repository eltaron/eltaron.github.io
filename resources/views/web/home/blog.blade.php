@extends('web.layouts.app')
@section('content')
@push('styles')
    <link rel="stylesheet" href="{{asset('web')}}/css/blog.css">
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
        @media (max-width: 991px){
            .mainleft {
                padding: 0;
                margin-top: 0;
            }
            .blog-sidebar {margin-top: 0;}
        }
    </style>
@endpush
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section spad set-bg" data-setbg="{{asset('web/new')}}/img/blog.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h4>{{trans('web.Blogs')}}</h4>
                        <div class="bt-option">
                            <a href="./index.html"><i class="fa fa-home"></i>{{trans('web.Home')}} </a>
                            <span>{{trans('web.Blogs')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
 <!-- Blog Section Begin -->
 <section class="blog-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title sidebar-title-b">
                    <h4>{{trans('web.All Blogs')}}</h4>
                </div>
                <div class="blog-item-list">
                    @foreach ( $blogs as $blog )
                    <div class="blog-item large-blog">
                        <div class="bi-pic">
                            <img src="{{$blog->image->url}}" alt="">
                        </div>
                        <div class="bi-text">
                            <h4><a href="{{url('blogDetails/'.$blog->id)}}">{{ \Illuminate\Support\Str::limit($blog->name, 50, '...') }}</a></h4>
                            <ul style="font-size: 20px">
                                <li><i class="fa fa-user"></i> {{ trans('web.by') }} {{$blog->user->name}}</li>
                                <li><i class="fa fa-clock-o"></i> {{$blog->time_ago}}</li>
                            </ul>
                            <p class="mb-3">{{ \Illuminate\Support\Str::limit($blog->text, 150, '...') }}</p>
                            <a href="{{url('blogDetails/'.$blog->id)}}" class="read-more">{{trans('web.Read more')}}<span class="arrow_right"></span></a>
                        </div>
                    </div>
                    @endforeach()
                </div>
                <div class="blog-pagination property-pagination ">
                    {{ $blogs->links('web.pagination.index') }}
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
    </div>
</section>
<!-- Blog Section End -->


@endsection
