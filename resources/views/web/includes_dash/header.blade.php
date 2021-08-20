<body>
    <div class="header">
        <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        </div>
        <div class="header-right">
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                @foreach (agentNotifications() as $ads)
                                    <li>
                                        <a href="{{gurl('chat/show/'.$ads->id)}}">
                                            <img src="{{$ads->user->image}}" alt="">
                                            <h3>{{$ads->user->name}}</h3>
                                            <p>{{$ads->time_ago}}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{Auth::user()->image}}" style="height: 100%">
                        </span>
                        <span class="user-name">{{Auth::user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="{{url('user/account')}}"><i class="dw dw-user1"></i> {{ trans('web.Profile') }}</a>
                        <a class="dropdown-item" href="{{url('user/logout')}}"><i class="dw dw-logout"></i> {{ trans('web.Log Out') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
