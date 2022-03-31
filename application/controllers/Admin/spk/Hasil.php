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

    public function implementWBobot($id_periode)
    {
        // get data penduduk berdasarkan periode
        $data_penduduk = $this->model_penduduk->penduduk_periode($id_periode);

        // get data kriteria bobot
        $kr_bobot = $this->model_kriteria->data_kriteria()->result_array();

        // get data subkriteria bobot
        $subkr_bobot = $this->model_subkriteria->data_subkriteria(3)->result_array();

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
        print_r($column2);

        // echo is_numeric($subkr_bobot[5]['nama_subkriteria']);
        $pieces = explode(" ", $subkr_bobot[2]['nama_subkriteria']);

        // echo "<br>";

        // echo count($pieces);
        // if ($pieces[1] == "-") {
        //     echo $pieces[1];
        // } else {
        //     echo "Bukan";
        // }


        // Proses subtitusi 

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

                            if (count($pieces) > 2) {
                                if ($pieces[1] == "-") {
                                    // $operator = $pieces[0] . " <= " . $dp[$column[$i]] . " && " . $dp[$column[$i]] . " <= " . $pieces[2];

                                    if ($pieces[0] <= $dp[$column[$i]] && $dp[$column[$i]] <= $pieces[2]) {
                                        $score[$no_p][$column[$i]] = $kr['bobot'] * $sbb['bobot'];
                                    }
                                } else {
                                    // $operator = $pieces[2] . " <= " . $dp[$column[$i]];
                                    if ($pieces[2] <= $dp[$column[$i]]) {
                                        $score[$no_p][$column[$i]] = $kr['bobot'] * $sbb['bobot'];
                                    }
                                }

                                if ($operator) {
                                    $score[$no_p][$column[$i]] = $kr['bobot'] * $sbb['bobot'];
                                }
                            } else {
                                if ($dp[$column[$i]] == $sbb['nama_subkriteria']) {
                                    $score[$no_p][$column[$i]] = $kr['bobot'] * $sbb['bobot'];
                                }
                            }
                        }
                    }
                }
            }
            $no_p++;
        }
        echo "<br><br><br>";
        print_r($score[0]);
        echo "<br><br><br>";
        print_r($score[1]);
        echo "<br><br><br>";
        print_r($score[2]);
        echo "<br><br><br>";
        print_r($score[3]);
        echo "<br><br><br>";
    }
}
