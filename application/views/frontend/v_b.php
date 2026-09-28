<section class="anime-details spad">
    <div class="container">
        <div class="anime__details__content">
            <div class="row">
                <?php if (count($books) == 0) { ?>
                    <div class="col-lg-12">
                        <div class="text-center mt-5 text-white"><h4>Buku Tidak Ditemukan</h4></div>
                    </div>
                <?php } else { ?>
                    <?php foreach ($books as $b) { ?>
                        <div class="col-lg-3">
                            <div class="anime__details__pic set-bg" data-setbg="<?php echo base_url('img/book/') . $b->buku_sampul ?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="anime__details__text">
                                <div class="anime__details__title">
                                    <h3><?php echo $b->buku_judul; ?></h3>
                                </div>
                                <div class="anime__details__widget">
                                    <ul>
                                        <li><span>Penulis:</span> <?php echo $b->buku_penulis; ?> </li>
                                        <li><span>Studios:</span> Zero Studios Book</li>
                                        <li><span>Tahun:</span> <?php echo !empty($b->buku_tahun) ? htmlspecialchars($b->buku_tahun) : '-'; ?></li>
                                        <li><span>Status:</span> <?php echo $b->service_status; ?></li>
                                        <li><span>Genre:</span> <?php echo $b->genre_nama; ?></li>
                                    </ul>
                                </div>
                                <div class="anime__details__btn">
                                    <a href="#" class="follow-btn"><i>Rp </i> <?php echo number_format($b->buku_harga, 0, ',', '.'); ?></a>
                                    <?php if (!empty($b->service_link) && $b->service_link !== '#') : ?>
                                        <a href="<?php echo $b->service_link; ?>" target="_blank" class="watch-btn"><span>Detail Karya</span> <i class="fa fa-angle-right"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="anime__details__synopsis">
                                <h4>Sinopsis:</h4>
                                <p><?php echo nl2br(htmlspecialchars($b->buku_sinopsis)); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php if (!empty($books)) : ?>
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="anime__details__review">
                    <div class="section-title">
                        <h5>Reviews</h5>
                    </div>
                    <?php
                    $subjeks = $books[0]->buku_judul;
                    $komen = $this->db->select('comment.*, pengguna.pengguna_nama, pengguna.pengguna_foto')
                        ->from('comment')
                        ->join('pengguna', 'comment.komen_pengguna = pengguna.pengguna_id')
                        ->where('comment.komen_subjek', $subjeks)
                        ->order_by('comment.komen_tanggal', 'DESC')
                        ->get()->result();

                    if (empty($komen)) {
                        echo '<p class="text-white-50">Belum ada review untuk buku ini. Jadilah yang pertama memberikan review!</p>';
                    } else {
                        foreach ($komen as $k) {
                            $foto = (!empty($k->pengguna_foto) && file_exists(FCPATH . 'img/user/' . $k->pengguna_foto))
                                ? base_url('img/user/' . $k->pengguna_foto)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($k->pengguna_nama) . '&background=e53637&color=fff';
                    ?>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="<?php echo $foto; ?>" alt="<?php echo htmlspecialchars($k->pengguna_nama); ?>" />
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
                        <h5>Tinggalkan Review</h5>
                    </div>
                    <?php if ($this->session->userdata('status') == 'telah_login') : ?>
                        <form action="<?php echo base_url('welcome/kirim_pesan') ?>" method="post">
                            <input type="hidden" name="tipe" value="buku">
                            <input type="hidden" name="id" value="<?php echo $books[0]->service_id; ?>">
                            <input type="hidden" name="subjek" value="<?php echo $books[0]->buku_judul; ?>">
                            <input type="hidden" name="slug" value="<?php echo $books[0]->service_slug; ?>">
                            <textarea placeholder="Tulis review Anda tentang buku ini..." id="pesan" name="konten" required></textarea>
                            <button type="submit">
                                <i class="fa fa-paper-plane"></i> Review
                            </button>
                        </form>
                    <?php else : ?>
                        <div class="alert alert-dark text-white" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            Silakan <a href="<?php echo base_url('login'); ?>" class="text-danger font-weight-bold">login</a> terlebih dahulu untuk memberikan review.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <?php $this->load->view('frontend/v_sidebar'); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>