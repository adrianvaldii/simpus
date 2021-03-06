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

  // timezone
  date_default_timezone_set('Asia/Jakarta');

  // session login
  if(empty($_SESSION['user'])){
    header("Location: index.php");

    die("Redirecting to: index.php");
  }

  include_once 'generate_id_daftar.php';

  // insert data to database
  $status = "";

  if(isset($_POST['submit'])){
    $id_daftar = $_POST['id_daftar'];
    $tgl_daftar = $_POST['tgl_daftar'];
    $id_pasien = $_POST['id_pasien'];
    $daftar_pelayanan = $_POST['daftar_pelayanan'];
    $daftar_perawat = $_POST['daftar_perawat'];

    // query
    $query = "INSERT INTO rekam_medis (id_daftar, tgl_daftar, id_pasien, id_pelayanan, id_perawat) VALUES ('$id_daftar', STR_TO_DATE('$tgl_daftar', '%Y-%m-%d'), '$id_pasien', '$daftar_pelayanan', '$daftar_perawat')";

    // logika basis data terdistribusi
    if ($stat_mylokal == "ON" && $stat_mypusat == "ON" && $stat_myapoteker == "ON" && $stat_mydokter == "ON") {
        // commit ke server lokal
        $mysqli_lokal->query($query);
        // commit ke server pusat
        $mysqli_pusat->query($query);
        // commit ke server apoteker
        $mysqli_apoteker->query($query);
        // commit ke server dokter
        $mysqli_dokter->query($query);

        $status = "Data berhasil ditambahkan pada server Resepsionis, Pusat, Apoteker, dan Dokter!";

    } elseif ($stat_mylokal == "ON" && $stat_mypusat == "OFF" && $stat_myapoteker == "OFF" && $stat_mydokter == "OFF") {
        // commit ke server lokal
        $mysqli_lokal->query($query);

        $status = "Data berhasil ditambahkan pada server Resepsionis!";

    } elseif ($stat_mylokal == "OFF" && $stat_mypusat == "ON" && $stat_myapoteker == "OFF" && $stat_mydokter == "OFF") {
        // commit ke server pusat
        $mysqli_pusat->query($query);

        $status = "Data berhasil ditambahkan pada server Pusat!";

    } elseif ($stat_mylokal == "OFF" && $stat_mypusat == "OFF" && $stat_myapoteker == "ON" && $stat_mydokter == "OFF") {
        // commit ke server apoteker
        $mysqli_apoteker->query($query);

        $status = "Data berhasil ditambahkan pada server Apoteker!";

    } elseif ($stat_mylokal == "OFF" && $stat_mypusat == "OFF" && $stat_myapoteker == "OFF" && $stat_mydokter == "ON") {
        // commit ke server dokter
        $mysqli_dokter->query($query);

        $status = "Data berhasil ditambahkan pada server Dokter!";

    } elseif ($stat_mylokal == "ON" && $stat_mypusat == "ON" && $stat_myapoteker == "OFF" && $stat_mydokter == "OFF") {
        // commit ke server lokal
        $mysqli_lokal->query($query);
        // commit ke server pusat
        $mysqli_pusat->query($query);

        $status = "Data berhasil ditambahkan pada server Resepsionis dan Pusat!";

    } elseif ($stat_mylokal == "ON" && $stat_mypusat == "OFF" && $stat_myapoteker == "ON" && $stat_mydokter == "OFF") {
        // commit ke server lokal
        $mysqli_lokal->query($query);
        // commit ke server apoteker
        $mysqli_apoteker->query($query);

        $status = "Data berhasil ditambahkan pada server Resepsionis dan Apoteker!";

    } elseif ($stat_mylokal == "ON" && $stat_mypusat == "OFF" && $stat_myapoteker == "OFF" && $stat_mydokter == "ON") {
        // commit ke server lokal
        $mysqli_lokal->query($query);
        // commit ke server dokter
        $mysqli_dokter->query($query);

        $status = "Data berhasil ditambahkan pada server Resepsionis dan Dokter!";

    } elseif ($stat_mylokal == "OFF" && $stat_mypusat == "ON" && $stat_myapoteker == "ON" && $stat_mydokter == "OFF") {
        // commit ke server pusat
        $mysqli_pusat->query($query);
        // commit ke server apoteker
        $mysqli_apoteker->query($query);

        $status = "Data berhasil ditambahkan pada server Pusat dan Apoteker!";

    } elseif ($stat_mylokal == "OFF" && $stat_mypusat == "ON" && $stat_myapoteker == "OFF" && $stat_mydokter == "ON") {
        // commit ke server pusat
        $mysqli_pusat->query($query);
        // commit ke server dokter
        $mysqli_dokter->query($query);

        $status = "Data berhasil ditambahkan pada server Pusat dan Dokter!";

    } elseif ($stat_mylokal == "OFF" && $stat_mypusat == "OFF" && $stat_myapoteker == "ON" && $stat_mydokter == "ON") {
        // commit ke server apoteker
        $mysqli_apoteker->query($query);
        // commit ke server dokter
        $mysqli_dokter->query($query);

        $status = "Data berhasil ditambahkan pada server Apoteker dan Dokter!";

    } elseif ($stat_mylokal == "ON" && $stat_mypusat == "OFF" && $stat_myapoteker == "ON" && $stat_mydokter == "ON") {
        // commit ke server lokal
        $mysqli_lokal->query($query);
        // commit ke server apoteker
        $mysqli_apoteker->query($query);
        // commit ke server dokter
        $mysqli_dokter->query($query);

        $status = "Data berhasil ditambahkan pada server Resepsionis, Apoteker, dan Dokter!";

    } elseif ($stat_mylokal == "ON" && $stat_mypusat == "ON" && $stat_myapoteker == "OFF" && $stat_mydokter == "ON") {
        // commit ke server lokal
        $mysqli_lokal->query($query);
        // commit ke server pusat
        $mysqli_pusat->query($query);
        // commit ke server dokter
        $mysqli_dokter->query($query);

        $status = "Data berhasil ditambahkan pada server Resepsionis, Pusat, dan Dokter!";

    } elseif ($stat_mylokal == "ON" && $stat_mypusat == "ON" && $stat_myapoteker == "ON" && $stat_mydokter == "OFF") {
        // commit ke server lokal
        $mysqli_lokal->query($query);
        // commit ke server pusat
        $mysqli_pusat->query($query);
        // commit ke server apoteker
        $mysqli_apoteker->query($query);

        $status = "Data berhasil ditambahkan pada server Resepsionis, Pusat, dan Apoteker!";

    } elseif ($stat_mylokal == "OFF" && $stat_mypusat == "ON" && $stat_myapoteker == "ON" && $stat_mydokter == "ON") {
        // commit ke server pusat
        $mysqli_pusat->query($query);
        // commit ke server apoteker
        $mysqli_apoteker->query($query);
        // commit ke server dokter
        $mysqli_dokter->query($query);

        $status = "Data berhasil ditambahkan pada server Pusat, Apoteker, dan Dokter!";

    }

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
        <div class="col-md-10 content main_baru">
          <h3>PENDAFTARAN - PENGOBATAN</h3>
          <a href="daftar_pasien.php" class="btn btn-warning">Daftar Pasien</a>
          <div class="clear"></div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <?php
                // menampilkan status
                if (isset($_POST['submit'])) {
                  ?><div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $status; ?>
                  </div><?php
                }
              ?>
              <form action="daftar_lama.php" method="post" autocomplete="off">
              <div class="row">
                <!-- form kiri -->
                <div class="col-md-8">
                  <div class="kotak">
                    <div class="form-group">
                      <label>No. Pendaftaran</label>
                      <input type="text" name="id_daftar" class="form-control" value="<?php echo $id_rekam_medis; ?>" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>ID Pasien</label>
                      <input type="text" name="id_pasien" id="id_pasien" class="form-control">
                      <small class="detail-form">Nomor pasien. Harus diisi.</small>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Daftar</label>
                      <input type="date" name="tgl_daftar" class="form-control" readonly="true" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="form-group">
                      <label>Nama Pasien</label>
                      <input type="text" name="nama_pasien" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Nama Orang Tua</label>
                      <input type="text" name="nama_ortu" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Alamat Asal</label>
                      <input type="text" name="alamat_asal" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Alamat Domisili</label>
                      <input type="text" name="alamat_domisili" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" name="tgl_lahir" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Umur</label>
                      <input type="text" name="umur" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Pekerjaan</label>
                      <input type="text" name="pekerjaan" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Nomor Telepon</label>
                      <input type="text" name="telp" class="form-control" readonly="true">
                    </div>
                    <div class="form-group">
                      <label>Golongan Darah</label>
                      <input type="text" name="gol_darah" class="form-control" readonly="true">
                    </div>
                  </div>
                </div>
                <!-- end form kiri -->
                <!-- form kanan -->
                <div class="col-md-4">
                  <!-- form poli -->
                  <div class="kotak">
                    <div class="form-group">
                      <label>Daftar Pelayanan</label>
                      <select class="form-control" name="daftar_pelayanan">
                        <option>-- Pilih Pelayanan --</option>
                        <?php
                          $data_pelayanan = "SELECT * FROM pelayanan";
                          if ($status_lokal == "ON" && $status_pusat == "ON") {
                            $pelayanan = oci_parse($conn_lokal, $data_pelayanan);
                            oci_execute($pelayanan);

                            while (($row = oci_fetch_array($pelayanan, OCI_BOTH)) != false) {
                              ?><option value="<?php echo $row['ID_PELAYANAN']; ?>"><?php echo $row['NAMA_PELAYANAN']; ?></option> <?php
                            }
                          } elseif ($status_lokal == "ON" && $status_pusat == "OFF") {
                            $pelayanan = oci_parse($conn_lokal, $data_pelayanan);
                            oci_execute($pelayanan);

                            while (($row = oci_fetch_array($pelayanan, OCI_BOTH)) != false) {
                              ?><option value="<?php echo $row['ID_PELAYANAN']; ?>"><?php echo $row['NAMA_PELAYANAN']; ?></option> <?php
                            }
                          } elseif ($status_lokal == "OFF" && $status_pusat == "ON") {
                            $pelayanan = oci_parse($conn_pusat, $data_pelayanan);
                            oci_execute($pelayanan);

                            while (($row = oci_fetch_array($pelayanan, OCI_BOTH)) != false) {
                              ?><option value="<?php echo $row['ID_PELAYANAN']; ?>"><?php echo $row['NAMA_PELAYANAN']; ?></option> <?php
                            }
                          } elseif ($status_lokal == "ON" && $status_pusat == "OFF") {
                            $pelayanan = oci_parse($conn_lokal, $data_pelayanan);
                            oci_execute($pelayanan);

                            while (($row = oci_fetch_array($pelayanan, OCI_BOTH)) != false) {
                              ?><option value="<?php echo $row['ID_PELAYANAN']; ?>"><?php echo $row['NAMA_PELAYANAN']; ?></option> <?php
                            }
                          }
                        ?>
                      </select>
                      <small class="detail-form">Layanan untuk pasien. Harus diisi.</small>
                    </div>
                  </div>
                  <!-- form dokter -->
                  <div class="kotak">
                    <div class="form-group">
                      <label>Daftar Perawat</label>
                      <select class="form-control" name="daftar_perawat">
                        <option>-- Pilih Perawat --</option>
                        <?php
                          $data_perawat = "SELECT * FROM perawat";

                          if ($status_lokal == "ON" && $status_pusat == "ON") {
                            $perawat = oci_parse($conn_lokal, $data_perawat);
                            oci_execute($perawat);

                            while (($row = oci_fetch_array($perawat, OCI_BOTH)) != false) {
                              ?><option value="<?php echo $row['ID_PERAWAT']; ?>"><?php echo $row['NAMA_PERAWAT']; ?></option> <?php
                            }
                          } elseif ($status_lokal == "ON" && $status_pusat == "OFF") {
                            $perawat = oci_parse($conn_lokal, $data_perawat);
                            oci_execute($perawat);

                            while (($row = oci_fetch_array($perawat, OCI_BOTH)) != false) {
                              ?><option value="<?php echo $row['ID_PERAWAT']; ?>"><?php echo $row['NAMA_PERAWAT']; ?></option> <?php
                            }
                          } elseif ($status_lokal == "OFF" && $status_pusat == "ON") {
                            $perawat = oci_parse($conn_pusat, $data_perawat);
                            oci_execute($perawat);

                            while (($row = oci_fetch_array($perawat, OCI_BOTH)) != false) {
                              ?><option value="<?php echo $row['ID_PERAWAT']; ?>"><?php echo $row['NAMA_PERAWAT']; ?></option> <?php
                            }
                          }
                        ?>
                      </select>
                      <small class="detail-form">Nama perawat. Harus diisi.</small>
                    </div>
                  </div>
                  <!-- button -->
                  <div class="btn-daftar">
                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Daftar</button>
                    </div>
                  </div>
                  </div>
                </div>
                <!-- end of form kanan -->
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- js -->
    <?php
      include 'js.php';
    ?>

    <script type="text/javascript">
      $(function(){
        $("#id_pasien").autocomplete({
          source: "datapasien.php",
          minLength:2,
          select:function(event, data){
            $('input[name=nama_pasien]').val(data.item.nama_pasien);
            $('input[name=nama_ortu]').val(data.item.nama_ortu);
            $('input[name=jenis_kelamin]').val(data.item.jenis_kelamin);
            $('input[name=tempat_lahir]').val(data.item.tempat_lahir);
            $('input[name=tgl_lahir]').val(data.item.tgl_lahir);
            $('input[name=umur]').val(data.item.umur);
            $('input[name=alamat_asal]').val(data.item.alamat_asal);
            $('input[name=alamat_domisili]').val(data.item.alamat_domisili);
            $('input[name=pekerjaan]').val(data.item.pekerjaan);
            $('input[name=telp]').val(data.item.telp);
            $('input[name=gol_darah]').val(data.item.gol_darah);
          }
        })
      });
    </script>
  </body>
</html>
