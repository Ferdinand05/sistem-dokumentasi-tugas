<!-- Modal -->
<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('/modul/addModul', ['class' => 'formModul']); ?>
                <?= csrf_field(); ?>
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="nama_modul">Nama Modul</label>
                        <input type="text" name="nama_modul" id="nama_modul" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="modul_pelajaran">Pelajaran</label>
                        <div class="input-group">
                            <select name="modul_pelajaran" id="modul_pelajaran" class="form-control">
                                <?php foreach ($pelajaran as $p) : ?>
                                    <option value="<?= $p['id_pelajaran']; ?>"><?= $p['nama_pelajaran']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="modul_semester">Semester</label>
                        <div class="input-group">
                            <select name="modul_semester" id="modul_semester" class="form-control">
                                <?php foreach ($semester as $s) : ?>
                                    <option value="<?= $s['id_semester']; ?>"><?= $s['semester']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
                <div class=" small text-danger error">
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $('.formModul').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/modul/addModul",
            data: {
                nama_modul: $('#nama_modul').val(),
                modul_semester: $('#modul_semester').val(),
                modul_pelajaran: $('#modul_pelajaran').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $('#nama_modul').addClass('is-invalid');
                    $('#modul_semester').addClass('is-invalid');
                    $('#modul_pelajaran').addClass('is-invalid');
                    $('.error').html(response.error);
                }

                if (response.success) {
                    $('#modalUpload').modal('hide');
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    )
                    listDataModul();
                }

            }
        });
    });
</script>