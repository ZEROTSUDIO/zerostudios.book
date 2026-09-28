<?php
// Limit hero to 5 items
$hero_books = array_slice($buku, 0, 5);
?>

<!-- ===================== HERO SECTION ===================== -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <?php foreach ($hero_books as $b) { ?>
            <div class="hero__items">
                <!-- Background image via real <img> with CSS overlay -->
                <img
                    src="<?php echo base_url('/img/book/') . $b->buku_sampul; ?>"
                    alt="<?php echo htmlspecialchars($b->buku_judul); ?>"
                    class="hero__bg-img"
                >
                <div class="hero__overlay"></div>
                <div class="container h-100">
                    <div class="row h-100 align-items-end">
                        <div class="col-lg-6 col-md-8">
                            <div class="hero__text">
                                <a href="<?php echo base_url('genre/') . $b->genre_slug; ?>">
                                    <div class="label"><?php echo htmlspecialchars($b->genre_nama); ?></div>
                                </a>
                                <h2><?php echo htmlspecialchars($b->buku_judul); ?></h2>
                                <p><?php echo truncateSynopsis($b->buku_sinopsis, 110); ?></p>
                                <a href="<?php echo base_url('book/') . $b->service_slug; ?>">
                                    <span>Baca Sekarang</span>
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<!-- ===================== WELCOME SECTION ===================== -->
<section class="hero-welcome spad">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <div class="welcome__tagline">
                    <span class="welcome__label">Zero Studios Book</span>
                    <h2 class="welcome__title">Selamat Datang di<br><strong>Zerostudios Book</strong></h2>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="welcome__desc">
                    <p>Tempat di mana imajinasi bertemu dengan realitas. Kami adalah rumah bagi karya-karya literatur yang menginspirasi, mempesona, dan mengubah cara Anda melihat dunia.</p>
                    <p>Temukan buku-buku yang memikat hati dan pikiran — dari petualangan penuh aksi hingga eksplorasi mendalam tentang kehidupan dan cinta.</p>
                    <a href="<?php echo base_url('book'); ?>" class="site-btn">Jelajahi Koleksi <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== LATEST BOOKS SECTION ===================== -->
<section class="product spad pt-0">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-8">
                <div class="section-title mb-0">
                    <h4>Buku Terbaru</h4>
                </div>
            </div>
            <div class="col-4">
                <div class="btn__all">
                    <a href="<?php echo base_url('book'); ?>" class="primary-btn">Lihat Semua <span class="arrow_right"></span></a>
                </div>
            </div>
        </div>

        <!-- Book Cards Grid -->
        <div class="row">
            <?php
            $display_books = array_slice($buku, 0, 8);
            foreach ($display_books as $b) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                    <div class="book-card">
                        <a href="<?php echo base_url('book/') . $b->service_slug; ?>" class="book-card__link">
                            <div class="book-card__pic">
                                <img
                                    src="<?php echo base_url('/img/book/' . $b->buku_sampul); ?>"
                                    alt="<?php echo htmlspecialchars($b->buku_judul); ?>"
                                    loading="lazy"
                                >
                                <div class="book-card__overlay">
                                    <span class="book-card__cta"><i class="fas fa-book-open me-1"></i> Baca</span>
                                </div>
                            </div>
                        </a>
                        <div class="book-card__text">
                            <span class="book-card__genre">
                                <a href="<?php echo base_url('genre/') . $b->genre_slug; ?>"><?php echo htmlspecialchars($b->genre_nama); ?></a>
                            </span>
                            <h5>
                                <a href="<?php echo base_url('book/') . $b->service_slug; ?>"><?php echo htmlspecialchars($b->buku_judul); ?></a>
                            </h5>
                            <?php if (!empty($b->buku_penulis)) { ?>
                                <small class="book-card__author"><i class="fas fa-pen-nib me-1"></i><?php echo htmlspecialchars($b->buku_penulis); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <hr class="divider-line">

        <!-- ===================== LATEST ARTICLES ===================== -->
        <div class="row mb-4 align-items-center mt-5">
            <div class="col-8">
                <div class="section-title mb-0">
                    <h4>Artikel Terbaru</h4>
                </div>
            </div>
            <div class="col-4">
                <div class="btn__all">
                    <a href="<?php echo base_url('blog'); ?>" class="primary-btn">Lihat Semua <span class="arrow_right"></span></a>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($artikel as $a) {
                $author_pic = 'https://ui-avatars.com/api/?name=' . urlencode($a->pengguna_nama) . '&background=e53637&color=fff&size=40';
                $excerpt = mb_strimwidth(strip_tags($a->artikel_konten ?? ''), 0, 115, '...');
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-blog">
                        <div class="card-img" style="overflow:hidden; position:relative;">
                            <a href="<?php echo base_url() . $a->artikel_slug; ?>">
                                <img
                                    src="<?php echo base_url('/img/artikel/' . $a->artikel_sampul); ?>"
                                    alt="<?php echo htmlspecialchars($a->artikel_judul); ?>"
                                    style="width:100%; height:200px; object-fit:cover; transition:transform 0.4s ease;"
                                    onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'"
                                >
                            </a>
                            <!-- Category badge overlaid on image -->
                            <a href="<?php echo base_url() . 'kategori/' . $a->kategori_slug; ?>" class="article-cat-badge">
                                <?php echo htmlspecialchars($a->kategori_nama); ?>
                            </a>
                        </div>
                        <div class="card-body pt-3">
                            <h3 class="card-title">
                                <a href="<?php echo base_url() . $a->artikel_slug; ?>"><?php echo htmlspecialchars($a->artikel_judul); ?></a>
                            </h3>
                            <?php if (!empty($excerpt)) { ?>
                                <p class="card-description" style="font-size:0.88rem; line-height:1.6;"><?php echo $excerpt; ?></p>
                            <?php } ?>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="post-author d-flex align-items-center gap-2">
                                <img src="<?php echo $author_pic; ?>" alt="<?php echo htmlspecialchars($a->pengguna_nama); ?>" width="24" height="24" class="rounded-circle">
                                <span><?php echo htmlspecialchars($a->pengguna_nama); ?></span>
                            </div>
                            <div class="post-date">
                                <i class="far fa-calendar-alt me-1"></i><?php echo date('d M Y', strtotime($a->artikel_tanggal)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</section>