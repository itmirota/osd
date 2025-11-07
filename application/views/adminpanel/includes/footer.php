<?php 
if(isset($name)){ ?>
</div>
</main>
<?php 
}else{ ?>
</div>
<?php 
} ?>
<footer class="footer" style="background-color:#1c88e3;">
	<div class="container-fluid">
		<div class="row text-muted">
			<div class="col-6 text-start">
				<p class="mb-0 text-white">
					<strong>Copyright &copy;</strong> - <a class="text-muted" href="https://mirota.id/" target="_blank"><strong class="text-white">PT Mirota KSM <?= DATE('Y')?></strong></a>
				</p>
			</div>
			<div class="col-6 text-end">
				<ul class="list-inline">
					<li class="list-inline-item">
						<a class="text-white" href="https://wa.me/08993932789" target="_blank">Support</a>
					</li>
					<li class="list-inline-item">
						<a class="text-white" href="https://wa.me/08993932789" target="_blank">Help Center</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<div class="flash-data" data-icon="<?= $this->session->flashdata('swal_icon')?>"  data-title="<?= $this->session->flashdata('swal_title')?>"  data-text="<?= $this->session->flashdata('swal_text')?>"></div>
</div>


	<!-- Popper -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
	
	<!-- Bootsrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

	<!-- DataTable -->
	<script src="https://cdn.dataTables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.dataTables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

	<!-- AdminKit -->
	<script src="<?php echo base_url(); ?>assets/adminkit/js/app.js"></script>

	<!-- FullCalendar -->
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js"></script>
	
	<!-- SELECT2 -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Summernote -->
	<script src="<?php echo base_url(); ?>assets/dist/summernote-0.9.0/summernote-bs5.min.js"></script>

	<script>
		$(document).ready(function() {
			$("#load").fadeOut(2000);
      		$("#durasi_kontrak").hide();
 		 	$("#infobarang").hide();
			$("#kendaraan_id").hide();
			loadkendaraan();
			buktiCuti();
			statuspegawai();
			swal();
			dataTable();
			dataTableScrollX();
			indicator();
			dataTableDashboard();
			checklist();

			$('.summernote').summernote({
        placeholder: 'Tulis disini...',
        tabsize: 2,
        height: 100
      });

			$('.select2, .selectDivisi, .selectApproval, .selectApprovalEdit').select2({
				theme: 'bootstrap-5',
				width: 'resolve' // need to override the changed default
			});

			$('#pegawai_terlambat').select2({
			theme: 'bootstrap-5',
				dropdownParent: $('#AddTerlambat')
			});

			$('#pegawai_assessment, #penilai_assessment').select2({
			theme: 'bootstrap-5',
				dropdownParent: $('#add_assessment')
			});

			$('#kadiv_select2, #manager_select2').select2({
				theme: 'bootstrap-5',
        		dropdownParent: $('#addDepartement')
 		  	});

			$('#pegawai_id').select2({
				theme: 'bootstrap-5',
				dropdownParent: $('#filterAbsenToko')
			});

			$('#pegawai_id').select2({
				theme: 'bootstrap-5',
				dropdownParent: $('#addKeterlambatan')
			});

			$('#penugasan_id').select2({
				theme: 'bootstrap-5',
        	dropdownParent: $('#addTugas')
 		  	});

			$('#pemberi_izin').select2({
				theme: 'bootstrap-5',
				dropdownParent: $('#addIzin')
			});

			$('#id_pegawai, #penilai').select2({
				theme: 'bootstrap-5',
				dropdownParent: $('#addJadwal')
			});

			$('#id_pegawai').select2({
				theme: 'bootstrap-5',
				dropdownParent: $('#AddPeminjamanBarang')
			});

			const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
			const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
	});

	function loadkendaraan(){
		$("#jenis_kendaraan").change(function(){
			var getjenis_kendaraan = $("#jenis_kendaraan").val(); 

					if( getjenis_kendaraan != 0){
			$.ajax({
				type : "POST",
				dataType : "JSON",
				url :  "<?= base_url(); ?>kendaraan/getKendaraan",
				data : {jenis_kendaraan : getjenis_kendaraan},
				success : function(data){
					console.log(data);

					var html = ' ';
					var i;
					for ( i=0; i < data.length ; i++){
						
						html += 
						'<option value="'+ data[i].id_kendaraan +'">'+ data[i].merek_kendaraan + ' | '+ data[i].nomor_polisi +'</option>';
					}
					$("#kendaraan_id").html(html);
					$("#kendaraan_id").show();
				}
			});
					}

		});
	} 

	function buktiCuti(){
    $("#jenis_cuti").change(function(){
		var getjenis_cuti = $("#jenis_cuti").val(); 

		if( getjenis_cuti == "tahunan"){
			document.getElementById("bukti_cuti").required = false;
			document.getElementById("kuota_cuti").style.display = "block";
			document.getElementById("bukti_cuti").style.display = "none";
			document.getElementById("detail_cuti_khusus").style.display = "none";
		}

		if( getjenis_cuti == "khusus"){
			document.getElementById("detail_cuti_khusus").style.display = "block";
			document.getElementById("kuota_cuti").style.display = "none";
			document.getElementById("bukti_cuti").style.display = "block";
		}

		if( getjenis_cuti == "pengganti"){
			document.getElementById("detail_cuti_khusus").style.display = "none";
			document.getElementById("kuota_cuti").style.display = "none";
			document.getElementById("bukti_cuti").style.display = "block";
		}
			
    });
  } 

	function checklist(){
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
	}

	function statuspegawai(){
    $("#AddStatus").change(function(){
      const status = $("#AddStatus").val();
			if( status === "kontrak"){
				$("#durasi_kontrak").show();
			}else{
				$("#durasi_kontrak").hide();
			}
    });
  }

	function indicator(){
			// setInterval(function(){
			$.ajax({
      url:"<?php echo site_url("dashboard/notiflaporan")?>",
      dataType:"JSON",
      type: "get",
      success:function(hasil){
				let notif_ruangan = hasil.jumlah_notif_ruangan;
				let notif_barang = hasil.jumlah_notif_barang;

				total = parseInt(notif_ruangan)+parseInt(notif_barang);
        document.getElementById("indicator").innerHTML = total;
        document.getElementById("indicator-header").innerHTML = total+" laporan baru";
        document.getElementById("indicator-barang").innerHTML = notif_barang+" laporan baru";
        document.getElementById("indicator-ruangan").innerHTML = notif_ruangan+" laporan baru";
      }
			// }, 1000);
    });
	}

	function bacaNotifRuangan(){
		$.ajax({
      url:"<?php echo site_url("ruangan/bacanotif")?>",
      dataType:"JSON",
      type: "get",
    });
	}

	function bacaNotifBarang(){
		$.ajax({
      url:"<?php echo site_url("barang/bacanotif")?>",
      dataType:"JSON",
      type: "get",
    });
	}

	function swal(){
		const icon = $('.flash-data').data('icon');
		const tittle = $('.flash-data').data('title');
		const text = $('.flash-data').data('text');

		if (icon){
			Swal.fire({
			icon: icon,
			title: tittle,
			text: text,
			position: "center",
			showConfirmButton: false,
			timer: 3000
			})
		}
	}

	function dataTable(){
		Object.assign(DataTable.defaults, {
		searching: true,
		responsive: true,
		ordering: true,
		// scrollX: true
		});
		
		new DataTable('#dataTable, #DataMontor');
	}

	function dataTableScrollX(){
		Object.assign(DataTable.defaults, {
		searching: true,
		responsive: true,
		ordering: true,
		scrollX: true
		});
		
		new DataTable('#dataTableScrollX');
	}

	function dataTableDashboard(){
		Object.assign(DataTable.defaults, {
		paging: false,
		searching: true,
		ordering: false,
		info: false,
		responsive: true
		});
		
		new DataTable('#DashboardRuangan, #DashboardBarang');
	}

	// Script Navbar active
	var windowURL = window.location.href;
	pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
	var x= $('a[href="'+pageURL+'"]');
			x.addClass('active');
			x.parent().addClass('active');
	var y= $('a[href="'+windowURL+'"]');
			y.addClass('active');
			y.parent().addClass('active');
</script>

</body>

</html>