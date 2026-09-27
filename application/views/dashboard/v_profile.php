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
                        <li class="breadcrumb-item active" aria-current="page"><a href="">Profile</a></li>
                    </ol>
                </nav>
            </div>
            <hr>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user-circle me-2"></i> Profil Pengguna <span class="badge bg-secondary ms-2 fw-normal">Pengaturan Akun</span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_GET['alert']) && $_GET['alert'] == "sukses") {
                                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                            <i class='fas fa-check-circle me-2'></i> Profil pengguna berhasil diperbarui!
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                          </div>";
                                }
                                foreach ($pengguna as $p) {
                                    $user_foto = (!empty($p->pengguna_foto) && file_exists(FCPATH . 'img/user/' . $p->pengguna_foto))
                                        ? base_url('img/user/' . $p->pengguna_foto)
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($p->pengguna_nama) . '&background=222c42&color=fff&size=256';
                                ?>
                                    <div class="row g-4">
                                        <div class="col-md-4 text-center">
                                            <div class="card p-3 border-0" style="background: rgba(15, 15, 15, 0.4);">
                                                <label class="form-label fw-bold mb-3">Foto Profil</label>
                                                <div class="mb-3">
                                                    <img src="<?php echo $user_foto; ?>" alt="Foto Profil" class="img-thumbnail rounded-circle" style="width: 140px; height: 140px; object-fit: cover; border: 3px solid rgba(255, 255, 255, 0.15);">
                                                </div>
                                                <h6 class="text-white mb-1"><?php echo htmlspecialchars($p->pengguna_nama); ?></h6>
                                                <p class="text-white-50 small mb-3"><code>@<?php echo htmlspecialchars($p->pengguna_username); ?></code></p>
                                                <?php if ($this->session->userdata('id') == $p->pengguna_id) { ?>
                                                    <form action="<?php echo base_url('dashboard/profil_foto_update'); ?>" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="<?php echo $p->pengguna_id; ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label small text-white-50">Pilih Foto Baru</label>
                                                            <input type="file" name="foto" class="form-control form-control-sm" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-sm btn-primary w-100">
                                                            <i class="fas fa-upload me-1"></i> Upload Foto
                                                        </button>
                                                    </form>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <form action="<?php echo base_url('dashboard/profil_update'); ?>" method="post">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Username</label>
                                                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username..." value="<?php echo htmlspecialchars($p->pengguna_username); ?>" required>
                                                        <?php echo form_error('username'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Level Pengguna</label>
                                                        <input type="text" name="level" class="form-control" value="<?php echo htmlspecialchars($p->pengguna_level); ?>" readonly>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label">Nama Lengkap</label>
                                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap..." value="<?php echo htmlspecialchars($p->pengguna_nama); ?>" required>
                                                        <?php echo form_error('nama'); ?>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label">Alamat Email</label>
                                                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email..." value="<?php echo htmlspecialchars($p->pengguna_email); ?>" required>
                                                        <?php echo form_error('email'); ?>
                                                    </div>
                                                </div>
                                                <?php if ($this->session->userdata('id') == $p->pengguna_id) { ?>
                                                    <hr class="my-4">
                                                    <div class="d-flex gap-2">
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fas fa-save me-1"></i> Update Profil
                                                        </button>
                                                        <a href="<?php echo base_url('dashboard/ganti_password'); ?>" class="btn btn-warning">
                                                            <i class="fas fa-lock me-1"></i> Ubah Password
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- /.content-wrapper -->