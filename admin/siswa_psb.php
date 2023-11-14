<?php include '../admin/template/header.php' ?>


<?php if (isset($_POST['tambah_studi'])) { ?>
    <?php
    require '../admin/functions/tambah.php';
    ?>
    <?php tambah_studi($_POST) ?>
<?php } ?>
<?php if (isset($_POST['edit_studi'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php update_studi($_POST) ?>
<?php } ?>
<?php if (isset($_GET['nisn'])) { ?>
    <?php
    require '../admin/functions/hapus.php';
    ?>
    <?php hapus_psbSiswa($_GET) ?>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa PSB</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Siswa PSB</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php
            include '../admin/koneksi.php';
            $query = mysqli_query($conn, "SELECT * FROM tahun_akademik");
            $get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
            if (isset($_GET['id_tahunAkd'])) {
                $id_tahunSelected = $_GET['id_tahunAkd'];
            } else {
                $id_tahunSelected = $get_tahunAkd['id_tahunAkd'];
            }
            //unduh template import data siswa
            if (isset($_POST['temp_psb'])) {
                require '../admin/process_excel/template_imp.php';
                temp_psb($_POST);
            }
            //import data siswa jika dijalankan
            if (isset($_POST['import'])) {
                require '../admin/process_excel/import.php';
                imp_psbSiswa($_POST);
            }
            ?>
            <div class="row">
                <div class="col-sm-6">
                    <form action="">
                        <div class="input-group mb-3">
                            <select class="selectpicker form-control" name="id_tahunAkd" data-live-search="true" title="Tahun Akademik" required>
                                <?php while ($row = mysqli_fetch_array($query)) : ?>
                                    <option <?= ($row['id_tahunAkd'] == $id_tahunSelected ? 'selected' : ''); ?> value="<?= $row['id_tahunAkd']; ?>"><?= $row['tahun']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-start">
                        <div class="px-2">
                            <!-- Button trigger modal import psb -->
                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalImpPsb">
                                <i class="fas fa-file-excel"></i> Import
                            </button>
                            <a href="" class="btn btn-outline-primary"><i class="fas fa-file-excel"></i> Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="card-title">Data Siswa PSB</div>
                        <a href="form_psb.php" class="btn btn-sm btn-primary"><i class="fas fa-user-plus"></i> Tambah Siswa PSB</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pendaftara</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Asal Sekolah</th>
                                <th>Jurusan Diambil</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        // $id_tahunAkd = $_GET['id_tahunAkd'];
                        if (isset($_GET['id_tahunAkd'])) {
                            $id_tahunAkd = $_GET['id_tahunAkd'];
                            $query = mysqli_query($conn, "SELECT * FROM psb_siswa INNER JOIN program_studi ON psb_siswa.jurusan = program_studi.id_Pstudi INNER JOIN tahun_akademik ON psb_siswa.id_thnAkd = tahun_akademik.id_tahunAkd WHERE id_thnAkd = $id_tahunAkd ORDER BY psb_siswa.id_pendaftaran DESC");
                        } else {
                            $id_tahunAkd = $get_tahunAkd['id_tahunAkd'];
                            $query = mysqli_query($conn, "SELECT * FROM psb_siswa INNER JOIN program_studi ON psb_siswa.jurusan = program_studi.id_Pstudi INNER JOIN tahun_akademik ON psb_siswa.id_thnAkd = tahun_akademik.id_tahunAkd WHERE id_thnAkd = $id_tahunAkd ORDER BY psb_siswa.id_pendaftaran DESC");
                        }
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['no_pendaftaran']; ?></td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td><?= $row['asal_sekolah']; ?></td>
                                    <td><?= $row['nama_studi']; ?></td>
                                    <td>
                                        <?php if ($row['status_pendaftaran'] == 'sedang divalidasi') {
                                            $get_view = 'warning bg-warning rounded';
                                        } elseif ($row['status_pendaftaran'] == 'valid') {
                                            $get_view = 'warning bg-success rounded';
                                        } elseif ($row['status_pendaftaran'] == 'tidak valid') {
                                            $get_view = 'warning bg-danger rounded';
                                        } ?>
                                        <strong>
                                            <p class="text-<?= $get_view; ?> text-center" style="text-transform:uppercase"><?= $row['status_pendaftaran']; ?></p>
                                        </strong>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="cek_dataPsb.php?id_psb=<?= $row['id_pendaftaran']; ?>" class="btn btn-sm btn-info">Cek Data </a>
                                            <a href="siswa_psb.php?nisn=<?= $row['nisn']; ?>" class="btn btn-sm btn-danger hapus"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" id="form-studi" enctype="multipart/form-data">
                            <input type="hidden" name="id_Pstudi" id="id_Pstudi">
                            <input type="hidden" name="gLama_studi" id="gLama_studi">
                            <div class="form-group">
                                <label for="nama_studi">Nama Studi</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nama_studi" name="nama_studi" placeholder="Username" aria-describedby="inputGroupPrepend" disabled readonly>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><a href="#" id="edit-namaStudi">Edit</a></span>
                                    </div>
                                </div>
                                <small id="rules-studi">Nama studi tidak boleh sama dengan data yang tersimpan</small>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_studi">Deskripsi</label>
                                <textarea name="deskripsi_studi" id="summernote" class="form-control">-</textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="gambar_studi">Gambar</label>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" name="file" id="file_image">
                                            <label class="custom-file-label">Choose file...</label>
                                        </div>
                                        <small>jpg, png, jpeg</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="./gambar/default.jpg" alt="" class="img-thumbnail" id="imgPreview" style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-sm btn-primary" name="tambah_studi" id="t-dataStudi">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="overlay" id="loader-card">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal IMPORT DATA PSB -->

<div class="modal fade" id="ModalImpPsb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">IMPORT DATA SISWA PSB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $tahun_akademik = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
            ?>
            <div class="modal-body">
                <div class="alert alert-warning alert-dismissible">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan !</h5>
                    Data yang akan diimport berdasarkan tahun akademik yang aktif <br> <strong>(Tahun akademik aktif = <?= $tahun_akademik['tahun']; ?>)</strong><br>
                    Silahkan cek terlebih dahulu dibagian <a class="text-primary" href="tahun_akademik.php">tahun akademik</a><br>
                    <strong>Data yang akan diimport akan otomatis dinyatakan valid!</strong>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="card-title title-import">Download Template Import <i class="fas fa-arrow-right"></i></div>
                            <form action="#" method="post">
                                <div class="d-flex justify-content-end">
                                    <input type="number" name="column" id="column" class="form-control-sm" min="1" placeholder="Jumlah kolom tabel" required>
                                    <button type="submit" name="temp_psb" class="btn btn-sm btn-outline-success"><i class="fas fa-file-excel"></i> Unduh Template Import</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2" id="rules-impSiswa">
                            <img src="../admin/gambar/rules_impPsb.PNG" alt="" style="width: 100%;">
                            <p> <strong>Rules Import :</strong> gambar di atas usahakan tidak ada spasi dibagian isi kolom data yang akan di import</p>
                        </div>
                        <?php
                        include '../admin/koneksi.php';
                        $query_studi = mysqli_query($conn, "SELECT * FROM program_studi");
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select class="selectpicker form-control" name="jurusan" required data-live-search="true" title="Pilih Jurusan" id="jurusan">
                                    <?php while ($row = mysqli_fetch_array($query_studi)) : ?>
                                        <option value="<?= $row['id_Pstudi']; ?>"><?= $row['nama_studi']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <p><strong>File Siswa Psb</strong> <small class="text-danger">(*xls *xlsx)</small></p>
                            <input type="file" name="file" id="file_imp" accept=".xlsx,.xls">
                            <div class="mt-2 text-right">
                                <button type="submit" name="import" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>


<?php include '../admin/template/footer.php' ?>