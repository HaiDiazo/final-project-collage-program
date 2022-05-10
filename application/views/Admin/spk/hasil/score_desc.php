<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="mr-auto bd-highlight">
                    <span style="font-size: 13px;"> Simpan ke data penerima:</span> <br>
                    <a href="<?= base_url('admin/spk/hasil/scoring/') . $id_periode . "/" . 1; ?>" class="btn btn-primary"> <span style="font-size: 13px;">Simpan <i class="bi bi-arrow-right"></i></span></a>
                    <!-- <a href="#" class="btn btn-success"> <span style="font-size: 13px;">Akurasi <i class="bi bi-arrow-right"></i></span></a> -->
                </div>
                <div class="">
                    <div class="input-icons">
                        <i class="bi bi-search icon"></i>
                        <input type="text" name="search" id="myInputSearch" class="input-field" placeholder="search...">
                    </div>
                </div>
            </div>

            <hr>
            <div class="table-responsive">
                <table id="example" class="table table-bordered" style="max-width: 40rem;">
                    <thead>
                        <tr style="background-color: #F9FAFB; font-size: 13px;">
                            <th scope="col" class="align-middle">No</th>
                            <th scope="col" class="align-middle">Nama</th>
                            <th scope="col" class="align-middle">NIK</th>
                            <th scope="col" class="align-middle">Alamat</th>
                            <th scope="col" class="align-middle">Score</th>
                            <th scope="col" class="align-middle">Status</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php $i = 1; ?>
                        <?php foreach ($data_scroring as $ds) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $ds['nama']; ?></td>
                                <td><?= $ds['nik']; ?></td>
                                <td><?= $ds['alamat']; ?></td>
                                <td><?= round($ds['score'], 4); ?></td>
                                <td><?= $ds['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>