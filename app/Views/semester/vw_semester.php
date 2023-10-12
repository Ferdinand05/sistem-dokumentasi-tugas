<?= $this->extend('template/index'); ?>

<?= $this->section('content-title'); ?>
Semester
<?= $this->endSection(); ?>

<?= $this->section('content-subtitle'); ?>
<button class="btn btn-primary" title="Tambah Data Semester" id="btnModalAdd"><i class="fa fa-plus fa-lg"></i></button>

<script>
    $('#btnModalAdd').click(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "/semester/modalAddSemester",
            dataType: "json",
            success: function(response) {
                $('.viewModalSemester').html(response.data);
                $('#modalAddSemester').modal('show');
            }
        });

    });
</script>

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<table class="dataTable table table-bordered table-hover" id="tableSemester" style="width: 100%;">
    <thead class="bg-dark">
        <tr>
            <th style="width: 5%;">No.</th>
            <th>Semester</th>
            <th style="width: 15%;">Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<div class="viewModalSemester"></div>



<script>
    function listDataSemester() {

        $('#tableSemester').DataTable({

            destroy: true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "/semester/listDataSemester",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [2],
                "orderable": false,
            }, ],
        })
    }

    $(document).ready(function() {
        listDataSemester();
    });
</script>
<?= $this->endSection(); ?>





<?= $this->section('content-footer'); ?>
<?= $this->endSection(); ?>