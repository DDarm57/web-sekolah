<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQONxEjHvJHloJFBH8jWYZDs_-IsdrN7SWHVw&usqp=CAU" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#"><?php echo $_SESSION['user_name'] ?></a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="data_studi.php" class="nav-link">
                    <i class="nav-icon fas fa-school"></i>
                    <p>
                        Program Studi
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        PSB Siswa
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="siswa_psb.php" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Data Siswa PSB
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pengumuman_psb.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Pengumuman PSB
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <?php
                //cari siswa yang belum mendapatkan kelas
                include '../admin/koneksi.php';
                $get_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_siswa WHERE status = 'no_kelas'"));
                ?>
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Siswa
                        <i class="right fas fa-angle-left"></i>
                        <?php if ($get_siswa > 0) : ?>
                            <span class="badge badge-danger right"><?= $get_siswa; ?></span>
                        <?php endif; ?>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="data_siswa.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <?php if ($get_siswa > 0) : ?>
                                <span class="badge badge-danger right"><?= $get_siswa; ?></span>
                            <?php endif; ?>
                            <p>
                                Data Siswa
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="data_kelas.php" class="nav-link">
                            <i class="nav-icon fas fa-school"></i>
                            <p>
                                Data Kelas
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="data_alumni.php" class="nav-link">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Data Alumni
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Ekstrakurikuler
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="data_kegiatan.php" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Data Kegiatan
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="data_pembina.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Data Pembina
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
            $tahun_sekarang = date("Y");
            $query = mysqli_query($conn, "SELECT * FROM tahun_akademik ORDER BY id_tahunAkd DESC");
            $get_tahunAkd = mysqli_fetch_array($query);
            $tahun_akd = substr($get_tahunAkd['tahun'], 5);
            ?>
            <li class="nav-item">
                <a href="tahun_akademik.php" class="nav-link">
                    <i class="nav-icon fas fa-calendar-week"></i>
                    <?php if ($get_siswa > 0) : ?>
                        <span class="badge badge-danger right"><?= $get_siswa; ?></span>
                    <?php endif; ?>
                    <p>
                        Tahun Akademik <br>
                        <?php if ($tahun_sekarang > $tahun_akd) : ?>
                            <p class="bg-danger rounded blink">Tahun Perlu Di tambah</p>
                        <?php endif; ?>
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Berita
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="data_berita.php" class="nav-link">
                            <i class="far fa-newspaper nav-icon"></i>
                            <p>Data Berita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="kategori_berita.php" class="nav-link">
                            <i class="fas fa-list nav-icon"></i>
                            <p>Kategori Berita</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="settings.php" class="nav-link" id="setting">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        Settings
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="data_pesan.php" class="nav-link">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>
                        Data Pesan
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link" id="logout">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>