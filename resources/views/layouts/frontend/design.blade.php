<!doctype html>
<html>
    <head>
        <title>@yield('title','Semster Exam Site')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Cache-Control" content="no-cache">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}?v=2">
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <style>
        .active {
    border: 1px solid #fff !important;
    color: #fff !important;
}
            </style>
        @stack('style')
    </head>
    <body>

    <div class="phpcoding">
        <section class="headeroption"></section>
        <section class="maincontent">
            <div class="menu">
            <ul>
                @if(!empty(Session::get('userSession')))
                <li><a href="{{ url('/profile') }}" class="{{ Request::is('profile')?'active':'' }}">Profile</a></li>
                <li><a href="{{url('exam')}}" class="{{ Request::is('exam')?'active':'' }}">Exam</a></li>
                <li><a href="{{ url('/logout')}}">Logout</a></li>
                @else
                <li><a href="{{ url('/') }}" class="{{ Request::is('/')?'active':'' }}">Login</a></li>
                <li><a href="{{ url('/registration') }}" class="{{ Request::is('registration')?'active':'' }}">Register</a></li>
                @endif
            </ul>
            </div>
            @yield('section')
        </section>
        <section class="footeroption">
            <h2>@2020 reserved by exam.semster.co</h2>
         </section>
    </div>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
     <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
     <script src="{{ asset('assets/frontend/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
    {!! Toastr::message() !!}
    @stack('script')
     @include('partial.error')
</body>
</html>