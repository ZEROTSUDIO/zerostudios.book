<?php
defined('BASEPATH') or exit('No script direct access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_data');
    }

    function index()
    {
        $this->load->view('v_login');
    }

    function aksi()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() != false) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Ambil pengguna berdasarkan username dan status aktif
            $user = $this->db->get_where('pengguna', [
                'pengguna_username' => $username,
                'pengguna_status'   => 1
            ])->row();

            $password_valid = false;
            if ($user) {
                // 1. Cek dengan password_verify (Bcrypt standar modern)
                if (password_verify($password, $user->pengguna_password)) {
                    $password_valid = true;
                }
                // 2. Fallback backwards compatibility untuk hash legacy MD5
                else if ($user->pengguna_password === md5($password)) {
                    $password_valid = true;
                    // Otomatis upgrade hash MD5 ke password_hash modern di background
                    $this->db->where('pengguna_id', $user->pengguna_id)
                             ->update('pengguna', [
                                 'pengguna_password' => password_hash($password, PASSWORD_BCRYPT)
                             ]);
                }
            }

            if ($password_valid) {
                $data_session = array(
                    'id'              => $user->pengguna_id,
                    'username'        => $user->pengguna_username,
                    'level'           => $user->pengguna_level,
                    'pengguna_level'  => $user->pengguna_level,
                    'aktif'           => $user->pengguna_status,
                    'profile_picture' => $user->pengguna_foto,
                    'status'          => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                redirect('');
            } else {
                redirect('login?alert=gagal');
            }
        } else {
            $this->load->view('v_login');
        }
    }

    public function aksi_reg()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() != false) {
            $nama     = $this->input->post('nama');
            $email    = $this->input->post('email');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->db->get_where('pengguna', ['pengguna_username' => $username]);
            if ($cek->num_rows() > 0) {
                redirect('login?alert=duplikat');
            } else {
                // Simpan password baru menggunakan Bcrypt
                $data = array(
                    'pengguna_nama'     => $nama,
                    'pengguna_email'    => $email,
                    'pengguna_foto'     => 'default.jpg',
                    'pengguna_username' => $username,
                    'pengguna_password' => password_hash($password, PASSWORD_BCRYPT),
                    'pengguna_level'    => 'user',
                    'pengguna_status'   => 1
                );
                $this->m_data->insert_data('pengguna', $data);

                $new_user = $this->db->get_where('pengguna', ['pengguna_username' => $username])->row();
                $data_session = array(
                    'id'              => $new_user->pengguna_id,
                    'username'        => $new_user->pengguna_username,
                    'level'           => $new_user->pengguna_level,
                    'pengguna_level'  => $new_user->pengguna_level,
                    'aktif'           => $new_user->pengguna_status,
                    'profile_picture' => $new_user->pengguna_foto,
                    'status'          => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                redirect('');
            }
        } else {
            redirect('login');
        }
    }

    function dashboard()
    {
        if ($this->session->userdata('level') == 'user') {
            redirect('dashboard/forbidden');
        } else {
            $this->load->view('v_login2');
        }
    }

    function dashboard_masuk()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() != false) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('pengguna', [
                'pengguna_username' => $username,
                'pengguna_status'   => 1
            ])->row();

            $password_valid = false;
            if ($user) {
                // 1. Cek dengan password_verify (Bcrypt standar modern)
                if (password_verify($password, $user->pengguna_password)) {
                    $password_valid = true;
                }
                // 2. Fallback backwards compatibility untuk hash legacy MD5
                else if ($user->pengguna_password === md5($password)) {
                    $password_valid = true;
                    // Otomatis upgrade hash MD5 ke password_hash modern di background
                    $this->db->where('pengguna_id', $user->pengguna_id)
                             ->update('pengguna', [
                                 'pengguna_password' => password_hash($password, PASSWORD_BCRYPT)
                             ]);
                }
            }

            if ($password_valid) {
                $data_session = array(
                    'id'              => $user->pengguna_id,
                    'username'        => $user->pengguna_username,
                    'level'           => $user->pengguna_level,
                    'pengguna_level'  => $user->pengguna_level,
                    'aktif'           => $user->pengguna_status,
                    'profile_picture' => $user->pengguna_foto,
                    'status'          => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                redirect('dashboard');
            } else {
                redirect('login/dashboard?alert=gagal');
            }
        } else {
            $this->load->view('v_login2');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
}
