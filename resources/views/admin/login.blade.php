<!DOCTYPE html>
<html lang="en">
<head>

    @include('includes.admin-header')
</head>

<body class="off-canvas-sidebar">


<div class="wrapper wrapper-full-page">

    <div class="page-header lock-page header-filter" style="background-image: url({{asset('admin/img/lock.jpg')}})">
        <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
        <div class="container">
            <div class="col-md-4 ml-auto mr-auto">
                <div class="card card-profile text-center card-hidden">
                    <div class="card-header ">
                        <div class="card-avatar">
                            <a href="#">
                                <img class="img" src="{{asset('images/admin-login.jpg')}}">
                            </a>
                        </div>
                    </div>
                    <form id="loginForm" action="{{url('admin/login/form')}}" method="post">
                        {{csrf_field()}}
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="exampleInput2" class="bmd-label-floating">Enter Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInput2" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Enter Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInput1" required>
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            <button class="btn btn-primary btn-round">Unlock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav class="float-left">

                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    , made with <i class="material-icons text-danger">favorite</i> by
                    <a href="{{'/'}}" target="_blank"> XYZ Dev</a>.
                </div>
            </div>
        </footer>

    </div>


</div>

@include('includes.admin-core-js')

<script>

    demo.checkFullPageBackgroundImage();
    setTimeout(function () {
        // after 1000 ms we add the class animated to the login/register card
        $('.card').removeClass('card-hidden');
    }, 100);

    let formLogin = $('#loginForm');

    formLogin.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: formLogin.attr('action'),
            type: formLogin.attr('method'),
            data: formLogin.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    window.location.href = '{{url('admin/dashboard')}}'
                } else {
                    showNoti('Entered email or password is invalid!');
                }
            },
            error: function (error) {
                showNoti('Server Error! try again');
            }
        });
    });

    function showNoti(message) {
        $.notify({
            icon: "add_alert",
            message: message

        }, {
            type: 'danger',
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }
</script>


</body>


</html>
