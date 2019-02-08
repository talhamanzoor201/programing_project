@extends('layouts.master-layout')
@section('title')
    Profile | {{Auth::user()->name}}
@endsection

@section('style')
    <style>
        .tree_widget-sec > ul > li.active > a i {
            color: #8b91dd;
        }
    </style>
@endsection


@section('content')
    @include('includes.student-top')
    <section>
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @include('includes.student-sidebar')
                    <div class="col-lg-9 column">
                        <div class="padding-left">
                            <div class="manage-jobs-sec">
                                <h3>Change Password</h3>
                                <div class="change-password">
                                    <form id="password-form" action="{{url('student/password-update')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <span class="pf-title">Old Password</span>
                                                <div class="pf-field">
                                                    <input type="password" name="old_password" required>
                                                </div>
                                                <p class="text-danger error-show m-0 pl-3 hide error-old_password"></p>
                                                <span class="pf-title">New Password</span>
                                                <div class="pf-field">
                                                    <input type="password" name="password" required>
                                                </div>
                                                <p class="text-danger error-show m-0 pl-3 hide error-password"></p>
                                                <span class="pf-title">Confirm Password</span>
                                                <div class="pf-field">
                                                    <input type="password" name="password_confirmation" required>
                                                </div>
                                                <p class="text-danger error-show m-0 pl-3 hide error-password_confirmation"></p>
                                                <button type="submit">Update</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <i class="la la-key big-icon"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
        let formPassword = $('#password-form');

        formPassword.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: formPassword.attr('action'),
                type: formPassword.attr('method'),
                data: formPassword.serialize(),
                success: function (response) {
                    // Success
                    if (response.status) {
                        Swal({
                            type: 'success',
                            text: response.message,
                        }).then(function () {
                            formPassword.trigger('reset')
                        })
                    } else {
                        $('.error-old_password').text(response.message);
                        $('.error-old_password').removeClass("hide");
                        $("[name=old_password" + "]").on('input', function () {
                            $('.error-old_password').addClass("hide");
                        });
                    }
                },
                error: function (json) {
                    if (json.status === 422) {
                        $.each(json.responseJSON.errors, function (key, value) {

                            $('.error-' + key).text(value);
                            $('.error-' + key).removeClass("hide");
                            $("[name= " + key + "]").on('input', function () {
                                $('.error-' + key).addClass("hide");
                            });
                        });
                    } else {
                        // server error
                    }
                }
            });
        });
        let messageSubscribe = true;
        $('#nav-password').addClass('active')
    </script>
@endsection
