<?php 
if(isset($name)){ ?>
</div>
</main>
<?php 
}else{ ?>
</div>
<?php 
} ?>
<!-- <footer class="footer" style="background-color:#1c88e3;">
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
</footer> -->
<div class="flash-data" data-icon="<?= $this->session->flashdata('swal_icon')?>"  data-title="<?= $this->session->flashdata('swal_title')?>"  data-text="<?= $this->session->flashdata('swal_text')?>"></div>
</div>


	<!-- jQuery 3 -->
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

	<!-- Popper -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
	
	<!-- Bootsrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>



	<!-- DataTable -->
	<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>


	<!-- AdminKit -->
	<script src="<?php echo base_url(); ?>assets/adminkit/js/app.js"></script>

	<!-- FullCalendar -->
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js"></script>
	
	<!-- SELECT2 -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?= base_url(); ?>assets/owlcarousel/js/owl.carousel.js"></script>


<script>
	$(document).ready(function() {
		$("#durasi_kontrak").hide();
		$("#infobarang").hide();
		$("#kendaraan_id").hide();
		$("#formLaporan").hide();
    	loadkendaraan();
		dataTable();
		buktiCuti()
		tooltip();
		swal();
		$('.select2, .selectDivisi, .selectBarang, .selectApproval, .selectApprovalEdit').select2({
			theme: 'classic',
		});

		$('#penugasan_id').select2({
			theme: 'bootstrap-5',
			dropdownParent: $('#suratTugas')
		});

		$('#pemberi_izin').select2({
			theme: 'bootstrap-5',
			dropdownParent: $('#suratIzin')
		});

		$('.loop').owlCarousel({
			center: true,
			items:1,
			loop:true,
			margin:10,
			responsive:{
				600:{
					items:2
				}
			}
		});

	});

	function dataTable(){
		Object.assign(DataTable.defaults, {
		searching: true,
		responsive: true,
		ordering: true
		});
		
		new DataTable('#dataTable');
	}

	function buktiCuti(){
		$("#jenis_cuti").change(function(){
		var getjenis_cuti = $("#jenis_cuti").val(); 

		if( getjenis_cuti == "tahunan"){
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

	function select2(){
		$('.select2, .selectDivisi, .selectBarang, .selectApproval, .selectApprovalEdit, .selectPegawai, .selectRuangan').select2({
			theme: 'bootstrap-5',
		});
	}

	function tooltip(){
		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
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