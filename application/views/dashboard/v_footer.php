    </div><!-- /container-fluid -->

    <!-- Logout Confirmation Modal (Bootstrap 5.3) -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">
                        <i class="fas fa-sign-out-alt text-danger me-2"></i> Konfirmasi Keluar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari akun ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-danger">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts (Bootstrap 5.3 + DataTables + Summernote + Main) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            // Summernote WYSIWYG
            if ($(".summernote").length) {
                $(".summernote").summernote({
                    height: 250
                });
            }

            // DataTables Pagination & Interactive Table
            if ($(".table-datatable").length) {
                $(".table-datatable").DataTable({
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "Semua"]
                    ],
                    language: {
                        search: "Cari:",
                        searchPlaceholder: "Ketik kata kunci...",
                        lengthMenu: "Tampilkan _MENU_ data",
                        zeroRecords: "Tidak ada data yang ditemukan",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        infoEmpty: "Menampilkan 0 data",
                        infoFiltered: "(disaring dari _MAX_ total data)",
                        paginate: {
                            first: '<i class="fas fa-angle-double-left"></i>',
                            last: '<i class="fas fa-angle-double-right"></i>',
                            next: '<i class="fas fa-chevron-right"></i>',
                            previous: '<i class="fas fa-chevron-left"></i>'
                        }
                    },
                    columnDefs: [
                        { orderable: false, targets: 'no-sort' }
                    ]
                });
            }
        });
    </script>
</body>

</html>