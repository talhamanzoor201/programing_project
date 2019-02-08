<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title> @yield('title') </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="xyz">
    <link rel="icon" type="image/png" href="{{asset('images/logo-dark.png')}}">
    <!-- Styles -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-grid.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/chosen.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/colors/colors.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"/>
    <style>
        .nav-active {
            background: rgba(0, 0, 0, 0.1) !important;
            border-radius: 5% !important;
        }

        .nav-link1:hover {
            background: rgba(0, 0, 0, 0.1) !important;
            border-radius: 5% !important;
            margin: 0.2rem !important;
        }

        .hide {
            display: none !important;
        }

        .show {
            display: block !important;
        }

        .error-show {
            float: left !important;
            font-size: 13px !important;
            text-align: left !important;
            line-height: normal !important;
        }

        .account-popup > form .cfield {
            margin-bottom: unset;
            margin-top: 19px;
        }

        .forsticky.sticky .my-profiles-sec > span > i {
            color: #232323 !important;
        }

        .action_job > li span {
            width: 110px !important;
        }

        /*.forsticky.sticky .my-profiles-sec > span > img {*/
        /*border: 2px solid #232323;*/
        /*}*/
    </style>
    @yield('style')
</head>
<body>
@php $courses  = \App\Course::orderBy('name')->get();
      $cities = \App\City::orderBy('name')->get();@endphp
