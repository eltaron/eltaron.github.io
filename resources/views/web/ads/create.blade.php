@extends('web.layouts.app_dash')
@section('content')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/src/plugins/jquery-steps/jquery.steps.css">
<style>
    .image_hidden{display:none;}
    label{color: #f57200;font-size: 20px}
    .custom-file-label::after {display: none}
</style>
<style>
    .upload .upload-box {
        border: solid 1px #cfcfcf;
        padding: 10px 20px;
        position: relative;
    }
    .upload .upload-box .fa {
        color: #cfcfcf;
    }
</style>
@if(lang() == "ar")
    <style>
        .main-container{
            text-align: right !important;
        }
        .wizard-content .wizard>.actions>ul {float: left;}
        label, input, select{direction: rtl}
        .wizard-content .wizard>.actions>ul>li+li {
            margin-left: 0;
            margin-right: 10px;
        }
        .wizard-content .wizard>.actions>ul>li {
            float: right !important;
        }
        .gallery-wrap{direction: rtl}
        .wizard-content .wizard>.steps>ul{display: none}
    .page-header .breadcrumb {direction: rtl}
    </style>
@endif
@endpush
<div class="main-container mt-5">
    <div class="min-height-150px pt-30">
        <div class="page-header">
            <div class="row mb-2">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>{{$title}}</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ trans('web.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @include('web.includes_dash.messages')
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <div class="wizard-content">
            <form class="tab-wizard wizard-circle wizard" id="wizard" action="{{url('user/ads/create')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <h5>{{trans('web.Advertisement Details')}}</h5>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >&#9830; {{trans('web.Title Of New Advertisement')}}</label>
                                <input type="text" name="title" required placeholder="{{trans('web.Title Of New Advertisement')}}t" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="html-editor mb-30">
                                <label >&#9830; {{trans('web.Description Of New Advertisement')}}</label>
                                <textarea class="textarea_editor form-control border-radius-0" name="description" required placeholder="{{trans('web.Description Of New Advertisement')}}"></textarea>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 2 -->
                <h5>{{trans('web.Department Details')}}</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&#9830; {{trans('web.Type')}}</label>
                                <select class="custom-select form-control" name="type" required>
                                    <option disabled>{{trans('web.Type')}}</option>
                                    <option value="Apartment">{{trans('web.Apartment')}}</option>
                                    <option value="Home">{{trans('web.Homes')}}</option>
                                    <option value="Else">{{trans('web.Else')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&#9830; {{trans('web.Purpose')}}</label>
                                <select class="custom-select form-control" name="purpose" required>
                                    <option disabled>{{trans('web.Select Purpose')}}</option>
                                    <option value="For Sale">{{trans('web.For Sale')}}</option>
                                    <option value="For Rent">{{trans('web.For Rent')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&#9830; {{trans('web.Area')}}</label>
                                <input type="number" name="area" placeholder="{{trans('web.Area Of Department In sqft')}}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&#9830; {{trans('web.Rooms')}}</label>
                                <input type="number" name="rooms" placeholder="{{trans('web.No Of Rooms')}}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&#9830; {{trans('web.Baths')}}</label>
                                <input type="number" name="baths" placeholder="{{trans('web.No Of Baths')}}" required class="form-control">
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 3 -->
                <h5>{{trans('web.More Info')}}</h5>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>&#9830; {{trans('web.Price')}}</label>
                                <input type="number" name="price" placeholder="{{trans('web.Price')}}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>&#9830; {{trans('web.Location')}}</label>
                                <input type="text" class="form-control" name="location" required placeholder="{{trans('web.Location')}}">
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 4 -->
                <h5>{{trans('web.Media')}}</h5>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>&#9830; {{trans('web.Video')}}</label>
                                <input type="text" name="video" placeholder="{{trans('web.Put Your video Url')}}" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <label style="display: block;width:100%;">&#9830; {{trans('web.Images')}}</label>
                        <div class="container">
                            <div class="upload">
                                <div class="upload-box">
                                    <div class="row">
                                        <div class="col-md-1"><i class="fa fa-cloud-upload fa-4x"></i></div>
                                        <div class="col-md-11">
                                            <div class="edit custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="customFile" name="files[]" multiple>
                                                <label class="custom-file-label mt-2" for="customFile" style="color: #cfcfcf;">{{trans('web.Choose file')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
@push('script')
<script src="{{ asset('admin') }}/src/plugins/jquery-steps/jquery.steps.js"></script>
<script src="{{ asset('admin') }}/vendors/scripts/steps-setting.js"></script>
<script>
    $(".actions a[href='#finish']").on("click", function () {
        $('#wizard').submit();
    });
</script>
@if(lang() == "ar")
<script>
    $(".actions a[href='#next']").html("{{trans('web.next')}}");
    $(".actions a[href='#finish']").html("{{trans('web.submit')}}");
    $(".actions a[href='#previous']").html("{{trans('web.previous')}}");
</script>
@endif
@endpush
@endsection
