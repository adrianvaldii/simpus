<?php

  // load db file
  require("koneksi/koneksi_lokal.php");

  // variable for status login
  $status = 0;

  // connect Logic
  if(isset($_POST['submit'])){
    // $query = "SELECT username, password from users where username = '$_POST[username]'";
    // $query_parse = oci_parse($conn_lokal, $query);
    // oci_execute($query_parse);
    // $login_ok = false;
    // $count = OCIRowCount($query_parse);
    // $row = oci_fetch_assoc($query_parse);

    // print_r($row['PASSWORD']);die();

    // if($count){
    //   $_SESSION['user'] = $row;
    //   header("Location: dashboard.php");
    //   die("Redirecting to: dashboard.php");
    // }
      header("Location: dashboard.php");
      die("Redirecting to: dashboard.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Sistem Informasi Poliklinik UIN Sunan Kalijaga</title>

    <!-- load css -->
    <link rel="stylesheet" href="assets/css/style-login.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <div class="container">
      <div class="form">
        <?php
          // if ($status == 1) {
          //   echo "<p class=alert-fail>Login Gagal</p>";
          // }
        ?>
        <p>Login in. To see it action.</p>
        <form action="index.php" method="POST" autocomplete="off">
          <input type="text" name="username" value="" placeholder="Username">
          <input type="password" name="password" value="" placeholder="Password">
          <input type="submit" name="submit" value="Login">
        </form>
        <span class="garis"></span>
        <p id="legal">Copyright &copy; 2016 by Valdi Adrian Abrar</p>
      </div>
    </div>
  </body>
</html>
