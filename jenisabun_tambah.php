
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success">
    <div class="panel-heading" align="center">
        <strong>TAMBAH DATA PRODUK </strong>
    </div>
    <div class="panel-body">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group" style="color: black" align="left">
                <label>Kode Produk<span class="text-danger">*</span></label>
                <input class="form-control input-sm" type="text" name="kode" value="<?= kode_oto('kode_jenis', 'tb_jenis_sabun', 'J', 2) ?>" readonly />
            </div>
            <div class="form-group" style="color: black" align="left">
                <label>Nama Produk <span class="text-danger">*</span></label>
                <input class="form-control input-sm" type="text" name="nama" value="<?= $_POST['nama'] ?>" />
            </div>
            <div class="form-group" align="left">
                <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger btn-sm" href="?m=jenisabun"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            
            </div>
        </form>
    </div>
</div>
</div>
</div>