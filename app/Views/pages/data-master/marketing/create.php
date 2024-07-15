<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card dashnum-card dashnum-card-small overflow-hidden">
        <span class="round bg-warning small"></span>
        <span class="round bg-warning big"></span>

        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Create Marketing</h2>
                </div>
            </div>
        </div>

        <!-- table input data -->
        <div class="card-body">
            <form action="<?= base_url('data-master/marketing/create') ?>" method="post" id="marketingCreate">
                <div class="row mb-3">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama">Name</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="no_telp">No. Handphone</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control" min="0" max="14" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <span class="input-group-text" id="toggleBtn"><i class="ti ti-eye-off" id="iconToggle"></i></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group text-center mb-3">
                    <button type="submit" class="btn btn-primary col-md-3 col-12" id="btnSubmit">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(function() {
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

        $('#btnSubmit').click(function() {
            const nama = $('#nama');
            const noTelp = $('#no_telp');
            const email = $('#email');
            const password = $('#password');

            validateField(nama, nama.val());
            validateField(noTelp, noTelp.val());
            validateField(email, email.val());
            validateField(password, password.val());
        });

        $('#marketingCreate').submit(function(e) {
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