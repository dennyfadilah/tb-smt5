<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">

        <div class="m-header">
            <a href="<?= base_url('/') ?>" class="b-brand text-primary d-flex align-items-center mx-auto">
                <!-- ========   Change your logo from here   ============ -->
                <h2 class="my-0">Surveyor</h2>
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">

                <li class="pc-item pc-caption">
                    <label>Pages</label>
                    <i class="ti ti-dashboard"></i>
                </li>

                <li class="pc-item <?= service('uri')->getSegment(1) == '' ? 'active' : '' ?>">
                    <a href="<?= base_url('/') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-home"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item <?= service('uri')->getSegment(1) == 'transaksi' ? 'active' : '' ?>">
                    <a href="<?= base_url('/transaksi') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-send"></i></span>
                        <span class="pc-mtext">Transaction</span>
                    </a>
                </li>

                <li
                    class="pc-item pc-hasmenu <?= service('uri')->getSegment(1) == 'data-master' ? 'active pc-trigger' : '' ?>">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-files"></i></span>
                        <span class="pc-mtext">Data Master</span>
                        <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <?php
                        $uri = service('uri');
                        $segment2 = ($uri->getTotalSegments() >= 2) ? $uri->getSegment(2) : null;
                        ?>
                        <li class="pc-item <?= $segment2 == 'marketing' ? 'active' : '' ?>">
                            <a class="pc-link" href="<?= base_url('/data-master/marketing') ?>">Marketing</a>
                        </li>
                        <li class="pc-item <?= $segment2 == 'commodity' ? 'active' : '' ?>">
                            <a class="pc-link" href="<?= base_url('/data-master/commodity') ?>">Commodity</a>
                        </li>
                        <li class="pc-item <?= $segment2 == 'location' ? 'active' : '' ?>">
                            <a class="pc-link" href="<?= base_url('/data-master/location') ?>">Location</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->