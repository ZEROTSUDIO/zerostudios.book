<section class="normal-breadcrumb set-bg" data-setbg="<?php echo base_url('assets/img/normal-breadcrumb.jpg'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Pencarian Buku: <?php echo htmlspecialchars($cari); ?></h2>
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
                                <h4>Hasil Buku</h4>
                            </div>
                        </div>
                    </div>
                    <?php if (count($books) == 0) { ?>
                        <div class="text-center text-white py-5">
                            <h4>Buku yang dicari tidak ditemukan.</h4>
                            <p class="text-white-50 mt-2">Coba gunakan kata kunci lain di kolom pencarian.</p>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <?php foreach ($books as $book) { ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="<?php echo base_url('img/book/' . $book->buku_sampul); ?>">
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li><a href="<?php echo base_url('genre/' . $book->genre_slug); ?>"><?php echo htmlspecialchars($book->genre_nama); ?></a></li>
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