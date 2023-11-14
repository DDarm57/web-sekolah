<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/assets/plugins/fontawesome-free/css/all.min.css">
    <title>Cek Validasi Pendaftaran</title>
</head>

<body>
    <?php include 'template_pendaftaran/navbar.php'; ?>
    <div class="container">
        <h3 class="mt-4">Cek Data Pendaftaran</h3>
        <div class="card mt-2">
            <div class="card-header bg-primary text-light">Cek Validasi Pendaftaran</div>
            <div class="card-body">
                <form action="ajax_process/cek_validasi.php" method="POST" id="form-cekData">
                    <div class="form-group">
                        <label for="cek">NISN/No Pendaftaran</label>
                        <input type="text" name="cek" id="cek" class="form-control">
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary" id="btn-cek">Cek Data</button>
                    </div>
                </form>
                <div id="data">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" alt="" id="tampil-gmb" style="width: 100%;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#form-cekData', function(e) {
                e.preventDefault();
                if ($('#cek').val() == "") {
                    console.log('tidak boleh kosong');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Inputan tidak boleh kosong',
                    })
                } else {
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'post',
                        data: $('#form-cekData').serialize(),
                        // dataType: 'Json',
                        beforeSend: function() {
                            $('#btn-cek').html('<i class="fas fa-sync-alt fa-spin"></i>');
                        },
                        success: function(data) {
                            console.log(data);
                            $('#form-cekData').prop('hidden', true);
                            $('#data').html(data);
                        }
                    })
                }
            })

            for (let i = 1; i <= 4; i++) {
                $(document).on('click', '.cek-gambar' + i, function() {
                    console.log($('.d-gambar' + i).attr('src'));
                    $('.modal-body #tampil-gmb').attr('src', $('.d-gambar' + i).attr('src'));
                })
            }
        })
    </script>
</body>

</html>