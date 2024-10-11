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

  <link rel="manifest" href="<?= base_url(); ?>/web.webmanifest"/>
  <!-- Adminkit -->
	<link href="<?= base_url(); ?>assets/adminkit/css/app.css" rel="stylesheet">

	<!-- Style.css -->
	<link href="<?= base_url(); ?>assets/dist/css/style.css" rel="stylesheet">
  
  <!-- FullCalendar -->
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  
  <!-- SELECT2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/dist/js/register.js"></script>
</head>

<!-- <body class="sidebar-mini skin-black-light"> -->
<body class="bg-pattern">
<div>
  <?php if (isset($name)){?>
  <div class="box" style="margin-bottom:10vh">
    <div class="container">
		  <div class="d-flex justify-content-between">
				<div class="p-2">
					<?php 
					if ($this->uri->segment(1) != 'dashboardUser'){?>
					<a href="<?= base_url('dashboardUser')?>" class="btn login-button"><i class="fas fa-angles-left"></i> kembali</a>
					<?php }?>
				</div>
				<div class="btn-group p-2">
					<button type="button" class="btn login-button dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
					<i class="fa-solid fa-circle-user"></i> Hi, <?= $name ?>
					</button>
					<ul class="dropdown-menu dropdown-menu-lg-end">
						<li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#detailPegawai" onclick="detailPegawai(<?= $pegawai_id?>)">User Info</a></li>
						<!-- <li><a class="dropdown-item" href="#">Ganti Password</a></li> -->
            <li><a class="dropdown-item" href="<?= base_url('Dashboard/downloadAPK')?>"><i class="fa-solid fa-download"></i> download APK</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="<?= base_url('logout')?>">Keluar</a></li>
					</ul>
				</div>
			</div>
    </div>
  </div>
  <?php } ?>
  
  <?php if($this->uri->segment(1) == 'satpam' | $this->uri->segment(1) == 'kebersihan' | $this->uri->segment(1) == 'PHL'){?>
  <div class="header" style="padding:10vh 0 0 0">
    <div class="container">
      <div class="d-flex justify-content-center">
        <img class="imageheader" src="<?= base_url('assets/dist/img/mirotaksm.png')?>" alt="" srcset="">
      </div>
      <!-- <div class="d-flex justify-content-center m-4">
        <h1 class="text-header">
          <?= $pageHeader ?>
        </h1>
      </div> -->
    </div>
  </div>
  <?php } ?>
  <div class="container" style="min-height:80vh">


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
