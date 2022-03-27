<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <h4>Matrix Comparasion </h4>
            <table class="table table-bordered" style="max-width: 60rem;">
                <thead class="align-middle">
                    <tr style="background-color: #F9FAFB; font-size: 13px;">
                        <th style="width: 100px;"></th>
                        <th>Banyak<br>Tanggungan</th>
                        <th>Jenis<br>Pekerjaan</th>
                        <th>Penghasilan</th>
                        <th>Usia</th>
                        <th>Terdampak</th>
                        <th>Status<br>Penduduk</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php
                    $temp = 0;

                    $akhir = count($kriteria_arr);
                    $min = 0;

                    for ($i = 0; $i < count($kriteria_arr); $i++) { ?>
                        <tr class="text-center">
                            <?php
                            $start = 0;
                            echo "<td class='text-left'>" . $kriteria_arr[$i] . "</td>";

                            while ($start < $akhir) {
                                if ($i == $start) {
                                    echo "<td>" . 1 . "</td>";
                                } else {
                                    echo "<td>" . "*" . "</td>";
                                }
                                $start++;
                                $temp++;
                            }
                            ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>