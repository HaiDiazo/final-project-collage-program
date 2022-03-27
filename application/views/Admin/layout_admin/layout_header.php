<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/style/style2.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/style/styleme.css'); ?>" type="text/css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/dataTables/dataTables.bootsrap4.min.css'); ?>">


    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="<?= base_url('assets/bootstrap/js/jquery.min.js'); ?>"></script>
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
    <title><?= $title; ?></title>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" <?php if ($this->session->userdata('tombol') != 0) echo "class='active'"; ?>>
            <div class="sidebar-header">

            </div>
            <ul class="list-unstyled components">
                <li class="<?php if ($title == "Dashboard") {
                                echo "active";
                            } ?>">
                    <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
                </li>

                <!-- Dropdown Data Master -->
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Data Master</a>
                    <ul class="collapse list-unstyled <?php if (isset($data_master)) echo "show"; ?>" id="homeSubmenu">
                        <li>
                            <a href="<?= base_url('admin/tahunperiode'); ?>" class="<?php if (isset($data_master)) if ($data_master == 'periode') echo 'active'; ?>">Tahun Periode</a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/penduduk'); ?>" class="<?php if (isset($data_master)) if ($data_master == 'penduduk') echo 'active'; ?>">Data Penduduk</a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/penerima'); ?>" class="<?php if (isset($data_master)) if ($data_master == 'penerima') echo 'active'; ?>">Data Penerima Bantuan</a>
                        </li>
                    </ul>
                </li>
                <!-- End Dropdown -->

                <li>
                    <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Sistem Pendukung Keputusan (AHP)</a>
                    <ul class="collapse list-unstyled <?php if (isset($spk)) echo 'show'; ?>" id="homeSubmenu2">
                        <li>
                            <a href="<?= base_url('admin/spk/kriteria'); ?>" class="<?php if (isset($spk)) if ($spk == 'kriteria') echo 'active'; ?>">Prioritas Elemen Kriteria</a>
                        </li>
                        <li>
                            <a href="#">Prioritas Elemen SubKriteria</a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/spk/proses'); ?>" class="<?php if (isset($spk)) if ($spk == 'prosesAhp') echo 'active'; ?>">Proses AHP</a>
                        </li>
                        <li>
                            <a href="#">Hasil AHP</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if ($title == 'Cetak Laporan') {
                                echo 'active';
                            } ?>">
                    <a href="<?= base_url('admin/cetak'); ?>">Cetak Laporan</a>
                </li>
                <li>
                    <a href="#">Tentang Aplikasi</a>
                </li>
                <li>
                    <a href="<?= base_url('login/logout'); ?>">Logout</a>
                </li>
            </ul>
        </nav>
        <div id="content" class="content">

            <nav class="border navbar navbar-expand-lg navbar-light bg-white">
                <div class="">
                    <button type="button" id="sidebarCollapse" class="btn btn-info" onclick="sendSessionTombol(this)">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                </div>
                <div class="mt-2 ml-2">
                    <h5 class=""><?= $title; ?></h5>
                </div>
                <div class="ml-auto">
                    <div class="navbar-text">
                        <img src="<?= base_url('assets/img/user.png'); ?>" alt="" width="20" class="border border-dark rounded-circle mr-1">
                        <?= $nama_user; ?>
                    </div>
                </div>
            </nav>

            <?php
            if (!($title == "Dashboard")) {
            ?>
                <div class="card m-3">
                    <div class="card-body" style="font-size: 14px;">
                        <?= $navigasi; ?>
                    </div>
                </div>
            <?php } ?>