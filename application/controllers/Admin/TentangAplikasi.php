<?php
defined('BASEPATH') or exit('No direct script access allowed');


class TentangAplikasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect();
        }
    }

    private function navigasi($title)
    {
        $navigasi = '<a href="' . base_url('admin/dashboard') . '">Dashboard</a> / ' . $title;
        return $navigasi;
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $nama_user = $this->session->userdata('nama');
        $title = 'Tentang Aplikasi';

        $data = [
            'title' => $title,
            'nama_user' => $nama_user,
        ];

        $data['navigasi'] = $this->navigasi($title);
        $data['periode'] = $this->model_periode->tahun_periode()->result_array();

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/tentang_aplikasi/tentang_aplikasi", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }
}
