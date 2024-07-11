<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- EMPTY -->
        </div>
        <div class="col-md-6">
            <div id="chart" >
            </div>
        </div>
        
        <div class="col-md-3">
            <!-- BUTTON HERE -->
             <div class="container">

                <div class="row">
                    <button class="btn btn-info" id="btn-chart-donut">
                        Chart Pie
                    </button>
                </div>
                <div class="row">
                    <!-- Kebutuhan Debugging -->
                    <p>
                        
                    </p>
                </div>
                <div class="row">
                    <button class="btn btn-info" id="btn-chart-column">
                        Chart Column
                    </button>
                </div>
             </div>
        </div>
    </div>
    <br>    
</div>

<!-- Apex Chart -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

    $(document).ready(function(){
        getDonutChart();

        // Event Listener
        $("#btn-chart-column").on("click", getColumnChart);
    });

    function getDonutChart(){
        //Lokasi yang sering disurvey
        var options = {
        // series: [
        //     5, 4, 3,
        // ], //Bayak Survey
        // labels: [
        //     "Jakarta", "Bogor", "Depok",
        // ], //Lokasi

        series: [
            <?php foreach  ($list_lokasi as $lokasi):?>
                <?= intval($lokasi["kunjungan"])?>, //KOK GAK PERLU JSON_ENCODE ??!!
            <?php endforeach ?>
        ],
        labels: [
            <?php foreach  ($list_lokasi as $lokasi):?>
                <?= json_encode($lokasi["lokasi"])?>,
            <?php endforeach ?>
        ],
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

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        $("#btn-chart-donut").prop("disabled", true);
    }

    function getColumnChart(){
        window.location.href = "<?= base_url("/column")?>";
        $("#btn-chart-column").prop("disabled", true);
        $("#btn-chart-column").text("Loading...");
    }


    
</script>

<?= $this->endSection() ?>