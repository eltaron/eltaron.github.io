@extends('admin.layouts.app')
@section('content')
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
<div class="main-container mt-5">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row mb-2">
						<div class="col-md-6 col-sm-12">
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
				<div class="bg-white border-radius-4 box-shadow mb-30">
					<div class="card-box p-3">
                        <div class="table-responsive">
                            <table class="data-table table stripe hover nowrap" id="datatableid">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">{{ trans('web.ID') }}</th>
                                        <th>{{ trans('web.Client Name') }}</th>
                                        <th>{{ trans('web.Agent Name') }}</th>
                                        <th>{{ trans('web.Advertisment') }}</th>
                                        <th>{{ trans('web.Type') }}</th>
                                        <th>{{ trans('web.Created At') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($chats)
                                        @foreach ($chats as $chat)
                                        <tr class="{{$chat->type == 'success' ? 'text-success' : ''}}">
                                            <td class="table-plus">{{$chat->id}}</td>
                                            <td>{{$chat->user->name}}</td>
                                            <td>{{$chat->agent->name}}</td>
                                            <td>{{$chat->ads->name}}</td>
                                            <td>{{$chat->type}}</td>
                                            <td>{{$chat->time_ago}}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            {{ trans('web.There Is No Chats Yet.') }}
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
    @endpush
    @endsection
