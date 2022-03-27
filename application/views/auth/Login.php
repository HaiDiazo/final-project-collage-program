<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('assets/style/style1.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
    <title>Login - Sistem Informasi Penerima Dana Bantuan</title>
</head>

<body>
    <div class="container" style="margin-top: 70px;">
        <div class="row">
            <div class="col mt-5">
                <div>
                    <h4 class="pt-2"><strong>APLIKASI SISTEM PENDUKUNG KEPUTUSAN <br> PENYALURAN DANA BLTDD KECAMATAN NGAGLIK</strong> </h4>
                    <h6>Silahkan login untuk masuk kedalam sistem</h6>
                </div>
                <div class="img">
                    <img src="<?= base_url('assets/img/gambar.svg'); ?>" height="350">
                </div>
            </div>
            <div class="col-4" style="margin-top: 80px;">
                <div class="mt-5 d-flex justify-content-center">
                    <img class="rounded-circle border p-1" src="<?= base_url('assets/img/user.png'); ?>" width="70">
                </div>
                <div class="mt-3">
                    <form action="<?= base_url('login/masuk'); ?>" method="POST">
                        <div class="form-group">
                            <label for="inputUsername">Username</label>
                            <input type="text" name="username" class="form-control" style="border-radius: 20px; padding: 10px;" id="inputUsername" placeholder="Username">
                            <?php echo $this->session->flashdata('none_username') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="password" class="form-control" style="border-radius: 20px; padding:10px" id="inputPassword" placeholder="Password">
                            <?php echo $this->session->flashdata('wrong_pass') ?>
                            <?php echo $this->session->flashdata('none_pass') ?>
                        </div>
                        <button type="submit" class="w-100 borderme">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom text-center">
        <div class="dropdown-divider"></div>
        <h6>&#169 2022</h6>
    </div>

    <script type="text/javascript" src="<?= base_url('assets/js/main.js'); ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>

</html>