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
                        <li class="breadcrumb-item active" aria-current="page"><a href="">User</a></li>
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
                                    <i class="fas fa-users me-2"></i> Data Pengguna <span class="badge bg-secondary ms-2 fw-normal">Tabel Pengguna</span>
                                </h5>
                                <a href="<?php echo base_url('dashboard/pengguna_tambah'); ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus me-1"></i> Tambah Pengguna
                                </a>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo base_url('dashboard/cari_user'); ?>" method="post" class="mb-3">
                                    <div class="input-group" style="max-width: 320px;">
                                        <input class="form-control" type="text" name="cari" id="cari" placeholder="Cari nama / username..." value="<?php echo isset($cari) ? htmlspecialchars($cari) : ''; ?>">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search me-1"></i> Cari
                                        </button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th width="3%" class="text-center">No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th width="10%" class="text-center">Status</th>
                                                <th width="12%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($pengguna as $p) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td><strong><?php echo htmlspecialchars($p->pengguna_nama); ?></strong></td>
                                                    <td><?php echo htmlspecialchars($p->pengguna_email); ?></td>
                                                    <td><code><?php echo htmlspecialchars($p->pengguna_username); ?></code></td>
                                                    <td class="text-center">
                                                        <?php echo ($p->pengguna_status == 1)
                                                            ? '<span class="badge bg-success">Aktif</span>'
                                                            : '<span class="badge bg-secondary">Tidak Aktif</span>'; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a href="<?php echo base_url('dashboard/see_profile/' . $p->pengguna_id); ?>" class="btn btn-info" title="Lihat Profil">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('dashboard/pengguna_edit/' . $p->pengguna_id); ?>" class="btn btn-warning" title="Edit Pengguna">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('dashboard/pengguna_hapus/' . $p->pengguna_id); ?>" class="btn btn-danger" title="Hapus Pengguna" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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