<div class="theme-layout" id="scrollup">
    {{--for small devices--}}
    <div class="responsive-header">
        <div class="responsive-menubar">
            <div class="res-logo"><a href="{{'/'}}" title=""><img
                            src="{{asset('images/logo-white.png')}}" style="height: 3.5rem" alt=""/></a></div>
            <div class="menu-resaction">
                <div class="res-openmenu">
                    <img src="{{asset(asset('images/icon.png'))}}" alt=""/> Menu
                </div>
                <div class="res-closemenu">
                    <img src="{{asset('images/icon2.png')}}" alt=""/> Close
                </div>
            </div>
        </div>
        <div class="responsive-opensec">
            @auth
                <div class="my-profiles-sec">
                        <span><img src="{{asset(Auth::user()->avatar)}}" alt=""
                                   class="mr-0" style="width: 40px;height: 40px">
                                <i data-toggle="dropdown" id="Preview" role="button" aria-haspopup="true"
                                   class="la la-bars"></i>
                            <div class="dropdown-menu" aria-labelledby="Preview">
                                @if(Auth::user()->role === 'Tutor')
                                    <a class="dropdown-item" href="{{url('/tutor')}}">Profile</a>
                                    <a class="dropdown-item" href="{{url('/tutor/logout')}}">Logout</a>
                                @endif
                                @if(Auth::user()->role === 'Student')
                                    <a class="dropdown-item" href="{{url('/student')}}">Profile</a>
                                    <a class="dropdown-item" href="{{url('/student/logout')}}">Logout</a>
                                @endif
                                @if(Auth::user()->role === 'Parent')
                                    <a class="dropdown-item" href="{{url('/parent')}}">Profile</a>
                                    <a class="dropdown-item" href="{{url('/parent/logout')}}">Logout</a>
                                @endif
                             </div>
                        </span>
                </div>
            @else
                <div class="btn-extars">
                    <ul class="account-btns">
                        <li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
                        <li class="signin-popup"><a title=""><i class="la la-external-link-square"></i> Login</a></li>
                    </ul>
                </div><!-- Btn Extras -->
            @endauth
            <div class="responsivemenu">
                <ul>
                    <li class="" id="nav-main-home">
                        <a href="{{url('/')}}" title="">Home</a>
                    </li>
                    <li class="" id="nav-main-tutors">
                        <a href="{{url('tutors/all')}}" title="">Tutors</a>
                    </li>
                    <li class="" id="nav-main-subject">
                        <a href="{{url('all-subjects')}}" title="">Subjects</a>
                    </li>
                    <li class="" id="nav-main-about">
                        <a href="{{url('about-us')}}" title="">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{--desktop devices--}}
    <header class="stick-top forsticky">
        <div class="menu-sec">
            <div class="container">
                <div class="logo">
                    <a href="{{url('/')}}" title="">
                        <img class="hidesticky"
                             src="{{asset('images/logo-white.png')}}"
                             alt=""/><img
                                class="showsticky"
                                src="{{asset('images/logo-dark.png')}}" alt=""/></a>
                </div><!-- Logo -->
                @auth
                    <div class="my-profiles-sec">
                        <span><img src="{{asset(Auth::user()->avatar)}}" alt=""
                                   class="mr-0" style="width: 40px;height: 40px">
                                <i data-toggle="dropdown" id="Preview" role="button" aria-haspopup="true"
                                   class="la la-bars"></i>
                            <div class="dropdown-menu" aria-labelledby="Preview">
                                @if(Auth::user()->role === 'Tutor')
                                    <a class="dropdown-item" href="{{url('/tutor')}}">Profile</a>
                                    <a class="dropdown-item" href="{{url('/tutor/logout')}}">Logout</a>
                                @endif
                                @if(Auth::user()->role === 'Student')
                                    <a class="dropdown-item" href="{{url('/student')}}">Profile</a>
                                    <a class="dropdown-item" href="{{url('/student/logout')}}">Logout</a>
                                @endif
                                @if(Auth::user()->role === 'Parent')
                                    <a class="dropdown-item" href="{{url('/parent')}}">Profile</a>
                                    <a class="dropdown-item" href="{{url('/parent/logout')}}">Logout</a>
                                @endif
                             </div>
                        </span>
                    </div>
                @else
                    <div class="btn-extars">
                        <ul class="account-btns">
                            <li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
                            <li class="signin-popup"><a title=""><i class="la la-external-link-square"></i>
                                    Login</a></li>
                        </ul>
                    </div><!-- Btn Extras -->
                @endauth
                <nav>
                    <ul>
                        <li class=" nav-link1" id="nav-main-home">
                            <a href="{{url('/')}}" title="">Home</a>
                        </li>
                        <li class="nav-link1" id="nav-main-tutors">
                            <a href="{{url('tutors/all')}}" title="">Tutors</a>
                        </li>
                        <li class="nav-link1" id="nav-main-subject">
                            <a href="{{url('all-subjects')}}" title="">Subjects</a>
                        </li>
                        <li class="nav-link1" id="nav-main-about">
                            <a href="{{url('about-us')}}" title="">About Us</a>
                        </li>
                    </ul>
                </nav><!-- Menus -->
            </div>
        </div>
    </header>

    @yield('content')
    {{--footer section--}}
    <footer>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 column">
                        <div class="widget">
                            <div class="about_widget">
                                <div class="logo">
                                    <a href="" title=""><img
                                                src="{{asset('images/logo-white.png')}}"
                                                alt=""/></a>
                                </div>
                                <span>Collin Street West, Victor 8007, Pakistan.</span>
                                <span>+92 000-000-0000</span>
                                <span>info@onlinetutor.com</span>
                                <div class="social">
                                    <a href="#" title=""><i class="fa fa-facebook"></i></a>
                                    <a href="#" title=""><i class="fa fa-twitter"></i></a>
                                    <a href="#" title=""><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div><!-- About Widget -->
                        </div>
                    </div>
                    <div class="col-lg-4 column">
                        <div class="widget">
                            <h3 class="footer-title">Search by Subjects</h3>
                            <div class="link_widgets">
                                <div class="row">
                                    <div class="col-lg-6">
                                        @forelse($courses as $course)
                                            <a href="{{url('filter/tutors?course_id='.$course->id)}}"
                                               title="">{{$course->name}} </a>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 column">
                        <div class="widget">
                            <h3 class="footer-title">Search by City</h3>
                            <div class="link_widgets">
                                <div class="row">
                                    <div class="col-lg-12">

                                        @forelse($cities as $city)
                                            <a href="{{url('filter/tutors?city_ids[]='.$city->id)}}"
                                               title="">{{$city->name}} </a>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bottom-line">
            <span>© 2018 tutor All rights reserved. Design by XYZ</span>
            <a href="#scrollup" class="scrollup" title=""><i class="la la-arrow-up"></i></a>
        </div>
    </footer>

</div>

