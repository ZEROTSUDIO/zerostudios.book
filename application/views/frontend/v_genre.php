<?php
$genre_name = !empty($books) ? htmlspecialchars($books[0]->genre_nama) : 'Koleksi Buku';
$genre_slug = !empty($books) ? $books[0]->genre_slug : '';
?>

<!-- Genre Hero Banner -->
<section class="genre-hero">
    <div class="genre-hero__bg set-bg" data-setbg="<?php echo base_url('assets/img/normal-breadcrumb.jpg'); ?>">
        <div class="genre-hero__overlay"></div>
    </div>
    <div class="container">
        <div class="genre-hero__content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>"><i class="fas fa-home me-1"></i>Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('book'); ?>">Buku</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $genre_name; ?></li>
                </ol>
            </nav>
            <div class="genre-hero__label">Genre</div>
            <h1 class="genre-hero__title"><?php echo $genre_name; ?></h1>
            <p class="genre-hero__count">
                <?php echo count($books); ?> buku tersedia
            </p>
        </div>
    </div>
</section>

<!-- Book Listing -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 col-md-8">
                <div class="section-title mb-4">
                    <h4>Daftar Buku</h4>
                </div>

                <?php if (count($books) == 0) : ?>
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-book-open fa-3x mb-3" style="color:rgba(255,255,255,0.2);"></i>
                        <h4 class="text-white">Belum ada buku dalam genre ini.</h4>
                        <p style="color:rgba(255,255,255,0.5);">Silakan cek genre lainnya.</p>
                        <a href="<?php echo base_url('book'); ?>" class="site-btn mt-2">Lihat Semua Buku</a>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <?php foreach ($books as $book) { ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 mb-4">
                                <div class="book-card">
                                    <a href="<?php echo base_url('book/' . $book->service_slug); ?>" class="book-card__link">
                                        <div class="book-card__pic">
                                            <img
                                                src="<?php echo base_url('img/book/' . $book->buku_sampul); ?>"
                                                alt="<?php echo htmlspecialchars($book->buku_judul); ?>"
                                                loading="lazy"
                                            >
                                            <div class="book-card__overlay">
                                                <span class="book-card__cta"><i class="fas fa-book-open me-1"></i>Baca</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="book-card__text">
                                        <span class="book-card__genre">
                                            <a href="<?php echo base_url('genre/' . $book->genre_slug); ?>"><?php echo htmlspecialchars($book->genre_nama); ?></a>
                                        </span>
                                        <h5>
                                            <a href="<?php echo base_url('book/' . $book->service_slug); ?>"><?php echo htmlspecialchars($book->buku_judul); ?></a>
                                        </h5>
                                        <?php if (!empty($book->buku_penulis)) : ?>
                                            <small class="book-card__author"><i class="fas fa-pen-nib me-1"></i><?php echo htmlspecialchars($book->buku_penulis); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-3">
                        <?php echo $this->pagination->create_links(); ?>
                    </nav>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 col-md-4">
                <?php $this->load->view('frontend/v_sidebar'); ?>
            </div>
        </div>
    </div>
</section>