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
                        <li class="breadcrumb-item active" aria-current="page"><a href="">Admin</a></li>
                    </ol>
                </nav>
            </div>
            <hr>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user-shield me-2"></i> Data Admin <span class="badge bg-secondary ms-2 fw-normal">Administrator</span>
                                </h5>
                                <a href="<?php echo base_url('dashboard/pengguna_tambah'); ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus me-1"></i> Tambah Admin
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th width="3%" class="text-center">No</th>
                                                <th width="6%" class="text-center">Foto</th>
                                                <th>Username</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th width="10%" class="text-center">Level</th>
                                                <th width="8%" class="text-center">Status</th>
                                                <th width="10%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($pengguna as $p) {
                                                $avatar = (!empty($p->pengguna_foto) && file_exists(FCPATH . 'img/user/' . $p->pengguna_foto))
                                                    ? base_url('img/user/' . $p->pengguna_foto)
                                                    : 'https://ui-avatars.com/api/?name=' . urlencode($p->pengguna_nama) . '&background=222c42&color=fff';
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td class="text-center">
                                                        <img class="table-thumb-avatar rounded-circle" src="<?php echo $avatar; ?>" alt="<?php echo htmlspecialchars($p->pengguna_username); ?>" style="width: 38px; height: 38px; object-fit: cover;">
                                                    </td>
                                                    <td><code><?php echo htmlspecialchars($p->pengguna_username); ?></code></td>
                                                    <td><strong><?php echo htmlspecialchars($p->pengguna_nama); ?></strong></td>
                                                    <td><?php echo htmlspecialchars($p->pengguna_email); ?></td>
                                                    <td class="text-center">
                                                        <span class="badge bg-primary text-uppercase"><?php echo htmlspecialchars($p->pengguna_level); ?></span>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo ($p->pengguna_status == 1)
                                                            ? '<span class="badge bg-success">Aktif</span>'
                                                            : '<span class="badge bg-secondary">Tidak Aktif</span>'; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a href="<?php echo base_url('dashboard/pengguna_edit/' . $p->pengguna_id); ?>" class="btn btn-warning" title="Edit Admin">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('dashboard/admin_hapus/' . $p->pengguna_id); ?>" class="btn btn-danger" title="Hapus Admin" onclick="return confirm('Yakin ingin menghapus admin ini?')">
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