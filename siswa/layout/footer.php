<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../admin/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
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
    });

    $(document).ready(function() {
        $(document).on("click", "#logout", function(e) {
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
                text: "Apakah anda yakin ingin logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Tidak, batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval
                    Swal.fire({
                        title: 'Jangan pantang menyerah teruslah belajar dengan giat :)',
                        html: 'Keluar dalam <b></b> milidetik.',
                        timer: 4000,
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
                        window.location.href = $(this).attr("href");
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Logout batal terimakasih telah menggunakan aplikasi ini :)',
                        'error'
                    )
                }
            })
        })
    })
</script>
</body>

</html>