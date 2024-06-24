<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
              <strong>  TAMBAH DATA PENJUALAN </strong>
            </div>
            <div class="panel-body">
<form method="post">
    
            <?php if ($_POST) include 'aksi.php' ?>
            <div class="form-group">
                <label>Kode Periode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_periode" value="<?= kode_oto('kode_periode', 'tb_periode', 'P', 2) ?>" />
            </div>
            <div class="form-group">
                <label>Tanggal Periode<span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal" value="<?= set_value('tanggal', date('Y-m-d')) ?>" />
            </div>
            <?php
            foreach ($JENIS as $key => $val) : ?>
                <div class="form-group">
                    <label><?= $val ?></label>
                    <input class="form-control" type="number" name="nilai[<?= $key ?>]" value="<?= $_POST['nilai'][$key] ?>" />
                </div>
            <?php endforeach ?>
        
    <div class="form-group">
        <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
        <a class="btn btn-danger btn-sm" href="?m=permintaan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
    </div>
</form>
</div></div></div></div>