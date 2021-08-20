@extends('agent.layouts.app')
@section('content')
@push('styles')
    <style>
    .main-left{margin-left: 20px;}
    </style>
    @if(lang() == "ar")
    <style>
        .main-container{
            text-align: right !important;
            direction: rtl !important;
        }
        .main-left{margin-right: 20px;}
        .dropdown-rtl{direction: rtl;}
        .dropdown-item{text-align: right;padding-right: 45px!important;padding-left: 15px !important;}
        .main_i{right: 15px;}
    </style>
    @endif
@endpush
<div class="main-container mt-5">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row mb-2">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>{{$title}}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{aurl('dashboard')}}">{{ trans('web.Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @include('agent.includes.messages')
            </div>
            <div class="product-wrap">
                <div class="product-list">
                    <ul class="row">
                        @if ($advertisments)
                            @foreach ($advertisments as $advertisment)
                                <li class="col-md-12 col-12 col-sm-6">
                                    <div class="container">
                                        <div class="product-box row" style="border-radius: 0;">
                                            <div class="producct-img col-md-4 p-0">
                                                <img src="{{$advertisment->image->url}}" alt="">
                                            </div>
                                            <div class="product-caption col-md-8">
                                                <h3 class="property-title mb-2">
                                                    <a href="{{gurl('ads/show/'.$advertisment->id)}}">{{ \Illuminate\Support\Str::limit($advertisment->name, 50, '...') }}</a></h3>
                                                <span class="property-location d-block mb-3"><span class="fa fa-map"></span> {{$advertisment->location}} </span>
                                                <strong class="property-price  mb-3 d-block">{{$advertisment->price}} {{ trans('web.AED') }}</strong>
                                                <div class="row">
                                                    <a href="{{gurl('ads/show/'.$advertisment->id)}}" class="btn btn-outline-primary">{{ trans('web.Read More') }}</a>
                                                    <div class="dropdown text-right main-left">
                                                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                            {{ trans('web.Settings') }}
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                            <a class="dropdown-item view_ads" href="{{gurl('ads/edit/'.$advertisment->id)}}"
                                                            ><i class="main_i dw dw-eye"></i> {{ trans('web.Edit') }}</a>
                                                            @if ($advertisment->status == 1)
                                                                <button class="dropdown-item not_activate_ads" data-id="{{ $advertisment->id }}"
                                                                ><i class="main_i dw dw-edit2"></i> {{ trans('web.Not Activate') }}</button>
                                                            @else
                                                                <button class="dropdown-item activate_ads" data-id="{{ $advertisment->id }}"
                                                                ><i class="main_i dw dw-edit2"></i> {{ trans('web.Activate') }}</button>
                                                            @endif
                                                            @if ($advertisment->allow_comment == 0)
                                                            <button class="dropdown-item allow_comment" data-id="{{ $advertisment->id }}"
                                                            ><i class="main_i icon-copy dw dw-chat-1"></i> {{ trans('web.Allow Comments') }}</button>
                                                            @endif
                                                            <button class="dropdown-item delete_ads" data-id="{{ $advertisment->id }}"
                                                            ><i class="main_i dw dw-delete-3"></i> {{ trans('web.Delete') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <div class="alert alert-warning" role="alert">
                                {{ trans('web.There Is No Advertisements Yet.') }}
                            </div>
                        @endif
                    </ul>
                </div>
                <div class="blog-pagination mb-30">
                    {{ $advertisments->links('agent.pagination.index') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="allow_commentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to allow comments for this advertisement ?') }}</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{gurl('ads/allow_comment')}}" method="POST">
                        @csrf
                        <input type="hidden" name="ads_id" id="ads_id_2">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                {{ trans('web.NO') }}
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                                {{ trans('web.YES') }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to activate this advertisement ?') }}</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{gurl('ads/activate')}}" method="POST">
                        @csrf
                        <input type="hidden" name="ads_id" id="ads_id_3">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                {{ trans('web.NO') }}
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                                {{ trans('web.YES') }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to delete This advertisement ?') }}</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{gurl('ads/delete_ads')}}" method="POST">
                        @csrf
                        <input type="hidden" name="ads_id" id="ads_id">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                {{ trans('web.NO') }}
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-danger border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></button>
                                {{ trans('web.YES') }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="not_activate_adsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to disactivate this advertisement ?') }}</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{gurl('ads/disactivate_ads')}}" method="POST">
                        @csrf
                        <input type="hidden" name="ads_id" id="ads_id_4">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                {{ trans('web.NO') }}
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                                {{ trans('web.YES') }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    $(document).ready(function() {
        $(".activate_ads").click(function() {
            var id = $(this).attr('data-id');
            $("#ads_id_3").val(id);
            $("#activateModal").modal('toggle');
        });
        $(".not_activate_ads").click(function() {
            var id = $(this).attr('data-id');
            $("#ads_id_4").val(id);
            $("#not_activate_adsModal").modal('toggle');
        });
        $(".allow_comment").click(function() {
            var id = $(this).attr('data-id');
            $("#ads_id_2").val(id);
            $("#allow_commentModal").modal('toggle');
        });
        $(".delete_ads").click(function() {
            var id = $(this).attr('data-id');
            $("#ads_id").val(id);
            $("#deleteModal").modal('toggle');
        });
    });
</script>
@endpush
@endsection
