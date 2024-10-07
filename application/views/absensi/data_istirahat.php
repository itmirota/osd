<div class="d-flex flex-wrap justify-content-center">
<div class="col-10">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-end mb-4" >
        <h3><?= $datenow ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div id="map" style="width: 100%; height: 50vh;"></div>
        </div>
      </div>
      <div class="col-sm-12 d-flex flex-wrap">
        <div class="d-flex flex-column justify-content-center mb-3 flex-fill">
            <div class="p-2 d-flex justify-content-center"><h3><b>Istirahat</b></h3></div>
            <div class="p-2 d-flex justify-content-center">
                <a href="#" onclick="getLocationOut()"><img src="<?= base_url('assets/images/log-out.png')?>" width="80px" alt="" srcset=""></a>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center mb-3 flex-fill">
            <div class="p-2 d-flex justify-content-center"><h3><b>Masuk</b></h3></div>
            <div class="p-2 d-flex justify-content-center">
              <a href="#" onclick="getLocationIn()"><img src="<?= base_url('assets/images/log-in.png')?>" width="80px" alt="" srcset=""></a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-10">
  <div class="card card-primary">
        <div class="card-body table-responsive no-padding">
          <table id="dataTable" class="table table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Waktu Keluar</th>
              <th class="text-center">Waktu Masuk</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            if(!empty($list_data))
            {
              foreach($list_data as $ld){
              $selisihkeluar  = strtotime($ld->time_out) - strtotime('12:00:00');  
              $selisihmasuk  = strtotime($ld->time_in) - strtotime($ld->time_out);
            ?>
              <tr>
                <td><?= $no++?></td>
                <td class="text-center"><?= mediumdate_indo($ld->date)?></td>
                <td class="text-center"><?= $ld->time_out?>
                </td>
                <td class="text-center" style="color:<?= ($selisihmasuk > 3600) ? 'red' : 'green' ?>">
                  <?php if (isset($ld->time_in)){ ?>
                  <?= $ld->time_in?>
                  <?php }else{ ?>
                  <span class="badge text-bg-secondary">belum absen</span> 
                  <?php } ?>
                </td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>
</div>

<!-- jQuery 3 -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
$(document).ready(function() {

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
}


function showPosition(position) {
  const lat =  position.coords.latitude;
  const long = position.coords.longitude;
  const map = L.map('map').setView([-7.779383571804818, 110.43408080373274], 18).invalidateSize();
  
  const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  const marker = L.marker([lat, long]).addTo(map);

  const circle = L.circle([-7.779383571804818, 110.43408080373274], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 65
  }).addTo(map);
}

});

function getLocationIn() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPositionIn);
  }
}

function showPositionIn(position) {
  const lat =  position.coords.latitude;
  const long = position.coords.longitude;
  TapIn(lat, long);
}

function TapIn(lat, long){
  $.ajax({
    url:"<?php echo site_url("absensi/cekJarak")?>",
    dataType:"JSON",
    type: "POST",
    data:{lat : lat, long : long},
    success:function(hasil){
      if(hasil > 650){
        Swal.fire({
          icon: "error",
          title: "DILUAR AREA !!",
          text: "lokasi anda "+hasil+" di luar area PT. Mirota KSM",
          position: "center",
          showConfirmButton: false,
          timer: 3000
        })
      }else{
        window.location.href="<?php echo base_url(); ?>istirahat/masuk";
      }
    }
  })
}

function getLocationOut() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPositionOut);
  }
}

function showPositionOut(position) {
  const lat =  position.coords.latitude;
  const long = position.coords.longitude;
  TapOut(lat, long);
}

function TapOut(lat, long){
  $.ajax({
    url:"<?php echo site_url("absensi/cekJarak")?>",
    dataType:"JSON",
    type: "POST",
    data:{lat : lat, long : long},
    success:function(hasil){
      if(hasil > 650){
        Swal.fire({
          icon: "error",
          title: "DILUAR AREA !!",
          text: "lokasi anda "+hasil+" kamu berada di luar area PT. Mirota KSM",
          position: "center",
          showConfirmButton: false,
          timer: 3000
        })
      }else{
        window.location.href="<?php echo base_url(); ?>istirahat/keluar";
      }
    }
  })
}
</script>