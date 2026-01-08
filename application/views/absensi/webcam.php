<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<style>
		#my_camera { width: 250px; height: 250px; margin: 0 auto;}
		#map { width: 80px; height: 80px; margin-top: 10px; position: absolute; bottom: 40px; left: 30px;}
		#ambilFoto { position: absolute; bottom: 40px; right: 30px;}

		@media only screen and (max-width: 300px) {
		#my_camera { width: 180px; height: 180px; padding: 0 auto;}
		#map { width: 60px; height: 60px; margin-top: 10px; position: absolute; bottom: 30px; left: 20px;}
		#ambilFoto { position: absolute; bottom: 30px; right: 20px;}
		}

		#final_result { width: 180px; -top: 15px; }
		.kamera {position: relative;text-align: center;}
</style>

<div class="d-flex justify-content-center main-page ">
  <div class="col-10">
    <div class="card">
			<div class="card-body">
				<form id="register">
					<input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai" value="<?= $id_pegawai?>">
					<input type="hidden" class="form-control" id="jenis_absen" value="<?= $jenis_absen ?>">
					<div class="d-flex justify-content-center mb-4">
						<div class="kamera">
						<div id="my_camera">
						</div>
						<div id="map"></div>
						</div>


						<div id="result">
						</div>
						<canvas id="canvas" width="640" height="960" style="display:none;"></canvas>

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
	<!-- Leaflet JS -->
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<!-- Leaflet to Image -->
	<script src="https://cdn.jsdelivr.net/npm/leaflet-image@0.4.0/leaflet-image.min.js"></script>
	

	<script>
		/* --- Variabel global --- */
		let userLat = -7.0;
		let userLng = 111.0;
		let wilayah = "-";
		let kota = "-";
		let jenisAbsen = "<?= $jenis_absen ?>";
		const kodeRandom = Math.random().toString(36).substring(2, 8).toLowerCase();


		Webcam.set({
			image_format: 'jpeg',
			jpeg_quality: 50
		});
		Webcam.attach( '#my_camera' );

		/* --- Buat map TERLEBIH DAHULU (penting) --- */
		let map = L.map('map',{
			center: [userLat, userLng],
			zoom: 10,
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
					iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
					shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',

					iconSize:     [15, 20], // ⬅️ PERKECIL DI SINI
					iconAnchor:   [9, 20],  // titik ujung bawah icon
					popupAnchor:  [0, -28],
					shadowSize:   [30, 20]
				});
				L.marker([userLat, userLng], { icon: myIcon }).addTo(map);

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

		function roundedRect(ctx, x, y, width, height, radius) {
			ctx.beginPath();
			ctx.moveTo(x + radius, y);
			ctx.lineTo(x + width - radius, y);
			ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
			ctx.lineTo(x + width, y + height - radius);
			ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
			ctx.lineTo(x + radius, y + height);
			ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
			ctx.lineTo(x, y + radius);
			ctx.quadraticCurveTo(x, y, x + radius, y);
			ctx.closePath();
		}


		document.getElementById("register").addEventListener("submit", function(e) {
			e.preventDefault();

			// Ambil foto webcam
			Webcam.snap(async function(data_uri) {

				// // Tampilkan preview foto
				// document.getElementById("result").innerHTML = '<img src="'+ data_uri + '"/>';
				// document.getElementById("my_camera").style.display = "none";

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
						const response = await fetch(data_uri);
						const blob = await response.blob();

						const bitmap = await createImageBitmap(blob, {
							imageOrientation: "from-image"
						});

						ctx.clearRect(0, 0, canvas.width, canvas.height);
						ctx.drawImage(bitmap, 0, 0, 720, 960);

						const isMasuk = jenisAbsen === "masuk";

						const badgeText  = isMasuk ? "ABSEN MASUK" : "ABSEN KELUAR";
						const badgeColor = isMasuk ? "rgba(40, 167, 69, 0.9)" : "rgba(220, 53, 69, 0.9)";

						// posisi badge
						const bx = 420;
						const by = 650;
						const bw = 200;
						const bh = 46;
						const radius = 14;

						// background
						ctx.fillStyle = badgeColor;
						roundedRect(ctx, bx, by, bw, bh, radius);
						ctx.fill();

						// text
						ctx.font = "bold 22px Arial";
						ctx.fillStyle = "#fff";
						ctx.textAlign = "center";
						ctx.textBaseline = "middle";
						ctx.fillText(badgeText, bx + bw / 2, by + bh / 2);

						// reset align
						ctx.textAlign = "left";
						ctx.textBaseline = "alphabetic";

						// === BACKGROUND PANEL TRANSPARAN ===
						const padding = 20;
						const panelHeight = 220;

						const panelX = padding;
						const panelY = canvas.height - panelHeight - padding;
						const panelWidth = canvas.width - (padding * 2);

						ctx.fillStyle = "rgba(0, 0, 0, 0.6)";
						roundedRect(ctx, panelX, panelY, panelWidth, panelHeight, 16);
						ctx.fill();

						// 2. Load map thumbnail from mapCanvas
						const mapImg = await loadImage(mapCanvas.toDataURL(), { crossOrigin: null });
						const mapSize = 180;
						const mapX = panelX + padding;
						const mapY = panelY + padding;

						ctx.drawImage(mapImg, mapX, mapY, mapSize, mapSize);

						// 3. Load logo (served from your domain)
						const logoImg = await loadImage("<?= base_url('assets/dist/img/logo.png') ?>");
						ctx.drawImage(logoImg, 640 - 150 - 10, 10, 150, 150); // pojok kanan atas, margin 10

						// 4. Tulis teks (tanggal, lokasi, lat/lng, kode)
						ctx.font = "20px Arial";
						ctx.fillStyle = "white";
						ctx.strokeStyle = "black";
						ctx.lineWidth = 3;

						let textX = mapX + mapSize + padding;
						let textY = mapY + 28;

						const writeLine = (text) => {
							ctx.strokeText(text, textX, textY);
							ctx.fillText(text, textX, textY);
							textY += 34;
						};

						const waktu = new Date().toLocaleString("id-ID", {
							day: "2-digit",
							month: "2-digit",
							year: "numeric",
							hour: "2-digit",
							minute: "2-digit"
						}).replace(".", ":");

						writeLine(`${waktu}`, 760);
						writeLine(`${wilayah}, ${kota}`, 800);
						// writeLine("Lat: " + userLat, 840);
						// writeLine("Lng: " + userLng, 880);
						writeLine(`Lat: ${userLat} | Lng: ${userLng}`, 840);
						writeLine("Kode: " + kodeRandom, 920);

						// 5. Finalize image (dataURL)
						const finalImage = canvas.toDataURL("image/jpeg", 0.95);
						document.getElementById('result').src = finalImage;

						// Jalankan proses absen
						await prosesAbsen(finalImage);

					} catch (e) {
						console.error("Error saat proses gambar:", e);
						alert("Terjadi kesalahan saat memproses gambar: " + e.message);
					}
				});
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

						const isMasuk = jenisAbsen === "masuk";
						const modaltext  = isMasuk ? "Hai, selamat datang. semangat yaa kerja hari ini :)" : "Kamu Hebat hari ini, sampai ketemu besok :)";

							await Swal.fire({
									icon: "success",
									title: "Berhasil!",
									html: `
										<p>${hasil.msg || modaltext}</p>
										<div class="mb-4"><img src="${fotoBase64}" style="max-width:100%;border-radius:10px"></div>
									`,
									showDenyButton: !!navigator.share,
									confirmButtonText: "Tutup",
									denyButtonText: "Bagikan",
									denyButtonColor: "#25D366",
									confirmButtonColor: "#3085d6",

									preDeny: async () => {
										try {
											// base64 → blob
											const res = await fetch(fotoBase64);
											const blob = await res.blob();

											const file = new File(
												[blob],
												`absensi_${Date.now()}.jpg`,
												{ type: "image/jpeg" }
											);

											await navigator.share({
												title: "Laporan Absensi",
												text: `Absensi ${jenisAbsen.toUpperCase()} - ${wilayah}, ${kota}`,
												files: [file]
											});

											return false; // jangan tutup alert setelah share
										} catch (err) {
											Swal.showValidationMessage("Gagal membagikan foto");
											return false;
										}
									}
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
		async function kirimKeServer(foto, lat, lon, wilayah, kota, kodeRandom) {
			const payload = {
				id: document.getElementById("id_pegawai").value,
				jenis_absen: document.getElementById("jenis_absen").value,
				imagecam: foto,
				lat: lat,
				lon: lon,
				wilayah: wilayah,
				kota: kota,
				kodeRandom: kodeRandom
			};

			const response = await fetch("<?= site_url('absensi/saveWebcam'); ?>", {
					method: "POST",
					headers: { "Content-Type": "application/json" },
					body: JSON.stringify(payload)
			});

			return await response.json();
		}
	</script>
