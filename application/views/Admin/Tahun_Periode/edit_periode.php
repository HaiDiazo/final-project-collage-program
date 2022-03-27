<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <form class="mx-5 mt-3" method="post" action="<?= base_url('admin/tahunperiode/edit/') . $periode['id_periode']; ?>">
                <div class="form-group">
                    <label for="InputNamaPeriode">Nama Periode</label>
                    <input type="text" name="nama" class="form-control" id="InputNama" placeholder="Masukan Nama Periode" autocomplete="off" value="<?= $periode['nama_periode']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="inputTanggalAwal">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control w-25" autocomplete="off" value="<?= $periode['tanggal_awal']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="inputTanggalAkhir">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control w-25" autocomplete="off" value="<?= $periode['tanggal_akhir']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="inputKeterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="InputAlamat" rows="3" placeholder="Masukan Keterangan" autocomplete="off" required><?= $periode['keterangan']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary float-right"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>