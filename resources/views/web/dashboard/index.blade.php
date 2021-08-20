@extends('web.layouts.app_dash')
@section('content')
@push('styles')
    @if(lang() == "ar")
    <style>
        .main-container{
            text-align: right !important;
            direction: rtl !important;
        }
        .main-i{
            float: right;
            padding-top: 5px;
            margin-left: 5px;
        }
    </style>
    @endif
@endpush
<div class="main-container mt-5">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="{{ asset('admin') }}/vendors/images/banner-img.svg" alt="">
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Welcome back <div class="weight-600 font-30 text-blue">{{Auth::user()->name}}</div>
                    </h4>
                    <p class="font-18 max-width-600">{{ trans('web.We Are Happy To Help You Share Your Building With Others And Help Them.') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart"></div>
                            <input type="hidden" id="chart_value_1" value="{{$ads}}">
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">{{$ads}}</div>
                            <div class="weight-600 font-14">{{trans('web.All ADS')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart2"></div>
                            <input type="hidden" id="chart_value_2" value="{{$invoices}}">
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">{{$invoices}}</div>
                            <div class="weight-600 font-14">{{trans('web.All Invoices')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart3"></div>
                            <input type="hidden" id="chart_value_3" value="{{$chats}}">
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">{{$chats}}</div>
                            <div class="weight-600 font-14">{{trans('web.All Chats')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart4"></div>
                            <input type="hidden" id="chart_value_4" value="{{$messages}}">
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">{{$messages}}</div>
                            <div class="weight-600 font-14">{{trans('web.messages')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-box pd-20 height-100-p mb-30">
            <h2 class="h4 pd-20">{{trans('web.Quick Links')}}</h2>
            <div class="row text-center">
                <div class="col-md-3 mb-2">
                    <a style="padding: 20px 0;" href="{{url('user/ads')}}" class="w-100 btn btn-primary"><i class="icon-copy fa fa-sticky-note" aria-hidden="true"></i> {{ trans('web.All Advertisments') }}</a>
                </div>
                <div class="col-md-3 mb-2">
                    <a style="padding: 20px 0;" href="{{url('user/chat')}}" class="w-100 btn btn-dark"><i class="icon-copy fa fa-wechat" aria-hidden="true"></i> {{ trans('web.All Chats') }}</a>
                </div>
                <div class="col-md-3 mb-2">
                    <a style="padding: 20px 0;" href="{{url('user/messages/sent')}}" class="w-100 btn btn-success"><i class="icon-copy fa fa-envelope-open" aria-hidden="true"></i> {{ trans('web.All Messages') }}</a>
                </div>
                <div class="col-md-3 mb-2">
                    <a style="padding: 20px 0;" href="{{url('user/account')}}" class="w-100 btn btn-info"><i class="icon-copy fa fa-id-badge" aria-hidden="true"></i> {{ trans('web.Account') }}</a>
                </div>
            </div>
        </div>
        <div class="card-box mb-30 p-4">
            <h2 class="h4 pd-20">{{trans('web.Leatest ADS')}}</h2>
            <div class="table-responsive">
                @if($latestads->count() > 0)
                    <table class=" table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{trans('web.ADS')}}</th>
                                <th>{{trans('web.Title')}}</th>
                                <th>{{trans('web.Price')}}</th>
                                <th>{{trans('web.Created at')}}</th>
                                <th>{{trans('web.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestads as $latestad)
                                <tr>
                                    <td class="table-plus">
                                        <img src="{{$latestad->image->url}}" width="70" height="70" alt="">
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($latestad->name, 50, '...') }}</td>
                                    <td>{{$latestad->price}}</td>
                                    <td>{{$latestad->time_ago}}</td>
                                    <td>
                                        <a class="dropdown-item" href="{{url('user/ads/show/'.$latestad->id)}}"><i class="main-i dw dw-eye"></i> {{ trans('web.View') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-primary" role="alert">
                        {{ trans('web.There is no ads yet') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('script')
<script src="{{ asset('admin') }}/src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('admin') }}/vendors/scripts/dashboard.js"></script>
@endpush
@endsection
