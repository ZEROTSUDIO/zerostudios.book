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
                        <li class="breadcrumb-item active" aria-current="page"><a href="">Buku</a></li>
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
                                    <i class="fas fa-book me-2"></i> Data Buku <span class="badge bg-secondary ms-2 fw-normal">Daftar Buku</span>
                                </h5>
                                <a href="<?php echo base_url('dashboard/buku_tambah'); ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus me-1"></i> Tambah Buku
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th width="3%" class="text-center">No</th>
                                                <th width="8%" class="text-center">Sampul</th>
                                                <th>Judul</th>
                                                <th>Penulis</th>
                                                <th>Genre</th>
                                                <th>Harga</th>
                                                <th class="text-center" width="12%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($buku as $a) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td class="text-center">
                                                        <img class="table-thumb-book" src="<?php echo base_url('img/book/') . $a->buku_sampul; ?>" alt="<?php echo htmlspecialchars($a->buku_judul); ?>">
                                                    </td>
                                                    <td><strong><?php echo htmlspecialchars($a->buku_judul); ?></strong></td>
                                                    <td><?php echo htmlspecialchars($a->buku_penulis); ?></td>
                                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($a->genre_nama); ?></span></td>
                                                    <td>Rp <?php echo number_format($a->buku_harga, 0, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a href="<?php echo base_url('dashboard/buku_edit/' . $a->buku_id); ?>" class="btn btn-warning" title="Edit Buku">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('dashboard/buku_hapus/' . $a->buku_id); ?>" class="btn btn-danger" title="Hapus Buku" onclick="return confirm('Yakin ingin menghapus data buku ini?')">
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