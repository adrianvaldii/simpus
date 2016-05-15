<?php
// mysql
include_once 'koneksi/mysql_lokal.php';
include_once 'koneksi/mysql_pusat.php';
include_once 'koneksi/mysql_dokter.php';
include_once 'koneksi/mysql_apoteker.php';
// generate id daftar berobat
$caridata = "SELECT MAX(id_daftar) as id_rekam_medis from rekam_medis";

// mendapatkan id_daftar dari server resepsionis
$data_lokal = $mysqli_lokal->query($caridata);
$cari_lokal = $data_lokal->fetch_array(MYSQLI_NUM);

// mendapatkan id_daftar dari server pusat
$data_pusat = $mysqli_pusat->query($caridata);
$cari_pusat = $data_pusat->fetch_array(MYSQLI_NUM);

// mendapatkan id_daftar dari server dokter
$data_dokter = $mysqli_dokter->query($caridata);
$cari_dokter = $data_dokter->fetch_array(MYSQLI_NUM);

// mendapatkan id_daftar dari server apoteker
$data_apoteker = $mysqli_apoteker->query($caridata);
$cari_apoteker = $data_apoteker->fetch_array(MYSQLI_NUM);

// logika distribusi
if ($stat_mylokal == "ON" && $stat_mypusat == "ON" && $stat_myapoteker == "ON" && $stat_mydokter == "ON") {
  if ($cari_lokal && $cari_pusat && $cari_dokter && $cari_apoteker) {
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
} elseif ($stat_mylokal == "ON" && $stat_mypusat == "OFF" && $stat_myapoteker == "OFF" && $stat_mydokter == "OFF") {
  if ($cari_lokal) {
    // mengambil tangga dari data maximal
    $hasil = substr($cari_lokal[0], 0, 8);
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
} elseif ($stat_mylokal == "OFF" && $stat_mypusat == "ON" && $stat_myapoteker == "OFF" && $stat_mydokter == "OFF") {
  if ($cari_pusat) {
    // mengambil tangga dari data maximal
    $hasil = substr($cari_pusat[0], 0, 8);
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
} elseif ($stat_mylokal == "OFF" && $stat_mypusat == "OFF" && $stat_myapoteker == "ON" && $stat_mydokter == "OFF") {
  if ($cari_apoteker) {
    // mengambil tangga dari data maximal
    $hasil = substr($cari_apoteker[0], 0, 8);
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
} else if ($stat_mylokal == "OFF" && $stat_mypusat == "OFF" && $stat_myapoteker == "OFF" && $stat_mydokter == "ON") {
  if ($cari_dokter) {
    // mengambil tangga dari data maximal
    $hasil = substr($cari_dokter[0], 0, 8);
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
} elseif ($stat_mylokal == "ON" && $stat_mypusat == "ON" && $stat_myapoteker == "OFF" && $stat_mydokter == "OFF") {
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
} elseif ($stat_mylokal == "ON" && $stat_mypusat == "OFF" && $stat_myapoteker == "ON" && $stat_mydokter == "OFF") {
  if ($cari_lokal && $cari_apoteker) {
    $nilai_max = max($cari_lokal[0], $cari_apoteker[0]);
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
} elseif ($stat_mylokal == "ON" && $stat_mypusat == "OFF" && $stat_myapoteker == "OFF" && $stat_mydokter == "ON") {
  if ($cari_lokal && $cari_dokter ) {
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
} elseif ($stat_mylokal == "OFF" && $stat_mypusat == "ON" && $stat_myapoteker == "ON" && $stat_mydokter == "OFF") {
  if ($cari_pusat && $cari_apoteker) {
    $nilai_max = max($cari_pusat[0], $cari_apoteker[0]);
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
} elseif ($stat_mylokal == "OFF" && $stat_mypusat == "ON" && $stat_myapoteker == "OFF" && $stat_mydokter == "ON") {
  if ($cari_pusat && $cari_dokter ) {
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
} elseif ($stat_mylokal == "OFF" && $stat_mypusat == "OFF" && $stat_myapoteker == "ON" && $stat_mydokter == "ON") {
  if ($cari_apoteker && $cari_dokter ) {
    $nilai_max = max($cari_apoteker[0], $cari_dokter[0]);
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
} elseif ($stat_mylokal == "ON" && $stat_mypusat == "OFF" && $stat_myapoteker == "ON" && $stat_mydokter == "ON") {
  if ($cari_lokal && $cari_apoteker && $cari_dokter ) {
    $nilai_max = max($cari_lokal[0], $cari_apoteker[0], $cari_dokter[0]);
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
} elseif ($stat_mylokal == "ON" && $stat_mypusat == "ON" && $stat_myapoteker == "OFF" && $stat_mydokter == "ON") {
  if ($cari_lokal && $cari_pusat && $cari_dokter ) {
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
} elseif ($stat_mylokal == "ON" && $stat_mypusat == "ON" && $stat_myapoteker == "ON" && $stat_mydokter == "OFF") {
  if ($cari_lokal && $cari_pusat && $cari_apoteker) {
    $nilai_max = max($cari_lokal[0], $cari_pusat[0], $cari_apoteker[0]);
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
} elseif ($stat_mylokal == "OFF" && $stat_mypusat == "ON" && $stat_myapoteker == "ON" && $stat_mydokter == "ON") {
  if ($cari_pusat && $cari_apoteker && $cari_dokter ) {
    $nilai_max = max($cari_apoteker[0], $cari_pusat[0], $cari_dokter[0]);
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
} elseif ($stat_mylokal == "OFF" && $stat_mypusat == "OFF" && $stat_myapoteker == "OFF" && $stat_mydokter == "OFF"){
  $date = date("Ymd");
  $id_rekam_medis = $date . "001";
}
?>
