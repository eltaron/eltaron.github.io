@extends('web.layouts.app')
@section('content')
@push('styles')
<style>
    .main_input {
        clear: none;
        margin-right: 20px;
        height: 46px;
        background: #ffffff;
        border-radius: 0;
        border: 1px solid #e1e1e1;
        line-height: 43px;
        margin-bottom: 20px;
        width: calc(33.33% - 23px);
        padding-right: 10px
    }
    @media only screen and (max-width: 767px){
        .main_input {
            width: 100%;
            margin-bottom: 20px;
            margin-right: 0 !important;
        }
    }
    .title a {color: #f57200;font-size:14px;}
</style>
@endpush
<body>
    <!--preloader  -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{asset('web/new')}}/img/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- end preloader-->
        <!-- Hero Section Begin -->
        <section class="hero-section">
            <div class="container">
                <div class="hs-slider owl-carousel">
                    <div class="hs-item set-bg" data-setbg="{{asset('web/new')}}/img/hero/hero-1.jpg">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hc-inner-text">
                                    <div class="hc-text">
                                        <h4>{{ trans('web.Find an awesome place with a great view') }}</h4>
                                        <p><span class="icon_pin_alt"></span> {{ trans('web.Any where') }}</p>
                                        <div class="label">{{ trans('web.For Rent') }}</div>
                                        <div class="label">{{ trans('web.OR') }}</div>
                                        <div class="label">{{ trans('web.For Sale') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hs-item set-bg" data-setbg="{{asset('web/new')}}/img/hero/hero-2.jpg">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hc-inner-text">
                                    <div class="hc-text">
                                        <h4>{{ trans('web.Find an awesome place with a great view') }}</h4>
                                        <p><span class="icon_pin_alt"></span> {{ trans('web.Any where') }}</p>
                                        <div class="label">{{ trans('web.For Rent') }}</div>
                                        <div class="label">{{ trans('web.OR') }}</div>
                                        <div class="label">{{ trans('web.For Sale') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hs-item set-bg" data-setbg="{{asset('web/new')}}/img/hero/hero-3.jpg">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hc-inner-text">
                                    <div class="hc-text">
                                        <h4>{{ trans('web.Find an awesome place with a great view') }}</h4>
                                        <p><span class="icon_pin_alt"></span> {{ trans('web.Any where') }}</p>
                                        <div class="label">{{ trans('web.For Rent') }}</div>
                                        <div class="label">{{ trans('web.OR') }}</div>
                                        <div class="label">{{ trans('web.For Sale') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->

        <!-- Search Section Begin -->
        <section class="search-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="section-title">
                            <h4>{{ trans('web.Where would you rather live?') }}</h4>
                        </div>
                    </div>
                    <div class="col-lg-5">
                    </div>
                </div>
                <div class="search-form-content">
                    <form action="{{url('search')}}" class="filter-form" method="POST">
                        @csrf
                        <select class="sm-width" name="city" required>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">
                                    @if(lang() == "ar")
                                        {{$city->name_ar}}
                                    @else
                                        {{$city->name_en}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <select class="sm-width" name="Type" required>
                            <option disabled selected>{{ trans('web.Type') }}</option>
                            <option value="Apartment">{{ trans('web.Apartment') }}</option>
                            <option value="Home">{{ trans('web.Home') }}</option>
                        </select>
                        <select class="sm-width" name="Purpose" required>
                            <option disabled selected>{{ trans('web.Purpose') }}</option>
                            <option value="For Rent">{{ trans('web.For Rent') }}</option>
                            <option value="For Sale">{{ trans('web.For Sale') }}</option>
                        </select>
                        <input type="number" name="Bedrooms" required class="main_input" placeholder="{{trans('web.No Of Bedrooms')}}">
                        <input type="number" name="Bathrooms" required class="main_input" placeholder="{{trans('web.No Of Bathrooms')}}">
                        <input type="number" name="price" required class="main_input" placeholder="{{trans('web.price in AED')}}">
                        <button type="submit" class="search-btn sm-width">{{ trans('web.Search') }}</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- Search Section End -->
        <!-- Property Section Begin -->
        <section class="property-section latest-property-section spad">
            <div class="container">
                <div class="row">
                    <div class="section-title p-3">
                        <h4>{{ trans('web.Latest Advertisments') }}</h4>
                    </div>
                </div>
                <div class="row mb-5">
                    @foreach ($latestads as $latestad)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{url('adsDetails/'.$latestad->id)}}" class="property-thumbnail">
                                <div class="offer-type-wrap">
                                    @if ($latestad->purpose == 'For Sale')
                                        <span class="offer-type bg-danger">{{trans('web.Sale')}}</span>
                                    @elseif($latestad->purpose == 'For Rent')
                                        <span class="offer-type bg-success">{{trans('web.Rent')}}</span>
                                    @endif
                                </div>
                                <img src="{{$latestad->image->url}}" alt="Image" class="img-fluid">
                                </a>
                                <div class="p-4 property-body">
                                <h2 class="property-title"><a href="{{url('adsDetails/'.$latestad->id)}}">{{ \Illuminate\Support\Str::limit($latestad->name, 50, '...') }}</a></h2>
                                <span class="property-location d-block mb-3"><span class="property-icon icon_pin_alt"></span> {{$latestad->location}}</span>
                                <strong class="property-price mb-3 d-block">{{$latestad->price}} {{trans('web.AED')}}</strong>
                                <ul class="property-specs-wrap mb-3 mb-lg-0">
                                    <li>
                                    <span class="property-specs">{{ trans('web.Beds') }}</span>
                                    <span class="property-specs-number">{{$latestad->rooms}}</span>
                                    </li>
                                    <li>
                                    <span class="property-specs">{{ trans('web.Baths') }}</span>
                                    <span class="property-specs-number">{{$latestad->baths}}</span>
                                    </li>
                                    <li>
                                    <span class="property-specs">{{ trans('web.Area') }}</span>
                                    <span class="property-specs-number">{{$latestad->area}}</span>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Property Section End -->

        <!-- Chooseus Section Begin -->
        <section class="chooseus-section spad set-bg" data-setbg="{{asset('web/new')}}/img/chooseus/choo.jpg" style="background-attachment: fixed;">
            <div class="container" style="background-color: rgb(4 9 30 / 50%);padding: 33px 20px;">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="chooseus-text">
                            <div class="section-title">
                                <h4>{{ trans('web.Why choose us') }}</h4>
                            </div>
                            <p>{{ trans('web.Want to move to one of Dubai most glamorous districts? We reveal the top buildings to rent apartments and popular areas for renting villas in Downtown Dubai.') }}</p>
                        </div>
                        <div class="chooseus-features">
                            <div class="cf-item">
                                <div class="cf-pic">
                                    <img src="{{asset('web/new')}}/img/chooseus/chooseus-icon-1.png" alt="">
                                </div>
                                <div class="cf-text">
                                    <h5>{{ trans('web.Find your future home') }}</h5>
                                    <p>{{ trans('web.We help you find a new home by offering a smart real estate.') }}</p>
                                </div>
                            </div>
                            <div class="cf-item">
                                <div class="cf-pic">
                                    <img src="{{asset('web/new')}}/img/chooseus/chooseus-icon-2.png" alt="">
                                </div>
                                <div class="cf-text">
                                    <h5>{{ trans('web.Buy or rent homes') }}</h5>
                                    <p>{{ trans('web.Millions of houses and apartments in your favourite cities') }}</p>
                                </div>
                            </div>
                            <div class="cf-item">
                                <div class="cf-pic">
                                    <img src="{{asset('web/new')}}/img/chooseus/chooseus-icon-3.png" alt="">
                                </div>
                                <div class="cf-text">
                                    <h5>{{ trans('web.Experienced agents') }}</h5>
                                    <p>{{ trans('web.Find an agent who knows your market best') }}</p>
                                </div>
                            </div>
                            <div class="cf-item">
                                <div class="cf-pic">
                                    <img src="{{asset('web/new')}}/img/chooseus/chooseus-icon-4.png" alt="">
                                </div>
                                <div class="cf-text">
                                    <h5>{{ trans('web.List your own property') }}</h5>
                                    <p>{{ trans('web.Sign up now and sell or rent your own properties') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Chooseus Section End -->

        <!--Our Agents-->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">
              <div class="row">
                <div class="col-md-7 ml-0">
                    <div class="section-title">
                        <h4>{{ trans('web.Latest Agents') }}</h4>
                    </div>
                </div>
                </div>
                <div class="row">
                    @foreach ($latestagents as $latestagent)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member w-100" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{$latestagent->image}}" style="width: 100%;height:200px">
                            <div class="social">
                            <a href="{{$latestagent->agents ? $latestagent->agents->facebook : ''}}"><i class="fa fa-twitter"></i></a>
                            <a href="{{$latestagent->agents ? $latestagent->agents->twitter : ''}}"><i class="fa fa-facebook"></i></a>
                            <a href="{{$latestagent->agents ? $latestagent->agents->instgram : ''}}"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>{{$latestagent->name}}</h4>
                            {{$latestagent->time_ago}}
                            <a href="{{url('agentDetail/'.$latestagent->id)}}" class="detail"><i class="fa fa-arrow-right" style="margin-left:9px;"></i></a>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </section>
        <!--end Agents-->

        <!--Recent Blogs section-->
        <div class="bg-sky pd-top-80 pd-bottom-50" id="latest">
            <div class="container">
              <div class="row ">
                <div class="col-md-7 ">
                  <div class="section-title">
                    <h4 >{{ trans('web.Latest Blogs') }}</h4>
                  </div>
                </div>
              </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-post-wrap style-overlay-bg">
                            <div class="thumb">
                                <img src="{{asset('web/new')}}/img/post/1.jpg" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single mb-3">
                                    <ul>
                                        <p><i class="fa fa-clock-o"></i> 08.22.2020</p>
                                    </ul>
                                </div>
                                <h6 class="title"><a href="#">{{ trans('web.New cities in egypt') }}</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-post-wrap">
                            <div class="thumb">
                                <img src="{{asset('web/new')}}/img/post/3.jpg" alt="img">
                                <p class="btn-date"><i class="fa fa-clock-o"></i>08.22.2020</p>
                            </div>
                            <div class="details">
                                <h6 class="title"><a href="#">{{ trans('web.Room in new place') }}</a></h6>
                            </div>
                        </div>
                        <div class="single-post-wrap">
                            <div class="thumb">
                                <img src="{{asset('web/new')}}/img/post/4.jpg" alt="img">
                                <p class="btn-date"><i class="fa fa-clock-o"></i>08.22.2020</p>
                            </div>
                            <div class="details">
                                <h6 class="title"><a href="#">{{ trans('web.office in landon') }}</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-post-wrap">
                            <div class="thumb">
                                <img src="{{asset('web/new')}}/img/post/6.jpg" alt="img">
                                <p class="btn-date"><i class="fa fa-clock-o"></i>08.22.2020</p>
                            </div>
                            <div class="details">
                                <h6 class="title"><a href="#">{{ trans('web.flat in Cairo') }}</a></h6>
                            </div>
                        </div>
                        <div class="single-post-wrap">
                            <div class="thumb">
                                <img src="{{asset('web/new')}}/img/post/5.jpg" alt="img">
                                <p class="btn-date"><i class="fa fa-clock-o"></i>08.22.2020</p>
                            </div>
                            <div class="details">
                                <h6 class="title"><a href="#">{{ trans('web.House in Dubai') }}</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <div class="single-post-wrap style-overlay-bg">
                          <div class="thumb">
                              <img src="{{asset('web/new')}}/img/post/2.png" alt="img">
                          </div>
                          <div class="details">
                              <div class="post-meta-single mb-3">
                                  <ul>
                                      <p><i class="fa fa-clock-o"></i> 08.22.2020</p>
                                  </ul>
                              </div>
                              <h6 class="title"><a href="#">{{ trans('web.Home in railway') }}</a></h6>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    <!--end blog-->

@endsection
