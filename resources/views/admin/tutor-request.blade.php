@extends('layouts.admin-layout')

@section('content')
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title ">Tutor Request</h4>
                            <p class="card-category">Accept/Denied</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable2">
                                    <thead class=" text-danger">
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 7rem!important;">Image</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Course</th>
                                        <th>Phone #</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    @php $t = 0 @endphp
                                    <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{++$t}}</td>
                                            <td>
                                                <div class="table-photo">
                                                    <img src="{{asset($user->avatar)}}" width="67"/>
                                                </div>
                                            </td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->tutor->age}}</td>
                                            <td>{{$user->tutor->course->name}}</td>
                                            <td>{{$user->tutor->phone_number}}</td>
                                            <td>{{$user->city->name}}</td>
                                            <td>{{$user->status}}</td>
                                            <td class="td-actions">
                                                <button rel="tooltip" class="btn btn-success btn-link"
                                                        onclick="confirmAction('{{url('admin/tutor/account/accept/'.$user->id)}}','Are you sure? ')"
                                                        title="Accept Request">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button type="button" rel="tooltip"
                                                        class="btn btn-danger btn-link"
                                                        onclick="confirmAction('{{url('admin/tutor/account/reject/'.$user->id)}}','Are you sure? ')"
                                                        data-original-title="" title="Reject Account">
                                                    <i class="material-icons">close</i>
                                                </button>
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
    </div>
    @include('includes.admin-delete')

@endsection

@section('js')
    <script>

        function confirm(url, context) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function (json) {
                            // Success
                            $(context).parent().parent()[0].remove();
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        },
                        error: function (json) {
                            console.log(json);
                        }
                    });
                }
            })
        }

        $(function () {
            $('#admin-nav-tutorRequest').addClass('active');
        })

    </script>
@endSection