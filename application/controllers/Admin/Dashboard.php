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

        $this->load->view("admin/layout_admin/layout_header", $data);
        $this->load->view("admin/Dashboard", $data);
        $this->load->view("admin/layout_admin/layout_footer");
    }
}
