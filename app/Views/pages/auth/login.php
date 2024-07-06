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
                    <h2 class="text-secondary mt-3"><b>Hi, Welcome Back</b></h2>
                    <p class="f-16 mt-2">Enter your credentials to continue</p>
                </div>
            </div>
        </div>

        <h5 class="my-3 d-flex justify-content-center">Login with Email address</h5>

        <form action="<?= base_url('auth/proses-login') ?>" method="post" id="loginForm" novalidate>
            <?= csrf_field() ?>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                <label for="email">Email address</label>
            </div>

            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                    <label for="password">Password</label>
                </div>
                <span class="input-group-text" id="toggleBtn"><i class="ti ti-eye-off" id="iconToggle"></i></span>
            </div>

            <div class="mt-1 text-end">
                <a href="<?= site_url('auth/forgot-password') ?>" class="h5 text-secondary">Forgot Password?</a>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-secondary" id="btnLogin">Login</button>
            </div>
        </form>

        <hr>

        <h5 class="d-flex gap-1 justify-content-center">
            Don't have an account?
            <a href="<?= site_url('auth/register') ?>" class="text-secondary">Register</a>
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

    $('#toggleBtn').click(function() {
        const password = $('#password');
        const icon = $('#iconToggle');
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

    $('#btnLogin').click(function() {
        const email = $('#email').val();
        const password = $('#password').val();

        if (email == '' || password == '') {
            if (email == '') {
                $('#email').addClass('is-invalid');
            } else if (password == '') {
                $('#password').addClass('is-invalid');
            }
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Data tidak boleh kosong.",
            });
        }
    });

    $('#loginForm').submit(function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const $btnLogin = $('#btnLogin');

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
                $btnLogin.text('Login');
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