@extends('layouts.master-layout')
@section('title')
    Tutor | {{Auth::user()->name}}
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
    @include('includes.parent-top')
    <section style="margin-bottom: 8rem">
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @include('includes.parent-sidebar')
                    <div class="col-lg-9 column">
                        <div class="padding-left content-box">
                            <div class="manage-jobs-sec">
                                <h3><span style="color: crimson"> Tutor Details</span> <br></h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>phone #</td>
                                        <td>City</td>
                                        <td>Request Status</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody style="font-weight: bold!important;">
                                    @forelse($requests as $request)
                                        <tr>
                                            <td>
                                                <span>{{$request->tutor->profile->name}}</span>
                                            </td>
                                            <td>
                                                <span>{{$request->tutor->phone_number}}</span>
                                            </td>
                                            <td>
                                                <span>{{$request->tutor->profile->city->name}}</span>
                                            </td>   <td>
                                                <span class="status">{{ucfirst($request->status)}}</span>
                                            </td>
                                            <td>
                                                <ul class="action_job">
                                                    <li><span>Delete Request</span>
                                                        <a href="#" title=""
                                                           onclick="confirmMessage('{{url('parent/request/delete/'.$request->id)}}')"><i
                                                                    class="la la-close la-2x"
                                                                    style="color: #fb236a"></i></a></li>
                                                    <li><span>Start Conversation</span>
                                                        <a href="#" title="Start Conversation"
                                                           onclick="sendNewMessage('{{$request->tutor->profile->id}}')"><i
                                                                    class="la la-comments la-2x"
                                                                    style="color: #25a32a"></i></a></li>
                                                    <li><span>Start Conversation</span>
                                                        <a href="#" title="Start Video Call"
                                                           onclick="videoCall('{{$request->tutor->profile->id}}')"><i
                                                                    class="la la-phone la-2x"
                                                                    style="color: #25a32a"></i></a></li>
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
                <form method="post" action="{{url('tutor/parent-report-store')}}" id="report-form">
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
        let messageSubscribe = true;
        $('#parent-nav-tutor').addClass('active')

    </script>
@endsection
