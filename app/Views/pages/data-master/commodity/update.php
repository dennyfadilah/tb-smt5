<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card dashnum-card dashnum-card-small overflow-hidden">
        <span class="round bg-warning small"></span>
        <span class="round bg-warning big"></span>

        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Update Commodity</h2>
                </div>

            </div>
        </div>

        <!-- table input data -->
        <div class="card-body">
            <form action="<?= base_url('data-master/commodity/update/' . $comodity['id']) ?>" method="post"
                id="commodityUpdate">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="nama">Name</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="<?= $comodity['nama'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="harga">Price</label>
                            <input type="number" name="harga" id="harga" class="form-control"
                                value="<?= $comodity['harga'] ?>" required>
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
        const harga = $('#harga');

        if (nama.val() == '') {
            nama.addClass('is-invalid');
        } else {
            nama.removeClass('is-invalid');
        }

        if (harga.val() == '') {
            harga.addClass('is-invalid');
        } else {
            harga.removeClass('is-invalid');
        }

        if (nama.val() == '' || harga.val() == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Mohon lengkapi semua kolom",
            });
        }
    });

    $('#commodityUpdate').submit(function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const $btnSubmit = $('#btnSubmit');

        $btnSubmit.text('On Progress...');
        $btnSubmit.prop('disabled', true);

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $btnSubmit.text('Submit');
                $btnSubmit.prop('disabled', false);

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