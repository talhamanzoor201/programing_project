@extends('layouts.admin-layout')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 m-auto col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <div><h4 class="card-title">Courses</h4> <a
                                        class="float-right btn btn-sm btn-secondary btn-round"
                                        data-toggle="modal" href="#courseModal"
                                        style="cursor: pointer">Add New</a></div>

                            <p class="card-category"> Courses details</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="table table-hover ">
                                <thead class="text-danger">
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th class="">Action</th>
                                </tr>
                                </thead>
                                @php $t = 0 @endphp
                                <tbody>
                                @forelse($courses as $course)
                                    <tr>
                                        <td>{{++$t}}</td>
                                        <td><i class="la la-{{$course->icon}} la-2x"></i></td>
                                        <td>{{$course->name}}</td>
                                        <td class="td-actions ">
                                            <button rel="tooltip" class="btn btn-success btn-link"
                                                    onclick="editCourse('{{$course->name}}','{{$course->icon}}',
                                                            '{{url('admin/add/courses/'.$course->id)}}')"
                                                    title="Edit Course">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" rel="tooltip" class="btn btn-danger btn-link"
                                                    onclick="confirmAction('{{url('admin/delete/course/'.$course->id)}}','Are you sure? ')"
                                                    title="Delete Course">
                                                <i class="material-icons">close</i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr span="3"> No Course found.</tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.admin-delete')
    </div>
    <!-- Modal -->
    <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Courses Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="courseForm" action="{{url('admin/add/courses')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group bmd-form-group">
                            <label for="courseName" class="bmd-label-floating">Course Name</label>
                            <input type="text" name="name" class="form-control" id="courseName">
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="courseIcon" class="bmd-label-floating">Course Icon</label>
                            <input type="text" name="icon" class="form-control" id="courseIcon">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Save Course</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function editCourse(name, icon, url) {
            $('#courseName').val(name);
            $('#courseIcon').val(icon);
            $('#courseForm').attr('action', url);
            $('.form-group').addClass('is-filled')

            $('#courseModal').modal('show');
        }

        $("#courseModal").on("hidden.bs.modal", function () {
            $('#courseForm').trigger('reset')
            $('.form-group').removeClass('is-filled')
            $('#courseForm').attr('action', '{{url('/admin/add/courses')}}');
        });

        $(function () {
            $('#admin-nav-courses').addClass('active');
        })

    </script>
@endSection