<?php include 'template_blog/header_blog.php' ?>

<section class="heading-page header-text" id="top">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2>Semua Berita</h2>
      </div>
    </div>
  </div>
</section>

<section class="meetings-page" id="meetings">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <!-- <div class="filters">
              <ul>
                <li data-filter="*" class="active">Semua Berita</li>
                <li data-filter=".soon">Soon</li>
                <li data-filter=".imp">Important</li>
                <li data-filter=".att">Attractive</li>
              </ul>
            </div> -->
          </div>
          <div class="col-lg-12">
            <div class="row grid">
              <?php
              include 'admin/koneksi.php';
              $batas = 9;
              $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
              $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

              $previous = $halaman - 1;
              $next = $halaman + 1;

              $data = mysqli_query($conn, "SELECT * FROM data_berita");
              $jumlah_data = mysqli_num_rows($data);
              $total_halaman = ceil($jumlah_data / $batas);

              $queri_berita = mysqli_query($conn, "SELECT * FROM data_berita INNER JOIN kategori_berita ON data_berita.id_kategoriBerita = kategori_berita.id_kategoriBerita ORDER BY id_berita DESC LIMIT $halaman_awal,$batas");
              var_dump($halaman_awal);
              $n = $halaman_awal + 1;
              while ($b = mysqli_fetch_array($queri_berita)) :
              ?>
                <div class="col-lg-4 templatemo-item-col all soon">

                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span><?= $b['nama_kategori']; ?> </span>
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
          <div class="col-lg-12">
            <div class="pagination">
              <ul>
                <?php if ($halaman > 1) : ?>
                  <li><a href="?halaman=<?= $previous; ?>"><i class="fa fa-angle-left"></i></a></li>
                <?php else : ?>
                  <li><a><i class="fa fa-angle-left"></i></a></li>
                <?php endif; ?>
                <?php for ($x = 1; $x <= $total_halaman; $x++) : ?>
                  <li class="<?= ($halaman == $x ? 'active' : ''); ?>"><a href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php endfor; ?>
                <?php if ($halaman < $total_halaman) : ?>
                  <li><a href="?halaman=<?= $next; ?>"><i class="fa fa-angle-right"></i></a></li>
                <?php else : ?>
                  <li><a><i class="fa fa-angle-right"></i></a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'template_blog/footer_blog.php' ?>