<?php session_start();
  // error_reporting(0);
  // oracle
  include_once 'koneksi/koneksi_pusat.php';
  include_once 'koneksi/koneksi_lokal.php';
  include_once 'koneksi/koneksi_dokter.php';
  include_once 'koneksi/koneksi_apoteker.php';
  // mysql
  include_once 'koneksi/mysql_lokal.php';
  include_once 'koneksi/mysql_pusat.php';
  include_once 'koneksi/mysql_dokter.php';
  include_once 'koneksi/mysql_apoteker.php';
  
  if(empty($_SESSION['user'])){
    header("Location: index.php?message=please+login");
    die("Redirecting to: index.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width= device-width, initial-scale=1">

    <title>Poli Klinik UIN Sunan Kalijaga</title>

    <!-- css -->
    <?php include 'css.php'; ?>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-poli">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">UIN SUKA HEALTH CENTER - RESEPSIONIS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <?php
            include "nav-top.php";
          ?>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container-fluid isi">
      <div class="row">
        <?php
          include 'nav-side.php';
        ?>
        <div class="col-md-10 content">
          <h3>DASHBOARD</h3>
          <hr>
          <div class="row">
            <div class="col-md-8">
              <div class="kotak table-scroll">
                <h4>DATA PASIEN BARU</h4>
                <hr>
                <table class="table table-striped table-pasien">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ID Pasien</th>
                      <th>Nama Pasien</th>
                      <th>Nama Orang Tua</th>
                      <th>Jenis Kelamin</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Umur</th>
                      <th>Alamat Asal</th>
                      <th>Alamat Domisili</th>
                      <th>Pekerjaan</th>
                      <th>No.Telepon</th>
                      <th>Golongan Darah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="kotak table-scroll">
                <h4>STATISTIK PENGOBATAN</h4>
                <hr>
                <table class="table table-striped table-daftar">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>No. Rekam Medis</th>
                      <th>ID Pasien</th>
                      <th>Nama Pasien</th>
                      <th>Pelayanan</th>
                      <th>Dokter</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-4">
              <div class="kotak">
                <h4>STATUS SERVER ORACLE</h4>
                <hr>
                <p class="nama-server">Server Lokal</p>
                <?php
                  if ($status_lokal == "ON") {
                    ?><span class="status-server label label-success"><?php echo $status_lokal; ?></span><?php
                  }else {
                    ?><span class="status-server label label-danger"><?php echo $status_lokal; ?></span><?php
                  }
                ?>
                <div class="clear"></div>
                <p class="nama-server">Server Pusat</p>
                <?php
                  if ($status_pusat == "ON") {
                    ?><span class="status-server label label-success"><?php echo $status_pusat; ?></span><?php
                  }else {
                    ?><span class="status-server label label-danger"><?php echo $status_pusat; ?></span><?php
                  }
                ?>
                <div class="clear"></div>
                <p class="nama-server">Server Dokter</p>
                <?php
                  if ($status_dokter == "ON") {
                    ?><span class="status-server label label-success"><?php echo $status_dokter; ?></span><?php
                  }else {
                    ?><span class="status-server label label-danger"><?php echo $status_dokter; ?></span><?php
                  }
                ?>
                <div class="clear"></div>
                <p class="nama-server">Server Apoteker</p>
                <?php
                  if ($status_apoteker == "ON") {
                    ?><span class="status-server label label-success"><?php echo $status_apoteker; ?></span><?php
                  }else {
                    ?><span class="status-server label label-danger"><?php echo $status_apoteker; ?></span><?php
                  }
                ?>
                <div class="clear"></div>
              </div>
              <div class="kotak">
                <h4>STATUS SERVER MySQL</h4>
                <hr>
                <p class="nama-server">Server Lokal</p>
                <?php
                  if ($stat_mylokal == "ON") {
                    ?><span class="status-server label label-success"><?php echo $stat_mylokal; ?></span><?php
                  }else {
                    ?><span class="status-server label label-danger"><?php echo $stat_mylokal; ?></span><?php
                  }
                ?>
                <div class="clear"></div>
                <p class="nama-server">Server Pusat</p>
                <?php
                  if ($stat_mypusat == "ON") {
                    ?><span class="status-server label label-success"><?php echo $stat_mypusat; ?></span><?php
                  }else {
                    ?><span class="status-server label label-danger"><?php echo $stat_mypusat; ?></span><?php
                  }
                ?>
                <div class="clear"></div>
                <p class="nama-server">Server Dokter</p>
                <?php
                  if ($stat_mydokter == "ON") {
                    ?><span class="status-server label label-success"><?php echo $stat_mydokter; ?></span><?php
                  }else {
                    ?><span class="status-server label label-danger"><?php echo $stat_mydokter; ?></span><?php
                  }
                ?>
                <div class="clear"></div>
                <p class="nama-server">Server Apoteker</p>
                <?php
                  if ($stat_myapoteker == "ON") {
                    ?><span class="status-server label label-success"><?php echo $stat_myapoteker; ?></span><?php
                  }else {
                    ?><span class="status-server label label-danger"><?php echo $stat_myapoteker; ?></span><?php
                  }
                ?>
                <div class="clear"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- js -->
    <?php
      include 'js.php';
    ?>
  </body>
</html>
