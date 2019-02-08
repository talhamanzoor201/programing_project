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
    @include('includes.tutor-top')
    <section>
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @include('includes.tutor-sidebar')
                    <div class="col-lg-9 column">
                        <div class="padding-left profile-form-edit">
                            <form action="{{url('tutor\profile-info-update')}}" method="post"
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
                                            <span class="pf-title">Allow In Search</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Allow In Search" class="chosen"
                                                        name="allow_in_search"
                                                        style="display: none;">
                                                    <option @if($tutor->allow_in_search) selected
                                                            @endif value="1">Yes
                                                    </option>
                                                    <option @if(!$tutor->allow_in_search) selected
                                                            @endif value="0">No
                                                    </option>
                                                </select>
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-allow_in_search"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Experience</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select Experience" class="chosen"
                                                        style="display: none;" name="experience">
                                                    <option selected disabled value="">Please Select Experience</option>
                                                    <option @if($tutor->experience ==='Fresh, No Experience') selected
                                                            @endif value="Fresh, No Experience">Fresh, No Experience
                                                    </option>
                                                    <option @if($tutor->experience ==='0-02 Years') selected
                                                            @endif value="0-02 Years">0-02 Years
                                                    </option>
                                                    <option @if($tutor->experience ==='02-05 Years') selected
                                                            @endif value="02-05 Years">02-05 Years
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
                                                    <option @if($tutor->age ==='18-22 Years') selected
                                                            @endif value="18-22 Years">18-22 Years
                                                    </option>
                                                    <option @if($tutor->age ==='23-27 Years') selected
                                                            @endif value="23-27 Years">23-27 Years
                                                    </option>
                                                    <option @if($tutor->age ==='28-34 Years') selected
                                                            @endif value="28-34 Years">28-34 Years
                                                    </option>
                                                    <option @if($tutor->age ==='35-50 Years') selected
                                                            @endif value="35-50 Years">35-50 Years
                                                    </option>
                                                    <option @if($tutor->age ==='> 51 Years') selected
                                                            @endif value="> 51 Years">> 51 Years
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
                                                        <option @if($tutor->language ==='English') selected @endif>
                                                            English
                                                        </option>
                                                        <option @if($tutor->language ==='Urdu') selected @endif>
                                                            Urdu
                                                        </option>
                                                        <option @if($tutor->language ==='German') selected @endif>
                                                            German
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-Language"></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <span class="pf-title">Expected fees, min (Rs)</span>
                                            <div class="pf-field">
                                                <input type="number" placeholder="10k" name="min_pay"
                                                       value="{{$tutor->min_pay}}" min="1">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <span class="pf-title">Max (Rs)</span>
                                            <div class="pf-field">
                                                <input type="number" class="mb-0" placeholder="20K" name="max_pay"
                                                       value="{{$tutor->max_pay}}" min="{{1 + $tutor->min_pay}}">
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-max_pay"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Institute Name</span>
                                            <div class="pf-field">
                                                <input type="text" class="mb-0" placeholder="University/Collage"
                                                       name="institute"
                                                       value="{{$tutor->institute}}">
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-institute"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Degree Title</span>
                                            <div class="pf-field">
                                                <input type="text" class="mb-0" placeholder="e.g Computer Science"
                                                       name="degree_title" value="{{$tutor->degree_title}}">
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-degree_title"></p>
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="pf-title">Description</span>
                                            <div class="pf-field">
                                                <textarea class="mb-0" placeholder="Write little about yourself."
                                                          name="description">{{$tutor->description}}</textarea>
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-description"></p>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="contact-edit">
                                <h3>Contact</h3>
                                <form action="{{url('tutor\profile-contact-info-update')}}" method="post"
                                      id="profile-contact-form">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span class="pf-title">Phone Number</span>
                                            <div class="pf-field">
                                                <input type="text" name="phone_number" placeholder="+92 300 000000"
                                                       value="{{$tutor->phone_number}}">
                                            </div>
                                            <p class="text-danger error-show m-0 pl-3 hide error-phone_number"></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="pf-title">Email</span>
                                            <div class="pf-field">
                                                <input type="text" placeholder="demo@tutoronline.com"
                                                       value="{{$auth->email}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="pf-title">Website</span>
                                            <div class="pf-field">
                                                <input type="text" placeholder="www.portfolio.com" name="website">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="pf-title">Country</span>
                                            <div class="pf-field">
                                                <select data-placeholder="Please Select Specialism" class="chosen"
                                                        style="display: none;" name="country">
                                                    <option value="pakistan">Pakistan</option>
                                                </select>
                                            </div>
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
                                        <div class="col-lg-12">
                                            <button type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
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
        let progress = Number('{{$progress}}') / 100;
        $(function () {
            $('.second.circle').circleProgress({
                startAngle: -Math.PI / 8 * 0,
                value: progress,
                emptyFill: 'rgba(0, 0, 0, 0)',
                fill: {gradient: ['#fa3979', '#e22d68']}
            }).on('circle-animation-progress', function (event, progress) {
                $(this).find('strong').html(Math.round(100 * progress) + '<i>%</i>');
            });
        });

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
        let formContactProfile = $('#profile-contact-form');

        formContactProfile.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: formContactProfile.attr('action'),
                type: formContactProfile.attr('method'),
                data: formContactProfile.serialize(),
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
        let messageSubscribe = true;
        $('#tutor-nav-profile').addClass('active')
    </script>
@endsection
