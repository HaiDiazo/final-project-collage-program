<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil extends CI_Controller
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
        $title = 'Implementasi AHP';
        $data = [
            'spk' => 'hasil',
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi($title),
        ];

        // Cek apakah ada bobot kriteria atau bobot subkriteria yang masih null?
        $bbt_kriteria = $this->model_kriteria->data_kriteria()->result_array();


        $cek_kriteria = 0;

        $sub_bobot_cek = array();
        $total_subkr = array();
        // cek kriteria & subrkiteria bobot masih null?
        $i = 0;
        foreach ($bbt_kriteria as $bk) {
            if ($bk['bobot'] == null) {
                $cek_kriteria++;
            }

            // cek subkriteria
            $bbt_subkriteria = $this->model_subkriteria->data_subkriteria($bk['id_kriteria'])->result_array();

            $cek_subkriteria = 0;
            $total = 0;
            foreach ($bbt_subkriteria as $bsk) {
                if ($bsk['bobot'] == null) {
                    $cek_subkriteria++;
                }
                $total++;
            }

            $sub_bobot_cek[$bk['nama_kriteria']] = $cek_subkriteria;
            $total_subkr[$bk['nama_kriteria']] = $total;
        }

        // print_r($sub_bobot_cek);
        // end


        if ($cek_kriteria == count($bbt_kriteria)) {
            $data['cek_kriteria'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Kriteria Masih Belum Ada Bobot 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {
            $data['cek_kriteria'] = '';
        }



        // Buat tabel untuk mau diimplementasikan di periode mana?
        $data['periode'] = $this->model_periode->tahun_periode()->result_array();

        // Cek in alert
        $data['cek_subkriteria'] = $sub_bobot_cek;
        $data['kriteria'] = $bbt_kriteria;
        $data['total_subkr'] = $total_subkr;

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/spk/hasil/hasil", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function cek_implementasi($id_periode)
    {
        $nama_user = $this->session->userdata('nama');
        $title = 'Cek Data Terhadap SubKriteria';
        $data = [
            'spk' => 'hasil',
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi(' <a href="' . base_url('admin/spk/hasil') . '">Implementasi AHP</a> / ' . $title),
        ];

        $data_penduduk = $this->model_penduduk->penduduk_periode($id_periode);

        $pekerjaan = $this->model_subkriteria->get_subkriteria_withName('pekerjaan')->result_array();

        $terdampak = $this->model_subkriteria->get_subkriteria_withName('terdampak')->result_array();

        $status_penduduk = $this->model_subkriteria->get_subkriteria_withName('status_penduduk')->result_array();


        // cek data terlebih dahulu
        $i = 0;
        $simpan = array();
        foreach ($data_penduduk->result_array() as $dp) {

            // usia
            if (!is_numeric($dp['usia'])) {
                $simpan[$i]['id_penduduk'] = $dp['id_penduduk'];
                $simpan[$i]['nama'] = $dp['nama'];
                $simpan[$i]['usia'] = 0;
            }

            // Tanggungan
            if (!is_numeric($dp['usia'])) {
                $simpan[$i]['id_penduduk'] = $dp['id_penduduk'];
                $simpan[$i]['nama'] = $dp['nama'];
                $simpan[$i]['usia'] = $dp['id_penduduk'];
            }

            // pekerjaan
            $temp = 0;
            foreach ($pekerjaan as $p) {
                if ($dp['pekerjaan'] == $p['nama_subkriteria']) {
                    $temp++;
                }
            }
            if ($temp == 0) {
                $simpan[$i]['id_penduduk'] = $dp['id_penduduk'];
                $simpan[$i]['nama'] = $dp['nama'];
                $simpan[$i]['pekerjaan'] = $temp;
            }

            // Penghasilan
            if (!is_numeric($dp['penghasilan'])) {
                $simpan[$i]['id_penduduk'] = $dp['id_penduduk'];
                $simpan[$i]['nama'] = $dp['nama'];
                $simpan[$i]['penghasilan'] = 0;
            }

            // Terdampak
            $temp = 0;
            foreach ($terdampak as $p) {
                if ($dp['terdampak'] == $p['nama_subkriteria']) {
                    $temp++;
                }
            }
            if ($temp == 0) {
                $simpan[$i]['id_penduduk'] = $dp['id_penduduk'];
                $simpan[$i]['nama'] = $dp['nama'];
                $simpan[$i]['terdampak'] = $temp;
            }


            // Status Penduduk
            $temp = 0;
            foreach ($status_penduduk as $p) {
                if ($dp['status_pddk'] == $p['nama_subkriteria']) {
                    $temp++;
                }
            }
            if ($temp == 0) {
                $simpan[$i]['id_penduduk'] = $dp['id_penduduk'];
                $simpan[$i]['nik'] = $dp['nik'];
                $simpan[$i]['status_penduduk'] = $temp;
            }

            $i++;
        }

        // Show error
        $data['error_data'] = $simpan;

        $data['id_periode'] = $id_periode;
        $data['pekerjaan'] = $pekerjaan;
        $data['terdampak'] = $terdampak;
        $data['status_penduduk'] = $status_penduduk;
        $data['penduduk'] = $data_penduduk->result_array();

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/spk/hasil/cek_kriteria", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    private function subtitusiBobot($column, $data_penduduk, $kr_bobot)
    {
        $column2 = $column;
        $column2[5] = "status_penduduk";

        $no_p = 0;
        $score = array();
        foreach ($data_penduduk->result_array() as $dp) {
            for ($i = 0; $i < count($column); $i++) {

                foreach ($kr_bobot as $kr) {
                    if ($column2[$i] == $kr['nama_kriteria']) {
                        // input tiap kolom array
                        $score[$no_p]['id_penduduk'] = $dp['id_penduduk'];
                        // $score[$no_p][$column[$i]] = $kr['bobot'];

                        // subkriteria
                        $subkr_bobot = $this->model_subkriteria->data_subkriteria($kr['id_kriteria'])->result_array();

                        foreach ($subkr_bobot as $sbb) {

                            $operator = "";
                            $pieces = explode(" ", $sbb['nama_subkriteria']);


                            if (count($pieces) == 3) {
                                if ($pieces[1] == "-") {

                                    // $operator = $pieces[0] . " <= " . $dp[$column[$i]] . " && " . $dp[$column[$i]] . " <= " . $pieces[2];

                                    if ($pieces[0] <= $dp[$column[$i]] && $dp[$column[$i]] <= $pieces[2]) {
                                        $score[$no_p][$i] = $kr['bobot'] * $sbb['bobot'];
                                    }
                                } else {
                                    // $operator = $pieces[2] . " <= " . $dp[$column[$i]];
                                    if ($pieces[2] <= $dp[$column[$i]]) {
                                        $score[$no_p][$i] = $kr['bobot'] * $sbb['bobot'];
                                    }
                                }

                                // if ($operator) {
                                //     $score[$no_p][$i] = $kr['bobot'] * $sbb['bobot'];
                                // }
                            } else {
                                if ($dp[$column[$i]] == $sbb['nama_subkriteria']) {
                                    $score[$no_p][$i] = $kr['bobot'] * $sbb['bobot'];
                                }
                            }
                        }
                    }
                }
            }
            $no_p++;
        }

        return $score;
    }

    private function jumTotalBobot($score)
    {
        $i = 0;
        $total = array();
        // print_r($score[0]);
        foreach ($score as $sc) {

            $temp = 0;
            for ($j = 0; $j < count($sc) - 1; $j++) {
                $total[$i]['id_penduduk'] = $sc['id_penduduk'];

                $temp += $sc[$j];
            }
            $total[$i]['total'] = $temp;
            $i++;
        }

        return $total;
    }

    public function implementWBobot($id_periode, $accept = null)
    {
        $nama_user = $this->session->userdata('nama');
        $title = 'Proses Subtitusi Bobot AHP';
        $data = [
            'spk' => 'hasil',
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi(' <a href="' . base_url('admin/spk/hasil') . '">Implementasi AHP</a> / ' . ' <a href="' . base_url('admin/spk/hasil/cek_implementasi/') . $id_periode . '">Cek Data Terhadap SubKriteria </a> / ' . $title),
        ];

        // get data penduduk berdasarkan periode
        $data_penduduk = $this->model_penduduk->penduduk_periode($id_periode);

        // get data kriteria bobot
        $kr_bobot = $this->model_kriteria->data_kriteria()->result_array();

        // get data subkriteria bobot
        // $subkr_bobot = $this->model_subkriteria->data_subkriteria(3)->result_array();

        // get nama kolom tabel penduduk
        $column = array();
        $column2 = array();
        $nm_column = $this->model_penduduk->get_column_name()->result_array();
        for ($i = 4; $i < count($nm_column); $i++) {
            if ($i != 7 && $i != 11) {
                array_push($column, $nm_column[$i]['Field']);
                array_push($column2, $nm_column[$i]['Field']);
            }
        }
        $column2[5] = "status_penduduk";

        // End get nama kolom
        // print_r($column2);

        // echo is_numeric($subkr_bobot[5]['nama_subkriteria']);
        // $pieces = explode(" ", $subkr_bobot[2]['nama_subkriteria']);

        // echo "<br>";

        // echo count($pieces);
        // if ($pieces[1] == "-") {
        //     echo $pieces[1];
        // } else {
        //     echo "Bukan";
        // }

        // Proses subtitusi 
        $score = $this->subtitusiBobot($column, $data_penduduk, $kr_bobot);
        // end proses subtitusi

        // Jumlah 1 baris untuk mulai diurutkan
        $total = $this->jumTotalBobot($score);
        // End proses total

        // print_r($score);
        // echo "<br><br><br>";
        // print_r($total);

        // Insert ke tabel alternatif
        if ($accept != null && $accept == 1) {

            // Cek apakah sudah ada?
            $temp = $this->model_alternatif->exist_alternatif_penduduk($id_periode)->result_array();

            if (count($temp) == 0) {
                foreach ($total as $ahp) {
                    $data = [
                        'id_penduduk' => $ahp['id_penduduk'],
                        'skor' => $ahp['total'],
                    ];
                    $this->model_alternatif->insert_alternatif($data);
                }
            } else {
                foreach ($total as $ahp) {
                    $data = [
                        'skor' => $ahp['total'],
                    ];
                    $this->model_alternatif->update_alternatif($ahp['id_penduduk'], $data);
                }
            }

            redirect('admin/spk/hasil/scoring/' . $id_periode);
        }

        $data['id_periode'] = $id_periode;
        $data['penduduk'] = $data_penduduk->result_array();
        $data['column'] = $column2;
        $data['score'] = $score;
        $data['total'] = $total;

        // // print_r($total);

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/spk/hasil/hasil_urut", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function scoring($id_periode, $accept = null)
    {
        $nama_user = $this->session->userdata('nama');
        $title = 'Proses Scoring Dan Status';
        $data = [
            'spk' => 'hasil',
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi(' <a href="' . base_url('admin/spk/hasil') . '">Implementasi AHP</a> / ' . ' <a href="' . base_url('admin/spk/hasil/cek_implementasi/') . $id_periode . '">Cek Data Terhadap SubKriteria </a> / ' . ' <a href="' . base_url('admin/spk/hasil/implementWBobot/') . $id_periode . '">Proses Subtitusi Bobot AHP </a> / ' . $title),
        ];

        // Inisialisasi
        $alternatif = $this->model_alternatif->sort_alternatif($id_periode)->result_array();
        $periode = $this->model_periode->tahun_periode_id($id_periode)->row_array();
        // End inisialisasi

        // Dana untuk yang diterima
        $dana = $periode['anggaran'] / $periode['kuota'];
        $dana = round($dana, 0);
        // End

        // Input array
        $score = array();
        $i = 0;
        foreach ($alternatif as $al) {
            if ($i <= $periode['kuota'] - 1) {
                $score[$i] = array(
                    'id_penduduk' => $al['id_penduduk'],
                    'nama' => $al['nama'],
                    'nik' => $al['nik'],
                    'alamat' => $al['alamat'],
                    'score' => $al['skor'],
                    'anggaran' => $dana,
                    'status' => 'Diterima'
                );
            } else {
                $score[$i] = array(
                    'id_penduduk' => $al['id_penduduk'],
                    'nama' => $al['nama'],
                    'nik' => $al['nik'],
                    'alamat' => $al['alamat'],
                    'score' => $al['skor'],
                    'anggaran' => 0,
                    'status' => 'Ditolak'
                );
            }
            $i++;
        }
        // End 


        if ($accept != null && ($accept == 1)) {

            foreach ($score as $sc) {

                $cek = $this->model_penerima->cek_status($sc['id_penduduk']);

                if ($cek->num_rows() != 0) {
                    $update = array(
                        'tgl_penerima' => date("Y-m-d"),
                        'dana' => $sc['anggaran'],
                        'status' => $sc['status']
                    );

                    $this->model_penerima->update_status($sc['id_penduduk'], $update);
                } else {
                    $insert = array(
                        'tgl_penerima' => date("Y-m-d"),
                        'id_penduduk' => $sc['id_penduduk'],
                        'dana' => $sc['anggaran'],
                        'status' => $sc['status']
                    );

                    $this->model_penerima->insert_status($insert);
                }
            }
            redirect('admin/penerima/periode/' . $id_periode);
        }

        // print_r($dicari);

        $data['data_scroring'] = $score;
        $data['id_periode'] = $id_periode;

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/spk/hasil/score_desc", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function cek_akurasi($id_periode)
    {
        $this->load->library("excel");

        $nama_user = $this->session->userdata('nama');
        $title = 'Cek Akurasi Data';
        $data = [
            'spk' => 'hasil',
            'title' => $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi(' <a href="' . base_url('admin/spk/hasil') . '">Implementasi AHP</a> / ' . ' <a href="' . base_url('admin/spk/hasil/cek_implementasi/') . $id_periode . '">.</a> / ' . ' <a href="' . base_url('admin/spk/hasil/implementWBobot/') . $id_periode . '">. </a> / ' . ' <a href="' . base_url('admin/spk/hasil/scoring/') . $id_periode . '">Proses Scoring dan Status </a> / ' . $title),
        ];

        $this->form_validation->set_rules('file', 'File', 'callback_import_validation');


        // Inisialisasi
        $alternatif = $this->model_alternatif->sort_alternatif($id_periode)->result_array();
        $periode = $this->model_periode->tahun_periode_id($id_periode)->row_array();

        // Input array
        $score = array();
        $i = 0;
        foreach ($alternatif as $al) {
            if ($i <= $periode['kuota'] - 1) {
                $score[$i] = array(
                    'id_penduduk' => $al['id_penduduk'],
                    'nama' => $al['nama'],
                    'nik' => $al['nik'],
                    'alamat' => $al['alamat'],
                    'score' => $al['skor'],
                    'status' => 'Diterima'
                );
            } else {
                $score[$i] = array(
                    'id_penduduk' => $al['id_penduduk'],
                    'nama' => $al['nama'],
                    'nik' => $al['nik'],
                    'alamat' => $al['alamat'],
                    'score' => $al['skor'],
                    'status' => 'Ditolak'
                );
            }
            $i++;
        }
        // End 

        $data['hasil_ahp'] = $score;
        $data['id_periode'] = $id_periode;

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/spk/hasil/cek_akurasi", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function import_validation()
    {
        if (isset($_FILES['file'])) {
            $allowed = ['xls', 'xlsx'];

            if (empty($_FILES['file']['name'])) {
                $this->session->set_flashdata('import_validation', "Field tidak boleh kosong!");
                return false;
            } else if (!in_array(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION), $allowed)) {
                $this->session->set_flashdata('import_validation', 'File extensi bukan file excel');
                return false;
            } else if ($_FILES['file']['size'] >= 10485760) {
                $this->session->set_flashdata('import_validation', 'File Max 10mb' . ', Ukuran file yang diupload: ' . $_FILES['file']['size']);
                return false;
            } else {
                return true;
            }
        }
    }
}
