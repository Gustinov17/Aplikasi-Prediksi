<div class="carousel-inner" role="listbox">
<div class="item active">
    <img src="assets/images/pt.jpg" alt="Image" width="100%" style="height:600px;">
    <div class="carousel-caption">
    <div class="container-height">
    <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-success">
    <div class="panel-heading text-center">
      LOGIN SISTEM PERAMALAN PRODUK
    </div>
    <div class="panel-body">
    <?php if ($_POST) include 'aksi.php' ?>
        
      <form method="post">  
      <div class="form-group" align="left">
        <label for="inputEmail" style="color: black">Username</label>
        <input class="form-control" type="text" placeholder="Username" name="Username" focus />
            </div>
        <div class="form-group" align="left">
        <label for="inputPassword" style="color: black">Password</label>
        <input class="form-control" type="password" placeholder="Password" name="Password" />
            </div>     
         <div class="form-group" align="right">
                <a href="?m=password_lupa"><span class="glyphicon glyphicon-lock"></span> Lupa Password</a>
            </div>
            <div class="form-group" align="left">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Login</button>
            </div>        
      </form>      
      </div>
  </div>
  </div>
  </div>
  </div>     
  </div>
</div>


    