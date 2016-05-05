<?php session_start();
  // error_reporting(0);
  include_once 'koneksi/koneksi_lokal.php';
  include_once 'koneksi/koneksi_pusat.php';
  include_once 'koneksi/koneksi_dokter.php';
  include_once 'koneksi/koneksi_apoteker.php';

  // session login
  if(empty($_SESSION['user'])){
    header("Location: index.php");

    die("Redirecting to: index.php");
  }

  $status = "";
  // resepsionis to pusat
  if (isset($_POST['submit_pusat'])) {
    $query = "MERGE INTO pasien r USING (SELECT * FROM pasien@to_pusat) p ON (r.id_pasien = p.id_pasien)
              WHEN MATCHED THEN UPDATE SET r.nama_pasien = p.nama_pasien, r.nama_ortu = p.nama_ortu, r.jenis_kelamin = p.jenis_kelamin, r.tempat_lahir = p.tempat_lahir, r.tgl_lahir = p.tgl_lahir, r.umur = p.umur, r.alamat_asal = p.alamat_asal, r.alamat_domisili = p.alamat_domisili, r.pekerjaan = p.pekerjaan, r.telp = p.telp, r.gol_darah = p.gol_darah
              WHEN NOT MATCHED THEN INSERT (id_pasien, nama_pasien, nama_ortu, jenis_kelamin, tempat_lahir, tgl_lahir, umur, alamat_asal, alamat_domisili, pekerjaan, telp, gol_darah) VALUES (p.id_pasien, p.nama_pasien, p.nama_ortu, p.jenis_kelamin, p.tempat_lahir, p.tgl_lahir, p.umur, p.alamat_asal, p.alamat_domisili, p.pekerjaan, p.telp, p.gol_darah)";
    $data_sinkron = oci_parse($conn_lokal, $query);
    $result = oci_execute($data_sinkron);
    oci_commit($conn_lokal);

    if ($result) {
      $status = "Good Job! Data pasien berhasil disinkronisasi.";
    } else {
      $status = "Bad News! Data pasien gagal disinkronisasi.";
    }
    oci_close($conn_lokal);
  }
  // pusat to resepsionis
  if (isset($_POST['submit_resepsionis'])) {
    $query = "MERGE INTO pasien p USING (SELECT * FROM pasien@to_resepsionis) r ON (p.id_pasien = r.id_pasien)
              WHEN MATCHED THEN UPDATE SET p.nama_pasien = r.nama_pasien, p.nama_ortu = r.nama_ortu, p.jenis_kelamin = r.jenis_kelamin, p.tempat_lahir = r.tempat_lahir, p.tgl_lahir = r.tgl_lahir, p.umur = r.umur, p.alamat_asal = r.alamat_asal, p.alamat_domisili = r.alamat_domisili, p.pekerjaan = r.pekerjaan, p.telp = r.telp, p.gol_darah = r.gol_darah
              WHEN NOT MATCHED THEN INSERT (id_pasien, nama_pasien, nama_ortu, jenis_kelamin, tempat_lahir, tgl_lahir, umur, alamat_asal, alamat_domisili, pekerjaan, telp, gol_darah) VALUES (r.id_pasien, r.nama_pasien, r.nama_ortu, r.jenis_kelamin, r.tempat_lahir, r.tgl_lahir, r.umur, r.alamat_asal, r.alamat_domisili, r.pekerjaan, r.telp, r.gol_darah)";
    $data_sinkron = oci_parse($conn_pusat, $query);
    $result = oci_execute($data_sinkron);
    oci_commit($conn_pusat);

    if ($result) {
      $status = "Good Job! Data pasien berhasil disinkronisasi.";
    } else {
      $status = "Bad News! Data pasien gagal disinkronisasi.";
    }
    oci_close($conn_pusat);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width= device-width, inital-scale=1">

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
          <h3>SINKRONISASI DATA PASIEN</h3>
          <hr>
          <div class="row">
            <!-- resepsionis sinkronisasi dengan pusat -->
            <div class="col-md-6">
              <fieldset class="sinkron">
                <legend class="sinkron">Sinkronisasi Data Server Resepsionis - Server Pusat</legend>
                <h3>Tekan tombol 'Sinkronisasi' untuk sinkronisasi data</h3>
                <?php
                  if (isset($_POST['submit_pusat'])) {
                    ?><div class="alert alert-info" role="alert"><?php echo $status; ?></div><?php
                  }
                ?>
                <hr>
                <form action="sinkron_pasien.php" method="post">
                  <input type="submit" class="btn btn-success btn-sinkron" name="submit_pusat" value="SINKRONISASI">
                </form>
                <!-- <button type="button" id="pustorep" class="btn btn-primary btn-sinkron" name="button">SINKRONISASI PUSAT KE RESEPSIONIS</button> -->
              </fieldset>
            </div>
            <!-- pusat sinkronisasi dengan resepsionis -->
            <div class="col-md-6">
              <fieldset class="sinkron">
                <legend class="sinkron">Sinkronisasi Data Server Pusat - Server Resepsionis</legend>
                <h3>Tekan tombol 'Sinkronisasi' untuk sinkronisasi data</h3>
                <?php
                  if (isset($_POST['submit_resepsionis'])) {
                    ?><div class="alert alert-info" role="alert"><?php echo $status; ?></div><?php
                  }
                ?>
                <hr>
                <form action="sinkron_pasien.php" method="post">
                  <input type="submit" class="btn btn-success btn-sinkron" name="submit_resepsionis" value="SINKRONISASI">
                </form>
                <!-- <button type="button" id="pustorep" class="btn btn-primary btn-sinkron" name="button">SINKRONISASI PUSAT KE RESEPSIONIS</button> -->
              </fieldset>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- js -->
    <?php include 'js.php'; ?>
  </body>
</html>
