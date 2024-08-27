<div class="d-flex justify-content-center mt-4">
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
                  <a href="<?= base_url('PHL/kehadiran/masuk')?>" ><img src="<?= base_url('assets/images/log-in.png')?>" width="80px" alt="" srcset=""></a>
              </div>
          </div>
          <div class="d-flex flex-column justify-content-center mb-3 flex-fill">
              <div class="p-2 d-flex justify-content-center"><h3><b>Pulang</b></h3></div>
              <div class="p-2 d-flex justify-content-center">
                  <a href="<?= base_url('PHL/kehadiran/pulang')?>"><img src="<?= base_url('assets/images/log-out.png')?>" width="80px" alt="" srcset=""></a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>