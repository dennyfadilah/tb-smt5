<?= $this->extend('layouts/main') ?>

<?= $this->section('auth') ?>
<div class="card mt-5">
    <div class="card-body">
        <a href="#" class="d-flex justify-content-center mt-3">
            <img src="../assets/images/logo-dark.svg" alt="image" class="img-fluid brand-logo">
        </a>
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="auth-header">
                    <h2 class="text-secondary mt-3"><b>Register</b></h2>
                    <p class="f-16 mt-2">Enter your credentials to continue</p>
                </div>
            </div>
        </div>
        <h5 class="my-3 d-flex justify-content-center">Register with Email address</h5>

        <form action="" method="post" id="registerForm" novalidate>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" placeholder="Fullname" required>
                <label for="name">Fullname</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                <label for="email">Email Address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
                <label for="password">Password</label>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary p-2" id="btnRegister">Register</button>
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

    $('#name').change(function() {
        const name = $(this).val();
        if (name.length == 0) {
            $(this).addClass('is-invalid');
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Masukan nama lengkap.",
            })
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    $('#email').change(function() {
        const email = $(this).val();

        if (!validEmail(email)) {
            $(this).addClass('is-invalid');
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Email tidak valid.",
            })
        } else if (email.length == 0) {
            $(this).addClass('is-invalid');
            $(this);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Masukan email.",
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

    $('#btnRegister').click(function() {
        const name = $('#name').val();
        const email = $('#email').val();
        const password = $('#password').val();


        if (name == '' || email == '' || password == '') {
            if (name == '') {
                $('#name').addClass('is-invalid');

            } else if (email == '') {
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

    $('#registerForm').submit(function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const $btnRegister = $('#btnRegister');

        $btnRegister.text('On Progress...');
        $btnRegister.prop('disabled', true);

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
                    $btnRegister.text('Login');
                    $btnRegister.prop('disabled', false);

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.message,
                    })
                } else {
                    $btnRegister.text('Login');
                    $btnRegister.prop('disabled', false);
                    window.location.href = response.redirect;
                }
            }
        });
    });
});
</script>
<?= $this->endSection() ?>