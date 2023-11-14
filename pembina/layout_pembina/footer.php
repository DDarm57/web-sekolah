</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Cek kembali data. Klik tombol logout jika yakin ingin keluar.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../pembina/logout_pembina.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../pembina/assets/vendor/jquery/jquery.min.js"></script>
<script src="../pembina/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../pembina/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../pembina/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../pembina/assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../pembina/assets/js/demo/chart-area-demo.js"></script>
<script src="../pembina/assets/js/demo/chart-pie-demo.js"></script>
<script src="../pembina/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../pembina/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../pembina/assets/js/demo/datatables-demo.js"></script>
<script>
    //FUNGSI HAPUS
    $(document).ready(function() {
        $(document).ready(() => {
            $("#file_image").change(function() {
                const file = this.files[0];
                let imageName = file.name;
                var ext = file.name.split(".").pop().toLowerCase();
                if ($.inArray(ext, ["gif", "png", "jpg", "jpeg"]) == -1) {
                    Swal.fire({
                        title: "Gagal",
                        text: "Extensi bukan gambar",
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "OK",
                    });
                    if ($("#file_image").val() != null) {
                        $("#file_image").val("");
                    }
                } else {
                    if (file) {
                        let reader = new FileReader();
                        $(".custom-file-label").text(imageName);
                        reader.onload = function(event) {
                            console.log(event.target.result);
                            $(".modal-body #imgPreview").attr("src", event.target.result);
                            $("#imgPreview").attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        });

        $(document).on("click", ".hapus", function(e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Hapus Data',
                text: "Apakah anda yakin ingin menghapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Data!',
                cancelButtonText: 'Tidak, Batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $(this).attr('href');
                    let timerInterval
                    Swal.fire({
                        title: 'Loading',
                        html: 'Sedang mengecek status data',
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
                            window.location.href = url;
                        }
                    })
                    // setTimeout(function() {

                    // }, 2000);
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Simpan data sebaik mungkin :)',
                        'error'
                    )
                }
            })
        })

        $(document).on("click", ".validasi", function(e) {
            e.preventDefault(e);
            Swal.fire({
                title: 'Validasi Data',
                text: "Validasi Data Sekarang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Validasi Sekarang',
                cancelButtonText: 'Tidak, Batal!',
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $(this).attr('href');
                    let timerInterval
                    Swal.fire({
                        title: 'Loading',
                        html: 'Sedangan Memvalidasi Data',
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
                            window.location.href = url;
                        }
                    })
                }
            })
        })
        //UPDATE FORM KEGIATAN
        $(document).on("click", ".edit-nilai", function(e) {
            e.preventDefault();
            $(".modal-body .id_nilai").val($(this).data("id_nilai"));
            $(".modal-body .nama").text($(this).data("nama_siswa"));
            $(".modal-body .materi").text($(this).data("materi_jadwal"));
            $(".modal-body .tanggal").text($(this).data("tanggal"));
            $(".modal-body .nilai").val($(this).data("nilai"));
        })

        $(document).on("click", ".edit-jadwal", function(e) {
            e.preventDefault();
            $(".modal-body .id_jadwal").val($(this).data("id_jadwal"));
            $(".modal-body #tanggal").val($(this).data("tanggal"));
            $(".modal-body #waktu").val($(this).data("waktu"));
            $(".modal-body #materi").val($(this).data("materi"));
            $(".modal-body #keterangan").val($(this).data("keterangan"));
        })
    })
</script>

</body>

</html>