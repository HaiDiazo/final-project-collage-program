<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
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
        $nama_user = $this->session->userdata('nama');
        $cek_periode = $this->model_periode->get_new_periode()->num_rows();
        $title = 'Cetak Laporan';
        $data = [
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi($title),
            'periode' => $this->model_periode->tahun_periode()->result_array(),
            'cek_periode' => $cek_periode
        ];

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/cetak/cetak", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function print_periode()
    {
        $periode = htmlspecialchars($this->input->post('periode'));

        $db_penerima = $this->model_penerima->penduduk_diterima($periode);
        $data['penerima'] = $db_penerima->result_array();
        $data_penerima = $db_penerima->row_array();
        $data['dari'] = $data_penerima['tanggal_awal'];
        $data['sampai'] = $data_penerima['tanggal_akhir'];


        $this->load->view('admin/cetak/print_laporan', $data);
    }

    public function print()
    {
        $dari = htmlspecialchars($this->input->post('dari'));
        $sampai = htmlspecialchars($this->input->post('sampai'));

        $data['penerima'] = $this->model_penerima->getPenerima_diterima($dari, $sampai)->result_array();
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('admin/cetak/print_laporan', $data);
    }
}
