@extends('layouts.master-layout')
@section('title')
    Profile | {{$auth->name}}
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
                        <div class="padding-left profile-form-edit">
                            <form action="{{url('student\profile-info-update')}}" method="post"
                                  id="profile-info-form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="profile-title">
                                    <h3>My Profile</h3>
                                    <div class="upload-img-bar">
                                    <span class="round">
                                        <img src="{{asset($auth->avatar)}}" alt="" id="blah"
                                             style="min-height: 170px!important;min-width: 170px!important; "></span>
                                        <div class="upload-info">
                                            <div class="resimyuklefile">
											 <span class="file-input">
											  Upload
											  <input type="file" accept="image/*" onchange="readURL(this)"
                                                     name="avatar"></span>
                                            </div>
                                            <span>Max file size is 1MB, Minimum dimension: 270x210 And Suitable files are .jpg &amp; .png</span>
                                            <p class="text-danger error-show m-0 pl-3 hide error-avatar"></p>
                                        </div>

                                    </div>
                                </div>
                                <div class="profile-form-edit">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span class="pf-title">Full Name</span>
                                            <div class="pf-field">
                                                <input type="text" class="mb-0" placeholder="Your Name" name="name"
                                                       required
                                                       value="{{$auth->name}}">
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-name"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Email</span>
                                            <div class="pf-field">
                                                <input type="text" placeholder="demo@tutoronline.com"
                                                       value="{{$auth->email}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Gender</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select Gender" class="chosen"
                                                        style="display: none;" name="gender">
                                                    <option selected disabled value="">Please Select Gender</option>
                                                    <option @if($student->gender ==='Male') selected
                                                            @endif value="Male">Male
                                                    </option>
                                                    <option @if($student->gender ==='Female') selected
                                                            @endif value="Female">Female
                                                    </option>
                                                </select>
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-experience"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Age</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select Age" class="chosen"
                                                        style="display: none;" name="age">
                                                    <option selected disabled>Please Select Age</option>
                                                    <option @if($student->age ==='04-07 Years') selected
                                                            @endif>04-07 Years
                                                    </option>
                                                    <option @if($student->age ==='08-12 Years') selected
                                                            @endif >08-12 Years
                                                    </option>
                                                    <option @if($student->age ==='13-16 Years') selected
                                                            @endif>13-16 Years
                                                    </option>
                                                    <option @if($student->age ==='> 17 Years') selected
                                                            @endif>> 17 Years
                                                    </option>
                                                </select>
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-age"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Languages</span>
                                            <div class="pf-field">
                                                <div class="pf-field">
                                                    <select data-placeholder="Please Select Language" class="chosen"
                                                            style="display: none;" name="language">
                                                        <option selected disabled>Please Select Language</option>
                                                        <option @if($student->language ==='English') selected @endif>
                                                            English
                                                        </option>
                                                        <option @if($student->language ==='Urdu') selected @endif>
                                                            Urdu
                                                        </option>
                                                        <option @if($student->language ==='German') selected @endif>
                                                            German
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-Language"></p>
                                        </div>

                                        <div class="col-lg-6">
                                            <span class="pf-title">City</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select City" class="chosen" required
                                                        name="city_id">
                                                    <option disabled>Please Select City</option>
                                                    @forelse($cities as $city)
                                                        <option @if($auth->city_id === $city->id) selected
                                                                @endif value="{{$city->id}}">{{$city->name}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-city_id"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Allow In Search</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Allow In Search" class="chosen"
                                                        name="allow_in_search"
                                                        style="display: none;">
                                                    <option @if($student->allow_in_search) selected
                                                            @endif value="1">Yes
                                                    </option>
                                                    <option @if(!$student->allow_in_search) selected
                                                            @endif value="0">No
                                                    </option>
                                                </select>
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-allow_in_search"></p>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="contact-edit">
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
        let messageSubscribe = true;
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        let formInfoProfile = $('#profile-info-form');

        formInfoProfile.submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: formInfoProfile.attr('action'),
                type: formInfoProfile.attr('method'),
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    // Success
                    successMessage(response.message)
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
        $('#nav-profile').addClass('active')
    </script>
@endsection
