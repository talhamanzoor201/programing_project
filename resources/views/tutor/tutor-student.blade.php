@extends('layouts.master-layout')
@section('title')
    Student | {{Auth::user()->name}}
@endsection

@section('style')
    <style>
        .tree_widget-sec > ul > li.active > a i {
            color: #8b91dd;
        }

        .content-box {
            float: left;
            width: 100%;
            margin-top: 1rem;
            border: 2px solid #e8ecec;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            -ms-border-radius: 8px;
            -o-border-radius: 8px;
            border-radius: 8px;
            padding: 30px;
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
                        <div class="padding-left content-box">
                            <div class="manage-jobs-sec">
                                <h3><span style="color: crimson"> Students Details</span> <br></h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Time Interval</td>
                                        <td>Days</td>
                                        <td>Courses</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody style="font-weight: bold!important;">
                                    @forelse($requests as $request)
                                        <tr>
                                            <td>
                                                <span>{{$request->user->name}} @if($request->user->role === 'Parent') (P) @elseif($request->user->role === 'Student') (S) @endif </span>
                                            </td>
                                            <td>
                                                <span class="applied-field">
                                                    {{\Carbon\Carbon::createFromTime($request->start_time,'0','0')->format('g:i A')}}
                                                    to
                                                    {{\Carbon\Carbon::createFromTime($request->end_time,'0','0')->format('g:i A')}}
                                                </span>
                                            </td>
                                            <td>
                                                <ul class="action_job">
                                                    <li><span>
                                                            @foreach($request->days as $day)
                                                                {{$day->day}}
                                                                <br>
                                                            @endforeach
                                                        </span>
                                                        <a href="#day" title=""><i class="la la-calendar la-2x"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="action_job">
                                                    <li><span>
                                                            @foreach($request->courses as $course)
                                                                {{$course->name}}
                                                                <br>
                                                            @endforeach
                                                        </span>
                                                        <a href="#course" title=""><i class="la la-book la-2x"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="action_job">
                                                    <li><span>Start Conversation</span>
                                                        <a href="#" title="Start Conversation"
                                                           onclick="sendNewMessage('{{$request->user->id}}')"><i
                                                                    class="la la-comments la-2x"
                                                                    style="color: #25a32a"></i></a></li>
                                                    <li><span>Start Conversation</span>
                                                        <a href="#" title="Start Video Call"
                                                           onclick="videoCall('{{$request->user->id}}')"><i
                                                                    class="la la-phone la-2x"
                                                                    style="color: #25a32a"></i></a></li>
                                                    <li><span>view detail</span>
                                                        <a href="#" title=""
                                                           onclick="details('{{$request->user->email}}','{{number_format($request->amount_per_hour,2)}}',
                                                                   '{{$request->area_name}}')"><i
                                                                    class="la la-eye la-2x"
                                                                    style="color: #1c7430"></i></a></li>
                                                    <li><span>Progress Report</span>
                                                        @php $students = null; if ($request->user->childrens) {$students =$request->user->childrens; }  @endphp
                                                        <a href="#" title=""
                                                           onclick="report('{{$request->courses}}' ,' {{$request->user_id}}','{{$students}}')"><i
                                                                    class="la la-calendar-plus-o la-2x"
                                                                    style="color: #1015fbcc"></i></a></li>
                                                    <li><span>Delete Record</span>
                                                        <a href="#" title=""
                                                           onclick="confirmMessage('{{url('tutor/request/delete/'.$request->id)}}')"><i
                                                                    class="la la-close la-2x"
                                                                    style="color: #fb236a"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- The Modal -->
    <div class="modal fade" id="modalDetail">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <strong class="pr-5">Email:</strong> <span id="email"></span>
                        </div>
                        <div class="col-md-12 my-2">
                            <strong class="pr-4">Amount:</strong> <span id="amount"></span>
                        </div>
                        <div class="col-md-12 my-2">
                            <strong class="pr-4">Address:</strong> <span id="address"></span>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>

    {{--// report modal--}}
    <div class="modal fade" id="modalReport">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Report</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{url('tutor/student-report-store')}}" id="report-form">
                    <!-- Modal body -->
                    <div class="modal-body">
                        {{csrf_field()}}
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="profile-form-edit">
                            <div class="row">
                                <div class="col-lg-12 mb-0">
                                    <span class="pf-title mt-0 mb-1">Select Course</span>
                                    <div class="form-group">
                                        <select class="form-control" id="course_select" data-placement="Select Course"
                                                required name="course_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-0" style="display: none" id="student_select_div">
                                    <span class="pf-title mt-0 mb-1">Select Student Name</span>
                                    <div class="form-group">
                                        <select class="form-control" id="student_select" data-placement="Select Student"
                                                 name="student_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-0">
                                    <span class="pf-title mt-0 mb-1">Quiz Marks</span>
                                    <div class="pf-field">
                                        <input type="text" class="mb-1" placeholder="80/100" name="quiz_marks" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title mt-3 mb-1">Assignment Marks</span>
                                    <div class="pf-field">
                                        <input type="text" class="mb-1" placeholder="85/100" name="assignment_marks"
                                               required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <span class="pf-title mt-3 mb-1">Description</span>
                                    <div class="pf-field">
                                        <textarea class="mb-0" rows="3" placeholder="Write description here..."
                                                  style="min-height: unset !important;" name="comment"
                                                  required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#tutor-nav-student').addClass('active')

        function details(email, amount, address) {
            $('#email').text(email)
            $('#amount').text(amount + '/hour')
            $('#address').text(address)
            $('#modalDetail').modal('show')
        }

        function report(courses, id, students) {
            students = jQuery.parseJSON(students)
            courses = jQuery.parseJSON(courses)
            $('#user_id').val(id)
            $('#course_select').empty()
            $('#course_select')
                .append($("<option></option>")
                    .attr("value", '')
                    .text('Please select Course'));
            $.each(courses, function (i, v) {
                $('#course_select')
                    .append($("<option></option>")
                        .attr("value", v.id)
                        .text(v.name));
            });
            if (students.length > 0) {
                $('#student_select_div').css('display', 'block');
                $('#student_select').empty()
                $('#student_select')
                    .append($("<option></option>")
                        .attr("value", '')
                        .text('Please select Student'));
                $.each(students, function (i, v) {
                    $('#student_select')
                        .append($("<option></option>")
                            .attr("value", v.id)
                            .text(v.name));
                })
            }
            $('#modalReport').modal('show')
        }

        $('#modalReport').on('hidden.bs.modal',function () {
            $('#student_select').empty()
            $('#student_select_div').css('display', 'none');
            $('#report-form').trigger('reset')
        })

        let form = $('#report-form');

        form.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    // Success
                    successMessage('Report saved successfully')
                },
                error: function (error) {
                }
            });
        });
        let messageSubscribe = true;
    </script>
@endsection
