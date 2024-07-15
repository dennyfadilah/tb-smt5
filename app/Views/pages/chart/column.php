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
                    <!-- <?php foreach ($list_lokasi as $lokasi):?>                                         
                      <?php foreach ($list_komoditas as $komoditas):?>                                               
                        <?php foreach ($list_specific as $specific):?>                           
                            <?php if($lokasi["lokasi"] == $specific["lokasi"] && $komoditas["komoditas"] == $specific["komoditas"]):?>
                              <?= $lokasi["lokasi"]?> | <?= $komoditas["komoditas"]?> | <?= intval($specific["jumlah"])?> <br>                          
                            <?php endif ?>
                          <?php endforeach?> 
                      <?php endforeach?>
                    <?php endforeach?> -->
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
        getColumnChart();

        // Event Listener
        $("#btn-chart-donut").on("click", getDonutChart);
    });

    function getColumnChart(){
        var options = {

          series:[
            <?php foreach ($list_komoditas as $komoditas): ?>
            { // IGNORE ERROR INI
              name: <?= json_encode($komoditas["komoditas"])?>,
              // komoditas
              data: [
                <?php foreach ($list_lokasi as $lokasi):?>
                  //Lokasi
                    <?php foreach ($list_specific as $specific):?>
                      //jumlah
                      <?php if($lokasi["lokasi"] == $specific["lokasi"] && $komoditas["komoditas"] == $specific["komoditas"]):?>
                        <?= intval($specific["jumlah"])?>,
                      <?php endif ?>
                    <?php endforeach?>
                <?php endforeach?>
              ]
            },
            <?php endforeach?>
          ],

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
          categories: [
            <?php foreach ($list_lokasi as $lokasi): ?>
              <?= json_encode($lokasi["lokasi"])?>,
            <?php endforeach ?>
          ],          
        },
        yaxis: {
          title: {
            text: 'Banyak Survey'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " kunjungan."
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        $("#btn-chart-column").prop("disabled", true);
    }

    function getDonutChart(){
        window.location.href = "<?= base_url("/donut")?>";
        $("#btn-chart-donut").prop("disabled", true);
        $("#btn-chart-donut").text("Loading...");
    }
</script>

<?= $this->endSection() ?>