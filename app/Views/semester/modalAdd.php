<!-- Modal -->
<div class="modal fade" id="modalAddSemester" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('/semester/addSemester', ['class' => 'formSemester']); ?>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <div class="input-group">
                        <input type="text" name="semester" id="semester" class="form-control" placeholder="Semester Berapa Sekarang?">
                        <div class="invalid-feedback errorSemester">

                        </div>
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
    $('.formSemester').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "/semester/addSemester",
            data: {
                semester: $('#semester').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    );
                    $('#modalAddSemester').modal('hide');
                    listDataSemester();
                }

                if (response.error) {
                    $('#semester').addClass('is-invalid');
                    $('.errorSemester').html(response.error);
                }

            }
        });

    });
</script>