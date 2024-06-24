<?php
include 'functions.php';
//if(empty($_SESSION[login]))
//header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="assets/images/logo.png" />

  <title>UD.MITRA ARTHA JAYA</title>
  <link href="assets/css/cosmo-bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/general.css" rel="stylesheet" />
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- <datatables> -->
  <link href="assets/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/> 
  <link rel="stylesheet" type="text/css" href="assets/datatables/css/responsive.bootstrap.min.css">
  <!-- End Datatables -->
</head>

<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="margin-top">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="hidden-xs">
          <a class="navbar-brand bg-success"><span><img src="assets/images/logo.png" style="align-items: center;" width="45px;" style="margin-top:11px;"> SISTEM PERAMALAN PRODUK</span></a> 

        </div>
        
      </div>
      <div id="navbar" class="navbar-collapse bg-success">
        <ul class="nav navbar-nav navbar-right bg-success">
          <?php if ($_SESSION['login']) : ?>
            <?php if($_SESSION['level']=='admin'):?>
            <li><a href="?m"><span class="glyphicon glyphicon-home" style="margin-top: 12px;"></span> Home</a></li>
            <li><a href="?m=jenisabun"><span class="glyphicon glyphicon-th-large" style="margin-top: 12px;"></span> Produk</a></li>
            <li><a href="?m=permintaan"><span class="glyphicon glyphicon-calendar" style="margin-top: 12px;"></span> Penjualan</a></li>
            <li><a href="?m=peramalan"><span class="glyphicon glyphicon-stats" style="margin-top: 12px;"></span> Peramalan</a></li>
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock" style="margin-top: 12px;"></span> Password</a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out" style="margin-top: 12px;"></span> Logout</a></li>
          <?php endif?>

          <?php if($_SESSION['level']=='pimpinan'):?>
          <li><a href="?"><span class="glyphicon glyphicon-home" style="margin-top: 12px;"></span> Home</a></li>
            <li><a href="?m=peramalan"><span class="glyphicon glyphicon-stats" style="margin-top: 12px;"></span> Peramalan</a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out" style="margin-top: 12px;"></span> Logout</a></li>
          <?php endif?> 
          
        <?php else : ?>
            <li><a href="?"><span class="glyphicon glyphicon-home" style="margin-top: 12px;"></span> Home</a></li>
            <li><a href="?m=tentang"><span class="glyphicon glyphicon-info-sign" style="margin-top: 12px;"></span> Tentang</a></li>    
            <li><a href="?m=login"><span class="glyphicon glyphicon-log-in" style="margin-top: 12px;"></span> Login</a></li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="">
    <?php
   
    if (file_exists($mod . '.php'))
      include $mod . '.php';
    else
      include 'home.php';
    ?>
  </div>
  <footer class="footer bg-success" style="color: white;">
    <div class="container">
      <p class="text-center">Copyright &copy; <?= date('Y') ?> SISTEM PERAMALAN PRODUK</p>
    </div>
  </footer>

  <!-- <SCRIPT DATATABLES> -->
  <script type="text/javascript" src="assets/datatables/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/datatables/js/dataTables.bootstrap.min.js"></script> 
  <script type="text/javascript" src="assets/datatables/js/dataTables.responsive.min.js"></script> 

  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatables').DataTable({
        responsive: true
      });
    } );
  </script>  
  <!-- END SCRIPT DATATABLES -->

</body>
</html>