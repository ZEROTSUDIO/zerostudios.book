<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            <?php foreach ($buku as $b) {
            ?>
                <div class="hero__items set-bg" data-setbg="<?php echo base_url('/img/book/') . $b->buku_sampul; ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <a href="<?php echo base_url('genre/') . $b->genre_slug; ?>">
                                    <div class="label"><?php echo $b->genre_nama ?></div>
                                </a>
                                <h2><?php echo $b->buku_judul ?></h2>
                                <p><?php echo truncateSynopsis($b->buku_sinopsis, 100); ?></p>
                                <a href="<?php echo base_url('book/') . $b->service_slug; ?>">
                                    <span>Baca Sekarang</span>
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</section>

<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="blog__details__title">
                    <h6>Action, Magic <span>- April 04, 2024</span></h6>
                    <h2>SELAMAT DATANG DI ZEROSTUDIOS BOOK</h2>
                    <div class="blog__details__social">
                        <a href="<?php echo $pengaturan->link_facebook; ?>" class="facebook" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
                        <a href="<?php echo $pengaturan->link_instagram; ?>" class="pinterest" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                        <a href="<?php echo $pengaturan->link_github; ?>" class="linkedin" target="_blank"><i class="fab fa-github"></i> Github</a>
                        <a href="<?php echo $pengaturan->link_twitter; ?>" class="twitter" target="_blank"><i class="fab fa-x-twitter"></i> Twitter</a>
                    </div>
                </div>
            </div>
            <hr>
            <!--
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="img/blog/details/blog-details-pic.jpg" alt="">
                </div>
        
            </div>-->
            <div class="col-lg-10">
                <div class="blog__details__content">
                    <div class="blog__details__text">
                        <p>Terima kasih telah mengunjungi Zero Studios, tempat di mana imajinasi bertemu
                            dengan realitas. Kami adalah rumah bagi karya-karya literatur yang menginspirasi,
                            mempesona, dan mengubah cara Anda melihat dunia.</p>
                        <p>Di sini, Anda akan menemukan buku-buku yang memikat hati dan pikiran
                            dari cerita-cerita penuh petualangan hingga eksplorasi mendalam tentang kehidupan
                            dan cinta. Setiap halaman yang kami buat diisi dengan keajaiban dan penemuan baru.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Buku Terbaru</h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="<?php echo base_url('book')?>" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <!-- book-->
                    <div class="row">
                        <?php foreach ($buku as $b) { ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?php echo base_url('/img/book/' . $b->buku_sampul); ?>">
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li><a href="<?php echo base_url('genre/') . $b->genre_slug; ?>"><?php echo $b->genre_nama; ?></a></li>
                                        </ul>
                                        <h5>
                                            <a href="<?php echo base_url('book/') . $b->service_slug; ?>"><?php echo $b->buku_judul; ?></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="artikel">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="section-title">
                        <h4>Artikel Terbaru</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="btn__all">
                        <a href="<?php echo base_url('blog')?>" class="primary-btn">View All <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($artikel as $a) {
                ?>
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-img" style="overflow: hidden;">
                                <a href="<?php echo base_url() . $a->artikel_slug; ?>">
                                    <img src="<?php echo base_url('/img/artikel/' . $a->artikel_sampul); ?>" style="width: 100%; max-height: 200px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="card-category-box">
                                    <div class="card-category">
                                        <a href="<?php echo base_url() . 'kategori/' . $a->kategori_slug; ?>">
                                            <h6 class="category"><?php echo $a->kategori_nama ?></h6>
                                        </a>
                                    </div>
                                </div>
                                <h3 class="card-title">
                                    <a href="<?php echo base_url() . $a->artikel_slug ?>"><?php echo $a->artikel_judul ?></a>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="post-author">
                                    <i class="far fa-user text-muted mr-1"></i> <span class="author"><?php echo $a->pengguna_nama; ?></span>
                                </div>
                                <div class="post-date">
                                    <i class="far fa-clock text-muted mr-1"></i> <?php echo date('d M Y', strtotime($a->artikel_tanggal)); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
        </div>
    </div>
</section>