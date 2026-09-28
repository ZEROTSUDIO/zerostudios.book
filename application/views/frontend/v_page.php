<section class="normal-breadcrumb set-bg" data-setbg="<?php echo base_url('assets/img/normal-breadcrumb.jpg'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2><?php echo !empty($halaman) ? htmlspecialchars($halaman[0]->halaman_judul) : 'Halaman'; ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog spad blog-wrapper" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row d-flex justify-content-center">
                    <?php if (count($halaman) == 0) { ?>
                        <div class="col-lg-12">
                            <div class="text-center mt-5 text-white"><h4>Halaman Tidak Ditemukan</h4></div>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($halaman as $h) { ?>
                            <div class="col-lg-10">
                                <div class="blog__details__title mb-4">                                    
                                    <h2 class="text-white mb-3"><?php echo htmlspecialchars($h->halaman_judul); ?></h2>
                                    <div class="blog__details__social">
                                        <?php if (!empty($pengaturan->link_facebook)) : ?>
                                            <a href="<?php echo $pengaturan->link_facebook; ?>" target="_blank" class="facebook"><i class="fab fa-facebook"></i> Facebook</a>
                                        <?php endif; ?>
                                        <?php if (!empty($pengaturan->link_instagram)) : ?>
                                            <a href="<?php echo $pengaturan->link_instagram; ?>" target="_blank" class="pinterest"><i class="fab fa-instagram"></i> Instagram</a>
                                        <?php endif; ?>
                                        <?php if (!empty($pengaturan->link_github)) : ?>
                                            <a href="<?php echo $pengaturan->link_github; ?>" target="_blank" class="linkedin"><i class="fab fa-github"></i> Github</a>
                                        <?php endif; ?>
                                        <?php if (!empty($pengaturan->link_twitter)) : ?>
                                            <a href="<?php echo $pengaturan->link_twitter; ?>" target="_blank" class="twitter"><i class="fab fa-x-twitter"></i> Twitter</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="blog__details__content text-white">
                                    <?php echo $h->halaman_konten; ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>