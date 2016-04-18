<?php
// generate id daftar berobat
$caridata = "SELECT max(id_daftar) as id_rekam_medis from rekam_medis";

// mendapatkan id_daftar dari server resepsionis
$data_lokal = oci_parse($conn_lokal, $caridata);
oci_execute($data_lokal);
$cari_lokal = oci_fetch_array($data_lokal, OCI_BOTH);

// mendapatkan id_daftar dari server pusat
$data_pusat = oci_parse($conn_pusat, $caridata);
oci_execute($data_pusat);
$cari_pusat = oci_fetch_array($data_pusat, OCI_BOTH);

// mendapatkan id_daftar dari server dokter
$data_dokter = oci_parse($conn_dokter, $caridata);
oci_execute($data_dokter);
$cari_dokter = oci_fetch_array($data_dokter, OCI_BOTH);

if ($status_lokal == "ON" && $status_pusat == "ON" && $status_dokter == "ON") {
  if ($cari_lokal && $cari_pusat && $cari_dokter) {
    $nilai_max = max($cari_lokal[0], $cari_pusat[0], $cari_dokter[0]);
    // mengambil tangga dari data maximal
    $hasil = substr($nilai_max, 0, 8);
    // deklarasi variabel $sekarang yang berisi tanggal sekarang
    $sekarang = date("Ymd");

    if ($hasil == $sekarang) {
      $id_rekam_medis = $nilai_max + 1;
    }else {
      $id_rekam_medis = $sekarang . "001";
    }
  } else {
    $date = date("Ymd");
    $id_rekam_medis = $date . "001";
  }
} elseif ($status_lokal == "ON" && $status_pusat == "ON" && $status_dokter == "OFF") {
  if ($cari_lokal && $cari_pusat) {
    $nilai_max = max($cari_lokal[0], $cari_pusat[0]);
    // mengambil tangga dari data maximal
    $hasil = substr($nilai_max, 0, 8);
    // deklarasi variabel $sekarang yang berisi tanggal sekarang
    $sekarang = date("Ymd");

    if ($hasil == $sekarang) {
      $id_rekam_medis = $nilai_max + 1;
    }else {
      $id_rekam_medis = $sekarang . "001";
    }
  } else {
    $date = date("Ymd");
    $id_rekam_medis = $date . "001";
  }
} elseif ($status_lokal == "ON" && $status_pusat == "OFF" && $status_dokter == "ON") {
  if ($cari_lokal && $cari_dokter) {
    $nilai_max = max($cari_lokal[0], $cari_dokter[0]);
    // mengambil tangga dari data maximal
    $hasil = substr($nilai_max, 0, 8);
    // deklarasi variabel $sekarang yang berisi tanggal sekarang
    $sekarang = date("Ymd");

    if ($hasil == $sekarang) {
      $id_rekam_medis = $nilai_max + 1;
    }else {
      $id_rekam_medis = $sekarang . "001";
    }
  } else {
    $date = date("Ymd");
    $id_rekam_medis = $date . "001";
  }
} elseif ($status_lokal == "OFF" && $status_pusat == "ON" && $status_dokter == "ON") {
  if ($cari_pusat && $cari_dokter) {
    $nilai_max = max($cari_pusat[0], $cari_dokter[0]);
    // mengambil tangga dari data maximal
    $hasil = substr($nilai_max, 0, 8);
    // deklarasi variabel $sekarang yang berisi tanggal sekarang
    $sekarang = date("Ymd");

    if ($hasil == $sekarang) {
      $id_rekam_medis = $nilai_max + 1;
    }else {
      $id_rekam_medis = $sekarang . "001";
    }
  } else {
    $date = date("Ymd");
    $id_rekam_medis = $date . "001";
  }
} elseif ($status_lokal == "ON" && $status_pusat == "OFF" && $status_dokter == "OFF") {
  if ($cari_lokal) {
    $nilai_max = max($cari_lokal[0]);
    // mengambil tangga dari data maximal
    $hasil = substr($nilai_max, 0, 8);
    // deklarasi variabel $sekarang yang berisi tanggal sekarang
    $sekarang = date("Ymd");

    if ($hasil == $sekarang) {
      $id_rekam_medis = $nilai_max + 1;
    }else {
      $id_rekam_medis = $sekarang . "001";
    }
  } else {
    $date = date("Ymd");
    $id_rekam_medis = $date . "001";
  }
} elseif ($status_lokal == "OFF" && $status_pusat == "ON" && $status_dokter == "OFF") {
  if ($cari_pusat) {
    $nilai_max = max($cari_pusat[0]);
    // mengambil tangga dari data maximal
    $hasil = substr($nilai_max, 0, 8);
    // deklarasi variabel $sekarang yang berisi tanggal sekarang
    $sekarang = date("Ymd");

    if ($hasil == $sekarang) {
      $id_rekam_medis = $nilai_max + 1;
    }else {
      $id_rekam_medis = $sekarang . "001";
    }
  } else {
    $date = date("Ymd");
    $id_rekam_medis = $date . "001";
  }
} elseif ($status_lokal == "OFF" && $status_pusat == "OFF" && $status_dokter == "ON") {
  if ($cari_dokter) {
    $nilai_max = max($cari_dokter[0]);
    // mengambil tangga dari data maximal
    $hasil = substr($nilai_max, 0, 8);
    // deklarasi variabel $sekarang yang berisi tanggal sekarang
    $sekarang = date("Ymd");

    if ($hasil == $sekarang) {
      $id_rekam_medis = $nilai_max + 1;
    }else {
      $id_rekam_medis = $sekarang . "001";
    }
  } else {
    $date = date("Ymd");
    $id_rekam_medis = $date . "001";
  }
}

?>
