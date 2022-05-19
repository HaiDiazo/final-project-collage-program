<!-- Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card card-stats mt-3">
                <div class="card-body" style="background: linear-gradient(to left, #ffcc00 0%, #ff9900 100%);">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <span style="font-size: 5em;" class="iconify text-white" data-icon="dashicons:clock"></span>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="text-right mt-3">
                                <span class="card-category text-white" style="font-size: 15px;">Total Periode</span>
                                <h3 class="card-title text-white" style="margin-bottom:-2px"><?= $total_periode; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top border-white" style="background: linear-gradient(to left, #ffcc00 0%, #ff9900 100%);">
                    <div class="stats">
                        <i class="bi bi-arrow-repeat text-white"></i><span style="font-size: 13px;" class="text-white"> Update terbaru</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-stats mt-3">
                <div class="card-body " style="background: linear-gradient(to left, #ffcc66 0%, #ff3300 100%);">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-warning">
                                <span class="iconify" data-icon="academicons:open-data" style="color: white; font-size:5em;"></span>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers text-right mt-3">
                                <span class="card-category text-white">Total Kriteria</span>
                                <h4 class="card-title text-white"><?= $total_kriteria; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top border-white" style="background: linear-gradient(to left, #ffcc66 0%, #ff3300 100%);">
                    <div class="stats">
                        <i class="bi bi-bezier2 text-white"></i> <span class="text-white" style="font-size: 13px;"> Kriteria AHP</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-stats mt-3">
                <div class="card-body " style="background: linear-gradient(to left, #33cccc 0%, #0066ff 100%);">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-warning">
                                <span class="iconify" data-icon="fluent:people-checkmark-16-filled" style="color: white; font-size: 5em;"></span>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers text-white text-right mt-3">
                                <span class="card-category text-white">Total Data</span>
                                <h4 class="card-title"><?= $total_data; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top border-white" style="background: linear-gradient(to left, #33cccc 0%, #0066ff 100%);">
                    <div class="stats">
                        <i class="bi bi-bar-chart text-white"></i> <span style="font-size: 13px;" class="text-white"> Total Data Penduduk</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-stats mt-3">
                <div class="card-body " style="background: linear-gradient(to left, #99cc00 0%, #336600 100%);">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-warning">
                                <span class="iconify" data-icon="ion:analytics-sharp" style="color: white; font-size:5em;"></span>
                            </div>
                        </div>
                        <div class="col-7 mt-2">
                            <div class="numbers text-right mt-3">
                                <h5 class="card-title text-white">Metode AHP</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top border-white" style="background: linear-gradient(to left, #99cc00 0%, #336600 100%);">
                    <div class="stats">
                        <span class="iconify" data-icon="icon-park-outline:market-analysis" style="color: white;"></span> <span class="text-white" style="font-size: 13px;"> Analytics Hierarchy Process</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="card card-stats mt-3">
                <div class="card-body ">
                    <canvas id="myChart"></canvas>
                    <?php
                    $nama_periode = "";
                    $anggaran = "";

                    ?>
                    <?php foreach ($periode as $p) {
                        $temp = explode(" ", $p['nama_periode']);
                        if (count($temp) > 1) {
                            $nama_periode .= "'$temp[0] $temp[1]'" . ", ";
                        } else {
                            $nama_periode .= "'$temp[0]'" . ",";
                        }
                        $temp = $p['anggaran'];
                        $anggaran .= "'$temp'" . ", ";
                    } ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6">
            <div class="card card-stats mt-3">
                <div class="card-body">
                    <canvas style="max-height: 350px;" id="myChart2"></canvas>
                    <?php
                    $jumlah = "";
                    $pekerjaan = "";

                    ?>
                    <?php foreach ($pekerjaan_total as $p) {
                        $temp = $p['jumlah'];
                        $jumlah .= "'$temp'" . ", ";
                        $temp = $p['pekerjaan'];
                        $pekerjaan .= "'$temp'" . ", ";
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>/assets/chartjs/node_modules/chartjs/dist/Chart.js"></script>

    <script>
        const data = {
            labels: [<?= $nama_periode; ?>],
            datasets: [{
                label: 'Anggaran Periode Penerima Dana Bantuan',
                data: [<?= $anggaran; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            },
        });
    </script>

    <script>
        const data2 = {
            labels: [<?= $pekerjaan; ?>],
            datasets: [{
                label: 'Jumlah Pekerjaan Masyarakat Terdaftar Dana Bantuan',
                data: [<?= $jumlah; ?>],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                hoverOffset: 4,
            }]
        };

        var cp = document.getElementById("myChart2");
        var myChart2 = new Chart(cp, {
            type: 'pie',
            data: data2,
        });
    </script>