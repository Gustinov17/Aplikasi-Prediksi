<table>
  <tr>
    <br>
    <td width="136" rowspan="3" align="center"><img src="assets/images/logo.png" width="90%"></td>
    <td width="883" align="center">&nbsp;</td>
    <td width="26" rowspan="6">&nbsp;</td>
</tr>

<tr>
    <td align="left"><center>
        <span align="left" style="font-size:20px;"><strong>UD.MITRA ARTHA JAYA</strong></span><BR><b></b><br> 
        <hr></center>
    </td>
</tr>   
</table>
<div>
    <center><H2><U>Laporan Hasil Peramalan</H2></center>
</div>
<?php
$_POST = $_SESSION['post'];

$next_periode = $_POST['next_periode'];
$n_periode = $_POST['n_periode'];
$awal = $_POST['awal'];
$akhir = $_POST['akhir'];

$analisa = get_analisa($awal, $akhir);

foreach ($analisa as $key_jenis => $val_jenis) :

    $ma = new MovingAverage($val_jenis, $next_periode, $n_periode);
    //echo '<pre>' . print_r($ma, 1) . '</pre>';
    $categories = array();
    $series = array();
?>

<center>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Hasil Peramalan Permintaan <?= $JENIS[$key_jenis] ?></h3>
        </div>
        <div class="table-responsive collapse" id="c_<?= $key_jenis ?>">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Aktual</th>
                        <th>Peramalan</th>
                        <?php if ($_SESSION['level']=='admin') : ?>
                        <th>Error</th>
                        <th>MAD</th>
                        <th>MSE</th>
                        <th>MAPE</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <?php foreach ($val_jenis as $key => $val) :
                    $categories[$key] = $key;
                    $series['aktual']['data'][$key] = $val * 1;
                    $series['prediksi']['data'][$key] = round($ma->ft[$key], 2); ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= number_format($val) ?></td>
                        <td><?= number_format($ma->ft[$key], 2) ?></td>
                        <?php if ($_SESSION['level']=='admin') : ?>
                        <td><?= number_format($ma->et[$key], 2) ?></td>
                        <td><?= number_format($ma->et_abs[$key], 2) ?></td>
                        <td><?= number_format($ma->et_square[$key], 2) ?></td>
                        <td><?= number_format($ma->et_yt[$key], 2) ?></td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
                <?php if ($_SESSION['level']=='admin') : ?>
                <tr>
                    <td colspan="4" class="text-right">MAD (Mean Absolute Deviation )</td>
                    <td><?= number_format($ma->error['MAE'], 2) ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                
                <tr>
                    <td colspan="4" class="text-right">MSE (Mean Squared Error)</td>
                    <td>&nbsp;</td>
                    <td><?= number_format($ma->error['MSE'], 2) ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">MAPE (Mean Absolute Percentage Error)</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?= number_format($ma->error['MAPE'], 2) ?> % </td>
                </tr>
                <?php endif ?>
            </table>
        </div>
        <div class="panel-body">
         <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/exporting.js"></script>
    <script src="assets/js/export-data.js"></script>
    <script src="assets/js/accessibility.js"></script>
    <style>
        .highcharts-credits {
            display: none;
        }
    </style>
            Hasil Prediksi:
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Karton</th>
                    </tr>
                </thead>
                <?php foreach ($ma->next_ft as $key => $val) :
                    $categories[$key] = $key;
                    $series['aktual']['data'][$key] = null;
                    $series['prediksi']['data'][$key] = round($val, 2); ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= number_format($val,2) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
        <!--
        <div class="panel-body">
            <script src="assets/js/highcharts.js"></script>
            <script src="assets/js/modules/exporting.js"></script>
            <script src="assets/js/modules/export-data.js"></script>
            <script src="assets/js/modules/accessibility.js"></script>
            <div id="container_<?= $key_jenis ?>"></div>
            <script>
                <?php
                $categories = array_values($categories);
                $series['aktual']['name'] = 'Aktual';
                $series['prediksi']['name'] = 'Prediksi';
                $series['aktual']['data'] = array_values($series['aktual']['data']);
                $series['prediksi']['data'] = array_values($series['prediksi']['data']);
                $series = array_values($series);
                ?>
                Highcharts.chart('container_<?= $key_jenis ?>', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Data dan Hasil Prediksi ' + '<?= $JENIS[$key_jenis] ?>'
                    },
                    // subtitle: {
                    //     text: 'Source: WorldClimate.com'
                    // },
                    xAxis: {
                        categories: <?= json_encode($categories) ?>
                    },
                    yAxis: {
                        title: {
                            text: 'Total'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: <?= json_encode($series) ?>
                });
            </script>
        </div> -->
    </div>
<?php endforeach ?>

<br>
<br>

<div align="right">
    <td> <br> Diketahui Direktur
    <br><br><br><br><br>
    <br>(Tedy Rasyidin,S.T )</td>  
    </div>  
