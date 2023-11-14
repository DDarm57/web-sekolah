<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/assets/bootstrap-select/dist/css/bootstrap-select.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/assets/dist/css/adminlte.min.css">
    <title>Formulir Pendaftaran</title>
</head>

<body>
    <style>
        .error {
            color: red;
        }
    </style>
    <?php include 'template_pendaftaran/navbar.php'; ?>
    <div class="container">
        <h3 class="mt-4">Formulir Pendaftaran</h3>
        <?php
        include 'admin/koneksi.php';
        $get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb ORDER BY id_psb ASC LIMIT 1"));
        // var_dump($get_data);
        ?>
        <?php if ($get_data['status'] == 'aktif') : ?>
            <?php if ($get_data['tgl_tutup'] >= date('Y-m-d')) : ?>
                <div class="card mt-2">
                    <div class="info-detail" hidden>
                        <div class="alert alert-warning alert-dismissible">
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan !</h5>
                            Screenshoot / tangkap layar detail data anda yang sudah mendaftar. atau klik tombol print dibawah
                        </div>
                    </div>
                    <div class="card-header bg-info text-light">Formulir Pendaftara :</div>
                    <div class="card-body">
                        <form action="ajax_process/proses_pendaftaran.php" method="POST" enctype="multipart/form-data" id="form-pendaftaran">
                            <div class="row">
                                <div class="col-sm-4 col-6">
                                    <div class="form-group">
                                        <label for="no_pendaftara">No Pendaftaran</label>
                                        <input type="text" name="no_pendaftaran" id="no_pendaftaran" class="form-control" value="<?= date('Y') . rand(100000, 999999); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="form-group">
                                        <label for="nisn">NISN</label>
                                        <input type="number" name="nisn" id="nisn" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nama_siswa">Nama Calon Siswa</label>
                                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tgl Lahir</label>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nama_ortu">Nama Orang Tua</label>
                                        <input type="text" name="nama_ortu" id="nama_ortu" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="alamat_rumah">Alamat Rumah</label>
                                        <input type="text" name="alamat_rumah" id="alamat_rumah" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="no_hp">No HP Yang Bisa Dihubungi</label>
                                        <input type="number" name="no_hp" id="no_hp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                                        <input type="text" name="pekerjaan_ortu" id="pekerjaan_ortu" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="asal_sekolah">Asal Sekolah</label>
                                        <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control">
                                    </div>
                                </div>
                                <?php
                                include 'admin/koneksi.php';
                                $query_studi = mysqli_query($conn, "SELECT * FROM program_studi")
                                ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="jurusan">Program Keahlian</label>
                                        <select class="selectpicker form-control" name="jurusan" data-live-search="true" title="Pilih Jurusan" id="jurusan">
                                            <?php while ($row = mysqli_fetch_array($query_studi)) : ?>
                                                <option value="<?= $row['id_Pstudi']; ?>"><?= $row['nama_studi']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <label for="gambar_berita">Scan Ijazah</label>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" name="scan_ijazah" id="file_image1" required>
                                            <label class="custom-file-label label1">Choose file...</label>
                                        </div>
                                        <small>jpg, png, jpeg</small>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <img src="admin/gambar/siswa_psb/default.jpg" alt="" class="img-thumbnail" id="imgPreview1" style="width: 130px; height: 130px; object-fit: cover;">
                                </div>
                                <div class="col-sm-3 col-6">
                                    <label for="gambar_berita">Scan KK</label>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" name="scan_kk" id="file_image2" required>
                                            <label class="custom-file-label label2">Choose file...</label>
                                        </div>
                                        <small>jpg, png, jpeg</small>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <img src="admin/gambar/siswa_psb/default.jpg" alt="" class="img-thumbnail" id="imgPreview2" style="width: 130px; height: 130px; object-fit: cover;">
                                </div>
                                <div class="col-sm-3 col-6">
                                    <label for="gambar_berita">Scan KTP Orang Tua</label>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" name="scan_ktpOrtu" id="file_image3" required>
                                            <label class="custom-file-label label3">Choose file...</label>
                                        </div>
                                        <small>jpg, png, jpeg</small>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <img src="admin/gambar/siswa_psb/default.jpg" alt="" class="img-thumbnail" id="imgPreview3" style="width: 130px; height: 130px; object-fit: cover;">
                                </div>
                                <div class="col-sm-3 col-6">
                                    <label for="gambar_berita">Scan NISN</label>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" name="scan_nisn" id="file_image4" required>
                                            <label class="custom-file-label label4">Choose file...</label>
                                        </div>
                                        <small>jpg, png, jpeg</small>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <img src="admin/gambar/siswa_psb/default.jpg" alt="" class="img-thumbnail" id="imgPreview4" style="width: 130px; height: 130px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary" id="btn-daftar"><i class="fas fa-envelope"></i> Kirim Pendaftaran</button>
                                <a href="detail_pendaftaran.php" class="btn btn-primary btn-kembali" hidden><i class="fas fa-chevron-left"></i> Kembali ke detail pendaftaran</a>
                            </div>
                        </form>
                    </div>
                    <div class="overlay" id="loader" hidden>
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
            <?php else : ?>
                <div class="d-flex justify-content-center">
                    <h1>Pendaftaran di tutup</h1>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="d-flex justify-content-center">
                <h1>Pendaftaran belum di buka</h1>
            </div>
        <?php endif; ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="admin/assets/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

    <script>
        for (let n = 0; n <= 4; n++) {
            $(document).ready(() => {
                //file scan
                $("#file_image" + n).change(function() {
                    const file = this.files[0];
                    var size = this.files[0].size;
                    let imageName = file.name;
                    var ext = file.name.split(".").pop().toLowerCase();
                    if ($.inArray(ext, ["gif", "png", "jpg", "jpeg"]) == -1) {
                        Swal.fire({
                            title: "Gagal",
                            text: "Extensi bukan gambar",
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK",
                        });
                        if ($("#file_image" + n).val() != null) {
                            $("#file_image" + n).val("");
                        }
                    } else if (size > 2000000) {
                        Swal.fire({
                            title: "Gagal",
                            text: "Ukuran gambar maksimal 2mb",
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK",
                        });
                    } else {
                        if (file) {
                            let reader = new FileReader();
                            $(".label" + n).text(imageName);
                            reader.onload = function(event) {
                                console.log(event.target.result);
                                console.log(file);
                                $("#imgPreview" + n).attr("src", event.target.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });
            });
        }

        $('#form-pendaftaran').validate({
            error: function(label) {
                $(this).addClass("error");
            },
            rules: {
                nisn: {
                    required: true,
                },
                nama_siswa: {
                    required: true,
                },
                tempat_lahir: {
                    required: true,
                },
                tgl_lahir: {
                    required: true,
                },
                nama_ortu: {
                    required: true,
                },
                alamat_rumah: {
                    required: true,
                },
                no_hp: {
                    required: true,
                },
                pekerjaan_ortu: {
                    required: true,
                },
                asal_sekolah: {
                    required: true,
                },
                jurusan: {
                    required: true,
                },
                file_image1: {
                    required: true,
                },
                file_image2: {
                    required: true,
                },
                file_image3: {
                    required: true,
                },
                file_image4: {
                    required: true,
                },
            },
            messages: {
                nisn: {
                    required: "nisn tidak boleh kosong",
                },
                nama_siswa: {
                    required: "nama tidak boleh kosong",
                },
                tempat_lahir: {
                    required: "tempat lahir tidak boleh kosong",
                },
                tgl_lahir: {
                    required: "tgl lahir tidak boleh kosong",
                },
                nama_ortu: {
                    required: "nama ortu tidak boleh kosong",
                },
                alamat_rumah: {
                    required: "almt rumah tidak boleh kosong",
                },
                no_hp: {
                    required: "no hp tidak boleh kosong",
                },
                pekerjaan_ortu: {
                    required: "pekerjaan ortu tidak boleh kosong",
                },
                asal_sekolah: {
                    required: "asal sekolah tidak boleh kosong",
                },
                jurusan: {
                    required: "pilihan jurusan tidak boleh kosong",
                },
                file_image1: {
                    required: "gambar tidak boleh kosong",
                },
                file_image2: {
                    required: "gambar tidak boleh kosong",
                },
                file_image3: {
                    required: "gambar tidak boleh kosong",
                },
                file_image4: {
                    required: "gambar tidak boleh kosong",
                },
            }
        })

        $(document).on('submit', '#form-pendaftaran', function(e) {
            e.preventDefault();

            console.log('ajax dijalankan');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Apakah data sudah valid?',
                text: "Cek data terlebih dahulu sebelum mengirim pendaftaran!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Daftar Sekarang',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#loader').prop('hidden', false);
                            $('#btn-daftar').html('<i class="fas fa-sync-alt fa-spin"></i>');
                        },
                        error: function(data) {
                            console.log(data);
                            Swal.fire({
                                title: "Gagal",
                                text: data.error,
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "OK",
                            });
                        },
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                                title: "Berhasil",
                                text: data.sukses,
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "OK",
                            });
                            $('#nisn').val("");
                            $('#nama_siswa').val("");
                            $('#tempat_lahir').val("");
                            $('#tempat_lahir').val("");
                            $('#tgl_lahir').val("");
                            $('#nama_ortu').val("");
                            $('#alamat_rumah').val("");
                            $('#no_hp').val("");
                            $('#pekerjaan_ortu').val("");
                            $('#asal_sekolah').val("");
                            $('#jurusan').prop('selected', false);
                            $('#jurusan').attr('aria-expended', false);
                            $('#imgPreview1').attr('src', 'admin/gambar/siswa_psb/default.jpg');
                            $('#imgPreview2').attr('src', 'admin/gambar/siswa_psb/default.jpg');
                            $('#imgPreview3').attr('src', 'admin/gambar/siswa_psb/default.jpg');
                            $('#imgPreview4').attr('src', 'admin/gambar/siswa_psb/default.jpg');
                            $('#imgPreview1').val("Chose File..");
                            $('#imgPreview2').val("Chose File..");
                            $('#imgPreview3').val("Chose File..");
                            $('#imgPreview4').val("Chose File..");
                            $('#btn-daftar').hide();
                            $('.btn-kembali').prop('hidden', false);
                            $('#loader').prop('hidden', true);

                            $('#form-pendaftaran').prop('hidden', true);
                            $('.card-body').html(data.detail);
                            $('.info-detail').prop('hidden', false);
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Silahkan cek kembali formulir data pendaftaran',
                        'error'
                    )
                }
            })
        })
    </script>
</body>

</html>