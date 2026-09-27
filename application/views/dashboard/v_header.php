<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zerostudios Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>
    <div class="container-fluid">
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><i class="fas fa-language"></i> ZERO STUDIOS </a>
                </div>
                <div id="menu-button">
                    <button id="toggleButton">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                            <?php echo $this->session->userdata('username') ?>
                            <img src="<?php echo base_url('img/user/') . $this->session->userdata('profile_picture'); ?>" alt="" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('dashboard/profile'); ?>"><i class="fas fa-user"></i> Profile</a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('login'); ?>"><i class="fas fa-user-plus"></i> Sign In </a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo base_url(''); ?>"><i class="fas fa-reply"></i> Keluar </a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="side-bar">
            <div class="side-header">
                <div class="list-item d-flex align-items-center">
                    <a href="#" class="nav-link d-flex align-items-center">
                        <img src="<?php echo base_url('img/website/logo.png') ?>" alt="">
                        <p class="menu-text" style="margin: 0;">ADMIN DASHBOARD</p>
                    </a>
                </div>
                <hr>
            </div>

            <div class="main-menu">
                <div class="list-item <?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url() . 'dashboard' ?>">
                        <span class="description">
                            <i class="fas fa-tachometer-alt" style="margin-right: 14px; font-size:24;"></i>
                            <p class="menu-text">Dashboard</p>
                        </span>
                    </a>
                </div>
                <?php if ($_SESSION['pengguna_level'] == 'admin') { ?>
                    <div class="list-item <?php echo ($active_page == 'buku') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/buku' ?>">
                            <span class="description">
                                <i class="fas fa-book" style="margin-right: 17px; font-size:24;"></i>
                                <p class="menu-text">Buku</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'service') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/service' ?>">
                            <span class="description">
                                <i class="fas fa-clipboard" style="margin-right: 20px; font-size:24;"></i>
                                <p class="menu-text">Service</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'genre') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/genre' ?>">
                            <span class="description">
                                <i class="fas fa-tags" style="margin-right: 14px; font-size:24;"></i>
                                <p class="menu-text">Genre</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'pages') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/pages' ?>">
                            <span class="description">
                                <i class="fas fa-file-alt" style="margin-right: 20px; font-size:24;"></i>
                                <p class="menu-text">Page</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'kategori') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/kategori' ?>">
                            <span class="description">
                                <i class="fas fa-th" style="margin-right: 14px; font-size:24;"></i>
                                <p class="menu-text">Kategori</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'news') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/artikel' ?>">
                            <span class="description">
                                <i class="fas fa-newspaper" style="margin-right: 14px; font-size:24;"></i>
                                <p class="menu-text">News</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'users') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/pengguna' ?>">
                            <span class="description">
                                <i class="fas fa-user" style="margin-right: 17px; font-size:24;"></i>
                                <p class="menu-text">User</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'admin') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/admin' ?>">
                            <span class="description">
                                <i class="fas fa-user-shield" style="margin-right: 8px; font-size:24;"></i>
                                <p class="menu-text">Admin</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'pesan') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/pesan' ?>">
                            <span class="description">
                                <i class="fas fa-envelope" style="margin-right: 14px; font-size:24;"></i>
                                <p class="menu-text">Pesan</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'pengaturan') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/pengaturan' ?>">
                            <span class="description">
                                <i class="fas fa-cogs" style="margin-right: 8px; font-size:24;"></i>
                                <p class="menu-text">Pengaturan</p>
                            </span>
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="list-item <?php echo ($active_page == 'service') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/service' ?>">
                            <span class="description">
                                <i class="fas fa-clipboard" style="margin-right: 20px; font-size:24;"></i>
                                <p class="menu-text">Service</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'news') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/artikel' ?>">
                            <span class="description">
                                <i class="fas fa-newspaper" style="margin-right: 14px; font-size:24;"></i>
                                <p class="menu-text">News</p>
                            </span>
                        </a>
                    </div>
                    <div class="list-item <?php echo ($active_page == 'pesan') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url() . 'dashboard/pesan' ?>">
                            <span class="description">
                                <i class="fas fa-envelope" style="margin-right: 14px; font-size:24;"></i>
                                <p class="menu-text">Pesan</p>
                            </span>
                        </a>
                    </div>
                <?php } ?>
            </div>



            <div class="side-footer text-center">
                <hr>
                <h2>ZERO STUDIOS</h2>
                <h5>PRODUCTION</h5>
            </div>
        </div>