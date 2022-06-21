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
        $id_user = $this->session->userdata('id_user');
        $cek_periode = $this->model_periode->get_new_periode()->num_rows();

        // ambil data periode yang sudah menggunakan spk
        $periodeUseAHP = $this->model_periode->getNamaPeriodeUseAHP()->result_array();

        $nama_terang = $this->user->getNamaTerang($id_user);

        if (!isset($nama_terang)) {
            $nama_terang = "Nama Terang";
        }

        $title = 'Cetak Laporan';
        $data = [
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi($title),
            'periode' => $this->model_periode->tahun_periode()->result_array(),
            'useAHP' => $periodeUseAHP,
            'cek_periode' => $cek_periode,
            'nama_terang' => $nama_terang['nama_terang']
        ];

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/cetak/cetak", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function setNamaTerang()
    {
        $nama_terang = htmlspecialchars($this->input->post('nama_terang'));
        $id_user = $this->session->userdata('id_user');

        $data = [
            'nama_terang' => $nama_terang
        ];

        $this->user->setNamaTerang($data, $id_user);

        $this->session->set_flashdata('nama_terang', '<div class="alert alert-success mt-3">Set Nama Terang Menjadi ' . $nama_terang . '</div>');

        redirect('admin/cetak');
    }

    public function print_periode()
    {
        $id_user = $this->session->userdata('id_user');
        $periode = htmlspecialchars($this->input->post('periode'));

        $user = $this->user->getNamaTerang($id_user);

        $db_penerima = $this->model_penerima->penduduk_diterima($periode);
        $data['penerima'] = $db_penerima->result_array();
        $data_penerima = $db_penerima->row_array();
        $data['dari'] = $data_penerima['tanggal_awal'];
        $data['sampai'] = $data_penerima['tanggal_akhir'];
        $data['nama_terang'] = $user['nama_terang'];


        $this->load->view('admin/cetak/print_laporan', $data);
    }

    public function printlaporanSkor()
    {
        $periode = htmlspecialchars($this->input->post('periodeAHP'));
        $id_user = $this->session->userdata('id_user');
        $user = $this->user->getNamaTerang($id_user);

        $periode_db = $this->model_periode->tahun_periode_id($periode)->row_array();
        $rekomendasi = $this->model_alternatif->sortAlternatifPenerima($periode)->result_array();

        $data['penerima'] = $rekomendasi;
        $data['dari'] = $periode_db['tanggal_awal'];
        $data['sampai'] = $periode_db['tanggal_akhir'];
        $data['nama_terang'] = $user['nama_terang'];

        $this->load->view('admin/cetak/print_laporan', $data);
    }

    public function print()
    {
        $dari = htmlspecialchars($this->input->post('dari'));
        $sampai = htmlspecialchars($this->input->post('sampai'));

        $id_user = $this->session->userdata('id_user');
        $user = $this->user->getNamaTerang($id_user);

        $data['penerima'] = $this->model_penerima->getPenerima_diterima($dari, $sampai)->result_array();
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $data['nama_terang'] = $user['nama_terang'];

        $this->load->view('admin/cetak/print_laporan', $data);
    }
}
