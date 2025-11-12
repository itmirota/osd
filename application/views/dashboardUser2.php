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
      <?php 
      if($penempatan_id != 1){ ?>
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
      <?php if($this->jabatan_id == 5){ ?> 
      <div class="col-3">
        <a href="<?= base_url('absensi') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <svg  class="img-menu" width="163px" height="163px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione-monotone" preserveAspectRatio="xMidYMid meet" fill="#0d66ba"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><circle cx="11.549" cy="31.205" r=".574" fill="#0d66ba"></circle><path d="M58.264 25.619h-1.162l.001-.54a2.473 2.473 0 0 0-2.366-2.452h-.017l-.065-.001c-.631 0-1.223.246-1.666.693a2.346 2.346 0 0 0-.684 1.665l-.002 9.183c0 .816.368 1.539.939 2.039a677.441 677.441 0 0 0-1.713 3.525a837.771 837.771 0 0 0-1.805-3.711c-.428-.875-1.566-1.813-3.479-1.813h-5.41l-.043.166h-.332a1.635 1.635 0 0 1-1.075-1.555v-.481c3.874-1.349 8.517-4.73 9.354-9.151c1.399-.254 2.871-1.165 2.871-3.865c0-2.486-.967-3.193-1.766-3.36c-.098-9.756-2.578-13.892-13.562-13.958c-11.093-.13-14.034 4.19-14.153 14.071c-.703.301-1.41 1.122-1.41 3.247c0 2.699 1.471 3.61 2.869 3.865c.834 4.41 5.455 7.786 9.324 9.142v.49c0 .729-.452 1.338-1.073 1.555h-.337l-.043-.166h-5.833c-1.817 0-2.769 1-3.28 1.537l-5.035 5.27V27.76c0-.633-.52-1.149-1.153-1.149H6.939c-.635 0-1.153.516-1.153 1.149v12.335a2.793 2.793 0 0 0-.384-.029c-1.161 0-2.402.623-2.402 2.368v9.262a2.808 2.808 0 0 0 2.811 2.799h4.296c.3 0 .583-.061.854-.146c2.29-.184 3.204-1.119 3.879-1.826l.064-.068l1.157-1.211l9.002-9.42l-.004 17.283v.596l.524.285c.154.08 3.78 2.012 10.564 2.012c6.772 0 10.407-1.93 10.56-2.012l.525-.285V44.941l.219.451c.395.838 1.695 2.439 3.769 2.441h.246c.706-.016 2.997-.232 4.091-2.346l.047-.059l.035-.105l4.09-8.43l.337-.693c.569-.5.935-1.223.935-2.035v-5.821a2.736 2.736 0 0 0-2.737-2.725m-43.528 2.626c0-.158.128-.287.288-.287h.576c.159 0 .288.129.288.287v.574a.288.288 0 0 1-.288.287h-.576a.287.287 0 0 1-.288-.287v-.574m-2.828 23.45a1.8 1.8 0 0 1-1.801 1.795H5.811a1.8 1.8 0 0 1-1.802-1.795v-9.262c0-1.057.666-1.33 1.272-1.359l.025 1.063h4.801c.993 0 1.801.807 1.801 1.797v7.761m-.359-19.341a1.15 1.15 0 0 1-1.152-1.149a1.152 1.152 0 0 1 2.304 0c0 .635-.517 1.149-1.152 1.149m2.627 19.406c-.411.43-.834.889-1.581 1.209c.199-.385.322-.813.322-1.273V49.58h3.241c.045 0 .083-.021.127-.025c-.67.699-1.372 1.435-2.109 2.205m10.479-29.157l-.06-.454l-.455-.042c-1.574-.147-2.275-1.006-2.275-2.786c0-1.505.355-2.267 1.057-2.267l.102.003c.113.606.228.973.354 1.172c.376.77 1.104 1.109 1.186 1.145l.943.418l-.145-1.023a15.898 15.898 0 0 1-.102-2.566c.338-5.019.68-5.44 1.645-5.44c.484 0 1.156.132 2.009.299c1.665.328 3.948.776 7.251.776c3.305 0 5.586-.448 7.253-.776c.851-.167 1.522-.299 2.007-.299c.965 0 1.305.422 1.642 5.424a16.11 16.11 0 0 1-.101 2.583l-.146 1.024l.945-.419c.081-.036.806-.375 1.159-1.098c.146-.241.262-.606.379-1.22c.793-.049 1.162.689 1.162 2.264c0 1.779-.703 2.639-2.277 2.786l-.456.042l-.06.454c-.733 5.65-8.449 9.234-11.508 9.234c-3.06-.001-10.776-3.585-11.509-9.234m7.356 12.774l.163-.057c1.045-.365 1.746-1.371 1.746-2.502v-.18c.82.22 1.588.343 2.244.343c.647 0 1.404-.121 2.213-.336v.173c0 1.131.703 2.137 1.75 2.502l.162.057h.209c-.531 1.346-2.846 2.258-4.351 2.258c-1.509 0-3.824-.912-4.353-2.258h.217m22.694 9.564a.042.042 0 0 1-.006.008c-.816 1.684-2.604 1.867-3.233 1.881h-.245c-1.938-.002-2.839-1.826-2.861-1.873c-.463-.961-1.297-2.678-2.135-4.406l-.002 18.555s-3.482 1.891-10.075 1.891c-6.604 0-10.077-1.891-10.077-1.891l.004-19.795a31777.01 31777.01 0 0 1-8.777 9.184c.001-.021.013-.041.013-.063v-5.961c1.645-1.721 3.535-3.699 5.742-6.012c.487-.51 1.168-1.25 2.573-1.25h5.048c.498 1.967 3.314 3.428 5.474 3.428c2.161 0 4.972-1.461 5.473-3.428h4.626c1.406 0 2.27.631 2.571 1.25a794.951 794.951 0 0 1 2.712 5.598a715.134 715.134 0 0 1 2.582-5.336c.292.105.602.172.929.172h3.224c.125 0 .244-.021.364-.037l-3.924 8.085m5.287-10.775c0 .947-.779 1.723-1.729 1.723H55.04c-.95 0-1.729-.775-1.729-1.723l.002-9.183a1.344 1.344 0 0 1 1.39-1.353a1.463 1.463 0 0 1 1.392 1.449l-.001 1.543h2.171c.949 0 1.729.775 1.729 1.723v5.821z" fill="#0d66ba"></path><path d="M33.041 19.589c0-1.208-.965-2.148-2.159-2.148s-2.163.94-2.163 2.148c0 1.208.969 2.148 2.163 2.148s2.159-.94 2.159-2.148" fill="#0d66ba"></path><path d="M41.445 21.737c1.195 0 2.164-.94 2.164-2.148c0-1.208-.969-2.148-2.164-2.148s-2.16.94-2.16 2.148c0 1.208.965 2.148 2.16 2.148" fill="#0d66ba"></path><path d="M40.164 26.725s0-.381-.4-.381h-7.2c-.399 0-.399.381-.399.381c0 1.524 2 2.286 3.999 2.286c2-.001 4-.762 4-2.286" fill="#0d66ba"></path></g></svg>
            </div>
            <p class="font-dark caption-text" style="text-align:center">
              Absen Online
            </p>
          </div>
        </a>
      </div>
      <?php }else { ?>
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
      <?php } ?>

      <?php }else{?>
      <div class="col-3">
        <a href="<?= base_url('absensi') ?>">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-center mb-2">
              <svg  class="img-menu" width="163px" height="163px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione-monotone" preserveAspectRatio="xMidYMid meet" fill="#0d66ba"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><circle cx="11.549" cy="31.205" r=".574" fill="#0d66ba"></circle><path d="M58.264 25.619h-1.162l.001-.54a2.473 2.473 0 0 0-2.366-2.452h-.017l-.065-.001c-.631 0-1.223.246-1.666.693a2.346 2.346 0 0 0-.684 1.665l-.002 9.183c0 .816.368 1.539.939 2.039a677.441 677.441 0 0 0-1.713 3.525a837.771 837.771 0 0 0-1.805-3.711c-.428-.875-1.566-1.813-3.479-1.813h-5.41l-.043.166h-.332a1.635 1.635 0 0 1-1.075-1.555v-.481c3.874-1.349 8.517-4.73 9.354-9.151c1.399-.254 2.871-1.165 2.871-3.865c0-2.486-.967-3.193-1.766-3.36c-.098-9.756-2.578-13.892-13.562-13.958c-11.093-.13-14.034 4.19-14.153 14.071c-.703.301-1.41 1.122-1.41 3.247c0 2.699 1.471 3.61 2.869 3.865c.834 4.41 5.455 7.786 9.324 9.142v.49c0 .729-.452 1.338-1.073 1.555h-.337l-.043-.166h-5.833c-1.817 0-2.769 1-3.28 1.537l-5.035 5.27V27.76c0-.633-.52-1.149-1.153-1.149H6.939c-.635 0-1.153.516-1.153 1.149v12.335a2.793 2.793 0 0 0-.384-.029c-1.161 0-2.402.623-2.402 2.368v9.262a2.808 2.808 0 0 0 2.811 2.799h4.296c.3 0 .583-.061.854-.146c2.29-.184 3.204-1.119 3.879-1.826l.064-.068l1.157-1.211l9.002-9.42l-.004 17.283v.596l.524.285c.154.08 3.78 2.012 10.564 2.012c6.772 0 10.407-1.93 10.56-2.012l.525-.285V44.941l.219.451c.395.838 1.695 2.439 3.769 2.441h.246c.706-.016 2.997-.232 4.091-2.346l.047-.059l.035-.105l4.09-8.43l.337-.693c.569-.5.935-1.223.935-2.035v-5.821a2.736 2.736 0 0 0-2.737-2.725m-43.528 2.626c0-.158.128-.287.288-.287h.576c.159 0 .288.129.288.287v.574a.288.288 0 0 1-.288.287h-.576a.287.287 0 0 1-.288-.287v-.574m-2.828 23.45a1.8 1.8 0 0 1-1.801 1.795H5.811a1.8 1.8 0 0 1-1.802-1.795v-9.262c0-1.057.666-1.33 1.272-1.359l.025 1.063h4.801c.993 0 1.801.807 1.801 1.797v7.761m-.359-19.341a1.15 1.15 0 0 1-1.152-1.149a1.152 1.152 0 0 1 2.304 0c0 .635-.517 1.149-1.152 1.149m2.627 19.406c-.411.43-.834.889-1.581 1.209c.199-.385.322-.813.322-1.273V49.58h3.241c.045 0 .083-.021.127-.025c-.67.699-1.372 1.435-2.109 2.205m10.479-29.157l-.06-.454l-.455-.042c-1.574-.147-2.275-1.006-2.275-2.786c0-1.505.355-2.267 1.057-2.267l.102.003c.113.606.228.973.354 1.172c.376.77 1.104 1.109 1.186 1.145l.943.418l-.145-1.023a15.898 15.898 0 0 1-.102-2.566c.338-5.019.68-5.44 1.645-5.44c.484 0 1.156.132 2.009.299c1.665.328 3.948.776 7.251.776c3.305 0 5.586-.448 7.253-.776c.851-.167 1.522-.299 2.007-.299c.965 0 1.305.422 1.642 5.424a16.11 16.11 0 0 1-.101 2.583l-.146 1.024l.945-.419c.081-.036.806-.375 1.159-1.098c.146-.241.262-.606.379-1.22c.793-.049 1.162.689 1.162 2.264c0 1.779-.703 2.639-2.277 2.786l-.456.042l-.06.454c-.733 5.65-8.449 9.234-11.508 9.234c-3.06-.001-10.776-3.585-11.509-9.234m7.356 12.774l.163-.057c1.045-.365 1.746-1.371 1.746-2.502v-.18c.82.22 1.588.343 2.244.343c.647 0 1.404-.121 2.213-.336v.173c0 1.131.703 2.137 1.75 2.502l.162.057h.209c-.531 1.346-2.846 2.258-4.351 2.258c-1.509 0-3.824-.912-4.353-2.258h.217m22.694 9.564a.042.042 0 0 1-.006.008c-.816 1.684-2.604 1.867-3.233 1.881h-.245c-1.938-.002-2.839-1.826-2.861-1.873c-.463-.961-1.297-2.678-2.135-4.406l-.002 18.555s-3.482 1.891-10.075 1.891c-6.604 0-10.077-1.891-10.077-1.891l.004-19.795a31777.01 31777.01 0 0 1-8.777 9.184c.001-.021.013-.041.013-.063v-5.961c1.645-1.721 3.535-3.699 5.742-6.012c.487-.51 1.168-1.25 2.573-1.25h5.048c.498 1.967 3.314 3.428 5.474 3.428c2.161 0 4.972-1.461 5.473-3.428h4.626c1.406 0 2.27.631 2.571 1.25a794.951 794.951 0 0 1 2.712 5.598a715.134 715.134 0 0 1 2.582-5.336c.292.105.602.172.929.172h3.224c.125 0 .244-.021.364-.037l-3.924 8.085m5.287-10.775c0 .947-.779 1.723-1.729 1.723H55.04c-.95 0-1.729-.775-1.729-1.723l.002-9.183a1.344 1.344 0 0 1 1.39-1.353a1.463 1.463 0 0 1 1.392 1.449l-.001 1.543h2.171c.949 0 1.729.775 1.729 1.723v5.821z" fill="#0d66ba"></path><path d="M33.041 19.589c0-1.208-.965-2.148-2.159-2.148s-2.163.94-2.163 2.148c0 1.208.969 2.148 2.163 2.148s2.159-.94 2.159-2.148" fill="#0d66ba"></path><path d="M41.445 21.737c1.195 0 2.164-.94 2.164-2.148c0-1.208-.969-2.148-2.164-2.148s-2.16.94-2.16 2.148c0 1.208.965 2.148 2.16 2.148" fill="#0d66ba"></path><path d="M40.164 26.725s0-.381-.4-.381h-7.2c-.399 0-.399.381-.399.381c0 1.524 2 2.286 3.999 2.286c2-.001 4-.762 4-2.286" fill="#0d66ba"></path></g></svg>
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
 