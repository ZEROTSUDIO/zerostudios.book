<section class="normal-breadcrumb set-bg" data-setbg="<?php echo base_url('assets/img/normal-breadcrumb.jpg'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Genre: <?php echo !empty($books) ? htmlspecialchars($books[0]->genre_nama) : 'Koleksi Buku'; ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="category">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Daftar Buku</h4>
                            </div>
                        </div>
                    </div>
                    <?php if (count($books) == 0) { ?>
                        <div class="text-center text-white py-5">
                            <h4>Belum ada buku dalam genre ini.</h4>
                        </div>
                    <?php } else { ?>
                        <!-- Books under this category -->
                        <div class="row">
                            <?php foreach ($books as $book) { ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="<?php echo base_url('img/book/' . $book->buku_sampul); ?>">
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li><?php echo htmlspecialchars($book->genre_nama); ?></li>
                                            </ul>
                                            <h5>
                                                <a href="<?php echo base_url('book/' . $book->service_slug); ?>"><?php echo htmlspecialchars($book->buku_judul); ?></a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <nav aria-label="Page navigation" class="mt-4">
                    <?php echo $this->pagination->create_links(); ?>
                </nav>
            </div>
            <div class="col-lg-4 col-md-4">
                <?php $this->load->view('frontend/v_sidebar'); ?>
            </div>
        </div>
    </div>
</section>