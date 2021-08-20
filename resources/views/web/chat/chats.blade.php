@extends('web.layouts.app_dash')
@section('content')
    @if(lang() == "ar")
        <style>
            .main-container{
                text-align: right !important;
                direction: rtl !important;
            }
            .chat-profile-header .left .chat-profile-name,.chat-profile-header .left .chat-profile-photo,
            .chat-profile-header .left {float: right}
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
									<li class="breadcrumb-item"><a href="{{url('user')}}">{{ trans('web.Home') }}</a></li>
									<li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
								</ol>
							</nav>
						</div>
					</div>
                    @include('web.includes_dash.messages')
				</div>
				<div class="bg-white border-radius-4 box-shadow mb-30">
					<div class="row no-gutters">
						<div class="col-lg-3 col-md-4 col-sm-12">
							<div class="chat-list bg-light-gray">
								<div class="chat-search">
									<input type="text" placeholder="{{trans('web.All Users')}}" disabled>
								</div>
								<div class="notification-list chat-notification-list customscroll">
									<ul>
                                        @foreach ($chats as $chat)
                                            <li>
                                                <a href="{{url('user/chat/show/'.$chat->id)}}">
                                                    <img src="{{$chat->user->image}}" alt="">
                                                    <h3 class="clearfix">{{$chat->user->name}}</h3>
                                                    <p>{{$chat->ads->name}}</p>
                                                </a>
                                            </li>
                                        @endforeach
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="chat-detail">
								<div class="chat-profile-header clearfix">
									<div class="left">
										<div class="clearfix">
											<div class="chat-profile-photo">
												<img src="{{Auth::user()->image}}" alt="">
											</div>
											<div class="chat-profile-name">
												<h3>{{Auth::user()->name}}</h3>
												<span>{{ Carbon\Carbon::now() }}</span>
											</div>
										</div>
									</div>
								</div>
								<div class="chat-box">
                                    @include('agent.includes.messages')
									<div class="chat-desc customscroll">
										<ul>
											<li class="clearfix admin_chat">
												<span class="chat-img">
													<img src="{{ asset('admin') }}/vendors/images/logo.png" alt="">
												</span>
												<div class="chat-body clearfix">
													<p>{{ trans('web.start chats with your clients now') }}</p>
													<div class="chat_time">{{ Carbon\Carbon::now() }}</div>
												</div>
											</li>
                                        </ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    @endsection
