<?php include "../pembina/layout_pembina/header.php" ?>
<?php
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $bulan[(int)$pecahkan[1]];
}
include '../admin/koneksi.php';
$kegiatan = $get_pembina['mengajar_kegiatan'];
$query = mysqli_query($conn, "SELECT * FROM tahun_akademik");
$get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
if (isset($_GET['id_tahunAkd'])) {
    $id_tahunSelected = $_GET['id_tahunAkd'];
} else {
    $id_tahunSelected = $get_tahunAkd['id_tahunAkd'];
}

if (isset($_POST['update_nilai'])) {
    require '../pembina/pembina_controller/update.php';
    update_nilai($_POST);
}

if (isset($_GET['bulan'])) {
    $bulan = $_GET['bulan'];
} else {
    $bulan = date('Y-m');
}
$query_jadwal = mysqli_query($conn, "SELECT * FROM jadwal_ekstra WHERE id_kegiatan='$kegiatan' AND tanggal LIKE '$bulan%'");
$get_idJadwal = mysqli_fetch_array($query_jadwal);
$query_nilai = mysqli_query($conn, "SELECT * FROM nilai_ekstra LEFT JOIN jadwal_ekstra on jadwal_ekstra.id_jadwal = nilai_ekstra.id_jadwal WHERE jadwal_ekstra.id_kegiatan = '$kegiatan' AND jadwal_ekstra.tanggal LIKE '$bulan%'");
$query_jdwl = mysqli_query($conn, "SELECT * FROM jadwal_ekstra WHERE id_kegiatan='$kegiatan' AND tanggal LIKE '$bulan%'");
$jumlah_jadwal = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jadwal_ekstra WHERE id_kegiatan='$kegiatan' AND tanggal LIKE '$bulan%'"));
?>


<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nilai Kegiatan</h1>
        <p class="d-none d-sm-inline-block"><a href="dashboard.php">Dashboard</a> / <strong>Jadwal Kegiatan</strong></p>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="month" name="bulan" id="" class="form-control" value="<?= $bulan; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                        <a href="pdf/nilai_jadwal.php?bulan=<?= $bulan; ?>" class="btn btn-outline-danger"><i class="fas fa-download"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">Nama</th>
                            <th rowspan="2" style="text-align: center; vertical-align: middle;">Kelas</th>
                            <th colspan="<?= $jumlah_jadwal; ?>" style="text-align: center; vertical-align: middle;"><?= Tgl_indo($bulan); ?></th>
                        </tr>
                        <tr>
                            <?php if ($query_jadwal != null) : ?>
                                <?php foreach ($query_jadwal as $jadwal) : ?>
                                    <?php $tgl = date('d', strtotime($jadwal['tanggal'])) ?>
                                    <th class="text-center"><?= $tgl; ?></th>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (mysqli_num_rows($query_jadwal) == 0) : ?>
                                <th>Tidak ada jadwal</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $id_tahunAkd = $_GET['id_tahunAkd'];
                        $query = mysqli_query($conn, "SELECT * FROM ekstrakurikuler 
                        INNER JOIN data_siswa ON data_siswa.id_siswa = ekstrakurikuler.id_siswa 
                        INNER JOIN data_akademik ON data_akademik.id_siswa = data_siswa.id_siswa
                        INNER JOIN kelas ON kelas.id_kelas = data_akademik.id_kelas 
                        WHERE id_kegiatan = '$kegiatan'");
                        ?>
                        <?php $n = 1;
                        while ($row = mysqli_fetch_array($query)) : ?>
                            <?php
                            $id_siswa = $row["id_siswa"];
                            $cek_nilai = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jadwal_ekstra
                            INNER JOIN nilai_ekstra ON nilai_ekstra.id_jadwal = jadwal_ekstra.id_jadwal
                            WHERE id_siswa = '$id_siswa' AND tanggal LIKE '$bulan%'
                            "));
                            ?>
                            <tr>
                                <?php if ($cek_nilai) : ?>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td><?= $row['nama_kelas']; ?></td>
                                <?php else : ?>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <?php if (mysqli_num_rows($query_nilai) == 0) : ?>
                                    <td>Tidak Ada Jadwal</td>
                                <?php elseif ($row['status_validasi'] == 'validasi nilai') : ?>
                                    <?php
                                    $jml_jadwal = mysqli_num_rows($query_jdwl);
                                    for ($i = 0; $i <= $jml_jadwal; $i++) {
                                        echo '<td class="text-danger">Nilai Belum Divalidasi</td>';
                                    }
                                    ?>
                                <?php elseif (mysqli_num_rows($query_nilai) > 0) : ?>
                                    <?php foreach ($query_nilai as $nilai) : ?>
                                        <?php if ($row['id_siswa'] != $nilai['id_siswa']) : ?>
                                            <?php continue; ?>
                                        <?php else : ?>
                                            <td class="text-center">
                                                <div class="input-group">
                                                    <input type="number" class="form-control bg-light border-0 small nilai" value="<?= $nilai['nilai']; ?>" readonly>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary edit-nilai" type="button" data-toggle="modal" data-target="#exampleModal" data-id_nilai="<?= $nilai['id_nilai']; ?>" data-nama_siswa="<?= $row['nama_siswa']; ?>" data-materi_jadwal="<?= $nilai['materi']; ?>" data-tanggal="<?= $nilai['tanggal']; ?>" data-nilai="<?= $nilai['nilai']; ?>">
                                                            <i class="fas fa-pen fa-sm"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">EDIT NILAI KEGIATAN</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_nilai" class="id_nilai">
                    <div class="alert alert-info">
                        <i class="fas fa-info"></i> Pastikan Materi dan Tanggal Jadwal Benar
                    </div>
                    <div class="d-flex justify-content-center">
                        <h4 class="p-2"><i class="fas fa-user"></i></h4>
                        <h4 class="p-2">|</h4>
                        <h4 class="nama p-2"></h4>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-header">
                            Jadwal
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>
                                        <h6>Materi</h6>
                                    </td>
                                    <td>
                                        <h6 class="px-2">:</h6>
                                    </td>
                                    <td>
                                        <h6 class="materi"></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h6>Tanggal</h6>
                                    </td>
                                    <td>
                                        <h6 class="px-2">:</h6>
                                    </td>
                                    <td>
                                        <h6 class="tanggal"></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h6>Input Nilai</h6>
                                    </td>
                                    <td>
                                        <h6 class="px-2">:</h6>
                                    </td>
                                    <td>
                                        <h6><input type="number" name="nilai" class="form-control form-control-sm nilai"></h6>
                                    </td>
                                </tr>
                            </table>
                            <button class="btn btn-sm btn-primary mt-2" type="submit" name="update_nilai">Update Nilai</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<?php include "../pembina/layout_pembina/footer.php" ?>