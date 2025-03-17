<div class="d-flex justify-content-center">
<div class="col-md-10">
  <form action="<?= base_url('evaluasiKerja/savePenilaian')?>" role="form" method="post" enctype="multipart/form-data">
  <div class="card p-2">
    <div class="card-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12 alert alert-info" role="alert">
                <?php foreach($list_data as $ld): ?>
                <div class="col-md-12">
                  <label for="nama_peserta" class="form-label">Nama Pegawai</label>
                  <input type="text" name="nama_peserta" class="form-control-plaintext tabel-PR" value="<?= $ld->nama_peserta?>" readonly>
                  <input type="hidden" name="evaluasiKerja_id" class="form-control tabel-PR" value="<?= $ld->id_evaluasiKerja?>" readonly>
                </div>
                <?php endforeach ?>
                <div class="col-md-12">
                  <label for="nama_penilai" class="form-label">Nama Penilai</label>
                  <input type="text" name="nama_penilai" class="form-control-plaintext tabel-PR" value="<?= $name?>" required />
                </div>
                <div class="col-md-12">
                  <label for="jabatan_bagian" class="form-label">Jabatan dan Bagian Penilai</label>
                  <input type="text" name="jabatan_bagian" class="form-control-plaintext tabel-PR" value="<?= $pegawai->nama_jabatan.' - '.$pegawai->nama_departement.'/'.$pegawai->nama_divisi?>" required />
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4 mb-4">
                <div class="col-md-12 alert alert-success" role="alert">
                <table class="table table-hover">
                  <thead>
                  <tr>
                    <th colspan="2"  class="text-center" style="font-size:20px">Norma Penilaian</th>
                  </tr>
                  </thead>
                  <tbody  class="text-center">    
                    <tr>
                      <td width="100px"><strong>poin</strong></td>
                      <td width="100px"><strong>Score</strong></td>
                    </tr>             
                    <tr>
                      <td width="100px">5</td>
                      <td width="100px">91 - 100</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>81 - 90</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>71 - 80</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>61 - 70</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>50 - 60</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            </div>
            <!-- 1 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Agility</h6>
                      <h3><strong>Adaptif</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan karyawan menyesuaikan diri dengan perubahan lingkungan kerja.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Frekuensi keluhan atau resistensi terhadap perubahan</p>
                      <p class="m-0" style="text-align:left">2. Seberapa cepat karyawan mempelajari proses baru atau menggunakan alat kerja yang baru</p>
                      <p class="m-0" style="text-align:left">3. Seberapa konsisten karyawan menunjukkan kemampuan beradaptasi seiring dengan perubahan yang terus berlangsung</p>
                      <p class="m-0" style="text-align:left">4. Seberapa sering karyawan berpartisipasi dalam diskusi tim untuk mengatasi tantangan yang muncul dari perubahan</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter1" class="form-label">score</label>
                        <input type="text" name="parameter1" placeholder="contoh 100" class="form-control" required>
                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan1" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan1" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 2 -->
            <!-- <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Kualitas Kerja</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Tingkat ketelitian, keefektifan, dan kualitas hasil kerja yang dihasilkan.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter2" class="form-label">score</label>
                        <input type="text" name="parameter2" placeholder="contoh 100" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan2" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan2" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>

                    </div>


                  </div>
                </div>
              </div>
            </div> -->
            <!-- 3 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Inisiatif</h6>
                      <h3><strong>Inovatif & Proaktif</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Tingkat proaktif dalam menyelesaikan tugas dan memberikan ide-ide baru.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:justify">1. Frekuensi karyawan menyelesaikan tugas tambahan atau mengidentifikasi pekerjaan yang perlu diselesaikan tanpa diminta</p>
                      <p class="m-0"  style="text-align:justify">2. Seberapa cepat karyawan menindaklanjuti tugas-tugas yang penting.</p>
                      <p class="m-0"  style="text-align:justify">3. Frekuensi karyawan memberikan ide-ide baru yang bermanfaat.</p>
                      <p class="m-0"  style="text-align:justify">4. Kualitas dan relevansi ide yang diajukan dalam konteks pekerjaan.</p>
                      <p class="m-0"  style="text-align:justify">5. Dampak dari ide-ide yang diimplementasikan terhadap produktivitas tim atau perusahaan.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter3" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter3"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter3" placeholder="contoh 100" class="form-control" required>
                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan3" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan3" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 4 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Problem Solving</h6>
                      <h3><strong>Resilience</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan karyawan menghadapi dan mengatasi tantangan dalam pekerjaan.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Seberapa sering karyawan menyelesaikan tugas meski dalam situasi penuh tekanan</p>
                      <p class="m-0" style="text-align:left">2. Seberapa cepat dan efektif karyawan menemukan solusi untuk masalah bar</p>
                      <p class="m-0" style="text-align:left">3. Kualitas dari solusi yang diberikan</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter4" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter4"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter4" placeholder="contoh 100" class="form-control" required>
                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan4" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan4" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 5 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Profesionals</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Tingkat profesionalisme dalam menjalankan tugas dan mewakili perusahaan.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Tingkat profesionalisme dalam menjalankan tugas dan mewakili perusahaan.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter5" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter5"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter5" placeholder="contoh 100" class="form-control" required>

                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan5" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan5" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 6 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Communication</h6>
                      <h3><strong>Etika Komunikasi</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan berkomunikasi dengan baik dengan rekan kerja, atasan, dan pihak eksternal.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Seberapa sering karyawan menyesuaikan gaya komunikasi mereka untuk lawan bicara yang berbeda (formal dengan atasan, lebih kasual dengan rekan kerja, profesional dengan pihak eksternal)</p>
                      <p class="m-0" style="text-align:left">2. Tingkat kesopanan dan perilaku profesional dalam interaksi dengan klien, mitra, dan rekan kerja</p>
                      <p class="m-0" style="text-align:left">3. Seberapa sering karyawan menjaga komunikasi dan hubungan yang baik dengan pihak eksternal, tanpa merusak nama baik perusahaan</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter6" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter6"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter6" placeholder="contoh 100" class="form-control" required>

                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan6" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan6" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 7 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Team Work</h6>
                      <h3><strong>Sinergi</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan bekerja sama dalam tim dan membangun hubungan yang baik dengan orang lain.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:left">1. Seberapa sering karyawan menunjukkan empati terhadap rekan kerja dalam situasi yang sulit.</p>
                      <p class="m-0"  style="text-align:left">2. Seberapa sering rekan kerja atau atasan merasa dapat mengandalkan dan mempercayai karyawan untuk membantu tugas bersama.</p>
                      <p class="m-0"  style="text-align:left">3. Seberapa sering karyawan menunjukkan sikap bersedia bekerja sama dengan satu tim atau departemen lain.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter7" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter7"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter7" placeholder="contoh 100" class="form-control" required>

                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan7" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan7" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 8 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Etica</h6>
                      <h3><strong>Integritas & Akuntable</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Integritas, kejujuran, dan tanggung jawab dalam bekerja.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Seberapa sering karyawan memberikan laporan yang jujur tanpa menyembunyikan kesalahan atau kegagalan.</p>
                      <p class="m-0" style="text-align:left">2. Tingkat kepercayaan atasan dan rekan kerja terhadap karyawan dalam menjaga kepentingan perusahaan.</p>
                      <p class="m-0" style="text-align:left">3. Frekuensi karyawan mengakui kesalahan tanpa menyalahkan orang lain.</p>
                      <p class="m-0" style="text-align:left">4. Frekuensi karyawan menyelesaikan tugas tanpa perlu diingatkan atau dipantau secara terus-menerus.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter8" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter8"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter8" placeholder="contoh 100" class="form-control" required>
                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan8" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan8" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->

                    </div>


                  </div>
                </div>
              </div>
            </div>
            <!-- 9 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Learning</h6>
                      <h3><strong>Continues Improvement</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Semangat karyawan untuk terus belajar.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:left">1. Frekuensi karyawan secara sukarela mengajukan/mengikuti pelatihan di luar tuntutan pekerjaan.</p>
                      <p class="m-0"  style="text-align:left">2. Jumlah kegiatan pengembangan diri yang dilakukan karyawan, seperti membaca buku, mengikuti webinar, atau menghadiri seminar.</p>
                      <p class="m-0"  style="text-align:left">3. Seberapa baik karyawan menunjukkan perubahan positif setelah menerima revisi/feedback.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter9" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter9"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter9" placeholder="contoh 100" class="form-control" required>

                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan9" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan9" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 10 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>TUPOKSI</h6>
                      <h3><strong>Tugas Pokok Divisi</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Bertanggung jawab mengontrol perangkat keras dan jaringan (Komputer, Hardware, LAN dan CCTV).</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Perbaikan dan perawatan berkala hardware, jaringan, dan CCTV</p>
                      <p class="m-0" style="text-align:left">2. Pengadaan hardware dan jaringan.</p>
                      <p class="m-0" style="text-align:left">3. Instalasi, upgrade, konfigurasi, dan pemeliharaan sistem operasi (OS, Windows, Linux).</p>
                      <p class="m-0" style="text-align:left">4. Pendataan berkala terkait dengan aset hardware.</p>
                      <p class="m-0" style="text-align:left">5. Pembuatan laporan pembelian, tagihan, dan perawatan hardware dan jaringan.</p>
                      <p class="m-0" style="text-align:left">6. Penanganan atas keluhan terkait hardware dan jaringan dari divisi lain.</p>
                      <p class="m-0" style="text-align:left">7. Pencegahan virus dan malware.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter10" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter10"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter10" placeholder="contoh 100" class="form-control" required>

                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan10" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan10" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 11 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Achievement & Action</h6>
                      <!-- <h3><strong>Learning</strong></h3> -->
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Sejauh mana karyawan mencapai target yang telah di tetapkan.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Target bulanan/semester yang telah ditentukan oleh leader dalam KPI.</p>
                      <p class="m-0" style="text-align:left">2. Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter11" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter11"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter11" placeholder="contoh 100" class="form-control" required>

                      </div>
                      <!-- <div class="mb-3">
                        <label for="keterangan11" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan11" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <label for="kelebihan" class="form-label">Hal yang perlu dipertahankan dari yang bersangkutan (Kelebihan)</label>
              <textarea type="text" name="kelebihan" class="form-control tabel-PR"></textarea>
            </div>
            <div class="col-md-12">
              <label for="kekurangan" class="form-label">Hal yang perlu ditingkatkan dari yang bersangkutan (Kekurangan)</label>
              <textarea type="text" name="kekurangan" class="form-control tabel-PR"></textarea>
            </div>
            <!-- <div class="col-md-12">
              <label for="rekomendasi" class="form-label">Layak Dipertahankan :</label>
              <select name="rekomendasi" class="form-select tabel-PR" placeholder="masukkan kategori disini" required>
                <option>----- pilih kategori ---</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="12">1 Tahun</option>
              </select>
            </div> -->
          </div>
        </div>
    </div>
    <div class="card-footer">
      <div class="col-12 d-flex justify-content-end">
      <button class="btn btn-primary"> Simpan</button>
      </div>
    </div>
  </div>
  </form>
</div>
</div>