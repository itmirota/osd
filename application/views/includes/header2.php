<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#0956AF">
	<meta name="author" content="Tri Cahya">
	<!-- <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"> -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/dist/img/favicon.png')?>">

	<link rel="preconnect" href="https://fonts.gstatic.com">

  <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">

	<link rel="shortcut icon" href="<?= base_url('assets/dist/img/favicon.png')?>" />

	<title><?= $pageTitle ?></title>

  <!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<!-- FontAwesome -->
	<script src="https://kit.fontawesome.com/2edfabd55a.js" crossorigin="anonymous"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

  <!-- Adminkit -->
	<link href="<?= base_url(); ?>assets/adminkit/css/app.css" rel="stylesheet">

	<!-- Style.css -->
	<link href="<?= base_url(); ?>assets/dist/css/style_v2.css" rel="stylesheet">
  
  <!-- FullCalendar -->
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  
  <!-- SELECT2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Owl Stylesheets -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/owlcarousel/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/owlcarousel/css/owl.theme.default.min.css">

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	
  <link rel="manifest" href="<?= base_url(); ?>/web.webmanifest"/>
	<script src="<?php echo base_url(); ?>assets/dist/js/register.js"></script>
</head>

<!-- <body class="sidebar-mini skin-black-light"> -->
<body class="theme-white">
<div>
  <?php if (isset($name)){?>
  <!-- Up Navbar -->
  <nav class="navbar navbar-dark bg-navbar navbar-expand mb-4">
    <div class="container">
    <ul class="navbar-nav justify-content-start w-100">
      <a class="navbar-brand" href="#">
        <img class="navbar-logo" src="<?= base_url('assets/dist/img/mirota.png')?>" alt="Logo" class="d-inline-block align-text-top">
      </a>
    </ul>
    <ul class="navbar-nav justify-content-end w-25 d-none d-md-block d-lg-block d-xl-block">
      <li class="nav-item">
        <div class="btn-group p-2">
					<button type="button" class="btn login-button dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
					<i class="fa-solid fa-circle-user"></i> Hi, <?= $name ?>
					</button>
					<ul class="dropdown-menu dropdown-menu-lg-end">
						<li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#detailPegawai" onclick="detailPegawai(<?= $pegawai_id?>)">User Info</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="<?= base_url('logout')?>">Keluar</a></li>
					</ul>
				</div>
      </li>
    </ul>
    </div>
  </nav>

  <!-- Bottom Navbar -->
  <nav class="navbar navbar-dark bg-navbar navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none">
    <ul class="navbar-nav nav-justified w-100">
      <li class="nav-item">
        <a href="<?= base_url('dashboardUser')?>" class="nav-link">
          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg>
        </a>
        <span class="text-light">Home</span>
      </li>
      <!-- <li class="nav-item">
        <a href="#" class="nav-link">
          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
          </svg>
        </a>
        <span class="text-light">Pinjam</span>
      </li> -->
      <!-- <li class="nav-item">
        <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-fingerprint" viewBox="0 0 16 16">
            <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
            <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332q0 .613-.066 1.221A.5.5 0 0 1 6 8.447q.06-.555.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8m-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329"/>
            <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334m.3 1.67a.5.5 0 0 1 .449.546 10.7 10.7 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.7 9.7 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
            <path d="M3.902 4.222a5 5 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 4 4 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556m6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705M3.68 5.842a.5.5 0 0 1 .422.568q-.044.289-.044.59c0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.5 6.5 0 0 0 3.058 7q0-.375.054-.736a.5.5 0 0 1 .568-.422m8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.5 10.5 0 0 0 .584-2.678.5.5 0 0 1 .54-.456"/>
            <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865m-.89 1.257a.5.5 0 0 1 .04.706A5.48 5.48 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346m12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49"/>
          </svg>
        </a>
        <span class="text-light">Kehadiran</span>
      </li> -->
      <li class="nav-item">
        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#detailPegawai" onclick="detailPegawai(<?= $pegawai_id?>)">
          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
          </svg>
        </a>
        <span class="text-light">info User</span>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('logout')?>" class="nav-link">
          <svg width="1.5em" height="1.5em" viewBox="-2.6 -2.6 25.20 25.20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" stroke-width="0.48"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="currentColor" d="M10.2392344,0 C13.3845587,0 16.2966635,1.39466883 18.2279685,3.74426305 C18.4595621,4.02601608 18.4134356,4.43777922 18.124942,4.66396176 C17.8364485,4.89014431 17.4148346,4.84509553 17.183241,4.5633425 C15.5035716,2.51988396 12.9739849,1.30841121 10.2392344,1.30841121 C5.32416443,1.30841121 1.33971292,5.19976806 1.33971292,10 C1.33971292,14.8002319 5.32416443,18.6915888 10.2392344,18.6915888 C13.0144533,18.6915888 15.5774656,17.443711 17.2546848,15.3485857 C17.4825482,15.0639465 17.9035339,15.0136047 18.1949827,15.2361442 C18.4864315,15.4586837 18.5379776,15.8698333 18.3101142,16.1544725 C16.3816305,18.5634688 13.4311435,20 10.2392344,20 C4.58426141,20 8.8817842e-14,15.5228475 8.8817842e-14,10 C8.8817842e-14,4.4771525 4.58426141,0 10.2392344,0 Z M17.0978642,7.15999289 L19.804493,9.86662172 C20.0660882,10.1282169 20.071043,10.5473918 19.8155599,10.802875 L17.17217,13.4462648 C16.9166868,13.701748 16.497512,13.6967932 16.2359168,13.435198 C15.9743215,13.1736028 15.9693667,12.7544279 16.2248499,12.4989447 L17.7715361,10.9515085 L7.46239261,10.9518011 C7.0924411,10.9518011 6.79253615,10.6589032 6.79253615,10.2975954 C6.79253615,9.93628766 7.0924411,9.64338984 7.46239261,9.64338984 L17.7305361,9.64250854 L16.1726778,8.08517933 C15.9110825,7.82358411 15.9061278,7.40440925 16.1616109,7.14892607 C16.4170941,6.89344289 16.836269,6.89839767 17.0978642,7.15999289 Z"></path> </g></svg>
        </a>
        <span class="text-light">Logout</span>
      </li>
    </ul>
  </nav>
  <?php } ?>
  
  <?php if($this->uri->segment(1) == 'satpam' | $this->uri->segment(1) == 'kebersihan' | $this->uri->segment(1) == 'PHL'){?>
  <?php } ?>
  <div class="container" style="min-height:105vh">


