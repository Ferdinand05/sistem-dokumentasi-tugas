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



<div class="viewModalTugas"></div>
<?= $this->endSection(); ?>





<?= $this->section('content-footer'); ?>
<?= $this->endSection(); ?>