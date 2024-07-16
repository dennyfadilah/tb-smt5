<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-xl-6 col-md-12">
        <div class="card dashnum-card dashnum-card-small overflow-hidden">
            <span class="round bg-warning small"></span>
            <span class="round bg-warning big"></span>
            <div class="card-header py-2">
                <h2 class="my-0">Survey Location</h2>
                <p class="my-0 text-muted">
                    <small>Lokasi yang sering di survey selama bulan
                        ini.</small>
                </p>
            </div>
            <div class="card-body">
                <div id="donutchart"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-12">
        <div class="card dashnum-card dashnum-card-small overflow-hidden">
            <span class="round bg-warning small"></span>
            <span class="round bg-warning big"></span>
            <div class="card-header py-2">
                <h2 class="my-0">Survey Commodity</h2>
                <p class="my-0 text-muted">
                    <small>Barang yang sering di survey setiap lokasi
                        selama 6 bulan terakhir.</small>
                </p>
            </div>
            <div class="card-body">
                <div id="columnchart"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(function() {
    getDonutChart();
    getColumnChart();

    //Lokasi yang sering disurvey
    function getDonutChart() {
        var series = JSON.parse('<?= $seriesDonut ?>');
        var labels = JSON.parse('<?= $labels ?>');

        var options = {
            series: series,
            labels: labels,
            chart: {
                type: 'donut',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#donutchart"), options);
        chart.render();
    }

    // Barang yang sering di survey setiap lokasi selama 6 bulan terakhir
    function getColumnChart() {
        var series = JSON.parse('<?= $seriesColumn ?>');
        var categories = JSON.parse('<?= $categories ?>');

        var options = {
            series: series,

            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: categories,
            },
            yaxis: {
                title: {
                    text: 'Survey'
                }
            },
            fill: {
                opacity: 1
            },

        };

        var chart = new ApexCharts(document.querySelector("#columnchart"), options);
        chart.render();
    }
});
</script>

<?= $this->endSection() ?>