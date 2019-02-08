<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8"/><!-- /Added by HTTrack -->
<head>
    @include('includes.admin-header')
</head>

@yield('css')
<style>
    .dropdown-menu .dropdown-item:focus, .dropdown-menu .dropdown-item:hover, .dropdown-menu a:active, .dropdown-menu a:focus, .dropdown-menu a:hover {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgba(229, 57, 53, 0.89);
        background-color: #e53935;
        color: #FFF;
    }

    .pagination > .page-item.active > a, .pagination > .page-item.active > a:focus, .pagination > .page-item.active > a:hover, .pagination > .page-item.active > span, .pagination > .page-item.active > span:focus, .pagination > .page-item.active > span:hover {
        background-color: #e53935;
        border-color: #e53935;
    }

    .table-photo {
        width: 50px;
        height: 50px;
        overflow: hidden;
        z-index: 5;
        border-radius: 20%;
        box-shadow: 0 16px 38px -12px rgba(0, 0, 0, .56), 0 4px 25px 0 rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }
</style>
<body>

<div class="wrapper ">
    <div class="sidebar" data-color="danger" data-background-color="black"
         data-image="{{asset('admin/img/sidebar-3.jpg')}}">
        <div class="logo"><a href="{{url('/')}}" class="simple-text logo-mini">
            </a>
            <a href="{{url('/')}}" class="simple-text logo-normal">
                Online Tutor
            </a></div>

        <div class="sidebar-wrapper">

            <div class="user">
                <div class="photo">
                    <img src="{{asset(Auth::guard('admin')->user()->avatar)}}"/>
                </div>
                <div class="user-info">
                    <a data-toggle="collapse" id="top-nav-user" href="#collapseExample" class="username">
                    <span>
                       {{Auth::guard('admin')->user()->name}}
                        <b class="caret"></b>
                    </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li class="nav-item" id="profile">
                                <a class="nav-link" href="{{url('admin/profile')}}">
                                    <span class="sidebar-mini"> EP </span>
                                    <span class="sidebar-normal"> Edit Profile </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('admin/logout')}}">
                                    <span class="sidebar-mini"> LG </span>
                                    <span class="sidebar-normal"> Logout </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">

                <li class="nav-item " id="index">
                    <a class="nav-link" href="{{url('admin/dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <p> Dashboard </p>
                    </a>
                </li>
                <li class="nav-item " id="admin-nav-tutorRequest">
                    <a class="nav-link" href="{{url('admin/tutor/request')}}">
                        <i class="material-icons">account_box</i>
                        <p> Tutor Account Request </p>
                    </a>
                </li>
                <li class="nav-item " id="admin-nav-users">
                    <a class="nav-link" href="{{url('admin/users')}}">
                        <i class="material-icons">supervisor_account</i>
                        <p> User Manage </p>
                    </a>
                </li>
                <li class="nav-item " id="admin-nav-courses">
                    <a class="nav-link" href="{{url('admin/courses')}}">
                        <i class="material-icons">list</i>
                        <p> Courses </p>
                    </a>
                </li>
                <li class="nav-item " id="admin-nav-sub-courses">
                    <a class="nav-link" href="{{url('admin/sub-courses')}}">
                        <i class="material-icons">list</i>
                        <p>Sub Courses </p>
                    </a>
                </li>
                <li class="nav-item " id="admin-nav-feedback">
                    <a class="nav-link" href="{{url('admin/feedback')}}">
                        <i class="material-icons">assignment</i>
                        <p> User Feedback </p>
                    </a>
                </li>

            </ul>

        </div>
    </div>


    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
            <div class="container-fluid">
                <div class="navbar-wrapper">


                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>


                    <a class="navbar-brand" href="#pablo">Dashboard</a>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        {{--<li class="nav-item dropdown">--}}
                            {{--<a class="nav-link" href="#" id="navbarDropdownMenuLink"--}}
                               {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--<i class="material-icons">notifications</i>--}}
                                {{--<span class="notification">5</span>--}}
                                {{--<p class="d-lg-none d-md-block">--}}
                                    {{--Some Actions--}}
                                {{--</p>--}}
                                {{--<div class="ripple-container"></div>--}}
                            {{--</a>--}}
                            {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">--}}
                                {{--<a class="dropdown-item" href="#">Mike John responded to your email</a>--}}
                                {{--<a class="dropdown-item" href="#">You have 5 new tasks</a>--}}
                                {{--<a class="dropdown-item" href="#">You're now friend with Andrew</a>--}}
                                {{--<a class="dropdown-item" href="#">Another Notification</a>--}}
                                {{--<a class="dropdown-item" href="#">Another One</a>--}}
                            {{--</div>--}}
                        {{--</li>--}}


                        <li class="nav-item">
                            <a class="nav-link" href="" id="navbarProfile"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarProfile">
                                <a class="dropdown-item" href="{{route('admin/profile')}}">Profile</a>
                                <a class="dropdown-item" href="{{url('/admin/logout')}}">Logout</a>
                            </div>
                        </li>
                    </ul>


                </div>
            </div>
        </nav>

        <div class="content">
            @yield('content')
        </div>

    </div>

</div>

@include('includes.admin-core-js')

@yield('js')
<script>
    $('#dataTable').dataTable({
        "ordering": false,
        "pageLength": 10
    });
    $('#dataTable2').dataTable({
        "ordering": false,
        "pageLength": 10
    });

    @if(Session::has('success'))
    successMessage('{{Session::get('success')}}');
    @endif

    @if(Session::has('error'))
    errorMessage('{{Session::get('error')}}');

    @endif
    function errorMessage(message) {
        $.notify({
            icon: "add_alert",
            message: message

        }, {
            type: 'danger',
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }

    function successMessage(message) {
        $.notify({
            icon: "add_alert",
            message: message

        }, {
            type: 'success',
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }
</script>
</body>

</html>
