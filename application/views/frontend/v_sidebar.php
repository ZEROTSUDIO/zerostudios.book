<?php
$artikel = $this->db->select('artikel.*, pengguna.pengguna_nama, kategori.kategori_nama')
    ->from('artikel')
    ->join('pengguna', 'artikel.artikel_author = pengguna.pengguna_id')
    ->join('kategori', 'artikel.artikel_kategori = kategori.kategori_id')
    ->where('artikel.artikel_status', 'publish')
    ->order_by('artikel.artikel_tanggal', 'DESC')
    ->limit(3)
    ->get()->result();

$buku = $this->db->select('b.buku_judul AS Judul_Buku, b.buku_sampul AS Sampul_Buku, g.genre_nama AS Nama_Genre, s.service_slug AS Slug_Service')
    ->from('service s')
    ->join('buku b', 's.service_buku = b.buku_id')
    ->join('genre g', 's.service_genre = g.genre_id')
    ->where('s.service_status', 'publish')
    ->order_by('s.service_id', 'DESC')
    ->limit(5)
    ->get()->result();
?>
<div class="product__sidebar">
    <div class="product__sidebar__search mb-4">
        <div class="section-title">
            <h5>Cari Buku</h5>
        </div>
        <?php echo form_open(base_url('book/search')); ?>
            <div class="input-group">
                <input name="cariw" type="text" class="form-control text-white" placeholder="Cari judul buku..." style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 4px 0 0 4px;" required />
                <div class="input-group-append">
                    <button class="btn btn-danger" type="submit" style="background: #e53637; border-color: #e53637; border-radius: 0 4px 4px 0;"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="product__sidebar__comment mb-4">
        <div class="section-title">
            <h5>New Book</h5>
        </div>
        <?php foreach ($buku as $b) { ?>
            <div class="product__sidebar__comment__item">
                <div class="product__sidebar__comment__item__pic" style="max-width: 80px;">
                    <img src="<?php echo base_url('img/book/' . $b->Sampul_Buku); ?>" alt="<?php echo htmlspecialchars($b->Judul_Buku); ?>" style="border-radius: 4px;" />
                </div>
                <div class="product__sidebar__comment__item__text">
                    <ul>
                        <li><?php echo htmlspecialchars($b->Nama_Genre); ?></li>
                    </ul>
                    <h5>
                        <a href="<?php echo base_url('book/' . $b->Slug_Service); ?>"><?php echo htmlspecialchars($b->Judul_Buku); ?></a>
                    </h5>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="product__sidebar__search mb-4">
        <div class="section-title">
            <h5>Cari Artikel</h5>
        </div>
        <?php echo form_open(base_url('search')); ?>
            <div class="input-group">
                <input name="cari" type="text" class="form-control text-white" placeholder="Cari artikel..." style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 4px 0 0 4px;" required />
                <div class="input-group-append">
                    <button class="btn btn-danger" type="submit" style="background: #e53637; border-color: #e53637; border-radius: 0 4px 4px 0;"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="product__sidebar__view">
        <div class="section-title">
            <h5>Artikel Terbaru Kami</h5>
        </div>
        <div class="filter__gallery">
            <?php foreach ($artikel as $a) { ?>
                <div class="product__sidebar__view__item set-bg mix day years" data-setbg="<?php echo base_url('img/artikel/' . $a->artikel_sampul); ?>" style="border-radius: 6px; overflow: hidden;">
                    <h5>
                        <a href="<?php echo base_url($a->artikel_slug); ?>">
                            <?php echo htmlspecialchars($a->artikel_judul); ?>
                        </a>
                        <small class="text-white d-block mt-1"><i class="far fa-calendar-alt mr-1"></i><?php echo date('d M Y', strtotime($a->artikel_tanggal)); ?></small>
                    </h5>
                </div>
            <?php } ?>
        </div>
    </div>
</div>