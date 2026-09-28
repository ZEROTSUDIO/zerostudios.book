<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Zero Studios Book</title>
    <!-- Bootstrap 5.3.3 & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>
    <div class="container-fluid">
        <!-- Top Header Navigation (Putih) -->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('dashboard'); ?>">
                        <i class="fas fa-book-open"></i> <span>ZERO STUDIOS</span>
                    </a>
                </div>
                <div id="menu-button">
                    <button id="toggleButton" type="button" aria-label="Toggle Navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-end">
                        <?php 
                        $u_pic = $this->session->userdata('profile_picture');
                        $u_name = $this->session->userdata('username');
                        $pic_url = (!empty($u_pic) && file_exists(FCPATH . 'img/user/' . $u_pic))
                            ? base_url('img/user/' . $u_pic)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($u_name) . '&background=222c42&color=fff';
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 d-none d-md-inline text-dark fw-bold"><?php echo htmlspecialchars($u_name); ?></span>
                            <img src="<?php echo $pic_url; ?>" alt="<?php echo htmlspecialchars($u_name); ?>" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url('dashboard/profile'); ?>">
                                    <i class="fas fa-user-circle me-2"></i> Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url(''); ?>" target="_blank">
                                    <i class="fas fa-external-link-alt me-2"></i> Kunjungi Web
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Sidebar Navigation (Hitam) -->
        <div class="side-bar">
            <div class="side-header">
                <div class="list-item d-flex align-items-center">
                    <a href="<?php echo base_url('dashboard'); ?>" class="nav-link d-flex align-items-center">
                        <?php 
                        $logo_path = base_url('assets/img/logo.png');
                        if (file_exists(FCPATH . 'img/website/logo.png')) {
                            $logo_path = base_url('img/website/logo.png');
                        }
                        ?>
                        <img src="<?php echo $logo_path; ?>" alt="Logo">
                        <p class="menu-text">ADMIN PANEL</p>
                    </a>
                </div>
            </div>

            <div class="main-menu">
                <div class="list-item <?php echo (isset($active_page) && $active_page == 'dashboard') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('dashboard'); ?>">
                        <span class="description">
                            <i class="fas fa-tachometer-alt"></i>
                            <p class="menu-text">Dashboard</p>
                        </span>
                    </a>
                </div>

                <?php if ($this->session->userdata('level') == 'admin') { ?>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'buku') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/buku'); ?>">
                            <span class="description">
                                <i class="fas fa-book"></i>
                                <p class="menu-text">Data Buku</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'service') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/service'); ?>">
                            <span class="description">
                                <i class="fas fa-clipboard-list"></i>
                                <p class="menu-text">Layanan Buku</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'genre') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/genre'); ?>">
                            <span class="description">
                                <i class="fas fa-tags"></i>
                                <p class="menu-text">Genre</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'pages') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/pages'); ?>">
                            <span class="description">
                                <i class="fas fa-file-alt"></i>
                                <p class="menu-text">Halaman</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'kategori') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/kategori'); ?>">
                            <span class="description">
                                <i class="fas fa-th-large"></i>
                                <p class="menu-text">Kategori</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'news') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/artikel'); ?>">
                            <span class="description">
                                <i class="fas fa-newspaper"></i>
                                <p class="menu-text">Artikel / Berita</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'users') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/pengguna'); ?>">
                            <span class="description">
                                <i class="fas fa-users"></i>
                                <p class="menu-text">Pengguna</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'admin') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/admin'); ?>">
                            <span class="description">
                                <i class="fas fa-user-shield"></i>
                                <p class="menu-text">Administrator</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'pesan') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/pesan'); ?>">
                            <span class="description">
                                <i class="fas fa-envelope"></i>
                                <p class="menu-text">Pesan Review</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'pengaturan') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/pengaturan'); ?>">
                            <span class="description">
                                <i class="fas fa-cogs"></i>
                                <p class="menu-text">Pengaturan</p>
                            </span>
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'service') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/service'); ?>">
                            <span class="description">
                                <i class="fas fa-clipboard-list"></i>
                                <p class="menu-text">Layanan Buku</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'news') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/artikel'); ?>">
                            <span class="description">
                                <i class="fas fa-newspaper"></i>
                                <p class="menu-text">Artikel / Berita</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo (isset($active_page) && $active_page == 'pesan') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('dashboard/pesan'); ?>">
                            <span class="description">
                                <i class="fas fa-envelope"></i>
                                <p class="menu-text">Pesan Review</p>
                            </span>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="side-footer">
                <h2>ZERO STUDIOS</h2>
                <h5>BOOK PUBLISHING</h5>
            </div>
        </div>