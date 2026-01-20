<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Pencatatan Inventaris kepemilikan mirota ksm">
	<meta name="author" content="Tri Cahya">
	<!-- <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"> -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/dist/img/favicon.png')?>">

	<link rel="preconnect" href="https://fonts.gstatic.com">

  <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">

	<link rel="shortcut icon" href="<?= base_url('assets/dist/img/favicon.png')?>" />

	<title><?= $pageTitle ?></title>

  <link rel="manifest" href="<?= base_url(); ?>/web.webmanifest"/>
  <script src="<?php echo base_url(); ?>assets/dist/js/register.js"></script>

  <!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

	<!-- FontAwesome -->
	<script src="https://kit.fontawesome.com/2edfabd55a.js" crossorigin="anonymous"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.dataTables.net/1.13.6/css/dataTables.bootstrap5.min.css">

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Summernote --> 
  <link href="<?=base_url(); ?>assets/dist/summernote-0.9.0/summernote-bs5.min.css" rel="stylesheet">


  <!-- jQuery 3 -->
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <style>
    #load{
      width: 100%;
      height: 100%;
      position: fixed;
      text-indent: 100%;
      background: rgba(255,255,255) url('./assets/images/loader.gif') no-repeat center;
      z-index: 1;
      opacity: 0.8;
    }

    .text-secondary-modal{
    font-size:10px;
    margin:0;
    }
  </style>
</head>

  <!-- <body class="sidebar-mini skin-black-light"> -->
