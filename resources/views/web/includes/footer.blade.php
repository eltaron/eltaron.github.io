
    <!-- start footer Area -->
	<footer class="footer-area section-gap">
        <div class="container">
            <div class="row my-3">
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h5 class="text-light mb-2">{{ trans('web.About Agency') }}</h5>
                        <p>
                            {{ trans('web.The world has become so fast paced that people don’t want to stand by reading a page of information, they would much rather look at a presentation and understand the message. It has come to a point') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h5 class="text-light mb-2">{{ trans('web.Navigation Links') }}</h5>
                        <div class="row p-3">
                            <div class="col">
                                <ul>
                                    <li><a href="{{url('home')}}">{{ trans('web.Home') }}</a></li>
                                    <li><a href="{{url('ads')}}">{{ trans('web.Advertisments') }}</a></li>
                                    <li><a href="{{url('blog')}}">{{ trans('web.Blog') }}</a></li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul>
                                    <li><a href="{{url('agents')}}">{{ trans('web.Agents') }}</a></li>
                                    <li><a href="{{url('contact')}}">{{ trans('web.Contact') }}</a></li>
                                    <li><a href="{{url('about')}}">{{ trans('web.About') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h5 class="text-light mb-2">{{ trans('web.Latest Ads') }}</h5>
                        <ul class="instafeed d-flex flex-wrap">
                            @foreach (ads() as $item)
                                <li>
                                    <a href="{{url('adsDetails/'.$item->id)}}">
                                        <img src="{{$item->image->url}}" style="width: 91%;">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row footer-bottom d-flex justify-content-between align-items-center" style="padding-bottom: 20px;">
                <p class="col-lg-8 col-sm-12 footer-text m-0" style="color:#fff">
                &copy;<script>document.write(new Date().getFullYear());</script> {{ trans('web.Deelmy is made with') }} <i class="fa fa-heart" aria-hidden="true"></i> {{ trans('web.by') }} <a href="https://www.facebook.com/MasterC0de" target="_blank">Master Code</a>
                </p>
                <div class="col-lg-4 col-sm-12 footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-google"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->
    <!-- Js Plugins -->
    <script src="{{asset('web/new')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('web/new')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('web/new')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('web/new')}}/js/mixitup.min.js"></script>
    <script src="{{asset('web/new')}}/js/jquery-ui.min.js"></script>
    <script src="{{asset('web/new')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{asset('web/new')}}/js/jquery.slicknav.js"></script>
    <script src="{{asset('web/new')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('web/new')}}/js/jquery.richtext.min.js"></script>
    <script src="{{asset('web/new')}}/js/image-uploader.min.js"></script>
    <script src="{{asset('web/new')}}/js/main.js"></script>
    <script>
        $(document).ready(function(){
        $('.toast').toast('show');
        });
    </script>
</body>

</html>
