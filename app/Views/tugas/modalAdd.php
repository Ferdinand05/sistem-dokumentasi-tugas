<!-- Modal -->
<div class="modal fade" id="modalAddTugas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <?= form_open('/tugas/addTugas', ['class' => 'formTugas']); ?>
                    <div class="form-group">
                        <label for="nama_pelajaran">Nama Pelajaran</label>
                        <div class="input-group">
                            <select name="nama_pelajaran" id="nama_pelajaran" class="form-control">
                                <option value="" selected disabled>>Pilih Pelajaran< </option>
                                        <?php foreach ($pelajaran as $p) : ?>
                                <option value="<?= $p['id_pelajaran']; ?>"><?= $p['nama_pelajaran']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_tugas">Nama Tugas</label>
                        <div class="input-group">
                            <input type="text" name="nama_tugas" id="nama_tugas" class="form-control" placeholder="Masukan Nama Tugas..">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_tugas">Keterangan Tugas</label>
                        <div class="input-group">
                            <textarea name="deskripsi_tugas" id="deskripsi_tugas" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="link_tugas" class="text-danger">Link*</label>
                        <div class="input-group">
                            <input type="text" name="link_tugas" id="link_tugas" class="form-control-lg form-control" placeholder="Link Tugas Google docs/drive">
                        </div>
                    </div>
                    <div class="small text-danger error">

                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <button class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.formTugas').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/tugas/addTugas",
            data: {
                nama_pelajaran: $('#nama_pelajaran').val(),
                nama_tugas: $('#nama_tugas').val(),
                deskripsi_tugas: $('#deskripsi_tugas').val(),
                link_tugas: $('#link_tugas').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    );
                    listDataTugas();
                    $('#modalAddTugas').modal('hide');
                }

                if (response.error) {
                    $('#nama_pelajaran').addClass('is-invalid');
                    $('#nama_tugas').addClass('is-invalid');
                    $('#deskripsi_tugas').addClass('is-invalid');
                    $('#link_tugas').addClass('is-invalid');

                    $('.error').html(response.error);
                }
            }
        });
    });
</script>