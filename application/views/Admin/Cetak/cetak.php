<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <h6>Berdasarkan Periode</h6>
            <form method="POST" target="_blank" action="<?= base_url('admin/cetak/print_periode'); ?>">
                <div class="form-group row">
                    <label for="inputPeriode" class="col-sm-2 col-form-label">Pilih Periode</label>
                    <div class="col-sm-10">
                        <select name="periode" id="periode" class="form-control" style="width: 270px;">
                            <?php foreach ($periode as $p) : ?>
                                <option value="<?= $p['id_periode']; ?>">
                                    <?php
                                    $tgl_awal = date_create($p['tanggal_awal']);
                                    $tgl_akhir = date_create($p['tanggal_akhir']);

                                    echo date_format($tgl_awal, ('d/M/Y')) . ' - ' . date_format($tgl_akhir, 'd/M/Y');
                                    ?></option>
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