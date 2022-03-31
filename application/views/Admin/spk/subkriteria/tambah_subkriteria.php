<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <?php if ($sub == "angka") { ?>
                <form action="<?= base_url('admin/spk/subkriteria/insert_subKrit_angka/') . $id_kriteria; ?>" method="POST">
                    <div class="form-group row">
                        <label for="inputSub" class="col-sm-2 col-form-label">Nilai 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-25" name="nilai1" id="inputSub" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSub" class="col-sm-2 col-form-label">Sub Kriteria</label>
                        <div class="col-sm-10">
                            <select name="antara" class="form-control w-25">
                                <option value="" disabled selected>Pilih Operator</option>
                                <option value="-">Diantara Keduanya</option>
                                <option value="<">Lebih Kecil (<) </option>
                                <option value=">">Lebih Besar (>)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSub" class="col-sm-2 col-form-label">Nilai 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-25" name="nilai2" id="inputSub" value="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
            <?php } else { ?>
                <form action="<?= base_url('admin/spk/subkriteria/insert_subKrit/') . $id_kriteria; ?>" method="POST">
                    <div class="form-group row">
                        <label for="inputSub" class="col-sm-2 col-form-label">Sub Kriteria</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-25" name="subkriteria" id="inputSub" value="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>