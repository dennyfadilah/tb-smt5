<?php
$uri = service('uri');
$totalSegments = $uri->getTotalSegments();

$segment1 = $uri->getSegment(1);
$segment2 = $totalSegments > 1 ? $uri->getSegment(2) : '';
$segment3 = $totalSegments > 2 ? $uri->getSegment(3) : '';

?>

<style>
.breadcrumb-item+.breadcrumb-item::before {
    color: var(--bs-white);
}

.breadcrumb-item a {
    color: var(--bs-white);
}

.breadcrumb-item a:hover {
    color: var(--bs-white);
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: var(--bs-warning);
    font-weight: bold;
}
</style>

<div class="card bg-primary-dark dashnum-card dashnum-card-small overflow-hidden text-white">
    <span class="round bg-primary small"></span>
    <span class="round bg-primary big"></span>
    <div class="card-body p-3 ">
        <div class="ms-2 d-flex align-items-center">
            <h4 class="text-white my-0"><?= $title ?></h4>

            <div class="vr mx-2 border opacity-50"></div>

            <div class="d-flex align-items-center">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb my-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                        <?php if ($segment1 == 'data-master') : ?>
                        <?php if ($segment3) : ?>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('/' . $segment1 . '/' . $segment2) ?>"><?= ucfirst($segment2) ?></a>
                        </li>
                        <?php endif; ?>

                        <?php else : ?>
                        <?php if ($segment2 == 'create' || $segment2 == 'update' || $segment2 == 'detail') :  ?>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('/' . $segment1) ?>">Transaction</a>
                        </li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>