<?php 
if($role != ROLE_STAFF){ ?>
<body>
<div id="load"></div>
<div class="wrapper">
  <nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
      <a class="sidebar-brand" href="">
        <span class="align-middle">Smart OSD Mirota KSM </span>
      </a>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-nav">
        <li class="sidebar-header">
          Menu
        </li>
        <li class="sidebar-item">
          <a href="<?php echo base_url('/dashboard');?>" class="sidebar-link">
            <i class="fa fa-dashboard" style="color:#fff"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- MASTER DATA -->
        <li class="sidebar-item has-submenu">
          <a class="sidebar-link" href="#"><i class="fa-solid fa-database"></i> Master Data <i class="fa fa-angle-down" style="float: right;"></i> </a>
          <ul class="submenu collapse">
            <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $role == ROLE_MANAGER){?>
            <!-- MENU DEPARTEMENT -->
            <li class="sidebar-item">
              <a href="<?php echo base_url('Datadepartement'); ?>" class="sidebar-link">
                <i class="fa-solid fa-people-roof"></i>
                <span>Struktur Organisasi</span>
              </a>
            </li>
            <!-- <li class="sidebar-item">
              <a href="<?php echo base_url('Datadivisi'); ?>" class="sidebar-link">
                <i class="fa-solid fa-people-line"></i>
                <span>Data Divisi</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="<?php echo base_url('Databagian'); ?>" class="sidebar-link">
                <i class="fa-solid fa-people-group"></i>
                <span>Data Bagian</span>
              </a>
            </li> -->
            
            <li class="sidebar-item">
              <a href="<?php echo base_url('area-kerja'); ?>" class="sidebar-link">
                <i class="fa-solid fa-people-line"></i>
                <span>Data Area Kerja</span>
              </a>
            </li>
            <?php }?>
            <!-- MENU PEGAWAI -->
            <li class="sidebar-item has-submenu">
              <a class="sidebar-link" href="#"><i class="fa-solid fa-users"></i> Data Karyawan <i class="fa fa-angle-down" style="float: right;"></i> </a>
              <ul class="submenu collapse">
                <li class="sidebar-item">
                  <a href="<?php echo base_url('Datapegawai'); ?>" class="sidebar-link">
                    <span>Karyawan Aktif</span>
                  </a>
                </li>

                <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $role == ROLE_MANAGER){?>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('Datapegawainonaktif'); ?>" class="sidebar-link">
                    <span>Karyawan Tidak Aktif</span>
                  </a>
                </li>
                <?php }?>
              </ul>
            </li>
          </ul>
        </li>
        <!-- MASTER DATA -->

        <!-- INVENTARIS -->
        <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $role == ROLE_MANAGER | $role == ROLE_KABAG){?>
        <li class="sidebar-item has-submenu">
          <a class="sidebar-link" href="#"><i class="fa-solid fa-warehouse"></i> Inventaris<i class="fa fa-angle-down" style="float: right;"></i> </a>
          <ul class="submenu collapse">
            <!-- MENU RUANGAN -->
            <li class="sidebar-item has-submenu">
              <a class="sidebar-link" href="#"><i class="fa fa-building"></i>  Ruangan <i class="fa fa-angle-down" style="float: right;"></i> </a>
              <ul class="submenu collapse">
                <li class="sidebar-item">
                  <a href="<?php echo base_url('Dataruangan'); ?>" class="sidebar-link">
                  <span>Data Ruangan</span>
                  </a>
                </li>
                <?php
                if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
                {
                ?>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('Pinjamruangan'); ?>" class="sidebar-link">
                    <span>Peminjaman Ruangan</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url(); ?>kerusakanRuangan" class="sidebar-link">
                    <span>Kerusakan Ruangan</span>
                  </a>
                </li>
                <?php } ?>
              </ul>
            </li>
            <!-- MENU BARANG -->
            <li class="sidebar-item has-submenu">
              <a class="sidebar-link" href="#"><i class="fa fa-boxes-stacked"></i>  Barang <i class="fa fa-angle-down" style="float: right;"></i> </a>
              <ul class="submenu collapse">
                <li class="sidebar-item">
                  <a href="<?php echo base_url('Databarang'); ?>" class="sidebar-link">
                    <span>Data Barang</span>
                  </a>
                </li>
                <?php
                if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $jabatan_id == ROLE_KABAG)
                {
                ?>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('data-pinjam-barang'); ?>" class="sidebar-link">
                    <span>Peminjaman Barang</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url(); ?>kerusakanBarang" class="sidebar-link">
                    <span>Kerusakan Barang</span>
                  </a>
                </li>
                <?php } ?>
              </ul>
            </li>
            <!-- MENU KENDARAAN -->
            <li class="sidebar-item has-submenu">
              <a class="sidebar-link" href="#"><i class="fa-solid fa-car"></i>  Kendaraan <i class="fa fa-angle-down" style="float: right;"></i> </a>
              <ul class="submenu collapse">
                <li class="sidebar-item">
                  <a href="<?php echo base_url('Datakendaraan'); ?>" class="sidebar-link">
                    <span>Data Kendaraan</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('tugas'); ?>" class="sidebar-link">
                    <span>Peminjaman Kendaraan</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <?php } ?>
        <!-- INVENTARIS -->

        <!-- MENU EVALUASI -->
        <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_KABAG | $role == ROLE_MANAGER){?>
        <li class="sidebar-item has-submenu">
          <a class="sidebar-link" href="#"><i class="fa-solid fa-user-check"></i> Evaluasi Kinerja <i class="fa fa-angle-down" style="float: right;"></i> </a>
          <ul class="submenu collapse">
            <li class="sidebar-item">
              <a href="<?php echo base_url('EvaluasiKerja'); ?>" class="sidebar-link">
                <span>Evaluasi Staff</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="<?php echo base_url('EvaluasiSpv'); ?>" class="sidebar-link">
                <span>Evaluasi SPV</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="<?php echo base_url('EvaluasiPromosi'); ?>" class="sidebar-link">
                <span>Promosi Karyawan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="<?php echo base_url('EvaluasiMagang'); ?>" class="sidebar-link">
                <span>Evaluasi Magang</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="sidebar-item has-submenu">
          <a class="sidebar-link" href="#"><i class="fa-solid fa-user-check"></i> Evaluasi <i class="fa fa-angle-down" style="float: right;"></i> </a>
          <ul class="submenu collapse">
            <li class="sidebar-item">
              <a href="<?php echo base_url('jenis-evaluasi'); ?>" class="sidebar-link">
                <span>Soal Evaluasi</span>
              </a>
            </li>
            <?php 
            $kategori = $this->global['kategori'] = $this->crud_model->lihatdata('tbl_evaluasi_kategori');
            foreach ($kategori as $k) { ?>
            <li class="sidebar-item">
              <a href="<?php echo base_url('evaluasi/'.$k->nama_evaluasi_kategori); ?>" class="sidebar-link">
                <span>Evaluasi <?= $k->nama_evaluasi_kategori?></span>
              </a>
            </li>
            <?php } ?>
            <!-- <li class="sidebar-item">
              <a href="<?php echo base_url('evaluasi/Probation'); ?>" class="sidebar-link">
                <span>Evaluasi Probation</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="<?php echo base_url('evaluasi/Promosi'); ?>" class="sidebar-link">
                <span>Evaluasi Promosi</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="<?php echo base_url('evaluasi/Magang'); ?>" class="sidebar-link">
                <span>Evaluasi Magang</span>
              </a>
            </li> -->
          </ul>
        </li>
        <?php } ?>
        <!-- /MENU EVALUASI -->

        <!-- MENU ASSESSMENT -->
        <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $role == ROLE_HRBP){?>
        <li class="sidebar-item">
          <a href="<?php echo base_url('DataAssessment'); ?>" class="sidebar-link">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Assesment360</span>
          </a>
        </li>
        <?php }?>
        <!-- /MENU ASSESSMENT -->


        <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $role == ROLE_MANAGER | $role == ROLE_KABAG){?>
        <li class="sidebar-item">
          <a href="<?php echo base_url('pelanggaran-karyawan'); ?>" class="sidebar-link">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Pelanggaran</span>
          </a>
        </li>
        <?php }?>

        <!-- MENU HRGA -->
        <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $role == ROLE_KABAG | $role == ROLE_MANAGER | $role == ROLE_SPV | $role == ROLE_ADMIN){?>
        <li class="sidebar-item has-submenu">
          <a class="sidebar-link" href="#"><i class="fa-solid fa-house-medical"></i> HRGA<i class="fa fa-angle-down" style="float: right;"></i> </a>
          <ul class="submenu collapse">
            <!-- MENU TRANSAKSI SATPAM -->
            <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA){?>
            <li class="sidebar-item has-submenu">
              <a class="sidebar-link" href="#"><i class="fa-solid fa-shield"></i>  Transaksi Satpam <i class="fa fa-angle-down" style="float: right;"></i> </a>
              <ul class="submenu collapse">
                <li class="sidebar-item">
                  <a href="<?php echo base_url('report-saldo'); ?>" class="sidebar-link">
                    <i class="fa-solid fa-coins"></i>
                    <span>Saldo</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('pengirimanpaket'); ?>" class="sidebar-link">
                    <i class="fa-solid fa-cubes"></i>
                    <span>Pengiriman Paket</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('pembelian-galon'); ?>" class="sidebar-link">
                    <i class="fa-solid fa-bottle-water"></i>
                    <span>Pembelian Galon</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php }?>


            <!-- MENU TRANSAKSI SATPAM -->

            <!-- MENU KEBERSIHAN -->
            <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA){?>
            <li class="sidebar-item">
              <a href="<?php echo base_url('laporan-kebersihan'); ?>" class="sidebar-link">
                <i class="fa-solid fa-broom"></i>
                <span>Kebersihan</span>
              </a>
            </li>
            <?php } ?>
            <!-- /MENU KEBERSIHAN -->

            <!-- MENU Dokumen -->
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $jabatan_id <= 4)
            {
            ?>
            <li class="sidebar-item">
              <a href="<?php echo base_url('dokumen-legal'); ?>" class="sidebar-link">
                <i class="fa-solid fa-file"></i>
                <span>Dokumen Legal</span>
              </a>
            </li>
            <?php } ?>
            <!-- /MENU Dokumen -->

            <!-- MENU APPROVAL PERIZINAN -->
            <?php
            if($jabatan_id <= 4  | $role == ROLE_HRGA)
            {
            ?>
            <li class="sidebar-item has-submenu">
              <a class="sidebar-link" href="#"><i class="fa-solid fa-file-circle-check"></i> Approval Izin<i class="fa fa-angle-down" style="float: right;"></i> </a>
              <ul class="submenu collapse">
                <li class="sidebar-item">
                  <a href="<?php echo base_url(); ?>izin" class="sidebar-link">
                    <span>Izin</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url(); ?>cuti" class="sidebar-link">
                    <span>Cuti Tahunan/ Khusus</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url(); ?>tugas" class="sidebar-link">
                    <span>Surat Tugas</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url(); ?>izin-harian" class="sidebar-link">
                    <span>Izin Kurang dari 1 Hari</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php } ?>
            <!-- /MENU APPROVAL PERIZINAN -->

            <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $role == ROLE_MANAGER | $role == ROLE_KABAG | $role == ROLE_ADMIN  | $role == ROLE_SPV){?>
            <!-- MENU ABSENSI -->
            <li class="sidebar-item has-submenu">
              <a class="sidebar-link" href="#"><i class="fa-solid fa-user-check"></i> Laporan Absensi <i class="fa fa-angle-down" style="float: right;"></i> </a>
              <ul class="submenu collapse">
                <?php
                if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA){
                ?>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('laporanAbsensi'); ?>" class="sidebar-link">
                    <span>Absensi Online</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('laporanAbsensiPHL'); ?>" class="sidebar-link">
                    <span>Absensi Pegawai Harian/Magang</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('laporan-absen-toko'); ?>" class="sidebar-link">
                    <span>Absensi Toko Manual</span>
                  </a>
                </li>
                <?php } ?>
                <li class="sidebar-item">
                  <a href="<?php echo base_url('Laporan-visit'); ?>" class="sidebar-link">
                    <span>Absensi Visit</span>
                  </a>
                </li>
                <!-- <li class="sidebar-item">
                  <a href="<?php echo base_url('laporan-absensi-mesin'); ?>" class="sidebar-link">
                    <span>Absensi Mesin</span>
                  </a>
                </li> -->
              </ul>
            </li>
            <!-- /MENU ABSENSI -->
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <?php if($role == ROLE_SUPERADMIN){ ?>
        <!-- MENU SAMPLE -->
        <li class="sidebar-item">
          <a href="<?php echo base_url('permintaan-sample'); ?>" class="sidebar-link">
            <i class="fa-solid fa-clipboard-check"></i>
            <span>Permintaan Sample</span>
          </a>
        </li>
        <?php } ?>
        <!-- /MENU SAMPLE -->

        <?php
        if($role == ROLE_SUPERADMIN)
        {
        ?>
        <li class="sidebar-header">
          User Management
        </li>
        <li class="sidebar-item">
          <a href="<?php echo base_url(); ?>userListing" class="sidebar-link">
            <i class="fa fa-users"></i>
            <span>Users</span>
          </a>
        </li>
        <?php } ?>

        <!-- <?php
        if($role != ROLE_POOL)
        {
        ?>
        <li class="sidebar-header">
          Scan Barcode
        </li>
        <li class="sidebar-item">
          <a href="<?= base_url('barang/cekBarang')?>" class="sidebar-link">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span>Cek Barang</span>
          </a>
        </li>
        <?php } ?> -->
      </ul>
    </div>
  </nav>

  <div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
      <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
      </a>
      <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
          <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
              <div class="position-relative">
                <i class="align-middle" data-feather="bell"></i>
                <span class="indicator" id="indicator"></span>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
              <div class="dropdown-menu-header" id="indicator-header">
              </div>
              <div class="list-group">
                <?php
                if($role == ROLE_SUPERADMIN || $role == ROLE_HRGA)
                {
                ?>
                <a href="<?php base_url(); ?>kerusakanBarang" class="list-group-item" onclick="bacaNotifBarang()">
                  <div class="row g-0 align-items-center">
                    <div class="col-2">
                      <i class="text-danger" data-feather="alert-circle"></i>
                    </div>
                    <div class="col-10">
                      <div class="text-dark">Laporan Kerusakan Barang</div>
                      <div class="text-muted small mt-1" id="indicator-barang"></div>
                    </div>
                  </div>
                </a>
                <?php } ?>

                <?php
                if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
                {
                ?>
                <a href="<?php base_url();?>kerusakanRuangan" class="list-group-item" onclick="bacaNotifRuangan()">
                  <div class="row g-0 align-items-center">
                    <div class="col-2">
                      <i class="text-danger" data-feather="alert-circle"></i>
                    </div>
                    <div class="col-10">
                      <div class="text-dark">Laporan Kerusakan Ruangan</div>
                      <div class="text-muted small mt-1" id="indicator-ruangan"></div>
                    </div>
                  </div>
                </a>
                <?php } ?>
              </div>
              <div class="dropdown-menu-footer">
                <a href="#" class="text-muted">Show all notifications</a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
              <i class="align-middle" data-feather="settings"></i>
            </a>

            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <span class="text-dark"><?= $name ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <!-- <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
              <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
              <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
              <div class="dropdown-divider"></div> -->
              <a class="dropdown-item" href="<?= base_url('logout')?>">Log out</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <main class="content">
      <div class="container-fluid p-0">
<?php }else{ ?>
<body class="bg-pattern">
<div>
  <div class="container" style="min-height:400px; margin-top:-3%">
<?php } ?>

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
</script>
