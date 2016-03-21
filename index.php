<?php
  // error_reporting(0);

  include 'koneksi/koneksi_pusat.php';
  include 'koneksi/koneksi_lokal.php';

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
              <div class="kotak table-pasien">
                <h4>DATA PASIEN BARU</h4>
                <hr>
                <table class="table table-striped">
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
                      $data = "SELECT * FROM pasien";
                      $data_parse = oci_parse($conn_lokal, $data);
                      oci_execute($data_parse);
                      $no = 1;
                      while (($row = oci_fetch_array($data_parse, OCI_BOTH)) != false) {
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $row['ID_PASIEN']; ?></td>
                          <td><?php echo $row['NAMA_PASIEN']; ?></td>
                          <td><?php echo $row['NAMA_ORTU']; ?></td>
                          <td><?php echo $row['JENIS_KELAMIN']; ?></td>
                          <td><?php echo $row['TEMPAT_LAHIR']; ?></td>
                          <td><?php echo date("d F Y", strtotime($row['TGL_LAHIR'])) ?></td>
                          <td><?php echo $row['UMUR']; ?></td>
                          <td><?php echo $row['ALAMAT_ASAL']; ?></td>
                          <td><?php echo $row['ALAMAT_DOMISILI']; ?></td>
                          <td><?php echo $row['PEKERJAAN']; ?></td>
                          <td><?php echo $row['TELP']; ?></td>
                          <td><?php echo $row['GOL_DARAH']; ?></td>
                        </tr>
                        <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="kotak">
                <h4>STATISTIK PENGOBATAN</h4>
                <hr>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </div>
            </div>
            <div class="col-md-4">
              <div class="kotak">
                <h4>STATUS SERVER</h4>
                <hr>
                <p class="nama-server">Server Lokal (Oracle)</p>
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
