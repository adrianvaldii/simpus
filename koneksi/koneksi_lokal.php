<?php

  $username = "resepsionis";
  $password = "resepsionis";
  $database = "localhost/XE";

  $conn_lokal = oci_connect($username, $password, $database);

  if($conn_lokal){
    $status_lokal = "ON";
  }else{
    $status_lokal = "OFF";
  }

?>
