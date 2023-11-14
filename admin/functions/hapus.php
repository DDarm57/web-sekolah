<?php

use function PHPSTORM_META\map;

include '../admin/koneksi.php';

function hapus_berita($data)
{
    global $conn;

    $id_berita = $data['id_berita'];

    $get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_berita WHERE id_berita='$id_berita'"));

    mysqli_query($conn, "DELETE FROM data_berita WHERE id_berita='$id_berita'");

    if ($get_data['gambar_berita'] != 'default.jpg') {
        unlink('../admin/gambar/gambar_berita/' . $get_data['gambar_berita']);
    }

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berita berhasil di hapus',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'data_berita.php';
                        }
                    })
                </script>";
    } else {
        echo "<script>
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Data berita gagal di hapus',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'data_berita.php';
                        }
                    })
                </script>";
    }
}

function hapus_Kberita($data)
{
    global $conn;
    $id_kategoriBerita = $data['id_kategoriBerita'];

    $cek_data = mysqli_query($conn, "SELECT * FROM data_berita WHERE id_kategoriBerita='$id_kategoriBerita'");

    if (mysqli_fetch_array($cek_data)) {
        echo "<script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Data gagal di hapus karena ada data berita yang sedang terhubung',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'kategori_berita.php';
                    }
                })
            </script>";
    } else {
        mysqli_query($conn, "DELETE FROM kategori_berita WHERE id_kategoriBerita='$id_kategoriBerita'");
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil di hapus',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'kategori_berita.php';
                        }
                    })
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Data gagal di hapus',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'kategori_berita.php';
                        }
                    })
                </script>";
        }
    }
}

function hapus_studi($data)
{
    global $conn;

    $id_Pstudi = $data['id_Pstudi'];

    $cek_data = mysqli_fetch_array(mysqli_query($conn, "select * from program_studi where id_Pstudi='$id_Pstudi'"));

    $cek_siswa = mysqli_fetch_array(mysqli_query($conn, "select * from psb_siswa where jurusan='$id_Pstudi'"));

    if ($cek_siswa) {
        echo "<script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Data gagal di hapus',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'data_studi.php';
                    }
                })
            </script>";
    } else {
        $cek = mysqli_query($conn, "DELETE from program_studi where id_Pstudi='$id_Pstudi'");
        if ($cek_data['gambar_studi'] != 'default.jpg') {
            unlink('./gambar/' . $cek_data['gambar_studi']);
        }
        echo "<script>
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data berhasil di hapus',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'data_studi.php';
                    }
                })
            </script>";
    }
}

function hapus_galeri($data)
{
    global $conn;
    $id_galeri = $data['id_galeri'];

    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM galeri WHERE id_galeri='$id_galeri'"));

    if ($cek_data['gambar'] != 'default.jpg') {
        unlink('../admin/gambar/galeri/' . $cek_data['gambar']);
    }

    mysqli_query($conn, "DELETE FROM galeri WHERE id_galeri='$id_galeri'");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data berhasil di hapus',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'settings.php';
                    }
                })
            </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Data gagal di hapus',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'settings.php';
                    }
                })
            </script>";
    }
}

function hapus_tahunAkd($data)
{
    global $conn;
    $id_tahunAkd = $data['hapus_tahunAkd'];

    $get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE id_thnAkd='$id_tahunAkd'"));
    $tahun_akd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE id_tahunAkd='$id_tahunAkd'"));
    if ($tahun_akd["status"] == "aktif") {
        echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Tahun akademik sedang aktif silahkan alihkan terlebih dahulu',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'tahun_akademik.php';
                }
            })
        </script>";
    } else {
        if (isset($get_data)) {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data gagal di hapus karena ada data yang sedang terhubung',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'tahun_akademik.php';
                }
            })
        </script>";
        } else {
            mysqli_query($conn, "DELETE FROM tahun_akademik WHERE id_tahunAkd='$id_tahunAkd'");
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data berhasil di hapus',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'tahun_akademik.php';
                            }
                        })
                    </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Data gagal di hapus',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'tahun_akademik.php';
                            }
                        })
                    </script>";
            }
        }
    }
}

