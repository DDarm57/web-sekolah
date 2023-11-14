<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="admin/assets/bootstrap-select/dist/css/bootstrap-select.css">
    <title>Register, SMK MIFTAHUL ULUM</title>
</head>
<?php
include 'admin/koneksi.php';
$query_kegiatan = mysqli_query($conn, "SELECT * FROM data_kegiatan");
?>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="gambar/register.jpg" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <h2>Ekstrakurikuler</h2>
                    <h4>SMK Miftahul Ulum</h4>
                    <div class="pesan-register">

                    </div>
                    <form action="ajax_process/register.php" method="post" id="register-form">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form1Example13">NISN <small>(Digunakan Username Untuk Login)</small></label>
                            <input type="text" name="nisn" id="form1Example13" class="form-control form-control-lg" required />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <div class="form-group">
                                <label class="form-label" for="form1Example23">Kegiatan Yang Akan Diikuti</label>
                                <select class="selectpicker form-control form-control-lg" name="id_kegiatan" data-live-search="true" title="Kegiatan" id="form1Example23" required>
                                    <?php while ($row = mysqli_fetch_array($query_kegiatan)) : ?>
                                        <option value="<?= $row['id_kegiatan']; ?>"><?= $row['nama_kegiatan']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-outline mb-4 inp-password" hidden>
                            <label class="form-label" for="form1Example33">Buat Password <small>(Digunakan Untuk Login Sistem)</small></label>
                            <input type="text" name="password" id="form1Example33" class="form-control form-control-lg" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <!-- Checkbox -->
                            <a href="login_ekstra.php">Sudah Punya Akun ? Login Ekstra</a>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-register">Daftar Sekarang</button>
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
    <script src="admin/assets/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#register-form', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: $('#register-form').serialize(),
                    beforeSend: function() {
                        $('#btn-register').html('<i class="fas fa-sync-alt fa-spin"></i>');
                    },
                    error: function() {
                        alert('ERROR AJAX');
                    },
                    success: function(data) {
                        $('.pesan-register').html(data.pesan);
                        $('#btn-register').html('Daftar Sekarang');
                        if (data.inp_pw == true) {
                            $('.inp-password').attr('hidden', false);
                            $('#form1Example33').attr('required', true);
                        }
                        if (data.url) {
                            setInterval(function() {
                                window.location.href = data.url
                            }, 2000);
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>