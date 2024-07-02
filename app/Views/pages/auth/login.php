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

        <form action="" method="post" id="loginForm" novalidate>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                <label for="email">Email address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
                <label for="password">Password</label>
            </div>

            <div class="d-flex mt-1 justify-content-between">
                <div class="form-check">
                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                    <label class="form-check-label text-muted" for="customCheckc1">Remember me</label>
                </div>
                <h5 class="text-secondary">Forgot Password?</h5>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary" id="btnLogin">Login</button>
            </div>
        </form>

        <hr>

        <h5 class="d-flex gap-1 justify-content-center">
            Don't have an account?
            <a href="<?= site_url('auth/register') ?>">Register</a>
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
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    $btnLogin.text('Login');
                    $btnLogin.prop('disabled', false);

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.message,
                    })
                } else {
                    $btnLogin.text('Login');
                    $btnLogin.prop('disabled', false);
                    window.location.href = response.redirect;
                }
            }
        });
    });
});
</script>
<?= $this->endSection() ?>