<?php

  include 'koneksi/koneksi_lokal.php';
  include 'koneksi/koneksi_pusat.php';

  // generate id pasien
  $carikode = "SELECT max(id_pasien) as id_pasien from pasien";

  // algoritma basis data id_pasien

  // -- jika koneksi ke lokal jalan
  if ($status_lokal == "ON") {
    $datakode = oci_parse($conn_lokal, $carikode);
    oci_execute($datakode);
    $row = oci_fetch_array($datakode);

    if($row){
      $id_pasien = $row[0] + 1;
    }else{
      $id_pasien = "900001";
    }
    // -- jika koneksi lokal gagal lalu mencari ke server pusat
  } elseif ($status_pusat == "ON") {
    $datakode = oci_parse($conn_pusat, $carikode);
    oci_execute($datakode);
    $row = oci_fetch_array($datakode);

    if($row){
      $id_pasien = $row[0] + 1;
    }else{
      $id_pasien = "900001";
    }
  }


  $status = "";

  if(isset($_POST['submit'])){
    $nama_pasien = $_POST['nama_pasien'];
    $nama_ortu = $_POST['nama_ortu'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $umur = $_POST['umur'];
    $alamat_asal = $_POST['alamat_asal'];
    $alamat_domisili = $_POST['alamat_domisili'];
    $pekerjaan = $_POST['pekerjaan'];
    $telp = $_POST['telp'];
    $gol_darah = $_POST['gol_darah'];

    // input to local server
    $query = oci_parse($conn_lokal, "INSERT INTO pasien (id_pasien, nama_pasien, nama_ortu, jenis_kelamin, tgl_lahir, tempat_lahir, umur, alamat_asal, alamat_domisili, pekerjaan, telp, gol_darah) VALUES (:id_pasien, :nama_pasien, :nama_ortu, :jenis_kelamin, to_date(:tgl_lahir, 'YYYY-MM-DD'), :tempat_lahir, :umur, :alamat_asal, :alamat_domisili, :pekerjaan, :telp, :gol_darah)");
    oci_bind_by_name($query, ":id_pasien", $id_pasien);
    oci_bind_by_name($query, ":nama_pasien", $nama_pasien);
    oci_bind_by_name($query, ":nama_ortu", $nama_ortu);
    oci_bind_by_name($query, ":jenis_kelamin", $jenis_kelamin);
    oci_bind_by_name($query, ":tempat_lahir", $tempat_lahir);
    oci_bind_by_name($query, ":tgl_lahir" , $tgl_lahir);
    oci_bind_by_name($query, ":umur", $umur);
    oci_bind_by_name($query, ":alamat_asal", $alamat_asal);
    oci_bind_by_name($query, ":alamat_domisili", $alamat_domisili);
    oci_bind_by_name($query, ":pekerjaan", $pekerjaan);
    oci_bind_by_name($query, ":telp", $telp);
    oci_bind_by_name($query, ":gol_darah", $gol_darah);

    $result_lokal = oci_execute($query);
    oci_commit($conn_lokal);

    oci_close($conn_lokal);

    // input to main server
    $query_pusat = oci_parse($conn_pusat, "INSERT INTO pasien (id_pasien, nama_pasien, nama_ortu, jenis_kelamin, tgl_lahir, tempat_lahir, umur, alamat_asal, alamat_domisili, pekerjaan, telp, gol_darah) VALUES (:id_pasien, :nama_pasien, :nama_ortu, :jenis_kelamin, to_date(:tgl_lahir, 'YYYY-MM-DD'), :tempat_lahir, :umur, :alamat_asal, :alamat_domisili, :pekerjaan, :telp, :gol_darah)");
    oci_bind_by_name($query_pusat, ":id_pasien", $id_pasien);
    oci_bind_by_name($query_pusat, ":nama_pasien", $nama_pasien);
    oci_bind_by_name($query_pusat, ":nama_ortu", $nama_ortu);
    oci_bind_by_name($query_pusat, ":jenis_kelamin", $jenis_kelamin);
    oci_bind_by_name($query_pusat, ":tempat_lahir", $tempat_lahir);
    oci_bind_by_name($query_pusat, ":tgl_lahir" , $tgl_lahir);
    oci_bind_by_name($query_pusat, ":umur", $umur);
    oci_bind_by_name($query_pusat, ":alamat_asal", $alamat_asal);
    oci_bind_by_name($query_pusat, ":alamat_domisili", $alamat_domisili);
    oci_bind_by_name($query_pusat, ":pekerjaan", $pekerjaan);
    oci_bind_by_name($query_pusat, ":telp", $telp);
    oci_bind_by_name($query_pusat, ":gol_darah", $gol_darah);

    $result_pusat = oci_execute($query_pusat);
    oci_commit($conn_pusat);

    oci_close($conn_pusat);

    if ($result_lokal && $result_pusat) {
      $status = "berhasil";
    }else{
      $status = "gagal";
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
        <div class="col-md-10 content">
          <h3>PENDAFTARAN - PASIEN BARU</h3>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="kotak">
                <?php
                  if($status == "berhasil")
                  {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Berhasil!</strong> Pendaftaran berhasil dilakukan.
                    </div>
                    <?php
                  }
                  elseif($status == "gagal")
                  {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Gagal!</strong> Pendaftaran gagal dilakukan.
                    </div>
                    <?php
                  }
                ?>
                <form action="daftar_pasien.php" method="post" autocomplete="off">
                  <div class="form-group">
                    <label>ID Pasien</label>
                    <input type="text" name="id_daftar" class="form-control" readonly="true" value="<?php echo $id_pasien; ?>">
                  </div>
                  <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control">
                    <small class="detail-form">Nama lengkap pasien. Harus diisi.</small>
                  </div>
                  <div class="form-group">
                    <label>Nama Orang Tua/Wali</label>
                    <input type="text" name="nama_ortu" class="form-control">
                    <small class="detail-form">Nama orang tua/wali pasien. Jika tidak ada isikan 'Tidak Ada'.</small>
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                      <option value="">-- Pilih Kelamin --</option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                    <small class="detail-form">Jenis kelamin pasien. Harus diisi.</small>
                  </div>
                  <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control">
                    <small class="detail-form">Tempat lahir pasien. Harus diisi.</small>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control">
                    <small class="detail-form">Tanggal lahir pasien. Harus diisi.</small>
                  </div>
                  <div class="form-group">
                    <label>Umur</label>
                    <input type="text" name="umur" class="form-control">
                    <small class="detail-form">Umur pasien. Harus diisi.</small>
                  </div>
                  <div class="form-group">
                    <label>Alamat Asal</label>
                    <input type="text" name="alamat_asal" class="form-control">
                    <small class="detail-form">Alamat asal pasien. Harus diisi.</small>
                  </div><div class="form-group">
                    <label>Alamat Domisili</label>
                    <input type="text" name="alamat_domisili" class="form-control">
                    <small class="detail-form">Alamat domisili pasien. Harus diisi.</small>
                  </div><div class="form-group">
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control">
                    <small class="detail-form">Pekerjaan pasien. Jika tidak ada isikan 'Tidak Ada'.</small>
                  </div><div class="form-group">
                    <label>No. Telp/HP</label>
                    <input type="text" name="telp" class="form-control">
                    <small class="detail-form">Nomor telepon/handphone pasien. Jika tidak ada isikan 'Tidak Ada'.</small>
                  </div>
                  <div class="form-group">
                    <label>Golongan Darah</label>
                    <select class="form-control" name="gol_darah">
                      <option value="">-- Pilih Golongan Darah --</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="AB">AB</option>
                      <option value="O">O</option>
                    </select>
                    <small class="detail-form">Golongan darah pasien. Harus diisi.</small>
                  </div>
                  <button type="submit" name="submit" class="btn btn-default">Daftar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- js -->
    <?php include 'js.php'; ?>
  </body>
</html>
