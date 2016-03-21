<?php

  $username = "";
  $password = "";
  $database = "";

  $conn = mysqli_connect($username, $password, $database);

  if($conn){
    $status_mysql = "ON";
  }else{
    $status_mysql = "OFF";
  }

?>
