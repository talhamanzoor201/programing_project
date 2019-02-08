@extends('layouts.master-layout')
@section('title')
    Home | Subjects
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
                                <h2 class="text-white">Professional Tutors</h2>
                            </div><!-- Heading -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="block remove-top">
            <div class="container">
                <div class="row no-gape">
                    <aside class="col-lg-3 column">
                        <form id="filter-form" action="{{url('filter/tutors')}}" method="POST">
                            {{csrf_field()}}
                            <div class="widget border">
                                <h3 class="sb-title open">All Subjects</h3>
                                <div class="posted_widget" style="display: block;">
                                    @forelse($courses as $course )
                                        <input type="radio" @if($course->id == $course_id) checked @endif
                                        name="course_id" value="{{$course->id}}" id="{{$course->id}}">
                                        <label for="{{$course->id}}">{{$course->name}}</label><br>
                                    @empty
                                    @endforelse
                                    <input type="radio" @if($course_id == '0' || $course_id === null) checked @endif
                                    value="0" name="course_id" id="course_all">
                                    <label class="nm" for="course_all">All</label><br>
                                </div>
                            </div>
                            <div class="widget border">
                                <h3 class="sb-title active">Experince</h3>
                                <div class="specialism_widget" style="display: block;">
                                    <div class="simple-checkbox">
                                        <p><input type="checkbox" name="experience[]" id="9"
                                                  @if(in_array('Fresh, No Experience' , $experience))checked @endif
                                                  value="Fresh, No Experience">
                                            <label for="9">Fresh, No Experience</label></p>
                                        <p><input type="checkbox" name="experience[]" id="10"
                                                  @if(in_array('0-02 Years' , $experience))checked @endif
                                                  value="0-02 Years">
                                            <label for="10">0 to 2Year</label></p>
                                        <p><input type="checkbox"
                                                  @if(in_array('02-05 Years' , $experience))checked @endif
                                                  name="experience[]" id="11" value="02-05 Years">
                                            <label for="11">2Years to 5Years</label></p>
                                    </div>
                                </div>
                            </div>
                            <div class="widget border">
                                <h3 class="sb-title active">City</h3>
                                <div class="specialism_widget" style="display: block;">
                                    <div class="simple-checkbox">
                                        @forelse($cities as $city)
                                            <p><input type="checkbox" name="city_ids[]"
                                                      @if(in_array($city->id , $city_ids))checked @endif
                                                      value="{{$city->id}}"
                                                      id="city-{{$city->id}}"><label
                                                        for="city-{{$city->id}}">{{$city->name}}</label></p>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </form>
                    </aside>
                    <div class="col-lg-9 column mt-3">
                        <div class="emply-list-sec">
                            @forelse($tutors as $tutor)
                                @if($tutor->profile)
                                    @if($tutor->profile->status === 'active')
                                        <div class="emply-list">
                                            <div class="emply-list-thumb">
                                                <a href="{{url('/tutor/profile/'.$tutor->id)}}"
                                                   title="">@if(!empty($tutor->profile))<img
                                                            src="{{asset($tutor->profile->avatar)}}" alt=""
                                                            style="height: 5rem"> @endif</a>
                                            </div>
                                            <div class="emply-list-info">
                                                <div class="emply-pstn"></div>
                                                <h3><a href="{{url('/tutor/profile/'.$tutor->id)}}"
                                                       title="">@if(!empty($tutor->profile)){{$tutor->profile->name}} @endif</a>
                                                </h3>
                                                <span>@if(!empty($tutor->course))
                                                        {{$tutor->course->name}}@endif </span>
                                                <h6><i class="la la-map-marker"></i>@if(!empty($tutor->profile))
                                                        Pakistan, {{$tutor->profile->city->name}} @endif</h6>
                                                <p>
                                                    {{str_limit($tutor->description,225)}}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @empty
                                <div class="text-center"> No Tutor Found.</div>
                            @endforelse
                            <div class="pagination">
                                {{$tutors->links()}}
                                {{--<ul>--}}
                                {{--<li class="prev"><a href="#"><i class="la la-long-arrow-left"></i> Prev</a></li>--}}
                                {{--<li><a href="#">1</a></li>--}}
                                {{--<li class="active"><a href="#">2</a></li>--}}
                                {{--<li><a href="#">3</a></li>--}}
                                {{--<li><span class="delimeter">...</span></li>--}}
                                {{--<li><a href="#">14</a></li>--}}
                                {{--<li class="next"><a href="#">Next <i class="la la-long-arrow-right"></i></a></li>--}}
                                {{--</ul>--}}
                            </div><!-- Pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        $('#filter-form input[type=radio] ,#filter-form input[type=checkbox]').change(function () {
            $('#filter-form').submit();
        });
        $('#nav-main-tutors').addClass('nav-active')
    </script>
@endsection
