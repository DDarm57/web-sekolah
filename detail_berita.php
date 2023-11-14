<?php include 'template_blog/header_blog.php' ?>
<!-- ***** Header Area End ***** -->

<?php
include 'admin/koneksi.php';
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

  // variabel pecahkan 0 = tahun
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tanggal

  return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

$id_berita = $_GET['berita'];
$get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_berita INNER JOIN kategori_berita ON data_berita.id_kategoriBerita = kategori_berita.id_kategoriBerita WHERE id_berita='$id_berita'"))


?>

<section class="heading-page header-text" id="top">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h6><?= $get_data['nama_kategori']; ?></h6>
        <h2><?= $get_data['judul_berita']; ?></h2>
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
            <div class="meeting-single-item">
              <div class="thumb">
                <div class="price">
                  <span><?= $get_data['nama_kategori']; ?></span>
                </div>
                <div class="date">
                  <h6><?= date('M', strtotime($get_data['tgl_publish'])); ?> <span><?= date('d', strtotime($get_data['tgl_publish'])); ?></span></h6>
                </div>
                <a href="#"><img src="admin/gambar/gambar_berita/<?= $get_data['gambar_berita']; ?>" alt=""></a>
              </div>
              <div class="down-content">
                <a href="#">
                  <h4><?= $get_data['judul_berita']; ?></h4>
                </a>
                <p>SMK MIFTAHUL ULUM, <?= tgl_indo($get_data['tgl_publish']); ?> , Sampang</p>
                <p class="mt-4">
                  <?= $get_data['deskripsi_berita']; ?>
                </p>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="hours">
                      <h5>Tanggal</h5>
                      <p>Di Publish Pada jam : <?= date('H : i', strtotime($get_data['created_at'])); ?> <br>Di Update Pada Jam: <?= date('H : i', strtotime($get_data['updated_at'])); ?></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="location">
                      <h5>Lokasi/Tanggal</h5>
                      <p>Dusun Tlotok, Tlotok, Pakalongan,
                        <br>Sampang - <?= date('Y-m-d', strtotime($get_data['created_at'])); ?>
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="share">
                      <h5>Share:</h5>
                      <ul>
                        <li>
                          <div class="fb-share-button" data-href="detail_berita.php?berita=<?= $get_data['id_berita']; ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a></div>
                        </li>
                        <li>
                          <a class="text-success" href="https://api.whatsapp.com/send?phone=whatsappphonenumber&text=detail_berita.php?berita=<?= $get_data['id_berita']; ?>" target="__blank"><i class="fab fa-whatsapp-square"></i>Whatsapp</a>
                        </li>
                        <li><a href="http://www.twitter.com/share?url=detail_berita.php?berita=<?= $get_data['id_berita']; ?>" target="__blank"><i class="fab fa-twitter"></i> Twitter</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="main-button-red">
              <a href="berita.php">Kembali Ke Berita</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'template_blog/footer_blog.php' ?>