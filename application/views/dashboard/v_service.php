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
                        <li class="breadcrumb-item active" aria-current="page"><a href="">Service</a></li>
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
                                    <i class="fas fa-clipboard-list me-2"></i> Data Layanan Buku <span class="badge bg-secondary ms-2 fw-normal">Daftar Layanan</span>
                                </h5>
                                <a href="<?php echo base_url('dashboard/service_tambah'); ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus me-1"></i> Tambah Layanan
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle table-datatable">
                                        <thead>
                                            <tr>
                                                <th width="4%" class="text-center no-sort">No</th>
                                                <th width="8%" class="text-center no-sort">Sampul</th>
                                                <th>Judul Buku</th>
                                                <th>Genre</th>
                                                <th width="10%">Tanggal</th>
                                                <th class="no-sort">Link Pembelian</th>
                                                <th width="8%" class="text-center">Status</th>
                                                <th width="12%" class="text-center no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($service as $a) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-center">
                                                        <img class="table-thumb-book" src="<?php echo base_url('/img/book/') . $a->buku_sampul; ?>" alt="<?= htmlspecialchars($a->buku_judul); ?>">
                                                    </td>
                                                    <td><strong><?= htmlspecialchars($a->buku_judul); ?></strong></td>
                                                    <td><span class="badge bg-secondary"><?= htmlspecialchars($a->genre_nama); ?></span></td>
                                                    <td><?= date('d/m/Y', strtotime($a->service_tanggal)); ?></td>
                                                    <td>
                                                        <?php if (!empty($a->service_link)) : ?>
                                                            <a href="<?= htmlspecialchars($a->service_link); ?>" target="_blank" class="text-info text-decoration-none">
                                                                <i class="fas fa-external-link-alt me-1"></i> Buka Link
                                                            </a>
                                                        <?php else : ?>
                                                            <span class="text-muted">-</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= ($a->service_status == 'publish')
                                                            ? '<span class="badge bg-success">Publish</span>'
                                                            : '<span class="badge bg-secondary">Draft</span>'; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a target="_blank" href="<?php echo base_url('book/') . $a->service_slug; ?>" class="btn btn-info" title="Lihat Layanan">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('dashboard/service_edit/' . $a->service_id); ?>" class="btn btn-warning" title="Edit Layanan">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('dashboard/service_hapus/' . $a->service_id); ?>" class="btn btn-danger" title="Hapus Layanan" onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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