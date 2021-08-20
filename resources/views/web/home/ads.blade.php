@extends('web.layouts.app')
@section('content')
@push('styles')
    <style>
        body{
            overflow-x: hidden !important;
            margin: 0;
            padding: 0;
            box-sizing: content-box;
        }
        .property-item {
            -webkit-box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            background: #fff;
        }
        .property-item .pi-text .heart-icon {left: -35px;right: auto;font-size: 27px;}
        .property-item .pi-text .heart-icon:hover span{
            color: #f57200;
            transition: 0.5s ease-in-out;
        }
        .property-item .pi-pic {margin-bottom: 0; }
        .property-item .pi-text {    padding: 18px 18px 18px 28px;}
        .blog-sidebar {
            -webkit-box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            box-shadow: 0 0 10px -2px rgb(0 0 0 / 10%);
            background: #fff;
            padding: 25px;
            margin-top: 83px;
        }
        @media (max-width: 991px){
            .mainleft {
                padding: 0;
                margin-top: 0;
            }
            .blog-sidebar {margin-top: 0;}
        }
        @media (max-width: 991px){
            .property-item .pi-text .heart-icon {left: auto;right: 17px;}
        }
    </style>
    @if(lang() == "ar")
    <style>

        .main-left{margin-right: 20px;}
        .dropdown-rtl{direction: rtl;}
        .dropdown-item{text-align: right;padding-right: 45px!important;padding-left: 15px !important;}
        .main_i{right: 15px;}
    </style>
    @endif
@endpush
<!-- Breadcrumb Section Begin -->
          <section class="breadcrumb-section spad set-bg" data-setbg="{{asset('web/new')}}/img/ads.jpg">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="breadcrumb-text">
                              <h4>{{trans('web.Advertisments')}}</h4>
                              <div class="bt-option">
                                  <a href="./index.html"><i class="fa fa-home"></i>{{trans('web.Home')}} </a>
                                  <span>{{trans('web.Ads')}}</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          <!-- Property Section Begin -->
    <div class="site-section site-section-sm bg-light">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-8 mt-4">
                    <div class="section-title sidebar-title-b">
                        <h4>{{trans('web.All Ads')}}</h4>
                    </div>
                    <div class="row">
                        @if($advertisements->count() >0)
                            @foreach ($advertisements as $advertisement)
                                <div class="property-item col-12">
                                    <div class="row">
                                        <div class="pi-pic set-bg col-md-5" data-setbg="{{$advertisement->image->url}}">
                                            @if ($advertisement->purpose == 'For Sale')
                                                <div class="label">{{trans('web.Sale')}}</div>
                                            @elseif($advertisement->purpose == 'For Rent')
                                                <div class="label">{{trans('web.Rent')}}</div>
                                            @endif
                                        </div>
                                        <div class="pi-text col-md-7">
                                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                                            <div class="pt-price">{{$advertisement->price}} {{trans('web.AED')}}</div>
                                            <h5><a href="{{url('adsDetails/'.$advertisement->id)}}">{{ \Illuminate\Support\Str::limit($advertisement->name, 50, '...') }}</a></h5>
                                            <p><span class="icon_pin_alt"></span> {{$advertisement->location}}</p>
                                            <ul>
                                                <li><i class="fa fa-object-group"></i> {{$advertisement->area}}</li>
                                                <li><i class="fa fa-bathtub"></i> {{$advertisement->baths}}</li>
                                                <li><i class="fa fa-bed"></i> {{$advertisement->rooms}}</li>
                                            </ul>
                                            <div class="pi-agent">
                                                <div class="pa-item">
                                                    <div class="pa-info">
                                                        <img src="{{$advertisement->user->image}}" alt="">
                                                        <h6>{{$advertisement->user->name}}</h6>
                                                    </div>
                                                    <div class="pa-text">
                                                        {{$advertisement->time_ago}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="alert alert-warning w-100" role="alert">
                            <h3>{{ trans('web.There is no ads to show') }}</h3>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $advertisements->links('web.pagination.index') }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mainleft mb-4">
                    <div class="blog-sidebar">
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
    </div>

    <!-- Property Section End -->

@endsection
