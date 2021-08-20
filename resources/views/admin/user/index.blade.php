@extends('admin.layouts.app')
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
    .dataTables_length label {
        text-align: right;
        display: block;
    }
    .dataTables_filter label {
        text-align: right;
        display: block;
        direction: rtl
    }
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
		<div class="pd-ltr-20 height-100-p xs-pd-20-10">
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
                    @include('admin.includes.messages')
                </div>
                <div class="mb-30">
                    <div class="card-box p-3">
                        <div class="table-responsive">
                            <table class="data-table table stripe hover nowrap" id="datatableid">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">{{ trans('web.UserId') }}</th>
                                        <th>{{ trans('web.Name') }}</th>
                                        <th>{{ trans('web.Email') }}</th>
                                        <th>{{ trans('web.status') }}</th>
                                        <th class="datatable-nosort">{{ trans('web.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users)
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="table-plus">{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td class="{{$user->status == 0 ? 'text-danger' : 'text-success'}}">{{$user->status == 1 ? trans('web.activate') : trans('web.not activate')}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="{{aurl('user/show/'.$user->id)}}"><i class="main_i dw dw-eye"></i>{{ trans('web.View & Edit') }}</a>
                                                    @if ($user->status == 1)
                                                        <button class="dropdown-item not_activate_user" data-id="{{ $user->id }}"
                                                        ><i class="main_i dw dw-edit2"></i>{{ trans('web.Not Activate') }}</button>
                                                    @else
                                                        <button class="dropdown-item activate_user" data-id="{{ $user->id }}"
                                                        ><i class="main_i dw dw-edit2"></i>{{ trans('web.Activate') }}</button>
                                                    @endif
                                                    <a class="dropdown-item delete_user" href="#" data-id="{{ $user->id }}"><i class="main_i dw dw-delete-3"></i>{{ trans('web.Delete') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            {{ trans('web.There Is No Users Yet.') }}
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to delete This User ?</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{aurl('user/delete')}}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    NO
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-danger border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></button>
                                    YES
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
                    <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to disactivate this user ?') }}</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{aurl('user/disactivate')}}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" id="ads_id_4">
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
                    <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to activate this user ?') }}</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{aurl('user/activate')}}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" id="ads_id_3">
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
            $(".delete_user").click(function() {
                var id = $(this).attr('data-id');
                $("#user_id").val(id);
                $("#deleteModal").modal('toggle');
            });
        });
        $(".activate_user").click(function() {
            var id = $(this).attr('data-id');
            $("#ads_id_3").val(id);
            $("#activateModal").modal('toggle');
        });
        $(".not_activate_user").click(function() {
            var id = $(this).attr('data-id');
            $("#ads_id_4").val(id);
            $("#not_activate_adsModal").modal('toggle');
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
    </script>
    @endpush
    @endsection
