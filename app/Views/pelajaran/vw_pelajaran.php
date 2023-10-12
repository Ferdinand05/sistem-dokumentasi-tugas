<?= $this->extend('template/index'); ?>

<?= $this->section('content-title'); ?>
Pelajaran
<?= $this->endSection(); ?>

<?= $this->section('content-subtitle'); ?>
<button class="btn btn-primary" id="btnModalAddPelajaran" title="Tambah Pelajaran"><i class="fa fa-plus fa-lg"></i></button>

<script>
    $('#btnModalAddPelajaran').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/pelajaran/modalAddPelajaran",
            dataType: "json",
            success: function(response) {
                $('.viewModalPelajaran').html(response.data);
                $('#modalAddPelajaran').modal('show');
            }
        });
    });
</script>
<?= $this->endSection(); ?>




<?= $this->section('content'); ?>

<table class="table dataTable table-bordered table-hover" id="tablePelajaran" style="width: 100%;">
    <thead class="bg-dark">
        <tr>
            <th style="width: 5%;">No.</th>
            <th>Pelajaran</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>

    </thead>
</table>

<div class="viewModalPelajaran"></div>


<script>
    function listDataPelajaran() {

        $('#tablePelajaran').DataTable({

            destroy: true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "/pelajaran/listDataPelajaran",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [3],
                "orderable": false,
            }, ],
        })
    }

    $(document).ready(function() {
        listDataPelajaran();
    });
</script>
<?= $this->endSection(); ?>





<?= $this->section('content-footer'); ?>
<?= $this->endSection(); ?>