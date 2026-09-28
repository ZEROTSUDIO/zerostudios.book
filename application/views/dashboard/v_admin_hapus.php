<?php
$id_user = $this->session->userdata('id');
$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
?>
<div class="container-fluid">
    <div class="main-content">
        <div class="container mt-3">
            <div class="content-header">
                <h5 id="Date" class="mb-0"></h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard' ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard/admin' ?>">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Hapus Admin</a></li>
                    </ol>
                </nav>
            </div>
            <hr>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user-times me-2"></i> Konfirmasi Hapus Admin
                                </h5>
                                <a href="<?php echo base_url('dashboard/admin'); ?>" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="alert alert-warning mb-4 text-dark border-0">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Pengguna <strong><?php echo htmlspecialchars($pengguna_hapus->pengguna_nama); ?></strong> akan dihapus. Semua artikel yang ditulis oleh pengguna ini harus dipindahkan ke pengguna lain.
                                </div>
                                <form method="post" action="<?php echo base_url('dashboard/admin_hapus_aksi'); ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Pindahkan Artikel Kepada:</label>
                                        <input type="hidden" name="pengguna_hapus" value="<?php echo $pengguna_hapus->pengguna_id; ?>">
                                        <select name="pengguna_tujuan" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Pengguna Tujuan --</option>
                                            <?php foreach ($pengguna_lain as $pl) { ?>
                                                <option value="<?php echo $pl->pengguna_id; ?>">
                                                    <?php echo htmlspecialchars($pl->pengguna_nama); ?> (<?php echo htmlspecialchars($pl->pengguna_level); ?>)
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <hr class="my-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <button type="submit" name="action" value="update" class="btn btn-success w-100">
                                                <i class="fas fa-user-edit me-1"></i> Hapus Peran Admin Saja
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" name="action" value="delete" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini sepenuhnya?')">
                                                <i class="fas fa-user-slash me-1"></i> Hapus Pengguna & Pindahkan Artikel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- /.content-wrapper -->