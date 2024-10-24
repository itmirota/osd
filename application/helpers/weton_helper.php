<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
function intPart($floatNum) {
  return ($floatNum<-0.0000001 ? ceil($floatNum-0.0000001) : floor($floatNum+0.0000001));
}

function hdate($day,$month,$year) {
  $julian = GregorianToJD($month, $day, $year);
  if ($julian >= 1937808 && $julian <= 536838867) {
    $date = cal_from_jd($julian, CAL_GREGORIAN);
    $d = $date['day'];
    $m = $date['month'] - 1;
    $y = $date['year'];

    $mPart = ($m-13)/12;
    $jd = intPart((1461*($y+4800+intPart($mPart)))/4)+
    intPart((367*($m-1-12*(intPart($mPart))))/12)-
    intPart((3*(intPart(($y+4900+intPart($mPart))/100)))/4)+$d-32075;

    $l = $jd-1948440+10632;
    $n = intPart(($l-1)/10631);
    $l = $l-10631*$n+354;
    $j = (intPart((10985-$l)/5316))*(intPart((50*$l)/17719))+(intPart($l/5670))*(intPart((43*$l)/15238));
    $l = $l-(intPart((30-$j)/15))*(intPart((17719*$j)/50))-(intPart($j/16))*(intPart((15238*$j)/43))+29;

    $m = intPart((24*$l)/709);
    $d = $l-intPart((709*$m)/24);
    $y = 30*$n+$j-30;
    $yj = $y+512;
    $h = ($julian+3)%5;

    if($julian<=1948439) $y–;

    return array(
        'day' => $date['day'],
        'month' => $date['month'],
        'year' => $date['year'],
        'dow' => $date['dow'],
        'hijriday' => $d,
        'hijrimonth' => $m, 
        'hijriyear' => $y,
        'javayear' => $yj,
        'javadow' => $h
    );
  }
}

function weton($date) {
  $imonth = Array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
  $amonth = Array('Muharram','Safar','Rabi\'ul Awal','Rabi\'ul Akhir','Jumadil Awal','Jumadil Akhir','Rajab','Sya\'ban','Ramadhan','Syawal','Dzul Qa\'dah','Dzul Hijjah');
  $jmonth = Array('Suro','Sapar','Mulud','Ba\'da Mulud','Jumadil Awal','Jumadil Akhir','Rejeb','Ruwah','Poso','Syawal','Dulkaidah','Besar');
  $aday = Array('Al-Ahad','Al-Itsnayna','Ats-Tsalatsa',"Al-Arba'a","Al-Hamis","Al-Jum'a","As-Sabt");
  $iday = Array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
  $jday = Array('Pon','Wage','Kliwon','Legi','Pahing');
  $hari = ['Minggu' => 5,'Senin' => 4,'Selasa' => 3,'Rabu' => 7,'Kamis' => 8,'Jumat' => 6,'Sabtu' => 9];
  $pasaran = ['Legi' => 5,'Pahing' => 9,'Pon' => 7,'Wage' => 4,'Kliwon' => 8];

  $date = explode("-", $date);

  $date = hdate($date[2], $date[1], $date[0]);
  
  // var_dump($date);

  $r['hari'] = $iday[$date['dow']];
  $r['pasaran'] = $jday[$date['javadow']];

  foreach ($hari as $key => $val) {
      if ($r['hari'] == $key) {
          $r['hari_val'] = $val;
          break;
      }
  }

  foreach ($pasaran as $key => $val) {
      if ($r['pasaran'] == $key) {
          $r['pasaran_val'] = $val;
          break;
      }
  }

  return $r['hari'].' '.$r['pasaran'];
}