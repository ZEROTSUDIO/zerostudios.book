<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pengaturan->nama; ?> - <?php echo $pengaturan->deskripsi; ?></title>
    <meta content="<?php echo $meta_keyword; ?>" name="keywords">
    <meta content="<?php echo $meta_description; ?>" name="description">
    <link href="<?php echo base_url() . '/img/website/' . $pengaturan->logo; ?>" rel="icon">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CDN & Stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/slicknav.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/elegant-icons.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style3.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style4.css'); ?>" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header"  style="position:sticky; top: 0; z-index: 1000;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 nav-left">
                    <div class="header__logo d-flex">
                        <a class="d-flex" href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url() . '/img/website/' . $pengaturan->logo; ?>" alt="" width="30px" class="mr-">
                            <div class="page-title">
                                <h5><?php echo $pengaturan->nama; ?></h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="<?php echo base_url(''); ?>">Homepage</a></li>
                                <li><a href="<?php echo base_url('book'); ?>">Buku</a></li>
                                <li><a href="#">Categories <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <?php $genre = $this->db->query("SELECT * FROM genre")->result();
                                        foreach ($genre as $g) {
                                        ?>
                                            <li><a href="<?php echo base_url('genre/') . $g->genre_slug; ?>"><?php echo $g->genre_nama; ?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url('page/tentang-kami'); ?>">Tentang Kami</a></li>
                                <li><a href="<?php echo base_url('page/kontak-kami'); ?>">Kontak</a></li>
                                <li><a href="<?php echo base_url('blog'); ?>">Berita</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header__right mobile-menu">
                        <?php if ($this->session->userdata('status') == 'telah_login') : ?>
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="<?php echo base_url('/img/user/' . $this->session->userdata('profile_picture')); ?>" alt="Profile Picture" width="30px" class="rounded-circle">
                                        <?php echo $this->session->userdata('username'); ?>
                                    </a>
                                    <ul class="dropdown">
                                        <li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>">Profil</a></li>
                                        <?php if ($this->session->userdata('level') != 'user') : ?>
                                            <li><a class="dropdown-item" href="<?php echo base_url('login/dashboard'); ?>">Dashboard</a></li>
                                        <?php endif; ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>

                        <?php else : ?>
                            <ul>
                                <li><a href="<?php echo base_url('login'); ?>"><span>Masuk <i class="fas fa-sign-in"></i></span></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap">
            </div>
        </div>
    </header>