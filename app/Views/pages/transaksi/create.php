<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <div class="card bg-primary-dark dashnum-card dashnum-card-small text-white overflow-hidden">
        <span class="round bg-primary small"></span>
        <span class="round bg-primary big"></span>
        <div class="card-body p-3 d-flex justify-content-between align-items-center">
            <div class="ms-2">
                <h2 class="text-white mb-0">Surveyor Marketing</h2>
                <p class="mb-0 opacity-50 text-sm">Lakukan Pengisian Survey</p>
            </div>
            <div class="col-auto">
                <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="<?= base_url('transaksi/export_excel') ?>" class="btn btn-success">Excel</a>
                        <a href="<?= base_url('transaksi/export_pdf') ?>" class="btn btn-danger">PDF</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="card dashnum-card dashnum-card-small overflow-hidden">
        <span class="round bg-warning small"></span>
        <span class="round bg-warning big"></span>
        <div class="card-body p-3">
            <div class="ms-2">
                <form action="<?= base_url('transaksi/create') ?>" method="post" id="transaksiCreate">
                    <div class="mb-3">
                        <label for="marketing_nama" class="form-label">Name</label>
                        <input type="text" class="form-control" id="marketing_nama" name="marketing_nama"
                            value="<?= session()->get('nama') ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="waktu" class="form-label">Date Time Survey</label>
                        <input type="date" class="form-control" id="waktu" name="waktu" value="<?= date('Y-m-d') ?>"
                            disabled>
                    </div>

                    <div class="mb-3">
                        <label for="komoditas_id" class="form-label">Commodity Name</label>
                        <select class="form-select" name="komoditas_id" id="komoditas_id" required>
                            <option value="" selected disabled>Pilih Komoditas</option>
                            <?php foreach ($komoditas as $komoditi) : ?>
                            <option value="<?= $komoditi['id'] ?>"><?= $komoditi['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_id" class="form-label">Location Name</label>
                        <select class="form-select" name="lokasi_id" id="lokasi_id" required>
                            <option value="" selected disabled>Pilih Lokasi</option>
                            <?php foreach ($lokasi as $lok) : ?>
                            <option value="<?= $lok['id'] ?>"><?= $lok['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="repeat_order" class="form-label">Repeat Orders</label>
                        <select class="form-select" name="repeat_order" id="repeat_order" required>
                            <option value="1">Iya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hasil_survey" class="form-label">Survey Results</label>
                        <textarea class="form-control" name="hasil_survey" id="hasil_survey" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
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

    $('#transaksiCreate').submit(function(e) {
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