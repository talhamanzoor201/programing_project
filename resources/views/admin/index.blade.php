@extends('layouts.admin-layout')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">people</i>
                            </div>
                            <p class="card-category">Total Users</p>
                            <h3 class="card-title">
                                {{$total_users}}

                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons ">date_range</i>
                                This moonth user: <p class="ml-4">{{$month_users}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-file"></i>
                            </div>
                            <p class="card-category">Total Courses</p>
                            <h3 class="card-title">{{$total_courses}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Last 30 days
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class=" col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">info_outline</i>
                            </div>
                            <p class="card-category">Total Tutors</p>
                            <h3 class="card-title">{{$total_tutors}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">local_offer</i> From the start
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <p class="card-category">Total Visitor</p>
                            <h3 class="card-title">{{$total_visitors}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">User Complaints</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php  $count = 1; @endphp
                                    @forelse($complaints as $complaint)
                                        <tr>
                                            <td class="text-center">{{$count++}}</td>
                                            <td>{{$complaint->name}}</td>
                                            <td>{{$complaint->email}}</td>
                                            <td style="width: 35rem;">{{$complaint->message}}</td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-danger btn-round"
                                                   onclick="confirmAction('{{url('admin/support-delete/'.$complaint->id)}}','Are you sure?')"
                                                   data-original-title="" title="Delete Complaint?">
                                                    <i class="material-icons">close</i>
                                                </a>
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
                @include('includes.admin-delete')
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>

        $(function () {
            $('#index').addClass('active');
        })
    </script>
@endSection