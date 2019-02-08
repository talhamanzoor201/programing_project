@extends('layouts.admin-layout')
@section('css')
    <style>
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 440px !important;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 m-auto col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <div><h4 class="card-title"> Sub Courses</h4> <a
                                        class="float-right btn btn-sm btn-secondary btn-round"
                                        data-toggle="modal" href="#courseModal"
                                        style="cursor: pointer">Add New</a></div>

                            <p class="card-category"> Courses with Subcourses details</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="table table-hover ">
                                <thead class="text-danger">
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                    <th>SubCourse Name</th>
                                    <th class="">Action</th>
                                </tr>
                                </thead>
                                @php $t = 0 @endphp
                                <tbody>
                                @forelse($subCourses as $course)
                                    <tr>
                                        <td>{{++$t}}</td>
                                        <td>{{$course->course->name}}</td>
                                        <td>{{$course->name}}</td>
                                        <td class="td-actions ">
                                            <button rel="tooltip" class="btn btn-success btn-link"
                                                    onclick="editCourse('{{$course->name}}','{{$course->course->id}}',
                                                            '{{url('admin/add/sub-courses/'.$course->id)}}')"
                                                    title="Edit Course">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" rel="tooltip" class="btn btn-danger btn-link"
                                                    onclick="confirmAction('{{url('admin/delete/sub-course/'.$course->id)}}','Are you sure? ')"
                                                    title="Delete Course">
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
                <form id="courseForm" action="{{url('admin/add/sub-courses')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group bmd-form-group">
                            <select required name="course_id" class="selectpicker" data-style="btn btn-primary"
                                    title="Please select Course" id="courses">
                                @forelse($courses as $course)
                                    <option value="{{$course->id}}">{{$course->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="courseName" class="bmd-label-floating">Course Name</label>
                            <input type="text" name="name" class="form-control" id="courseName" required>
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
        function editCourse(name, value, url) {
            $('#courseName').val(name);
            $('#courseForm').attr('action', url);
            $('.form-group').addClass('is-filled')

            $('#courses').val(value).change();
            $('#courses').attr('disabled', true)
            $('#courseModal').modal('show');
        }

        $("#courseModal").on("hidden.bs.modal", function () {
            $('#courseForm').trigger('reset')
            $('.form-group').removeClass('is-filled')
            $('#courses').val('0').change();
            $('#courses').attr('disabled', false)
        });

        $(function () {
            $('#admin-nav-sub-courses').addClass('active');
        })

    </script>
@endSection