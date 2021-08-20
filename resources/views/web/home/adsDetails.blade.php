@extends('web.layouts.app')
@section('content')
@push('styles')
<style>
    .pd-text .pd-board .tab-board .nav-tabs {
    background: #f7f7f7;
}
.blog-sidebar {
            -webkit-box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            background: #fff;
            padding: 25px;
        }
        .pd-text .pd-title {
            margin-bottom: 5px;
        }
        .ta-num a{
    font-size: 18px;
    color: #f57500;
    font-weight: 500;
}
 .bc-widget .comment-option .co-item {
    overflow: hidden;
    margin-bottom: 20px;
}
 .bc-widget .comment-option .co-item .ci-pic {
    float: left;
    margin-right: 25px;
}
 .bc-widget .comment-option .co-item .ci-pic img {
    height: 90px;
    width: 90px;
    border-radius: 50%;
}
 .bc-widget .comment-option .co-item .ci-text {
    overflow: hidden;
    position: relative;
}
 .bc-widget .comment-option .co-item .ci-text h5 {
    color: #111111;
    font-weight: 700;
    margin-bottom: 13px;
}
 .bc-widget .comment-option .co-item .ci-text p {
    font-size: 15px;
    line-height: 26px;
}
 .bc-widget .comment-option .co-item .ci-text ul {
    position: absolute;
    right: 0;
    top: 0;
}
 .bc-widget .comment-option .co-item .ci-text ul li {
    list-style: none;
    font-size: 12px;
    color: #888888;
    margin-right: 25px;
    display: inline-block;
}
 .bc-widget .comment-option .co-item .ci-text ul li i {
    font-size: 14px;
    color: #f57200;
    margin-right: 5px;
}
.blog-hero-section {
    height: 400px;
}
@media only screen and (max-width: 767px){
     .bc-widget .comment-option .co-item .ci-text ul {
        position: relative !important;
    }
}
</style>
@endpush
      <!-- Breadcrumb Section Begin -->
      <section class="breadcrumb-section spad set-bg" data-setbg="{{asset('web/new')}}/img/ads.jpg">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="breadcrumb-text">
                          <h4>{{$advertisement->name}}</h4>
                          <div class="bt-option">
                              <a href="./index.html"><i class="fa fa-home"></i> {{trans('web.Home')}}</a>
                              <span> {{trans('web.Advertisments')}}</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Breadcrumb Section End -->


    <!-- Property Details Section Begin -->
    <section class="property-details-section mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="pd-text">
                        <div class="row">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @foreach ($images as $k=>$image)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="{{$k == 0 ? 'active' : ''}}"></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($images as $k=>$image)
                                        <div class="carousel-item {{$k == 0 ? 'active' : ''}}">
                                            <img class="d-block w-100" src="{{$image->url}}" style="max-height:500px;width:100% !important;">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="pd-title w-100 d-block mt-5 p-3">
                                    <div class="pt-price h1">{{$advertisement->price}} {{trans('web.AED')}}</div>
                                    <h2>{{$advertisement->name}}</h2>
                                    <p><span class="icon_pin_alt"></span> {{$advertisement->location}}</p>
                                    <div class="tab-desc">
                                        <h3 class="mb-4">{{ trans('web.Description') }}</h3>
                                        <p> {!!$advertisement->description!!} </p>
                                    </div>
                                </div>
                        </div>
                        <div class="pd-board">
                            <div class="tab-board">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active"> {{trans('web.Overview')}}</a>
                                    </li>
                                </ul><!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="tab-details">
                                            <ul class="left-table">
                                                <li>
                                                    <span class="type-name">{{trans('web.Property Type')}}</span>
                                                    <span class="type-value">{{ trans('web.'.$advertisement->type) }}</span>
                                                </li>
                                                <li>
                                                    <span class="type-name">{{trans('web.Property ID')}}</span>
                                                    <span class="type-value">{{$advertisement->id}}</span>
                                                </li>
                                                <li>
                                                    <span class="type-name">{{trans('web.Price')}}</span>
                                                    <span class="type-value">{{$advertisement->price}}</span>
                                                </li>
                                                <li>
                                                    <span class="type-name">{{trans('web.Contract type')}}</span>
                                                    <span class="type-value">{{ trans('web.'.$advertisement->purpose) }}</span>
                                                </li>
                                                <li>
                                                    <span class="type-name">{{trans('web.Agent Name')}}</span>
                                                    <span class="type-value">{{$advertisement->user->name}}</span>
                                                </li>
                                                <li>
                                                    <span class="type-name">{{trans('web.Home Area')}}</span>
                                                    <span class="type-value">{{$advertisement->area}}</span>
                                                </li>
                                                <li>
                                                    <span class="type-name">{{trans('web.Rooms')}}</span>
                                                    <span class="type-value">{{$advertisement->rooms}}</span>
                                                </li>
                                                <li>
                                                    <span class="type-name">{{trans('web.Baths')}}</span>
                                                    <span class="type-value">{{$advertisement->baths}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($advertisement->allow_comment == 1)
                        <div class="bc-widget mt-5 mb-5">
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
                            <form action="{{url('ads/sendMessage')}}" class="leave-comment-form" method="POST">
                                @csrf
                                <input type="hidden" name="ads_id" value="{{$advertisement->id}}">
                                @if (Auth::guest())
                                <div class="group-input">
                                    <input type="text" name="name" id="name"  placeholder="Name">
                                    <input type="text"  name="email" id="email" placeholder="Email">
                                </div>
                                @endif
                                <textarea placeholder="{{trans('web.Comment')}}" name="message"></textarea>
                                <button type="submit" class="site-btn">{{trans('web.Submit')}}</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <div class="feature-post">
                            <div class="section-title sidebar-title-b">
                                <h4>{{ trans('web.Agent details')}}</h4>
                            </div>
                            <div class="ta-item">
                                <div class="text-center mb-3">
                                    <img src="{{$agent->image}}" width="100">
                                </div>
                                <div class="ta-text text-center">
                                    <h2><b>{{$agent->name}}</b></h2>
                                    <span style="color:#666666">{{$agent->agent == 1 ? trans('web.Agent') : trans('web.User')}}</span>
                                    <div class="ta-num mt-3 mb-3"><a href="{{url('chat/'.$advertisement->id)}}">{{ trans('web.Start chat about this advertisement') }}</a></div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="feature-post">
                            <div class="section-title sidebar-title-b">
                                <h4>{{trans('web.Latest Ads')}}</h4>
                            </div>
                            <div class="recent-post">
                                @foreach ($latestads as $latestads )
                                <div class="rp-item">
                                    <div class="rp-pic">
                                        <img src="{{$latestads->image->url}}" width="120">
                                    </div>
                                    <div class="rp-text">
                                        <h6><a href="{{url('adsDetails/'.$latestads->id)}}">{{ \Illuminate\Support\Str::limit($latestads->name, 50, '...') }}</a></h6>
                                        <span>{{$latestads->time_ago}}</span>
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
    <!-- Property Details Section End -->
    @endsection
