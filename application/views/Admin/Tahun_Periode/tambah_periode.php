<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <form class="mx-5 mt-3" method="post" action="<?= base_url('admin/tahunperiode/input'); ?>">
                <div class="form-group">
                    <label for="InputNamaPeriode">Nama Periode</label>
                    <input type="text" name="nama" class="form-control w-50" id="InputNama" placeholder="Masukan Nama Periode..." autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="inputTanggalAwal">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control w-25" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="inputTanggalAkhir">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control w-25" autocomplete="off" required>
                </div>

                <label for="InputAnggaran">Anggaran</label><br>
                <div class="input-group mb-3 w-50">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                    </div>
                    <input type="text" id="InputAnggaran" name="anggaran" class="form-control" placeholder="Masukan jumlah anggaran..." aria-describedby="basic-addon1">
                </div>

                <label for="InputNamaPeriode">Kuota Diterima</label>
                <div class="input-group mb-3 w-50">
                    <input type="text" name="kuota" class="form-control" placeholder="Masukan jumlah kuota..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Orang</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputKeterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control w-50" id="InputAlamat" rows="3" placeholder="Masukan Keterangan..." autocomplete="off" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary float-right"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>