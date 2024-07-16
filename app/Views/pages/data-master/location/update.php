<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card dashnum-card dashnum-card-small overflow-hidden">
        <span class="round bg-warning small"></span>
        <span class="round bg-warning big"></span>

        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Update Location</h2>
                </div>

            </div>
        </div>

        <!-- table input data -->
        <div class="card-body">
            <form action="<?= base_url('data-master/location/update/' . $lokasi['id']) ?>" method="post"
                id="locationUpdate">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="nama">Name</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $lokasi['nama'] ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="kode_zip">ZIP Code</label>
                            <input type="number" name="kode_zip" id="kode_zip" class="form-control"
                                value="<?= $lokasi['kode_zip'] ?>" required>
                        </div>
                    </div>
                </div><br>

                <div class="form-group text-center mb-3">
                    <button type="submit" class="btn btn-primary w-25" id="btnSubmit">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(function($) {
    $('#btnSubmit').click(function() {
        const nama = $('#nama');
        const kode_zip = $('#kode_zip');

        if (nama.val() == '') {
            nama.addClass('is-invalid');
        } else {
            nama.removeClass('is-invalid');
        }

        if (kode_zip.val() == '') {
            kode_zip.addClass('is-invalid');
        } else {
            kode_zip.removeClass('is-invalid');
        }

        if (nama.val() == '' || kode_zip.val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Mohon lengkapi semua kolom",
            });
        }
    });

    $('#locationUpdate').submit(function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const $btnLogin = $('#btnSubmit');

        $btnLogin.text('On Progress...');
        $btnLogin.prop('disabled', true);

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $btnLogin.text('Submit');
                $btnLogin.prop('disabled', false);

                if (response.error) {

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                    }).then(function() {
                        window.location.href = response.redirect;
                    });
                }
            }
        });
    });
});
</script>
<?= $this->endSection() ?>