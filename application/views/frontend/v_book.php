<section class="normal-breadcrumb set-bg" data-setbg="<?php echo base_url('assets/img/normal-breadcrumb.jpg'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Buku Kami</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-page spad">
    <div class="container">
        <div class="row">
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
                    <div class="category mb-4">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4><?php echo htmlspecialchars($genre->genre_nama); ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- Books under this category -->
                        <div class="row">
                            <?php foreach ($genre_books as $book) { ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="<?php echo base_url('img/book/' . $book->buku_sampul); ?>">                                                
                                        </div>
                                        <div class="product__item__text">                                                
                                            <h5>
                                                <a href="<?php echo base_url('book/' . $book->service_slug); ?>"><?php echo htmlspecialchars($book->buku_judul); ?></a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!$has_books) : ?>
                    <div class="col-lg-12 text-center text-white py-5">
                        <h4>Belum ada buku yang tersedia saat ini.</h4>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 col-md-4">
                <?php $this->load->view('frontend/v_sidebar'); ?>
            </div>
        </div>
    </div>
</section>