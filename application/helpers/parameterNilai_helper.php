<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function ubahNilai($nilai,$target,$bobot) {
  switch ($nilai) {
    case $nilai >= 50 && $nilai <= 60:
        $hasil = 1;
    break;
    case $nilai >= 61 && $nilai <= 70:
        $hasil = 2;
    break;
    case $nilai >= 71 && $nilai <= 80:
        $hasil = 3;
    break;
    case $nilai >= 81 && $nilai <= 90:
        $hasil = 4;
    break;
    case $nilai >= 91 && $nilai <= 100:
        $hasil = 5;
    break;   
  }

  if($hasil >= $target){
    $hasil = $bobot;
  }else{
    $hasil = ($hasil/$target)*($bobot);
  }

  return $hasil;
}