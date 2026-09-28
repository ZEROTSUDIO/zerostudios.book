<?php
$id_user = $this->session->userdata('id');
$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
?>
<div class="container-fluid">
    <div class="main-content">
        <div class="container mt-3">
            <div class="content-header">
                <h5 id="Date" class="mb-0"></h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard' ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard/buku' ?>">Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Tambah Buku</a></li>
                    </ol>
                </nav>
            </div>
            <hr>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12 connectedSortable">
                        <div class="card card-outline card-info">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">
                                    <i class="nav-icon fas fa-book"></i> Data Buku |<small> Tambah Buku Baru</small>
                                </h3>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalGoogleBooks">
                                        <i class="fas fa-magic me-1"></i> Auto-Fill dari Google Books
                                    </button>
                                    <a href="<?php echo base_url('dashboard/buku'); ?>" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?php echo base_url('dashboard/buku_aksi') ?>" method="post" enctype="multipart/form-data">
                                    <!-- Hidden field untuk URL sampul dari API -->
                                    <input type="hidden" id="buku_sampul_api_url" name="buku_sampul_api_url" value="">

                                    <div class="row mb-3">
                                        <div class="form-group col-md-9">
                                            <label for="buku_judul" class="form-label">Judul Buku</label>
                                            <input type="text" class="form-control" id="buku_judul" name="buku_judul" placeholder="Contoh: Laskar Pelangi" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="buku_genre" class="form-label">Genre Buku</label>
                                            <select class="form-select" id="buku_genre" name="buku_genre" required>
                                                <option value="" disabled selected>Pilih Genre</option>
                                                <?php
                                                foreach ($genre as $k) {
                                                ?>
                                                    <option <?php if (set_value('genre') == $k->genre_id) {
                                                                echo "selected='selected'";
                                                            } ?> value="<?php echo $k->genre_id; ?>">
                                                        <?php echo $k->genre_nama; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-md-4">
                                            <label for="buku_sampul" class="form-label">Sampul Buku</label>
                                            <input type="file" class="form-control" id="buku_sampul" name="buku_sampul" required>
                                            <?php if (isset($gambar_error)) {
                                                echo $gambar_error;
                                            }
                                            echo form_error('sampul');
                                            ?>
                                            <!-- Preview Cover dari Google Books API -->
                                            <div id="api_cover_preview" class="mt-2 d-none">
                                                <div class="d-flex align-items-center gap-2 p-2 rounded" style="background: rgba(255,255,255,0.06); border: 1px dashed rgba(255,255,255,0.25);">
                                                    <img id="api_cover_img" src="" alt="Cover Preview" style="width: 44px; height: 62px; object-fit: cover; border-radius: 4px;">
                                                    <div class="small flex-grow-1">
                                                        <span class="badge bg-success mb-1">Cover Google API Terpilih</span>
                                                        <div class="text-white-50" style="font-size: 11px;">Otomatis diunduh ke folder server saat disimpan.</div>
                                                        <button type="button" class="btn btn-link btn-sm text-danger p-0 mt-1" id="btn_cancel_api_cover" style="font-size: 11.5px; text-decoration: none;">
                                                            <i class="fas fa-times me-1"></i> Batal & Gunakan Upload File
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="buku_penulis" class="form-label">Penulis Buku</label>
                                            <input type="text" class="form-control" id="buku_penulis" name="buku_penulis" placeholder="Nama penulis/pengarang" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="buku_harga" class="form-label">Harga Buku (Rp)</label>
                                            <input type="number" class="form-control" id="buku_harga" name="buku_harga" placeholder="Contoh: 45000" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-md-12">
                                            <label for="buku_sinopsis" class="form-label">Sinopsis Buku</label>
                                            <textarea class="form-control" id="buku_sinopsis" name="buku_sinopsis" rows="6" placeholder="Ringkasan cerita atau sinopsis..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="fas fa-save me-1"></i> Simpan Buku
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div>
                </div>
            </section>
            <!-- /.content -->

            <!-- Modal Cari Google Books API -->
            <div class="modal fade" id="modalGoogleBooks" tabindex="-1" aria-labelledby="modalGoogleBooksLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalGoogleBooksLabel">
                                <i class="fas fa-book-reader text-info me-2"></i> Cari & Auto-Fill Buku Cerita (Google Books API)
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="api_search_query" placeholder="Ketik judul buku cerita (misal: Laskar Pelangi, Harry Potter, Bumi Manusia)...">
                                <button class="btn btn-primary" type="button" id="btn_search_api">
                                    <i class="fas fa-search me-1"></i> Cari Buku
                                </button>
                            </div>

                            <div id="api_search_loading" class="text-center py-4 d-none">
                                <div class="spinner-border text-info" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-white-50 small mb-0">Menghubungi Google Books API...</p>
                            </div>

                            <div id="api_search_empty" class="text-center py-4 d-none">
                                <i class="fas fa-search-minus fa-3x text-white-50 mb-2"></i>
                                <p class="text-white-50 mb-0">Tidak ada buku cerita yang cocok. Coba kata kunci atau judul lain.</p>
                            </div>

                            <div id="api_search_results" class="d-flex flex-column gap-3">
                                <!-- Kartu hasil pencarian akan dimuat di sini -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <small class="text-white-50 me-auto"><i class="fas fa-info-circle me-1"></i> Data judul, penulis, sinopsis & sampul akan terisi otomatis ke form.</small>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Script Interaktif Auto-Fill -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var btnSearch = document.getElementById('btn_search_api');
                    var inputSearch = document.getElementById('api_search_query');
                    var loading = document.getElementById('api_search_loading');
                    var emptyState = document.getElementById('api_search_empty');
                    var resultsContainer = document.getElementById('api_search_results');

                    var inputJudul = document.getElementById('buku_judul');
                    var inputPenulis = document.getElementById('buku_penulis');
                    var inputSinopsis = document.getElementById('buku_sinopsis');
                    var inputSampul = document.getElementById('buku_sampul');
                    var hiddenSampulUrl = document.getElementById('buku_sampul_api_url');
                    var apiCoverPreview = document.getElementById('api_cover_preview');
                    var apiCoverImg = document.getElementById('api_cover_img');
                    var btnCancelApiCover = document.getElementById('btn_cancel_api_cover');

                    // Fungsi jalankan pencarian
                    function performSearch() {
                        var q = inputSearch.value.trim();
                        if (!q) {
                            alert('Silakan masukkan judul buku cerita yang ingin dicari.');
                            return;
                        }

                        loading.classList.remove('d-none');
                        emptyState.classList.add('d-none');
                        resultsContainer.innerHTML = '';

                        var url = '<?php echo base_url("dashboard/cari_buku_api"); ?>?q=' + encodeURIComponent(q);

                        fetch(url)
                            .then(function (res) { return res.json(); })
                            .then(function (res) {
                                loading.classList.add('d-none');
                                if (res.status === 'success' && res.data && res.data.length > 0) {
                                    renderResults(res.data);
                                } else {
                                    emptyState.classList.remove('d-none');
                                }
                            })
                            .catch(function (err) {
                                loading.classList.add('d-none');
                                alert('Terjadi kesalahan saat memuat data: ' + err);
                            });
                    }

                    // Render kartu buku
                    function renderResults(books) {
                        resultsContainer.innerHTML = '';
                        books.forEach(function (book, idx) {
                            var thumb = book.thumbnail ? book.thumbnail : 'https://via.placeholder.com/80x120?text=No+Cover';
                            var cleanDesc = book.description ? book.description.replace(/"/g, '&quot;') : '';

                            var card = document.createElement('div');
                            card.className = 'p-3 rounded d-flex gap-3 align-items-start';
                            card.style.background = 'rgba(255, 255, 255, 0.05)';
                            card.style.border = '1px solid rgba(255, 255, 255, 0.1)';

                            var innerHtml = '<img src="' + thumb + '" alt="' + book.title + '" style="width: 70px; height: 100px; object-fit: cover; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.5); flex-shrink: 0;">' +
                                '<div class="flex-grow-1 min-w-0">' +
                                    '<div class="d-flex justify-content-between align-items-start gap-2">' +
                                        '<h6 class="fw-bold text-white mb-1">' + book.title + '</h6>' +
                                        '<button type="button" class="btn btn-sm btn-success text-nowrap btn-pilih-buku px-3 py-1" data-index="' + idx + '">' +
                                            '<i class="fas fa-check me-1"></i> Gunakan' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="text-white-50 small mb-1"><i class="fas fa-pen-nib me-1"></i> ' + book.authors + ' &bull; <span class="badge bg-secondary">' + book.published_date + '</span></div>' +
                                    '<p class="small text-light mb-0" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; color: #b0b3b8 !important;">' +
                                        book.description +
                                    '</p>' +
                                '</div>';

                            card.innerHTML = innerHtml;
                            resultsContainer.appendChild(card);

                            // Pasang handler tombol gunakan
                            card.querySelector('.btn-pilih-buku').addEventListener('click', function () {
                                applyBook(book);
                            });
                        });
                    }

                    // Terapkan data ke form input
                    function applyBook(book) {
                        inputJudul.value = book.title;
                        inputPenulis.value = book.authors;
                        inputSinopsis.value = book.description;

                        if (book.thumbnail) {
                            hiddenSampulUrl.value = book.thumbnail;
                            apiCoverImg.src = book.thumbnail;
                            apiCoverPreview.classList.remove('d-none');
                            // Tidak wajibkan file upload jika cover API sudah dipilih
                            inputSampul.removeAttribute('required');
                        }

                        // Tutup modal
                        var modalEl = document.getElementById('modalGoogleBooks');
                        var modalInstance = bootstrap.Modal.getInstance(modalEl);
                        if (modalInstance) {
                            modalInstance.hide();
                        }

                        // Efek fokus visual
                        inputJudul.focus();
                    }

                    // Batal pakai cover API
                    btnCancelApiCover.addEventListener('click', function () {
                        hiddenSampulUrl.value = '';
                        apiCoverImg.src = '';
                        apiCoverPreview.classList.add('d-none');
                        inputSampul.setAttribute('required', 'required');
                    });

                    // Event listener pencarian
                    btnSearch.addEventListener('click', performSearch);
                    inputSearch.addEventListener('keypress', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            performSearch();
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- /.content-wrapper -->