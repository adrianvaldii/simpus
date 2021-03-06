<?php
// generate id pasien
$kode_lokal = "SELECT max(id_pasien) as id_pasien from pasien";
$kode_pusat = "SELECT max(id_pasien) as id_pasien from pasien";

// jika koneksi keduanya jalan
if ($status_lokal == "ON" && $status_pusat == "ON") {
  // get data from server resepsionis and server pusat
  $data_lokal = oci_parse($conn_lokal, $kode_lokal);
  oci_execute($data_lokal);
  $row_lokal = oci_fetch_array($data_lokal);

  $data_pusat = oci_parse($conn_pusat, $kode_pusat);
  oci_execute($data_pusat);
  $row_pusat = oci_fetch_array($data_pusat);

    if ($row_lokal && $row_pusat) {
      $nilai_max = max($row_lokal[0], $row_pusat[0]);
      $id_pasien = $nilai_max + 1;
    } else {
      $id_pasien = "900001";
    }
  // jika koneksi lokal on pusat off
} elseif ($status_lokal == "ON" && $status_pusat == "OFF") {
  $data_lokal = oci_parse($conn_lokal, $kode_lokal);
  oci_execute($data_lokal);
  $row_lokal = oci_fetch_array($data_lokal);

    if ($row_lokal) {
      $id_pasien = $row_lokal[0] + 1;
    } else {
      $id_pasien = "900001";
    }
  // -- jika koneksi lokal gagal lalu mencari ke server pusat
} elseif ($status_lokal == "OFF" && $status_pusat == "ON") {
  $data_pusat = oci_parse($conn_pusat, $kode_pusat);
  oci_execute($data_pusat);
  $row_pusat = oci_fetch_array($data_pusat);

    if ($row_pusat) {
      $id_pasien = $row_pusat[0] + 1;
    } else {
      $id_pasien = "900001";
    }
} else {
    $id_pasien = "900001";
}
?>
