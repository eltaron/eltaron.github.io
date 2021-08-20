@extends('agent.layouts.app')
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
                            <li class="breadcrumb-item"><a href="{{gurl('home')}}">{{ trans('web.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @include('agent.includes.messages')
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <div class="wizard-content">
            <form class="tab-wizard wizard-circle wizard" id="wizard" action="{{gurl('blog/update')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="ads_id" value="{{$blog->id}}">
                <h5>{{trans('web.Blog Details')}}</h5>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >&#9830; {{trans('web.Title Of New Blog')}}</label>
                                <input type="text" name="title" value="{{$blog->name}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="html-editor mb-30">
                                <label >&#9830; {{trans('web.Description Of New Blog')}}</label>
                                <textarea class="textarea_editor form-control border-radius-0" name="text" >{!!$blog->text!!}</textarea>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 2 -->
                <h5>Media</h5>
                <section>
                    <div class="row p-3">
                        <label style="display: block;width:100%">&#9830; {{trans('web.Images')}}</label>
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
    <div class="pd-ltr-20 card-box mb-30 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title mb-3">
                        <h4>{{trans('web.Gallery')}}</h4>
                    </div>
                </div>
            </div>
            <div class="gallery-wrap">
                <ul class="row">
                    @foreach ($images as $image)
                        <li class="col-lg-4 col-md-6 col-sm-12">
                            <div class="da-card box-shadow">
                                <div class="da-card-photo">
                                    <img src="{{$image->url}}" style="height: 280px">
                                    <div class="da-overlay" style="height: 280px">
                                        <div class="da-social">
                                        <h5 class="mb-10 color-white pd-20 text-center">{{$blog->name}}</h5>
                                            <ul class="clearfix">
                                                <li><a href="{{$image->url}}" data-fancybox="images"><i class="fa fa-picture-o"></i></a></li>
                                                <li><a class="delete_image" data-ads="{{ $blog->id }}" data-id="{{ $image->id }}"><i class="dw dw-delete-3"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to delete This Image ?')}}</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{gurl('blog/delete_image')}}" method="POST">
                        @csrf
                        <input type="hidden" name="image_id" id="image_id">
                        <input type="hidden" name="ads_id" id="ads_id">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                {{trans('web.NO')}}
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-danger border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></button>
                                {{trans('web.YES')}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
<script>
    $(document).ready(function() {
        $(".delete_image").click(function() {
            var id  = $(this).attr('data-id');
            var ads = $(this).attr('data-ads');
            $("#image_id").val(id);
            $("#ads_id").val(ads);
            $("#deleteModal").modal('toggle');
        });
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
