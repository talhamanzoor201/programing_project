@extends('layouts.master-layout')
@section('title')
    Subjects
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
                            <div class="heading">
                                <h2 class="text-white">Popular Subjects</h2>
                                <span class="text-white">{{\App\User::where('role','Tutor')->where('status','active')->count()}}
                                    Tutors - {{$courses->count()}}
                                    Subjects.</span>
                            </div><!-- Heading -->
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
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('scripts')
    <script>

        $('#nav-main-subject').addClass('nav-active')
    </script>
@endsection
