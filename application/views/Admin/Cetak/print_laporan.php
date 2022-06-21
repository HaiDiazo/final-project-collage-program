<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <style>
        .tabelAtas {
            text-align: center;
        }
    </style>
    <script>
        window.print();
    </script>
</head>


<body>
    <div align="center">
        <h2> Laporan Penerima Bantuan Sosial Covid-19</h2>
        <!-- <div align="left">
            <div class="d-flex flex-row">
                <div class="">
                    Periode : <?= $dari; ?>
                </div>
                <div class="mx-2">
                    <span>-</span>
                </div>
                <div class="">
                    <?= $sampai; ?>
                </div>
            </div>
        </div> -->
        <table class="tabelAtas mt-5">
            <tr>
                <th rowspan="5">
                    <img src="<?= base_url('assets/images/logo-sleman-white2.png'); ?>" height="100px">
                </th>
            </tr>
            <tr>
                <td>Pemerintah Kabupaten Sleman</td>
            </tr>
            <tr>
                <td>Kecamatan Ngaglik</td>
            </tr>
            <tr>
                <td>KEPALA DESA SUKOHARJO</td>
            </tr>
            <tr>
                <td>Jl. Besi- Jangkang Sukoharjo Ngaglik, Sleman (0274) 896887</td>
            </tr>
        </table>
        <hr>
        <br>
        <table border="1" style="width: 100%; text-align: center;" class="mt-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Penghasilan</th>
                    <th scope="col">Jumlah<br>Tanggungan</th>
                    <th scope="col">Status Covid</th>
                    <th scope="col">Status Penerima</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total_dana = 0;
                foreach ($penerima as $p) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td style="text-align: left;"><?= $p['nama']; ?></td>
                        <td style="text-align: left;"><?= $p['nik']; ?></td>
                        <td>Rp. <?= $p['penghasilan']; ?></td>
                        <td><?= $p['tanggungan']; ?></td>
                        <td><?= $p['terdampak']; ?></td>
                        <td><?= $p['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br><br>
        <div align="Right" class="mt-5">
            <table>
                <tr>
                    <td>Sleman, <?php echo date("d M Y") ?></td>
                </tr>
                <tr>
                    <td>Mengetahui Lurah Sukoharjo</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><?= $nama_terang; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>