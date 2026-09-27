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

    <!-- Scripts (Bootstrap 5.3 + Summernote + Main) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            if ($(".summernote").length) {
                $(".summernote").summernote({
                    height: 250
                });
            }
        });
    </script>
</body>

</html>