@extends('layouts.admin-layout')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <h3 class="mb-3">
                    </h3>
                    <!-- Tabs with icons on Card -->
                    <div class="card card-nav-tabs">
                        <div class="card-header card-header-danger">
                            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active show" href="#profile1" data-toggle="tab">
                                                <i class="material-icons">face</i> Profile Update

                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#settings" data-toggle="tab">
                                                <i class="material-icons">build</i> Password Change

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="tab-content text-center">
                                <div class="tab-pane active show" id="profile1">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 px-5">
                                            <form method="post" action="{{url('/admin/profile/update')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="admin-email">Admin email</label>
                                                    <input type="email" name="email" class="form-control"
                                                           id="admin-email" value="{{$admin->email}}"
                                                           placeholder="admin email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="admin-name">Admin name</label>
                                                    <input type="text" class="form-control" id="admin-name"
                                                           value="{{$admin->name}}"
                                                           name="name" required
                                                           placeholder="Admin name">
                                                </div>
                                                <br>
                                                <div class="col-md-6 m-auto">
                                                    <button type="submit" class="btn btn-danger btn-block">Update
                                                        Information
                                                    </button>
                                                </div>
                                            </form>
                                            @if(count($errors) > 0)
                                                <div class="alert alert-danger " role="alert" style="margin-top: 3rem">
                                                    @foreach ($errors->all() as $error)
                                                        <strong class="form-inline">
                                                            {{$error}}  </strong>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="settings">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 px-5">
                                            <form method="post" action="{{url('/admin/password/update')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="old_password">Old password</label>
                                                    <input type="password" name="old_password" class="form-control"
                                                           id="old_password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_password">Enter new Password</label>
                                                    <input type="password" name="password" required
                                                           class="form-control" id="new_password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm-password">ReEnter Password</label>
                                                    <input type="password" name="password_confirmation"
                                                           required class="form-control" id="confirm-password">
                                                </div>
                                                <br>
                                                <div class="col-md-6 m-auto">
                                                    <button type="submit" class="btn btn-danger btn-block">Update
                                                        Password
                                                    </button>
                                                </div>
                                            </form>
                                            @if(Session::has('errorp'))
                                                <div class="alert alert-danger " role="alert" style="margin-top: 3rem">
                                                    {{Session::get('errorp')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Tabs with icons on Card -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $(function () {
            $('#top-nav-user').click();
            $('#profile').addClass('active');
        })

    </script>
@endSection