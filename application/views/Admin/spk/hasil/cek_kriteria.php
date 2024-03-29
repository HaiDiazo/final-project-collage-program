<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="mr-auto bd-highlight">
                    <?php if (!count($error_data) > 0) { ?>
                        <a href="<?= base_url('admin/spk/hasil/implementWBobot/') . $id_periode; ?>" class="btn btn-primary"><span>Lanjut Proses</span> <i class="bi bi-arrow-right"></i></a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-primary disabled"><span style="font-size: 15px;">Lanjut Proses</span> <i class="bi bi-arrow-right"></i></a>
                    <?php } ?>
                </div>
                <div class="">
                    <div class="input-icons">
                        <i class="bi bi-search icon"></i>
                        <input type="text" name="search" id="myInputSearch" class="input-field" placeholder="search...">
                    </div>
                </div>
            </div>
            <hr>
            <?php if (count($error_data) > 0) { ?>
                <div>
                    <h6 class="font-weight-bold text-danger">Data tidak cocok</h6>
                </div>
                <div class="rounded bg-light mb-3 p-1" style="height: 50px; overflow-y: scroll;">
                    <?php
                    $i = 1;
                    foreach ($error_data as $ed) {
                        echo "<span style='font-size: 13px;'>[" . $i++ . "] Error subkriteria pada data dengan NAMA : " . $ed['nama'] . "</span>";
                        echo "<br>";
                    }
                    ?>
                </div>
            <?php } ?>

            <div class="table-responsive">
                <table id="example" class="table table-bordered text-center">
                    <thead style="font-size: 13px;">
                        <tr>
                            <th scope="col" class="align-middle">No</th>
                            <th scope="col" class="align-middle">Nama</th>
                            <th scope="col" class="align-middle">Usia</th>
                            <th scope="col" class="align-middle">Jumlah <br> (Tanggungan)</th>
                            <th scope="col" class="align-middle">Pekerjaan</th>
                            <th scope="col" class="align-middle">Penghasilan</th>
                            <th scope="col" class="align-middle">Terdampak</th>
                            <th scope="col" class="align-middle">Status <br> Penduduk</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php $no = 1; ?>
                        <?php foreach ($penduduk as $p) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td class="text-left"><?= $p['nama']; ?></td>

                                <!-- Usia -->
                                <?php
                                if (is_numeric($p['usia'])) {
                                    echo "<td>" . $p['usia'] . "</td>";
                                } else {
                                    echo "<td class='bg-danger text-white'>" . $p['usia'] . "</td>";
                                }
                                ?>

                                <!-- Tanggungan -->
                                <?php
                                if (is_numeric($p['tanggungan'])) {
                                    echo "<td>" . $p['tanggungan'] . "</td>";
                                } else {
                                    echo "<td class='bg-danger text-white'>" . $p['tanggungan'] . "</td>";
                                }
                                ?>
                                <!-- Pekerjaan -->
                                <?php

                                $temp = 0;
                                foreach ($pekerjaan as $pr) {
                                    if ($p['pekerjaan'] == $pr['nama_subkriteria']) {
                                        $temp++;
                                    }
                                }
                                if ($temp == 0) {
                                    echo "<td class='bg-danger text-white'>" . $p['pekerjaan'] . "</td>";
                                } else {
                                    echo "<td>" . $p['pekerjaan'] . "</td>";
                                }

                                ?>

                                <!-- Penghasilan -->
                                <?php
                                if (is_numeric($p['penghasilan'])) {
                                    echo "<td>" . $p['penghasilan'] . "</td>";
                                } else {
                                    echo "<td class='bg-danger text-white'>" . $p['penghasilan'] . "</td>";
                                }
                                ?>

                                <!-- Terdampak -->
                                <?php

                                $temp = 0;
                                foreach ($terdampak as $pr) {
                                    if ($p['terdampak'] == $pr['nama_subkriteria']) {
                                        $temp++;
                                    }
                                }
                                if ($temp == 0) {
                                    echo "<td class='bg-danger text-white'>" . $p['terdampak'] . "</td>";
                                } else {
                                    echo "<td>" . $p['terdampak'] . "</td>";
                                }

                                ?>

                                <!-- Status Penduduk -->
                                <?php

                                $temp = 0;
                                foreach ($status_penduduk as $pr) {
                                    if ($p['status_pddk'] == $pr['nama_subkriteria']) {
                                        $temp++;
                                    }
                                }
                                if ($temp == 0) {
                                    echo "<td class='bg-danger text-white'>" . $p['status_pddk'] . "</td>";
                                } else {
                                    echo "<td>" . $p['status_pddk'] . "</td>";
                                }

                                ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>