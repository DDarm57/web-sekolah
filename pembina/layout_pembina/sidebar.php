 <!-- Divider -->
 <hr class="sidebar-divider my-0">

 <!-- Nav Item - Dashboard -->
 <li class="nav-item active">
     <a class="nav-link" href="dashboard.php">
         <i class="fas fa-fw fa-tachometer-alt"></i>
         <span>Dashboard</span></a>
 </li>


 <!-- Divider -->
 <hr class="sidebar-divider">

 <!-- Heading -->
 <div class="sidebar-heading">
     Siswa
 </div>

 <!-- Nav Item - data siswa -->
 <li class="nav-item">
     <a class="nav-link" href="data_siswa.php">
         <i class="fas fa-fw fa-user"></i>
         <span>Data Siswa</span></a>
 </li>

 <!-- Nav Item - jadwal -->
 <li class="nav-item">
     <a class="nav-link" href="jadwal_kegiatan.php">
         <i class="fas fa-fw fa-calendar"></i>
         <span>Jadwal Kegiatan</span></a>
 </li>

 <?php
    include '../pembina/koneksi.php';
    $id_kegiatan = $get_pembina['mengajar_kegiatan'];
    $count_nilaiValidasi = mysqli_num_rows(mysqli_query($conn, "SELECT status_validasi FROM ekstrakurikuler WHERE id_kegiatan='$id_kegiatan' AND status_validasi='validasi nilai'"));
    ?>
 <!-- Nav Item - nilai -->
 <li class="nav-item">
     <a class="nav-link" href="nilai_kegiatan.php">
         <i class="fas fa-fw fa-table"></i>
         <span>Nilai Kegiatan </span>
     </a>

 </li>

 <!-- Nav Item - validasi nilai -->
 <li class="nav-item">
     <a class="nav-link" href="validasi_nilai.php">
         <i class="fas fa-fw fa-check"></i>
         <span>Validasi Nilai <?= ($count_nilaiValidasi > 0 ? '<strong class="bg-danger rounded">' . $count_nilaiValidasi . '</strong>' : ''); ?></span></a>
 </li>

 <!-- Nav Item - profil -->
 <li class="nav-item">
     <a class="nav-link" href="profile.php">
         <i class="fas fa-fw fa-user-cog"></i>
         <span>Profil</span></a>
 </li>

 <!-- Divider -->
 <hr class="sidebar-divider d-none d-md-block">