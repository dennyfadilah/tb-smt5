<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <div class="card dashnum-card dashnum-card-small overflow-hidden">
        <span class="round bg-warning small"></span>
        <span class="round bg-warning big"></span>

        <div class="card-header py-3">
            <div class="d-flex align-items-center">
                <h2 class="mb-0">Update Transaction Page</h2>
            </div>
        </div>

        <div class="card-body p-3">
            <div class="ms-2">
                <form action="<?= base_url('transaksi/update/' . $surveyor['id']) ?>" method="post"
                    id="transaksiUpdate">
                    <div class="form-group mb-3">
                        <label for="marketing_nama" class="form-label">Name</label>
                        <input type="text" class="form-control" id="marketing_nama" name="marketing_nama"
                            value="<?= $surveyor['marketing_nama'] ?>" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="waktu" class="form-label">Date Time Survey</label>
                        <input type="date" class="form-control" id="waktu" name="waktu"
                            value="<?= $surveyor['waktu'] ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="komoditas_id" class="form-label">Commodity Name</label>
                        <select class="form-select" name="komoditas_id" id="komoditas_id" required>
                            <option value="" selected disabled>Pilih Komoditas</option>
                            <?php foreach ($komoditas as $komoditi) : ?>
                            <option value="<?= $komoditi['id'] ?>"
                                <?= $surveyor['komoditas_id'] == $komoditi['id'] ? ' selected' : '' ?>>
                                <?= $komoditi['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="lokasi_id" class="form-label">Location Name</label>
                        <select class="form-select" name="lokasi_id" id="lokasi_id" required>
                            <option value="" selected disabled>Pilih Lokasi</option>
                            <?php foreach ($lokasi as $lok) : ?>
                            <option value="<?= $lok['id'] ?>"
                                <?= $surveyor['lokasi_id'] == $lok['id'] ? ' selected' : '' ?>><?= $lok['nama'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="repeat_order" class="form-label">Repeat Orders</label>
                        <select class="form-select" name="repeat_order" id="repeat_order" required>
                            <option value="1" <?= $surveyor['repeat_order'] == 1 ? ' selected' : '' ?>>Iya</option>
                            <option value="0" <?= $surveyor['repeat_order'] == 0 ? ' selected' : '' ?>>Tidak</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="hasil_survey" class="form-label">Survey Results</label>
                        <textarea class="form-control" name="hasil_survey" id="hasil_survey"
                            rows="3"><?= $surveyor['hasil_survey'] ?></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary col-md-3 col-12" id="btnSubmit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(function($) {
    // $('#btnSubmit').click(function() {
    //     const nama = $('#nama');
    //     const kode_zip = $('#kode_zip');

    //     if (nama.val() == '') {
    //         nama.addClass('is-invalid');
    //     } else {
    //         nama.removeClass('is-invalid');
    //     }

    //     if (kode_zip.val() == '') {
    //         kode_zip.addClass('is-invalid');
    //     } else {
    //         kode_zip.removeClass('is-invalid');
    //     }

    //     if (nama.val() == '' || kode_zip.val() == '') {
    //         Swal.fire({
    //             icon: "error",
    //             title: "Oops...",
    //             text: "Mohon lengkapi semua kolom",
    //         });
    //     }
    // });

    $('#transaksiUpdate').submit(function(e) {
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

                    $.each(response.errors, function(key, value) {
                        const $inputElement = $('[name="' + key + '"]');
                        $inputElement.addClass('is-invalid');
                        $inputElement.next('.invalid-feedback').text(value);
                    });

                    // Menampilkan pesan kesalahan menggunakan SweetAlert
                    function formatErrorMessages(errors) {
                        let errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += `${value}. `;
                        });
                        return errorMessage;
                    }

                    let errorMessage = "Terjadi kesalahan!";
                    if (typeof response.message === 'string') {
                        errorMessage = response.message;
                    } else if (typeof response.message === 'object') {
                        errorMessage = formatErrorMessages(response.message);
                    }

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: errorMessage,
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