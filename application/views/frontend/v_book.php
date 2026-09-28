<?php
// Build unique genre list from books for tab navigation
$genre_ids_present = [];
foreach ($genres as $genre) {
    $genre_books = array_filter($books, function($b) use ($genre) {
        return $b->buku_genre == $genre->genre_id;
    });
    if (!empty($genre_books)) {
        $genre_ids_present[] = $genre->genre_id;
    }
}
?>

<!-- Breadcrumb Banner -->
<section class="page-banner set-bg" data-setbg="<?php echo base_url('assets/img/normal-breadcrumb.jpg'); ?>">
    <div class="page-banner__overlay"></div>
    <div class="container">
        <div class="page-banner__content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>"><i class="fas fa-home me-1"></i>Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buku Kami</li>
                </ol>
            </nav>
            <h1 class="page-banner__title">Buku Kami</h1>
            <p class="page-banner__sub">Jelajahi seluruh koleksi buku Zero Studios</p>
        </div>
    </div>
</section>

<!-- Genre Tab Pills (only shown if multiple genres exist) -->
<?php if (count($genre_ids_present) > 1) : ?>
<div class="genre-tabs-bar">
    <div class="container">
        <div class="genre-tabs">
            <a href="#all" class="genre-tab-pill active" data-genre="all">Semua</a>
            <?php foreach ($genres as $genre) :
                $has = in_array($genre->genre_id, $genre_ids_present);
                if (!$has) continue;
            ?>
                <a href="#genre-<?php echo $genre->genre_id; ?>" class="genre-tab-pill" data-genre="<?php echo $genre->genre_id; ?>">
                    <?php echo htmlspecialchars($genre->genre_nama); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Book Listing -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 col-md-8">
                <?php
                $has_books = false;
                foreach ($genres as $genre) {
                    $genre_books = array_filter($books, function($b) use ($genre) {
                        return $b->buku_genre == $genre->genre_id;
                    });
                    if (empty($genre_books)) continue;
                    $has_books = true;
                ?>
                    <div class="genre-section mb-5" id="genre-<?php echo $genre->genre_id; ?>" data-genre-id="<?php echo $genre->genre_id; ?>">
                        <div class="section-title mb-3">
                            <h4><?php echo htmlspecialchars($genre->genre_nama); ?></h4>
                        </div>
                        <div class="row">
                            <?php foreach ($genre_books as $book) { ?>
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
                                            <?php if (!empty($book->genre_slug) && !empty($book->genre_nama)) : ?>
                                            <span class="book-card__genre">
                                                <a href="<?php echo base_url('genre/' . $book->genre_slug); ?>"><?php echo htmlspecialchars($book->genre_nama); ?></a>
                                            </span>
                                            <?php endif; ?>
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
                    </div>
                <?php } ?>

                <?php if (!$has_books) : ?>
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-book-open fa-3x mb-3" style="color:rgba(255,255,255,0.2);"></i>
                        <h4 class="text-white">Belum ada buku yang tersedia saat ini.</h4>
                        <p style="color:rgba(255,255,255,0.5);">Silakan cek kembali nanti.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 col-md-4">
                <?php $this->load->view('frontend/v_sidebar'); ?>
            </div>
        </div>
    </div>
</section>

<script>
// Genre tab pills — show/hide genre sections
(function() {
    var pills    = document.querySelectorAll('.genre-tab-pill');
    var sections = document.querySelectorAll('.genre-section');
    if (!pills.length || !sections.length) return;

    pills.forEach(function(pill) {
        pill.addEventListener('click', function(e) {
            e.preventDefault();
            pills.forEach(function(p) { p.classList.remove('active'); });
            pill.classList.add('active');

            var genre = pill.dataset.genre;
            sections.forEach(function(sec) {
                if (genre === 'all' || sec.dataset.genreId === genre) {
                    sec.style.display = '';
                } else {
                    sec.style.display = 'none';
                }
            });

            // smooth scroll to first visible section
            var first = (genre === 'all') ? sections[0] : document.getElementById('genre-' + genre);
            if (first) first.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
})();
</script>