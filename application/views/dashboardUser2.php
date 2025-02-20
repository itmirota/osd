<style>
.event{
  background: rgb(18,11,63);
  background: linear-gradient(180deg, rgba(18,11,63,1) 0%, rgba(20,39,98,1) 24%, rgba(26,109,187,1) 49%, rgba(18,17,70,1) 77%, rgba(18,17,70,1) 93%);
}

.event .headertext{
  color:#fff;
  font-size:32px;
  font-weight:bold;
}

.btn-event{
  background-color:#ebbc0d;
  color:rgb(18,11,63);
}

.event .theme{
  font-size: 24px;
  background: linear-gradient(37deg, rgba(244,198,10,1) 24%, rgba(218,176,6,1) 34%, rgba(218,176,6,1) 57%, rgba(244,198,10,1) 70%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.event .subheadertext{
  color:#fff;
  font-size:18px;
}

.event .text{
  color:#fff;
  text-align:center;
}

.event .img-qrcode{
  /* width: 10px; */
}
</style>

<div class="container">
  <h4 class="font-dark"><strong>Selamat <?=nama_waktu(DATE('H'))?>, <?=$name?> !</strong></h4>
  <div class="row">
    <div class="col-12">
      <div class="card card-dashboard2">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <p class="font-light" style="font-size:20px"><i class="fa fa-solid fa-user"></i></p>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h4 class="font-light"><strong><?= $name ?></strong></h4>
                  <h6 class="font-light"><?= $pegawai->nama_divisi ?></h6>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="d-flex">
                <div class="flex-grow-1 ms-3">
                  <h4 class="font-light"><strong>Kuota Cuti</strong></h4>
                  <h6 class="font-light">0</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h3 class="font-dark"><strong>Info Mirota</strong></h3>
    <div class="col-12">
      <div class="loop owl-carousel owl-theme">
        <div class="item">
          <h4>1</h4>
        </div>
        <div class="item">
          <h4>2</h4>
        </div>
        <div class="item">
          <h4>3</h4>
        </div>
        <div class="item">
          <h4>4</h4>
        </div>
        <div class="item">
          <h4>5</h4>
        </div>
        <div class="item">
          <h4>6</h4>
        </div>
        <div class="item">
          <h4>7</h4>
        </div>
        <div class="item">
          <h4>8</h4>
        </div>
        <div class="item">
          <h4>9</h4>
        </div>
        <div class="item">
          <h4>10</h4>
        </div>
        <div class="item">
          <h4>11</h4>
        </div>
        <div class="item">
          <h4>12</h4>
        </div>
      </div>
    </div>
    <h3 class="font-dark"><strong>Menu</strong></h3>
    <div class="col-12">
      <div class="row">
        <div class="col-6">
          <a href="<?= base_url('peminjaman') ?>">
          <div class="card menu">
            <div class="card-body">
              <img class="mb-2" width="40" height="40" src="<?= base_url('assets/images/process.png')?>">
              <h4 class="font-dark m-0"><strong>peminjaman</strong></h4>
            </div> 
          </div>
          </a>
        </div>
        <div class="col-6">
          <a href="<?= base_url('peminjaman') ?>">
          <div class="card menu">
            <div class="card-body">
              <img class="mb-2" width="40" height="40" src="<?= base_url('assets/images/camera.png')?>">
              <h4 class="font-dark m-0"><strong>Presensi</strong></h4>
            </div> 
          </div>
          </a>
        </div>
        <div class="col-6">      
          <div class="card menu">
            <div class="card-body">
              <img class="mb-2" width="40" height="40" src="<?= base_url('assets/images/rest.png')?>">
              <h4 class="font-dark m-0"><strong>Istirahat</strong></h4>
            </div> 
          </div>
        </div>
      </div>

    </div>

    <!-- <div class="col-12">
      <h4 class="font-dark"><strong>Info Mirota</strong></h4>
      <div class="card" style="background-color:grey; height:100px"></div>
    </div> -->
  </div>

  <!-- Menu -->
  <div class="text-judul mt-2 mb-2">
    <h3 class="m-0"> Layanan OSD</h3>
    <p style="font-size:12px" class="m-0 mt-1">Layanan yang bisa kamu manfaatkan, seperti pengajuan izin, peminjaman, absensi</p>
  </div>
  <div class="d-flex flex-row justify-content-center p-4 pb-1">
    <div class="col-3 m-1">
      <a href="<?= base_url('peminjaman') ?>">
        <div class="d-flex flex-column">
          <div class="d-flex justify-content-center mb-2">
            <img class="img-menu" src="<?= base_url('assets/images/process.png')?>">
          </div>
          <div class="d-flex justify-content-center text-header">
            Peminjaman
          </div>
        </div>
      </a>
    </div>

    <!-- <div class="col-3 m-1">
      <a href="<?= base_url('perizinan') ?>">
        <div class="d-flex flex-column">
          <div class="d-flex justify-content-center mb-2">
            <img class="img-menu" src="<?= base_url('assets/images/folder.png')?>">
          </div>
          <div class="d-flex justify-content-center text-header">
            Perizinan
          </div>
        </div>
      </a>
    </div> -->

    <?php if($divisi_id >= 16 && $divisi_id <= 31){ ?>
    <div class="col-3 m-1">
      <a href="<?= base_url('Absensi-visit') ?>">
        <div class="d-flex flex-column">
          <div class="d-flex justify-content-center mb-2">
            <img class="img-menu" src="<?= base_url('assets/images/camera.png')?>">
          </div>
          <div class="d-flex justify-content-center text-header">
            Absensi Visit
          </div>
        </div>
      </a>
    </div>

    <div class="col-3 m-1">
      <a href="<?= base_url('absen-toko') ?>">
        <div class="d-flex flex-column">
          <div class="d-flex justify-content-center mb-2">
            <img class="img-menu" src="<?= base_url('assets/images/take_picture.png')?>">
          </div>
          <div class="d-flex justify-content-center text-header">
            Absen Manual Toko
          </div>
        </div>
      </a>
    </div>
    <?php }else{?>
    <div class="col-3 m-1">
      <a href="<?= base_url('absensi') ?>">
        <div class="d-flex flex-column">
          <div class="d-flex justify-content-center mb-2">
            <img class="img-menu" src="<?= base_url('assets/images/camera.png')?>">
          </div>
          <div class="d-flex justify-content-center text-header">
            Absensi Online
          </div>
        </div>
      </a>
    </div>

    <div class="col-3 m-1">
      <a href="<?= base_url('istirahat') ?>">
        <div class="d-flex flex-column">
          <div class="d-flex justify-content-center mb-2">
            <img class="img-menu" src="<?= base_url('assets/images/rest.png')?>">
          </div>
          <div class="d-flex justify-content-center text-header">
            Absensi Istirahat
          </div>
        </div>
      </a>
    </div>
    <?php } ?>
    
  </div>

  <!-- <div class="d-flex flex-row justify-content-start">
    <div class="col-3 m-1">
      <a data-bs-toggle="modal" data-bs-target="#DaftarHadir">
        <div class="d-flex flex-column">
          <div class="d-flex justify-content-center mb-2">
            <img class="img-menu" src="<?= base_url('assets/images/logo51.png')?>">
          </div>
          <div class="d-flex justify-content-center text-header">
            HUT 51 MIROTA
          </div>
        </div>
      </a>
    </div>
  </div> -->
  <!-- Menu -->
</div>

<!-- MODAL DAFTAR HADIR -->
<!-- Modal -->
<div class="modal fade" id="DaftarHadir" tabindex="-1" aria-labelledby="DaftarHadirLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">HUT ke 51 PT. Mirota KSM</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="event mb-2 p-4" id="konfirmasi" style="display:<?= isset($event) ? 'none' : 'block' ?>">
            <div class="d-flex justify-content-center">
              <div class="p-2">
                <img width=80px src="<?= base_url('assets/dist/img/logo51.png') ?>" alt="" srcset="">
              </div>
            </div>
            <!-- <h2 class="subheadertext d-flex justify-content-center m-0">PERAYAAN HUT ke 51</h2>
            <h1 class="headertext d-flex justify-content-center">PT MIROTA KSM</h1> -->
            <div class="d-flex justify-content-center mt-4 mb-4">
            <img style="width:100%" src="<?= base_url('assets/images/tema51.png') ?>" alt="" srcset="">
            </div>
            <div class="d-flex justify-content-center">
            <div class="col-md-5">
            <p class="text text-start m-0"><i class="fa fa-solid fa-calendar"></i> 15 November 2024</p>
            <p class="text text-start m-0"><i class="fa fa-solid fa-clock"></i> 13:00 WIB - 17:00 WIB</p>
            <p class="text text-start"><i class="fa fa-solid fa-building"></i> Ruang Aula 2 / Ruang Makan Lt. 2</p>
            </div>
            </div>
            <p class="text">Tak terasa perusahaan kita sebentar lagi menginjak 51 tahun. banyak tantangan dan rintangan yang sudah kita lewati bersama, ikut sertamu dalam acara ulang tahun ini sangat dinantikan. akan ada banyak hadiah menarik yang bisa kamu bawa pulang. yuk segera konfirmasi kehadiranmu.</p>
            <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-event" onclick="kehadiran(<?= $this->pegawai_id ?>)">Yaps, Pasti Hadir</button>
            </div>
        </div>
        <div class="event mb-4" id="qrcode" style="display:<?= isset($event) ? 'block' : 'none' ?>">
          <div class="d-flex justify-content-center">
            <div class="p-2 mt-4">
              <img width=80px src="<?= base_url('assets/dist/img/logo51.png') ?>" alt="" srcset="">
            </div>
          </div>
          <div class="d-flex flex-column mb-3">
            <!-- <h2 class="subheadertext d-flex justify-content-center m-0 mt-4">Perayaan HUT ke 51</h2>
            <h1 class="headertext d-flex justify-content-center">PT MIROTA KSM</h1> -->
            <div class="d-flex justify-content-center mt-4 mb-4">
            <img style="width:80%" src="<?= base_url('assets/images/tema51.png') ?>" alt="" srcset="">
            </div>
            <div class="img-qrcode d-flex justify-content-center mb-3" style="display:<?= isset($event) ? 'none' : 'block' ?>">
              <img class="img-qrcode" id="image_qrcode" src="<?= isset($event) ? base_url('assets/images/qrcode/HUT51/').$event->data_qrcode :''?>" alt="<?= isset($event) ? $event->data_qrcode : ''?>">
            </div>
            <p class="text d-flex justify-content-center m-0"> 15 November 2024</p>
            <p class="text d-flex justify-content-center m-0 mb-3">13:00 WIB - 17:00 WIB</p>
            <div class="info d-flex justify-content-center">
              <p class="text p-4 pt-0">Harap Screenshoot layar ini dan tunjukkan kepada panitia sebagai daftar kehadiran</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function kehadiran($id){
  $.ajax({
    url:"<?php echo site_url("DaftarHadir/simpanDaftarHadir")?>/" + $id,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      document.getElementById("konfirmasi").style.display = "none";
      document.getElementById("qrcode").style.display = "block";
      document.getElementById("image_qrcode").src = "<?= base_url('assets/images/qrcode/HUT51/')?>"+ hasil.data_qrcode;
    }
  });
}
</script>
 