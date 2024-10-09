<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function shio($tanggal){
  $tahun = date('Y', strtotime($tanggal));

  $param1 = $tahun / 12;
  $hasil = round($param1,3);

  $pengurang = floor($param1);

  $hitung = $hasil - $pengurang;

  if ($hitung == 0){
    $shio = 0;
  }else{
    $shio = $hitung * 12;
    $shio = round($shio,0);
  }

  switch ($shio) {
    case 0:
      $shio = "Monyet";
      break;
    case 1:
      $shio = "Ayam";
      break;
    case 2:
      $shio = "Anjing";
      break;
    case 3:
      $shio = "Babi";
      break;
    case 4:
      $shio = "Tikus";
      break;
    case 5:
      $shio = "Sapi";
      break;
    case 6:
      $shio = "Harimau";
      break;
    case 7:
      $shio = "Kelinci";
      break;
    case 8:
      $shio = "Naga";
      break;
    case 9:
      $shio = "Ular";
      break;
    case 10:
      $shio = "Kuda";
      break;
    case 11:
      $shio = "Kambing";
      break;
  }

  return $shio;
}