<!-- Content -->
<div class="m-3">
    <div class="card rounded">
        <div class="card-body">
            <form action="<?= base_url('admin/penerima/simpan/') . $id_periode; ?>" method="POST" id="proses">
                <div class="d-flex justify-content-end align-items-center">
                    <div class="mr-1">
                        <select name="status_penerima" id="status_penerima" class="form-control" disabled>
                            <option value="" selected>Status Penerima</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="mr-auto">
                        <button class="btn btn-primary" id="simpan" disabled>Simpan</button>
                    </div>
                    <div class="">
                        <div class="input-icons">
                            <i class="bi bi-search icon"></i>
                            <input type="text" name="search" id="myInputSearch" class="input-field" placeholder="search...">
                        </div>
                    </div>
                </div>

                <?= $this->session->flashdata('failed'); ?>

                <hr>
                <div class="table-responsive">
                    <table id="tabel_penerima" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th class=""><input type="checkbox" id="select_all" value="">&nbsp</th>
                                <th scope="col" class="align-middle">No</th>
                                <th scope="col" class="align-middle">Nama</th>
                                <th scope="col" class="align-middle">NIK</th>
                                <th scope="col" class="align-middle">Alamat</th>
                                <th scope="col" class="align-middle">Usia</th>
                                <th scope="col" class="align-middle">Jumlah <br> (Tanggungan)</th>
                                <th scope="col" class="align-middle">Pekerjaan</th>
                                <th scope="col" class="align-middle">Status</th>
                                <th scope="col" class="align-middle">Penghasilan</th>
                                <th scope="col" class="align-middle">Pekerjaan</th>
                                <th scope="col" class="align-middle">Status <br> Penduduk</th>
                                <th scope="col" class="align-middle">Status<br>Penerima</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($penerima as $p) : ?>
                                <tr>
                                    <td><input type="checkbox" name="checked[]" class="check" value="<?= $p['id_penduduk']; ?>"></td>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td class="text-left"><?= $p['nama']; ?></td>
                                    <td><?= $p['nik']; ?></td>
                                    <td><?= $p['alamat']; ?></td>
                                    <td><?= $p['usia']; ?></td>
                                    <td><?= $p['tanggungan']; ?></td>
                                    <td><?= $p['pekerjaan']; ?></td>
                                    <td><?= $p['status_c']; ?></td>
                                    <td><?= $p['penghasilan']; ?></td>
                                    <td><?= $p['terdampak']; ?></td>
                                    <td><?= $p['status_pddk']; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary <?php
                                                                                if (!empty($p['status']) && $p['status'] == "Diterima") {
                                                                                    echo "bg-success";
                                                                                } elseif (!empty($p['status']) && $p['status'] == "Ditolak") {
                                                                                    echo "bg-danger";
                                                                                }
                                                                                ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php
                                                if (!empty($p['status']) && $p['status'] == "Diterima") {
                                                    echo "Diterima";
                                                } elseif (!empty($p['status']) && $p['status'] == "Ditolak") {
                                                    echo "Ditolak";
                                                } else {
                                                    echo "Pilih Status";
                                                }
                                                ?> <i class="bi bi-caret-down-fill"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?= base_url('admin/penerima/status_accept/') . $p['id_penduduk'] . "/" . "Diterima" . "/" . $id_periode; ?>"> Diterima</a>
                                                <a class="dropdown-item" href="<?= base_url('admin/penerima/status_accept/') . $p['id_penduduk'] . "/" . "Ditolak" . "/" . $id_periode; ?>">Ditolak</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#select_all').on('click', function() {
            if (this.checked) {
                $('.check').each(function() {
                    this.checked = true;
                })
                checkLength();
            } else {
                $('.check').each(function() {
                    this.checked = false;
                })
                checkLength();
            }
        });

        function checkLength() {
            if ($('.check:checked').length > 0) {
                $('#status_penerima').removeAttr('disabled', "false");
                $('#simpan').removeAttr('disabled', "false");
            } else {
                $('#status_penerima').attr('disabled', "true");
                $('#simpan').attr('disabled', "true");
            }
        }

        $('.check').on('click', function() {
            checkLength();
        });
    })
</script>