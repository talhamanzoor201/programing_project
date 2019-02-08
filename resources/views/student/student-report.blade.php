@extends('layouts.master-layout')
@section('title')
    Reports | {{Auth::user()->name}}
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
    @include('includes.student-top')
    <section style="margin-bottom: 8rem">
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @include('includes.student-sidebar')
                    <div class="col-lg-9 column">
                        <div class="padding-left content-box">
                            <div class="manage-jobs-sec">
                                <h3><span style="color: crimson">Students Reports</span> <br></h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Tutor Name</td>
                                        <td>Course</td>
                                        <td>date</td>
                                        <td>Quiz</td>
                                        <td>Assignment</td>
                                        <td>Comment</td>
                                    </tr>
                                    </thead>
                                    <tbody style="font-weight: bold!important;">
                                    @forelse($reports as $report)
                                        <tr>
                                            <td>
                                                <span>{{$report->tutor->profile->name}}</span>
                                            </td>
                                            <td>
                                                <span>{{$report->course->name}}</span>
                                            </td>
                                            <td>
                                                <span>{{$report->month}}</span>
                                            </td>
                                            <td>
                                                <span>{{$report->quiz_marks}}</span>
                                            </td>
                                            <td>
                                                <span>{{$report->assignment_marks}}</span>
                                            </td>
                                            <td>
                                                <span>{{str_limit($report->comment,100)}}</span>
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
        $('#student-nav-report').addClass('active')
        let messageSubscribe = true;
    </script>
@endsection
