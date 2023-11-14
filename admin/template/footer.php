<!-- Modal -->
<div class="modal fade" id="exampleModaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Deskripsi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-desk">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
<script src="../admin/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../admin/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../admin/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../admin/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../admin/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../admin/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../admin/assets/plugins/moment/moment.min.js"></script>
<script src="../admin/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../admin/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../admin/assets/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="../admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../admin/assets/plugins/jszip/jszip.min.js"></script>
<script src="../admin/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../admin/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
<!-- Page specific script -->
<script src="../admin/assets/plugins/summernote/summernote-bs4.min.js"></script>

<script src="../admin/assets/bootstrap-select/dist/js/bootstrap-select.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="../admin/assets/plugins/toastr/toastr.min.js"></script>

<!-- dttable online -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->

<!-- <script>
    $(document).ready(function() {
        $('#example thead th').each(function() {
            var title = $(this).text();
            $(this).html(title + ' <input type="text" class="col-search-input" placeholder="Search ' + title + '" />');
        });

        table.columns().every(function() {
            var table = this;
            $('input', this.header()).on('keyup change', function() {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
        });
    });
</script> -->

<script>
    $(function() {
        $("#example1")
            .DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example2").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
        var url = window.location;
        // for single sidebar menu
        $("ul.nav-sidebar a")
            .filter(function() {
                return this.href == url;
            })
            .addClass("active");

        // for sidebar menu and treeview
        $("ul.nav-treeview a")
            .filter(function() {
                return this.href == url;
            })
            .parentsUntil(".nav-sidebar > .nav-treeview")
            .css({
                display: "block",
            })
            .addClass("menu-open")
            .prev("a")
            .addClass("active");

        // Summernote
        $("#summernote").summernote();

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai",
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

    });

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

    $(document).ready(() => {
        $("#image_galeri").change(function() {
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
            } else {
                if (file) {
                    let reader = new FileReader();
                    $(".custom-file-label").text(imageName);
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $(".modal-body #preview_galeri").attr("src", event.target.result);
                        $("#preview_galeri").attr("src", event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    })

    function loadData() {
        $.get("ajax_form/data_sosialMedia.php", function(data) {
            $(".modal-body #tbl_sosialMedia").html(data);
        });
    }

    function loadDataPsiswa() {
        // $.get("ajax_form/data_Psiswa.php", function(data) {
        //     $("#tabel-Psiswa").html(data);
        // });
        $.ajax({
            url: 'ajax_form/data_Psiswa.php',
            success: function(data) {
                $("#tabel-Psiswa").html(data);
            }
        })
    }

    function loadTable() {
        $('#example').dataTable({
            "ajax": {
                "url": "data.json",
                "type": "POST"
            }
        });
    }


    $(document).ready(function() {
        loadData();
        // loadDataPsiswa();

        //event hendler data sosial media
        $("#sosial_media").on("click", function() {
            $("#loader-tabel").show();
            setTimeout(function() {
                $("#loader-tabel").hide();
            }, 2000);
            $(".form_tambahSosial").hide();
        });

        $(document).on("click", ".edit-sosial", function() {
            $(".form_tambahSosial").hide();
            $("#loader-tabel").show();

            setTimeout(function() {
                $("#loader-tabel").hide();
                $(".form_tambahSosial").slideDown().fadeIn();
            }, 1000);

            let id_sosialMedia = $(this).data("id_s");
            let tipe_sosialMedia = $(this).data("tipe_s");
            let link_sosialMedia = $(this).data("link_s");

            $("#id_sosialMedia").val(id_sosialMedia);
            $("#tipe_sosialMedia").val(tipe_sosialMedia).change();
            $("#link_sosialMedia").val(link_sosialMedia);

            console.log(id_sosialMedia);

            $(document).submit("#form", function(e) {
                e.preventDefault();

                alamat = "ajax_form/update_sosialMedia.php";

                if ($("#link_sosialMedia").val() == "") {
                    $("#link_sosialMedia").addClass("is-invalid");
                    $(".validasi").text("inputan tidak boleh kosong");
                } else {
                    $.ajax({
                        url: alamat,
                        method: "post",
                        data: $("#form").serialize(),
                        beforeSend: function() {
                            $("#loader-tabel").show();
                            $(".form_tambahSosial").hide();
                        },
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                                title: "Sukses",
                                text: data,
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "OK",
                            });
                            loadData();
                            $("#loader-tabel").hide();
                            $(".form_tambahSosial").slideDown(500).fadeIn();
                            $("#link_sosialMedia").removeClass("is-invalid");
                        },
                    });
                }
            });
        });

        //event hendler kategori berita
        // $(document).on("click", "#tambah_Kberita", function () {
        //   $("#loader-card").hide();
        //   $("#t-dataKat").on("click", function () {
        //     $("#nama_kategori").prop("readonly", false);
        //     $("#deskripsi").prop("readonly", false);
        //     $("#t-dataKat").text("Simpan");
        //     $("#nama_kategori").focus();
        //   });
        // });


        //data studi
        if ($("#nama_studi").val() == "" || $("#deskripsi_studi").val() == "") {
            $("#form-studi").validate({
                rules: {
                    nama_studi: {
                        required: true,
                    },
                    deskripsi_studi: {
                        required: true,
                    },
                    file_image: {
                        required: true,
                    },
                },
                messages: {
                    nama_studi: {
                        required: "nama studi tidak boleh kosong",
                    },
                    deskripsi_studi: {
                        required: "deskripsi studi tidak boleh kosong",
                    },
                    file_image: {
                        required: "gambar studi tidak boleh kosong",
                    },
                },
            });
        }
        $(document).on("click", ".edit-studi", function() {
            // e.preventDefault();
            $('#rules-studi').hide();
            $('#nama_studi').prop('disabled', true);
            $('#nama_studi').prop('readonly', true);
            let id_studi = $(this).data("id_pstudi");
            let nama_studi = $(this).data("nama_studi");
            let deskripsi_studi = $(this).data("desk_studi");
            let gambar_studi = $(this).data("gambar_studi");

            console.log(deskripsi_studi);

            let url = "./gambar/" + gambar_studi;

            $(".modal-body #id_Pstudi").val(id_studi);
            $(".modal-body #nama_studi").val(nama_studi);
            // $('#summernote').summernote('editor.insertText', deskripsi_studi);
            $(".modal-body #desk_studi").val(deskripsi_studi);
            $(".modal-body #imgPreview").attr("src", url);
            $(".modal-body .custom-file-label").text(gambar_studi);
            $(".modal-body #gLama_studi").val(gambar_studi);

            $("#t-dataStudi").attr("name", "edit_studi");

            $('#edit-namaStudi').on('click', function() {
                $('#nama_studi').prop('disabled', false);
                $('#nama_studi').prop('readonly', false);
                $('#rules-studi').show();
            })
        });

        $(document).on("click", "#tambah-studi", function() {
            // e.preventDefault();
            $('#nama_studi').prop('disabled', false);
            $('#nama_studi').prop('readonly', false);
            $(".modal-body #nama_studi").val("");
            $(".modal-body #summernote").text("-");
            $(".modal-body #imgPreview").attr("src", "./gambar/default.jpg");
            $(".modal-body .custom-file-label").text("Chose File...");
            $("#t-dataStudi").attr("name", "tambah_studi");
            $('#summernote').summernote('editor.insertText', 'hello world');
        });

        $(document).on("click", ".hapus-studi", function(e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Hapus data?',
                text: "Apakah anda yakin ingin menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = $(this).attr("href");
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Simpan data anda sebaik mungkin :)',
                        'error'
                    )
                }
            })
        });

        //data kategori berita
        if ($("#nama_kategori").val() == "" || $("#deskripsi").val() == "") {
            $("#form-Kberita").validate({
                rules: {
                    nama_kategori: {
                        required: true,
                    },
                    deskripsi: {
                        required: true,
                    },
                },
                messages: {
                    nama_kategori: {
                        required: "nama kategori tidak boleh kosong",
                    },
                    deskripsi: {
                        required: "deskripsi tidak boleh kosong",
                    },
                },
            });
        }
        $(document).on("click", ".edit-kategori", function() {
            let id_kategori = $(this).data("id_kategori");
            let nama_kategori = $(this).data("nama_kategori");
            let deskripsi = $(this).data("deskripsi");

            $(".modal-body #id_kategoriBerita").val(id_kategori);
            $(".modal-body #nama_kategori").val(nama_kategori);
            $(".modal-body #deskripsi").val(deskripsi);

            $("#t-dataKat").attr("name", "edit_Kberita");
        });

        $(document).on('click', '#tambah_Kberita', function(e) {
            e.preventDefault();
            $(".modal-body #id_kategoriBerita").val("");
            $(".modal-body #nama_kategori").val("");
            $(".modal-body #deskripsi").val("");
            $("#t-dataKat").attr("name", "tambah_Kberita");
        })

        $(document).on("click", ".hapus-kategori", function(e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Hapus data?',
                text: "Apakah anda yakin ingin menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = $(this).attr("href");
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Simpan data anda sebaik mungkin :)',
                        'error'
                    )
                }
            })
        });

        $(document).on("click", ".hapus-berita", function(e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Hapus data?',
                text: "Apakah anda yakin ingin menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = $(this).attr("href");
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Simpan data anda sebaik mungkin :)',
                        'error'
                    )
                }
            })
        });

        //data galeri 
        $(document).on('click', '#galeri', function() {
            $('#tabel-galeri').attr('hidden', false);
        });

        if ($('#judul_gambar').val() == "") {
            $('#form-galeri').validate({
                rules: {
                    judul_gambar: {
                        required: true
                    },
                },
                messages: {
                    judul_gambar: {
                        required: "judul gambar tidak boleh kosong"
                    }
                }
            });
        }
        $(document).on('click', '.edit-galeri', function(e) {
            e.preventDefault();

            let id_galeri = $(this).data('id_galeri');
            let judul_galeri = $(this).data('judul_galeri');
            let desk_galeri = $(this).data('desk_galeri');
            let gambar = $(this).data('gambar');

            $('.modal-galeri #id_galeri').val(id_galeri);
            $('.modal-galeri #judul_gambar').val(judul_galeri);
            $('.modal-galeri #deskripsi_gambar').text(desk_galeri);
            $('.modal-galeri #preview_galeri').attr('src', '../admin/gambar/galeri/' + gambar);
            $('.modal-galeri #g_lamaGaleri').val(gambar);
            $('.modal-galeri .custom-file-label').text(gambar);
            $('.modal-galeri #image_galeri').prop('required', false);
            $('.modal-galeri #btn-Sgaleri').attr('name', 'edit_galeri');
        })

        $(document).on('click', '#t-galeri', function() {

            $('.modal-galeri #id_galeri').val("");
            $('.modal-galeri #judul_gambar').val("");
            $('.modal-galeri #deskripsi_gambar').val("");
            $('.modal-galeri #imgPreview').attr('src', '../admin/gambar/galeri/default.jpg');
            $('.modal-galeri #g_lamaGaleri').val("");
            $('.modal-galeri .custom-file-label').text("chose file..");

            $('.modal-galeri #btn-Sgaleri').attr('name', 'tambah_galeri');
        })

        $(document).on("click", ".hapus-galeri", function(e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Hapus data?',
                text: "Apakah anda yakin ingin menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = $(this).attr("href");
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Simpan data anda sebaik mungkin :)',
                        'error'
                    )
                }
            })
        });

        $(document).on('click', '#t-psb', function() {
            $('.modal-psb #deskripsi').attr('readonly', true);
            $('.modal-psb #tgl_buka').attr('readonly', true);
            $('.modal-psb #tgl_tutup').attr('readonly', true);
            $('.modal-psb #tgl_pengumuman').attr('readonly', true);
            $('.modal-psb #btn-psb').attr('hidden', true);
            $('.modal-psb #edit-psb').attr('hidden', false);
            $('.modal-psb #summernote').summernote('disable');
        });

        $(document).on('click', '#edit-psb', function() {
            $('.modal-psb #deskripsi').attr('readonly', false);
            $('.modal-psb #tgl_buka').attr('readonly', false);
            $('.modal-psb #tgl_tutup').attr('readonly', false);
            $('.modal-psb #tgl_pengumuman').attr('readonly', false);
            $('.modal-psb #btn-psb').attr('hidden', false);
            $('.modal-psb #edit-psb').attr('hidden', true);
            $('.modal-psb #summernote').summernote('enable');
        });


        $(document).on('click', '#tambah-thnAkd', function() {
            // $('#tahun1').attr('aria-disabled', false);
            // $('#tahun2').attr('aria-disabled', false);
            $(".selectpicker").val("").change();
            $('#s-tahunAkd').prop('name', "t-tahunAkd");
            $('#s-tahunAkd').text("Simpan");
        })

        $('#form-tahunAkd').validate({
            rules: {
                tahun1: {
                    required: true,
                },
                tahun2: {
                    required: true,
                }
            },
            messages: {
                tahun1: {
                    required: "tahun 1 tidak boleh kosong",
                },
                tahun2: {
                    required: "tahun 2 tidak boleh kosong",
                }
            }
        })

        $(document).on('click', '.edit-tahunAkd', function(e) {
            e.preventDefault();
            let id_tahunAkd = $(this).data('id_tahunakd');
            let tahun_1 = $(this).data('tahun_1');
            let tahun_2 = $(this).data('tahun_2');

            $('.modal-body #id_tahunAkd').val(id_tahunAkd);
            $('.modal-body #tahun1').val(tahun_1).change();
            $('.modal-body #tahun2').val(tahun_2).change();
            $('#s-tahunAkd').prop('name', "edit_tahunAkd");
            $('#s-tahunAkd').text("Update");
        })

        $(document).on('click', '.status-akd', function(e) {
            e.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Update Data',
                text: "Apakah anda yakin ingin mengupdate data ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, update',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = $(this).attr("href");
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Update dibatalkan :)',
                        'error'
                    )
                }
            })
        })

        $(document).on('click', '.tahun-akd', function(e) {
            e.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Hapus data?',
                text: "Apakah anda yakin ingin menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = $(this).attr("href");
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Simpan data anda sebaik mungkin :)',
                        'error'
                    )
                }
            })
        })

        for (let i = 1; i <= 4; i++) {
            $(document).on('click', '.cek-gambar' + i, function() {
                console.log($('.d-gambar' + i).attr('src'));
                $('.modal-body #tampil-gmb').attr('src', $('.d-gambar' + i).attr('src'));
            })
        }

        $(document).on('click', '#btn-Tvalid', function(e) {
            e.preventDefault();
            $('#v-tidakValid').prop('checked', true);
            $('#v-valid').prop('checked', false);
            $('#form-pesan').prop('hidden', false);
            $('#btn-valid').hide();
            $('#btn-Tvalid').hide();
            $('.btn-validasi').prop('hidden', false);
            $('.btn-validasi').text('Validasi ke data tidak valid');
        })

        $(document).on('click', '#btn-valid', function(e) {
            e.preventDefault();
            $('#v-tidakValid').prop('checked', false);
            $('#v-valid').prop('checked', true);
            $('#btn-valid').hide();
            $('#btn-Tvalid').hide();
            $('.btn-validasi').prop('hidden', false);
            $('.btn-validasi').text('Validasi ke data valid');
        })

        $(document).on('submit', '#form-validasi', function(e) {
            e.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Validasi Data Pendaftaran',
                text: "Apakah anda yakin ingin memvalidasi pendaftaran ? Cek kembali data sebelum memvalidasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Validasi',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'post',
                        // dataType: 'json',
                        data: $('#form-validasi').serialize(),
                        beforeSend: function() {
                            $('#loader').prop('hidden', false);
                        },
                        error: function(data) {
                            console.log(data);
                            Swal.fire({
                                title: "Gagal",
                                text: data,
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "OK",
                            });
                        },
                        success: function(data) {
                            $('#v-tidakValid').prop('checked', false);
                            $('#v-valid').prop('checked', false);
                            $('#form-pesan').prop('hidden', false);
                            $('#btn-valid').hide();
                            $('#btn-Tvalid').hide();
                            $('.btn-validasi').prop('hidden', true);
                            $('#loader').prop('hidden', true);
                            console.log(data);
                            Swal.fire({
                                title: "Sukses",
                                text: data,
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'siswa_psb.php';
                                }
                            })
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Update dibatalkan :)',
                        'error'
                    )
                }
            })
        })

        $("#centang-semua").click(function() {
            console.log('TEST');
            if ($(this).is(':checked')) {
                $('.centangID').prop('checked', true);
            } else {
                $('.centangID').prop('checked', false);
            }
        });

        //toast info
        //ajax submit pengumuman siswa
        $('#btn-lulus').click(function() {
            $('#v-lulus').prop('checked', true);
            $('#v-tidakLulus').prop('checked', false);
        });
        $('#btn-tidakLulus').click(function() {
            $('#v-lulus').prop('checked', false);
            $('#v-tidakLulus').prop('checked', true);
        });

        $(document).on('click', '#logout', function(e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Logout',
                text: "Apakah anda yakin ingin logout ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = $(this).attr("href");
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Logout dibatalkan :)',
                        'error'
                    )
                }
            })
        })

        $(document).on("click", "#tambah-kelas", function(e) {
            e.preventDefault(e);
            $(".modal-body .btn-formKelas").text("Tambah");
            $(".modal-body .btn-formKelas").attr("name", "simpan_kelas");

            $(".modal-body #id_kelas").val("");
            $(".modal-body .filter-option-inner-inner").text("Nama Kelas");
            $(".modal-body #nama_kelas").val("");
            $(".modal-body #jumlah_bangku").val("");
        })


        $(document).on("click", ".edit_kelas", function(e) {
            e.preventDefault(e);
            $(".modal-body .btn-formKelas").text("Update");
            $(".modal-body .btn-formKelas").attr("name", "update_kelas");
            let id_kelas = $(this).data("id_kelas");

            $(".modal-body #id_kelas").val(id_kelas);
            $(".modal-body #nama_kelas").val($(this).data("nama_kelas")).change();
            $(".modal-body #jumlah_bangku").val($(this).data("jml_bangku"));
        })

        //FUNGSI HAPUS
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
                    // swalWithBootstrapButtons.fire(
                    //     'Dihapus!',
                    //     'Data berhasil dihapus.',
                    //     'success'
                    // )
                    window.location.href = $(this).attr('href');
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

        //Jquery EKSTRAKURIKULER

        //CEK IMG
        $(document).on("click", ".cek_gambar", function(e) {
            e.preventDefault();
            let nama_gambar = $(this).data("nama_gambar");
            Swal.fire({
                title: $(this).data("nama"),
                imageUrl: 'gambar/pembina/' + nama_gambar,
                imageWidth: 300,
            })
        })

        //edit_kegiatan
        $('.desk_kegiatan').summernote('disable');
        $(document).on('click', '.btn-Ekegiatan', function(e) {
            e.preventDefault();
            $('#nama_kegiatan').prop("readonly", false);
            $('.desk_kegiatan').summernote('enable');
            $('.btn-Ekegiatan').prop('hidden', true);
            $('.btn-Ukegiatan').prop('hidden', false);
        });
    })
</script>