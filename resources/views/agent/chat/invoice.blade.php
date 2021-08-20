@extends('agent.layouts.app')
@section('content')
    <style>
        .rows{width: 100%; padding-left: 20px;}
        .rows label {
            font-size: 19px;
        }
        .margin-left{padding-left: 0 !important;}
        .colered_text{
            font-family: helvetica;
            font-weight: bold;
            font-size: 5vw;
            font-smoothing: antialiased;
            -webkit-font-smoothing: antialiased;
            background: linear-gradient(
            80deg
            ,#05f7ff88,#ff333388,#f57200,#ff663388,#05f7ff88), linear-gradient(
            40deg
            ,#cc33ffee,#33ccffee,#ff9933ee,#f57200);
            backdrop-filter: blur(1000px);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            background-size: 200%;
            animation: moveGradient 10s linear infinite;
        }
        @keyframes moveGradient{
        to{background-position:600%}
        }
    </style>
    @if(lang() == "ar")
        <style>
            .main-container{
                text-align: right !important;
                direction: rtl !important;
            }
            .chat-profile-header .left .chat-profile-name,.chat-profile-header .left .chat-profile-photo,
            .chat-profile-header .left {float: right}
            .row{padding-right: 20px;}
            .margin-left{padding-right: 27px !important;padding-left: 30px !important}
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
									<li class="breadcrumb-item"><a href="{{gurl('home')}}">{{ trans('web.Home') }}</a></li>
									<li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
								</ol>
							</nav>
						</div>
					</div>
                    @include('agent.includes.messages')
				</div>
                <div class="invoice-box mb-4 w-100  data-table-export" id="printTable">
                    <div class="invoice-header">
                        <div class="logo text-left pl-5">
                            <button id="print" class="btn btn-primary mt-3">{{ trans('web.print invoice') }}</button>
                            <button data-toggle="modal" data-target="#message-add" class="btn btn-primary mt-3">{{ trans('web.Send Email') }}</button>
                        </div>
                    </div>
                    <h2 class="text-center mb-30 colered_text">{{ trans('web.INVOICE') }}</h2>
                    <div class="row">
                        <div class="row rows">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >&#9830; {{ trans('web.Invoice ID') }}</label>
                                    <input type="text" value="{{$invoice->id}}" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row rows">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >&#9830; {{ trans('web.Client Name') }}</label>
                                    <input type="text" value="{{$invoice->user->name}}" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row rows">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >&#9830; {{ trans('web.Agent Name') }}</label>
                                    <input type="text" value="{{$invoice->agent->name}}" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row rows">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >&#9830; {{ trans('web.Advertisment') }}</label>
                                    <input type="text" value="{{$invoice->chat->ads->name}}" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row rows">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >&#9830; {{ trans('web.Created At') }}</label>
                                    <input type="text" value="{{$invoice->time_ago}}" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-desc">
                        <div class="invoice-desc-footer p-4 margin-left">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ trans('web.Advertisment') }}</th>
                                            <th scope="col">{{ trans('web.Price') }}</th>
                                            <th scope="col">{{ trans('web.Created At') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$invoice->chat->ads->name}}</td>
                                            <td>{{$invoice->chat->ads->price}}</td>
                                            <td>{{$invoice->time_ago}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-center pb-20">
                        <img src="{{ asset('admin') }}/vendors/images/logo.png" width="250" class="m-auto" >
                    </h4>
                </div>
			</div>
		</div>
	</div>
    <div class="modal fade customscroll" id="message-add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to Send Email to this client?') }}</h4>
                    <p id="ads_comment_3"></p>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{gurl('invoice/send')}}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{$invoice->chat->user->email}}">
                            <input type="hidden" name="invoice"value="{{$invoice->id}}" >
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    {{ trans('web.NO') }}
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></button>
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
        function printData()
        {
            var divToPrint=document.getElementById("printTable");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            var css =`
                {{lang() == "ar" ? 'body{direction:rtl;text-align:right;}' : ''}}
                table, td, th {
                    border: 1px solid black;
                }
                table {width:80%;margin-top:20px}
                td {padding:5px}
                #datatableid_wrapper .row:first-child{display:none;}
                #datatableid_wrapper .row:last-child{display:none;}
                input{display:block; margin:10px 0; width:80%;padding:10px}
                #print{display:none}
                th {
                    background-color: #7a7878;
                    text-align:center
                }`;
            var div = $("<div />", {
                html: '&shy;<style>' + css + '</style>'
            }).appendTo( newWin.document.body);
                newWin.print();
                newWin.close();
            }
            $('#print').on('click',function(){
            printData();
            })
        </script>
    @endpush
    @endsection
