<?= $this->extend('layouts/main') ?>

<?= $this->section('auth') ?>
<div class="card my-5">
    <div class="card-body">
        <a href="#" class="d-flex justify-content-center">
            <img src="../assets/images/logo-dark.svg" alt="image" class="img-fluid brand-logo">
        </a>
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="auth-header">
                    <h2 class="text-secondary mt-3"><b>Enter Code</b></h2>
                </div>
            </div>
        </div>

        <p class="my-3 text-center">We've sent a code to <strong><?= $email ?></strong>. Please enter
            it to proceed.
        </p>

        <form action="<?= base_url('auth/verify-code') ?>" method="post" id="enterCodeForm" novalidate>
            <?= csrf_field() ?>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="code" name="code" placeholder="Enter your code" min="0"
                    minlength="6" maxlength="6" required>
                <label for="code">Enter your code</label>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary" id="btnNext">Next</button>
            </div>
        </form>

        <hr>

        <h5 class="d-flex gap-1 justify-content-center">
            Already have an account?
            <a href="<?= site_url('auth/login') ?>">Login</a>
        </h5>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
jQuery(function($) {
    $('#code').change(function() {
        const code = $('#code').val();
        if (code.length == 0) {
            $(this).addClass('is-invalid');
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Masukan kode.",
            })
        } else {
            $(this).removeClass('is-invalid');
        }
    })



    $('#btnNext').click(function() {
        const code = $('#code').val();

        if (code == '') {
            $('#code').addClass('is-invalid');

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Masukan kode.",
            });
        }
    });

    $('#enterCodeForm').submit(function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const $btnLogin = $('#btnNext');

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
                $btnLogin.text('Next');
                $btnLogin.prop('disabled', false);

                if (response.error) {

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.message,
                    });
                } else {
                    window.location.href = response.redirect;
                }
            }
        });
    });
});
</script>
<?= $this->endSection() ?>