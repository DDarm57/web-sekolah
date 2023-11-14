<ul class="nav">
    <li class=""><a href="index.php">Home</a></li>
    <li class="has-sub">
        <a href="javascript:void(0)">Jurusan</a>
        <ul class="sub-menu">
            <?php
            include 'admin/koneksi.php';
            $queri_jurusan = mysqli_query($conn, "SELECT * FROM program_studi");
            $n = 1;
            while ($s = mysqli_fetch_array($queri_jurusan)) :
            ?>
                <li><a href="detail_jurusan.php?jurusan=<?= $s['nama_studi']; ?>"><?= $s['nama_studi']; ?></a></li>
            <?php endwhile; ?>
        </ul>
    </li>
    <!-- <li class="scroll-to-section"><a href="#courses">Courses</a></li> -->
    <li><a href="berita.php">Semua Berita</a></li>
    <li class="has-sub">
        <a href="javascript:void(0)">Berita</a>
        <ul class="sub-menu">
            <?php
            include 'admin/koneksi.php';
            $queri_Kberita = mysqli_query($conn, "SELECT * FROM kategori_berita");
            $n = 1;
            while ($k = mysqli_fetch_array($queri_Kberita)) :
            ?>
                <li><a href="kategori_berita.php?kategori=<?= $k['id_kategoriBerita']; ?>"><?= $k['nama_kategori']; ?></a></li>
            <?php endwhile; ?>
        </ul>
    </li>
    <li class=""><a href="login_ekstra.php">Ekstrakurikuler</a></li>
    <li class="scroll-to-section"><a href="#contact">Kontak Kami</a></li>
</ul>