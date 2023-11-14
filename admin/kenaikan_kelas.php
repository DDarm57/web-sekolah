<?php include '../admin/template/header.php' ?>

<?php include '../admin/koneksi.php'; ?>
<?php
if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];
    $tahun = $_GET['tahun'];
    $get_namaKelas = mysqli_fetch_array(mysqli_query($conn, "SELECT id_kelas,nama_kelas FROM kelas WHERE id_kelas='$id_kelas'"));
    $nama_kelas = $get_namaKelas['nama_kelas'];
} else {
    $id_kelas = 0;
    $tahun = date('Y');
    $nama_kelas = "";
}

if (isset($_POST['naik_kelas'])) {
    require '../admin/functions/update.php';
    naik_kelas($_POST);
} elseif (isset($_POST['tidak_naik'])) {
    var_dump("Tidak Naik");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Atur Kenaikan Kelas Siswa <?= $nama_kelas; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Atur Kenaikan Kelas Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    $get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="bg-secondary p-2 rounded">TAHUN AKADEMIK AKTIF SEKARANG : <?= $get_tahunAkd['tahun']; ?></h4>
                </div>
            </div>
            <div class="alert alert-warning alert-dismissible">
                <h5 class="blink"><i class="icon fas fa-exclamation-triangle"></i>PERINGATAN !</h5>
                <h5>ATUR KENAIKAN KELAS DIMULAI DARI KELAS SISWA TERTINGGI AGAR DATA TIDAK TERTIMPA DARI SISWA KELAS SEBELUMNYA.</h5>
            </div>
            <div class="alert alert-light alert-dismissible">
                <h5><i class="icon fas fa-exclamation-triangle"></i>INFO !</h5>
                <h5>PENGGUNAAN :</h5>
                <hr>
                <h6>PILIH KELAS DI ATAS UTAMAKAN UPDATE DARI KELAS TERTINGGI, KEMUDIAN CENTANG DATA SISWA SESUAI DENGAN YANG DI UPDATE DAN TENTUKAN DI BAGIAN BAWAH TOMBOL <strong class="bg-success px-2 rounded">NAIK KELAS</strong> ATAU <strong class="bg-danger px-2 rounded">TIDAK NAIK KELAS</strong>. <br> SISTEM AKAN OTOMATIS MENGUPDATE DATA CONTOH : <br> JIKA KELAS X MAKA AKAN NAIK KE KELAS XI BEGITU JUGA KELAS XI NAIK KE KELAS XII DAN JIKA KELAS XII MAKA SISWA AKAN DI UPDATE DENGN STATUS LULUS DAN TIDAK AKAN DI TAMBAHKAN KEMBALI DI BAGIAN DATA AKADEMIK.</h6>
            </div>
            <form action="" method="get">
                <div class="row">
                    <div class="col-sm-6 col-6">
                        <label for="">Kelas</label>
                        <div class="input-group mb-3">
                            <?php $query_kelas = mysqli_query($conn, "SELECT * FROM kelas"); ?>
                            <select name="id_kelas" class="selectpicker form-control" title="Silahkan Pilih Kelas Terlebih Dahulu">
                                <?php foreach ($query_kelas as $row) : ?>
                                    <option <?= ($id_kelas == $row['id_kelas'] ? "selected" : ""); ?> value="<?= $row['id_kelas']; ?>"><?= $row['nama_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-6">
                        <label for="">Tahun</label>
                        <div class="input-group mb-3">
                            <select name="tahun" class="selectpicker form-control" title="Tahun">
                                <?php for ($i = 0; $i < 10; $i++) : ?>
                                    <?php $tahun_dipilih  = '202' . $i; ?>
                                    <option <?= ($tahun == $tahun_dipilih ? "selected" : ''); ?> value="202<?= $i; ?>">202<?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kelas <?= $nama_kelas; ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" method="post">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="" id="centang-semua"></th>
                                    <th>NO</th>
                                    <th>NISN</th>
                                    <th>NAMA SISWA</th>
                                    <th>KELAS</th>
                                    <th>JURUSAN</th>
                                </tr>
                            </thead>
                            <?php
                            $query_akademik = mysqli_query($conn, "SELECT * FROM data_akademik INNER JOIN tahun_akademik ON tahun_akademik.id_tahunAkd = data_akademik.id_thnAkd INNER JOIN data_siswa ON data_siswa.id_siswa = data_akademik.id_siswa INNER JOIN kelas ON kelas.id_kelas = data_akademik.id_kelas INNER JOIN program_studi ON program_studi.id_Pstudi = data_akademik.id_Pstudi WHERE kelas.id_kelas = '$id_kelas' AND tahun_akademik.status = 'aktif' AND data_akademik.bulan_tahun LIKE '$tahun%'");
                            ?>
                            <tbody>
                                <?php $n = 1;
                                while ($row = mysqli_fetch_array($query_akademik)) : ?>
                                    <tr>
                                        <td><input type="checkbox" name="id_siswa[]" class="centangID" value="<?= $row['id_siswa']; ?>"></td>
                                        <td><?= $n++; ?></td>
                                        <td><?= $row['nisn']; ?></td>
                                        <td><?= $row['nama_siswa']; ?></td>
                                        <td>KELAS <?= $row['nama_kelas']; ?></td>
                                        <td><?= $row['nama_studi']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start">
                            <button class="btn btn-sm btn-success" type="submit" onclick="return confirm('atur kenaikan kelas ?')" name="naik_kelas"><?= ($nama_kelas == "XII" ? "LULUS" : "NAIK KELAS"); ?></button>
                            <div class="px-2">
                                <button class="btn btn-sm btn-danger" onclick="return confirm('atur tidak naik kelas ?')" name="tidak_naik"><?= ($nama_kelas == "XII" ? "TIDAK LULUS" : "TIDAK NAIK KELAS"); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </section>
</div>


<?php include '../admin/template/footer.php' ?>