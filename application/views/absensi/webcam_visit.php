
<div class="d-flex justify-content-center ">
  <div class="col-md-6">
    <div class="card">
			<div class="card-body">
				<!-- <h1>Form Registrasi</h1> -->
				<form id="register">
					<input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai" value="<?= $id_pegawai?>">
					<input type="hidden" class="form-control" id="jenis_absen" value="<?= $jenis_absen ?>">
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
				save(data_uri,lat,lon);
				});
				} else {
					console.log('geolocation not available');
				}
			}

			function save(data_uri,lat,lon){
				let id_pegawai = document.getElementById("id_pegawai").value;
				let jenis_absen = document.getElementById("jenis_absen").value;
				$.ajax({
					url: '<?php echo site_url("absensi/saveWebcam");?>',
					type: 'POST',
					dataType: 'json',
					data: {id:id_pegawai,jenis_absen:jenis_absen,imagecam:data_uri,lat:lat,lon:lon},
				})
				.done(function(data) {
					if (data > 0) {
						alert('insert data sukses');
						window.location.href="<?php echo base_url(); ?>Absensi-visit";
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
					window.location.href="<?php echo base_url(); ?>Absensi-visit";
				});
			}
			
		});
	</script>
</body>
</html>