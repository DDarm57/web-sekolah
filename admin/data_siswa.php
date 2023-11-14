<?php include '../admin/template/header.php' ?>

<?php
if (isset($_GET['hapus_siswa'])) {
    require '../admin/functions/hapus.php';
    hapus_siswa($_GET);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Siswa</li>
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

            //unduh template import data data siswa
            if (isset($_GET['temp_siswa'])) {
                require '../admin/process_excel/template_imp.php';
                temp_siswa();
            }
            //import data siswa jika dijalankan
            if (isset($_POST['import'])) {
                require '../admin/process_excel/import.php';
                imp_dataSiswa($_POST);
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
                            <!-- <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalImpSiswa">
                                <i class="fas fa-file-excel"></i> Import
                            </button> -->
                            <a href="" class="btn btn-outline-primary"><i class="fas fa-file-excel"></i> Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($_GET['id_siswa'])) : ?>
                <?php
                $id_siswa = $_GET['id_siswa'];
                $query_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_siswa WHERE id_siswa = '$id_siswa'"));
                ?>
                <div class="alert alert-warning alert-dismissible">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan !</h5>
                    Data dengan <strong>NAMA = <?= $query_siswa['nama_siswa']; ?> | NISN = <?= $query_siswa['nisn']; ?></strong> terhubung ke data akademik jika anda ingin menghapus data ini maka akan menghapus semua data yang terhubung apakah anda yakin ? jika yakin klik tombol dibawah <br>
                    <a href="data_siswa.php?hapus_siswa=<?= $id_siswa; ?>" class="btn btn-sm btn-danger">Ya Hapus Data!</a> || <a href="data_siswa.php" class="btn btn-sm btn-success">Batal!</a>
                </div>
            <?php endif; ?>
            <?php
            //cari siswa yang belum mendapatkan kelas
            include '../admin/koneksi.php';
            $get_countSiswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_siswa WHERE status = 'no_kelas'"));
            ?>
            <?php if ($get_countSiswa > 0) : ?>
                <div class="alert alert-danger alert-dismissible mb-2">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan!</h5>
                    <strong>Data siswa yang sudah mendaftar dan dinyatakan lulus dan belum mendapatkan kelas sebanyak <?= $get_countSiswa; ?> data</strong><br>
                    Data siswa ini belum ditetapkan ke data akademik. <a href="atur_kelas.php" class="btn btn-sm btn-primary">Atus Sekarang!</a>
                </div>
            <?php endif; ?>
            <div class="card mt-2">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="card-title">Data Siswa</div>
                        <!-- <a href="" class="btn btn-sm btn-primary"><i class="fas fa-user-plus"></i> Tambah Data Siswa</a> -->
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Tempat & Tgl Lahir</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        // $id_tahunAkd = $_GET['id_tahunAkd'];
                        if (isset($_GET['id_tahunAkd'])) {
                            $id_tahunAkd = $_GET['id_tahunAkd'];
                            $query = mysqli_query($conn, "SELECT * FROM data_siswa INNER JOIN data_akademik ON data_siswa.id_siswa = data_akademik.id_siswa WHERE id_thnAkd = $id_tahunAkd ORDER BY data_siswa.id_siswa DESC");
                        } else {
                            $id_tahunAkd = $get_tahunAkd['id_tahunAkd'];
                            $query = mysqli_query($conn, "SELECT * FROM data_siswa INNER JOIN data_akademik ON data_siswa.id_siswa = data_akademik.id_siswa WHERE id_thnAkd = $id_tahunAkd ORDER BY data_siswa.id_siswa DESC");
                        }
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td><?= $row['tempat_lahir'] . ", " . $row['tgl_lahir']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td>
                                        <strong>
                                            <?php
                                            if ($row['status'] == 'aktif') {
                                                $bg_status = "success bg-success";
                                            } elseif ($row['status'] == 'lulus') {
                                                $bg_status = "info bg-info";
                                            } else {
                                                $bg_status = "danger bg-danger";
                                            }
                                            ?>
                                            <p style="text-transform:uppercase" class="text-<?= $bg_status; ?> rounded text-center"><?= $row['status']; ?></p>
                                        </strong>
                                    </td>
                                    <td>
                                        <a href="edit_siswa.php?id_siswa=<?= $row['id_siswa']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                        <a href="data_siswa.php?id_siswa=<?= $row['id_siswa']; ?>" class="btn btn-sm btn-danger hapus"><i class="fas fa-trash"></i></a>
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

<!-- Modal IMPORT DATA SISWA -->

<div class="modal fade" id="ModalImpSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">IMPORT DATA SISWA</h5>
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
                    Silahkan cek terlebih dahulu dibagian <a class="text-primary" href="tahun_akademik.php">tahun akademik</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="card-title title-import">Download Template Import <i class="fas fa-arrow-right"></i></div>
                            <a href="data_siswa.php?temp_siswa=unduh" class="btn btn-sm btn-outline-success"><i class="fas fa-file-excel"></i> Unduh Template Import</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2" id="rules-impSiswa">
                            <img src="../admin/gambar/rules_impSiswa.PNG" alt="" style="width: 100%;">
                            <p> <strong>Rules Import :</strong> gambar di atas dibagian kolom kelas usahakan tidak ada spasi dan tidak harus center sama seperti di gambar</p>
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
                            <p><strong>File Data Siswa</strong> <small class="text-danger">(*xls *xlsx)</small></p>
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