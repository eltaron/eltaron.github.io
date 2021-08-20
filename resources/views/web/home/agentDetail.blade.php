@extends('web.layouts.app')
@push('styles')
<style>
.profile-agent-newslatter a{
    color:#f57200;
    size:10px;
}
.profile-agent-newslatter i{
    font-size: 3em;
    margin:0px 7px;
}
</style>
@endpush
@section('content')
<!-- Breadcrumb Section Begin -->
      <section class="breadcrumb-section spad set-bg" data-setbg="{{asset('web/new')}}/img/agent.jpg">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="breadcrumb-text">
                          <h4>{{$agent->name}}</h4>
                          <div class="bt-option">
                              <a href="./index.html"><i class="fa fa-home"></i>{{trans('web.Home')}}</a>
                              <span>{{trans('web.Agents')}}</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

<!-- Profile Section Begin -->
<section class="profile-section spad">
    <div class="container">
        <div class="profile-agent-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="profile-agent-info">
                        <div class="pi-pic">
                            <img src="{{$agent->image}}" alt="">
                        </div>
                        <div class="pi-text">
                            <h5>{{$agent->name}}</h5>
                            <span>{{ trans('web.Agent') }}</span>
                            <p>{{$agent->time_ago}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="profile-agent-widget">
                        <ul>
                            <li><b>{{trans('web.Email')}}</b> <span>{{$agent->email}}</span></li>
                            <li><b>{{trans('web.Description')}}</b> <p>{{$agent->description}} </p></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="profile-agent-newslatter">
                        <h5>{{trans('web.Contact With')}} {{$agent->name}}</h5>
                        <a href=""><i class="fa fa-facebook-official "></i></a>
                        <a href=""><i class="fa fa-twitter-square"></i></a>
                        <a href=""><i class="fa fa-instagram"></i></a>
                        <a href=""><i class="fa  fa-google-plus-square"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Profile Section End -->

  <!-- Breadcrumb Section End -->
  <section class="property-section latest-property-section spad">
    <div class="container">
        <div class="section-title sidebar-title-b">
            <h4>{{ trans('web.Latest Advertisement') }}</h4>
        </div>
        <div class="row mb-5">
            @foreach ($advertisments as $advertisement)
            <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
                <a href="{{url('adsDetails/'.$advertisement->id)}}" class="property-thumbnail">
                <div class="offer-type-wrap">
                    @if ($advertisement->purpose == 'For Sale')
                    <span class="offer-type bg-danger">{{trans('web.Sale')}}</span>
                    @elseif($advertisement->purpose == 'For Rent')
                    <span class="offer-type bg-success">{{trans('web.Rent')}}</span>
                    @endif
                </div>
                <img src="{{$advertisement->image->url}}" alt="Image" class="img-fluid">
                </a>
                <div class="p-4 property-body">
                <h2 class="property-title"><a href="{{url('adsDetails/'.$advertisement->id)}}">{{$advertisement->name}}</a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon_pin_alt"></span>{{$advertisement->location}}</span>
                <strong class="property-price mb-3 d-block">{{$advertisement->price}} {{trans('web.AED')}}</strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                    <li>
                    <span class="property-specs">{{trans('web.Beds')}}</span>
                    <span class="property-specs-number">{{$advertisement->baths}}</span>

                    </li>
                    <li>
                    <span class="property-specs">{{trans('web.Baths')}}</span>
                    <span class="property-specs-number"> {{$advertisement->baths}}</span>

                    </li>
                    <li>
                    <span class="property-specs"> {{ trans('web.SQFT') }}</span>
                    <span class="property-specs-number">{{$advertisement->area}}</span>

                    </li>
                </ul>

                </div>
            </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-12">
            <div class="row text-center">{{ $advertisments->links('web.pagination.index') }}</div>
        </div>
    </div>
</section>
    <!--================Blog Area =================-->
@endsection
