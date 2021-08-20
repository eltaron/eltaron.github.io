<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Dellmey</title>
	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin') }}/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin') }}/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin') }}/vendors/images/favicon-16x16.png">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/styles/style.css">
    <style>
        .main_btn{
            position: relative;
            top: 36px;
            left: 22px;
            font-size: 23px;
        }
        .chat-desc{height: 128% !important}
		@media (max-width:768px) {
			.chat-desc{height: 109% !important;}
		}
        .chat-footer{
            position: fixed;
            background-color: white;
            width: 100%;
        }
    </style>
</head>
<body>
	<div class="bg-white border-radius-4 box-shadow">
		<div class="row no-gutters">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="chat-detail">
					<div class="chat-profile-header clearfix">
						<div class="left">
							<div class="clearfix">
								<div class="chat-profile-photo">
									<img src="{{$ads->user->image}}" alt="">
								</div>
								<div class="chat-profile-name">
									<h3>{{$ads->user->name}}</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="chat-box">
						<div class="chat-desc customscroll" style="background-color: white;">
                            <div class="main_td_2"></div>
							<ul id="chat-content">
                                @if ($chats != null)
                                    @foreach ($chats as $chat)
                                        @if ($chat->status == 'recieve')
                                            @if ($chat->image)
                                                <li class="clearfix upload-file admin_chat">
                                                    <span class="chat-img">
                                                        <img src="{{$ads->user->image}}" alt="">
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="upload-file-box clearfix">
                                                            <div class="left text-center">
                                                                <img src="{{$chat->image}}" style="height:100%">
                                                                <div class="overlay">
                                                                    <a href="{{$chat->image}}">
                                                                        <span><i class="fa fa-angle-down"></i></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="chat_time">{{$chat->time_ago}}</div>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="clearfix admin_chat">
                                                    <span class="chat-img">
                                                        <img src="{{$ads->user->image}}" alt="">
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <p>{{$chat->content}}</p>
                                                        <div class="chat_time">{{$chat->time_ago}}</div>
                                                    </div>
                                                </li>
                                            @endif
                                        @elseif ($chat->status == 'send')
                                            @if ($chat->image)
                                                <li class="clearfix upload-file">
                                                    <span class="chat-img">
                                                        <img src="{{Auth::user()->image}}" alt="">
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="upload-file-box clearfix">
                                                            <div class="left text-center">
                                                                <img src="{{$chat->image}}" style="height:100%">
                                                                <div class="overlay">
                                                                    <a href="{{$chat->image}}">
                                                                        <span><i class="fa fa-angle-down"></i></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="chat_time">{{$chat->time_ago}}</div>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="clearfix">
                                                    <span class="chat-img">
                                                        <img src="{{Auth::user()->image}}" alt="">
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <p>{{$chat->content}}</p>
                                                        <div class="chat_time">{{$chat->time_ago}}</div>
                                                    </div>
                                                </li>
                                            @endif
                                        @else
                                            <li class="clearfix admin_chat">
                                                <span class="chat-img">
                                                    <img src="{{$ads->user->image}}" alt="">
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
                                            <img src="{{$ads->user->image}}" alt="">
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
                                    <input type="hidden" name="agent" value="{{$ads->user->id}}">
                                    <input type="hidden" name="ads" value="{{$ads->id}}" >
                                    <textarea placeholder="Type your message…" id="message" name="message"></textarea>
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
	<!-- js -->
	<script src="{{ asset('admin') }}/vendors/scripts/core.js"></script>
    <script src="{{ asset('admin') }}/vendors/scripts/script.min.js"></script>
    <script src="{{ asset('admin') }}/vendors/scripts/process.js"></script>
    {{-- <script src="{{ asset('admin') }}/vendors/scripts/jquery.min.js"></script> --}}
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
                    url: '{{url("chat/store")}}',
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
                                                    <img src="` + response['chat']['image'] + `" style="height:100%">
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
                    url:'{{url("chat/".$ads->id)}}',
                    type:'GET',
                    dataType:'json',
                    success:function(response){
                        if(response.chats.length>0){
                            var chats ='';
                            for(var i=0;i<response.chats.length;i++){
                                if(response.chats[i]['status'] == 'recieve') {
                                    if(response.chats[i]['image']) {
                                        chats = chats + `
                                        <li class="clearfix upload-file admin_chat">
                                            <span class="chat-img">
                                                <img src="{{$ads->user->image}}" alt="">
                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="upload-file-box clearfix">
                                                    <div class="left text-center">
                                                        <img src="` + response.chats[i]['image'] + `" style="height:100%">
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
                                                    <img src="{{$ads->user->image}}" alt="">
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
                                                        <img src="` + response.chats[i]['image'] + `" style="height:100%">
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
</body>
</html>
