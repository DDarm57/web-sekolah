<?php include '../admin/template/header.php' ?>



<?php

include '../admin/koneksi.php';
$id_pendaftaran = $_GET['id_psb'];
$get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE id_pendaftaran='$id_pendaftaran'"));
$jurusan = $get_data['jurusan'];
$get_jurusan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM program_studi WHERE id_Pstudi='$jurusan'"));
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Calon Siswa PSB</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Data Siswa PSB</li>
                        <li class="breadcrumb-item active">Calon Siswa PSB</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">No Pendaftaran : <?= $get_data['no_pendaftaran']; ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <h4 style="width: 100%;"><strong>Nomor Pendaftaran</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['no_pendaftaran']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>NISN</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['nisn']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>Nama Calon Siswa</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['nama_siswa']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>Tempat dan tanggal lahir</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['tempat_lahir'] . ', ' . $get_data['tgl_lahir']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>Nama Orang Tua</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['nama_ortu']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>Alamat Rumah</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['alamat_rumah']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>No Hp</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['no_hp']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>Pekerjaan Orang Tua</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['pekerjaan_ortu']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>Asal Sekolah</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_data['asal_sekolah']; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><strong>Jurusan Yang Dipilih</strong></h4>
                            </td>
                            <td>
                                <h4><strong>:</strong></h4>
                            </td>
                            <td>
                                <h4><?= $get_jurusan['nama_studi']; ?></h4>
                            </td>
                        </tr>
                    </table>
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="d-inline">
                                    <h4>Scan Ijazah :</h4>
                                    <a href="#" class="cek-gambar1" data-toggle="modal" data-target="#exampleModal">
                                        <img src="../admin/gambar/siswa_psb/<?= $get_data['scan_ijazah']; ?>" alt="" class="img-thumbnail d-gambar1" style="width: 150px; height: 150px; object-fit: cover;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="d-inline">
                                    <h4>Scan KK:</h4>
                                    <a href="#" class="cek-gambar2" data-toggle="modal" data-target="#exampleModal">
                                        <img src="../admin/gambar/siswa_psb/<?= $get_data['scan_kk']; ?>" alt="" class="img-thumbnail d-gambar2" style="width: 150px; height: 150px; object-fit: cover;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="d-inline">
                                    <h4>Scan KTP Orang Tua:</h4>
                                    <a href="#" class="cek-gambar3" data-toggle="modal" data-target="#exampleModal">
                                        <img src="../admin/gambar/siswa_psb/<?= $get_data['scan_ktpOrtu']; ?>" alt="" class="img-thumbnail d-gambar3" style="width: 150px; height: 150px; object-fit: cover;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="d-inline">
                                    <h4>Scan NISN:</h4>
                                    <a href="#" class="cek-gambar4" data-toggle="modal" data-target="#exampleModal">
                                        <img src="../admin/gambar/siswa_psb/<?= $get_data['scan_nisn']; ?>" alt="" class="img-thumbnail d-gambar4" style="width: 150px; height: 150px; object-fit: cover;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form action="ajax_form/proses_validasi.php" method="POST" id="form-validasi">
                            <input type="hidden" name="id_pendaftaran" value="<?= $get_data['id_pendaftaran']; ?>">
                            <input type="radio" name="status_pendaftaran" id="v-tidakValid" value="tidak valid" hidden>
                            <input type="radio" name="status_pendaftaran" id="v-valid" value="valid" hidden>
                            <div id="form-pesan" hidden>
                                <div class="alert alert-warning alert-dismissible mt-2">
                                    <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan !</h5>
                                    Tulis form dibawah apa saja data pendaftaran calon siswa yang tidak valid.
                                </div>
                                <div class="form-group">
                                    <label for="pesan">Pesan Data Tidak Valid</label>
                                    <textarea name="pesan" id="summernote" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-validasi" hidden></button>
                        </form>
                        <div class="d-flex justify-content-between mt-2">
                            <button type="button" class="btn btn-success" id="btn-valid">Valid</button>
                            <button type="button" class="btn btn-danger" id="btn-Tvalid">Tidak Valid</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="overlay" id="loader" hidden>
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
            </div><!-- /.container-fluid -->
            <!-- /.content -->
    </section>
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


<?php include '../admin/template/footer.php' ?>