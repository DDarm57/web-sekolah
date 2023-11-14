<?php include 'template_blog/header_blog.php' ?>
<!-- ***** Header Area End ***** -->

<!-- ***** Main Banner Area Start ***** -->
<section class="section main-banner" id="top" data-section="section1">
  <video autoplay muted loop id="bg-video">
    <source src="assets/images/course-video.mp4" type="video/mp4" />
  </video>

  <div class="video-overlay header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="caption">
            <h2>Selamat Datang</h2>
            <p>Selamat datang di WEB Sekolah SMK MIFTAHUL ULUM SAMPANG</p>
            <div class="main-button-red">
              <div class=""><a href="profil_sekolah.php">PROFIL SEKOLAH</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ***** Main Banner Area End ***** -->
<?php
include 'admin/koneksi.php';
if (isset($_GET['berita'])) {
  $id_berita = $_GET['berita'];
  $get_lastView = mysqli_fetch_array(mysqli_query($conn, "SELECT view FROM data_berita WHERE id_berita='$id_berita'"));
  $viewPlus = $get_lastView['view'] + 1;
  mysqli_query($conn, "UPDATE data_berita SET view='$viewPlus' WHERE id_berita='$id_berita'");
  echo '<script>
  window.location.href = "detail_berita.php?berita=' . $id_berita . '";
  </script>';
} ?>
<section class="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="owl-service-item owl-carousel">
          <?php
          include 'admin/koneksi.php';
          $queri_jurusan = mysqli_query($conn, "SELECT * FROM program_studi");
          $n = 1;
          while ($s = mysqli_fetch_array($queri_jurusan)) :
          ?>
            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-01.png" alt="">
              </div>
              <div class="down-content">
                <h4><?= $s['nama_studi']; ?></h4>
                <p><?= $s['deskripsi_studi']; ?></p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="upcoming-meetings" id="meetings">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Berita Sekolah</h2>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="categories">
          <h4>Kategori Berita</h4>
          <ul>
            <?php
            include 'admin/koneksi.php';
            $queri_Kberita = mysqli_query($conn, "SELECT * FROM kategori_berita");
            $n = 1;
            while ($k = mysqli_fetch_array($queri_Kberita)) :
            ?>
              <li><a href="#"><?= $k['nama_kategori']; ?></a></li>
            <?php endwhile; ?>
          </ul>
          <!-- <div class="main-button-red">
              <a href="meetings.html">All Upcoming Meetings</a>
            </div> -->
        </div>
        <?php
        include 'admin/koneksi.php';
        $kepsek = mysqli_fetch_array(mysqli_query($conn, "SELECT kepala_sekolah, gmb_kepSek FROM profil_sekolah"));
        ?>
        <div class="categories mt-2">
          <h4>Kepala Sekolah :</h4>
          <div class="d-flex justify-content-center">
            <img src="admin/gambar/<?= $kepsek['gmb_kepSek']; ?>" alt="" class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
          </div>
          <div class="d-flex justify-content-center mt-4">
            <h4><?= $kepsek['kepala_sekolah']; ?></h4>
          </div>
          <!-- <div class="main-button-red">
              <a href="meetings.html">All Upcoming Meetings</a>
            </div> -->
        </div>
      </div>

      <div class="col-lg-8">
        <div class="row">
          <?php
          include 'admin/koneksi.php';

          $queri_berita = mysqli_query($conn, "SELECT * FROM data_berita INNER JOIN kategori_berita ON data_berita.id_kategoriBerita = kategori_berita.id_kategoriBerita ORDER BY id_berita DESC LIMIT 4");
          $n = 1;
          while ($b = mysqli_fetch_array($queri_berita)) :
          ?>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                  <div class="price">
                    <span><?= $b['nama_kategori']; ?></span>
                  </div>
                  <a href="index.php?berita=<?= $b['id_berita']; ?>"><img src="admin/gambar/gambar_berita/<?= $b['gambar_berita']; ?>" alt="New Lecturer Meeting"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6><?= date('M', strtotime($b['tgl_publish'])); ?> <span><?= date('d', strtotime($b['tgl_publish'])); ?></span></h6>
                  </div>
                  <a href="index.php?berita=<?= $b['id_berita']; ?>">
                    <h4><?= $b['judul_berita']; ?></h4>
                  </a>
                  <div class="desk">
                    <td>
                      <div class="text">
                        <?= $b['deskripsi_berita']; ?>
                      </div>
                    </td>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="apply-now" id="apply">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="row">
          <?php
          include 'admin/koneksi.php';
          $get_psb = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb"));
          ?>
          <div class="col-lg-12">
            <div class="item">
              <h3>Pendaftaran Siswa Baru</h3>
              <p><?= $get_psb['deskripsi']; ?></p>
              <div class="main-button-red">
                <div class="">
                  <a href="detail_pendaftaran.php">Detail Pendaftaran</a>
                </div>
              </div>
            </div>
          </div>
          <?php
          $pengumuman = mysqli_fetch_array(mysqli_query($conn, "SELECT tgl_pengumuman FROM psb"));
          if ($pengumuman['tgl_pengumuman'] <= date('Y-m-d')) {
          ?>
            <div class="col-lg-12">
              <div class="item">
                <h3>PENGUMUMAN PENDAFTARAN SISWA BARU</h3>
                <p>Pengumuman pendaftaran telah di buka silahkan cek kelulusan calon siswa di bagian detail pengumuman</p>
                <div class="main-button-yellow">
                  <div><a href="detail_pengumuman.php">Detail Pengumuman</a></div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <?php
      include 'admin/koneksi.php';
      $alamat_sekolah = mysqli_fetch_array(mysqli_query($conn, "SELECT alamat_sekolah FROM profil_sekolah limit 1"));
      ?>
      <div class="col-lg-6">
        <div class="accordions is-first-expanded">
          <article class="accordion">
            <div class="accordion-head">
              <span>Alamat Sekolah</span>
              <span class="icon">
                <i class="icon fa fa-chevron-right"></i>
              </span>
            </div>
            <div class="accordion-body">
              <div class="content">
                <p><?= $alamat_sekolah['alamat_sekolah']; ?></p>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <h1 class="fw-light text-center text-lg-start mt-4 mb-0">Galeri</h1>

    <hr class="mt-2 mb-5">

    <div class="row text-center text-lg-start">

      <?php
      include 'admin/koneksi.php';
      $query_galeri = mysqli_query($conn, "SELECT * FROM galeri");
      ?>
      <?php while ($galery = mysqli_fetch_array($query_galeri)) : ?>
        <div class="col-lg-3 col-md-4 col-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="admin/gambar/galeri/<?= $galery['gambar']; ?>" alt="" style="width: 250px; height: 250px; object-fit: cover;">
          </a>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<section class="our-courses" id="courses">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Berita Populer</h2>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="owl-courses-item owl-carousel">
          <?php
          include 'admin/koneksi.php';
          $b_populer = mysqli_query($conn, "SELECT * FROM data_berita INNER JOIN kategori_berita ON data_berita.id_kategoriBerita = kategori_berita.id_kategoriBerita ORDER BY view DESC LIMIT 7");
          while ($p = mysqli_fetch_array($b_populer)) :
          ?>
            <div class="item">
              <img src="admin/gambar/gambar_berita/<?= $p['gambar_berita']; ?>" alt="" class="img-thumbnail">
              <div class="down-content">
                <h4><?= $p['judul_berita']; ?></h4>
                <div class="info">
                  <div class="text">
                    <?= $p['deskripsi_berita']; ?>
                  </div>
                  <div class="d-flex justify-content-around">
                    <div class="">
                      <ul>
                        <a href="index.php?berita=<?= $p['id_berita']; ?>" class="btn btn-sm btn-primary">Detail...</a>
                      </ul>
                    </div>
                    <div class="">
                      <span><?= $p['nama_kategori']; ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="our-facts">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-12">
            <h2>A Few Facts About Our University</h2>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-12">
                <div class="count-area-content">
                  <?php
                  include 'admin/koneksi.php';
                  $count_jurusan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM program_studi"));
                  $count_Kberita = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kategori_berita"));
                  $count_berita = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_berita"));
                  ?>
                  <div class="count-digit"><?= $count_jurusan; ?></div>
                  <div class="count-title">Jumlah Jurusan</div>
                </div>
              </div>
              <div class="col-12">
                <div class="count-area-content">
                  <div class="count-digit"><?= $count_Kberita; ?></div>
                  <div class="count-title">Jumlah Kategori Berita</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-12">
                <div class="count-area-content new-students">
                  <div class="count-digit"><?= $count_berita; ?></div>
                  <div class="count-title">Jumlah Berita</div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 align-self-center">
        <div class="video">
          <a href="https://www.youtube.com/watch?v=HndV87XpkWg" target="_blank"><img src="assets/images/play-icon.png" alt=""></a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="contact-us" id="contac">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 align-self-center">
        <form action="ajax_process/process_pesan.php" method="post" id="contact">
          <div class="row">
            <div class="col-lg-12">
              <h2>Kontak Admin</h2>
            </div>
            <div id="info" class="mb-2">
            </div>
            <div class="col-lg-4">
              <fieldset>
                <input name="name" type="text" id="name" placeholder="NAMA" required="">
              </fieldset>
            </div>
            <div class="col-lg-4">
              <fieldset>
                <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="EMIL" required="">
              </fieldset>
            </div>
            <div class="col-lg-4">
              <fieldset>
                <input name="subject" type="text" id="subject" placeholder="SUBJEK" required="">
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <textarea name="message" type="text" class="form-control" id="message" placeholder="PESAN ANDA" required=""></textarea>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <button type="submit" id="form-submit">KIRIM PESAN SEKARANG</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php include 'template_blog/footer_blog.php' ?>