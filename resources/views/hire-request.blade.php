<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hire Request form</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/form-elements.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>


<!-- Top content -->
<div class="top-content">
    <div class="container">

        <div class="row ">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box"
                 style="padding-top: 130px !important;">
                <form role="form" id="request-form" action="{{url('hire-request-store/'.$tutor->id)}}" method="post"
                      class="f1">
                    <h3><b>@if($tutor->profile) {{$tutor->profile->name}} @endif </b></h3>
                    <p>Fill in the form to hire this tutor.</p>
                    <div class="f1-steps">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"
                                 style="width: 16.66%;"></div>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            <p>time</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                            <p>details</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-twitter"></i></div>
                            <p>course</p>
                        </div>
                    </div>

                    <fieldset>
                        {{csrf_field()}}
                        <h4>Tell us what time you prefer tutoring:</h4>
                        <div class="form-group">
                            <label for="start_time">Select start time:</label>
                            <select class="form-control" name="start_time" id="start_time">
                                <option selected value="" disabled>Start Time</option>
                                <option value="1">01:00 AM</option>
                                <option value="2">02:00 AM</option>
                                <option value="3">03:00 AM</option>
                                <option value="4">04:00 AM</option>
                                <option value="5">05:00 AM</option>
                                <option value="6">06:00 AM</option>
                                <option value="7">07:00 AM</option>
                                <option value="8">08:00 AM</option>
                                <option value="9">09:00 AM</option>
                                <option value="10">10:00 AM</option>
                                <option value="11">11:00 AM</option>
                                <option value="12">12:00 AM</option>
                                <option value="13">01:00 PM</option>
                                <option value="14">02:00 PM</option>
                                <option value="15">03:00 PM</option>
                                <option value="16">04:00 PM</option>
                                <option value="17">05:00 PM</option>
                                <option value="18">06:00 PM</option>
                                <option value="19">07:00 PM</option>
                                <option value="20">08:00 PM</option>
                                <option value="21">09:00 PM</option>
                                <option value="22">10:00 PM</option>
                                <option value="23">11:00 PM</option>
                                <option value="24">12:00 PM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="end_time">Select end time:</label>
                            <select class="form-control" name="end_time" id="end_time">
                                <option selected value="" disabled>End Time</option>
                                <option value="1">01:00 AM</option>
                                <option value="2">02:00 AM</option>
                                <option value="3">03:00 AM</option>
                                <option value="4">04:00 AM</option>
                                <option value="5">05:00 AM</option>
                                <option value="6">06:00 AM</option>
                                <option value="7">07:00 AM</option>
                                <option value="8">08:00 AM</option>
                                <option value="9">09:00 AM</option>
                                <option value="10">10:00 AM</option>
                                <option value="11">11:00 AM</option>
                                <option value="12">12:00 AM</option>
                                <option value="13">01:00 PM</option>
                                <option value="14">02:00 PM</option>
                                <option value="15">03:00 PM</option>
                                <option value="16">04:00 PM</option>
                                <option value="17">05:00 PM</option>
                                <option value="18">06:00 PM</option>
                                <option value="19">07:00 PM</option>
                                <option value="20">08:00 PM</option>
                                <option value="21">09:00 PM</option>
                                <option value="22">10:00 PM</option>
                                <option value="23">11:00 PM</option>
                                <option value="24">12:00 PM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="total_hour">Total Hour</label>
                            <input type="number" name="total_hour" placeholder="Enter Hour"
                                   class="f1-email form-control"
                                   id="total_hour">
                        </div>
                        <div class="f1-buttons">
                            <button type="button" class="btn btn-next">Next</button>
                        </div>
                    </fieldset>

                    <fieldset>
                        <h4>Address details:</h4>
                        <div class="form-group">
                            <input type="text" name="area_name" placeholder="Enter area name"
                                   class="f1-email form-control"
                                   id="area_name">
                        </div>
                        <h4>How much you can pay per/hour:</h4>
                        <div class="form-group">
                            <input type="number" name="amount_per_hour" placeholder="Enter amount"
                                   class="f1-email form-control"
                                   id="amount_hour">
                        </div>
                        <div class="form-group">
                            <h4>What Subjects Want To Learn?</h4>
                            <div class="checkbox checkbox-circle checkbox-info">
                                @forelse($subCourses as $course)
                                    <div class="col-md-6">
                                        <input name="courses[]" value="{{$course->id}}" id="checkbox{{$course->id}}"
                                               type="checkbox" checked>
                                        <label for="checkbox{{$course->id}}">{{$course->name}}</label>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="" style="margin-bottom: 100px !important;"></div>
                        <div class="f1-buttons">
                            <button type="button" class="btn btn-previous">Previous</button>
                            <button type="button" class="btn btn-next">Next</button>
                        </div>
                    </fieldset>

                    <fieldset>
                        <h4>Days Required for tutor</h4>
                        <div class="checkbox checkbox-circle checkbox-info">
                            <div class="col-md-6">
                                <input name="days[]" id="day0" type="checkbox" checked value="Sunday">
                                <label for="day0">Sunday</label>
                            </div>
                            <div class="col-md-6">
                                <input name="days[]" id="day1" type="checkbox" checked value="Monday">
                                <label for="day1">Monday</label>
                            </div>
                            <div class="col-md-6">
                                <input name="days[]" id="day2" type="checkbox" checked value="Tuesday">
                                <label for="day2">Tuesday</label>
                            </div>
                            <div class="col-md-6">
                                <input name="days[]" id="day3" type="checkbox" checked value="Wednesday">
                                <label for="day3">Wednesday</label>
                            </div>
                            <div class="col-md-6">
                                <input name="days[]" id="day4" type="checkbox" checked value="Thursday">
                                <label for="day4">Thursday</label></div>
                            <div class="col-md-6">
                                <input name="days[]" id="day5" type="checkbox" checked value="Friday">
                                <label for="day5">Friday</label>
                            </div>
                            <div class="col-md-12">
                                <input name="days[]" id="day6" type="checkbox" checked value="Saturday">
                                <label for="day6">Saturday</label>
                            </div>
                        </div>
                        <div class="f1-buttons" style="margin-top: 150px !important;">
                            <button type="button" class="btn btn-previous">Previous</button>
                            <button type="submit" class="btn btn-submit">Submit</button>
                        </div>
                    </fieldset>

                </form>
            </div>
        </div>

    </div>
</div>


<!-- Javascript -->
<script src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.backstretch.min.js')}}"></script>
<script src="{{asset('assets/js/retina-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script>

    let form = $('#request-form');

    form.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                // Success
                Swal({
                    type: 'success',
                    text: response.message,
                }).then(function () {
                    window.top.location.href = '{{url('/')}}'
                })
            },
            error: function (error) {
            }
        });
    });

</script>
</body>

</html>