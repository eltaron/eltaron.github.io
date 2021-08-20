<body>
<!--header-->
     <!-- Offcanvas Menu Wrapper Begin -->
     <div class="offcanvas-menu-overlay"></div>
     <div class="offcanvas-menu-wrapper">
         <div class="canvas-close">
             <span class="icon_close"></span>
         </div>
         <div class="logo">
             <a href="{{url('/')}}">
                 <img src="{{asset('web/new')}}/img/logo.png" >
             </a>
         </div>
         <div id="mobile-menu-wrap"></div>
         <div class="om-widget">
                <ul>
                    <li>
                        <a href="{{url('language/ar')}}">{{ trans('web.AR') }}</a>
                        <span><a href="{{url('language/en')}}">{{ trans('web.EN') }}</a> </span>
                    </li>
                </ul>
             @if (Auth::guest())
                <a href="{{trans('login')}}" class="hw-btn">{{ trans('web.Login') }}</a>
            @else
                <a href="{{trans('logout')}}" class="hw-btn">{{ trans('web.Logout') }}</a>
            @endif
         </div>
         <div class="om-social">
             <a href="#"><i class="fa fa-facebook"></i></a>
             <a href="#"><i class="fa fa-twitter"></i></a>
             <a href="#"><i class="fa fa-youtube-play"></i></a>
             <a href="#"><i class="fa fa-instagram"></i></a>
             <a href="#"><i class="fa fa-pinterest-p"></i></a>
         </div>
     </div>
     <!-- Offcanvas Menu Wrapper End -->

     <!-- Header Section Begin -->
     <header class="header-section">
         <div class="hs-top">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-2">
                         <div class="logo">
                             <a href="{{url('/')}}" class="text-left"><img src="{{asset('web/new')}}/img/logo.png" class="main_img"></a>
                         </div>
                     </div>
                     <div class="col-lg-10">
                         <div class="ht-widget">
                             <ul>
                                <li>
                                    <a href="{{url('language/ar')}}">{{ trans('web.AR') }}</a>
                                    <span><a href="{{url('language/en')}}">{{ trans('web.EN') }}</a> </span>
                                </li>
                             </ul>
                            @if (Auth::guest())
                                <a href="{{trans('login')}}" class="hw-btn">{{ trans('web.Login') }}</a>
                            @else
                                <a href="{{trans('logout')}}" class="hw-btn">{{ trans('web.Logout') }}</a>
                            @endif
                         </div>
                     </div>
                 </div>
                 <div class="canvas-open">
                     <span class="icon_menu"></span>
                 </div>
             </div>
         </div>
         <div class="hs-nav">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-9">
                         <nav class="nav-menu">
                             <ul>
                                 <li class="{{$name == 'home' ? 'active' : ''}}"><a href="{{url('home')}}">{{ trans('web.Home') }}</a></li>
                                 <li class="{{$name == 'ads' ? 'active' : ''}}"><a href="{{url('ads')}}">{{ trans('web.Advertisments') }}</a></li>
                                 <li class="{{$name == 'agents' ? 'active' : ''}}"><a href="{{url('agents')}}">{{ trans('web.Agents') }}</a></li>
                                 <li class="{{$name == 'blog' ? 'active' : ''}}"><a href="{{url('blog')}}">{{ trans('web.Blog') }}</a></li>
                                 <li class="{{$name == 'about' ? 'active' : ''}}"><a href="{{url('about')}}">{{ trans('web.About') }}</a></li>
                                 <li class="{{$name == 'contact' ? 'active' : ''}}"><a href="{{url('contact')}}">{{ trans('web.Contact') }}</a></li>
                             </ul>
                         </nav>
                     </div>
                     <div class="col-lg-3">
                         <div class="hn-social">
                            @if (!Auth::guest())
                                <a href="{{url('user')}}">{{ trans('web.Dashboard') }}</a>
                            @endif
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </header>
     <!-- Header End -->
