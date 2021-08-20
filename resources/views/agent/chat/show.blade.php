@extends('agent.layouts.app')
@section('content')
@push('styles')
    <style>
        .main_btn{
            position: relative;
            top: 36px;
            left: 22px;
            font-size: 23px;
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
            .main_dropdown{text-align: left}
            .main_btn{right: 7px;left: auto;}
        </style>
    @endif
@endpush
<div class="main-container">
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
				<div class="bg-white border-radius-4 box-shadow mb-30">
					<div class="row no-gutters">
						<div class="col-lg-3 col-md-4 col-sm-12">
							<div class="chat-list bg-light-gray">
								<div class="chat-search">
									<input type="text" placeholder="{{trans('web.All Users')}}" disabled>
								</div>
								<div class="notification-list chat-notification-list customscroll">
									<ul>
                                        @foreach ($Allchats as $Allchat)
                                            <li class="{{$Allchat->id == $chat->id?'active':''}}">
                                                <a href="{{gurl('chat/show/'.$Allchat->id)}}">
                                                    <img src="{{$Allchat->user->image}}" alt="">
                                                    <h3 class="clearfix">{{$Allchat->user->name}}</h3>
                                                    <p>{{$Allchat->ads->name}}</p>
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
												<img src="{{$chat->user->image}}" alt="">
											</div>
											<div class="chat-profile-name">
												<h3>{{$chat->user->name}}</h3>
												<span>{{$chat->time_ago}}</span>
											</div>
										</div>
									</div>
                                    @if ($chat->type != 'success')
                                        <div class="right text-right">
                                            <div class="dropdown main_dropdown">
                                                <a class="btn btn-success text-light" data-toggle="modal" data-target="#message-add">
                                                    {{ trans('web.Complete') }}
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="right text-right">
                                            <div class="dropdown main_dropdown">
                                                <a class="btn btn-primary text-light" href="{{gurl('chat/invoice/'.$chat->id)}}">
                                                    {{ trans('web.Invoice') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
								</div>
								<div class="chat-box">
									<div class="chat-desc customscroll">
										<div class="main_td_2"></div>
                                        <ul id="chat-content">
                                            @if ($chats != null)
                                                @foreach ($chats as $main_chat)
                                                    @if ($main_chat->status == 'send')
                                                        @if ($main_chat->image)
                                                            <li class="clearfix upload-file admin_chat">
                                                                <span class="chat-img">
                                                                    <img src="{{$chat->user->image}}" alt="">
                                                                </span>
                                                                <div class="chat-body clearfix">
                                                                    <div class="upload-file-box clearfix">
                                                                        <div class="left text-center">
                                                                            <img src="{{$main_chat->image}}" style="height: 100% !important">
                                                                            <div class="overlay">
                                                                                <a href="{{$main_chat->image}}">
                                                                                    <span><i class="fa fa-angle-down"></i></span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat_time">{{$main_chat->time_ago}}</div>
                                                                </div>
                                                            </li>
                                                        @else
                                                            <li class="clearfix admin_chat">
                                                                <span class="chat-img">
                                                                    <img src="{{$chat->user->image}}" alt="">
                                                                </span>
                                                                <div class="chat-body clearfix">
                                                                    <p>{{$main_chat->content}}</p>
                                                                    <div class="chat_time">{{$main_chat->time_ago}}</div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @elseif ($main_chat->status == 'recieve')
                                                        @if ($main_chat->image)
                                                            <li class="clearfix upload-file">
                                                                <span class="chat-img">
                                                                    <img src="{{Auth::user()->image}}" alt="">
                                                                </span>
                                                                <div class="chat-body clearfix">
                                                                    <div class="upload-file-box clearfix">
                                                                        <div class="left text-center">
                                                                            <img src="{{$main_chat->image}}" style="height: 100% !important">
                                                                            <div class="overlay">
                                                                                <a href="{{$main_chat->image}}">
                                                                                    <span><i class="fa fa-angle-down"></i></span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat_time">{{$main_chat->time_ago}}</div>
                                                                </div>
                                                            </li>
                                                        @else
                                                            <li class="clearfix">
                                                                <span class="chat-img">
                                                                    <img src="{{Auth::user()->image}}" alt="">
                                                                </span>
                                                                <div class="chat-body clearfix">
                                                                    <p>{{$main_chat->content}}</p>
                                                                    <div class="chat_time">{{$main_chat->time_ago}}</div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @else
                                                        <li class="clearfix admin_chat">
                                                            <span class="chat-img">
                                                                <img src="{{$chat->user->image}}" alt="">
                                                            </span>
                                                            <div class="chat-body clearfix">
                                                                <p>{{trans('web.Write something')}}</p>
                                                                <div class="chat_time">{{date('Y-m-d')}}</div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @else
                                                <li class="clearfix admin_chat">
                                                    <span class="chat-img">
                                                        <img src="{{$chat->user->image}}" alt="">
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <p>{{trans('web.Write something')}}</p>
                                                        <div class="chat_time">{{date('Y-m-d')}}</div>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
									</div>
									<div class="chat-footer">
                                        <form id="contactForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="file-upload custom-file">
                                                <i class="fa fa-paperclip main_btn" for="images"></i>
                                                <input type="file" name="images" class="custom-file-input" id="images">
                                            </div>
                                            <div class="chat_text_area">
                                                <input type="hidden" name="chat" value="{{$chat->id}}" >
                                                <textarea placeholder="{{trans('web.Type your message…')}}" id="message" name="message"></textarea>
                                            </div>
                                            <div class="chat_send">
                                                <button class="btn btn-link" type="submit"><i class="icon-copy ion-paper-airplane"></i></button>
                                            </div>
                                        </form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="modal fade customscroll" id="message-add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">{{ trans('web.Are you sure you want to Complete This Chat?') }}</h4>
                    <p id="ads_comment_3"></p>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{gurl('chat/complete')}}" method="POST">
                            @csrf
                            <input type="hidden" name="chat_id" value="{{$chat->id}}">
                            <input type="hidden" name="user_id" value="{{$chat->user->id}}">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    {{ trans('web.NO') }}
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-success border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></button>
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
        $(document).ready(function(){
            setInterval(function(){
                fetch_user_chat_history();
            }, 5000);
            $('#images').change(function() {
                $('#message').val("{{trans('web.One file choosen')}}");
            });
            $('#contactForm').on('submit',function(e){
                e.preventDefault();
                var formData = new FormData(this); //select your form
                $.ajax({
                    url: '{{gurl("chat/store")}}',
                    type:"POST",
                    data: formData, //pass the formdata object
                    cache: false,
                    contentType: false, //tell jquery to avoid some checks
                    processData: false,
                    success:function(response){
                        if(!response['error']){
                            if(response['chat']['image']) {
                                data = `
                                <li class="clearfix upload-file">
                                        <span class="chat-img">
                                            <img src="{{Auth::user()->image}}" alt="">
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="upload-file-box clearfix">
                                                <div class="left text-center">
                                                    <img src="` + response['chat']['image'] + `" style="height: 100% !important">
                                                    <div class="overlay">
                                                        <a href="` + response['chat']['image'] + `">
                                                            <span><i class="fa fa-angle-down"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat_time">` + response['chat']['time_ago'] + `</div>
                                        </div>
                                    </li>
                                `;
                            } else {
                                data = `
                                <li class="clearfix">
                                    <span class="chat-img">
                                        <img src="{{Auth::user()->image}}" alt="">
                                    </span>
                                    <div class="chat-body clearfix">
                                        <p>`+response['chat']['content']+`</p>
                                        <div class="chat_time">` + response['chat']['time_ago'] + `</div>
                                    </div>
                                </li>
                                `;
                            }
                            $('#chat-content').append(data);
                            $('#message').val('');
                        } else {
                            data = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        `+response['error']+`
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> `;
                            $('.main_td_2').append(data);
                        }
                    }
                });
            });
            function fetch_user_chat_history(){
                $.ajax({
                    url:'{{gurl("chat/show/".$chat->id)}}',
                    type:'GET',
                    dataType:'json',
                    success:function(response){
                        if(response.chats.length>0){
                            var chats ='';
                            for(var i=0;i<response.chats.length;i++){
                                if(response.chats[i]['status'] == 'send') {
                                    if(response.chats[i]['image']) {
                                        chats = chats + `
                                        <li class="clearfix upload-file admin_chat">
                                            <span class="chat-img">
                                                <img src="{{$chat->user->image}}" alt="">
                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="upload-file-box clearfix">
                                                    <div class="left text-center">
                                                        <img src="` + response.chats[i]['image'] + `" style="height: 100% !important">
                                                        <div class="overlay">
                                                            <a href="` + response.chats[i]['image'] + `">
                                                                <span><i class="fa fa-angle-down"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat_time">` + response.chats[i]['time_ago'] + `</div>
                                            </div>
                                        </li>
                                        `;
                                    } else {
                                            chats = chats + `
                                            <li class="clearfix admin_chat">
                                                <span class="chat-img">
                                                    <img src="{{$chat->user->image}}" alt="">
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <p>`+response.chats[i]['content']+`</p>
                                                    <div class="chat_time">` + response.chats[i]['time_ago'] + `</div>
                                                </div>
                                            </li>
                                            `;
                                    }
                                } else {
                                    if(response.chats[i]['image']) {
                                        chats = chats + `
                                        <li class="clearfix upload-file">
                                            <span class="chat-img">
                                                <img src="{{Auth::user()->image}}" alt="">
                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="upload-file-box clearfix">
                                                    <div class="left text-center">
                                                        <img src="` + response.chats[i]['image'] + `" style="height: 100% !important">
                                                        <div class="overlay">
                                                            <a href="` + response.chats[i]['image'] + `">
                                                                <span><i class="fa fa-angle-down"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat_time">` + response.chats[i]['time_ago'] + `</div>
                                            </div>
                                        </li>
                                        `;
                                    } else {
                                            chats = chats + `
                                            <li class="clearfix">
                                                <span class="chat-img">
                                                    <img src="{{Auth::user()->image}}" alt="">
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <p>`+response.chats[i]['content']+`</p>
                                                    <div class="chat_time">` + response.chats[i]['time_ago'] + `</div>
                                                </div>
                                            </li>
                                            `;
                                    }
                                }
                            }
                            $('#chat-content').empty();
                            $('#chat-content').append(chats);
                        }
                    },error:function(err){
                        console.log(err);
                    }
                });
            }
        });
    </script>
    @endpush
    @endsection
