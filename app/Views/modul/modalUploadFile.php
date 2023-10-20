<!-- Modal -->
<div class="modal fade" id="modalUploadFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File Modul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('/modul/uploadFile', ['class' => 'formUploadFile']) ?>
            <?= csrf_field(); ?>
            <div class="container">


                <div class="modal-body">

                    <div class="row">
                        <div class="col-md">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload Modul</span>
                                </div>
                                <input type="hidden" value="<?= $idmodul; ?>" id="idModul" name="idModul">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileModul" name="fileModul">
                                    <label class="custom-file-label" for="">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="error small" id="errorSampul" style="color: red;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnSampul">Save changes</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>


<script>
    $('.formUploadFile').submit(function(e) {
        e.preventDefault();
        let form = $('.formUploadFile')[0];
        let data = new FormData(form);

        $.ajax({
            type: "post",
            url: "/modul/uploadFile",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $('#fileModul').addClass('is-invalid');
                    $('.error').html(response.error);
                    $('#errorSampul').html(e.errorSampul);
                }

                if (response.success) {
                    $('#modalUploadFile').modal('hide');
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    )
                    listDataModul();
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });


    });
</script>