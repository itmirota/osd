
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<style>
		#my_camera { width: 250px; height: 250px; margin: 0 auto;}
		#map { width: 120px; height: 80px; margin-top: 10px; position: absolute; bottom: 60px; left: 10px;}
		#ambilFoto { position: absolute; bottom: 60px; right: 10px;}

		@media only screen and (max-width: 300px) {
		#my_camera { width: 180px; height: 180px; padding: 0 auto;}
		#map { width: 60px; height: 60px; margin-top: 10px; position: absolute; bottom: 50px; left: 45px;}
		#ambilFoto { position: absolute; bottom: 50px; right: 45px;}
		}

		#final_result { width: 180px; height: auto; -top: 15px; }
		.kamera {position: relative;text-align: center;}
</style>

<div class="d-flex justify-content-center main-page ">
  <div class="col-10" style="margin:0 0 10dvh 0">
    <div class="card">
			<div class="card-body">
				<div class="h3"><strong>Form Absensi Visit</strong></div>
				<form id="register">
					<input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai" value="<?= $id_pegawai?>">
					<input type="hidden" class="form-control" id="jenis_absen" value="<?= $jenis_absen ?>">
					<div class="d-flex justify-content-center mb-2">
						<div class="kamera">
							<div id="my_camera"></div>
							<div id="map"></div>
							<button class="btn btn-sm btn-info" type="button" id="ambilFoto">Ambil Foto</button>

							<img id="final_result" />
							<div class="d-flex justify-content-between">
								<button type="button" id="fotoUlang" class="btn btn-sm btn-warning mt-4" style="display:none">
									Foto Ulang
								</button>
								<button type="button" id="shareFoto" class="btn btn-sm btn-success mt-4" style="display:none">
									Bagikan Foto
								</button>
								<!-- <button type="button" id="downloadFoto" class="btn btn-primary mt-4" style="display:none">
										Download Foto
								</button> -->
							</div>
						</div>

						<canvas id="canvas" width="640" height="360" style="display:none;"></canvas>
						</div>
					</div>

					<div class="d-flex flex-wrap justify-content-center">
						<div class="col-8 mb-3">
							<label for="nama_toko" class="form-label">Nama Toko</label>
							<input type="text" class="form-control" id="nama_toko" placeholder="masukkan nama toko" value="<?= $jenis_absen == 'pulang' ? (isset($list_absen->nama_toko) ? $list_absen->nama_toko : '')  : '' ?>">
						</div>

						<div class="col-8 mb-3" style="display:<?= $jenis_absen == 'pulang' ? 'block':'none'?>;">
								<label class="form-label fw-bold">Dokumen Pendukung</label>
								<input type="file"
											id="dokumen"
											class="form-control"
											accept=".pdf,.jpg,.jpeg,.png">
								<small class="text-muted">
										PDF / JPG / PNG (opsional)
								</small>
						</div>

						<div class="col-8 mb-3"  style="display:<?= $jenis_absen == 'pulang' ? 'block':'none'?>;">
							<label for="keterangan" class="form-label">Keterangan</label>
							<textarea class="form-control" id="keterangan" rows="3"></textarea>
						</div>
					</div>



					<div class="d-grid gap-2 col-8 mx-auto mb-4">
						<button type="submit" class="btn btn-<?= ($jenis_absen == "masuk" ? 'success':'danger')?>"> <b><?= $jenis_absen ?></b></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
	<!-- Leaflet JS -->
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<!-- Leaflet to Image -->
	<script src="https://cdn.jsdelivr.net/npm/leaflet-image@0.4.0/leaflet-image.min.js"></script>
	

