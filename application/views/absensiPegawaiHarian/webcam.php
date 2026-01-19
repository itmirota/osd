
<div class="d-flex justify-content-center mt-4 ">
  <div class="col-md-6">
    <div class="card">
			<div class="card-body">
				<!-- <h1>Form Registrasi</h1> -->
				<form id="register">
					<?php if($jenis_absen == "masuk"){?>
					<div class="mb-3">
						<label for="nama" class="form-label">Nama Pegawai</label>
						<input type="hidden" class="form-control" name="id_absensi" id="id_absensi" value="0">
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
						<input type="hidden" class="form-control" name="bagian" id="bagian" value="0">
						<input type="hidden" class="form-control" name="nama" id="nama" value="0">
						<select class="form-select" class="form-control" name="id_absensi" id="id_absensi" aria-label="Default select example">
							<option selected>Pilih pegawai</option>
							<?php foreach($pegawai as $p){?>
							<option value="<?=$p->id_absensi_pegawaiHarian?>"><?= $p->nama?></option>
							<?php }?>
						</select>
						</div>
					<?php }?>
					<div class="d-flex justify-content-center mb-4">
						<video
							id="camera"
							autoplay
							playsinline
							muted
							style="width:250px;height:250px;border-radius:12px;object-fit:cover">
						</video>

						<canvas id="canvas" width="720" height="960" style="display:none"></canvas>
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
	

<script>
let videoStream = null;
const video = document.getElementById("camera");

async function startCamera() {
	try {
		videoStream = await navigator.mediaDevices.getUserMedia({
			video: {
				facingMode: "user", // atau "environment"
				width: { ideal: 1920 },
				height: { ideal: 1080 }
			},
			audio: false
		});

		video.srcObject = videoStream;

	} catch (err) {
		alert("Kamera tidak bisa diakses: " + err.message);
	}
}

startCamera();
</script>

<!-- Code to handle taking the snapshot and displaying it locally -->
<script type="text/javascript">

	// get GPS
	if ('geolocation' in navigator) {
		console.log('geolocation available');
		navigator.geolocation.getCurrentPosition(position => {
		lat = position.coords.latitude;
		lon = position.coords.longitude;
	});
	} else {
		console.log('geolocation not available');
	}
	// ======================

	document.getElementById("register").addEventListener("submit", async function(e) {
		e.preventDefault();

		if (!video.videoWidth) {
			alert("Kamera belum siap");
			return;
		}

		const canvas = document.getElementById("canvas");
		const ctx = canvas.getContext("2d");

		canvas.width = 720;
		canvas.height = 960;

		ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

		const fotoBase64 = canvas.toDataURL("image/jpeg", 0.95);

		await prosesAbsensiCanvas(fotoBase64);
	});

	async function prosesAbsensiCanvas(fotoBase64) {

		Swal.fire({
			title: "Mengirim data...",
			didOpen: () => Swal.showLoading(),
			allowOutsideClick: false
		});

		try {
			const hasil = await save(fotoBase64, lat, lon);

			Swal.close();

			if (hasil.status === "ok") {
				await Swal.fire({
					icon: "success",
					title: "Berhasil!",
					html: `<img src="${fotoBase64}" style="width:50%;border-radius:10px">`
				});

				window.location.href = "<?= base_url('PHL/kehadiran'); ?>";
			}

		} catch (err) {
			Swal.close();
			alert(err.message);
		}
	}

async function save(data_uri, lat, lon) {
  let jenis_absen = document.getElementById("jenis_absen").value;
  let nama = document.getElementById("nama").value;
  let bagian = document.getElementById("bagian").value;
  let id_absensi = document.getElementById("id_absensi").value;

  return $.ajax({
    url: '<?= site_url("absensiPegawaiHarian/saveWebcam"); ?>',
    type: 'POST',
    dataType: 'json',
    data: {
      id_absensi: id_absensi,
      nama: nama,
      bagian: bagian,
      jenis_absen: jenis_absen,
      imagecam: data_uri,
      lat: lat,
      lon: lon
    }
  });
}

</script>
</body>
</html>