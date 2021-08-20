@extends('agent.layouts.app')
@section('content')
    @if(lang() == "ar")
    <style>
        .main-container{
            text-align: right !important;
            direction: rtl !important;
        }
        .profile-social ul li {
            float: right;
        }
    </style>
    @endif
	<div class="main-container mt-5">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
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
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="{{Auth::user()->image}}" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
                                            <form action="{{gurl('user/update/image')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body pd-5">
                                                    <div class="img-container text-center">
                                                        <img id="image" src="{{Auth::user()->image}}" alt="Picture">
                                                    </div>
                                                    <div class="input-group mb-3 p-4">
                                                        <div class="custom-file">
                                                            <input type="file" name="image" required class="custom-file-input" id="inputGroupFile01">
                                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('web.Choose file')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                        <input type="submit" value="Update" class="btn btn-primary">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.Close')}}</button>
                                                </div>
                                            </form>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center h5 mb-0">{{Auth::user()->name}}</h5>
							<p class="text-center text-muted font-14">{{Auth::user()->description}}</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">{{ trans('web.Contact Information') }}</h5>
								<ul>
									<li>
										<span>{{ trans('web.Email Address') }}</span>
										{{Auth::user()->email}}
									</li>
                                    @if(Auth::user()->mobile)
                                        <li>
                                            <span>{{ trans('web.Phone Number') }}</span>
                                            {{Auth::user()->mobile}}
                                        </li>
                                    @endif
                                    @if(Auth::user()->city)
                                        <li>
                                            <span>{{ trans('web.City') }}</span>
                                            @if(lang() == "en")
                                                {{Auth::user()->city->name_en}}
                                            @else
                                                {{Auth::user()->city->name_ar}}
                                            @endif
                                        </li>
                                    @endif
								</ul>
							</div>
							<div class="profile-social">
								<h5 class="mb-20 h5 text-blue">{{ trans('web.Social Media Links') }}</h5>
								<ul class="clearfix">
									<li><a href="{{$agent->facebook}}" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
									<li><a href="{{$agent->twitter}}" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
									<li><a href="{{$agent->instgram}}" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
									<li><a href="https://mail.google.com/mail/u/1/?view=cm&fs=1&to={{Auth::user()->email}}&tf=1" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">{{ trans('web.Account Details') }}</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#setting" role="tab">{{ trans('web.Edit Account') }}</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Timeline Tab start -->
										<div class="tab-pane fade show active" id="timeline" role="tabpanel">
											<div class="pd-20">
												<div class="profile-setting">
                                                    <form>
                                                        <ul class="profile-edit-list row">
                                                            <li class="weight-500 col-md-6">
                                                                <h4 class="text-blue h5 mb-20">{{trans('web.Personal Information') }}</h4>
                                                                <div class="form-group">
                                                                    <label>{{ trans('web.Full Name') }}</label>
                                                                    <input class="form-control form-control-lg" value="{{Auth::user()->name}}" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>{{ trans('web.Email') }}</label>
                                                                    <input class="form-control form-control-lg" value="{{Auth::user()->email}}" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>{{ trans('web.Date of registration') }}</label>
                                                                    <input class="form-control form-control-lg" value="{{Auth::user()->created_at}}" disabled>
                                                                </div>
                                                                @if(Auth::user()->city)
                                                                    <div class="form-group">
                                                                        <label>{{ trans('web.City') }}</label>
                                                                        <input class="form-control form-control-lg" value="{{Auth::user()->city->name_en}}" disabled>
                                                                    </div>
                                                                @endif
                                                                <div class="form-group">
                                                                    <label>{{ trans('web.Description') }}</label>
                                                                    <textarea class="form-control" disabled>{{Auth::user()->description}}</textarea>
                                                                </div>                                                            </li>
                                                            <li class="weight-500 col-md-6">
                                                                <h4 class="text-blue h5 mb-20">{{ trans('web.Social Media links') }}</h4>
                                                                <div class="form-group">
                                                                    <label>{{ trans('web.Facebook URL') }}</label>
                                                                    <input class="form-control form-control-lg" value="{{$agent->facebook}}" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>{{ trans('web.Twitter URL') }}</label>
                                                                    <input class="form-control form-control-lg" value="{{$agent->twitter}}" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>{{ trans('web.Instagram URL') }}</label>
                                                                    <input class="form-control form-control-lg" value="{{$agent->instgram}}" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>{{ trans('web.Google Email') }}</label>
                                                                    <input class="form-control form-control-lg" value="{{Auth::user()->email}}" disabled>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </form>
                                                </div>
											</div>
										</div>
										<!-- Timeline Tab End -->
										<!-- Setting Tab start -->
										<div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form action="{{gurl('user/edit')}}" method="post">
                                                    @csrf
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">{{trans('web.Edit Your Personal Setting')}}</h4>
															<div class="form-group">
																<label>{{trans('web.Full Name')}}</label>
																<input class="form-control form-control-lg" type="text" value="{{Auth::user()->name}}" name="name">
															</div>
															<div class="form-group">
																<label>{{trans('web.Email')}}</label>
																<input class="form-control form-control-lg" type="email" value="{{Auth::user()->email}}" name="email">
															</div>
															<div class="form-group">
																<label>{{trans('web.City')}}</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" name="city">
																	@foreach ($cities as $city)
                                                                        <option value="{{$city->id}}">
                                                                            @if(lang() == "en")
                                                                                {{$city->name_en}}
                                                                            @else
                                                                                {{$city->name_ar}}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
																</select>
															</div>
															<div class="form-group">
																<label>{{trans('web.Description')}}</label>
																<textarea class="form-control" name="description">{{Auth::user()->description}}</textarea>
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">{{trans('web.Edit Social Media links')}}</h4>
															<div class="form-group">
                                                                <label>{{trans('web.Facebook URL')}}</label>
                                                                <input class="form-control form-control-lg" value="{{$agent->facebook}}" name="facebook">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>{{trans('web.Twitter URL')}}</label>
                                                                <input class="form-control form-control-lg" value="{{$agent->twitter}}" name="twitter">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>{{trans('web.Instagram URL')}}</label>
                                                                <input class="form-control form-control-lg" value="{{$agent->instgram}}" name="instgram">
                                                            </div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="{{trans('web.Save & Update')}}">
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
										<!-- Setting Tab End -->
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
