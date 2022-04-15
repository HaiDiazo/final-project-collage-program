<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <form action="<?= base_url('admin/spk/kriteria/kriteria_masuk/') . $jum_perbandingan; ?>" method="POST">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <hr>
                <table class="table table-bordered" style="max-width: 40rem;">
                    <thead>
                        <tr style="background-color: #F9FAFB; font-size: 13px;">
                            <th>Kriteria 1</th>
                            <th>Nilai perbandingan</th>
                            <th>Kriteria 2</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        $var = 0;
                        $akhir = count($kriteria_arr);
                        $jum_perbandingan = 0;
                        for ($i = 0; $i < count($kriteria_arr); $i++) {
                            $start = 0;

                            while ($start < $akhir) {
                                if ($kriteria_arr[$i] != $kriteria_arr[$start + $i]) {
                        ?>
                                    <div>
                                    </div>
                                    <tr>
                                        <td>
                                            <input type="text" name="kriteria1[]" value="<?= $id_kriteria[$i]; ?>" hidden>
                                            <?= $kriteria_arr[$i]; ?>
                                        </td>
                                        <td>
                                            <select class="custom-select" name="nilaiElemen<?= $var; ?>">
                                                <option value="" <?php if ($nilai_perb[$var] == 0 || $nilai_perb[$var] == null) echo "selected"; ?>>Pilih tingkat kepentingan</option>
                                                <option value="9_1">9; Kriteria <?= $kriteria_arr[$i]; ?> mutlak diutamakan </option>
                                                <option value="7_1">9; Kriteria <?= $kriteria_arr[$i]; ?> sangat diutamakan </option>
                                            </select>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name="kriteria2[]" value="<?= $id_kriteria[$start + $i]; ?>" hidden>
                                                <?= $kriteria_arr[$start + $i]; ?>
                                            </div>
                                        </td>
                                    </tr>
                        <?php
                                    $jum_perbandingan++;
                                    $var++;
                                }
                                $start++;
                            }
                            $akhir--;
                        } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>