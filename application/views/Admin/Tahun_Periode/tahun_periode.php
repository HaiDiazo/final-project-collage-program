<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="mr-auto bd-highlight">
                    <a href="<?= base_url('admin/tahunPeriode/tambah_periode'); ?>" class="btn btn-success"><i class="bi bi-plus-lg"></i>
                        <span>Tambah</span>
                    </a>
                </div>
                <div class="">
                    <div class="input-icons">
                        <i class="bi bi-search icon"></i>
                        <input type="text" name="search" id="myInputSearch" class="input-field" placeholder="search...">
                    </div>
                </div>
            </div>

            <?= $this->session->flashdata('import'); ?>

            <hr>
            <div class="table-responsive">
                <table id="example" class="table table-bordered text-center">
                    <thead style="font-size: 13px;">
                        <tr>
                            <th scope="col" class="align-middle">No</th>
                            <th scope="col" class="align-middle">Nama Periode</th>
                            <th scope="col" class="align-middle">Tanggal Periode</th>
                            <th scope="col" class="align-middle">Anggaran</th>
                            <th scope="col" class="align-middle">Kuota</th>
                            <th scope="col" class="align-middle">Keterangan</th>
                            <th scope="col" class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php $no = 1; ?>
                        <?php foreach ($periode as $p) : ?>
                            <tr>
                                <th scope="row" style="width: 30px;"><?= $no++; ?></th>
                                <td class="text-left" style="width: 250px;"><?= $p['nama_periode']; ?></td>
                                <td><?php
                                    $date_awal = date_create($p['tanggal_awal']);
                                    $date_akhir = date_create($p['tanggal_akhir']); ?>
                                    <?= date_format($date_awal, "d, M Y"); ?> - <?= date_format($date_akhir, "d, M Y"); ?>
                                </td>
                                <td>Rp. <?php echo number_format($p['anggaran'], 0, '.', '.') ?></td>
                                <td><?= $p['kuota']; ?> Orang</td>
                                <td><?= $p['keterangan']; ?></td>
                                <td style="width:30px;">
                                    <a href="<?= base_url('admin/tahunperiode/hapus/') . $p['id_periode']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                    <div class="my-2"></div>
                                    <a href="<?= base_url('admin/tahunperiode/edit_periode/') . $p['id_periode']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>