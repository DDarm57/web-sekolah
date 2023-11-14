<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="d-flex justify-content-center">
            <img src="admin/gambar/7990_mu.png" alt="" style="width: 100px;">
        </div>
        <div class="login-logo">
            <a href="admin/assets/index2.html"><b>SMK MIFTAHUL ULUM</b> SAMPANG</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login untuk mengakses admin website</p>
                <form action="ajax_process/login_process.php" method="post" id="login-form">
                    <div class="form-group">
                        <label for="username" class="error">Username</label>
                        <div class="input-group mb-3">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="error">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-login">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="admin/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/assets/dist/js/adminlte.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: 'Username tidak boleh kosong'
                    },
                    password: {
                        required: 'Password tidak boleh kosong'
                    }
                }
            })
            $(document).on('submit', '#login-form', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: $('#login-form').serialize(),
                    beforeSend: function() {
                        $('#btn-login').html('<i class="fas fa-sync-alt fa-spin"></i>');
                    },
                    error: function() {
                        alert('ERROR AJAX');
                    },
                    success: function(data) {
                        $('.login-box-msg').html(data.pesan);
                        $('#btn-login').html('Sign In');
                        if (data.login) {
                            setInterval(function() {
                                window.location.href = data.login
                            }, 1000);
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>