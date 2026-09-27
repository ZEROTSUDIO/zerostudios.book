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
                        <li class="breadcrumb-item active" aria-current="page"><a href="">Page</a></li>
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
                                    <i class="fas fa-file-alt me-2"></i> Data Halaman <span class="badge bg-secondary ms-2 fw-normal">Halaman Web</span>
                                </h5>
                                <a href="<?php echo base_url('dashboard/pages_tambah'); ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus me-1"></i> Buat Halaman Baru
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th width="3%" class="text-center">No</th>
                                                <th>Judul Halaman</th>
                                                <th>URL Slug</th>
                                                <th width="12%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($halaman as $h) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td><strong><?php echo htmlspecialchars($h->halaman_judul); ?></strong></td>
                                                    <td>
                                                        <a href="<?php echo base_url('page/' . $h->halaman_slug); ?>" target="_blank" class="text-info text-decoration-none">
                                                            <i class="fas fa-external-link-alt me-1"></i><code>page/<?php echo htmlspecialchars($h->halaman_slug); ?></code>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a target="_blank" href="<?php echo base_url('page/' . $h->halaman_slug); ?>" class="btn btn-info" title="Lihat Halaman">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('dashboard/pages_edit/' . $h->halaman_id); ?>" class="btn btn-warning" title="Edit Halaman">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('dashboard/pages_hapus/' . $h->halaman_id); ?>" class="btn btn-danger" title="Hapus Halaman" onclick="return confirm('Yakin ingin menghapus data halaman ini?')">
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