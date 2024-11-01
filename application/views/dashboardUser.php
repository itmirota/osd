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
  <div class="d-flex flex-row justify-content-center p-4">
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
  <!-- Menu -->
</div>
 