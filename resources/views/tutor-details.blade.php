@extends('layouts.master-layout')
@section('title')
    Tutor  Details
@endsection

@section('style')

@endsection

@section('content')
    <section class="overlape">
        <div class="block no-padding">
            <div data-velocity="-.1"
                 style="background: url('') 50% -42.2px repeat scroll transparent;"
                 class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="overlape">
        <div class="block remove-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cand-single-user">
                            <div class="share-bar circle">
                            </div>
                            <div class="can-detail-s">
                                <div class="cst"><img
                                            @if(!empty($tutor->profile)) src="{{asset($tutor->profile->avatar)}}"
                                            @endif alt=""
                                            style="height: 8rem"></div>
                                <h3> @if(!empty($tutor->profile)) {{$tutor->profile->name}}   @endif</h3>
                                <span><i>Main Subject - </i>@if(!empty($tutor->course)){{$tutor->course->name}}@endif</span>
                                <p>@if(!empty($tutor->profile))  {{$tutor->profile->email}}  @endif</p>
                                <p>Member Since, {{\Carbon\Carbon::parse($tutor->created_at)->year}}</p>
                                <p><i class="la la-map-marker"></i>Pakistan
                                    / @if(!empty($tutor->profile))@if(!empty($tutor->profile->city)) {{$tutor->profile->city->name}}   @endif   @endif
                                </p>
                            </div>

                            @auth

                                <div class="download-cv">
                                    @if(Auth::user()->role !== 'Tutor')
                                        <a href="{{url('hire/'.$tutor->id)}}" title="">HIRE REQUEST</a>
                                    @endif
                                </div>

                            @else
                                <div class="download-cv">
                                    <a href="#" class="signin-popup" title="">HIRE REQUEST</a>
                                </div>
                            @endauth

                        </div>
                        <ul class="cand-extralink">
                            <li><a href="#about" title="">About</a></li>
                            <li><a href="#about" title="">Education</a></li>
                            <li><a href="#education" title="">Sub Courses</a></li>
                        </ul>
                        <div class="cand-details-sec">
                            <div class="row">
                                <div class="col-lg-8 column">
                                    <div class="cand-details" id="about">
                                        <h2>Candidates About</h2>
                                        <p>{{$tutor->description}}</p>
                                        <div class="edu-history-sec" id="education">
                                            <h2>Education</h2>
                                            <div class="edu-history">
                                                <i class="la la-graduation-cap"></i>
                                                <div class="edu-hisinfo">
                                                    <h3>University</h3>
                                                    <span>{{$tutor->institute}}
                                                        -  <i>{{$tutor->degree_title}}</i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <section id="about">
                                            <div class="block">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="heading">
                                                                <h2>Sub Course Listing</h2>
                                                            </div><!-- Heading -->
                                                            <div class="job-listings-sec">
                                                                @forelse($tutor->subCourses as $subCourse)
                                                                    <div class="job-listing text-center">
                                                                        <span>{{$subCourse->name}}</span>
                                                                    </div>
                                                                @empty
                                                                    <div class="job-listing">
                                                                        <span class="text-center ml-5">No sub courses found.</span>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="col-lg-4 column">
                                    <div class="job-overview">
                                        <h3>Tutor Overview</h3>
                                        <ul>
                                            <li><i class="la la-money"></i>
                                                <h3>Expected Payment</h3><span>{{$tutor->min_pay}}k -{{$tutor->max_pay}}
                                                    k</span></li>
                                            <li><i class="la la-mars-double"></i>
                                                <h3>Age</h3><span>{{$tutor->age}}</span></li>
                                            <li><i class="la la-thumb-tack"></i>
                                                <h3>Career Level</h3><span>Professional</span></li>
                                            <li><i class="la la-puzzle-piece"></i>
                                                <h3>Industry</h3><span>Education</span></li>
                                            <li><i class="la la-shield"></i>
                                                <h3>Experience</h3><span>{{$tutor->experience}}</span></li>
                                            <li><i class="la la-line-chart "></i>
                                                <h3>Qualification</h3><span>{{$tutor->degree_title}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection
