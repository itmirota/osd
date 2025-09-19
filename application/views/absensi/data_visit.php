<main class="p-3">
<div class="d-flex flex-wrap justify-content-center">
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
                <a href="<?= base_url('Absensi-visit/masuk')?>" ><img src="<?= base_url('assets/images/log-in.png')?>" width="80px" alt="" srcset=""></a>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center mb-3 flex-fill">
            <div class="p-2 d-flex justify-content-center"><h3><b>Keluar</b></h3></div>
            <div class="p-2 d-flex justify-content-center">
              <a href="<?= base_url('Absensi-visit/pulang')?>"><img src="<?= base_url('assets/images/log-out.png')?>" width="80px" alt="" srcset=""></a>
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
              <th class="text-center">Waktu Masuk</th>
              <th class="text-center">Waktu Keluar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            if(!empty($list_data))
            {
              foreach($list_data as $ld):
            ?>
              <tr>
                <td><?= $no++?></td>
                <td class="text-center"><?= mediumdate_indo($ld->date)?></td>
                <td class="text-center"><?= $ld->time_in?>
                </td>
                <td class="text-center">
                  <?php if (isset($ld->time_out)){ ?>
                  <?= $ld->time_out?>
                  <?php }else{ ?>
                  <span class="badge text-bg-secondary">belum absen</span> 
                  <?php } ?>
                </td>
              </tr>
              <?php
              endforeach;
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>
</div>
</main>


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