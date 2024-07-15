<?php
$uri = service('uri');
$totalSegments = $uri->getTotalSegments();

$segment1 = $uri->getSegment(1);
$segment2 = $totalSegments > 1 ? $uri->getSegment(2) : '';
$segment3 = $totalSegments > 2 ? $uri->getSegment(3) : '';
?>

<div class="card bg-primary-dark dashnum-card dashnum-card-small overflow-hidden text-white">
    <span class="round bg-primary small"></span>
    <span class="round bg-primary big"></span>
    <div class="card-body p-3 align-items-center">
        <div class="ms-2 d-flex">
            <h5 class="text-white mb-0">
                <?php
                echo $title;
                // if ($segment3) {
                //     echo ucfirst($segment3) . ' ' . ucfirst($segment2);
                // } else if ($segment2) {
                //     echo ucfirst($segment2);
                // } else {
                //     echo ucfirst($segment1);
                // }
                ?>
            </h5>

            <div class="vr ms-2 border opacity-50"></div>

            <!-- <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Dashboard</a></li>

                <?php if ($segment1 == 'data-master') : ?>

                <li class="breadcrumb-item active">Data Master</li>
                <?php if ($segment2) : ?>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/' . $segment1 . '/' . $segment2) ?>">
                        <?= ucfirst($segment2) ?></a>
                </li>
                <?php if ($segment3) : ?>
                <li class="breadcrumb-item active"><?= ucfirst($segment3) ?></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php else : ?>
                <li class="breadcrumb-item active"><?= ucfirst($segment1) ?></li>
                <?php endif; ?>

            </ul> -->
        </div>

    </div>
</div>

<!-- <div class="page-header mb-3">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">
                        <?php
                        if ($segment3) {
                            echo ucfirst($segment3) . ' ' . ucfirst($segment2);
                        } else if ($segment2) {
                            echo ucfirst($segment2);
                        } else {
                            echo ucfirst($segment1);
                        }
                        ?>
                    </h5>
                </div>

                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Dashboard</a></li>

                    <?php if ($segment1 == 'data-master') : ?>

                    <li class="breadcrumb-item active">Data Master</li>
                    <?php if ($segment2) : ?>
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('/' . $segment1 . '/' . $segment2) ?>">
                            <?= ucfirst($segment2) ?></a>
                    </li>
                    <?php if ($segment3) : ?>
                    <li class="breadcrumb-item active"><?= ucfirst($segment3) ?></li>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php else : ?>
                    <li class="breadcrumb-item active"><?= ucfirst($segment1) ?></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </div>
</div> -->