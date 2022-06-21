<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <h6>Nama Terang untuk di Laporan</h6>
            <form method="POST" action="<?= base_url('admin/cetak/setNamaTerang'); ?>">
                <?php echo $this->session->flashdata('nama_terang'); ?>
                <div class="form-group row">
                    <label for="inputPeriode" class="col-sm-2 col-form-label">Nama Terang</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama_terang" class="form-control" value="<?= $nama_terang; ?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card rounded mt-3">
        <div class="card-body">
            <h6>Berdasarkan Periode</h6>
            <form method="POST" target="_blank" action="<?= base_url('admin/cetak/print_periode'); ?>">
                <div class="form-group row">
                    <label for="inputPeriode" class="col-sm-2 col-form-label">Pilih Periode</label>
                    <div class="col-sm-10">
                        <select name="periode" id="periode" class="form-control" style="width: 270px;">
                            <?php foreach ($periode as $p) : ?>
                                <option value="<?= $p['id_periode']; ?>"><?= $p['nama_periode']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary " name="submit" value="Print Laporan" <?php if ($cek_periode == 0) echo "disabled"; ?>>
                </div>
            </form>
        </div>
    </div>

    <div class="card rounded mt-3">
        <div class="card-body">
            <h6>Berdasarkan Periode Yang Telah Menggunakan AHP</h6>
            <form method="POST" target="_blank" action="<?= base_url('admin/cetak/printlaporanSkor'); ?>">
                <div class="form-group row">
                    <label for="inputPeriode" class="col-sm-2 col-form-label">Pilih Periode</label>
                    <div class="col-sm-10">
                        <select name="periodeAHP" id="periode" class="form-control" style="width: 270px;">
                            <?php foreach ($useAHP as $p) : ?>
                                <option value="<?= $p['id_periode']; ?>"><?= $p['nama_periode']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary " name="submit" value="Print Laporan" <?php if ($cek_periode == 0) echo "disabled"; ?>>
                </div>
            </form>
        </div>
    </div>

    <div class="card rounded mt-3">
        <div class="card-body">
            <h6>Masukan Tanggal Periode</h6>
            <form method="POST" target="_blank" action="<?= base_url('admin/cetak/print'); ?>">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Dari</label>
                    <div class="col-sm-10">
                        <input type="date" name="dari" class="form-control" style="width: 270px;">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Sampai</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="sampai" style="width: 270px;">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Print Laporan" <?php if ($cek_periode == 0) echo "disabled"; ?>>
                </div>
            </form>
        </div>
    </div>
</div>