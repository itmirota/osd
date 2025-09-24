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
                      <td width="100px">baik sekali</td>
                      <td width="100px">5</td>
                    </tr>
                    <tr>
                      <td>baik</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>cukup</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>kurang</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>kurang sekali</td>
                      <td>1</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            </div>
            <!-- 1 -->
            <!-- <h3><strong>Soft Skill</strong></h3> -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>SKILL COMPETENCY</h6>
                      <h3><strong>Manajemen Limbah & Lingkungan (Environmental Management)</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0"> Mampu mengimplementasikan, memelihara, dan mengawasi sistem manajemen lingkungan (misalnya, ISO). Ini mencakup pengelolaan limbah B3 dan non-B3, pengurangan limbah, efisiensi sumber daya (air, energi), dan kepatuhan terhadap regulasi lingkungan</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Frekuensi keluhan atau resistensi terhadap perubahan</p>
                      <p class="m-0" style="text-align:left">2. Seberapa cepat karyawan mempelajari proses baru atau menggunakan alat kerja yang baru</p>
                      <p class="m-0" style="text-align:left">3. Seberapa konsisten karyawan menunjukkan kemampuan beradaptasi seiring dengan perubahan yang terus berlangsung</p>
                      <p class="m-0" style="text-align:left">4. Seberapa sering karyawan berpartisipasi dalam diskusi tim untuk mengatasi tantangan yang muncul dari perubahan</p> -->
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter1" class="form-label">score</label>
                        <input type="text" name="parameter1" placeholder="1 - 5" class="form-control" required>
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>SKILL COMPETENCY</h6>
                      <h3><strong>Manajemen Proyek (terkait Kualitas)</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Mampu mengelola proyek-proyek peningkatan kualitas, implementasi sistem baru, atau sertifikasi.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p> -->
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter2" class="form-label">score</label>
                        <input type="text" name="parameter2" placeholder="1 - 5" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan2" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan2" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 3 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>SKILL COMPETENCY</h6>
                      <h3><strong>ERP (Enterprise Resource Planning)</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Mampu mengoperasikan dan memanfaatkan sistem informasi manufacture (misalnya, ERP atau MES).</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:left">1. Frekuensi karyawan menyelesaikan tugas tambahan atau mengidentifikasi pekerjaan yang perlu diselesaikan tanpa diminta</p>
                      <p class="m-0"  style="text-align:left">2. Seberapa cepat karyawan menindaklanjuti tugas-tugas yang penting.</p>
                      <p class="m-0"  style="text-align:left">3. Frekuensi karyawan memberikan ide-ide baru yang bermanfaat.</p>
                      <p class="m-0"  style="text-align:left">4. Kualitas dan relevansi ide yang diajukan dalam konteks pekerjaan.</p>
                      <p class="m-0"  style="text-align:left">5. Dampak dari ide-ide yang diimplementasikan terhadap produktivitas tim atau perusahaan.</p> -->
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
                        <input type="text" name="parameter3" placeholder="1 - 5" class="form-control" required>
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
                      <h6>SKILL COMPETENCY</h6>
                      <h3><strong>Manajemen Hubungan Vendor</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Memiliki keahlian dalam membangun, memelihara, dan mengembangkan hubungan jangka panjang yang kuat dan saling menguntungkan dengan vendor. Ini termasuk evaluasi kinerja vendor pest control.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Seberapa sering karyawan menyelesaikan tugas meski dalam situasi penuh tekanan</p>
                      <p class="m-0" style="text-align:left">2. Seberapa cepat dan efektif karyawan menemukan solusi untuk masalah baru</p>
                      <p class="m-0" style="text-align:left">3. Kualitas dari solusi yang diberikan</p> -->
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
                        <input type="text" name="parameter4" placeholder="1 - 5" class="form-control" required>
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
                      <h6>KNOWLEDGE COMPETENCY</h6>
                      <h3><strong>Prinsip Lean Manufacturing & Six Sigma</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Memiliki pemahaman dan pengetahuan tentang metodologi untuk eliminasi pemborosan, peningkatan efisiensi, dan pengurangan variasi dalam proses.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Frekuensi kehadiran tepat waktu, termasuk kehadiran dalam rapat, dan waktu penyelesaian tugas</p>
                      <p class="m-0" style="text-align:left">2. Seberapa efektif memanfaatkan total waktu kerja</p>
                      <p class="m-0" style="text-align:left">3. Seberapa sering karyawan menyelesaikan tugas dengan kualitas yang konsisten sesuai ekspektasi</p>
                      <p class="m-0" style="text-align:left">4. Mampu menjaga nama baik perusahaan</p> -->
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
                        <input type="text" name="parameter5" placeholder="1 - 5" class="form-control" required>

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
                      <h6>KNOWLEDGE COMPETENCY</h6>
                      <h3><strong>Manajemen Risiko Kualitas</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Pengetahuan tentang bagaimana mengidentifikasi, menilai, dan memitigasi risiko-risiko yang dapat memengaruhi kualitas dan keamanan produkMemiliki pemahaman dan pengetahuan tentang metodologi untuk eliminasi pemborosan, peningkatan efisiensi, dan pengurangan variasi dalam proses.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Seberapa sering karyawan menyesuaikan gaya komunikasi mereka untuk lawan bicara yang berbeda (formal dengan atasan, lebih kasual dengan rekan kerja, profesional dengan pihak eksternal)</p>
                      <p class="m-0" style="text-align:left">2. Tingkat kesopanan dan perilaku profesional dalam interaksi dengan klien, mitra, dan rekan kerja</p>
                      <p class="m-0" style="text-align:left">3. Seberapa sering karyawan menjaga komunikasi dan hubungan yang baik dengan pihak eksternal, tanpa merusak nama baik perusahaan</p> -->
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
                        <input type="text" name="parameter6" placeholder="1 - 5" class="form-control" required>

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
                      <h6>KNOWLEDGE COMPETENCY</h6>
                      <h3><strong>Production Process FMCG</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Pemahaman menyeluruh tentang alur dan tahapan proses produksi FMCG di pabrik untuk mengidentifikasi critical control points (CCP) dan quality control points.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:left">1. Seberapa sering karyawan menunjukkan empati terhadap rekan kerja dalam situasi yang sulit.</p>
                      <p class="m-0"  style="text-align:left">2. Seberapa sering rekan kerja atau atasan merasa dapat mengandalkan dan mempercayai karyawan untuk membantu tugas bersama.</p>
                      <p class="m-0"  style="text-align:left">3. Seberapa sering karyawan menunjukkan sikap bersedia bekerja sama dengan satu tim atau departemen lain.</p> -->
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
                        <input type="text" name="parameter7" placeholder="1 - 5" class="form-control" required>

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
                      <h6>KNOWLEDGE COMPETENCY</h6>
                      <h3><strong>Sistem K3</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Memahami sistem kesehatan, keselamatan, dan kecelakaan kerja.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Seberapa sering karyawan memberikan laporan yang jujur tanpa menyembunyikan kesalahan atau kegagalan.</p>
                      <p class="m-0" style="text-align:left">2. Tingkat kepercayaan atasan dan rekan kerja terhadap karyawan dalam menjaga kepentingan perusahaan.</p>
                      <p class="m-0" style="text-align:left">3. Frekuensi karyawan mengakui kesalahan tanpa menyalahkan orang lain.</p>
                      <p class="m-0" style="text-align:left">4. Frekuensi karyawan menyelesaikan tugas tanpa perlu diingatkan atau dipantau secara terus-menerus.</p> -->
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
                        <input type="text" name="parameter8" placeholder="1 - 5" class="form-control" required>
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
                      <h6>KNOWLEDGE COMPETENCY</h6>
                      <h3><strong>Regulasi & Hukum</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Pemahaman tentang peraturan perundang-undangan terkait industri FMCG, labelisasi, dan perlindungan konsumen.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:left">1. Frekuensi karyawan secara sukarela mengajukan/mengikuti pelatihan di luar tuntutan pekerjaan.</p>
                      <p class="m-0"  style="text-align:left">2. Jumlah kegiatan pengembangan diri yang dilakukan karyawan, seperti membaca buku, mengikuti webinar, atau menghadiri seminar.</p>
                      <p class="m-0"  style="text-align:left">3. Seberapa baik karyawan menunjukkan perubahan positif setelah menerima revisi/feedback.</p> -->
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
                        <input type="text" name="parameter9" placeholder="1 - 5" class="form-control" required>

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
            <!-- <h3><strong>Hard Skill</strong></h3> -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>PSYCOLOGICAL TRAIT</h6>
                      <h3><strong>Achievement and Action</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Derajat kepedulian seseorang terhadap pekerjaannya sehingga ia terdorong berusaha untuk bekerja dengan lebih baik atau di atas standar.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Pencapaian Target Penjualan & Penagihan</p>
                      <p class="m-0" style="text-align:left">2. Pengembangan Wilayah</p>
                      <p class="m-0" style="text-align:left">3. Kinerja Tim Lapangan</p>
                      <p class="m-0" style="text-align:left">4. Distribusi & Kelayakan Produk</p>
                      <p class="m-0" style="text-align:left">5. Hubungan Pelanggan & Tenaga Kesehatan</p>
                      <p class="m-0" style="text-align:left">6. Pelaporan dan Administrasi</p> -->
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
                        <!-- <input type="text" name="parameter10" placeholder="1 - 5" class="form-control" value="0"> -->

                      </div>
                      <div class="mb-3">
                        <label for="keterangan10" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan10" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>
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
                      <h6>PSYCOLOGICAL TRAIT</h6>
                      <h3><strong>Problem Solving</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan menganalisis, memilah situasi secara sistematis dan memberikan alternatif solusi untuk menyelesaikan masalah dengan memanfaatkan informasi yang valid.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Target bulanan/semester yang telah ditentukan oleh leader dalam KPI.</p>
                      <p class="m-0" style="text-align:left">2. Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p> -->
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
                        <input type="text" name="parameter11" placeholder="1 - 5" class="form-control" required>

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
            <!-- 12 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>PSYCOLOGICAL TRAIT</h6>
                      <h3><strong>Business Orientation</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan untuk mengelola kinerja dan pemanfaatan sumber daya dengan prinsip-prinsip bisnis yang efektif dan efisien, serta melakukan pengembangan bisnis yang berkelanjutan.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Target bulanan/semester yang telah ditentukan oleh leader dalam KPI.</p>
                      <p class="m-0" style="text-align:left">2. Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p> -->
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter12" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter11"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter12" placeholder="1 - 5" class="form-control" required>

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
            <!-- 13 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>PSYCOLOGICAL TRAIT</h6>
                      <h3><strong>Initiative</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemauan untuk bertindak tanpa menunggu perintah, termasuk mengantisipasi masalah atau peluang dan mengambil tindakan lebih awal untuk menyelesaikannya.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Target bulanan/semester yang telah ditentukan oleh leader dalam KPI.</p>
                      <p class="m-0" style="text-align:left">2. Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p> -->
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter13" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter11"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter13" placeholder="1 - 5" class="form-control" required>

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
            <!-- 14 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>PSYCOLOGICAL TRAIT</h6>
                      <h3><strong>Impact and Influence</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Tindakan, membujuk, meyakinkan mempengaruhi orang lain sehingga mau mendukung rencana perusahaan serta mempengaruhi dalam hal positif.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Target bulanan/semester yang telah ditentukan oleh leader dalam KPI.</p>
                      <p class="m-0" style="text-align:left">2. Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p> -->
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter14" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter11"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter14" placeholder="1 - 5" class="form-control" required>

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
            <!-- 15 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>PSYCOLOGICAL TRAIT</h6>
                      <h3><strong>Relationship Building</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Pengelolaan seluruh siklus pengadaan produk, termasuk pemilihan supplier, pertemuan, permintaan penawaran, klarifikasi.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Target bulanan/semester yang telah ditentukan oleh leader dalam KPI.</p>
                      <p class="m-0" style="text-align:left">2. Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p> -->
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter15" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter11"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter15" placeholder="1 - 5" class="form-control" required>

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
            <!-- 16 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>PSYCOLOGICAL TRAIT</h6>
                      <h3><strong>Communication</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan untuk menerangkan pandangan dan gagasan secara jelas, sistematis disertai argumentasi yang logis dengan cara-cara yang sesuai baik secara lisan maupun tertulis; memastikan pemahaman; mendengarkan secara aktif dan efektif; mempersuasi, meyakinkan dan membujuk orang lain dalam rangka mencapai tujuan organisasi.</p>
                      <!-- <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:left">1. Target bulanan/semester yang telah ditentukan oleh leader dalam KPI.</p>
                      <p class="m-0" style="text-align:left">2. Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p> -->
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter16" class="form-label">score</label>
                        <!-- <select class="form-select" name="parameter11"  aria-label="Default select example">
                          <option selected>Pilih score</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter16" placeholder="1 - 5" class="form-control" required>

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
            <div class="col-md-12">
              <label for="rekomendasi" class="form-label">Layak Dipertahankan :</label>
              <select name="rekomendasi" class="form-select tabel-PR" placeholder="masukkan kategori disini" required>
                <option>----- pilih kategori ---</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="12">1 Tahun</option>
              </select>
            </div>
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