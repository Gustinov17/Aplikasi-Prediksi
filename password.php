<div class="carousel-inner" role="listbox">
<div class="item active">
    <img src="assets/images/pt.jpg" alt="Image" width="100%" style="height:600px;">
    <div class="carousel-caption">
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
              <strong>  UBAH PASSWORD </strong>
            </div>
            <div class="panel-body">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group" style="color: black" align="left">
                <label>Password Lama <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass1" />
            </div>
            <div class="form-group" style="color: black" align="left">
                <label>Password Baru <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass2" />
            </div>
            <div class="form-group" style="color: black" align="left">
                <label>Konfirmasi Password Baru <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass3" />
            </div>
            <div class="form-group" align="left">
            <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
        </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>