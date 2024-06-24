<?php
$row = $db->get_row("SELECT * FROM tb_jenis_sabun WHERE kode_jenis='$_GET[ID]'");
?>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
               <strong> EDIT DATA PRODUK </strong>
            </div>
            <div class="panel-body">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kode Jenis <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" readonly="readonly" value="<?= $row->kode_jenis ?>" />
            </div>
            <div class="form-group">
                <label>Nama Jenis <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?= $row->nama_jenis ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger btn-sm" href="?m=jenisabun"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div></div></div>