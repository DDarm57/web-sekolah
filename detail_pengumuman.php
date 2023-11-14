<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">

    <title>Detail Pendaftaran</title>
</head>

<body>
    <?php include 'template_pendaftaran/navbar.php'; ?>
    <div class="container">
        <?php
        include 'admin/koneksi.php';
        // tahun akademik aktif
        $get_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
        $id_thnAkd = $get_thnAkd['id_tahunAkd'];
        $cekdata = mysqli_query($conn, "SELECT status FROM psb WHERE status='aktif'");
        ?>
        <?php if (!mysqli_fetch_array($cekdata)) : ?>
            <h3 class="mt-4 text-center">Pengumuman Pendaftaran Siswa Baru Telah Di Tutup</h3>
        <?php else : ?>
            <?php if ($get_thnAkd['status'] == 'aktif') : ?>
                <h3 class="mt-4">Pengumuman Kelulusan Calon Siswa</h3>
                <div class="card mt-2">
                    <div class="card-header bg-warning">Data Calon Siswa</div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-hover">
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
                            include 'admin/koneksi.php';
                            $query = mysqli_query($conn, "SELECT * FROM pengumuman_psb INNER JOIN psb_siswa ON pengumuman_psb.id_pendaftaran = psb_siswa.id_pendaftaran WHERE id_tahunAkd='$id_thnAkd'"); ?>
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
                </div>
            <?php else : ?>
                <h3 class="mt-4 text-center">Pengumuman Pendaftaran Siswa Baru Belum Dibuka</h3>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>