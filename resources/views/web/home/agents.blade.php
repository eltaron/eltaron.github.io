@extends('web.layouts.app')
@section('content')
      <!-- Breadcrumb Section Begin -->
      <section class="breadcrumb-section spad set-bg" data-setbg="{{asset('web/new')}}/img/agent.jpg">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="breadcrumb-text">
                          <h4>{{trans('web.Our Agents')}}</h4>
                          <div class="bt-option">
                              <a href="./index.html"><i class="fa fa-home"></i>{{trans('web.Home')}}</a>
                              <span>{{trans('web.Agents')}}</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Breadcrumb Section End -->

<!--Our Agents-->
<section id="team" class="team">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
                <div class="site-section-title pb-4">
                    <h2 class="text-bold">{{trans('web.Welcome')}}</h2>
                    <p><b>{{trans('web.Our Mission is hleping you to find what you need')}}</b></p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($agents as $agent)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch p-1">
                    <div class="member w-100 " data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="{{$agent->image}}" style="width: 100%;height:200px">
                            <div class="social">
                                <a href="{{url('agentLike')}}"><i class="fa fa-heart"></i></a>
                                <a href="{{url('agentDetail/'.$agent->id)}}"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>{{$agent->name}}</h4>
                            {{$agent->time_ago}}
                            <a href="{{url('agentDetail/'.$agent->id)}}" class="detail"><i class="fa fa-arrow-right" style="margin-left:9px;"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row text-center">{{ $agents->links('web.pagination.index') }}</div>
    </div>
</section>
@endsection
