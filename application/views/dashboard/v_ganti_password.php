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
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard/profile' ?>">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Password</a></li>
                    </ol>
                </nav>
            </div>
            <hr>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-key me-2"></i> Ganti Password <span class="badge bg-secondary ms-2 fw-normal">Keamanan Akun</span>
                                </h5>
                                <a href="<?php echo base_url('dashboard/profile'); ?>" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Profil
                                </a>
                            </div>
                            <div class="card-body">
                                <?php if (isset($_GET['alert'])) {
                                    if ($_GET['alert'] == 'gagal') {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                <i class='fas fa-exclamation-triangle me-2'></i> Maaf, password lama yang Anda masukkan salah!
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                              </div>";
                                    } elseif ($_GET['alert'] == "sukses") {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                <i class='fas fa-check-circle me-2'></i> Password berhasil diperbarui!
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                              </div>";
                                    }
                                }
                                ?>
                                <form method="post" action="<?php echo base_url('dashboard/ganti_password_aksi'); ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Password Lama</label>
                                        <input type="password" class="form-control" name="password_lama" placeholder="Masukkan password lama Anda" required>
                                        <?php echo form_error('password_lama'); ?>
                                    </div>
                                    <hr class="my-3">
                                    <div class="mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" name="password_baru" placeholder="Masukkan password baru Anda" required>
                                        <?php echo form_error('password_baru'); ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" name="konfirmasi_password" placeholder="Ulangi password baru Anda" required>
                                        <?php echo form_error('konfirmasi_password'); ?>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-lock me-1"></i> Perbarui Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- /.content-wrapper -->