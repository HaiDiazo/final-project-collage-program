</div>
</div>
<!-- Script Js -->

<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="<?= base_url('assets/bootstrap2/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/main.js'); ?>"></script>

<script src="<?= base_url('assets/dataTables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/dataTables/jquery.bootsrap4.min.js'); ?>"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function() {
            $('#example').DataTable();
        });
    });

    let oTable = $('#example').DataTable({
        "dom": 'lrtip',
    });

    let penerima = $('#tabel_penerima').DataTable({
        "dom": 'lrtip',
        'columnDefs': [{
            'targets': [0],
            'orderable': false
        }],
    });

    $('#myInputSearch').keyup(function() {
        oTable.search($(this).val()).draw();
        penerima.search($(this).val()).draw();
    })

    function sendSessionTombol() {
        let data = {
            tombol: 1,
        };

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('login/sendSessionTombol'); ?>",
            data: data,
        });
    }
</script>
</body>

</html>