
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
              <strong>  LUPA PASSWORD </strong>
            </div>
            <div class="panel-body">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Nama Lengkap <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_lengkap" />
            </div>
            
            <div class="form-group">
                <label>Username <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="username" />
            </div>
            <div class="form-group" style="color: black" align="left">
                <label>Password Lama <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass1" />
            </div>
            <div class="form-group">
                <label>Password Baru <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass2" />
            </div>
            <div class="form-group">
                <label>Konfirmasi Password Baru <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass3" />
            </div>
            <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger btn-sm" href="?m=login"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </form>
    </div>
</div>
</div></div>