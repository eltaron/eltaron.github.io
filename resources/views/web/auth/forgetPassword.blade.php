<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Deelmy</title>
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
    @if(lang() == "ar")
        <style>
            .main_container{
                text-align: right;
                direction: rtl;
            }
            .dropdown-rtl{direction: rtl;}
            .dropdown-item{text-align: right;padding: 4px;}
            .login-menu a {font-size: 18px;}
        </style>
    @endif
    <style>
        @media (max-width: 768px) {
            .brand-logo a img {margin: auto;}
            .login-menu{text-align: center !important;}
        }
    </style>
</head>
<body class="login-page">
    <div class="login-header box-shadow">
		<div class="container-fluid justify-content-between align-items-center">
			<div class="row">
                <div class="brand-logo col-md-6 col-12">
                    <a href="{{aurl('')}}">
                        <img src="{{ asset('admin') }}/vendors/images/logo.png">
                    </a>
                </div>
                <div class="login-menu col-md-6 col-12 text-right p-3">
                    <ul>
                        <li class="dropleft">
                            <div  style="display: inline-block;">
                                <h3 style="display: inline-block;color: #040726;">{{trans('web.'.lang())}}</h3>
                                @if(lang() == "ar")
                                <img
                                style="height: 24px;margin: 3px 15px;"
                                src="{{ asset('admin') }}/src/images/ar.jpg" alt="">
                                @else
                                <img
                                style="height: 24px;margin: 3px 15px;"
                                src="{{ asset('admin') }}/src/images/en.jpg" alt="">
                                @endif
                            </div>
                            <a href="#" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-copy dw dw-worldwide" style="font-size: 27px;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-rtl" aria-labelledby="dropdownMenuButton">
                                <ul class="pro-body">
                                    <li class="dropdown-item" >
                                        <a href="{{ url('language/ar') }}" class="dropdown-item">&nbsp; <img
                                                style="height: 19px;margin-top: 5px;"
                                                src="{{ asset('admin') }}/src/images/ar.jpg" alt="">
                                            {{ trans('web.Arabic') }}</a>
                                    </li>
                                    <li class="dropdown-item" >
                                        <a href="{{ url('language/en') }}" class="dropdown-item">&nbsp; <img
                                                style="height: 19px;margin-top: 5px;"
                                                src="{{ asset('admin') }}/src/images/en.jpg" alt="">
                                            {{ trans('web.English') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container main_container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="{{ asset('admin') }}/vendors/images/security.svg" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">{{trans('web.Forgot Password')}}</h2>
                            <div class="text-center m-auto" style="width:70%;">
                                <a href="{{url('')}}">
                                    <img src="{{ asset('admin') }}/vendors/images/logo.png">
                                </a>
                            </div>
						</div>
						<h6 class="mb-20">{{trans('web.Enter your email address to reset your password')}}</h6>
						<form method="POST" action="{{ url('forgetPassword') }}">
                            @include('admin.includes.messages')
                            @csrf
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" name="email" placeholder="{{trans('web.Email')}}" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<button class="btn btn-primary btn-lg btn-block" type="submit">{{trans('web.Submit')}}</button>
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">{{trans('web.OR')}}</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="login.html">{{trans('web.Login')}}</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="{{ asset('admin') }}/src/plugins/bootstrap/popper.min.js"></script>
    <script src="{{ asset('admin') }}/src/plugins/bootstrap/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/src/plugins/bootstrap/bootstrap.min.js"></script>
</body>
</html>
