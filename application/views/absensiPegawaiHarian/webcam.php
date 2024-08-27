
<div class="d-flex justify-content-center mt-4 ">
  <div class="col-md-6">
    <div class="card">
			<div class="card-body">
				<!-- <h1>Form Registrasi</h1> -->
				<form id="register">
					<?php if($jenis_absen == "masuk"){?>
					<div class="mb-3">
						<label for="nama" class="form-label">Nama Pegawai</label>
						<input type="text" class="form-control" name="nama" id="nama" placeholder="tuliskan nama anda disini" required>
					</div>
					<div class="mb-3">
						<label for="bagian" class="form-label">Bagian</label>
						<input type="text" class="form-control" name="bagian" id="bagian" placeholder="tuliskan bagian anda disini" required>
						<input type="hidden" class="form-control" name="jenis_absen" id="jenis_absen" value="<?= $jenis_absen ?>">
					</div>
					<?php }else{?>
						<div class="mb-3">
						<label for="id_absensi" class="form-label">Nama Pegawai</label>
						<input type="hidden" class="form-control" name="jenis_absen" id="jenis_absen" value="<?= $jenis_absen ?>">
						<input type="hidden" class="form-control" name="nama" id="nama">
						<select class="form-select" class="form-control" name="id_absensi" id="id_absensi" aria-label="Default select example">
							<option selected>Pilih pegawai</option>
							<?php foreach($pegawai as $p){?>
							<option value="<?=$p->id_absensi_pegawaiHarian?>"><?= $p->nama?></option>
							<?php }?>
						</select>
						</div>
					<?php }?>
					<div class="d-flex justify-content-center mb-4">
						<div id="my_camera">
						</div>

						<div id="result">
						</div>
					</div>
					<div class="d-grid gap-2 col-10 mx-auto">
						<button type="submit" class="btn btn-<?= ($jenis_absen == "masuk" ? 'success':'danger')?>"> <b><?= $jenis_absen ?></b></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
	
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 50
		});
		Webcam.attach( '#my_camera' );
	</script>
	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script type="text/javascript">
		$('#register').on('submit', function (event) {
			event.preventDefault();

			Webcam.snap( function(data_uri) {
				document.getElementById("result").innerHTML = '<img src="'+ data_uri + '"/>';
				$("#my_camera").hide();
				getLocation(data_uri);
			});

			function getLocation(data_uri){
				if ('geolocation' in navigator) {
				console.log('geolocation available');
				navigator.geolocation.getCurrentPosition(position => {
				lat = position.coords.latitude;
				lon = position.coords.longitude;
				let jenis_absen = document.getElementById("jenis_absen").value;
				save(data_uri,lat,lon);

				});
				} else {
					console.log('geolocation not available');
				}
			}

			function save(data_uri,lat,lon){
				let jenis_absen = document.getElementById("jenis_absen").value;
				let nama = document.getElementById("nama").value;
				let id_absensi = document.getElementById("id_absensi").value;

				$.ajax({
					url: '<?php echo site_url("absensiPegawaiHarian/saveWebcam");?>',
					type: 'POST',
					dataType: 'json',
					data: {id_absensi:id_absensi,nama:nama,jenis_absen:jenis_absen,imagecam:data_uri,lat:lat,lon:lon},
				})
				.done(function(data) {
					if (data > 0) {
						alert('insert data sukses');
						console.log(data);
						window.location.href="<?php echo base_url(); ?>PHL/Absensi";
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					window.location.href="<?php echo base_url(); ?>PHL/Absensi";
				});
			}
			
		});
	</script>
</body>
</html>