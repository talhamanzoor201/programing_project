@extends('layouts.admin-layout')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">User Feedbacks</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php  $count = 1; @endphp
                                    @forelse($feedbacks as $feedback)
                                        <tr>
                                            <td class="text-center">{{$count++}}</td>
                                            <td>
                                                <div class="table-photo">
                                                    <img src="{{asset($feedback->user->avatar)}}" width="67"/>
                                                </div>
                                            </td>
                                            <td>{{$feedback->user->name}}</td>
                                            <td style="width: 35rem;">{{$feedback->message}}</td>
                                            <td>{{\Carbon\Carbon::parse($feedback->created_at)->toFormattedDateString()}}</td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-danger btn-round"
                                                   onclick="confirmAction('{{url('admin/feedback-delete/'.$feedback->id)}}','Are you sure?')"
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
            $('#admin-nav-feedback').addClass('active');
        })
    </script>
@endSection