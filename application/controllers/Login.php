<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {

        if ($this->session->userdata('username')) {
            redirect('admin/dashboard');
        }
        $this->load->view("auth/Login");
    }

    public function sendSessionTombol()
    {
        $tombol = $this->session->userdata('tombol');

        if ($tombol == 0) {
            $this->session->set_userdata('tombol', 1);
        } else {
            $this->session->set_userdata('tombol', 0);
        }
    }

    public function masuk()
    {
        $this->load->library('session');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if ($user['password'] == $password) {
                echo "Password Benar";

                $data = [
                    'id_user' => $user['id_user'],
                    'nama' => $user['nama'],
                    'tombol' => 0,
                    'username' => $user['username']
                ];
                $this->session->set_userdata($data);

                redirect('admin/dashboard');
            } else {
                echo "Password Salah";
                $this->session->set_flashdata('wrong_pass', '<small class="text-danger font-italic">*Password Salah</small>');
                redirect();
            }
        } else {
            echo "Akun Tidak ditemukan";
            $this->session->set_flashdata('none_username', '<small class="text-danger font-italic">*Username Tidak Ditemukan</small>');
            $this->session->set_flashdata('none_pass', '<small class="text-danger font-italic">*Password Tidak Ditemukan</small>');
            redirect();
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        redirect();
    }
}
