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
  <div class="d-flex">
    <div class="col-md-12">
      <div class="card card-dashboard">
        <div class="card-body d-flex flex-wrap align-items-center">
            <div class="p-2">
              <img class="imageheader" src="<?= base_url('assets/dist/img/mirotaksm.png')?>" alt="" srcset="">
            </div>
            <div class="p-2 d-flex flex-wrap flex-fill">
              <div class="flex-fill">
                <div class="mb-3 row">
                  <label for="namaPegawai" class="col-5 col-form-label">Nama Pegawai</label>
                  <div class="col-6">
                    <input type="text" readonly class="form-control-plaintext" id="namaPegawai" value=": <?= $name ?>">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="divisiPegawai" class="col-5 col-form-label">Divisi</label>
                  <div class="col-6">
                    <input type="text" readonly class="form-control-plaintext" id="divisiPegawai" value=": <?= $pegawai->nama_divisi?>">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="tglBergabung" class="col-5 col-form-label">Tanggal Bergabung</label>
                  <div class="col-6">
                    <input type="text" readonly class="form-control-plaintext" id="tglBergabung" value=": <?= mediumdate_indo($pegawai->tgl_masuk)?>">
                  </div>
                </div>
              </div>
              <div class="flex-fill">
                <div class="mb-3 row">
                  <label for="SisaCuti" class="col-5 col-form-label">Kuota Cuti</label>
                  <div class="col-6">
                    <input type="text" readonly class="form-control-plaintext" id="SisaCuti" value=": <?= $pegawai->kuota_cuti+$pegawai->sisa_cuti?>">
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
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

    <div class="col-3 m-1">
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
    </div>

    <?php if($divisi_id >= 16){ ?>
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

  <div class="d-flex flex-row justify-content-start">
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
  </div>
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
            <p class="text text-start"><i class="fa fa-solid fa-building"></i> Aula PT Mirota KSM</p>
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
            <p class="text d-flex justify-content-center m-0 mb-3"> 15 November 2024</p>
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
 