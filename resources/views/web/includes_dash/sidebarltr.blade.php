<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{url('dashboard')}}">
            <img src="{{ asset('admin') }}/vendors/images/logo.png" alt="" class="dark-logo m-auto mb-2">
            <img src="{{ asset('admin') }}/vendors/images/logod.png" alt="" class="light-logo m-auto mb-2">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll pt-5">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{url('user/dashboard')}}" class="dropdown-toggle dropdown-toggle-none">
                        <span class="micon dw dw-house-1"></span><span class="mtext">{{ trans('web.Home') }}</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-browser"></span><span class="mtext">{{ trans('web.ADS') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{url('user/ads')}}">{{ trans('web.All ADS') }}</a></li>
                        <li><a href="{{url('user/ads/create')}}">{{ trans('web.New ADS') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{url('user/account')}}" class="dropdown-toggle dropdown-toggle-none">
                        <span class="micon dw dw-file-4"></span><span class="mtext">{{ trans('web.Account') }}</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-chat-2"></span><span class="mtext">{{ trans('web.Contact') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{url('user/chat')}}">{{ trans('web.Chats') }}</a></li>
                        <li><a href="{{url('user/messages/sent')}}">{{ trans('web.Messages') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{url('user/invoice/all')}}" class="dropdown-toggle dropdown-toggle-none">
                        <span class="micon dw dw-invoice"></span><span class="mtext">{{ trans('web.Invoices') }}</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{url('home')}}" class="dropdown-toggle dropdown-toggle-none">
                        <span class="micon dw dw-monitor"></span><span class="mtext">{{ trans('web.Front page') }}</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{url('logout')}}" class="dropdown-toggle dropdown-toggle-none">
                        <span class="micon dw dw-logout1"></span><span class="mtext">{{ trans('web.Logout') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
