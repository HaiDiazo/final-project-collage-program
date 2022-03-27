<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkriteria extends CI_Controller
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

    private function faktorial($digit)
    {
        $total = 1;
        for ($i = 1; $i <= $digit; $i++) {
            $total = $total * $i;
        }
        return $total;
    }

    private function jum_perbandingan($angka)
    {
        // Rumus pairwise comparasion
        $rumus = $this->faktorial($angka) / ($this->faktorial(2) * $this->faktorial(($angka - 2)));
        return $rumus;
    }

    public function index()
    {
        $nama_user = $this->session->userdata('nama');
        $title = 'Konfigurasi Kriteria';
        $data = [
            'spk' => 'kriteria',
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi($title),
        ];
    }

    public function subkriteria_masuk($jum)
    {
        // Inisialisasi data
        $nilai_elemen = array();
        $pilihan = array();
        $array_kriteria1 = $this->input->post('kriteria1');
        $array_kriteria2 = $this->input->post('kriteria2');
        // end 

        // Get data dari form
        for ($i = 0; $i < $jum; $i++) {
            array_push($pilihan, substr($this->input->post('elemen' . $i), -1));
            array_push($nilai_elemen, $this->input->post('nilaiElemen' . $i));
        }
        // end 

        //** input into database

        // * cek tb perbandingan ada tidak? 
        $cek_jumlah = $this->model_kriteria->cek_data_perb();

        if ($cek_jumlah == 0) {
            for ($i = 0; $i < $jum; $i++) {
                $data = [
                    'id_kriteria1' => $array_kriteria1[$i],
                    'id_kriteria2' => $array_kriteria2[$i],
                    'nilai_perband' => $nilai_elemen[$i],
                    'set_radio' => $pilihan[$i]
                ];

                // insert data to table perbandingan
                $this->model_kriteria->insert_data_perb($data);
            }

            $insert = $this->db->affected_rows() != 1 ? false : true;

            if ($insert == 1) {
                echo "Sukses Insert";
                redirect('admin/spk/proses/proses_kriteria');
            } else {
                echo "Gagal Insert";
                redirect('admin/spk/kriteria');
            }
        } else {
            for ($i = 0; $i < $jum; $i++) {
                $data = [
                    'nilai_perband' => $nilai_elemen[$i],
                    'set_radio' => $pilihan[$i]
                ];

                $where = "id_kriteria1 = " . $array_kriteria1[$i] . " AND id_kriteria2 = " . $array_kriteria2[$i];
                $this->model_kriteria->update_if_exist($data, $where);
            }

            redirect('admin/spk/proses/proses_kriteria');
        }
        // * end cek 
        //** end input database
    }

    public function reset_perbandingan()
    {
    }
}
