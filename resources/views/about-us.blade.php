@extends('layouts.master-layout')
@section('title')
    About Us
@endsection

@section('style')

@endsection

@section('content')
    <section class="overlape">
        <div class="block no-padding">
            <div data-velocity="-.1"
                 style="background: url('') 50% -42.2px repeat scroll transparent;"
                 class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header">
                            <div class="heading">
                                <h2 class="text-white">Learn More About Us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>About Online Tutor</h3>
                                </div>
                                <div class="col-lg-7">
                                    <p>Far much that one rank beheld bluebird after outside ignobly allegedly more when
                                        oh arrogantly vehement irresistibly fussy penguin insect additionally wow
                                        absolutely crud meretriciously hastily dalmatian a glowered inset one echidna
                                        cassowary some parrot and much as goodness some froze the sullen much connected
                                        bat wonderfully on instantaneously eel valiantly petted this along across
                                        highhandedly much. </p>
                                    <p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that
                                        jeepers loosely yikes that as or eel underneath kept and slept compactly far
                                        purred sure abidingly up above fitting to strident wiped set waywardly far the
                                        and pangolin horse approving paid chuckled cassowary oh above a much opposite
                                        far much hypnotically more therefore wasp less that hey apart well like while
                                        superbly orca and far hence one.Far much that one rank beheld bluebird after
                                        outside ignobly allegedly more when oh arrogantly vehement irresistibly
                                        fussy.</p>
                                </div>
                                <div class="col-lg-5">
                                    <img src="{{asset('images/about-us.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="tags-share">
                                <div class="share-bar">
                                    <a href="#" title="" class="share-fb"><i class="fa fa-facebook"></i>
                                    </a><a href="#" title="" class="share-twitter"><i
                                                class="fa fa-twitter"></i></a><a href="#" title="" class="share-google"><i
                                                class="la la-google"></i></a><span>Share</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="block remove-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="our-services">
                            <div class="row">
                                <div class="col-lg-12"><h2>Our Service</h2></div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="service">
                                        <i class="la la-clock-o"></i>
                                        <div class="service-info"><h3>Save Time</h3>
                                            <p>Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere.
                                                Morbi in lectus.</p></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="service">
                                        <i class="la la-search"></i>
                                        <div class="service-info"><h3>Easy Find</h3>
                                            <p>Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere.
                                                Morbi in lectus.</p></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="service">
                                        <i class="la la-user"></i>
                                        <div class="service-info"><h3>Verified Tutors</h3>
                                            <p>Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere.
                                                Morbi in lectus.</p></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="service">
                                        <i class="la la-codepen"></i>
                                        <div class="service-info"><h3>Reports</h3>
                                            <p>Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere.
                                                Morbi in lectus.</p></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="service">
                                        <i class="la la-tv"></i>
                                        <div class="service-info"><h3>Video Chat</h3>
                                            <p>Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere.
                                                Morbi in lectus.</p></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="service">
                                        <i class="la la-diamond"></i>
                                        <div class="service-info"><h3>Online Payments</h3>
                                            <p>Duis a tristique lacus. Donec vehicula ante id lorem venenatis posuere.
                                                Morbi in lectus.</p></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section>
        <div class="block">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-md-4 m-auto text-center">
                        <h2>Contact Us</h2>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-8 m-auto text-center">
                        <p>Let us now about your issue and a Professional will reach you out</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 column">
                        <div class="contact-form">
                            <form id="support-form" action="{{url('support-message')}}" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="pf-title">Full Name</span>
                                        <div class="pf-field">
                                            <input type="text" name="name" placeholder="Your name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Email</span>
                                        <div class="pf-field">
                                            <input type="email" name="email" placeholder="Your email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Message</span>
                                        <div class="pf-field">
                                            <textarea name="message"
                                                      placeholder="Write your problem here..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 column mt-4">
                        <div class="contact-textinfo style2">
                            <h3>JobHunt Office</h3>
                            <ul>
                                <li><i class="la la-map-marker"></i><span>Jobify Inc. 555 Madison Avenue, Suite F-2 Manhattan, New York 10282 </span>
                                </li>
                                <li><i class="la la-phone"></i><span>Call Us : 0934 343 343</span></li>
                                <li><i class="la la-fax"></i><span>Fax : 0934 343 343</span></li>
                                <li><i class="la la-envelope-o"></i><span>Email : info@jobhunt.com</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-md-4 m-auto ">
                        <h2>Leave Your feedback</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 column m-auto">
                        <div class="contact-form">
                            <form id="feedback-form" action="{{url('user-feedback')}}" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pf-field">
                                            <textarea name="message"
                                                      placeholder="Write your words here..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 float-right">
                                        @auth
                                            <button type="submit" class="float-right">Submit</button> @else
                                            <button type="button" class="signin-popup float-right">Submit</button>
                                        @endauth
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>

        let form_support = $('#support-form');

        form_support.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: form_support.attr('action'),
                type: form_support.attr('method'),
                data: form_support.serialize(),
                dataType: 'json',
                success: function (response) {
                    // Success
                    Swal({
                        type: 'success',
                        text: response.message,
                    }).then(function () {
                        form_support.trigger('reset')
                    })
                },
                error: function (error) {
                }
            });
        });
        let form_feedback = $('#feedback-form');

        form_feedback.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: form_feedback.attr('action'),
                type: form_feedback.attr('method'),
                data: form_feedback.serialize(),
                dataType: 'json',
                success: function (response) {
                    // Success
                    Swal({
                        type: 'success',
                        title: 'Thank You!',
                        text: response.message,
                    }).then(function () {
                        form_feedback.trigger('reset')
                    })
                },
                error: function (error) {
                }
            });
        });
        $('#nav-main-about').addClass('nav-active')
    </script>
@endsection
