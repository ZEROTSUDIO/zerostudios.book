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
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Pengaturan</a></li>
                    </ol>
                </nav>
            </div>
            <hr>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-sliders-h me-2"></i> Pengaturan Website <span class="badge bg-secondary ms-2 fw-normal">Identitas & Media Sosial</span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_GET['alert']) && $_GET['alert'] == "sukses") {
                                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                            <i class='fas fa-check-circle me-2'></i> Pengaturan website berhasil diperbarui!
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                          </div>";
                                }
                                foreach ($pengaturan as $p) {
                                    $logo_img = (!empty($p->logo) && file_exists(FCPATH . 'img/website/' . $p->logo))
                                        ? base_url('img/website/' . $p->logo)
                                        : base_url('assets/img/logo.png');
                                ?>
                                    <div class="row g-4">
                                        <div class="col-lg-8">
                                            <form action="<?php echo base_url('dashboard/pengaturan_update'); ?>" method="post" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Website</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama website..." value="<?php echo htmlspecialchars($p->nama); ?>" required>
                                                    <?php echo form_error('nama'); ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi Website</label>
                                                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi website..."><?php echo htmlspecialchars($p->deskripsi); ?></textarea>
                                                    <?php echo form_error('deskripsi'); ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Ganti Logo Website</label>
                                                    <input type="file" name="logo" class="form-control">
                                                    <small class="text-white-50">Kosongkan bila tidak ingin mengganti logo website.</small>
                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label"><i class="fab fa-facebook text-primary me-1"></i> Link Facebook</label>
                                                        <input type="text" name="link_facebook" class="form-control" placeholder="https://facebook.com/..." value="<?php echo htmlspecialchars($p->link_facebook); ?>">
                                                        <?php echo form_error('link_facebook'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label"><i class="fab fa-twitter text-info me-1"></i> Link Twitter</label>
                                                        <input type="text" name="link_twitter" class="form-control" placeholder="https://twitter.com/..." value="<?php echo htmlspecialchars($p->link_twitter); ?>">
                                                        <?php echo form_error('link_twitter'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label"><i class="fab fa-instagram text-danger me-1"></i> Link Instagram</label>
                                                        <input type="text" name="link_instagram" class="form-control" placeholder="https://instagram.com/..." value="<?php echo htmlspecialchars($p->link_instagram); ?>">
                                                        <?php echo form_error('link_instagram'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label"><i class="fab fa-github me-1"></i> Link GitHub</label>
                                                        <input type="text" name="link_github" class="form-control" placeholder="https://github.com/..." value="<?php echo htmlspecialchars($p->link_github); ?>">
                                                        <?php echo form_error('link_github'); ?>
                                                    </div>
                                                </div>
                                                <hr class="my-4">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-save me-1"></i> Simpan Pengaturan
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                            <div class="card p-3 border-0" style="background: rgba(15, 15, 15, 0.4);">
                                                <label class="form-label fw-bold mb-3">Logo Website Saat Ini</label>
                                                <div class="p-3 bg-white rounded mb-2 d-inline-block mx-auto">
                                                    <img src="<?php echo $logo_img; ?>" alt="Logo <?php echo htmlspecialchars($p->nama); ?>" style="max-height: 100px; max-width: 100%; object-fit: contain;">
                                                </div>
                                                <small class="text-white-50 d-block"><?php echo htmlspecialchars($p->nama); ?></small>
                                            </div>
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
            <!-- /.content -->
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- /.content-wrapper -->