@include('web.includes_dash.head')
@include('web.includes_dash.header')
@include('web.includes_dash.sidebarrtl')
@include('web.includes_dash.sidebarltr')
{{-- @include('web.includes_dash.messages') --}}
@yield('content')
@include('web.includes_dash.footer')
