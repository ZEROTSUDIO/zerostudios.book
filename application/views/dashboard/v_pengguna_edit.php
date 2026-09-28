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
                        <li class="breadcrumb-item active" aria-current="page">Edit Pengguna</li>
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
                                    <i class="fas fa-user-edit me-2"></i> Edit Data Pengguna
                                </h5>
                                <a href="<?php echo base_url('dashboard/pengguna'); ?>" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                foreach ($pengguna as $p) {
                                ?>
                                    <form method="post" action="<?php echo base_url('dashboard/pengguna_update'); ?>">
                                        <input type="hidden" name="id" value="<?php echo $p->pengguna_id; ?>">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Level / Hak Akses</label>
                                                <select class="form-select" name="level" required>
                                                    <option value="" disabled>-- Pilih Level --</option>
                                                    <option <?php if ($p->pengguna_level == "admin") { echo "selected='selected'"; } ?> value="admin">Admin</option>
                                                    <option <?php if ($p->pengguna_level == "penulis") { echo "selected='selected'"; } ?> value="penulis">Penulis</option>
                                                    <option <?php if ($p->pengguna_level == "user") { echo "selected='selected'"; } ?> value="user">User</option>
                                                </select>
                                                <?php echo form_error('level'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Status Akun</label>
                                                <select class="form-select" name="status" required>
                                                    <option value="" disabled>-- Pilih Status --</option>
                                                    <option <?php if ($p->pengguna_status == "1") { echo "selected='selected'"; } ?> value="1">Aktif</option>
                                                    <option <?php if ($p->pengguna_status == "0") { echo "selected='selected'"; } ?> value="0">Tidak Aktif</option>
                                                </select>
                                                <?php echo form_error('status'); ?>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Update Pengguna
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>
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