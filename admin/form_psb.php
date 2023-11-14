<?php

use PhpOffice\PhpSpreadsheet\Worksheet\Row;

include '../admin/template/header.php'; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Tambah PSB</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Data Siswa PSB</li>
                        <li class="breadcrumb-item active">Form Tambah PSB</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-info alert-dismissible">
                <h5><i class="icon fas fa-info"></i>Info !</h5>
                Jika menggunakan form ini status validasi otomatis dinyatakan <strong>VALID</strong>. Pastikan calon siswa menyetor data terlebih dahulu sebelum mendaftar.
            </div>
            <?php
            include '../admin/koneksi.php';
            $get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb ORDER BY id_psb ASC LIMIT 1"));
            // var_dump($get_data);
            ?>
            <?php
            if (isset($_POST['tambah_psb'])) {
                require '../admin/functions/tambah.php';
                $get_msg = tambah_psb($_POST);
            }
            ?>
            <?php if ($get_data['status'] == 'aktif') : ?>
                <?php if ($get_data['tgl_tutup'] >= date('Y-m-d')) : ?>
                    <div class="card mt-2">
                        <div class="card-header bg-success text-light">Formulir Pendaftaran :</div>
                        <div class="card-body">
                            <form action="" method="POST" id="form-pendaftaran">
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
                                            <input type="number" name="nisn" id="nisn" class="form-control <?= (isset($get_msg) != null ? 'is-invalid' : ''); ?>" value="<?= (isset($get_msg) != null ? $get_msg->old->nisn : ''); ?>">
                                            <?php if (isset($get_msg) != null) : ?>
                                                <div class="invalid-feedback">
                                                    NISN <?= $get_msg->old->nisn; ?> Sudah terdaftar di database
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nama_siswa">Nama Calon Siswa</label>
                                            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?= (isset($get_msg) != null ? $get_msg->old->nama_siswa : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= (isset($get_msg) != null ? $get_msg->old->tempat_lahir : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tgl Lahir</label>
                                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?= $get_msg->old->tgl_lahir; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nama_ortu">Nama Orang Tua</label>
                                            <input type="text" name="nama_ortu" id="nama_ortu" class="form-control" value="<?= (isset($get_msg) != null ? $get_msg->old->nama_ortu : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="alamat_rumah">Alamat Rumah</label>
                                            <input type="text" name="alamat_rumah" id="alamat_rumah" class="form-control" value="<?= (isset($get_msg) != null ? $get_msg->old->alamat_rumah : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="no_hp">No HP Yang Bisa Dihubungi</label>
                                            <input type="number" name="no_hp" id="no_hp" class="form-control" value="<?= (isset($get_msg) != null ? $get_msg->old->no_hp : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                                            <input type="text" name="pekerjaan_ortu" id="pekerjaan_ortu" class="form-control" value="<?= (isset($get_msg) != null ? $get_msg->old->pekerjaan_ortu : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah">Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" value="<?= (isset($get_msg) != null ? $get_msg->old->asal_sekolah : ''); ?>">
                                        </div>
                                    </div>
                                    <?php
                                    include '../admin/koneksi.php';
                                    $query_studi = mysqli_query($conn, "SELECT * FROM program_studi")
                                    ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jurusan">Program Keahlian</label>
                                            <select class="selectpicker form-control" name="jurusan" data-live-search="true" title="Pilih Jurusan" id="jurusan">
                                                <?php while ($row = mysqli_fetch_array($query_studi)) : ?>
                                                    <?php $checked = (isset($get_msg) != null ? $get_msg->old->jurusan : '');  ?>
                                                    <option <?= ($checked == $row['id_Pstudi'] ? 'selected' : ''); ?> value="<?= $row['id_Pstudi']; ?>"><?= $row['nama_studi']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary" name="tambah_psb">Simpan</button>
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
                    <h4>Masa Pendaftaran Sudah Melewati Tanggal Yang Ditentukan. Silahkan Atur Dibagian Setting</h4>
                <?php endif; ?>
            <?php else : ?>
                <div class="d-flex justify-content-center">
                    <h1>Pendaftaran belum di buka</h1>
                </div>
                <h4>Silahkan Atur Dibagian Setting</h4>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php include '../admin/template/footer.php'; ?>