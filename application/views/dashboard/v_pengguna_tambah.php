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
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard/pengguna'); ?>">Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Pengguna</li>
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
                                    <i class="fas fa-user-plus me-2"></i> Tambah Pengguna Baru
                                </h5>
                                <a href="<?php echo base_url('dashboard/pengguna'); ?>" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="<?php echo base_url('dashboard/pengguna_tambah_aksi'); ?>">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna..." required>
                                            <?php echo form_error('nama'); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Alamat Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna..." required>
                                            <?php echo form_error('email'); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Masukkan username pengguna..." required>
                                            <?php echo form_error('username'); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan password pengguna..." required>
                                            <?php echo form_error('password'); ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Level / Hak Akses</label>
                                            <select class="form-select" name="level" required>
                                                <option value="" disabled selected>-- Pilih Level --</option>
                                                <option value="admin">Admin</option>
                                                <option value="penulis">Penulis</option>
                                                <option value="user">User</option>
                                            </select>
                                            <?php echo form_error('level'); ?>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan Pengguna
                                    </button>
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