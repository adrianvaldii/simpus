<?php

  $username = "dokter";
  $password = "dokter";
  $database = "192.168.1.3/XE";

  $conn_dokter = oci_connect($username, $password, $database);

  if($conn_dokter){
    $status_dokter = "ON";
  }else{
    $status_dokter = "OFF";
  }

?>
