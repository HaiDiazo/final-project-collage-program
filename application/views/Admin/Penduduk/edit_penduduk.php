<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <form class="mx-5 mt-3" method="post" action="<?= base_url('admin/penduduk/update/') . $penduduk['id_penduduk']; ?>">
                <div class="form-group">
                    <label for="InputNama">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" id="InputNama" placeholder="Masukan Nama" value="<?= $penduduk['nama']; ?>">
                </div>
                <div class="form-group">
                    <label for="InputNik">NIK</label>
                    <input type="text" name="nik" class="form-control" id="exampleInputPassword1" placeholder="Masukan NIK" value="<?= $penduduk['nik']; ?>">
                </div>
                <div class="form-group">
                    <label for="InputAlamat">Alamat</label>
                    <textarea name="alamat" class="form-control" id="InputAlamat" rows="3" placeholder="Masukan Alamat"><?= $penduduk['alamat']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="usia">Usia</label>
                    <input type="text" name="usia" class="form-control" id="usia" style="width: 240px; " placeholder="Masukan Usia" value="<?= $penduduk['usia']; ?>">
                </div>
                <div class="form-group">
                    <label for="InputPekerjaan">Pekerjaan</label>
                    <select name="pekerjaan" class="form-control" style="width: 240px;" id="InputPekerjaan" onchange="nochoice(this.value)">
                        <option value="" selected disabled>Pilih Pekerjaan</option>
                        <?php foreach ($pekerjaan as $p) : ?>
                            <option value="<?= $p['nama_subkriteria']; ?>" <?php if ($penduduk['pekerjaan'] == $p['nama_subkriteria']) echo "selected" ?>><?= $p['nama_subkriteria']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="InputPekerjaanText" id="textInputPekerjaan" style="display: none;">Masukan Pekerjaan</label>
                    <input type="text" name="pekerjaanInput" id="pekerjaan" class="form-control" style="display: none; width: 240px;">
                </div>
                <div class="form-group w-25">
                    <label for="InputPenghasilan">Penghasilan</label>
                    <input type="text" name="penghasilan" class="form-control" style="width: 240px;" id="exampleInputPassword1" placeholder="Rp. 1.000.000" value="<?= $penduduk['penghasilan']; ?>">
                </div>
                <div class="form-group">
                    <label for="tanggungan">Banyak Tanggungan</label>
                    <input type="text" name="tanggungan" class="form-control" id="tanggungan" style="width: 240px; " placeholder="Masukan Tanggungan" value="<?= $penduduk['tanggungan']; ?>">
                </div>

                <div class="form-group w-25">
                    <label for="InputTerdampak">Terdampak</label>
                    <select name="terdampak" class="form-control" id="InputTerdampak" style="width: 240px;">
                        <option value="" selected disabled>Pilih Terdampak</option>
                        <option value="Terdampak" <?php if ($penduduk['terdampak'] == "Terdampak") {
                                                        echo "selected";
                                                    } ?>>Terdampak</option>
                        <option value="Tidak Terdampak" <?php if ($penduduk['terdampak'] == "Tidak Terdampak") {
                                                            echo "selected";
                                                        } ?>>Tidak Terdampak</option>
                    </select>
                </div>
                <div class="form-group w-25">
                    <label for="InputTerdampak">Status Penduduk</label>
                    <select name="status_pddk" class="form-control" id="InputTerdampak" style="width: 240px;">
                        <option value="" selected disabled>Pilih Status Penduduk</option>
                        <option value="Penduduk" <?php if ($penduduk['status_pddk'] == "Penduduk") {
                                                        echo "selected";
                                                    } ?>>Penduduk</option>
                        <option value="Pendatang" <?php if ($penduduk['status_pddk'] == "Pendatang") {
                                                        echo "selected";
                                                    } ?>>Pendatang</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary float-right"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function nochoice(value) {
        let InputText = document.getElementById('pekerjaan');
        let LabelInput = document.getElementById('textInputPekerjaan');
        if (value == 'Tambah Pekerjaan') {
            InputText.style.display = 'block';
            LabelInput.style.display = 'block';
        } else {
            InputText.style.display = 'none';
            LabelInput.style.display = 'none';
        }
    }
</script>