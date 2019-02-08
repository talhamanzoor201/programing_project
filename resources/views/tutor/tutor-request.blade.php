@extends('layouts.master-layout')
@section('title')
    Request | {{Auth::user()->name}}
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
                                <h3><span style="color: crimson">User Requests</span> <br></h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Time Interval</td>
                                        <td>Days</td>
                                        <td>Courses</td>
                                        <td>Amount/h</td>
                                        <td>Location</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody style="font-weight: bold!important;">
                                    @forelse($requests as $request)
                                        <tr>
                                            <td>
                                                <span>{{$request->user->name}}</span>
                                            </td>
                                            <td>
                                                <span>{{$request->user->email}}</span>
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
                                                <span>{{number_format($request->amount_per_hour,2)}}</span>
                                            </td>
                                            <td>
                                                <span>{{str_limit($request->area_name,35)}}</span>
                                            </td>
                                            <td>
                                                <ul class="action_job">
                                                    <li><span>Accept</span>
                                                        <a href="#" title=""
                                                           onclick="confirmMessage('{{url('tutor/request/approve/'.$request->id.'/accept')}}')"><i
                                                                    class="la la-check la-2x"
                                                                    style="color: #1c7430"></i></a></li>
                                                    <li><span>Reject</span>
                                                        <a href="#" title=""
                                                           onclick="confirmMessage('{{url('tutor/request/approve/'.$request->id.'/reject')}}')"><i
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
@endsection

@section('scripts')
    <script>
        $('#tutor-nav-request').addClass('active')
        let messageSubscribe = true;
    </script>
@endsection
