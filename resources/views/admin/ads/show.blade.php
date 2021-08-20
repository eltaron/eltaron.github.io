@extends('admin.layouts.app')
@section('content')
@push('styles')
    <style>
        strong{color: rgb(174 171 171);}
        a{text-decoration: none}
    </style>
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
    <div class=" pd-ltr-20 xs-pd-20-10  mb-30">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
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
                @include('admin.includes.messages')
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box" style="overflow: hidden">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($images as $k => $image)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="$k" class="{{$k == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($images as $k => $image)
                                    <div class="carousel-item {{$k == 0 ? 'active' : '' }}">
                                        <img class="d-block w-100 " src="{{$image->url}}">
                                    </div>
                                @endforeach
                            </div>
                            @if ($images->count() != 1)
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">{{trans('web.Previous')}}</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">{{trans('web.Next')}}</span>
                                </a>
                            @endif
                        </div>
                        <div class="product-detail-desc pd-20">
                            <div class="container">
                                <div class="row mb-5">
                                    <div class="col-md-8 mb-20 pt-20">
                                        <h3>{{$advertise->name}}</h3>
                                        <strong class="d-block"><i class="fa fa-map"></i> {{ $advertise->location }}</strong>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <strong class="text-success h1 mb-3">{{$advertise->price}} {{ trans('web.AED') }}</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 col-lg-6 text-center border-bottom border-top py-3">
                                        <span class="d-inline-block text-black mb-0 caption-text">{{trans('web.Home Type')}}</span>
                                        <strong class="d-block">{{ trans('web.'.$advertise->type) }}</strong>
                                    </div>
                                    <div class="col-md-6 col-lg-6 text-center border-bottom border-top py-3">
                                        <span class="d-inline-block text-black mb-0 caption-text">{{trans('web.Purpose')}}</span>
                                        <strong class="d-block">{{ trans('web.'.$advertise->purpose) }}</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 col-lg-4 text-center border-bottom  py-3">
                                        <span class="d-inline-block text-black mb-0 caption-text">{{trans('web.Area')}}</span>
                                        <strong class="d-block">{{$advertise->area}} {{ trans('web.In sqft') }}</strong>
                                    </div>
                                    <div class="col-md-6 col-lg-4 text-center border-bottom py-3">
                                        <span class="d-inline-block text-black mb-0 caption-text">{{trans('web.No Of Rooms')}}</span>
                                        <strong class="d-block">{{ trans('web.'.$advertise->rooms) }}</strong>
                                    </div>
                                    <div class="col-md-6 col-lg-4 text-center border-bottom py-3">
                                        <span class="d-inline-block text-black mb-0 caption-text">{{trans('web.No Of Baths')}}</span>
                                        <strong class="d-block">{{ trans('web.'.$advertise->baths) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="container">
                                    <h3>{{trans('web.Description')}} : </h3>
                                    <p class="d-bock mt-3">{!! $advertise->description !!}</p>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row mt-3 mb-5">
                                    <div class="col-md-6 col-lg-6 text-center border-top py-3">
                                        <span class="d-inline-block text-black mb-0 caption-text">{{trans('web.Allow Comments')}}</span>
                                        <strong class="d-block">{{ $advertise->allow_comment? trans('web.active') : trans('web.not active') }}</strong>
                                    </div>
                                    <div class="col-md-6 col-lg-6 text-center border-top py-3">
                                        <span class="d-inline-block text-black mb-0 caption-text">{{trans('web.Status')}}</span>
                                        <strong class="d-block">{{ $advertise->status? trans('web.active') : trans('web.not active') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($comments->count() > 0)
        <div class="mb-30 pd-ltr-20 xs-pd-20-10">
            <div class="card-box">
                <div class="pd-20">
                    <h4 class="text-blue h4">{{trans('web.All Comments')}}</h4>
                </div>
                <div class="pb-20 container">
                    <div class="table-responsive">
                        <table class="data-table table stripe hover nowrap" id="datatableid">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">{{trans('web.Name')}}</th>
                                    <th>{{trans('web.Email')}}</th>
                                    <th>{{trans('web.Comment')}}</th>
                                    <th>{{trans('web.Created at')}}</th>
                                    <th class="datatable-nosort">{{trans('web.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td class="table-plus">{{$comment->user? $comment->user->name : $comment->user_name}}</td>
                                        <td>{{$comment->user? $comment->user->email : $comment->email}}</td>
                                        <td>{{\Illuminate\Support\Str::limit($comment->comment, 50, '...')}}</td>
                                        <td>{{$comment->time_ago}}</td>
                                        <td>
                                            <div class="dropdown main-left">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <button class="dropdown-item view_ads" data-comment="{{ $comment->comment }}"
                                                    ><i class="main_i dw dw-eye"></i> {{trans('web.View')}}</button>
                                                    @if ($comment->status == 1)
                                                        <button class="dropdown-item activate_ads" data-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}"
                                                        ><i class="main_i dw dw-edit2"></i>{{trans('web.Not Activate')}}</button>
                                                    @endif
                                                    <button class="dropdown-item delete_ads" data-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}"
                                                    ><i class="main_i dw dw-delete-3"></i> {{trans('web.Delete')}}</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">{{trans('web.Your Comment')}}</h3>
                <div class="mb-30 text-center"><i class="fa fa-comments-o" style="font-size: 50px;color: #f57200;"></i></div>
                <p id="ads_comment"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('web.Done')}}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to disactivate this comment?')}}</h4>
                <p id="ads_comment_2"></p>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{aurl('ads/disactivate')}}" method="POST">
                        @csrf
                        <input type="hidden" name="comment_id" id="ads_id_2">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                {{trans('web.NO')}}
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                               {{trans('web.YES')}}
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
                <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to delete This comment?')}}</h4>
                <p id="ads_comment_3"></p>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{aurl('ads/delete')}}" method="POST">
                        @csrf
                        <input type="hidden" name="comment_id" id="ads_id_3">
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
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatableid').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            }
        });
    } );
</script>
<script>
    $(document).ready(function() {
        $(".view_ads").click(function() {
            var comment = $(this).attr('data-comment');
            $("#ads_comment").text(comment);
            $("#viewModal").modal('toggle');
        });
        $(".activate_ads").click(function() {
            var id = $(this).attr('data-id');
            var comment = $(this).attr('data-comment');
            $("#ads_id_2").val(id);
            $("#ads_comment_2").text(comment);
            $("#activateModal").modal('toggle');
        });
        $(".delete_ads").click(function() {
            var id = $(this).attr('data-id');
            var comment = $(this).attr('data-comment');
            $("#ads_id_3").val(id);
            $("#ads_comment_3").text(comment);
            $("#deleteModal").modal('toggle');
        });
    });
</script>
@endpush
@endsection
