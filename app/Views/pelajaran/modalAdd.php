<!-- Modal -->
<div class="modal fade" id="modalAddPelajaran" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('/pelajaran/addPelajaran', ['class' => 'formPelajaran']); ?>
                <div class="form-group">
                    <label for="nama_pelajaran">Pelajaran</label>
                    <div class="input-group">
                        <input type="text" name="nama_pelajaran" id="nama_pelajaran" class="form-control" placeholder="Nama Pelajaran...">
                        <div class="invalid-feedback errorPelajaran">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_semester">Semester</label>
                    <div class="input-group">
                        <select name="id_semester" id="id_semester" class="form-control">
                            <?php foreach ($semester as $s) : ?>
                                <option value="<?= $s['id_semester']; ?>"><?= $s['semester']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.formPelajaran').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "/pelajaran/addPelajaran",
            data: {
                nama_pelajaran: $('#nama_pelajaran').val(),
                id_semester: $('#id_semester').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    );
                    $('#modalAddPelajaran').modal('hide');
                    listDataPelajaran();
                }

                if (response.error) {
                    $('#nama_pelajaran').addClass('is-invalid');
                    $('.errorPelajaran').html(response.error);
                }

            }
        });

    });
</script>