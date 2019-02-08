@extends('layouts.master-layout')
@section('title')
    Profile | {{Auth::user()->name}}
@endsection

@section('style')
    <style>
        .tree_widget-sec > ul > li.active > a i {
            color: #8b91dd;
        }
    </style>
@endsection


@section('content')
    @include('includes.tutor-top')
    <section style="margin-bottom: 8rem">
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @include('includes.tutor-sidebar')
                    <div class="col-lg-9 column">
                        <div class="padding-left quick-form-job">
                            <form action="{{url('tutor/add-subCourses/'.$course->id)}}" method="post">
                                {{csrf_field()}}
                                <div class="manage-jobs-sec">
                                    <h3><span style="color: crimson">{{$course->name}}</span> <br> Select Sub Courses
                                        that you are interested in.</h3>
                                    <div class="job-listings-sec my-5">
                                        @forelse($subCourses as $subCourse)
                                            <div class="job-listing simple-checkbox pl-5">
                                                <p><input type="checkbox" name="sub_ids[]" id="sub-{{$subCourse->id}}"
                                                          @if(in_array($subCourse->id,$userCourses)) checked
                                                          @endif value="{{$subCourse->id}}">
                                                    <label for="sub-{{$subCourse->id}}">
                                                        <span class="text-center ml-5">{{$subCourse->name}}</span>
                                                    </label></p>
                                            </div>
                                        @empty
                                            <div class="job-listing pl-5">
                                                <span class="text-center ml-5">No sub courses found.</span>
                                            </div>
                                        @endforelse
                                    </div>

                                    <div class="col-md-5 m-auto" style="margin-top: 3rem!important;">
                                        <button class="submit btn-block">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('#tutor-nav-skills').addClass('active')
        let messageSubscribe = true;
    </script>
@endsection
