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

        <form action="<?= base_url('auth/proses-register') ?>" method="post" id="registerForm" novalidate>
            <?= csrf_field() ?>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Fullname" required>
                <label for="nama">Fullname</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telp" required>
                <label for="no_telp">No. Telp</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                <label for="email">Email Address</label>
            </div>

            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <span class="input-group-text" id="toggleBtn"><i class="ti ti-eye-off" id="iconToggle"></i></span>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary p-2" id="btnRegister">Register</button>
            </div>
        </form>

        <hr>

        <h5 class="d-flex gap-1 justify-content-center">
            Already have an account?
            <a href="<?= site_url('auth/login') ?>" class="text-secondary">Login</a>
        </h5>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    jQuery(function($) {
        $('#nama').change(function() {
            const nama = $(this).val();
            if (nama.length == 0) {
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

        $('#no_telp').on('input', function() {
            let no_telp = $(this).val();
            no_telp = no_telp.replace(/[^0-9]/g, '');
            $(this).val(no_telp);
        });

        $('#no_telp').change(function() {
            const no_telp = $(this).val();
            if (no_telp.length == 0) {
                $(this).addClass('is-invalid');
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Masukan no. telp.",
                })
            } else {
                $(this).removeClass('is-invalid');
            }
        })

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

        function togglePassword() {
            const password = $('#password');
            const icon = $('.ti-eye-off');
            if (password.attr('type') == 'password') {
                password.attr('type', 'text');
                icon.removeClass('ti-eye-off');
                icon.addClass('ti-eye');
            } else {
                password.attr('type', 'password');
                icon.removeClass('ti-eye');
                icon.addClass('ti-eye-off');
            }
        }

        function validateField(selector, value) {
            if (value === '') {
                selector.addClass('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data tidak boleh kosong',
                });
            } else {
                selector.removeClass('is-invalid');
            }
        }

        $('#btnRegister').click(function() {
            const nama = $('#nama');
            const noTelp = $('#no_telp');
            const email = $('#email');
            const password = $('#password');

            validateField(nama, nama.val());
            validateField(noTelp, noTelp.val());
            validateField(email, email.val());
            validateField(password, password.val());
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
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $btnRegister.text('Register');
                    $btnRegister.prop('disabled', false);

                    if (response.error) {
                        console.log("response.message");
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
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