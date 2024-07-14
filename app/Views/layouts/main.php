<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Surveyor | <?= $title ?></title>

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= base_url('assets/images/favicon.svg') ?>" type="image/x-icon">

    <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link">

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/tabler-icons.min.css') ?>">

    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" id="main-style-link">
    <link rel="stylesheet" href="<?= base_url('assets/css/style-preset.css') ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .previewImage {
            width: auto;
            height: auto;
            max-height: 200px;
            max-width: 150px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- Cek Login True -->
    <?php if (!session()->get('isLoggedIn')) : ?>
        <div class="auth-main">
            <div class="auth-wrapper v3">
                <div class="auth-form">
                    <?= $this->renderSection('auth') ?>
                </div>
            </div>
        </div>

    <?php else : ?>

        <!-- [ Main Content ] start -->
        <?= $this->include('components/sidebar') ?>
        <?= $this->include('components/topbar') ?>


        <div class="pc-container">
            <div class="pc-content">
                <!-- [ Breadcrumb ] start -->
                <?php if (current_url() !== base_url()) {
                    echo $this->include('components/breadcrumb');
                }
                ?>
                <!-- [ Breadcrumb ] end -->

                <!-- [ Content ] start -->
                <?= $this->renderSection('content') ?>
                <!-- [ Content ] end -->
            </div>
        </div>

        <?= $this->include('components/footer') ?>
        <!-- [ Main Content ] end -->

    <?php endif ?>

    <script src="<?= base_url('assets/js/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/fonts/custom-font.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/pages/dashboard-default.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Swal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('script') ?>

    <script>
        layout_change('light');
    </script>

    <script>
        font_change("Roboto");
    </script>

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_caption_change('true');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change("preset-1");
    </script>
</body>

</html>