<!-- Modal Detail Pegawai-->
<div class="modal fade" id="detailPegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pegawai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <div class="mb-3 row">
              <label for="tempat_tglLahir" class="col-sm-4 col-form-label">Tempat, Tanggal Lahir</label>
              <div class="col-sm-8">
                <input type="text" id="tempat_tglLahir" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="shio" class="col-sm-4 col-form-label">Shio</label>
              <div class="col-sm-8">
                <input type="text" id="info_shio" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="zodiak" class="col-sm-4 col-form-label">Zodiak</label>
              <div class="col-sm-8">
                <input type="text" id="info_zodiak" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_weton" class="col-sm-4 col-form-label">Weton</label>
              <div class="col-sm-8">
                <input type="text" id="info_weton" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
              <div class="col-sm-8">
                <input type="text" id="info_jenis_kelamin" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_pendidikan_terakhir" class="col-sm-4 col-form-label">Pendidikan Terakhir</label>
              <div class="col-sm-8">
                <input type="text" id="info_pendidikan_terakhir" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_golongan_darah" class="col-sm-4 col-form-label">Golongan Darah</label>
              <div class="col-sm-8">
                <input type="text" id="info_golongan_darah" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_agama" class="col-sm-4 col-form-label">Agama</label>
              <div class="col-sm-8">
                <input type="text" id="info_agama" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_alamat_ktp" class="col-sm-4 col-form-label">Alamat KTP</label>
              <div class="col-sm-8">
                <textarea id="info_alamat_ktp" readonly class="form-control-plaintext"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_alamat_domisili" class="col-sm-4 col-form-label">Alamat domisili</label>
              <div class="col-sm-8">
                <textarea id="info_alamat_domisili" readonly class="form-control-plaintext"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_kontak" class="col-sm-4 col-form-label">Nomor</label>
              <div class="col-sm-8">
                <input type="text" id="info_kontak" readonly class="form-control-plaintext">
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3 row">
              <label for="info_ktp" class="col-sm-4 col-form-label">Nomor KTP</label>
              <div class="col-sm-8">
                <input type="text" id="info_ktp" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_kk" class="col-sm-4 col-form-label">Nomor KK</label>
              <div class="col-sm-8">
                <input type="text" id="info_kk" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_jamsostek" class="col-sm-4 col-form-label">Nomor Jamsostek</label>
              <div class="col-sm-8">
                <input type="text" id="info_jamsostek" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_bpjsKesehatan" class="col-sm-4 col-form-label">Nomor Bpjs Kesehatan</label>
              <div class="col-sm-8">
                <input type="text" id="info_bpjsKesehatan" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_npwp" class="col-sm-4 col-form-label">Nomor NPWP</label>
              <div class="col-sm-8">
                <input type="text" id="info_npwp" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_tgl_masuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
              <div class="col-sm-8">
                <input type="text" id="info_tgl_masuk" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_tgl_masuk" class="col-sm-4 col-form-label">Tanggal Selesai Kontrak</label>
              <div class="col-sm-8">
                <input type="text" id="info_tgl_selesai" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_durasi_kontrak" class="col-sm-4 col-form-label">Durasi Kontrak</label>
              <div class="col-sm-8">
                <input type="text" id="info_durasi_kontrak" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_email" class="col-sm-4 col-form-label">Email</label>
              <div class="col-sm-8">
                <input type="text" id="info_email" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_ibu" class="col-sm-4 col-form-label">Nama Ibu</label>
              <div class="col-sm-8">
                <input type="text" id="info_ibu" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_ayah" class="col-sm-4 col-form-label">Nama ayah</label>
              <div class="col-sm-8">
                <input type="text" id="info_ayah" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_pasangan" class="col-sm-4 col-form-label">Nama Pasangan</label>
              <div class="col-sm-8">
                <input type="text" id="info_pasangan" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_anak" class="col-sm-4 col-form-label">Nama anak</label>
              <div class="col-sm-8">
                <textarea id="info_anak" readonly class="form-control-plaintext"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(){

		document.querySelectorAll('.sidebar .sidebar-link').forEach(function(element){

			element.addEventListener('click', function (e) {

				let nextEl = element.nextElementSibling;
				let parentEl  = element.parentElement;	

				if(nextEl) {
					e.preventDefault();	
					let mycollapse = new bootstrap.Collapse(nextEl);

			  		if(nextEl.classList.contains('show')){
			  			mycollapse.hide();
			  		} else {
			  			mycollapse.show();
			  			// find other submenus with class=show
			  			var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
			  			// if it exists, then close all of them
						if(opened_submenu){
							new bootstrap.Collapse(opened_submenu);
						}

			  		}
		  		}

			});
		})

	}); 
	// DOMContentLoaded  end

  function detailPegawai($id){
    $.ajax({
      url:"<?php echo site_url("pegawai/detailpegawai")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){

				const months = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nov","Des"];

        const pegawai = hasil.pegawai;

				let tanggal_masuk = new Date(pegawai.tgl_masuk);
				let m_tgl_masuk = months[tanggal_masuk.getMonth()];
				let d_tgl_masuk = tanggal_masuk.getDate();
				let y_tgl_masuk = tanggal_masuk.getFullYear();

        document.getElementById("tempat_tglLahir").value = pegawai.tempat_lahir+', '+pegawai.tgl_lahir;
        document.getElementById("info_shio").value = pegawai.shio;
        document.getElementById("info_zodiak").value = pegawai.zodiak;
        document.getElementById("info_weton").value = pegawai.weton;
        document.getElementById("info_jenis_kelamin").value = pegawai.jenis_kelamin == 'L' ? 'Laki-laki':'Perempuan';
        document.getElementById("info_pendidikan_terakhir").value = pegawai.pendidikan_terakhir+' '+pegawai.jurusan;
        document.getElementById("info_golongan_darah").value = pegawai.golongan_darah;
        document.getElementById("info_agama").value = pegawai.agama;
        document.getElementById("info_alamat_ktp").value = pegawai.alamat_ktp;
        document.getElementById("info_alamat_domisili").value = pegawai.alamat_domisili;
        document.getElementById("info_kontak").value = pegawai.kontak_pegawai;
        document.getElementById("info_kk").value = pegawai.no_kk;
        document.getElementById("info_ktp").value = pegawai.no_ktp;
        document.getElementById("info_jamsostek").value = pegawai.no_jamsostek;
        document.getElementById("info_bpjsKesehatan").value = pegawai.no_bpjsKesehatan;
        document.getElementById("info_npwp").value = pegawai.no_npwp;
        document.getElementById("info_tgl_masuk").value = d_tgl_masuk+' '+m_tgl_masuk+' '+y_tgl_masuk;
        document.getElementById("info_tgl_selesai").value = pegawai.tgl_selesai;
        document.getElementById("info_durasi_kontrak").value = pegawai.durasi_kontrak;
        document.getElementById("info_email").value = pegawai.email_pegawai;
        document.getElementById("info_ibu").value = pegawai.nama_ibu;
        document.getElementById("info_ayah").value = pegawai.nama_ayah;
        document.getElementById("info_pasangan").value = pegawai.nama_pasangan;
        document.getElementById("info_anak").value = pegawai.nama_anak;
      }
    });
  }

</script>
