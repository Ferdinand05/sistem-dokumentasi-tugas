<?= $this->extend('template/index'); ?>

<?= $this->section('content-title'); ?>
MODUL / SLIDE
<?= $this->endSection(); ?>

<?= $this->section('content-subtitle'); ?>
<button type="button" class="btn btn-primary" id="btnModalUpload"><i class="fa fa-plus fa-lg"></i></button>

<script>
    $('#btnModalUpload').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/modul/modalUpload",
            dataType: "json",
            success: function(response) {
                $('.viewModalModul').html(response.data);
                $('#modalUpload').modal('show');
            }
        });
    });
</script>

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<table class="dataTable table table-hover table-bordered" id="tableModul" style="width: 100%;">
    <thead class="bg-dark">
        <tr>
            <th>No</th>
            <th>Nama Modul</th>
            <th>Pelajaran</th>
            <th style="width: 9%;">Semester</th>
            <th>File</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<div class="viewModalModul"></div>


<script>
    function listDataModul() {

        $('#tableModul').DataTable({

            destroy: true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "/modul/listDataModul",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        })
    }

    function uploadModul(id_modul) {
        $.ajax({
            type: "post",
            url: "/modul/modalUploadFile",
            data: {
                id_modul: id_modul
            },
            dataType: "json",
            success: function(response) {
                $('.viewModalModul').html(response.data);
                $('#modalUploadFile').modal('show');


            }
        });


    }

    function downloadModul(file_modul) {

        if (file_modul == "") {
            Swal.fire(
                'Not Found',
                'File Modul Tidak Ditemukan',
                'question'
            )
        } else {

            window.open('/modulFiles/' + file_modul);
        }

    }


    $(document).ready(function() {
        listDataModul();



    });
</script>
<?= $this->endSection(); ?>





<?= $this->section('content-footer'); ?>
<?= $this->endSection(); ?>