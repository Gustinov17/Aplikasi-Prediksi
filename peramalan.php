
<?php
$awal = $db->get_var("SELECT MIN(tanggal) FROM tb_periode");
$akhir = $db->get_var("SELECT MAX(tanggal) FROM tb_periode");

$success = false;
if ($_POST) {
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
    $next_periode = $_POST['next_periode'];
    $n_periode = $_POST['n_periode'];
    $count = $db->get_var("SELECT COUNT(*) FROM tb_periode");

    if ($n_periode < 2 || $n_periode > $count) {
        print_msg("Isikan periode moving antara 2 dan $count");
    } elseif ($next_periode < 1) {
        print_msg('Masukkan periode peramalan minimal 1');
    } else {
        $success = true;
    }
}
?>
<form method="post">
    <div class="panel panel-success">
        <div class="panel-heading" align="center">
            <strong style="margin-top:30px;">PERHITUNGAN SIMPLE MOVING AVERAGE</strong>
        </div>
        <div class="panel-body">
            <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Periode Sebelumnya<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="n_periode" value="<?= set_value('n_periode', 3) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Jumlah Periode Diramal<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="next_periode" value="<?= set_value('next_periode', 1) ?>" />
                    </div>
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-signal"></span> Hitung</button> 

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pilih Bulan Awal <span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="awal" value="<?= set_value('awal', $awal) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Pilih Bulan Akhir <span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="akhir" value="<?= set_value('akhir', $akhir) ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
$c = $db->get_results("SELECT * FROM tb_permintaan_sabun WHERE nilai < 0");
if (!$PERIODE || !$JENIS) :
    echo "Tampaknya anda belum mengatur periode dan jenis. Silahkan tambahkan minimal 3 periode dan 3 jenis.";
elseif ($c) :
    echo "Tampaknya anda belum mengatur nilai periode. Silahkan atur pada menu <strong>Nilai Periode</strong>.";
elseif ($success) :
    include 'peramalan_hasil.php';
    $_SESSION['post'] = $_POST;
endif ?>
