<?php include '../admin/template/header.php' ?>

<?php if (isset($_POST['t-tahunAkd'])) { ?>
    <?php
    require '../admin/functions/tambah.php';
    ?>
    <?php tambah_tahunAkd($_POST) ?>
<?php } ?>
<?php if (isset($_POST['edit_tahunAkd'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php edit_tahunAkd($_POST) ?>
<?php } ?>
<?php if (isset($_GET['id_tahunAkd'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php update_statusAkd($_GET) ?>
<?php } ?>
<?php if (isset($_GET['hapus_tahunAkd'])) { ?>
    <?php
    require '../admin/functions/hapus.php';
    ?>
    <?php hapus_tahunAkd($_GET) ?>
<?php } ?>

<?php
include '../admin/koneksi.php';
$tahun_sekarang = date("Y");
$query = mysqli_query($conn, "SELECT * FROM tahun_akademik ORDER BY id_tahunAkd DESC");
$get_tahunAkd = mysqli_fetch_array($query);
$tahun_akd = substr($get_tahunAkd['tahun'], 5);
// var_dump($tahun_akd);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Tahun Akademik</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Tahun Akademik</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if ($tahun_sekarang > $tahun_akd) : ?>
                <div class="alert alert-danger alert-dismissible blink">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan !</h5>
                    <h5><strong> Tahun akademik perlu di tambahkan ke tahun sekarang <?= $tahun_akd . '/' . $tahun_sekarang; ?></strong></h5>
                </div>
            <?php else : ?>
                <div class="alert alert-success alert-dismissible">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan !</h5>
                    <h5><strong>Tahun akademik tidak perlu di tambahkan</strong></h5>
                </div>
            <?php endif; ?>
            <div class="mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="tambah-thnAkd">
                    <i class="fas fa-plus"></i> Tambah Tahun Akademik
                </button>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Tahun Akademik</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Akademik</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM tahun_akademik ORDER BY id_tahunAkd DESC");
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['tahun']; ?></td>
                                    <td>
                                        <strong class="<?= ($row['status'] == 'aktif' ? 'text-success' : 'text-danger'); ?>" style="text-transform:uppercase"><?= $row['status']; ?></strong>
                                    </td>
                                    <td>
                                        <?php
                                        $tahun_1 = substr($row["tahun"], 0, 4);
                                        $tahun_2 = substr($row["tahun"], 5, 9);
                                        ?>
                                        <a href="tahun_akademik.php?id_tahunAkd=<?= $row['id_tahunAkd']; ?>&&status=<?= ($row['status'] == 'aktif' ? 'aktif' : 'tidak aktif'); ?>" class="btn btn-sm btn-<?= ($row['status'] == 'aktif' ? 'danger' : 'success'); ?> status-akd" <?= ($row['status'] == 'aktif' ? 'hidden' : ' '); ?>><?= ($row['status'] == 'aktif' ? '<i class="fas fa-times"></i>' : '<i class="fas fa-check"></i>'); ?></a>
                                        <a href="" class="btn btn-sm btn-warning edit-tahunAkd" data-toggle="modal" data-target="#exampleModal" data-id_tahunAkd="<?= $row['id_tahunAkd']; ?>" data-tahun_1="<?= $tahun_1; ?>" data-tahun_2="<?= $tahun_2; ?>"><i class="fas fa-pen"></i></a>
                                        <a href="tahun_akademik.php?hapus_tahunAkd=<?= $row['id_tahunAkd']; ?> hapus-akd" class="btn btn-sm btn-danger hapus-studi"><i class="fas fa-trash"></i></a>
                                        <!-- <a href="" class="btn btn-info"><i class="fas fa-info"></i>nfo</a> -->
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Akademik</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NISN</th>
                                <th>NAMA SISWA</th>
                                <th>KELAS</th>
                                <th>JURUSAN</th>
                                <th>TAHUN</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query_akademik = mysqli_query($conn, "SELECT * FROM data_akademik INNER JOIN tahun_akademik ON tahun_akademik.id_tahunAkd = data_akademik.id_thnAkd INNER JOIN data_siswa ON data_siswa.id_siswa = data_akademik.id_siswa INNER JOIN kelas ON kelas.id_kelas = data_akademik.id_kelas INNER JOIN program_studi ON program_studi.id_Pstudi = data_akademik.id_Pstudi WHERE tahun_akademik.status = 'aktif' ORDER BY id_akademik DESC");
                        // $cek_data = mysqli_fetch_all($query_akademik);
                        // var_dump($cek_data);
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query_akademik)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td>KELAS <?= $row['nama_kelas']; ?></td>
                                    <td><?= $row['nama_studi']; ?></td>
                                    <td><?= $row["bulan_tahun"]; ?></td>
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
    <div class="modal-dialog" role="document">
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
                        <form action="#" method="POST" id="form-tahunAkd">
                            <input type="hidden" name="id_tahunAkd" id="id_tahunAkd">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tahun">Tahun 1</label>
                                        <select name="tahun1" id="tahun1" class="selectpicker form-control" data-live-search="true" title="Tahun 1">
                                            <?php for ($i = 0; $i < 10; $i++) : ?>
                                                <option value="202<?= $i; ?>">202<?= $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tahun2">Tahun 2</label>
                                        <select name="tahun2" id="tahun2" class="selectpicker form-control" data-live-search="true" title="Tahun 2">
                                            <?php for ($i = 0; $i < 10; $i++) : ?>
                                                <option value="202<?= $i; ?>">202<?= $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p>Tahun 1 = 2022 / Tahun 2 = 2023 : 2022/2023</p>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary" name="t-tahunAkd" id="s-tahunAkd">Simpan</button>
                            </div>
                        </form>
                        <!-- <button type="button" class="btn btn-primary" id="t-tahunAkd">Tambah</button> -->
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


<?php include '../admin/template/footer.php' ?>