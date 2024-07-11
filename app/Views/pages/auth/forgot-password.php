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
                    <h2 class="text-secondary mt-3"><b>Forgot Password</b></h2>
                </div>
            </div>
        </div>

        <h5 class="my-3 d-flex justify-content-center">Find your email</h5>

        <form action="<?= base_url('auth/send-code') ?>" method="post" id="forgotForm" novalidate>
            <?= csrf_field() ?>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                <label for="email">Email address</label>
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
        function validEmail(email) {
            var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
        }

        $('#email').change(function() {
            const email = $(this).val();

            if (!validEmail(email)) {
                $(this).addClass('is-invalid');
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Email tidak valid.",
                })
            } else {
                $(this).removeClass('is-invalid');
            }
        });



        $('#btnNext').click(function() {
            const email = $('#email').val();
            const password = $('#password').val();

            if (email == '') {
                $('#email').addClass('is-invalid');

                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Masukan email.",
                });
            }
        });

        $('#forgotForm').submit(function(e) {
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
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed || result.dismiss) {
                                window.location.href = response.redirect;
                            }
                        });
                    }
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>