<?php
$row = $db->get_row("SELECT * FROM tb_periode WHERE kode_periode='$_GET[ID]'");
?>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
               <strong> EDIT DATA PENJUALAN </strong>
            </div>
            <div class="panel-body">
<form method="post">
            <?php if ($_POST) include 'aksi.php' ?>
            <div class="form-group">
                <label>Kode Periode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_periode" value="<?= $row->kode_periode ?>" readonly />
            </div>
            <div class="form-group">
                <label>Nama Periode <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal" value="<?= set_value('tanggal', $row->tanggal) ?>" />
            </div>
            <?php
            $rows = $db->get_results("SELECT * FROM tb_permintaan_sabun r 
                INNER JOIN tb_jenis_sabun k ON k.kode_jenis=r.kode_jenis
            WHERE kode_periode='$row->kode_periode' ORDER BY r.kode_jenis");
            foreach ($rows as $row) : ?>
                <div class="form-group">
                    <label><?= $row->nama_jenis ?></label>
                    <input type="number" class="form-control" name="nilai[<?= $row->ID ?>]" value="<?= $row->nilai ?>" />
                </div>
            <?php endforeach ?>
        
    <div class="form-group">
        <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
        <a class="btn btn-danger btn-sm" href="?m=permintaan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
    </div>
</form>
</div></div></div></div>