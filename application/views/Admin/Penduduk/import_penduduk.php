<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <div class="">
                <h6>Masukan File Excel</h6>
            </div>
            <form method="POST" action="<?= base_url('admin/penduduk/import/') . $id_periode; ?>" enctype="multipart/form-data">
                <div class="input-group w-50">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" onchange="pressed()" name="file" id="inputFile" aria-describedby="inputGroupFileAddon01" accept=".xls, .xlsx" required>
                        <label for="inputFile" class="custom-file-label" id="fileLabel">Choose file</label>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <span class="text-danger font-italic" style="font-size: 12px;"><?= $this->session->flashdata('import_validation'); ?></span>
                </div>
                <div class="">
                    <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.pressed = function() {
        const a = document.getElementById('inputFile');
        if (a.value == "") {
            fileLabel.innerText = "Pilih File";
        } else {
            var theSplit = a.value.split('\\');
            fileLabel.innerText = theSplit[theSplit.length - 1];
        }
    };
</script>