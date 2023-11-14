<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/assets/plugins/fontawesome-free/css/all.min.css">
    <title>LOGIN, SMK MIFTAHUL ULUM</title>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="gambar/login_img.jpg" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <h2>Ekstrakurikuler</h2>
                    <h4>SMK Miftahul Ulum</h4>
                    <div class="pesan-login">

                    </div>
                    <form action="ajax_process/auth.php" method="post" id="login-form">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form1Example13">Username</label>
                            <input type="text" name="username" id="form1Example13" class="form-control form-control-lg" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form1Example23">Password</label>
                            <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <!-- Checkbox -->
                            <a href="register_ekstra.php">Daftar Ekstrakurikuler</a>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-login">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
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
                        $('.pesan-login').html(data.pesan);
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