@extends('web.layouts.app_dash')
@section('content')
@push('styles')
    <style>
    .main-left{margin-left: 20px;}
    .add_btn{float: right}
    </style>
    @if(lang() == "ar")
    <style>
        label{color: #f57200;font-size: 20px}
        .main-container{
            text-align: right !important;
            direction: rtl !important;
        }
        .main-left{margin-right: 20px;}
        .dropdown-rtl{direction: rtl;}
        .dropdown-item{text-align: right;padding-right: 45px!important;padding-left: 15px !important;}
        .main_i{right: 15px;}
        .add_btn{float: left}
        .modal-header .close{ margin: -1rem -1rem -1rem -1rem;}
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
                                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ trans('web.Home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    @include('web.includes.messages')
                </div>
                <div class="mb-30">
                    <div class="card-box p-3">
                        <div class="title mb-3">
                            <h4>{{ trans('web.Admin Messages') }}</h4>
                        </div>
                        <div class="add_btn" >
                            <a style="margin-top:-50px;background-color:#f57200" href="message-add" data-toggle="modal" data-target="#message-add" class="bg-light-blue btn text-white weight-500"><i class="ion-plus-round mr-1"></i> {{ trans('web.Add') }}</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table hover multiple-select-row data-table-export nowrap" id="datatableid">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">{{ trans('web.MessageId') }}</th>
                                        <th>{{ trans('web.Message') }}</th>
                                        <th>{{ trans('web.Created-at') }}</th>
                                        <th class="datatable-nosort">{{ trans('web.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($messages)
                                    @foreach ($messages as $message)
                                    <tr>
                                        <td class="table-plus">{{$message->id}}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($message->message, 50, '...') }}</td>
                                        <td>{{$message->time_ago}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item view_ads" data-comment="{{ $message->message }}"><i class="dw dw-eye"></i>{{ trans('web.View') }}</a>
                                                    <a class="dropdown-item delete_ads" data-id="{{ $message->id }}" data-comment="{{ $message->message }}"><i class="dw dw-delete-3"></i>{{ trans('web.Delete') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            {{ trans('web.There Is No Messages Yet.') }}
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mb-30">
                    <div class="card-box p-3">
                        <div class="title mb-3">
                            <h4>{{ trans('web.Send Messages') }}</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table hover multiple-select-row data-table-export nowrap" id="datatableid_2">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">{{ trans('web.MessageId') }}</th>
                                        <th>{{ trans('web.Message') }}</th>
                                        <th>{{ trans('web.Created-at') }}</th>
                                        <th class="datatable-nosort">{{ trans('web.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($messages)
                                    @foreach ($sendMessages as $message)
                                    <tr>
                                        <td class="table-plus">{{$message->id}}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($message->message, 50, '...') }}</td>
                                        <td>{{$message->time_ago}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item view_ads" data-comment="{{ $message->message }}"><i class="dw dw-eye"></i>{{ trans('web.View') }}</a>
                                                    <a class="dropdown-item delete_ads" data-id="{{ $message->id }}" data-comment="{{ $message->message }}"><i class="dw dw-delete-3"></i>{{ trans('web.Delete') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            {{ trans('web.There Is No Messages Yet.') }}
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add task popup start -->
        <div class="modal fade customscroll" id="message-add" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('web.Message Add') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form  action="{{url('user/messages/add')}}" method="POST">
                        @csrf
                        <div class="modal-body p-3">
                                <div class="form-group row">
                                    <label class="col-md-4">{{ trans('web.Message') }}</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="message" required></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('web.Send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- add task popup End -->
	</div>
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">{{ trans('web.Your Message') }}</h3>
                    <div class="mb-30 text-center"><i class="fa fa-comments-o" style="font-size: 50px;color: #f57200;"></i></div>
                    <p id="ads_comment"></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('web.Done') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to delete This Message?') }}</h4>
                    <p id="ads_comment_3"></p>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{url('user/messages/delete')}}" method="POST">
                            @csrf
                            <input type="hidden" name="comment_id" id="ads_id_3">
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
    @push('script')
    <script>
        $(document).ready(function() {
            $(".view_ads").click(function() {
                var comment = $(this).attr('data-comment');
                $("#ads_comment").text(comment);
                $("#viewModal").modal('toggle');
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
        $(document).ready(function() {
            $('#datatableid_2').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
                }
            });
        } );
    </script>
    @endpush
    @endsection
