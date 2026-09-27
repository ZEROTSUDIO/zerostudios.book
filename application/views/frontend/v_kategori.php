<section class="normal-breadcrumb set-bg" data-setbg="<?php echo base_url('assets/img/normal-breadcrumb.jpg'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Kategori: <?php echo !empty($artikel) ? htmlspecialchars($artikel[0]->kategori_nama) : 'Artikel Kami'; ?></h2>
                    <p>Temukan artikel dan wawasan menarik seputar dunia literasi</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog spad blog-wrapper" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <?php if (count($artikel) == 0) { ?>
                    <div class="text-center text-white py-5">
                        <h4>Artikel dalam kategori ini belum tersedia.</h4>
                    </div>
                <?php } ?>
                <?php foreach ($artikel as $a) { ?>
                    <div class="post-box mb-4">
                        <div class="post-thumb">
                            <?php if ($a->artikel_sampul != "") { ?>
                                <div class="image-container">
                                    <img src="<?php echo base_url('img/artikel/' . $a->artikel_sampul); ?>" alt="<?php echo htmlspecialchars($a->artikel_judul); ?>">
                                </div>
                            <?php } ?>
                        </div>
                        <div class="post-meta p-3">
                            <a href="<?php echo base_url($a->artikel_slug); ?>">
                                <h2 class="article-title"><?php echo htmlspecialchars($a->artikel_judul); ?></h2>
                            </a>
                        </div>
                        <div class="blog-footer">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <i class="fas fa-user-edit mr-1"></i>
                                    <span><?php echo htmlspecialchars($a->pengguna_nama); ?></span>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fas fa-tag mr-1"></i>
                                    <a href="<?php echo base_url('kategori/' . $a->kategori_slug); ?>" class="text-danger font-weight-bold">
                                        <?php echo htmlspecialchars($a->kategori_nama); ?>
                                    </a>
                                </li>
                            </ul>
                            <span class="artikel-tanggal"><i class="far fa-calendar-alt mr-1"></i><?php echo date('d M Y', strtotime($a->artikel_tanggal)); ?></span>
                        </div>
                    </div>
                <?php } ?>
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