<div class="account-popup-area signin-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>
        <h3>User Login</h3>
        <div class="select-user">
            <span style="width: 6rem" class="active user1">Student</span>
            <span class="user1">Parent</span>
            <span class="tutor">Tutor</span>
        </div>
        <p class="text-danger mt-5 m-0 pl-3 hide error-show  error-login-suspended"></p>
        <form method="post" action="{{url('user-login')}}" id="user-login-form">
            {{csrf_field()}}
            <div class="cfield">
                <input type="email" name="email" required placeholder="Enter your email"/>
                <i class="la la-user"></i>
            </div>
            <p class="text-danger error-show m-0 pl-3 hide  error-login-email"></p>
            <div class="cfield">
                <input type="password" name="password" required placeholder="Enter your password"/>
                <i class="la la-key"></i>
            </div>
            <p class="text-danger error-show m-0 pl-3 hide error-login-password"></p>
            <a href="{{url('password/reset')}}" title="">Forgot Password?</a>
            <button type="submit">Login</button>
        </form>
        <div class="extra-login social-login">
            <span>Or</span>
            <div class="login-social">
                <a class="fb-login" onclick="socialLogin('{{url('login/google')}}')" href="#" title=""><i
                            class="fa fa-google"></i></a>
                <a class="tw-login" onclick="socialLogin('{{url('login/twitter')}}')" href="#" title=""><i
                            class="fa fa-twitter"></i></a>
            </div>
        </div>
    </div>
</div><!-- LOGIN POPUP -->

