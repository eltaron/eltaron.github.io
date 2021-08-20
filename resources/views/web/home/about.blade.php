@extends('web.layouts.app')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{asset('web/new')}}/css/style2.css">
<style>
    .af-icon img {    width: 55px;}
</style>
@endpush
     <!-- Breadcrumb Section Begin -->
     <section class="breadcrumb-section spad set-bg" data-setbg="{{asset('web/new')}}/img/about.jpg">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="breadcrumb-text">
                         <h4>{{trans('web.About us')}}</h4>
                         <div class="bt-option">
                             <a href="./index.html"><i class="fa fa-home"></i>{{trans('web.Home')}} </a>
                             <span>{{trans('web.About')}}</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- Breadcrumb Section End -->

     <section class="about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="at-title">
                            <h3>{{trans('web.Welcome to Mastercode')}}</h3>
                            <p>{{ trans('web.The world has become so fast paced that people don’t want to stand by reading a page of information, they would much rather look at a presentation and understand the message. It has come to a point') }}</p>
                        </div>
                        <div class="at-feature">
                            <div class="af-item">
                                <div class="af-icon">
                                    <img src="{{asset('web/new')}}/img/chooseus/chooseus-icon-1.png" alt="">
                                </div>
                                <div class="af-text">
                                    <h6>{{trans('web.Find your future home')}}</h6>
                                    <p>{{trans('web.We help you find a new home by offering a smart real estate.')}}</p>
                                </div>
                            </div>
                            <div class="af-item">
                                <div class="af-icon">
                                    <img src="{{asset('web/new')}}/img/chooseus/chooseus-icon-2.png" alt="">
                                </div>
                                <div class="af-text">
                                    <h6>{{trans('web.Experienced agents')}}</h6>
                                    <p>{{trans('web.Find an agent who knows your market best')}}</p>
                                </div>
                            </div>
                            <div class="af-item">
                                <div class="af-icon">
                                    <img src="{{asset('web/new')}}/img/chooseus/chooseus-icon-3.png" alt="">
                                </div>
                                <div class="af-text">
                                    <h6>{{trans('web.Buy or rent homes')}}</h6>
                                    <p>{{trans('web.Millions of houses and apartments in your favourite cities')}}</p>
                                </div>
                            </div>
                            <div class="af-item">
                                <div class="af-icon">
                                    <img src="{{asset('web/new')}}/img/chooseus/chooseus-icon-4.png" alt="">
                                </div>
                                <div class="af-text">
                                    <h6>{{trans('web.List your own property')}}</h6>
                                    <p>{{trans('web.Sign up now and sell or rent your own properties')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic set-bg" data-setbg="{{asset('web/new')}}/img/about-us.jpg">
                        <a href="https://www.youtube.com/watch?v=8EJ3zbKTWQ8" class="play-btn video-popup">
                            <i class="fa fa-play-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

	<!-- Start price Area -->
    <section class="price-area section-gap pb-4">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h2 class="my-3">We Provide Affordable Prices</h2>
                        <p>Well educated, intellectual people, especially scientists at all times demonstrate considerably.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-price">
                        <h4>Cheap Packages</h4>
                        <ul class="price-list">
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-price">
                        <h4>Luxury Packages</h4>
                        <ul class="price-list">
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-price">
                        <h4>Camping Packages</h4>
                        <ul class="price-list">
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span>DUBAI</span>
                                <a href="#" class="price-btn">$1500</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End price Area -->

@endsection
