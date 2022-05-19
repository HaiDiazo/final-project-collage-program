<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect();
        }
        $this->perPage = 10;
    }

    private function navigasi($title)
    {
        $navigasi = '<a href="' . base_url('admin/dashboard') . '">Dashboard</a> / ' . $title;
        return $navigasi;
    }

    private function pick_three_word($val)
    {
        $str = explode(" ", $val);
        $name_str = "";

        if (count($str) > 3) {
            $name_str = $str[0] . " " . $str[1] . " " . $str[2] . "...";
        } else {
            $name_str = $val;
        }


        return $name_str;
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $data['data_master'] = 'penduduk';
        $data['nama_user'] = $this->session->userdata('nama');
        // Buat tampilan periode terbaru
        $cek_periode = $this->model_periode->get_new_periode()->num_rows();
        $data_periode = $this->model_periode->get_new_periode()->row_array();

        // Susun Tanggal
        $periode_name = $this->pick_three_word($data_periode['nama_periode']);
        $tanggal_awal = date_create($data_periode['tanggal_awal']);
        $tanggal_akhir = date_create($data_periode['tanggal_akhir']);


        if ($cek_periode > 0) {
            $title = 'Data Penduduk ' . $periode_name . ' (' . date_format($tanggal_awal, "d M Y") . ' - ' . date_format($tanggal_akhir, "d M Y") . ')';
            $data['title'] = $title;
            $data['navigasi'] = $this->navigasi($title);
        } else {
            $title = 'Data Penduduk Periode (Belum Ada Data Periode)';
            $data['title'] = $title;
            $data['navigasi'] = $this->navigasi($title);
        }

        $data['penduduk'] = $this->model_penduduk->penduduk_periode($data_periode['id_periode'])->result_array();

        // Buat dropdown
        $periode_all = $this->model_periode->tahun_periode()->result_array();


        // Buat Dropdown - Ambil 3 kata didepan
        $name_periode = array();

        for ($i = 0; $i < count($periode_all); $i++) {

            /** explode beberapa bagian string, jika lebih dari 3 terdapat "..." */
            $name_str = $this->pick_three_word($periode_all[$i]['nama_periode']);

            // Insert into array
            $nama_periode[$i] = array(
                'id_periode' => $periode_all[$i]['id_periode'],
                'tanggal_awal' => $periode_all[$i]['tanggal_awal'],
                'tanggal_akhir' => $periode_all[$i]['tanggal_akhir'],
                'nama_periode' => $name_str
            );
        }
        $data['periode'] = $nama_periode;
        // =============

        // Buat tambah data / import
        $data['id_periode'] = $data_periode['id_periode'];
        // =========================

        // Cek periode
        $data['cek_periode'] = $cek_periode;
        // =========================

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/Penduduk/Penduduk", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function periode($id_periode)
    {

        $username = $this->session->userdata('username');
        $nama_user = $this->session->userdata('nama');
        $data['data_master'] = 'penduduk';
        $data['nama_user'] = $nama_user;

        $cek_periode = $this->model_periode->get_new_periode()->num_rows();
        $data['penduduk'] = $this->model_penduduk->penduduk_periode($id_periode)->result_array();


        // Buat dropdown
        $periode_all = $this->model_periode->tahun_periode()->result_array();


        // Buat Dropdown - Ambil 3 kata didepan
        $name_periode = array();

        for ($i = 0; $i < count($periode_all); $i++) {

            /** explode beberapa bagian string, jika lebih dari 3 terdapat "..." */
            $name_str = $this->pick_three_word($periode_all[$i]['nama_periode']);

            // Insert into array
            $nama_periode[$i] = array(
                'id_periode' => $periode_all[$i]['id_periode'],
                'tanggal_awal' => $periode_all[$i]['tanggal_awal'],
                'tanggal_akhir' => $periode_all[$i]['tanggal_akhir'],
                'nama_periode' => $name_str
            );
        }
        $data['periode'] = $nama_periode;
        // =============


        $where = array('id_periode' => $id_periode);
        $data_periode = $this->model_periode->get_periode($where)->row_array();

        // Susun Tanggal
        $periode_name = $this->pick_three_word($data_periode['nama_periode']);
        $tanggal_awal = date_create($data_periode['tanggal_awal']);
        $tanggal_akhir = date_create($data_periode['tanggal_akhir']);

        if ($cek_periode > 0) {
            $title = 'Data Penduduk ' . $periode_name . ' (' . date_format($tanggal_awal, "d M Y") . ' - ' . date_format($tanggal_akhir, "d M Y") . ')';
            $data['title'] = $title;
            $data['navigasi'] = $this->navigasi($title);
        } else {
            $title = 'Data Penduduk Periode (Belum Ada Data Periode)';
            $data['title'] = $title;
            $data['navigasi'] = $this->navigasi($title);
        }

        // Untuk Proses Tambah Data
        $data['id_periode'] = $id_periode;
        // ========================

        // Cek periode
        $data['cek_periode'] = $cek_periode;
        // =========================


        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/Penduduk/Penduduk", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function tambah_penduduk($id_periode)
    {
        $username = $this->session->userdata('username');
        $nama_user = $this->session->userdata('nama');

        $where = array('id_periode' => $id_periode);
        $data_periode = $this->model_periode->get_periode($where)->row_array();

        // Susun Tanggal
        $tanggal_awal = date_create($data_periode['tanggal_awal']);
        $tanggal_akhir = date_create($data_periode['tanggal_akhir']);

        $title = 'Periode (' . date_format($tanggal_awal, "d M Y") . ' - ' . date_format($tanggal_akhir, "d M Y") . ')';


        $title_all = '<a href="' . base_url('admin/penduduk') . '">Data Penduduk</a> / ' . 'Tambah Data Penduduk ' . $title;

        $data = [
            'data_master' => 'penduduk',
            'title' => 'Tambah Data Penduduk ' . $title,
            'nama_user' => $nama_user
        ];

        $data['navigasi'] = $this->navigasi($title_all);
        $data['id_periode'] = $id_periode;
        $data['pekerjaan'] = $this->model_subkriteria->get_subkriteria_pekerjaan()->result_array();


        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/Penduduk/tambah_penduduk", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function import_menu($id_periode)
    {
        $username = $this->session->userdata('username');
        $nama_user = $this->session->userdata('nama');

        $where = array('id_periode' => $id_periode);
        $data_periode = $this->model_periode->get_periode($where)->row_array();

        // Susun Tanggal
        $tanggal_awal = date_create($data_periode['tanggal_awal']);
        $tanggal_akhir = date_create($data_periode['tanggal_akhir']);

        $title = 'Periode (' . date_format($tanggal_awal, "d M Y") . ' - ' . date_format($tanggal_akhir, "d M Y") . ')';

        $title_all = '<a href="' . base_url('admin/penduduk') . '">Data Penduduk</a> / ' . 'Import Data Excel ' . $title;

        $data = [
            'data_master' => 'penduduk',
            'title' => 'Import Data Excel ' . $title,
            'nama_user' => $nama_user,
            'navigasi' => $this->navigasi($title_all),
            'id_periode' => $id_periode
        ];

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/penduduk/import_penduduk", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function import($id_periode)
    {
        $this->load->library("excel");

        $this->form_validation->set_rules('file', 'File', 'callback_import_validation');

        if ($this->form_validation->run() == true) {
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];

            $object = PHPExcel_IOFactory::load($file_tmp);

            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();


                for ($row = 2; $row <= $highestRow; $row++) {

                    $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    if (!empty($no)) {

                        $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $nik = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $alamat = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $usia = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $tanggungan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $pekerjaan = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $terdampak = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $penghasilan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $status_pddk = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

                        $data = [
                            'nama' => $nama,
                            'nik' => $nik,
                            'alamat' => $alamat,
                            'usia' => $usia,
                            'tanggungan' => $tanggungan,
                            'pekerjaan' => $pekerjaan,
                            'penghasilan' => $penghasilan,
                            'terdampak' => $terdampak,
                            'status_pddk' => $status_pddk,
                            'id_periode' => $id_periode
                        ];

                        $this->db->insert('tb_penduduk', $data);
                    } else {
                        $row = $highestRow;
                    }
                }

                $this->session->set_flashdata('import', '<div class="alert alert-success mt-3">Import file excel berhasil disimpan di database</div>');
                redirect('admin/penduduk');
            }
        } else {
            redirect('admin/penduduk/import_menu/' . $id_periode);
        }
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

    // Test Import Validation
    // public function import_validation()
    // {
    //     if (isset($_FILES['file'])) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function edit_penduduk($id)
    {
        $username = $this->session->userdata('username');
        $nama_user = $this->session->userdata('nama');
        $title = '<a href="' . base_url('admin/penduduk') . '">Data Penduduk</a> / ' . 'Edit Data Penduduk';


        $data = [
            'title' => 'Edit Data Penduduk',
            'nama_user' => $nama_user
        ];

        $where = array('id_penduduk' => $id);
        $data['navigasi'] = $this->navigasi($title);
        $data['penduduk'] = $this->model_penduduk->get_penduduk($where)->row_array();
        $data['pekerjaan'] = $this->model_subkriteria->get_subkriteria_pekerjaan()->result_array();

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/Penduduk/edit_penduduk", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }

    public function input($id_periode)
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $nik = htmlspecialchars($this->input->post('nik'));
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $usia = htmlspecialchars($this->input->post('usia'));
        $pekerjaanSelect = htmlspecialchars($this->input->post('pekerjaan'));
        $pekerjaanInput = htmlspecialchars($this->input->post('pekerjaanInput'));
        $tanggungan = htmlspecialchars($this->input->post('tanggungan'));
        $penghasilan = htmlspecialchars($this->input->post('penghasilan'));
        $terdampak = htmlspecialchars($this->input->post('terdampak'));
        $status_pddk = htmlspecialchars($this->input->post('status_pddk'));

        // Cek Inputan Pekerjaan 
        if ($pekerjaanSelect == "Tambah Pekerjaan") {
            $pekerjaan = $pekerjaanInput;
        } else {
            $pekerjaan = $pekerjaanSelect;
        }

        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'alamat' => $alamat,
            'usia' => $usia,
            'tanggungan' => $tanggungan,
            'pekerjaan' => $pekerjaan,
            'penghasilan' => $penghasilan,
            'terdampak' => $terdampak,
            'status_pddk' => $status_pddk,
            'id_periode' => $id_periode
        ];

        $this->model_penduduk->tambah_penduduk($data);
        $insert = $this->db->affected_rows() != 1 ? false : true;

        if ($insert == 1) {
            redirect('admin/penduduk/');
        } else {
            redirect('admin/penduduk/tambah_penduduk/' . $id_periode);
        }
    }

    public function update($id)
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $nik = htmlspecialchars($this->input->post('nik'));
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $usia = htmlspecialchars($this->input->post('usia'));
        $pekerjaanSelect = htmlspecialchars($this->input->post('pekerjaan'));
        $pekerjaanInput = htmlspecialchars($this->input->post('pekerjaanInput'));
        $tanggungan = htmlspecialchars($this->input->post('tanggungan'));
        $status = htmlspecialchars($this->input->post('status'));
        $penghasilan = htmlspecialchars($this->input->post('penghasilan'));
        $terdampak = htmlspecialchars($this->input->post('terdampak'));
        $status_pddk = htmlspecialchars($this->input->post('status_pddk'));

        // Cek Inputan Pekerjaan 
        if ($pekerjaanSelect == "Tambah Pekerjaan") {
            $pekerjaan = $pekerjaanInput;
        } else {
            $pekerjaan = $pekerjaanSelect;
        }

        $where = [
            'id_penduduk' => $id,
        ];

        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'alamat' => $alamat,
            'usia' => $usia,
            'tanggungan' => $tanggungan,
            'pekerjaan' => $pekerjaan,
            'penghasilan' => $penghasilan,
            'terdampak' => $terdampak,
            'status_pddk' => $status_pddk
        ];

        $this->model_penduduk->update_penduduk($where, $data);

        $update = $this->db->affected_rows() != 1 ? false : true;

        if ($update > 0) {
            redirect('admin/penduduk');
        } else {
            redirect('admin/penduduk/edit_penduduk/' . $id);
        }
    }

    public function hapus($id)
    {
        $where = [
            'id_penduduk' => $id,
        ];
        $this->model_penduduk->delete_penduduk($where);

        $delete = $this->db->affected_rows();

        if ($delete > 0) {
            redirect('admin/penduduk');
        } else {
            redirect('admin/penduduk');
        }
    }
}
