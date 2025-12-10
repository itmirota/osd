
<div class="d-flex justify-content-center main-page ">
  <div class="col-10">
    <div class="card">
			<div class="card-body">
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
	

	<script>
		Webcam.set({
			width: 240,
			height: 320,
			image_format: 'jpeg',
			jpeg_quality: 50
		});
		Webcam.attach( '#my_camera' );

		document.getElementById("register").addEventListener("submit", function(e) {
			e.preventDefault();

			// Ambil foto webcam
			Webcam.snap(async function(data_uri) {

				// Tampilkan preview foto
				document.getElementById("result").innerHTML = '<img src="'+ data_uri + '"/>';
				document.getElementById("my_camera").style.display = "none";

				// Jalankan proses absen
				await prosesAbsen(data_uri);
			});
		});

		// ======================
		// MAIN FUNCTION
		// ======================
		async function prosesAbsen(fotoBase64) {

			// Tampilkan loading
			Swal.fire({
					title: "Mengirim data...",
					text: "Mohon tunggu sebentar",
					didOpen: () => Swal.showLoading(),
					allowOutsideClick: false
			});

			try {
					// 1. Ambil koordinat GPS
					const posisi = await getGPS();
					const lat = posisi.coords.latitude;
					const lon = posisi.coords.longitude;

					// 2. Reverse geocoding LocationIQ
					const lokasi = await getLocationName(lat, lon);

					// 3. Simpan ke server CI3
					const hasil = await kirimKeServer(fotoBase64, lat, lon, lokasi.wilayah, lokasi.kota);

					Swal.close(); // Tutup loading

					if (hasil.status === "ok") {

							await Swal.fire({
									icon: "success",
									title: "Berhasil!",
									text: hasil.msg || "Absensi berhasil disimpan"
							});

							// Redirect hanya jika sukses
							window.location.href = "<?= base_url('Absensi'); ?>";

					} else {
							Swal.fire({
									icon: "error",
									title: "Gagal",
									text: hasil.msg || "Terjadi kesalahan"
							});
					}

			} catch (error) {
					Swal.close();

					Swal.fire({
							icon: "error",
							title: "Kesalahan",
							text: error.message || error
					});
			}
		}

		// ======================
		// GET GPS (Promise)
		// ======================
		function getGPS() {
			return new Promise((resolve, reject) => {
				if (!navigator.geolocation) {
					reject("Browser tidak mendukung GPS.");
				}

				navigator.geolocation.getCurrentPosition(resolve, () => {
					reject("Tidak mendapatkan izin GPS.");
				});
			});
		}

		// ======================
		// GET LOCATION NAME DENGAN LOCATIONIQ
		// ======================
		async function getLocationName(lat, lon) {
			const apiKey = "pk.37bf22c2eeccf7da7a41e58485f2b6ea";
			const url = `https://us1.locationiq.com/v1/reverse.php?key=${apiKey}&lat=${lat}&lon=${lon}&format=json`;

			try {
					const response = await fetch(url);
					const data = await response.json();

					const address = data.address || {};

					// Ambil wilayah
					const wilayah = 
							address.city_district ||
							address.village ||
							address.suburb ||
							address.town ||
							"-";

					// Ambil kota
					const kota = 
							address.city ||
							address.county ||
							address.state ||
							"-";

					return { wilayah, kota };

			} catch (e) {
					return { wilayah: "-", kota: "-" };
			}
		}

		// ======================
		// SIMPAN KE SERVER (CI3)
		// ======================
		async function kirimKeServer(foto, lat, lon, wilayah, kota) {
			const payload = {
				id: document.getElementById("id_pegawai").value,
				jenis_absen: document.getElementById("jenis_absen").value,
				imagecam: foto,
				lat: lat,
				lon: lon,
				wilayah: wilayah,
				kota: kota
			};

			const response = await fetch("<?= site_url('absensi/saveWebcam'); ?>", {
					method: "POST",
					headers: { "Content-Type": "application/json" },
					body: JSON.stringify(payload)
			});

			return await response.json();
		}
	</script>
