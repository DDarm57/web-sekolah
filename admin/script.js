$(function () {
  $("#example1")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      // buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#example1_wrapper .col-md-6:eq(0)");
  $("#example2").DataTable({
    paging: true,
    lengthChange: false,
    searching: false,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
  });
  var url = window.location;
  // for single sidebar menu
  $("ul.nav-sidebar a")
    .filter(function () {
      return this.href == url;
    })
    .addClass("active");

  // for sidebar menu and treeview
  $("ul.nav-treeview a")
    .filter(function () {
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
});

$(document).ready(() => {
  $("#file_image").change(function () {
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
        reader.onload = function (event) {
          console.log(event.target.result);
          $("#imgPreview").attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });
});
function loadData() {
  $.get("ajax_form/data_sosialMedia.php", function (data) {
    $(".modal-body #tbl_sosialMedia").html(data);
  });
}

$(document).ready(function () {
  loadData();
  //event hendler data sosial media
  $("#sosial_media").on("click", function () {
    $("#loader-tabel").show();
    setTimeout(function () {
      $("#loader-tabel").hide();
    }, 2000);
    $(".form_tambahSosial").hide();
  });

  $(document).on("click", ".edit-sosial", function () {
    $(".form_tambahSosial").hide();
    $("#loader-tabel").show();

    setTimeout(function () {
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

    $(document).submit("#form", function (e) {
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
          beforeSend: function () {
            $("#loader-tabel").show();
            $(".form_tambahSosial").hide();
          },
          success: function (data) {
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

  //data studi
  $(document).on("click", ".edit-studi", function () {
    // e.preventDefault();

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

    let id_studi = $(this).data("id_Pstudi");
    let nama_studi = $(this).data("nama_studi");
    let deskripsi_studi = $(this).data("desk_studi");
    let gambar_studi = $(this).data("gambar_studi");

    let url = "./gambar/" + gambar_studi;

    $(".modal-body #id_Pstudi").val(id_studi);
    $(".modal-body #nama_studi").val(nama_studi);
    $(".modal-body #summernote").text(deskripsi_studi);
    $(".modal-body #imgPreview").attr("src", url);
    $(".modal-body .custom-file-label").text(gambar_studi);
    $(".modal-body #gLama_studi").val(gambar_studi);

    $("#t-dataStudi").attr("name", "edit_studi");
  });

  $(document).on("click", "#tambah-studi", function () {
    // e.preventDefault();
    $(".modal-body #nama_studi").val("");
    $(".modal-body #summernote").text("");
    $(".modal-body #imgPreview").attr("src", "./gambar/default.jpg");
    $(".modal-body .custom-file-label").text("Chose File...");
    $("#t-dataStudi").attr("name", "edit_studi");
  });

  //data kategori berita
  $(document).on("click", ".edit-kategori", function () {
    let id_kategori = $(this).data("id_kategori");
    let nama_kategori = $(this).data("nama_kategori");
    let deskripsi = $(this).data("deskripsi");

    $(".modal-body #id_kategoriBerita").val(id_kategori);
    $(".modal-body #nama_kategori").val(nama_kategori);
    $(".modal-body #deskripsi").val(deskripsi);

    $("#t-dataKat").attr("name", "edit_Kberita");
  });

  $(document).on("click", ".hapus-kategori", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "Info",
      text: "Apakah anda yakin ingin menghapus data",
      icon: "info",
      showCancelButton: false,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "OK",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = $(this).attr("href");
      }
    });
  });
});