<script>
/* --- Inisialisasi webcam --- */
Webcam.set({
    image_format: 'jpeg',
    jpeg_quality: 90
});
Webcam.attach('#my_camera');

	/* --- Variabel global --- */
	let userLat = -7.0;
	let userLng = 111.0;
	let wilayah = "-";
	let kota = "-";
	let jenis_absen = "<?= $jenis_absen ?>";

	const kodeRandom = Math.random().toString(36).substring(2, 8).toLowerCase();

	/* --- Buat map TERLEBIH DAHULU (penting) --- */
	let map = L.map('map',{
    center: [userLat, userLng],
    zoom: 12,
		zoomControl:false,
		attributionControl:false
		});
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			crossOrigin: true
	}).addTo(map);

	/* --- Setelah map dibuat, ambil GPS dan reverse-geocode SEKALI --- */
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(async function(pos) {
			userLat = pos.coords.latitude;
			userLng = pos.coords.longitude;

			// update map view & marker
			map.setView([userLat, userLng]);
			let myIcon = L.icon({
				iconSize: [38, 95],
				iconAnchor: [22, 94]
			});
			L.marker([userLat, userLng]).addTo(map);

			// dapatkan nama lokasi sekali saja
			try {
				const lokasi = await getLocationName(userLat, userLng);
				wilayah = lokasi.wilayah;
				kota = lokasi.kota;
			} catch (e) {
				wilayah = "-";
				kota = "-";
			}
		}, function(err){
			console.warn("GPS error:", err);
			// tetap biarkan map & fungsi ambil foto berjalan (dgn default lat/lng)
		}, { enableHighAccuracy: true, timeout: 10000 });
	}

	/* --- Helper loadImage dengan support crossOrigin dan error handling --- */
	function loadImage(src, { crossOrigin = 'anonymous' } = {}) {
		return new Promise((resolve, reject) => {
			const img = new Image();
			if (crossOrigin) img.crossOrigin = crossOrigin;
			img.onload = () => resolve(img);
			img.onerror = (e) => reject(new Error('Gagal load image: ' + src));
			img.src = src;
		});
	}

	/* --- Ambil Foto (event) --- */
	document.getElementById('ambilFoto').onclick = function() {
		Webcam.snap(async function(webcamImg) {
			// leafletImage signature: leafletImage(map, callback)
			leafletImage(map, async function(err, mapCanvas) {
				if (err) {
					console.error("leafletImage error:", err);
					alert("Gagal membuat thumbnail peta.");
					return;
				}

				try {
					const canvas = document.getElementById('canvas');
					const ctx = canvas.getContext('2d');

					// 1. Load webcam image
					const foto = await loadImage(webcamImg, { crossOrigin: null }); // webcamImg is dataURL, no CORS

					// draw foto full area (720x720)
					ctx.clearRect(0,0,canvas.width, canvas.height);
					ctx.drawImage(foto, 0, 0, 720, 720);

					// 2. Load map thumbnail from mapCanvas
					const mapImg = await loadImage(mapCanvas.toDataURL(), { crossOrigin: null });
					ctx.drawImage(mapImg, 20, 740, 260, 200);

					// 3. Load logo (served from your domain)
					const logoImg = await loadImage("<?= base_url('assets/dist/img/logo.png') ?>");
					ctx.drawImage(logoImg, 720 - 150 - 10, 10, 150, 150); // pojok kanan atas, margin 10

					// 4. Tulis teks (tanggal, lokasi, lat/lng, kode)
					ctx.font = "24px Arial";
					ctx.fillStyle = "white";
					ctx.strokeStyle = "black";
					ctx.lineWidth = 3;

					const write = (text, y) => {
							ctx.strokeText(text, 300, y);
							ctx.fillText(text, 300, y);
					};

					const waktu = new Date().toLocaleString("id-ID");
					write(waktu, 760);
					write(`${wilayah}, ${kota}`, 800);
					write("Lat: " + userLat, 840);
					write("Lng: " + userLng, 880);
					write("Kode: " + kodeRandom, 920);

					// 5. Finalize image (dataURL)
					const finalImage = canvas.toDataURL("image/jpeg", 0.95);
					document.getElementById('final_result').src = finalImage;

					// toggle UI: hide camera/map/ambilFoto, show tombol lain
					document.getElementById("my_camera").style.display = "none";
					document.getElementById("map").style.display = "none";
					document.getElementById("ambilFoto").style.display = "none";
					document.getElementById("fotoUlang").style.display = "block";
					document.getElementById("shareFoto").style.display = "block";

				} catch (e) {
					console.error("Error saat proses gambar:", e);
					alert("Terjadi kesalahan saat memproses gambar: " + e.message);
				}
			});
		});
	};

	document.getElementById('fotoUlang').onclick = function () {

		// Kosongkan hasil foto
		document.getElementById('final_result').src = "";

		// Tampilkan kembali kamera, map, tombol ambil foto
		document.getElementById("my_camera").style.display = "block";
		document.getElementById("map").style.display = "block";
		document.getElementById("ambilFoto").style.display = "block";

		// Sembunyikan tombol foto ulang
		document.getElementById("fotoUlang").style.display = "none";

		// Sembunyikan tombol download
		document.getElementById("downloadFoto").style.display = "none";

		// Re-attach webcam (jaga-jaga jika ada HP yang disable kamera setelah hidden)
		Webcam.attach('#my_camera');

		// Resize ulang map supaya tidak blank
		setTimeout(() => {
				map.invalidateSize();
		}, 300);
	};

	document.getElementById('shareFoto').onclick = async function () {
    const imgSrc = document.getElementById('final_result').src;

    if (!imgSrc) {
        alert("Foto belum tersedia");
        return;
    }

    try {
        // Convert base64 → Blob
        const res = await fetch(imgSrc);
        const blob = await res.blob();

        const file = new File([blob], `absensi_${Date.now()}.jpg`, {
            type: 'image/jpeg'
        });

        if (navigator.share) {
            await navigator.share({
                title: 'Laporan Absensi',
                text: 'Laporan absensi visit',
                files: [file]
            });
        } else {
            alert("Browser tidak mendukung fitur share.");
        }

    } catch (err) {
        console.error(err);
        alert("Gagal membagikan foto");
    }
	};


	// document.getElementById('downloadFoto').onclick = function () {
	// 	const imgData = document.getElementById('final_result').src;

	// 	if (!imgData) {
	// 		alert("Foto belum tersedia");
	// 		return;
	// 	}

	// 	// Membuat elemen <a> untuk download
	// 	const a = document.createElement('a');
	// 	a.href = imgData;
	// 	a.download = "absensiVisit"+jenis_absen+"_" + Date.now() + ".jpg";
	// 	a.click();
	// };


	document.getElementById("register").addEventListener("submit", function(e) {
		e.preventDefault();
		
		// Ambil DATA BASE64 dari gambar final
		const fotoBase64 = document.getElementById('final_result').src;

		// Jika foto belum dibuat
		if (!fotoBase64 || fotoBase64.length < 100) {
			Swal.fire({
					icon: "warning",
					title: "Belum ada foto",
					text: "Silakan ambil foto dulu."
			});
			return;
		}
			
		prosesAbsen(fotoBase64);
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
			// 1. Gunakan data GPS GLOBAL
			const lat = userLat;
			const lon = userLng;

			// 2. Gunakan data reverse-geocode GLOBAL
			const wilayahFix = wilayah;
			const kotaFix = kota;

			// 3. Simpan ke server CI3
			const hasil = await kirimKeServer(fotoBase64, lat, lon, wilayahFix, kotaFix, kodeRandom);

			Swal.close(); // Tutup loading

			if (hasil.status === "ok") {

				await Swal.fire({
					icon: "success",
					title: "Berhasil!",
					text: hasil.msg || "Absensi berhasil disimpan"
				});

				// Redirect hanya jika sukses
				window.location.href = "<?= base_url('Absensi-visit'); ?>";

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
	async function kirimKeServer(foto, lat, lon, wilayah, kota, kodeRandom) {
		const payload = {
			id: document.getElementById("id_pegawai").value,
			jenis_absen: document.getElementById("jenis_absen").value,
			nama_toko: document.getElementById("nama_toko").value,
			keterangan: document.getElementById("keterangan").value,
			kodeRandom: kodeRandom,
			imagecam: foto,
			lat: lat,
			lon: lon,
			wilayah: wilayah,
			kota: kota
		};

		const response = await fetch("<?= site_url('absensi/saveWebcamVisit'); ?>", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify(payload)
		});

		return await response.json();
	}
</script>
