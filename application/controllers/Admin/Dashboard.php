<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect();
        }
    }

    public function index()
    {
        $this->load->library('session');
        $username = $this->session->userdata('username');
        $nama_user = $this->session->userdata('nama');

        // echo "Nama User: " . $nama_user;
        // echo "<br> Username: " . $username;
        $data = [
            'title' => 'Dashboard',
            'nama_user' => $nama_user,
        ];

        // Periode 
        $total_periode = $this->model_periode->tahun_periode()->result_array();
        $periode = $this->model_periode->getCountPendudukPerPeriode()->result_array();

        // Pekerjaan
        $pekerjaan = $this->model_penduduk->get_sum_pekerjaan()->result_array();

        // Data
        $penduduk = $this->model_penduduk->data_penduduk();

        // Kriteria
        $kriteria = $this->model_kriteria->data_kriteria();

        // Total anggaran semua periode 
        $data['total_kriteria'] = $kriteria->num_rows();
        $data['total_data'] = $penduduk->num_rows();
        $data['total_anggaran'] = 0;
        $data['periode'] = $periode;
        $data['pekerjaan_total'] = $pekerjaan;
        $data['total_periode'] = count($total_periode);

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/Dashboard", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }
}