<div class="account-popup-area signup-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>
        <h3>Sign Up</h3>
        <div class="select-user">
            <span style="width: 6rem" class="active user1">Student</span>
            <span class="user1">Parent</span>
            <span class="tutor">Tutor</span>

        </div>
        <form id="signup-form" action="{{url('user-registration')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" value="Student" id="select-user" name="role">
            <div class="cfield mb-0">
                <input type="text" placeholder="Username" required name="name">
                <i class="la la-user"></i>
            </div>
            <p class="text-danger error-show m-0 pl-3 hide error-name"></p>
            <div class="cfield">
                <input type="email" placeholder="Email" required name="email">
                <i class="la la-envelope-o"></i>
            </div>
            <p class="text-danger error-show m-0 pl-3 hide error-email"></p>
            <div class="cfield">
                <input type="password" placeholder="Password" required name="password">
                <i class="la la-key"></i>
            </div>
            <p class="text-danger error-show m-0 pl-3 hide error-password"></p>
            <div class="cfield">
                <input type="password" placeholder="Confirm Password" required name="password_confirmation">
                <i class="la la-key"></i>
            </div>

            <div class="dropdown-field mt-3 mb-0">
                <select data-placeholder="Please Select City" class="chosen" required name="city_id">
                    <option selected disabled>Please Select City</option>
                    @forelse($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <p class="text-danger error-show m-0 pl-3 hide error-city_id"></p>
            <div class="dropdown-field subject-choose hide mt-3 mb-0">
                <select data-placeholder="Please Select Subject" class="chosen" name="course_id">
                    <option>Please Select Subject</option>
                    @forelse($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}</option>
                    @empty
                    @endforelse
                </select>
            </div>

            <button type="submit">Signup</button>
        </form>
        <div class="extra-login social-login">
            <span>Or</span>
            <div class="login-social">
                <a class="fb-login" onclick="socialLogin('{{url('register/google')}}')" href="#" title=""><i
                            class="fa fa-google"></i></a>
                <a class="tw-login" onclick="socialLogin('{{url('register/twitter')}}')" href="#" title=""><i
                            class="fa fa-twitter"></i></a>
            </div>
        </div>
        <form action="" method="get" id="social-login">
            {{csrf_field()}}
            <input type="hidden" value="Student" id="select-user1" name="role">
        </form>
    </div>
</div><!-- SIGNUP POPUP -->

<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/modernizr.js')}}" type="text/javascript"></script>
<script src="{{asset('js/script.js')}}" type="text/javascript"></script>
<script src="{{asset('js/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/wow.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/slick.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/parallax.js')}}" type="text/javascript"></script>
<script src="{{asset('js/select-chosen.js')}}" type="text/javascript"></script>
<script src="{{asset('js/circle-progress.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script>
    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4500
    });
    $('.user1').click(function () {
        let text = $(this).text();
        $('#select-user').val(text);
        $('#select-user1').val(text);
        $('.subject-choose').addClass('hide')
        $('.social-login').removeClass('hide')
    });

    $('.tutor').click(function () {
        let text = $(this).text();
        $('#select-user').val(text);
        $('.subject-choose').removeClass('hide')
        $('.social-login').addClass('hide')
    })


    // registration form ajax
    let signupform = $('#signup-form');

    signupform.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: signupform.attr('action'),
            type: signupform.attr('method'),
            data: signupform.serialize(),
            dataType: 'json',
            success: function (response) {
                // Success
                window.location.href = response.redirectURL;
            },
            error: function (json) {
                if (json.status === 422) {
                    $.each(json.responseJSON.errors, function (key, value) {

                        $('.error-' + key).text(value);
                        $('.error-' + key).removeClass("hide");
                        $("[name= " + key + "]").on('input', function () {
                            $('.error-' + key).addClass("hide");
                        });

                    });
                } else {
                    // server error
                }
            }
        });
    });
    // user login from ajax
    let loginForm = $('#user-login-form');
    loginForm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: loginForm.attr('action'),
            type: loginForm.attr('method'),
            data: loginForm.serialize(),
            dataType: 'json',
            success: function (response) {
                // Success
                window.location.href = response.redirectURL;
            },
            error: function (json) {
                if (json.status === 404) {
                    json = json.responseJSON;
                    $('.error-login-' + json.key).text(json.message);
                    $('.error-login-' + json.key).removeClass("hide");
                    $("[name= " + json.key + "]").on('input', function () {
                        $('.error-login-' + json.key).addClass("hide");
                    });
                } else {
                    // server error
                }
            }
        });
    });

    function successMessage(message) {
        Swal({
            type: 'success',
            text: message,
        }).then(function () {
            location.reload()
        })
    }

    function socialLogin(url) {
        $('#social-login').attr('action', url).submit();
    }


    @if(Session::has('success'))
    toast({
        type: 'success',
        title: '{{Session::get('success')}}'
    })
    @endif

    @if(Session::has('user-not-exists'))
    Swal({
        type: 'error',
        title: 'Sorry!',
        text: 'You are not registered.',
    }).then(function () {
        location.reload()
    })

    @endif

    function confirmMessage(url, text = "") {
        Swal({
            title: 'Are you sure?',
            text: text,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        })
    }

    function sendNewMessage(id) {
        Swal({
            title: 'Enter Message',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Send',
            showLoaderOnConfirm: true,
            preConfirm: (message) => {
                return fetch('{{url('new/conversation/')}}' + '/' + message + '/' + id)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Issue while delivering message')
                        }
                        return response.json()
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                Swal({
                    title: 'Your Message has been delivered',
                })
            }
        })
    }

    function videoCall(id) {
        toast({
            type: 'success',
            title: 'Calling...'
        })
        $.ajax({
            url: '{{url('video-call-initiate/')}}' + '/' + id,
            type: 'Get',
            success: function (responce) {
                if (responce.status) {
                    let url = '{{url('video-local-page/')}}' + '/' + id
                    window.open(url, "popupWindow")
                } else {
                    Swal({
                        position: 'top-end',
                        type: 'info',
                        title: 'Your is offline right now',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            error: function (responce) {
            }
        });
    }
</script>
@yield('scripts')

<script>
            @auth
    let pusher = new Pusher('2536485dc36d05e71007', {
            cluster: 'ap2'
        });
    if (messageSubscribe) {
        let channel = pusher.subscribe('message-{{Auth::id()}}');
        channel.bind('NewMessage', function (data) {
            toast({
                type: 'success',
                title: data.message.message
            })
        });
    }
    // video call bind channel
    let videoChannel = pusher.subscribe('video-call-{{Auth::id()}}');
    videoChannel.bind('VideoCall', function (data) {
        Swal({
            imageUrl: '{{url('/')}}' +'/'+ data.friend.avatar,
            imageWidth: 400,
            imageHeight: 200,
            position: 'top-end',
            title: 'Incoming video call',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Accept',
            cancelButtonText: 'Reject'
        }).then((result) => {
            if (result.value) {
                let url = '{{url('video-remote-page/')}}' + '/' + data.friend.friend_id;
                window.open(url, "popupWindow")
            }
            if (result.dismiss === 'cancel') {
                // alert('rejected')
            }
        })
    });
    @endauth
</script>
</body>

</html>

