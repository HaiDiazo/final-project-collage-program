<!-- Content -->
<div class="m-3">

    <?= $this->session->flashdata('success'); ?>

    <div class="card rounded">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="mr-1">
                    <a href="<?= base_url('admin/penerima/tambah_penerima/') . $id_periode; ?>" class="btn btn-success <?php if ($cek_periode == 0) echo "disabled"; ?>"><i class="bi bi-plus-lg"></i> <span>Tambah</span></a>
                </div>
                <div class="dropdown mr-auto">
                    <button class="btn btn-warning <?php if ($cek_periode == 0) echo "disabled"; ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-clock"></i> Periode <i class="bi bi-caret-down-fill"></i>
                    </button>
                    <div class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenuButton">
                        <?php foreach ($periode as $p) : ?>
                            <a class="dropdown-item" href="<?php echo base_url('admin/penerima/periode/') . $p['id_periode'] ?>">
                                <?php
                                $tgl_awal = date_create($p['tanggal_awal']);
                                $tgl_akhir = date_create($p['tanggal_akhir']);

                                echo  $p['nama_periode'] . ' (' . date_format($tgl_awal, ('d M Y')) . ' - ' . date_format($tgl_akhir, 'd M Y') . ')';
                                ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="">
                    <div class="input-icons">
                        <i class="bi bi-search icon"></i>
                        <input type="text" name="search" id="myInputSearch" class="input-field" placeholder="search...">
                    </div>
                </div>
            </div>

            <div class="mt-3" style="font-size: 14px;">
                Total Anggaran: Rp. <?= number_format($anggaran, 0, ',', '.'); ?>
            </div>

            <div class="mt-1" style="font-size: 14px;">
                Sisa Anggaran: Rp. <?= number_format($sisa_anggaran, 0, ',', '.'); ?>
            </div>

            <hr>
            <div class="table-responsive">
                <table id="example" class="table table-bordered text-center">
                    <thead style="font-size: 13px;">
                        <tr>
                            <th scope="col" class="align-middle">No</th>
                            <th scope="col" class="align-middle">Nama</th>
                            <th scope="col" class="align-middle">NIK</th>
                            <th scope="col" class="align-middle">Usia</th>
                            <th scope="col" class="align-middle">Jumlah <br> (Tanggungan)</th>
                            <th scope="col" class="align-middle">Pekerjaan</th>
                            <th scope="col" class="align-middle">Terdampak</th>
                            <th scope="col" class="align-middle">Penghasilan</th>
                            <th scope="col" class="align-middle">Status <br> Penduduk</th>
                            <th scope="col" class="align-middle">Status <br> Penerima</th>
                            <th scope="col" class="align-middle">Jumlah <br> Dana Bantuan</th>
                            <th scope="col" class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php $no = 1; ?>
                        <?php foreach ($penerima as $p) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td class="text-left"><?= $p['nama']; ?></td>
                                <td><?= $p['nik']; ?></td>
                                <td><?= $p['usia']; ?></td>
                                <td><?= $p['tanggungan']; ?></td>
                                <td><?= $p['pekerjaan']; ?></td>
                                <td><?= $p['terdampak']; ?></td>
                                <td><?= $p['penghasilan']; ?></td>
                                <td><?= $p['status_pddk']; ?></td>
                                <td><?= $p['status']; ?></td>
                                <td scope="col" class="align-middle" style="min-width: 200px;">
                                    <form action="<?= base_url('admin/penerima/simpan_dana/') . $id_periode . "/" . $p['id_penerima']; ?>" class="row" method="POST">
                                        <input type="text" name="dana" id="dana" class="form-control col ml-2 mr-1" <?php if (!empty($p['dana'])) { ?> value="<?= $p['dana']; ?>" <?php } ?> <?php if ($p['status'] == "Ditolak") echo "disabled"; ?>>
                                        <button type="submit" class="btn btn-primary col mr-2 " style="max-width: 50px;" <?php if ($p['status'] == "Ditolak") echo "disabled"; ?>><i class="bi bi-file-arrow-up"></i></button>
                                    </form>
                                </td>
                                <td style="width:30px;">
                                    <a href="<?= base_url('admin/penerima/hapus_penerima/') . $id_periode . '/' . $p['id_penerima']; ?>" class="btn btn-danger" style="height: 38px;"><i class="bi bi-trash pt-2"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>