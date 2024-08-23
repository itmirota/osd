<div class="d-flex justify-content-center">
<div class="col-10">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-end mb-4" >
        <h3><?= $datenow ?></h3>
      </div>
        <div class="col-sm-12 d-flex flex-wrap">
          <div class="d-flex flex-column justify-content-center mb-3 flex-fill">
              <div class="p-2 d-flex justify-content-center"><h3><b>Masuk</b></h3></div>
              <div class="p-2 d-flex justify-content-center">
                <?php if($time_in == '') { ?>
                  <a href="<?= base_url('kehadiran/masuk')?>" ><img src="<?= base_url('assets/images/log-in.png')?>" width="80px" alt="" srcset=""></a>
                <?php } else { ?> 
                  <?= $time_in?>
                <?php } ?>
              </div>
          </div>
          <div class="d-flex flex-column justify-content-center mb-3 flex-fill">
              <div class="p-2 d-flex justify-content-center"><h3><b>Pulang</b></h3></div>
              <div class="p-2 d-flex justify-content-center">
                <?php if($time_out == '' || is_null($time_out)) { ?>
                  <a href="<?= base_url('kehadiran/pulang')?>"><img src="<?= base_url('assets/images/log-out.png')?>" width="80px" alt="" srcset=""></a>
                <?php } else { ?> 
                  <?= $time_out?>
                <?php } ?>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
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
      if(hasil > 5000){
        Swal.fire({
          icon: "error",
          title: "DILUAR AREA !!",
          text: "kamu berada di luar area PT. Mirota KSM",
          position: "center",
          showConfirmButton: false,
          timer: 3000
        })
      }else{
        $.ajax({
          url:"<?php echo site_url("absensi/saveIn")?>",
          dataType:"JSON",
          type: "POST",
          data:{lat : lat, long : long},
          success:function(hasil){
            location.reload();
          }
        })
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
      if(hasil > 50){
        Swal.fire({
          icon: "error",
          title: "DILUAR AREA !!",
          text: "kamu berada di luar area PT. Mirota KSM",
          position: "center",
          showConfirmButton: false,
          timer: 3000
        })
      }else{
        $.ajax({
          url:"<?php echo site_url("absensi/saveOut")?>",
          dataType:"JSON",
          type: "POST",
          data:{lat : lat, long : long},
          success:function(hasil){
            location.reload();
          }
        })
      }
    }
  })
}
</script>