function hapus_psbSiswa($data)
{
    global $conn;
    $nisn = $data['nisn'];
    $cek_siswaPsb = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE nisn='$nisn'"));
    if ($cek_siswaPsb) {
        $get_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT id_siswa, nisn FROM data_siswa WHERE nisn='$nisn'"));
        if ($get_siswa) {
            echo "<script>
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'INFO',
                text: 'Data NISN = " . $cek_siswaPsb['nisn'] . " NAMA = " . $cek_siswaPsb['nama_siswa'] . "  terhubung ke dalam data akademik dan data siswa!. Apakah anda yakin ingin menghapus data? Jika yakin klik tombol OK dibawah untuk pergi ke data siswa',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Tidak, Batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval
                    Swal.fire({
                    title: 'Beralih ke data siswa!',
                    html: 'I will close in <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = 'data_siswa.php?id_siswa=" . $get_siswa['id_siswa'] . "';
                    }
                })
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    
                    window.location.href = 'siswa_psb.php';
                }
            })</script>";
        } else {
            $scan_ijazah = $cek_siswaPsb['scan_ijazah'];
            $scan_kk = $cek_siswaPsb['scan_kk'];
            $scan_ktpOrtu = $cek_siswaPsb['scan_ktpOrtu'];
            $scan_nisn = $cek_siswaPsb['scan_nisn'];

            if ($scan_ijazah != 'default.jpg') {
                unlink('../admin/gambar/siswa_psb/' . $scan_ijazah);
            }
            if ($scan_kk != 'default.jpg') {
                unlink('../admin/gambar/siswa_psb/' . $scan_kk);
            }
            if ($scan_ktpOrtu != 'default.jpg') {
                unlink('../admin/gambar/siswa_psb/' . $scan_ktpOrtu);
            }
            if ($scan_nisn != 'default.jpg') {
                unlink('../admin/gambar/siswa_psb/' . $scan_nisn);
            }

            mysqli_query($conn, "DELETE FROM psb_siswa WHERE nisn='$nisn'");

            echo "<script>
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data berhasil di hapus',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'siswa_psb.php';
                        }
                    })
            </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Tidak ada data yang ingin dihapus',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'siswa_psb.php';
            }
        })
    </script>";
    }
}

function hapus_siswa($data)
{
    global $conn;
    $id_siswa = $data['hapus_siswa'];

    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT id_siswa,nisn FROM data_siswa WHERE id_siswa='$id_siswa'"));
    if ($cek_data) {
        //hapus data akademik
        mysqli_query($conn, "DELETE FROM data_akademik WHERE id_siswa='$id_siswa'");
        //hapus data_siswa
        mysqli_query($conn, "DELETE FROM data_siswa WHERE id_siswa='$id_siswa'");

        echo "<script>
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil di hapus',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'data_siswa.php';
                    }
                })
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Tidak ada data yang ingin dihapus',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_siswa.php';
            }
        })
    </script>";
    }
}

function hapus_kelas($data)
{
    global $conn;

    $id_kelas = $data['id_kelas'];

    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_akademik WHERE id_kelas='$id_kelas'"));

    if ($cek_data) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data terhubung dengan data akademik',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_kelas.php';
            }
        })
    </script>";
    } else {
        mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas='$id_kelas'");

        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil di hapus',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'data_kelas.php';
                    }
                })
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data gagal dihapus',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_kelas.php';
                }
            })
        </script>";
        }
    }
}

//EKSTRAKURIKULER

function hapus_kegiatan($data)
{
    global $conn;

    $id_kegiatan = $data['id_kegiatan'];
    var_dump($id_kegiatan);
    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT id_kegiatan FROM ekstrakurikuler WHERE id_kegiatan='$id_kegiatan'"));
    if ($cek_data) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data gagal dihapus karena ada aktifitas di dalamnya',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_kegiatan.php';
            }
        })
    </script>";
    } else {
        mysqli_query($conn, "DELETE FROM data_kegiatan WHERE id_kegiatan='$id_kegiatan'");
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di hapus',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_kegiatan.php';
            }
        })
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data gagal dihapus',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_kegiatan.php';
                }
            })
        </script>";
        }
    }
}

function hapus_pembina($data)
{
    global $conn;

    $id_pembina = $data['id_pembina'];

    $cek_ekstra = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ekstrakurikuler WHERE id_pembina='$id_pembina'"));

    if (isset($cek_ekstra)) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data gagal dihapus data pembina sedang mengajar kegiatan',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_pembina.php';
            }
        })
    </script>";
    } else {
        $get_pembinaUserid = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE id_pembina='$id_pembina'"));

        $pembina_userid = $get_pembinaUserid['pembina_userid'];

        mysqli_query($conn, "DELETE FROM data_pembina WHERE id_pembina='$id_pembina'");
        mysqli_query($conn, "DELETE FROM users WHERE id_user='$pembina_userid'");

        if ($get_pembinaUserid['gambar_pembina'] != 'default.jpg') {
            $gambar_pembina = $get_pembinaUserid['gambar_pembina'];
            unlink('../admin/gambar/siswa_psb/' . $gambar_pembina);
        }

        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di hapus',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_pembina.php';
            }
        })
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data gagal dihapus',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_pembina.php';
                }
            })
        </script>";
        }
    }
}
