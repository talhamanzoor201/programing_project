@extends('layouts.master-layout')
@section('title')
    Home | ONLINE TUTORING
@endsection

@section('style')
    <style>
        .btn-account {
            width: 13rem;
        }

        .reviews:before {
            content: unset !important;
        }

        .reviews p {
            min-height: 5.6rem !important;
        }

        .list-item {
            cursor: pointer;
            background: rgba(255, 255, 255, 0.89);
            margin: 4px;
            margin-top: 0;
            margin-bottom: 0;
        }

        .list-item:hover {
            background: white;
        }

        .slide-fade li {
            transition: all 0.4s ease-out;
            opacity: 0;
        }

        .bd-callout {
            border: 1px solid #eee;
            border-left-width: .25rem;
            border-radius: .25rem;
            border-left-color: #db2244;
        }
    </style>

@endsection

@section('content')
    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-featured-sec">
                            <ul class="main-slider-sec text-arrows">
                                <li class="slideHome"><img
                                            src="{{asset('images/mslider3.jpg')}}"
                                            alt=""/></li>
                                <li class="slideHome"><img
                                            src="{{asset('images/mslider2.jpg')}}"
                                            alt=""/></li>
                                <li class="slideHome"><img
                                            src="{{asset('images/mslider1.jpg')}}"
                                            alt=""/></li>
                            </ul>
                            <div class="job-search-sec">
                                <div class="job-search">
                                    <h3>The Easiest Way to Get Online Tutor</h3>
                                    <form action="{{url('filter/tutors')}}" method="post">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-5 col-sm-12 col-xs-12">
                                                <div class="job-field">
                                                    <input type="text" id="search_input" autocomplete="off"
                                                           placeholder="course title, keywords or class name"/>
                                                    <i class="la la-keyboard-o"></i>
                                                    {{csrf_field()}}
                                                    <input id="sub_course2" type="hidden" name="subCourse_id">
                                                </div>
                                                <div class="job-field">
                                                    <ul id="search-result-list" class="list-group "
                                                        style="border-radius: 100px !important;
                                                         position: absolute; width: 100%">
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                                                <div class="job-field">
                                                    <select data-placeholder="City, province or region"
                                                            class="chosen-city" name="city_ids[]">
                                                        @forelse($cities as $city)
                                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    <i class="la la-map-marker"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                                <button type="submit"><i class="la la-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    {{--<div class="or-browser">--}}
                                    {{--<span>Browse job offers by</span>--}}
                                    {{--<a href="#" title="">Category</a>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                            <div class="scroll-to">
                                <a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="scroll-here">
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Popular Courses</h2>
                            <span>{{\App\User::where('role','Tutor')->where('status','active')->count()}}
                                Tutors - {{$courses->count()}}
                                Subjects.</span>
                        </div><!-- Heading -->
                        <div class="cat-sec">
                            <div class="row no-gape">
                                @forelse($courses as $course)
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="p-category">
                                            <a href="{{url('filter/tutors?course_id='.$course->id)}}" title="">
                                                <i class="la la-{{$course->icon}}"></i>
                                                <span>{{$course->name}}</span>
                                                <p>({{$course->tutorCount($course->id)}} tutor)</p>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-lg-3 col-md-3 col-sm-6 text-center m-auto">
                                        <h3>No Subject Found.</h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    @if(!empty($courses[0]))
                        <div class="col-lg-12">
                            <div class="browse-all-cat">
                                <a href="{{url('all-subjects')}}" title="">Browse All Subjects</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{--register tutor--}}
    <section>
        <div class="block double-gap-top double-gap-bottom">
            <div data-velocity="-.1"
                 style="background: url('{{asset('images/parallax1.jpg')}}') repeat scroll 50% 422.28px transparent;"
                 class="parallax scrolly-invisible layer color"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="simple-text-block">
                            <h3>So convenient and easy to use.</h3>
                            <span>Create your account now!</span>
                            <a href="#" class="btn-account signup-popup" title="">Register as Student</a>
                            <a href="#" class="btn-account signup-popup" title="">Register as Parent</a>
                            <a href="#" class="btn-account signup-popup" title="">Register as Tutor</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--verified tutors--}}
    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Verified Tutor</h2>
                            <span>here goes somehings.</span>
                        </div><!-- Heading -->
                        <div class="job-listings-sec">
                            @forelse($tutors as $tutor)
                                <div class="job-listing">
                                    <div class="job-title-sec">
                                        <div class="c-logo"><img
                                                    @if(!empty($tutor->profile)) src="{{asset($tutor->profile->avatar)}}"
                                                    @endif
                                                    alt="" style="width: 3rem"/></div>
                                        <h3><a href="#"
                                               title="">  @if(!empty($tutor->profile)){{$tutor->profile->name}} @endif</a>
                                        </h3>
                                        <span>@if(!empty($tutor->course)){{$tutor->course->name}} @endif</span>
                                    </div>
                                    <span class="job-lctn"><i class="la la-map-marker"></i>@if(!empty($tutor->profile))
                                            {{$tutor->profile->city->name}} , Pakistan @endif</span>
                                    {{--<span class="fav-job"><i class="la la-heart-o"></i></span>--}}
                                    <a href="{{url('/tutor/profile/'.$tutor->id)}}"> <span class="job-is ft">View Profile</span>
                                    </a>
                                </div>
                            @empty
                                <div class="col-lg-3 col-md-3 col-sm-6 text-center m-auto">
                                    <h3>No Tutor Found.</h3>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @if(!empty($tutors[0]))
                        <div class="col-lg-12">
                            <div class="browse-all-cat">
                                <a href="{{url('tutors/all')}}" title="">Load more Tutor</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{--video view--}}
    <section>
        <div class="block">
            <div data-velocity="-.1"
                 style="background: url('{{asset('images/parallax3.jpg')}}') 50% -86.14px repeat scroll transparent;"
                 class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Quick Career Tips</h2>
                            <span>Found by employers communicate directly with hiring managers and recruiters.</span>
                        </div><!-- Heading -->
                        <div class="blog-sec">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="my-blog">
                                        <div class="blog-thumb">
                                            <a href="#s" title=""><img src="{{asset('images/b1.jpg')}}" alt=""></a>
                                        </div>
                                        <div class="blog-details">
                                            <h3><a href="#ds" title="">Attract More Attention Sales And Profits</a></h3>
                                            <p>A job is a regular activity performed in exchange becoming an employee,
                                                volunteering, </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="my-blog">
                                        <div class="blog-thumb">
                                            <a href="#sd" title=""><img src="{{asset('images/b2.jpg')}}" alt=""></a>
                                        </div>
                                        <div class="blog-details">
                                            <h3><a href="#a" title="">11 Tips to Help You Get New Clients</a></h3>
                                            <p>A job is a regular activity performed in exchange becoming an employee,
                                                volunteering, </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="my-blog">
                                        <div class="blog-thumb">
                                            <a href="#sf" title=""><img src="{{asset('images/b3.jpg')}}" alt=""></a>
                                        </div>
                                        <div class="blog-details">
                                            <h3><a href="#as" title="">An Overworked Newspaper Editor</a></h3>
                                            <p>A job is a regular activity performed in exchange becoming an employee,
                                                volunteering, </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--feedback--}}
    <section>
        <div class="block">
            <div data-velocity="-.1"
                 style="background: url('{{asset('images/parallax2.jpg')}}') repeat scroll 50% 422.28px transparent;"
                 class="parallax scrolly-invisible layer color light"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading light">
                            <h2>Kind Words From Happy Candidates</h2>
                            <span>What other people thought about the service provided by Online Tutor</span>
                        </div><!-- Heading -->
                        <div class="reviews-sec" id="reviews-carousel">
                            @foreach($feedbacks as $feedback)
                                <div class="col-lg-6">
                                    <div class="reviews">
                                        <img src="{{asset($feedback->user->avatar)}}" alt=""/>
                                        <h3>{{$feedback->user->name}} </h3>
                                        <p>{{str_limit($feedback->message,220)}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--contact view--}}
    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="simple-text">
                            <h3>Gat a question?</h3>
                            <span>We're here to help. Check out our FAQs, send us an email or call us at 1 (800) 000-000000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection



@section('scripts')
    <script>
        var timeoutID = null;
        let itemList = $('#search-result-list');
        let messageSubscribe = true;

        function findCourse(text) {
            itemList.empty();
            if (text.trim() !== '') {
                $.ajax({
                    url: '{{url('search-course')}}' + '/' + text,
                    type: 'get',
                    success: function (response) {
                        console.log(response)
                        let html = '';
                        if (response.empty) {
                            html = '<li class="list-group-item list-item bd-callout">No data found.' +
                                '   </li>';
                            itemList.html(html)
                        } else {
                            $.each(response.data, function (i, v) {
                                html += '<li class="list-group-item list-item" onclick="putInput(this,' + v.id + ')">' + v.name +
                                    ' </li>';
                            })
                            itemList.html(html)
                        }
                    }
                });
            }
        }

        $('#search_input').keyup(function (e) {
            clearTimeout(timeoutID);
            timeoutID = setTimeout(() => findCourse(e.target.value), 500);
        });

        function putInput(context, id) {
            $('#sub_course2').val(id)
            text = $(context).text();
            $('#search_input').val(text)
            itemList.empty();
        }

        $('#nav-main-home').addClass('nav-active')
    </script>
@endsection
