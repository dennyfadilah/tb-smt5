<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= base_url('assets/images/favicon.svg') ?>" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/tabler-icons.min.css') ?>">

    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" id="main-style-link">
    <link rel="stylesheet" href="<?= base_url('assets/css/style-preset.css') ?>">

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

<body>


    <?= $this->include('components/topbar') ?>
    <?= $this->include('components/sidebar') ?>

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ Breadcrumb ] start -->
            <?= $this->include('components/breadcrumb') ?>
            <!-- [ Breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <?= $this->renderSection('content') ?>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <?= $this->include('components/footer') ?>


    <script src="<?= base_url('assets/js/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/fonts/custom-font.js') ?>"></script>
    <script src="<?= base_url('assets/js/pcoded.js') ?>"></script>

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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            // Menampilkan toast untuk pesan sukses
            if (document.getElementById('toastSuccess')) {
                let toastSuccess = new bootstrap.Toast(document.getElementById('toastSuccess'));
                toastSuccess.show();
            }

            // Menampilkan toast untuk pesan error
            if (document.getElementById('toastError')) {
                let toastError = new bootstrap.Toast(document.getElementById('toastError'));
                toastError.show();
            }
        }, 100);
    });
    </script>

    <script>
    let successAlert = document.getElementById('success-alert');
    let dangerAlert = document.getElementById('danger-alert');

    function hideAlert(alert) {
        alert.style.display = 'none';
    }

    if (successAlert) {
        setTimeout(function() {
            hideAlert(successAlert);
        }, 3000);
    }

    if (dangerAlert) {
        setTimeout(function() {
            hideAlert(dangerAlert);
        }, 3000);
    }
    </script>

    <!-- [Page Specific JS] start -->
    <script src="<?= base_url('assets/js/pages/dashboard-default.js') ?>"></script>
    <!-- [Page Specific JS] end -->
</body>

</html>