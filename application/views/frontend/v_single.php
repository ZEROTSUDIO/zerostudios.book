<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row d-flex justify-content-center">
                    <?php if (count($artikel) == 0) { ?>
                        <div class="col-lg-12">
                            <center class="mt-5">Artikel Tidak Ditemukan</center>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($artikel as $a) { ?>
                            <div class="col-lg-12">
                                <div class="blog__details__title">
                                    <h6><a href="<?php echo base_url('kategori/') . $a->kategori_slug ?>"><?php echo $a->kategori_nama ?></a> <span>- <?php echo $a->artikel_tanggal ?></span></h6>
                                    <h2><?php echo $a->artikel_judul ?></h2>
                                    <div class="blog__details__social">
                                        <a href="<?php echo $pengaturan->link_facebook; ?>" class="facebook" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
                                        <a href="<?php echo $pengaturan->link_instagram; ?>" class="pinterest" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                                        <a href="<?php echo $pengaturan->link_github; ?>" class="linkedin" target="_blank"><i class="fab fa-github"></i> Github</a>
                                        <a href="<?php echo $pengaturan->link_twitter; ?>" class="twitter" target="_blank"><i class="fab fa-x-twitter"></i> Twitter</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="blog__details__pic">
                                    <img src="<?php echo base_url('img/artikel/') . $a->artikel_sampul ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="blog__details__content">
                                    <?php echo $a->artikel_konten ?>
                                    <!--div class="blog__details__form">
                                        <h4>Leave A Comment</h4>
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input type="text" placeholder="Name">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input type="text" placeholder="Email">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea placeholder="Message"></textarea>
                                                    <button type="submit" class="site-btn">Send Message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div-->
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="anime__details__review">
                    <div class="section-title">
                        <h5>Komentar</h5>
                    </div>
                    <?php
                    $subjeks = $artikel[0]->artikel_judul;
                    $komen = $this->db->select('comment.*, pengguna.pengguna_nama, pengguna.pengguna_foto')
                                      ->from('comment')
                                      ->join('pengguna', 'comment.komen_pengguna = pengguna.pengguna_id')
                                      ->where('comment.komen_subjek', $subjeks)
                                      ->order_by('comment.komen_tanggal', 'DESC')
                                      ->get()
                                      ->result();

                    if (empty($komen)) {
                        echo '<p class="text-white-50">Belum ada komentar untuk artikel ini.</p>';
                    } else {
                        foreach ($komen as $k) {
                            $foto = (!empty($k->pengguna_foto) && file_exists(FCPATH . 'img/user/' . $k->pengguna_foto))
                                ? base_url('img/user/' . $k->pengguna_foto)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($k->pengguna_nama) . '&background=e53637&color=fff';
                    ?>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="<?php echo $foto; ?>" alt="<?php echo htmlspecialchars($k->pengguna_nama); ?>" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;" />
                            </div>
                            <div class="anime__review__item__text">
                                <h6><?php echo htmlspecialchars($k->pengguna_nama); ?> - <span><?php echo date('d M Y, H:i', strtotime($k->komen_tanggal)); ?></span></h6>
                                <p>
                                    <?php echo htmlspecialchars($k->komen_konten); ?>
                                </p>
                            </div>
                        </div>
                    <?php } } ?>
                </div>
                <div class="anime__details__form">
                    <div class="section-title">
                        <h5>Tulis Komentar</h5>
                    </div>
                    <?php if ($this->session->userdata('status') == 'telah_login') : ?>
                        <form action="<?php echo base_url('welcome/kirim_pesan'); ?>" method="post">
                            <?php foreach ($artikel as $b) { ?>
                                <input type="hidden" name="tipe" value="artikel">
                                <input type="hidden" name="id" value="<?php echo $b->artikel_id; ?>">
                                <input type="hidden" name="subjek" value="<?php echo $b->artikel_judul; ?>">
                                <input type="hidden" name="slug" value="<?php echo $b->artikel_slug; ?>">
                            <?php } ?>
                            <textarea placeholder="Tulis komentar Anda..." id="pesan" name="konten" required></textarea>
                            <button type="submit">
                                <i class="fa fa-paper-plane"></i> Kirim Komentar
                            </button>
                        </form>
                    <?php else : ?>
                        <div class="alert alert-dark text-white" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            Silakan <a href="<?php echo base_url('login'); ?>" class="text-danger font-weight-bold">login</a> terlebih dahulu untuk memberikan komentar.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <?php $this->load->view('frontend/v_sidebar'); ?>
            </div>
        </div>
    </div>
</section>