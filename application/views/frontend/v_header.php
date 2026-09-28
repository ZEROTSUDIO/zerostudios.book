<!DOCTYPE html>
<html lang="id">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/slicknav.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/elegant-icons.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style3.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style4.css'); ?>" type="text/css">
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Search Overlay -->
    <div id="search-overlay" class="search-overlay" aria-hidden="true">
        <div class="search-overlay__inner">
            <button id="search-close" class="search-overlay__close" aria-label="Tutup pencarian">
                <i class="fas fa-times"></i>
            </button>
            <div class="search-overlay__tabs">
                <button class="search-tab active" data-target="search-book-form">📚 Buku</button>
                <button class="search-tab" data-target="search-article-form">📰 Artikel</button>
            </div>
            <?php echo form_open(base_url('book/search'), ['id' => 'search-book-form', 'class' => 'search-overlay__form']); ?>
                <input type="text" name="cariw" class="search-overlay__input" placeholder="Cari judul buku..." autocomplete="off" />
                <button type="submit" class="search-overlay__btn"><i class="fas fa-search"></i></button>
            </form>
            <?php echo form_open(base_url('search'), ['id' => 'search-article-form', 'class' => 'search-overlay__form d-none']); ?>
                <input type="text" name="cari" class="search-overlay__input" placeholder="Cari artikel..." autocomplete="off" />
                <button type="submit" class="search-overlay__btn"><i class="fas fa-search"></i></button>
            </form>
            <p class="search-overlay__hint">Tekan <kbd>Esc</kbd> untuk menutup</p>
        </div>
    </div>

    <!-- Header Section -->
    <?php
    $current_url = current_url();
    $base        = base_url();
    function nav_active($url) {
        return (strpos(current_url(), $url) !== false) ? 'active' : '';
    }
    ?>
    <header class="header header--sticky" id="site-header">
        <div class="container-fluid">
            <div class="row align-items-center">

                <!-- Logo -->
                <div class="col-md-2 nav-left">
                    <div class="header__logo d-flex align-items-center">
                        <a class="d-flex align-items-center" href="<?php echo base_url(''); ?>">
                            <?php
                            $logo_file = (!empty($pengaturan->logo) && file_exists(FCPATH . 'img/website/' . $pengaturan->logo))
                                ? base_url('img/website/' . $pengaturan->logo)
                                : base_url('assets/img/logo.png');
                            ?>
                            <img src="<?php echo $logo_file; ?>" alt="<?php echo htmlspecialchars($pengaturan->nama); ?>" width="30" height="30" class="me-2 rounded">
                            <div class="page-title">
                                <h5 class="mb-0 text-white fw-bold"><?php echo htmlspecialchars($pengaturan->nama); ?></h5>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Nav -->
                <div class="col-md-7">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="<?php echo (rtrim($current_url, '/') === rtrim($base, '/')) ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url(''); ?>">Beranda</a>
                                </li>
                                <li class="<?php echo (strpos($current_url, base_url('book')) !== false) ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('book'); ?>">Buku</a>
                                </li>
                                <li class="<?php echo (strpos($current_url, base_url('genre')) !== false) ? 'active' : ''; ?>">
                                    <a href="#">Genre <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <?php
                                        $genre = $this->db->get('genre')->result();
                                        foreach ($genre as $g) {
                                        ?>
                                            <li><a href="<?php echo base_url('genre/' . $g->genre_slug); ?>"><?php echo htmlspecialchars($g->genre_nama); ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li class="<?php echo (strpos($current_url, base_url('page')) !== false) ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('page/tentang-kami'); ?>">Tentang Kami</a>
                                </li>
                                <li class="<?php echo (strpos($current_url, base_url('page/kontak')) !== false) ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('page/kontak-kami'); ?>">Kontak</a>
                                </li>
                                <li class="<?php echo (strpos($current_url, base_url('blog')) !== false || strpos($current_url, base_url('kategori')) !== false) ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('blog'); ?>">Berita</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Right: search + user -->
                <div class="col-md-3">
                    <div class="header__right d-flex align-items-center justify-content-end gap-3">

                        <!-- Search toggle -->
                        <button class="header__search-btn" id="search-open" aria-label="Buka pencarian">
                            <i class="fas fa-search"></i>
                        </button>

                        <?php if ($this->session->userdata('status') == 'telah_login') :
                            $user_pic  = $this->session->userdata('profile_picture');
                            $user_name = $this->session->userdata('username');
                            $pic_url   = (!empty($user_pic) && file_exists(FCPATH . 'img/user/' . $user_pic))
                                ? base_url('img/user/' . $user_pic)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user_name) . '&background=e53637&color=fff';
                        ?>
                            <ul class="mb-0">
                                <li>
                                    <a href="#">
                                        <img src="<?php echo $pic_url; ?>" alt="<?php echo htmlspecialchars($user_name); ?>" width="30" height="30" class="rounded-circle me-1">
                                        <?php echo htmlspecialchars($user_name); ?>
                                    </a>
                                    <ul class="dropdown">
                                        <li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>"><i class="fas fa-user fa-fw me-1"></i>Profil</a></li>
                                        <?php if ($this->session->userdata('level') != 'user') : ?>
                                            <li><a class="dropdown-item" href="<?php echo base_url('login/dashboard'); ?>"><i class="fas fa-gauge fa-fw me-1"></i>Dashboard</a></li>
                                        <?php endif; ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>"><i class="fas fa-right-from-bracket fa-fw me-1"></i>Logout</a></li>
                                    </ul>
                                </li>
                            </ul>

                        <?php else : ?>
                            <a href="<?php echo base_url('login'); ?>" class="header__login-btn">
                                Masuk <i class="fas fa-right-to-bracket ms-1"></i>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>

    <script>
    // Header scroll-shrink
    (function() {
        var header = document.getElementById('site-header');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 60) {
                header.classList.add('header--scrolled');
            } else {
                header.classList.remove('header--scrolled');
            }
        }, { passive: true });
    })();

    // Search overlay
    (function() {
        var overlay    = document.getElementById('search-overlay');
        var openBtn    = document.getElementById('search-open');
        var closeBtn   = document.getElementById('search-close');
        var tabs       = document.querySelectorAll('.search-tab');
        var firstInput = overlay.querySelector('.search-overlay__input');

        function openOverlay() {
            overlay.classList.add('is-open');
            overlay.setAttribute('aria-hidden', 'false');
            setTimeout(function() { firstInput && firstInput.focus(); }, 200);
        }
        function closeOverlay() {
            overlay.classList.remove('is-open');
            overlay.setAttribute('aria-hidden', 'true');
        }

        openBtn.addEventListener('click', openOverlay);
        closeBtn.addEventListener('click', closeOverlay);
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeOverlay();
        });

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                tabs.forEach(function(t) { t.classList.remove('active'); });
                tab.classList.add('active');
                var target = document.getElementById(tab.dataset.target);
                overlay.querySelectorAll('.search-overlay__form').forEach(function(f) { f.classList.add('d-none'); });
                target.classList.remove('d-none');
                target.querySelector('input').focus();
            });
        });
    })();
    </script>
</body>