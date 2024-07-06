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
                    <h2 class="text-secondary mt-3"><b>Reset Password</b></h2>
                </div>
            </div>
        </div>

        <h5 class="my-3 d-flex justify-content-center">Enter your new password</h5>

        <form action="<?= base_url('auth/confirm-password') ?>" method="post" id="resetPasswordForm" novalidate>
            <?= csrf_field() ?>

            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                    <label for="password">Password</label>
                </div>
                <span class="input-group-text" id="toggleBtn1"><i class="ti ti-eye-off" id="iconToggle1"></i></span>
            </div>

            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                        placeholder="confirmPassword" required>
                    <label for="confirmPassword">Confirm Password</label>
                </div>
                <span class="input-group-text" id="toggleBtn2"><i class="ti ti-eye-off" id="iconToggle2"></i></span>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary" id="btnReset">Reset Password</button>
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
    $('#password').keyup(function() {
        const password = $(this).val();
        if (password.length == 0) {
            $(this).addClass('is-invalid');
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Masukan password.",
            })
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    $('#confirmPassword').keyup(function() {
        const password = $(this).val();
        if (password.length == 0) {
            $(this).addClass('is-invalid');
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Masukan konfirmasi password.",
            })
        } else {
            $(this).removeClass('is-invalid');
        }
    });



    $('#toggleBtn1').click(function() {
        const password = $('#password');
        const icon = $('#iconToggle1');
        if (password.attr('type') == 'password') {
            password.attr('type', 'text');
            icon.removeClass('ti-eye-off');
            icon.addClass('ti-eye');
        } else {
            password.attr('type', 'password');
            icon.removeClass('ti-eye');
            icon.addClass('ti-eye-off');
        }
    });

    $('#toggleBtn2').click(function() {
        const confirmPassword = $('#confirmPassword');
        const icon = $('#iconToggle2');
        if (confirmPassword.attr('type') == 'password') {
            confirmPassword.attr('type', 'text');
            icon.removeClass('ti-eye-off');
            icon.addClass('ti-eye');
        } else {
            confirmPassword.attr('type', 'password');
            icon.removeClass('ti-eye');
            icon.addClass('ti-eye-off');
        }
    });

    $('#btnReset').click(function() {
        const password = $('#password').val();
        const confirmPassword = $('#confirmPassword').val();

        if (password == '') {
            $('#password').addClass('is-invalid');
        }

        if (confirmPassword == '') {
            $('#confirmPassword').addClass('is-invalid');
        }
    });

    $('#resetPasswordForm').submit(function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const $btnLogin = $('#btnReset');

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
                    function formatErrorMessages(errors) {
                        let errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += `${value}.\n`;
                        });
                        return errorMessage;
                    }

                    let errorMessage = "Terjadi kesalahan!";

                    if (typeof response.message === 'string') {
                        errorMessage = response.message;
                    } else if (typeof response.message === 'object') {
                        errorMessage = formatErrorMessages(response.message);
                    }

                    if (response.field) {
                        $('#password').addClass('is-invalid');
                        $('#confirmPassword').addClass('is-invalid');
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