<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TahunPeriode extends CI_Controller
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
        $title = 'Tahun Periode';

        $data = [
            'data_master' => 'periode',
            'title' => $title,
            'nama_user' => $nama_user,
        ];

        $data['navigasi'] = $this->navigasi($title);
        $data['periode'] = $this->model_periode->tahun_periode()->result_array();

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/tahun_periode/tahun_periode", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function tambah_periode()
    {
        $nama_user = $this->session->userdata('nama');
        $title = '<a href="' . base_url('admin/tahunperiode') . '">Tahun Periode</a> / ' . 'Tambah Periode';

        $data = [
            'data_master' => 'periode',
            'title' => 'Tambah Periode',
            'nama_user' => $nama_user
        ];

        $data['navigasi'] = $this->navigasi($title);

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/tahun_periode/tambah_periode", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function edit_periode($id)
    {
        $nama_user = $this->session->userdata('nama');
        $title = '<a href="' . base_url('admin/tahunperiode') . '">Tahun Periode</a> / ' . 'Edit Periode';

        $data = [
            'data_master' => 'periode',
            'title' => 'Edit Periode',
            'nama_user' => $nama_user
        ];

        $where = array('id_periode' => $id);
        $data['periode'] = $this->model_periode->get_periode($where)->row_array();
        $data['navigasi'] = $this->navigasi($title);

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/tahun_periode/edit_periode", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function edit($id)
    {
        $nama_periode = htmlspecialchars($this->input->post('nama'));
        $tgl_awal = htmlspecialchars($this->input->post('tanggal_awal'));
        $tgl_akhir = htmlspecialchars($this->input->post('tanggal_akhir'));
        $kuota = htmlspecialchars($this->input->post('kuota'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));

        $where = array('id_periode' => $id);
        $data = [
            'nama_periode' => $nama_periode,
            'tanggal_awal' => $tgl_awal,
            'tanggal_akhir' => $tgl_akhir,
            'kuota' => $kuota,
            'keterangan' => $keterangan
        ];

        $this->model_periode->update_periode($where, $data);

        $update = $this->db->affected_rows() != 1 ? false : true;

        if ($update > 0) {
            redirect('admin/tahunperiode');
        } else {
            redirect('admin/tahunperiode/edit_periode/' . $id);
        }
    }

    public function input()
    {
        $nama_periode = htmlspecialchars($this->input->post('nama'));
        $tgl_awal = htmlspecialchars($this->input->post('tanggal_awal'));
        $tgl_akhir = htmlspecialchars($this->input->post('tanggal_akhir'));
        $kuota = htmlspecialchars($this->input->post('kuota'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));

        $data = [
            'nama_periode' => $nama_periode,
            'tanggal_awal' => $tgl_awal,
            'tanggal_akhir' => $tgl_akhir,
            'kuota' => $kuota,
            'keterangan' => $keterangan
        ];

        $this->model_periode->insert_periode($data);
        $insert = $this->db->affected_rows() != 1 ? false : true;

        if ($insert) {
            redirect('admin/tahunperiode');
        } else {
            redirect('admin/tahunperiode/tambah_periode');
        }
    }

    public function hapus($id)
    {
        $where = array('id_periode' => $id);

        $this->model_periode->delete_periode($where);
        $delete = $this->db->affected_rows() != 1 ? false : true;

        redirect('admin/tahunperiode');
    }
}
