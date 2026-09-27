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
                        <li class="breadcrumb-item active" aria-current="page">Pesan Review</li>
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
                                    <i class="fas fa-envelope me-2"></i> Data Pesan Review <span class="badge bg-secondary ms-2 fw-normal">Ulasan Pembaca</span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th width="3%" class="text-center">No</th>
                                                <th width="15%">Pengirim</th>
                                                <th width="14%">Waktu</th>
                                                <th width="20%">Subjek Pesan</th>
                                                <th>Isi Pesan</th>
                                                <th width="6%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($pesan as $p) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td><strong><?php echo htmlspecialchars($p->pengguna_nama); ?></strong></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($p->komen_tanggal)); ?></td>
                                                    <td><?php echo htmlspecialchars($p->komen_subjek); ?></td>
                                                    <td><?php echo nl2br(htmlspecialchars($p->komen_konten)); ?></td>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url('dashboard/pesan_hapus/' . $p->komen_id); ?>" class="btn btn-sm btn-danger" title="Hapus Pesan" onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
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