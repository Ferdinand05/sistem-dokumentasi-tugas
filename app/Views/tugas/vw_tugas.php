<?= $this->extend('template/index'); ?>

<?= $this->section('content-title'); ?>
Tugas
<?= $this->endSection(); ?>

<?= $this->section('content-subtitle'); ?>
<button type="button" class="btn btn-primary" id="btnModalAddTugas"><i class="fa fa-plus fa-lg"></i></button>

<script>
    $('#btnModalAddTugas').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/tugas/modalAddTugas",
            dataType: "json",
            success: function(response) {
                $('.viewModalTugas').html(response.data);
                $('#modalAddTugas').modal('show');
            }
        });
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <table class="dataTable table table-hover table-bordered" id="tableTugas" style="width: 100%;">
        <thead class="bg-dark">
            <tr>
                <th>No</th>
                <th>Nama Tugas</th>
                <th>Pelajaran</th>
                <th style="width: 3%;">Link</th>
                <th>Semester</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>




<div class="viewModalTugas"></div>



<script>
    function listDataTugas() {

        $('#tableTugas').DataTable({

            destroy: true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "/tugas/listDataTugas",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0, 3, 5],
                "orderable": false,
            }, ],
        })
    }



    $(document).ready(function() {
        listDataTugas();
    });
</script>
<?= $this->endSection(); ?>





<?= $this->section('content-footer'); ?>
<?= $this->endSection(); ?>