<?php

use function PHPSTORM_META\map;

include '../admin/template/header.php' ?>

<?php if (isset($_POST['status'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php update_pengumuman($_POST) ?>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengumuman PSB</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengumuman PSB</li>
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
            ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                            Tambah Kelulusan Siswa
                        </button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form action="">
                        <div class="d-flex justify-content-end">
                            <?php
                            $get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
                            if (isset($_GET['id_tahunAkd'])) {
                                $id_tahunSelected = $_GET['id_tahunAkd'];
                            } else {
                                $id_tahunSelected = $get_tahunAkd['id_tahunAkd'];
                            }
                            // echo  $id_tahunSelected;
                            ?>
                            <select class="selectpicker form-control" name="id_tahunAkd" data-live-search="true" title="Tahun Akademik" required>
                                <?php while ($row = mysqli_fetch_array($query)) : ?>
                                    <option <?= ($row['id_tahunAkd'] == $id_tahunSelected ? 'selected' : ''); ?> value="<?= $row['id_tahunAkd']; ?>"><?= $row['tahun']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>

            </div>


            <!-- Pesan Toast -->
            <div id="pesan-toast"></div>

            <!-- <div class="toastrDefaultSuccess">
                <p id="isi-pesan">test</p>
            </div> -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pengumuman PSB</h3>
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
                                <th>Status Pengumuman</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        if (isset($_GET['id_tahunAkd'])) {
                            $id_tahunAkd = $_GET['id_tahunAkd'];
                        } else {
                            $id_tahunAkd = $get_tahunAkd['id_tahunAkd'];
                        }
                        $query = mysqli_query($conn, "SELECT * FROM pengumuman_psb INNER JOIN psb_siswa ON pengumuman_psb.id_pendaftaran = psb_siswa.id_pendaftaran INNER JOIN tahun_akademik ON pengumuman_psb.id_tahunAkd = tahun_akademik.id_tahunAkd WHERE pengumuman_psb.id_tahunAkd = $id_tahunAkd ORDER BY id_pengumuman DESC");
                        ?>
                        <tbody id="tabel-Psiswa">
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['no_pendaftaran']; ?></td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td>
                                        <p class="<?= ($row['status_lulus'] == 'lulus' ? 'text-light bg-success rounded text-center' : 'text-light bg-danger rounded text-center'); ?>">
                                            <strong><?= $row['status_lulus']; ?></strong>
                                        </p>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="overlay" id="loader-tabelPsiswa" hidden>
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </section>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info alert-dismissible mb-2">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Info!</h5>
                    <strong> Data calon siswa dibawah berdasarkan data pendaftaran yang valid.</strong><br>
                    Centang data kemudian klik tombol lulus atau tidak lulus
                </div>
                <div class="alert alert-warning alert-dismissible mb-2">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan!</h5>
                    <strong> Data calon siswa yang sudah ditetapkan lulus atatu tidak lulus tidak dapat diupdate lagi!</strong><br>
                    Koreksi data sebaik mungkin
                </div>
                <div class="d-flex justify-content-start mb-2">
                    <button class="btn btn-success p-2">LULUS</button>
                    <button class="btn btn-danger">TIDAK LULUS</button>
                    <button class="btn btn-warning">BELUM DI TETAPKAN</button>
                </div>
                <form action="#" method="POST" id="pengumuman-siswa">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="centang-semua"></th>
                                <th>No</th>
                                <th>No Pendaftaran</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM psb_siswa INNER JOIN program_studi ON psb_siswa.jurusan = program_studi.id_Pstudi INNER JOIN tahun_akademik ON psb_siswa.id_thnAkd = tahun_akademik.id_tahunAkd WHERE psb_siswa.id_thnAkd = '$id_tahunAkd'  AND psb_siswa.status_pendaftaran ='valid' ORDER BY id_pendaftaran DESC");
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <?php
                                $id_pendaftaran = $row['id_pendaftaran'];
                                $get_bg = mysqli_fetch_array(mysqli_query($conn, "SELECT id_pendaftaran,status_lulus FROM pengumuman_psb WHERE id_pendaftaran='$id_pendaftaran'"));
                                if (isset($get_bg)) {
                                    if ($get_bg['status_lulus'] == 'lulus') {
                                        $bg = 'bg-success';
                                    } elseif ($get_bg['status_lulus'] == 'tidak lulus') {
                                        $bg = 'bg-danger';
                                    }
                                } else {
                                    $bg = 'bg-warning';
                                }
                                ?>
                                <tr class="<?= $bg; ?>">
                                    <td><input type="checkbox" class="centangID" name="id_pendaftaran[]" value="<?= $row['id_pendaftaran']; ?>"></td>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['no_pendaftaran']; ?></td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <input type="checkbox" name="status_lulus" id="v-lulus" value="lulus" hidden>
                    <input type="checkbox" name="status_lulus" id="v-tidakLulus" value="tidak lulus" hidden>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-success btn-sm" id="btn-lulus" onclick="return confirm('apakah anda yakin ingin update data?')" name="status">Lulus</button>
                        <button type="submit" class="btn btn-danger btn-sm" id="btn-tidakLulus" onclick="return confirm('apakah anda yakin ingin update data ?')" name="status">Tidak Lulus</button>
                    </div>
                </form>
                <div id="info-status">

                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="reload-data" hidden>Reload Data</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" class="close">Close</button>
            </div>
            <div class="overlay" id="loader-tabel" hidden>
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<?php include '../admin/template/footer.php' ?>