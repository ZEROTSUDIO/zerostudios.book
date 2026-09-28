<?php
defined('BASEPATH') or exit('No script direct access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('m_login');
        $this->load->model('m_data');
        if ($this->session->userdata('status') != "telah_login") {
            redirect('login?alert=belum_login');
        }
        if ($this->session->userdata('level') == "user" || $this->session->userdata('aktif') == "0") {
            redirect('page/forbidden');
        }
    }

    function forbidden()
    {
        $data['active_page'] = 'dashboard';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_forbidden', $data);
        $this->load->view('dashboard/v_footer');
    }

    function index()
    {
        //hitung jumlah artikel
        $data['jumlah_artikel'] = $this->m_data->get_data('artikel')->num_rows();
        //hitung jumlah kategori
        $data['jumlah_service'] = $this->m_data->get_data('service')->num_rows();
        //hitung jumlah pengguna
        $data['jumlah_pengguna'] = $this->m_data->get_data('pengguna')->num_rows();
        //hitung jumlah halaman
        $data['jumlah_komentar'] = $this->m_data->get_data('comment')->num_rows();
        $data['active_page'] = 'dashboard';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    //genre
    public function genre()
    {
        if ($this->session->userdata('level') != 'admin') {
            //$data['active_page'] = 'input';
            redirect(base_url() . 'dashboard/forbidden');
        } else {
            $data['genre'] = $this->m_data->get_data('genre')->result();
            $data['active_page'] = 'genre';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_genre', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function genre_tambah()
    {
        $data['active_page'] = 'genre';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_genre_tambah');
        $this->load->view('dashboard/v_footer');
    }
    public function genre_tambah_aksi()
    {
        $this->form_validation->set_rules('genre', 'genre', 'required');
        if ($this->form_validation->run() != false) {
            $genre = $this->input->post('genre');
            $data = array(
                'genre_nama' => $genre,
                'genre_slug' => strtolower(url_title($genre))
            );
            $this->m_data->insert_data('genre', $data);
            redirect(base_url() . 'dashboard/genre');
        } else {
            $data['active_page'] = 'genre';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_genre_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }
    public function genre_edit($id)
    {
        $where = array(
            'genre_id' => $id
        );
        $data['genre'] = $this->m_data->edit_data('genre', $where)->result();
        $data['active_page'] = 'genre';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_genre_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function genre_update()
    {
        $this->form_validation->set_rules('genre', 'genre', 'required');
        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $genre = $this->input->post('genre');
            $where = array(
                'genre_id' => $id
            );
            $data = array(
                'genre_nama' => $genre,
                'genre_slug' => strtolower(url_title($genre))
            );
            $this->m_data->update_data('genre', $data, $where);
            redirect(base_url() . 'dashboard/genre');
        } else {
            $id = $this->input->post('id');
            $where = array(
                'genre_id' => $id
            );
            $data['genre'] = $this->m_data->edit_data('genre', $where)->result();
            $data['active_page'] = 'genre';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_genre_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function genre_hapus($id)
    {
        $where = array(
            'genre_id' => $id
        );
        $this->m_data->delete_data('genre', $where);
        redirect(base_url() . 'dashboard/genre');
    }

    //buku
    public function buku()
    {
        $data['buku'] = $this->db->query('SELECT * FROM buku ,genre WHERE buku_genre=genre_id
        order by buku_id desc')->result();
        $data['active_page'] = 'buku';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_buku', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function buku_tambah()
    {
        $data['genre'] = $this->m_data->get_data('genre')->result();
        $data['active_page'] = 'buku';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_buku_tambah', $data);
        $this->load->view('dashboard/v_footer');
    }
    // Endpoint AJAX: Cari Buku dari Google Books API
    public function cari_buku_api()
    {
        header('Content-Type: application/json');

        if ($this->session->userdata('level') != 'admin') {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }

        $q = trim($this->input->get('q', TRUE) ?: $this->input->post('q', TRUE));
        if (empty($q)) {
            echo json_encode(['status' => 'error', 'message' => 'Kata kunci pencarian tidak boleh kosong']);
            return;
        }

        // Load config google_books
        $this->config->load('google_books', TRUE);
        $api_key = $this->config->item('google_books_api_key', 'google_books');

        $query_encoded = urlencode($q);
        $url = "https://www.googleapis.com/books/v1/volumes?q={$query_encoded}&maxResults=10";
        if (!empty($api_key)) {
            $url .= "&key={$api_key}";
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZeroStudios-Book/1.0 (Windows NT 10.0)');
        $response = curl_exec($ch);
        $curl_error = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $http_code !== 200) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghubungi Google Books API. ' . $curl_error]);
            return;
        }

        $res = json_decode($response, true);
        $books = [];
        if (!empty($res['items'])) {
            foreach ($res['items'] as $item) {
                $info = $item['volumeInfo'] ?? [];
                $title = $info['title'] ?? 'Tanpa Judul';
                $authors = isset($info['authors']) ? implode(', ', $info['authors']) : 'Penulis Tidak Diketahui';
                $description = $info['description'] ?? 'Tidak ada sinopsis resmi.';
                
                // Cover image URL
                $thumbnail = '';
                if (!empty($info['imageLinks']['thumbnail'])) {
                    $thumbnail = str_replace('http://', 'https://', $info['imageLinks']['thumbnail']);
                } elseif (!empty($info['imageLinks']['smallThumbnail'])) {
                    $thumbnail = str_replace('http://', 'https://', $info['imageLinks']['smallThumbnail']);
                }

                $published_date = $info['publishedDate'] ?? '-';
                $publisher = $info['publisher'] ?? '-';
                $categories = isset($info['categories']) ? implode(', ', $info['categories']) : 'Cerita / Fiksi';
                $page_count = $info['pageCount'] ?? 0;

                $books[] = [
                    'title' => $title,
                    'authors' => $authors,
                    'description' => $description,
                    'thumbnail' => $thumbnail,
                    'published_date' => $published_date,
                    'publisher' => $publisher,
                    'categories' => $categories,
                    'page_count' => $page_count
                ];
            }
        }

        echo json_encode(['status' => 'success', 'data' => $books]);
    }

    // Helper unduh sampul dari URL Google Books ke folder lokal img/book/
    private function _download_cover_from_url($url)
    {
        if (empty($url)) return false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
        $img_data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($img_data && $http_code == 200) {
            $filename = 'gb_' . uniqid() . '.jpg';
            $save_path = FCPATH . 'img/book/' . $filename;
            if (file_put_contents($save_path, $img_data)) {
                return $filename;
            }
        }
        return false;
    }

    public function buku_aksi()
    {
        $judul = $this->input->post('buku_judul');
        $sinopsis = $this->input->post('buku_sinopsis');
        $penulis = $this->input->post('buku_penulis');
        $genre = $this->input->post('buku_genre');
        $harga = $this->input->post('buku_harga');
        $api_sampul_url = $this->input->post('buku_sampul_api_url');
        $sampul = '';

        // Opsi 1: Jika admin mengunggah file manual dari perangkat
        if (!empty($_FILES['buku_sampul']['name'])) {
            $config['upload_path'] = './img/book/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $new_filename = uniqid() . '.' . pathinfo($_FILES['buku_sampul']['name'], PATHINFO_EXTENSION);
            $config['file_name'] = $new_filename;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('buku_sampul')) {
                $gambar = $this->upload->data();
                $sampul = $gambar['file_name'];
            } else {
                $this->form_validation->set_message('buku_sampul', $data['gambar_error'] = $this->upload->display_errors());
                $data['genre'] = $this->m_data->get_data('genre')->result();
                $data['active_page'] = 'buku';
                $this->load->view('dashboard/v_header', $data);
                $this->load->view('dashboard/v_buku_tambah', $data);
                $this->load->view('dashboard/v_footer');
                return;
            }
        } elseif (!empty($api_sampul_url)) {
            // Opsi 2: Jika admin memilih cover dari Google Books API, unduh ke folder lokal img/book/
            $downloaded = $this->_download_cover_from_url($api_sampul_url);
            if ($downloaded) {
                $sampul = $downloaded;
            }
        }

        // Fallback jika tidak ada cover
        if (empty($sampul)) {
            $sampul = 'default.jpg';
        }

        $data = array(
            'buku_judul' => $judul,
            'buku_sampul' => $sampul,
            'buku_penulis' => $penulis,
            'buku_sinopsis' => $sinopsis,
            'buku_genre' => $genre,
            'buku_harga' => $harga
        );

        $this->m_data->insert_data('buku', $data);
        redirect(base_url() . 'dashboard/buku');
    }

    public function buku_edit($id)
    {
        $where = array(
            'buku_id' => $id
        );
        $data['buku'] = $this->m_data->edit_data('buku', $where)->result();
        $data['genre'] = $this->m_data->get_data('genre')->result();
        $data['active_page'] = 'buku';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_buku_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function buku_update()
    {
        $id = $this->input->post('id');
        $judul = $this->input->post('buku_judul');
        $sinopsis = $this->input->post('buku_sinopsis');
        $penulis = $this->input->post('buku_penulis');
        $genre = $this->input->post('buku_genre');
        $harga = $this->input->post('buku_harga');

        $where = array(
            'buku_id' => $id
        );

        // Update book details first
        $data = array(
            'buku_judul' => $judul,
            'buku_penulis' => $penulis,
            'buku_sinopsis' => $sinopsis,
            'buku_genre' => $genre,
            'buku_harga' => $harga
        );
        $this->m_data->update_data('buku', $data, $where);

        // Check if a new cover file is uploaded
        if (!empty($_FILES['buku_sampul']['name'])) {
            $config['upload_path'] = './img/book/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            // Generate a new file name
            $new_filename = uniqid() . '.' . pathinfo($_FILES['buku_sampul']['name'], PATHINFO_EXTENSION);
            $config['file_name'] = $new_filename;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('buku_sampul')) {
                $gambar = $this->upload->data();
                $data = array(
                    'buku_sampul' => $gambar['file_name']
                );
                $this->m_data->update_data('buku', $data, $where);
                redirect(base_url() . 'dashboard/buku');
            } else {
                $this->load->library('form_validation');
                $this->form_validation->set_message('buku_sampul', $data['gambar_error'] = $this->upload->display_errors());

                $data['buku'] = $this->m_data->edit_data('buku', $where)->result();
                $data['active_page'] = 'buku';
                $this->load->view('dashboard/v_header', $data);
                $this->load->view('dashboard/v_buku_edit', $data);
                $this->load->view('dashboard/v_footer');
            }
        } else {
            redirect(base_url() . 'dashboard/buku');
        }
    }


    public function buku_hapus($id)
    {
        $where = array(
            'buku_id' => $id
        );
        $this->m_data->delete_data('buku', $where);
        redirect(base_url() . 'dashboard/buku');
    }

    //service buku

    public function service()
    {
        $data['service'] = $this->db->query('SELECT * FROM service, buku, genre
        WHERE service_buku=buku_id
        and service_genre=genre_id
        order by service_id desc')->result();
        $data['active_page'] = 'service';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_service', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function service_tambah()
    {
        $data['active_page'] = 'service';
        $data['buku'] = $this->m_data->get_data('buku')->result();
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_service_tambah', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function service_aksi()
    {
        $this->form_validation->set_rules('buku_id', 'Buku', 'required');
        $this->form_validation->set_rules('service_konten', 'Konten', 'required');
        $this->form_validation->set_rules('service_link', 'Link', 'required');
        if ($this->form_validation->run() != false) {
            $tanggal = date('Y-m-d H:i:s');
            $judul = $this->input->post('buku_id');
            $buku = $this->db->get_where('buku', array('buku_id' => $judul))->row();
            $slug = strtolower(url_title($buku->buku_judul));
            $konten = $this->input->post('service_konten');
            $link = $this->input->post('service_link');
            $genre = $buku->buku_genre;
            $status = $this->input->post('service_status');
            $data = array(
                'service_buku' => $judul,
                'service_tanggal' => $tanggal,
                'service_slug' => $slug,
                'service_konten' => $konten,
                'service_link' => $link,
                'service_genre' => $genre,
                'service_status' => $status
            );
            $this->m_data->insert_data('service', $data);
            redirect(base_url() . 'dashboard/service');
        } else {
            redirect(base_url() . 'dashboard/service_tambah');
        }
    }
    public function service_edit($id)
    {
        $where = array(
            'service_id' => $id
        );
        $data['service'] = $this->m_data->edit_data('service', $where)->result();
        $data['buku'] = $this->m_data->get_data('buku')->result();
        $data['active_page'] = 'service';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_service_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function service_update()
    {
        $this->form_validation->set_rules('buku_id', 'Buku', 'required');
        $this->form_validation->set_rules('service_konten', 'Konten', 'required');
        $this->form_validation->set_rules('service_link', 'Link', 'required');
        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');
            $konten = $this->input->post('service_konten');
            $link = $this->input->post('service_link');
            $status = $this->input->post('service_status');
            $judul = $this->input->post('buku_id');
            $buku = $this->db->get_where('buku', array('buku_id' => $judul))->row();
            $slug = strtolower(url_title($buku->buku_judul));
            $where = array(
                'service_id' => $id
            );
            $data = array(
                'service_slug' => $slug,
                'service_konten' => $konten,
                'service_link' => $link,
                'service_status' => $status
            );
            $this->m_data->update_data('service', $data, $where);
            redirect(base_url() . 'dashboard/service');
        } else {
            $id = $this->input->post('id');
            $where = array(
                'service_id' => $id
            );
            $data['service'] = $this->m_data->edit_data('service', $where)->result();
            $data['buku'] = $this->m_data->get_data('buku')->result();
            $data['active_page'] = 'service';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_service_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function service_hapus($id)
    {
        $where = array(
            'service_id' => $id
        );
        $this->m_data->delete_data('service', $where);
        redirect(base_url() . 'dashboard/service');
    }

    //pages

    public function pages()
    {
        if ($this->session->userdata('level') != 'admin') {
            //$data['active_page'] = 'input';
            redirect(base_url() . 'dashboard/forbidden');
        } else {
            $data['halaman'] = $this->m_data->get_data('halaman')->result();
            $data['active_page'] = 'pages';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pages', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function pages_tambah()
    {
        $data['active_page'] = 'pages';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_pages_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function pages_aksi()
    {
        // Wajib isi judul dan konten
        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[halaman.halaman_judul]');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        if ($this->form_validation->run() != false) {
            $judul = $this->input->post('judul');
            $slug = strtolower(url_title($judul));
            $konten = $this->input->post('konten');
            $data = array(
                'halaman_judul' => $judul,
                'halaman_slug' => $slug,
                'halaman_konten' => $konten
            );
            $this->m_data->insert_data('halaman', $data);
            redirect(base_url() . 'dashboard/pages');
        } else {
            $data['active_page'] = 'pages';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pages_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }
    public function pages_edit($id)
    {
        $where = array('halaman_id' => $id);
        $data['halaman'] = $this->m_data->edit_data('halaman', $where)->result();
        $data['active_page'] = 'pages';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_pages_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function pages_update()
    {
        // Wajib isi judul dan konten
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $slug = strtolower(url_title($judul));
            $konten = $this->input->post('konten');
            $where = array(
                'halaman_id' => $id
            );
            $data = array(
                'halaman_judul' => $judul,
                'halaman_slug' => $slug,
                'halaman_konten' => $konten
            );
            $this->m_data->update_data('halaman', $data, $where);
            redirect(base_url() . 'dashboard/pages');
        } else {
            $id = $this->input->post('id');
            $where = array('halaman_id' => $id);
            $data['halaman'] = $this->m_data->edit_data('halaman', $where)->result();
            $data['active_page'] = 'pages';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pages_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function pages_hapus($id)
    {
        $where = array(
            'halaman_id' => $id
        );
        $this->m_data->delete_data('halaman', $where);
        redirect(base_url() . 'dashboard/pages');
    }

    //kategori

    public function kategori()
    {
        if ($this->session->userdata('level') != 'admin') {
            //$data['active_page'] = 'input';
            redirect(base_url() . 'dashboard/forbidden');
        } else {
            $data['kategori'] = $this->m_data->get_data('kategori')->result();
            $data['active_page'] = 'kategori';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_kategori', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function kategori_tambah()
    {
        $data['active_page'] = 'kategori';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_kategori_tambah');
        $this->load->view('dashboard/v_footer');
    }
    public function kategori_tambah_aksi()
    {
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        if ($this->form_validation->run() != false) {
            $kategori = $this->input->post('kategori');
            $data = array(
                'kategori_nama' => $kategori,
                'kategori_slug' => strtolower(url_title($kategori))
            );
            $this->m_data->insert_data('kategori', $data);
            redirect(base_url() . 'dashboard/kategori');
        } else {
            $data['active_page'] = 'kategori';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_kategori_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }
    public function kategori_edit($id)
    {
        $where = array(
            'kategori_id' => $id
        );
        $data['kategori'] = $this->m_data->edit_data('kategori', $where)->result();
        $data['active_page'] = 'kategori';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_kategori_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function kategori_update()
    {
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $kategori = $this->input->post('kategori');
            $where = array(
                'kategori_id' => $id
            );
            $data = array(
                'kategori_nama' => $kategori,
                'kategori_slug' => strtolower(url_title($kategori))
            );
            $this->m_data->update_data('kategori', $data, $where);
            redirect(base_url() . 'dashboard/kategori');
        } else {
            $id = $this->input->post('id');
            $where = array(
                'kategori_id' => $id
            );
            $data['kategori'] = $this->m_data->edit_data('kategori', $where)->result();
            $data['active_page'] = 'kategori';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_kategori_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function kategori_hapus($id)
    {
        $where = array(
            'kategori_id' => $id
        );
        $this->m_data->delete_data('kategori', $where);
        redirect(base_url() . 'dashboard/kategori');
    }

    //artikel

    public function artikel()
    {
        $data['artikel'] = $this->db->query('SELECT * FROM artikel,kategori,pengguna
        WHERE artikel_kategori=kategori_id
        and artikel_author=pengguna_id
        order by artikel_id desc')->result();
        $data['active_page'] = 'news';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_news', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function artikel_tambah()
    {
        $data['kategori'] = $this->m_data->get_data('kategori')->result();
        $data['active_page'] = 'news';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_news_tambah', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function artikel_aksi()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if (empty($_FILES['sampul']['name'])) {
            $this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
        }
        if ($this->form_validation->run() != false) {
            $config['upload_path'] = './img/artikel/';
            $config['allowed_types'] = 'gif|jpg|png|jfif';
            $new_filename = uniqid() . '.' . pathinfo($_FILES['sampul']['name'], PATHINFO_EXTENSION);
            $config['file_name'] = $new_filename;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sampul')) {
                // mengambil data tentang gambar
                $gambar = $this->upload->data();
                $tanggal = date('Y-m-d H:i:s');
                $judul = $this->input->post('judul');
                $slug = strtolower(url_title($judul));
                $konten = $this->input->post('konten');
                $sampul = $gambar['file_name'];
                $author = $this->session->userdata('id');
                $kategori = $this->input->post('kategori');
                $status = $this->input->post('status');
                $data = array(
                    'artikel_tanggal' => $tanggal,
                    'artikel_judul' => $judul,
                    'artikel_slug' => $slug,
                    'artikel_konten' => $konten,
                    'artikel_sampul' => $sampul,
                    'artikel_author' => $author,
                    'artikel_kategori' => $kategori,
                    'artikel_status' => $status
                );
                $this->m_data->insert_data('artikel', $data);
                redirect(base_url() . 'dashboard/artikel');
            } else {
                $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
                $data['kategori'] = $this->m_data->get_data('kategori')->result();
                $data['active_page'] = 'news';
                $this->load->view('dashboard/v_header', $data);
                $this->load->view('dashboard/v_news_tambah', $data);
                $this->load->view('dashboard/v_footer');
            }
        } else {
            $data['kategori'] = $this->m_data->get_data('kategori')->result();
            $data['active_page'] = 'news';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_news_tambah', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function artikel_edit($id)
    {
        $where = array(
            'artikel_id' => $id
        );
        $data['artikel'] = $this->m_data->edit_data('artikel', $where)->result();
        $data['kategori'] = $this->m_data->get_data('kategori')->result();
        $data['active_page'] = 'news';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_news_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function artikel_update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $slug = strtolower(url_title($judul));
            $konten = $this->input->post('konten');
            $kategori = $this->input->post('kategori');
            $status = $this->input->post('status');
            $where = array(
                'artikel_id' => $id
            );
            $data = array(
                'artikel_judul' => $judul,
                'artikel_slug' => $slug,
                'artikel_konten' => $konten,
                'artikel_kategori' => $kategori,
                'artikel_status' => $status
            );
            $this->m_data->update_data('artikel', $data, $where);
            if (!empty($_FILES['sampul']['name'])) {
                $config['upload_path'] = './img/artikel/';
                $config['allowed_types'] = 'gif|jpg|png|jfif';
                $new_filename = uniqid() . '.' . pathinfo($_FILES['sampul']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = $new_filename;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {
                    $gambar = $this->upload->data();
                    $data = array(
                        'artikel_sampul' => $gambar['file_name']
                    );
                    $this->m_data->update_data('artikel', $data, $where);
                    redirect(base_url() . 'dashboard/artikel');
                } else {
                    $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
                    $where = array(
                        'artikel_id' => $id
                    );
                    $data['artikel'] = $this->m_data->edit_data('artikel', $where)->result();
                    $data['kategori'] = $this->m_data->get_data('kategori')->result();
                    $data['active_page'] = 'news';
                    $this->load->view('dashboard/v_header', $data);
                    $this->load->view('dashboard/v_news_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'dashboard/artikel');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'artikel_id' => $id
            );
            $data['artikel'] = $this->m_data->edit_data('artikel', $where)->result();
            $data['kategori'] = $this->m_data->get_data('kategori')->result();
            $data['active_page'] = 'news';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_news_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function artikel_hapus($id)
    {
        $where = array(
            'artikel_id' => $id
        );
        $this->m_data->delete_data('artikel', $where);
        redirect(base_url() . 'dashboard/artikel');
    }

    //pengguna

    public function pengguna()
    {
        if ($this->session->userdata('level') != 'admin') {
            $data['active_page'] = 'users';
            redirect(base_url() . 'dashboard/forbidden');
        } else {
            $data['pengguna'] = $this->m_data->get_data('pengguna')->result();
            $data['active_page'] = 'users';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pengguna', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function pengguna_tambah()
    {
        $data['active_page'] = 'users';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_pengguna_tambah', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function pengguna_tambah_aksi()
    {
        $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username Pengguna', 'required');
        $this->form_validation->set_rules('password', 'Password Pengguna', 'required');
        $this->form_validation->set_rules('level', 'Level Pengguna', 'required');
        if ($this->form_validation->run() != false) {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $level = $this->input->post('level');
            $status = '1';
            $foto = 'default.jpg';
            $data = array(
                'pengguna_nama' => $nama,
                'pengguna_email' => $email,
                'pengguna_foto' => $foto,
                'pengguna_username' => $username,
                'pengguna_password' => $password,
                'pengguna_level' => $level,
                'pengguna_status' => $status
            );
            $this->m_data->insert_data('pengguna', $data);
            redirect(base_url() . 'dashboard/pengguna');
        } else {
            $data['active_page'] = 'users';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pengguna_tambah', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function pengguna_edit($id)
    {
        $where = array(
            'pengguna_id' => $id
        );
        $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();
        $data['active_page'] = 'users';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_pengguna_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function pengguna_update()
    {
        //rules untuk wajib diisi
        $this->form_validation->set_rules('level', 'Level Pengguna', 'required');
        $this->form_validation->set_rules('status', 'Status Pengguna', 'required');
        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $level = $this->input->post('level');
            $status = $this->input->post('status');
            $data = array(
                'pengguna_level' => $level,
                'pengguna_status' => $status
            );
            $where = array(
                'pengguna_id' => $id
            );
            $this->m_data->update_data('pengguna', $data, $where);
            redirect(base_url() . 'dashboard/pengguna');
        } else {
            $id = $this->input->post('id');
            $where = array(
                'pengguna_id' => $id
            );
            $data['pengguna'] = $this->m_data->get_data('pengguna', $where)->result();
            $data['active_page'] = 'users';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pengguna_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function pengguna_hapus($id)
    {
        $where = array(
            'pengguna_id' => $id
        );
        $this->m_data->delete_data('pengguna', $where);
        redirect(base_url() . 'dashboard/pengguna');
    }

    public function see_profile($id)
    {
        $where = array(
            'pengguna_id' => $id
        );
        $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();
        $data['active_page'] = 'dashboard';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_profile', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function profile()
    {
        $id_pengguna = $this->session->userdata('id');
        $where = array(
            'pengguna_id' => $id_pengguna
        );
        $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();
        $data['active_page'] = 'dashboard';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_profile', $data);
        $this->load->view('dashboard/v_footer');
    }

    /*public function profile_update()
    {
        //rules form wajib diisi untuk nama dan email
        $this->form_validation->set_rules('nama', 'Nama', 'Required');
        $this->form_validation->set_rules('email', 'Email', 'Required');
        if ($this->form_validation->run() != false) {
            $id = $this->session->userdata('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $where = array(
                'pengguna_id' => $id
            );
            $data = array(
                'pengguna_nama' => $nama,
                'pengguna_email' => $email
            );
            $this->m_data->update_data('pengguna', $data, $where);
            redirect(base_url() . 'dashboard/profile/?alert=sukses');
        } else {
            //id pengguna yang sedang login
            $id = $this->session->userdata('id');
            $where = array(
                'pengguna_id' => $id
            );
            $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();
            $data['active_page'] = 'dashboard';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_profile', $data);
            $this->load->view('dashboard/v_footer');
        }
    }*/

    public function profil_update()
    {
        //rules form wajib diisi untuk nama dan email
        $this->form_validation->set_rules('username', 'Username', 'Required');
        $this->form_validation->set_rules('nama', 'Nama', 'Required');
        $this->form_validation->set_rules('email', 'Email', 'Required');
        if ($this->form_validation->run() != false) {
            $id = $this->session->userdata('id');
            $usename = $this->input->post('username');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $where = array(
                'pengguna_id' => $id
            );
            $data = array(
                'pengguna_username' => $usename,
                'pengguna_nama' => $nama,
                'pengguna_email' => $email
            );
            $data_session = array(
                'username' => $usename
            );
            $this->m_data->update_data('pengguna', $data, $where);
            $this->session->set_userdata($data_session);
            redirect(base_url() . 'dashboard/profile');
        } else {
            //id pengguna yang sedang login
            $id_pengguna = $this->session->userdata('id');
            $where = array(
                'pengguna_id' => $id_pengguna
            );
            $data['pengguna'] = $this->m_data->edit_data('dashboard', $where)->result();
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_profile', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function profil_foto_update()
    {
        $id = $this->input->post('id');
        $config['upload_path'] = './img/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $new_filename = uniqid() . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $config['file_name'] = $new_filename;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $file_data = $this->upload->data();
            $foto = $file_data['file_name'];

            $where = array('pengguna_id' => $id);
            $data = array('pengguna_foto' => $foto);
            $data_session = array(
                'profile_picture' => $foto
            );
            $this->m_data->update_data('pengguna', $data, $where);
            $this->session->set_userdata($data_session);
            redirect(base_url('dashboard/profile'));
        } else {
            $error = $this->upload->display_errors();
            // Handle the error case as needed, e.g., show an error message
            redirect(base_url('dashboard/profile?alert=gagal'));
        }
    }

    //admin
    public function admin()
    {
        if ($this->session->userdata('level') != 'admin') {
            $data['active_page'] = 'users';
            redirect(base_url() . 'dashboard/forbidden');
        } else {
            $data['pengguna'] = $this->m_data->get_admin();
            $data['active_page'] = 'admin';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_admin', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function admin_hapus($id)
    {
        $where = array(
            'pengguna_id' => $id
        );
        $data['pengguna_hapus'] = $this->m_data->edit_data('pengguna', $where)->row();
        $data['pengguna_lain'] = $this->db->where('pengguna_id !=', $id)
                                          ->where('pengguna_level !=', 'user')
                                          ->get('pengguna')
                                          ->result();
        $data['active_page'] = 'admin';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_admin_hapus', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function admin_hapus_aksi()
    {
        $pengguna_hapus = $this->input->post('pengguna_hapus');
        $pengguna_tujuan = $this->input->post('pengguna_tujuan');
        $action = $this->input->post('action');

        // Update articles authored by pengguna_hapus to be authored by pengguna_tujuan
        $w = array(
            'artikel_author' => $pengguna_hapus
        );
        $d = array(
            'artikel_author' => $pengguna_tujuan
        );
        $this->m_data->update_data('artikel', $d, $w);

        // Change pengguna_level to 'user' instead of deleting
        $where = array(
            'pengguna_id' => $pengguna_hapus
        );
        $data = array(
            'pengguna_level' => 'user'
        );
        if ($action == 'update') {
            $this->m_data->update_data('pengguna', $data, $where);
        } else {
            $this->m_data->delete_data('pengguna', $where);
        }
        redirect(base_url() . 'dashboard/admin');
    }

    public function pesan()
    {
        $data['pesan'] = $this->db->query('SELECT * FROM comment,pengguna
        WHERE komen_pengguna=pengguna_id
        order by komen_id desc')->result();
        $data['active_page'] = 'pesan';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_pesan', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function pesan_hapus($id)
    {
        $where = array(
            'komen_id' => $id
        );
        $this->m_data->delete_data('comment', $where);
        redirect(base_url() . 'dashboard/pesan');
    }
    //pengaturan

    public function pengaturan()
    {
        if ($this->session->userdata('level') != 'admin') {
            //$data['active_page'] = 'input';
            redirect(base_url() . 'dashboard/forbidden');
        } else {
            $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();
            $data['active_page'] = 'pengaturan';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pengaturan', $data);
            $this->load->view('dashboard/v_footer');
        }
    }
    public function pengaturan_update()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        if ($this->form_validation->run() != false) {
            $nama = $this->input->post('nama');
            $deskripsi = $this->input->post('deskripsi');
            $link_facebook = $this->input->post('link_facebook');
            $link_twitter = $this->input->post('link_twitter');
            $link_instagram = $this->input->post('link_instagram');
            $link_github = $this->input->post('link_github');
            $where = array();
            $data = array(
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'link_facebook' => $link_facebook,
                'link_twitter' => $link_twitter,
                'link_instagram' => $link_instagram,
                'link_github' => $link_github
            );
            //update pengaturan website
            $this->m_data->update_data('pengaturan', $data, $where);
            //periksa apakah ada gambar yang akan diupload
            if (!empty($_FILES['logo']['name'])) {
                $config['upload_path'] = './gambar/website/';
                $config['allowed_types'] = 'jpg|png';
                $new_filename = uniqid() . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = $new_filename;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('logo')) {
                    //mengambil data logo yang akan diupload
                    $gambar = $this->upload->data();
                    $logo = $gambar['file_name'];
                    $this->db->update('pengaturan', ['logo' => $logo]);
                }
            }
            redirect(base_url() . 'dashboard/pengaturan/?alert=sukses');
        } else {
            $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();
            $data['active_page'] = 'pengaturan';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pengaturan', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    //ganti password

    function ganti_password()
    {
        $data['active_page'] = 'dashboard';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('dashboard/v_ganti_password');
        $this->load->view('dashboard/v_footer');
    }
    function ganti_password_aksi()
    {
        $this->form_validation->set_rules('password_lama', 'last password', 'required');
        $this->form_validation->set_rules('password_baru', 'new password', 'required');
        $this->form_validation->set_rules('konfirmasi_password', 'password confirmation', 'required|matches[password_baru]');

        if ($this->form_validation->run() != false) {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru');
            $id = $this->session->userdata('id');

            $user = $this->db->get_where('pengguna', ['pengguna_id' => $id])->row();
            $old_password_valid = false;

            if ($user) {
                if (password_verify($password_lama, $user->pengguna_password)) {
                    $old_password_valid = true;
                } else if ($user->pengguna_password === md5($password_lama)) {
                    $old_password_valid = true;
                }
            }

            if ($old_password_valid) {
                $data = array(
                    'pengguna_password' => password_hash($password_baru, PASSWORD_BCRYPT)
                );
                $this->m_data->update_data('pengguna', $data, ['pengguna_id' => $id]);
                redirect('dashboard/ganti_password?alert=sukses');
            } else {
                redirect('dashboard/ganti_password?alert=gagal');
            }
        } else {
            $data['active_page'] = 'dashboard';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_ganti_password');
            $this->load->view('dashboard/v_footer');
        }
    }

    function cari_user()
    {
        $this->form_validation->set_rules('cari', 'cari', 'required');
        if ($this->form_validation->run() != false) {
            $cari = $this->input->post('cari');
            $data['pengguna'] = $this->db->group_start()
                ->like('pengguna_nama', $cari)
                ->or_like('pengguna_username', $cari)
                ->group_end()
                ->order_by('pengguna_id', 'DESC')
                ->get('pengguna')
                ->result();
            $data['active_page'] = 'users';
            $this->load->view('dashboard/v_header', $data);
            $this->load->view('dashboard/v_pengguna', $data);
            $this->load->view('dashboard/v_footer');
        } else {
            redirect('dashboard/pengguna');
        }
    }
}
