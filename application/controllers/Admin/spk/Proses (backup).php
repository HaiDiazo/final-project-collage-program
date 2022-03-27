<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proses extends CI_Controller
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

    // **** Function untuk AHP


    private function matrix_comparison($n, $set_radio, $nilai_perb_arr)
    {
        // ** Membuat matrix perbandingan
        // Matrix for => var[kolom][baris]
        // x = kolom
        // y = baris

        $urut = 0;

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                if ($set_radio[$urut] == 1) {
                    $matrik[$x][$y] = $nilai_perb_arr[$urut];
                    $matrik[$y][$x] = 1 / $nilai_perb_arr[$urut];
                } else {
                    $matrik[$x][$y] = 1 / $nilai_perb_arr[$urut];
                    $matrik[$y][$x] = $nilai_perb_arr[$urut];
                }
                $urut++;
            }
        }

        for ($x = 0; $x < $n; $x++) {
            $matrik[$x][$x] = 1;
        }

        // Total
        $total = array(0, 0, 0, 0, 0, 0);
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $total[$x] += $matrik[$y][$x];
            }
        }

        $matrix_comp = array(
            'matrik' => $matrik,
            'total' => $total
        );

        return $matrix_comp;
    }

    private function consistensi_index($eigen, $n)
    {
        $ci = ($eigen - $n) / ($n - 1);
        return $ci;
    }

    // End Function AHP

    public function index()
    {
        $nama_user = $this->session->userdata('nama');
        $title = 'Proses AHP';
        $data = [
            'spk' => 'prosesAhp',
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi($title),
        ];

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/spk/proses/proses_table", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function proses_kriteria()
    {
        $nama_user = $this->session->userdata('nama');
        $title = 'Proses AHP - Kriteria';
        $data = [
            'spk' => 'prosesAhp',
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi(' <a href="' . base_url('admin/spk/proses') . '">Proses AHP</a> / ' . $title),
        ];

        // Ambil data dari model
        $kriteria = $this->model_kriteria->data_kriteria()->result_array();
        $nilai_perb = $this->model_kriteria->get_perbandingan_kriteria()->result_array();
        // end

        // Inisialisasi dan push to array kriteria array
        $kriteria_arr = array();
        foreach ($kriteria as $kr) {
            array_push($kriteria_arr, $kr['nama_kriteria']);
        }
        // end

        // Inisialisasi dan push to array nilai perbandingan array
        $nilai_perb_arr = array();
        $set_radio = array();
        foreach ($nilai_perb as $np) {
            array_push($nilai_perb_arr, $np['nilai_perband']);
            array_push($set_radio, $np['set_radio']);
        }
        // end

        //** membuat matrik perbandingan
        // Matrix for => var[kolom][baris]
        // x = kolom
        // y = baris
        $matrik = array();
        $urut = 0;
        $n = count($kriteria_arr);

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                if ($set_radio[$urut] == 1) {
                    $matrik[$x][$y] = $nilai_perb_arr[$urut];
                    $matrik[$y][$x] = 1 / $nilai_perb_arr[$urut];
                } else {
                    $matrik[$x][$y] = 1 / $nilai_perb_arr[$urut];
                    $matrik[$y][$x] = $nilai_perb_arr[$urut];
                }
                $urut++;
            }
        }

        for ($x = 0; $x < $n; $x++) {
            $matrik[$x][$x] = 1;
        }


        // Total
        $total = array(0, 0, 0, 0, 0, 0);
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $total[$x] += $matrik[$y][$x];
            }
        }
        //** end matrik perbandingan

        // ** matrik normalisasi
        $normalisasi = array();
        $jumlah = array(0, 0, 0, 0, 0, 0);
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $normalisasi[$y][$x] = $matrik[$y][$x] / $total[$x];
            }
        }

        $prioritas = array(0, 0, 0, 0, 0, 0);
        $total_norm = array(0, 0, 0, 0, 0, 0);
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $jumlah[$x] += $normalisasi[$x][$y];
                $total_norm[$x] += $normalisasi[$y][$x];
            }
            $prioritas[$x] = $jumlah[$x] / $n;
        }
        // ** end normalisasi

        // ** Matrix penjumlahan tiap baris
        $penjuml_tiap_bar = array();
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $penjuml_tiap_bar[$y][$x] = $matrik[$y][$x] * $prioritas[$x];
            }
        }

        $jumlah_tiap_bar = array(0, 0, 0, 0, 0, 0);
        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $jumlah_tiap_bar[$x] += $penjuml_tiap_bar[$x][$y];
            }
        }
        // ** end matrix penjumlahan tiap baris

        // ** Rasio konsistensi 
        $nilai = array(0, 0, 0, 0, 0, 0);
        $jumlah_nilai = 0;
        for ($x = 0; $x < $n; $x++) {
            $nilai[$x] = $jumlah_tiap_bar[$x] / $prioritas[$x];
            $jumlah_nilai += $nilai[$x];
        }

        // Nilai eigen
        $eigen = $jumlah_nilai / $n;

        // Ambil dari db IR
        $cons_index = $this->consistensi_index($eigen, $n);
        $ir = $this->model_ir->get_ir($n)->row_array();
        $cons_rasio = $cons_index / $ir['nilai_ir'];

        if ($cons_rasio < 0.1) {
            $data['pesan'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"> Rasio Konsistensi dibawah 0.1 <br>Silahkan lanjut ke tahapan selanjutnya. 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
        } else {
            $data['pesan'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Rasio Konsistensi <strong>diatas 0.1</strong> ! <br> Silahkan kembali konfigurasi prioritas elemen kriteria.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
        }

        // ** end Rasio konsistensi

        // Matrik comparison
        $data['kriteria_arr'] = $kriteria_arr;
        $data['matrik'] = $matrik;
        $data['total'] = $total;
        // end matrix comparison

        // Matrik normalisasi
        $data['normalisasi'] = $normalisasi;
        $data['jumlah_normalisasi'] = $jumlah;
        $data['prioritas'] = $prioritas;
        $data['total_norm'] = $total_norm;
        // End Matrik normalisasi

        // Matrix penjumlahan tiap baris
        $data['penjumlahan_tiap_baris'] = $penjuml_tiap_bar;
        $data['jumlah_tiap_baris'] = $jumlah_tiap_bar;
        // End matrix penjumlahan tiap baris

        // Rasio Konsistensi
        $data['nilai'] = $nilai;
        $data['jumlah_nilai'] = $jumlah_nilai;
        $data['eigen'] = $eigen;
        $data['cons_index'] = $cons_index;
        $data['ir'] = $ir['nilai_ir'];
        $data['cons_rasio'] = $cons_rasio;
        // End rasio konsistensi

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/spk/proses/proses_kriteria", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }
}
