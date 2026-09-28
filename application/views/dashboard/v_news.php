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
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">News</a></li>
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
                                    <i class="fas fa-newspaper me-2"></i> Data Artikel <span class="badge bg-secondary ms-2 fw-normal">Daftar Artikel</span>
                                </h5>
                                <a href="<?php echo base_url('dashboard/artikel_tambah'); ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus me-1"></i> Tambah Artikel
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle table-datatable">
                                        <thead>
                                            <tr>
                                                <th width="4%" class="text-center no-sort">No</th>
                                                <th width="8%" class="text-center no-sort">Sampul</th>
                                                <th>Judul Artikel</th>
                                                <th>Penulis</th>
                                                <th>Kategori</th>
                                                <th width="12%">Tanggal</th>
                                                <th width="8%" class="text-center">Status</th>
                                                <th width="12%" class="text-center no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($artikel as $a) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td class="text-center">
                                                        <img class="table-thumb-news" src="<?php echo base_url('img/artikel/') . $a->artikel_sampul; ?>" alt="<?php echo htmlspecialchars($a->artikel_judul); ?>">
                                                    </td>
                                                    <td><strong><?php echo htmlspecialchars($a->artikel_judul); ?></strong></td>
                                                    <td><?php echo htmlspecialchars($a->pengguna_nama); ?></td>
                                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($a->kategori_nama); ?></span></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($a->artikel_tanggal)); ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($a->artikel_status == "publish") {
                                                            echo "<span class='badge bg-success'>Publish</span>";
                                                        } else {
                                                            echo "<span class='badge bg-secondary'>Draft</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a target="_blank" href="<?php echo base_url($a->artikel_slug); ?>" class="btn btn-info" title="Lihat Artikel">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <?php if ($this->session->userdata('level') != 'penulis' || $this->session->userdata('id') == $a->artikel_author) { ?>
                                                                <a href="<?php echo base_url('dashboard/artikel_edit/' . $a->artikel_id); ?>" class="btn btn-warning" title="Edit Artikel">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="<?php echo base_url('dashboard/artikel_hapus/' . $a->artikel_id); ?>" class="btn btn-danger" title="Hapus Artikel" onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            <?php } ?>
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