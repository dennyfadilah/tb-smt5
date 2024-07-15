<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-xl-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="donutchart"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-12">
        <div class="card">
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
        var options = {
            series: [44, 55, 41, 17, 15],
            labels: ["Jan", "Feb", "Mar", "Apr", "May"],
            chart: {
                type: 'donut',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
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
        var options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'Revenue',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
                name: 'Free Cash Flow',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
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
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#columnchart"), options);
        chart.render();
    }
});
</script>

<?= $this->endSection() ?>