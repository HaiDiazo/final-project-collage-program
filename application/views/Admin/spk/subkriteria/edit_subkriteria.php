<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <?php if ($sub == "angka") { ?>
                <form action="<?= base_url('admin/spk/subkriteria/update_subKrit_angka/') . $sub_kriteria['id_subkriteria']; ?>" method="POST">
                    <div class="form-group row">
                        <label for="inputSub" class="col-sm-2 col-form-label">Nilai 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-25" name="nilai1" id="inputSub" value="<?= $nilai1; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSub" class="col-sm-2 col-form-label">Sub Kriteria</label>
                        <div class="col-sm-10">
                            <select name="antara" class="form-control w-25">
                                <option value="" disabled selected>Pilih Operator</option>
                                <option value="-" <?php if ($antara == "-") echo "selected"; ?>>Diantara Keduanya</option>
                                <option value="<" <?php if ($antara == "&lt;") echo "selected"; ?>>Lebih Kecil (<) </option>
                                <option value=">" <?php if ($antara == "&gt;") echo "selected"; ?>>Lebih Besar (>)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSub" class="col-sm-2 col-form-label">Nilai 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-25" name="nilai2" id="inputSub" value="<?= $nilai2; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
            <?php } else { ?>
                <form action="<?= base_url('admin/spk/subkriteria/update_subKrit/') . $sub_kriteria['id_subkriteria']; ?>" method="POST">
                    <div class="form-group row">
                        <label for="inputSub" class="col-sm-2 col-form-label">Sub Kriteria</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-25" name="subkriteria" id="inputSub" value="<?= $sub_kriteria['nama_subkriteria']; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>