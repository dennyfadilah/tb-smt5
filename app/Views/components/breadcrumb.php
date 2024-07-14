<div class="page-header mb-3">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <?php

                // Memanggil Segment Uri
                $uri = service('uri');
                $segment1 = $uri->getSegment(1);
                $segment2 = $uri->getSegment(2);
                $segment3 = $uri->getSegment(3);
                ?>

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
                        <?php if ($segment3) : ?>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('/' . $segment1 . '/' . $segment2) ?>">
                                    <?= ucfirst($segment2) ?></a>
                            </li>
                            <li class="breadcrumb-item active"><?= ucfirst($segment3) ?></li>
                        <?php else : ?>
                            <li class="breadcrumb-item active"><?= ucfirst($segment2) ?></li>
                        <?php endif; ?>
                    <?php else : ?>
                        <li class="breadcrumb-item active"><?= ucfirst($segment1) ?></li>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </div>
</div>