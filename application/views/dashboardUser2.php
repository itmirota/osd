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
<main class="p-3">
<div class="container main-page">
  <h4 class="font-dark"><strong>Selamat <?=nama_waktu(DATE('H'))?>, <?=$name?> !</strong></h4>
  <div class="row">
    <div class="col-12">
      <div class="card card-dashboard2">
        <div class="card-body">
          <div class="d-flex flex-wrap justify-content-between">
            <div class="p-1">
              <div class="d-flex">
                <div class="flex-grow-1">
                  <h4 class="font-light"><strong><?= $name ?></strong></h4>
                  <p class="font-light m-0"><?= $pegawai->nama_divisi." / ".$pegawai->nama_bagian ?></p>
                  <p class="font-light m-0"><?= $pegawai->nama_areakerja ?></p>
                </div>
              </div>
            </div>
            <div class="p-1">
              <div class="d-flex">
                <div class="flex-grow-1">
                  <!-- <h4 class="font-light"><strong>Kuota Cuti</strong></h4>
                  <p class="font-light m-0"><strong><?= $pegawai->kuota_cuti ?></strong></p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- OLD MENU -->
    <!-- <h3 class="font-dark">Menu</h3>
    <div class="col-12">
      <div class="row" >
        <div class="col-3">
          <a href="<?= base_url('peminjaman') ?>">
          <div class="card menu">
            <div class="card-body">
              <img class="mb-2" width="40" height="40" src="<?= base_url('assets/images/process.png')?>">
              <h4 class="font-dark m-0"><strong>peminjaman</strong></h4>
            </div> 
          </div>
          </a>
        </div>
        <div class="col-3">
          <a href="<?= base_url('peminjaman') ?>">
          <div class="card menu">
            <div class="card-body">
              <img class="mb-2" width="40" height="40" src="<?= base_url('assets/images/camera.png')?>">
              <h4 class="font-dark m-0"><strong>Presensi</strong></h4>
            </div> 
          </div>
          </a>
        </div>
        <div class="col-3">      
          <div class="card menu">
            <div class="card-body">
              <img class="mb-2" width="40" height="40" src="<?= base_url('assets/images/rest.png')?>">
              <h4 class="font-dark m-0"><strong>Istirahat</strong></h4>
            </div> 
          </div>
        </div>
      </div>
    </div> -->
    <!-- OLD MENU -->

    <!-- Menu -->
    <div class="mt-2 mb-2">
      <h3 class="font-dark"> Layanan OSD</h3>
      <p class="mt-1 font-dark">Layanan yang bisa kamu manfaatkan, seperti pengajuan izin, peminjaman, absensi</p>
    </div>
    <div class="d-flex flex-wrap flex-row">
      <div class="col-3">
        <a href="<?= base_url('peminjaman') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <img class="img-menu" src="<?= base_url('assets/images/process.png')?>">
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Peminjaman
            </p>
          </div>
        </a>
      </div>
      <!-- <div class="col-3">
        <a href="<?= base_url('perizinan') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <img class="img-menu" src="<?= base_url('assets/images/folder.png')?>">
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Perizinan
            </p>
          </div>
        </a>
      </div> -->
      <div class="col-3">
        <a href="" data-bs-toggle="modal" data-bs-target="#addPengirimanPaket">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <img class="img-menu" src="<?= base_url('assets/images/truck.png')?>">
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Pengiriman Paket
            </p>
          </div>
        </a>
      </div>
      <?php if($penempatan_id != 1){ ?>
      <div class="col-3">
        <a href="<?= base_url('Absensi-visit') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <img class="img-menu" src="<?= base_url('assets/images/camera.png')?>">
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Absen Visit
            </p>
          </div>
        </a>
      </div>

      <div class="col-3">
        <a href="<?= base_url('absen-toko') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <img class="img-menu" src="<?= base_url('assets/images/take_picture.png')?>">
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Absen Toko Manual
            </p>
          </div>
        </a>
      </div>
      <?php }else{?>
      <div class="col-3">
        <a href="<?= base_url('absensi') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <img class="img-menu" src="<?= base_url('assets/images/camera.png')?>">
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Absen Online
            </p>
          </div>
        </a>
      </div>

      <div class="col-3">
        <a href="<?= base_url('istirahat') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <img class="img-menu" src="<?= base_url('assets/images/rest.png')?>">
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Absen Istirahat
            </p>
          </div>
        </a>
      </div>
      <?php } ?>

      <div class="col-3">
        <a href="<?= base_url('PenilaianAssessment') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <svg class="img-menu" fill=" #0d66ba" width="139px" height="139px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M716.582 133c212.77 0 385.853 173.192 385.853 385.852v110.244c0 116.747-53.138 220.266-135.38 291.042 59.642 7.276 119.284 16.316 178.154 28.774 166.798 35.057 287.956 194.139 287.956 378.245v211.888l-22.49 16.426c-120.937 88.746-367.22 232.393-694.974 232.393-17.309 0-34.837-.44-52.587-1.212-288.727-13.56-507.781-133.174-640.735-231.18L0 1538.934v-211.888c0-184.107 121.268-343.188 288.287-378.245 58.539-12.348 117.85-21.829 177.381-28.994-82.02-70.887-134.938-174.185-134.938-290.712V518.852C330.73 306.192 503.813 133 716.582 133Zm405.917 923.73c-149.931-31.64-304.162-45.751-455.416-41.782-119.173 2.976-239.008 17.087-356.086 41.672-116.307 24.474-200.754 138.245-200.754 270.427v155.774c122.15 85.439 312.54 182.122 558.053 193.698 303.39 14.552 532.035-108.59 654.625-193.808v-155.554c0-132.292-84.336-245.953-200.422-270.427ZM625.08 518.852c-38.695 0-55.342 15.324-82.903 40.68-23.702 21.938-53.909 49.61-101.203 62.398v7.166c0 152.025 123.583 275.608 275.608 275.608 152.026 0 275.61-123.583 275.61-275.608v-45.2c-29.326 23.261-68.242 45.2-127.883 45.2-81.69 0-125.568-40.35-157.648-69.785-27.23-25.245-43.657-40.459-81.58-40.459ZM1842.058 307.66 1920 385.6l-431.713 431.713-235.37-235.37 77.942-77.942 157.428 157.428 353.77-353.771ZM716.582 243.243c-145.3 0-263.481 113.441-273.624 256.206 7.717-5.953 15.545-12.678 24.474-20.946 32.081-29.435 75.958-69.894 157.648-69.894 80.92 0 124.575 40.238 156.326 69.563 27.56 25.356 44.207 40.68 82.903 40.68 37.593 0 53.798-15.103 80.918-40.129 11.025-10.142 22.82-20.946 36.491-30.978-31.64-117.41-137.915-204.502-265.136-204.502Z" fill-rule="evenodd"></path> </g></svg>
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Assessment 360°
            </p>
          </div>
        </a>
      </div>
      
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
    <!-- <h3 class="font-dark">Info Mirota</h3>
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
    </div> -->
  </div>
</div>
</main>

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
<!-- Modal -->
<div class="modal fade" id="addPengirimanPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('kirimpaket')?>" role="form" id="addPengirimanPaket" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="tgl_kirim" class="form-label">tanggal pengiriman</label>
              <input type="date" name="tgl_kirim" class="form-control tabel-PR" required/>
            </div> 
            <div class="col-md-12">
              <label for="deskripsi_paket" class="form-label">Deskripsi Paket</label>
              <textarea  class="form-control tabel-PR" name="deskripsi_paket" cols="30" rows="5" required></textarea>
            </div> 
            <div class="col-md-12">
              <label for="nama_penerima" class="form-label">Nama Penerima</label>
              <input type="text" name="nama_penerima" placeholder="Nama penerima" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="ekspedisi" class="form-label">Nama Ekspedisi</label>
              <input type="text" name="ekspedisi" placeholder="Nama Ekspedisi" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="alamat_penerima" class="form-label">Alamat Penerima</label>
              <textarea  class="form-control tabel-PR" name="alamat_penerima" cols="30" rows="5" required></textarea>
            </div> 
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
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
 