<!doctype html>
<html>
<head>
    <title>@yield('title','Semster Exam Site')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/admin.css') }}?v=4">
    
    <style>
        .active {
            border: 1px solid #1b9970 !important;
            color: #1b9970 !important;
            background: floralwhite;
        }
    </style>
    @stack('style')
</head>
<body>
    
    <div class="phpcoding">
        <section class="headeroption"></section>
        <section class="maincontent">
            @if(!empty(Session::get('adminSession')))
            <div class="menu">
                <ul>
                    <li><a href="{{ url('/admin/dashbord') }}" class="{{ Request::is('admin/dashbord')?'active':'' }}">Home</a></li>
                    <li><a href="{{ url('/admin/examinees') }}" class="{{ Request::is('admin/examinees')?'active':'' }}">Manage user</a></li>
                    <li><a href="{{ url('/admin/add-question') }}" class="{{ Request::is('admin/add-question')?'active':'' }}">Add Ques</a></li>
                    <li><a href="{{ url('/admin/questions') }}" class="{{ Request::is('admin/questions')?'active':'' }}">Ques List</a></li>
                    <li><a href="{{ url('/admin/settings') }}" class="{{ Request::is('admin/settings')?'active':'' }}">Exam Settings</a></li>
                    <li><a href="{{ url('/admin/profile') }}" class="{{ Request::is('admin/profile')?'active':'' }}">Profile</a></li>
                    <li><a href="{{ url('/admin/logout') }}">Logout</a></li>
                </ul>
            </div>
            @endif
            @yield('section')
        </section>
        <section class="footeroption">
            <h2>@2020 reserved by exam.semster.co</h2>
        </section>
    </div>
    
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/main.js') }}"></script>
    
    <script>
        
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
    {!! Toastr::message() !!}
    @include('partial.error')
    @stack('script')
    
</body>
</html>