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
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
            </div>
            <hr>
            <section class="navigation">
                <div class="row g-3">
                    <div class="col-xl-3 col-sm-6">
                        <div class="small-box bg-stat-box1">
                            <div class="inner">
                                <h3><?php echo $jumlah_artikel; ?></h3>
                                <p>Jumlah Artikel</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <a href="<?php echo base_url('dashboard/artikel'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>

                    <?php if ($this->session->userdata('level') == "admin") { ?>
                        <div class="col-xl-3 col-sm-6">
                            <div class="small-box bg-stat-box2">
                                <div class="inner">
                                    <h3><?php echo $jumlah_service; ?></h3>
                                    <p>Jumlah Layanan Buku</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <a href="<?php echo base_url('dashboard/service'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="small-box bg-stat-box3">
                                <div class="inner">
                                    <h3><?php echo $jumlah_pengguna; ?></h3>
                                    <p>Jumlah Pengguna</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="<?php echo base_url('dashboard/pengguna'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="small-box bg-stat-box4">
                                <div class="inner">
                                    <h3><?php echo $jumlah_komentar; ?></h3>
                                    <p>Jumlah Pesan Review</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <a href="<?php echo base_url('dashboard/pesan'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <hr>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-home me-2"></i> Dashboard Overview
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-dark mb-4 border-0 d-flex align-items-center" style="background: rgba(15, 15, 15, 0.6); color: #fff;">
                                    <i class="fas fa-hand-wave fa-2x me-3 text-white"></i>
                                    <div>
                                        <h5 class="mb-1 text-white">Selamat Datang, <strong><?php echo htmlspecialchars($user->pengguna_nama); ?></strong>!</h5>
                                        <small class="text-white-50">Anda login sebagai <strong><?php echo ucfirst($this->session->userdata('level')); ?></strong> di portal administrasi Zero Studios Book.</small>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover align-middle">
                                        <tbody>
                                            <tr>
                                                <th width="15%"><i class="fas fa-user me-2 text-white-50"></i>Nama Lengkap</th>
                                                <td width="2%">:</td>
                                                <td><?php echo htmlspecialchars($user->pengguna_nama); ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-at me-2 text-white-50"></i>Username</th>
                                                <td>:</td>
                                                <td><code><?php echo htmlspecialchars($this->session->userdata('username')); ?></code></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-envelope me-2 text-white-50"></i>Email</th>
                                                <td>:</td>
                                                <td><?php echo htmlspecialchars($user->pengguna_email); ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-shield-alt me-2 text-white-50"></i>Hak Akses</th>
                                                <td>:</td>
                                                <td>
                                                    <span class="badge bg-primary text-uppercase"><?php echo htmlspecialchars($this->session->userdata('level')); ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-check-circle me-2 text-white-50"></i>Status Akun</th>
                                                <td>:</td>
                                                <td>
                                                    <span class="badge bg-success">Aktif</span>
                                                </td>
                                            </tr>
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