<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function zodiak($tgl_lahir){
  $tgl_lahir = date('m-d', strtotime($tgl_lahir));

  switch ($tgl_lahir) {
    case $tgl_lahir > "03-21" && $tgl_lahir < "04-19":
      $zodiak = "Aries";
      break;
    case $tgl_lahir > "04-20" && $tgl_lahir < "05-20":
      $zodiak = "Taurus";
      break;
    case $tgl_lahir > "05-21" && $tgl_lahir < "06-20":
      $zodiak = "Gemini";
      break;
    case $tgl_lahir > "06-21" && $tgl_lahir < "07-22":
      $zodiak = "Cancer";
      break;
    case $tgl_lahir > "07-23" && $tgl_lahir < "08-22":
      $zodiak = "Leo";
      break;
    case $tgl_lahir > "08-23" && $tgl_lahir < "09-22":
      $zodiak = "Virgo";
      break;
    case $tgl_lahir > "09-23" && $tgl_lahir < "10-22":
      $zodiak = "Libra";
      break;
    case $tgl_lahir > "10-23" && $tgl_lahir < "11-21":
      $zodiak = "Scorpio";
      break;
    case $tgl_lahir > "11-22" && $tgl_lahir < "12-21":
      $zodiak = "Sagitarius";
      break;
    case $tgl_lahir > "12-22" && $tgl_lahir < "01-19":
      $zodiak = "Capricorn";
      break;
    case $tgl_lahir > "01-20" && $tgl_lahir < "02-18":
      $zodiak = "Aquarius";
      break;
    case $tgl_lahir > "02-19" && $tgl_lahir < "03-20":
      $zodiak = "Pisces";
      break;
  }

  return $zodiak;
}