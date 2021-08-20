@extends('web.layouts.app')
@section('content')
@push('styles')
    <style>
        .btn-main{
            border: 2px solid #F7941D !important;
            border-radius: 0;
            background-color:#F7941D;
        }
        .btn-main:hover{
            background-color: #fff !important;
            border-color: #F7941D;
            color: var(--heading-color);
            transition: 0.5s ease-in-out;
        }
        .contact-us .single-info .title li{
            list-style-type: circle;
            margin-left:10px;
            font-weight:bold;

        }
    </style>
@endpush
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section spad set-bg" data-setbg="{{asset('web/new')}}/img/breadcrumb-contact-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h4>{{trans('web.Contact Us')}}</h4>
                        <div class="bt-option">
                            <a href="./index.html"><i class="fa fa-home"></i>{{trans('web.Home')}}</a>
                            <span>{{trans('web.Contact')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Map Section -->
	<div class="map-section mt-2">
		<div id="myMap">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13659.067395440103!2d31.4570335!3d31.1439891!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1627358408166!5m2!1sar!2seg" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
	</div>
	<!--/ End Map Section -->

  	<!-- Start Contact -->
	<section id="contact-us" class="contact-us section mb-5">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-lg-8 col-12">
							<div class="form-main">
								<div class="title">
									<h4>{{trans('web.Get in touch')}}</h4>
									<h3>{{trans('web.Write us a message')}}</h3>
								</div>
								<form class="form" method="post" action="{{url('contact/message')}}">
                                    @csrf
									<div class="row">
                                        @if (Auth::guest())
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>{{ trans('web.Your Name') }}<span>*</span></label>
                                                    <input name="name" type="text" placeholder="{{ trans('web.Your Name') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>{{ trans('web.Your Email') }}<span>*</span></label>
                                                    <input name="email" type="email" placeholder="{{ trans('web.Your Email') }}">
                                                </div>
                                            </div>
                                        @endif
										<div class="col-12">
											<div class="form-group message">
												<label>{{ trans('web.your message') }}<span>*</span></label>
												<textarea name="message" placeholder="{{ trans('web.your message') }}"></textarea>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group button">
                                                <button type="submit" class="btn btn-main">{{ trans('web.Send') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="single-head">
								<div class="single-info">
									<i class="fa fa-phone"></i>
									<h4 class="title">{{trans('web.Call us Now')}}</h4>
									<ul>
										<li>01066343874</li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-envelope-open"></i>
									<h4 class="title">{{trans('web.Email')}}</h4>
									<ul>
										<li><a href="mailto:info@yourwebsite.com">mastercode179@gmail.com</a></li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-location-arrow"></i>
									<h4 class="title">{{trans('web.Our Address')}}</h4>
									<ul>
										<li>Master Code</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!--/ End Contact -->
@endsection
