<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <?= $pesan; ?>
            <div class="d-flex flex-row-reverse">
                <a href="<?= base_url('admin/spk/proses/proses_kriteria/1'); ?>" class="btn btn-primary <?php if ($cons_rasio > 0.1) echo "disabled"; ?>">Lanjut Step<i class="bi bi-arrow-right-short"></i></a>
                <a href="<?= base_url('admin/spk/kriteria'); ?>" class="btn btn-warning mr-2"><i class="bi bi-arrow-left-short"></i>Kembali</a>
            </div>
            <hr>

            <!-- Matrix Comparison -->
            <table class="table table-bordered" style="max-width: 60rem;">
                <thead class="align-middle">
                    <tr>
                        <th colspan="7" class="text-center">Matrix Comparasion</th>
                    </tr>
                    <tr style="background-color: #F9FAFB; font-size: 13px;" class="text-center">
                        <th style="width: 100px;"></th>
                        <th>Banyak<br>Tanggungan</th>
                        <th>Jenis<br>Pekerjaan</th>
                        <th class="align-middle">Penghasilan</th>
                        <th class="align-middle">Usia</th>
                        <th class="align-middle">Terdampak</th>
                        <th>Status<br>Penduduk</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php
                    $n = count($kriteria_arr);

                    for ($x = 0; $x < $n; $x++) {
                        echo "<tr>";
                        echo "<td style='background-color: #F9FAFB;' class='font-weight-bold'>" . $kriteria_arr[$x] . "</td>";
                        for ($y = 0; $y < $n; $y++) {
                            echo "<td class='text-center'>" . round($matrik[$x][$y], 3) . "</td>";
                        }
                        echo "</tr>";
                    } ?>
                    <tr>
                        <td>Total</td>
                        <?php for ($i = 0; $i < $n; $i++) {
                            echo "<td class='text-center'>" . round($total[$i], 3) . "</td>";
                        } ?>
                    </tr>
                </tbody>
            </table>
            <!-- End Matrx Comparison -->

            <!-- Matrix Normalisasi -->
            <table class="table table-bordered mt-4" style="max-width: 60rem;">
                <thead class="align-middle">
                    <tr>
                        <th colspan="9" class="text-center">Matrik Normalisasi</th>
                    </tr>
                    <tr style="background-color: #F9FAFB; font-size: 13px;" class="text-center">
                        <th style="width: 100px;"></th>
                        <th>Banyak<br>Tanggungan</th>
                        <th>Jenis<br>Pekerjaan</th>
                        <th class="align-middle">Penghasilan</th>
                        <th class="align-middle">Usia</th>
                        <th class="align-middle">Terdampak</th>
                        <th>Status<br>Penduduk</th>
                        <th>Jumlah</th>
                        <th>Prioritas</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php
                    $n = count($kriteria_arr);

                    for ($x = 0; $x < $n; $x++) {
                        echo "<tr>";
                        echo "<td style='background-color: #F9FAFB;' class='font-weight-bold'>" . $kriteria_arr[$x] . "</td>";
                        for ($y = 0; $y < $n; $y++) {
                            echo "<td class='text-center'>" . round($normalisasi[$x][$y], 3) . "</td>";
                        }
                        echo "<td class='text-center'>" . round($jumlah_normalisasi[$x], 3) . "</td>";
                        echo "<td class='text-center'>" . round($prioritas[$x], 3) . "</td>";
                        echo "</tr>";
                    } ?>
                    <tr>
                        <td>Total</td>
                        <?php for ($i = 0; $i < $n; $i++) {
                            echo "<td class='text-center'>" . $total_norm[$i] . "</td>";
                        } ?>
                    </tr>
                </tbody>
            </table>
            <!-- End Matrix Normalisasi -->

            <!-- Bobot Kriteria -->
            <div class="d-flex flex-row">
                <div class="">
                    <table class="table table-bordered mt-4" style="max-width: 20rem;">
                        <thead class="align-middle">
                            <tr>
                                <th colspan="2" class="text-center">Bobot Prioritas</th>
                            </tr>
                            <tr style="background-color: #F9FAFB; font-size: 13px;" class="text-center">
                                <th style="width: 100px;">Kriteria</th>
                                <th>Prioritas</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;">
                            <?php
                            $n = count($kriteria_arr);

                            for ($x = 0; $x < $n; $x++) {
                                echo "<tr>";
                                echo "<td style='background-color: #F9FAFB;' class='font-weight-bold'>" . $kriteria_arr[$x] . "</td>";
                                echo "<td class='text-center'>" . round($prioritas[$x], 3) . "</td>";
                                echo "</tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!-- End Bobot Kriteria -->

                <!-- Tabel matrix penjumlahan tiap baris -->
                <div class="ml-3">
                    <table class="table table-bordered mt-4" style="max-width: 60rem;">
                        <thead class="align-middle">
                            <tr>
                                <th colspan="8" class="text-center">Penjumlahan Tiap Baris</th>
                            </tr>
                            <tr style="background-color: #F9FAFB; font-size: 13px;" class="text-center">
                                <th style="width: 100px;"></th>
                                <th>Banyak<br>Tanggungan</th>
                                <th>Jenis<br>Pekerjaan</th>
                                <th class="align-middle">Penghasilan</th>
                                <th class="align-middle">Usia</th>
                                <th class="align-middle">Terdampak</th>
                                <th>Status<br>Penduduk</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;">
                            <?php
                            $n = count($kriteria_arr);

                            for ($x = 0; $x < $n; $x++) {
                                echo "<tr>";
                                echo "<td style='background-color: #F9FAFB;' class='font-weight-bold'>" . $kriteria_arr[$x] . "</td>";
                                for ($y = 0; $y < $n; $y++) {
                                    echo "<td class='text-center'>" . round($penjumlahan_tiap_baris[$x][$y], 3) . "</td>";
                                }
                                echo "<td class='text-center'>" . round($jumlah_tiap_baris[$x], 3) . "</td>";
                                echo "</tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!-- End matrix penjumlahan tiap baris -->
            </div>

            <!-- Rasio Konsistensi -->
            <div class="d-flex flex-row">
                <div class="">
                    <table class="table table-bordered mt-4" style="max-width: 20rem;">
                        <thead class="align-middle">
                            <tr>
                                <th colspan="4" class="text-center">Rasio Konsistensi</th>
                            </tr>
                            <tr style="background-color: #F9FAFB; font-size: 13px;" class="text-center">
                                <th style="width: 100px;">Kriteria</th>
                                <th>Jumlah</th>
                                <th>Prioritas</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;">
                            <?php
                            $n = count($kriteria_arr);

                            for ($x = 0; $x < $n; $x++) {
                                echo "<tr>";
                                echo "<td style='background-color: #F9FAFB;' class='font-weight-bold'>" . $kriteria_arr[$x] . "</td>";
                                echo "<td class='text-center'>" . round($jumlah_tiap_baris[$x], 3) . "</td>";
                                echo "<td class='text-center'>" . round($prioritas[$x], 3) . "</td>";
                                echo "<td class='text-center'>" . round($nilai[$x], 3) . "</td>";
                                echo "</tr>";
                            } ?>
                            <tr>
                                <td colspan="3">Jumlah</td>
                                <td><?= round($jumlah_nilai, 3); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3">λmaks / Eigen Value
                                </td>
                                <td><?= round($eigen, 3); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tabel consistensi index dan consistensi rasio -->
                <div class="ml-3">
                    <table class="table table-bordered mt-4" style="max-width: 15rem;">
                        <thead class="align-middle">
                            <tr>
                                <th colspan="2" class="text-center">Rasio Consistensi</th>
                            </tr>
                            <tr style="background-color: #F9FAFB; font-size: 13px;" class="text-center">
                                <th style="width: 100px;">#</th>
                                <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;">
                            <tr>
                                <td>Consistensi Index</td>
                                <td class="align-middle"><?= round($cons_index, 3); ?></td>
                            </tr>
                            <tr>
                                <td>Index Random</td>
                                <td><?= $ir; ?></td>
                            </tr>
                            <tr>
                                <td>Consistensi Rasio</td>
                                <td class="align-middle <?php if ($cons_rasio < 0.1) {
                                                            echo "bg-success text-white";
                                                        } else {
                                                            echo "bg-danger text-white";
                                                        } ?>"><?= round($cons_rasio, 3); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div style="max-width: 30rem;">
                        <h5>Kesimpulan</h5>
                        <?php if ($cons_rasio < 0.1) { ?>
                            <p style="font-size: 14px;">Dengan Consistensi Rasio yang telah didapatkan bahwa yaitu sebesar <span class="font-weight-bold"><?= round($cons_rasio, 3); ?> < 0.1</span> atau lebih kecil dari 0.1, maka perbandigan elemen sebelumnya adalah <span class="font-weight-bold">KONSISTEN</span>.
                            </p>
                        <?php } else { ?>
                            <p style="font-size: 14px;">Dengan Consistensi Rasio yang telah didapatkan bahwa yaitu sebesar <span class="font-weight-bold"><?= round($cons_rasio, 3); ?> < 0.1</span> atau lebih besar dari 0.1, maka perbandigan elemen sebelumnya adalah <span class="font-weight-bold">TIDAK KONSISTEN</span>.
                            </p>
                        <?php } ?>
                    </div>
                </div>
                <!-- End consistensi index dan consistensi rasio -->
            </div>
            <!-- End Rasio Konsistensi -->
        </div>
    </div>
</div>