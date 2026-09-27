<section class="anime-details spad">
    <div class="container">
        <div class="anime__details__content">
            <div class="row">
                <?php if (count($pengguna) == 0) { ?>
                    <div class="col-lg-12">
                        <center class="mt-5 text-white"><h4>Pengguna Tidak Ditemukan</h4></center>
                    </div>
                <?php } else {
                    foreach ($pengguna as $p) {
                        $foto = (!empty($p->pengguna_foto) && file_exists(FCPATH . 'img/user/' . $p->pengguna_foto))
                            ? base_url('img/user/' . $p->pengguna_foto)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($p->pengguna_nama) . '&background=e53637&color=fff';
                ?>
                    <div class="col-md-4 text-center mb-4">
                        <div class="card p-3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;">
                            <label class="font-weight-bold text-white mb-3">Foto Profil</label>
                            <div class="mb-3">
                                <img src="<?php echo $foto; ?>" alt="Foto Profil" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <?php if ($this->session->userdata('id') == $p->pengguna_id) { ?>
                                <form action="<?php echo base_url('welcome/profil_foto_update'); ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $p->pengguna_id; ?>">
                                    <div class="form-group text-left">
                                        <label class="text-white-50 small">Pilih Foto Baru</label>
                                        <input type="file" name="foto" class="form-control-file text-white" required>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-block btn-sm mt-3" style="background: #e53637; border-color: #e53637;">
                                        <i class="fas fa-upload mr-1"></i> Upload Foto
                                    </button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card p-4" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;">
                            <h4 class="text-white mb-4">Informasi Profil</h4>
                            <form action="<?php echo base_url('welcome/profil_update'); ?>" method="post">
                                <div class="form-group">
                                    <label class="text-white">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username..." value="<?php echo htmlspecialchars($p->pengguna_username); ?>" <?php echo ($this->session->userdata('id') != $p->pengguna_id) ? 'readonly' : ''; ?>>
                                    <?php echo form_error('username'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-white">Level Pengguna</label>
                                    <input type="text" name="level" class="form-control" value="<?php echo htmlspecialchars($p->pengguna_level); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="text-white">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama..." value="<?php echo htmlspecialchars($p->pengguna_nama); ?>" <?php echo ($this->session->userdata('id') != $p->pengguna_id) ? 'readonly' : ''; ?>>
                                    <?php echo form_error('nama'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="text-white">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email..." value="<?php echo htmlspecialchars($p->pengguna_email); ?>" <?php echo ($this->session->userdata('id') != $p->pengguna_id) ? 'readonly' : ''; ?>>
                                    <?php echo form_error('email'); ?>
                                </div>
                                <?php if ($this->session->userdata('id') == $p->pengguna_id) { ?>
                                    <div class="mt-4 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                        </button>
                                        <a href="<?php echo base_url('dashboard/ganti_password'); ?>" class="btn btn-outline-warning">
                                            <i class="fas fa-key mr-1"></i> Ubah Password
                                        </a>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                <?php } } ?>
            </div>
        </div>
    </div>
</section>