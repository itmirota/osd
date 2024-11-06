<div class="d-flex justify-content-center">
<div class="col-lg-12">
  <form action="<?= base_url('evaluasiMagang/savePenilaian')?>" role="form" method="post" enctype="multipart/form-data">
  <div class="card p-2">
    <div class="card-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12 alert alert-info" role="alert">
                <?php foreach($list_data as $ld): ?>
                <div class="col-md-12">
                  <label for="nama_peserta" class="form-label">Nama Pegawai</label>
                  <input type="text" name="nama_peserta" class="form-control-plaintext tabel-PR" value="<?= $ld->nama_peserta?>" readonly>
                  <input type="hidden" name="evaluasiMagang_id" class="form-control tabel-PR" value="<?= $ld->id_evaluasiKerja?>" readonly>
                </div>
                <?php endforeach ?>
                <div class="col-md-12">
                  <label for="nama_penilai" class="form-label">Nama Penilai</label>
                  <input type="text" name="nama_penilai" class="form-control-plaintext tabel-PR" value="<?= $ld->name?>" required />
                </div>
                <div class="col-md-12">
                  <label for="jabatan_bagian" class="form-label">Jabatan dan Bagian Penilai</label>
                  <input type="text" name="jabatan_bagian" class="form-control tabel-PR" placeholder="co: Manager - Operasional" required />
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
                      <td width="100px">5</td>
                      <td width="100px">91% - 100%</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>81% - 90%</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>71% - 80%</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>61% - 70%</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>50% - 60%</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            </div>

            <div class="row">
              <div class="card">
                <div class="card-body">
                  <div class="responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th width="100px">Sub</th>
                          <th width="100px">Indikator</th>
                          <th width="200px">Deskripsi</th>
                          <th width="300px">Aspek Pengukuran</th>
                          <th>Nilai</th>
                          <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- 1 -->
                        <tr>
                          <td>Lingkup Kerja</td>
                          <td>Pencapaian Kinerja</td>
                          <td>Sejauh mana karyawan mencapai target yang telah di tetapkan</td>
                          <td>Target bulanan/semester yang telah ditentukan oleh leader dalam KPI</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter1"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter1" placeholder="Tulis poin disini" class="form-control" required>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan1" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 2 -->
                        <tr>
                          <td>Lingkup Kerja</td>
                          <td>Kualitas Kerja</td>
                          <td>Tingkat ketelitian, keefektifan, dan kualitas hasil kerja yang dihasilkan.</td>
                          <td>Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter2"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter2" placeholder="Tulis poin disini" class="form-control" required>
                              
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan2" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 3 -->
                        <tr>
                          <td>Lingkup Kerja</td>
                          <td>Problem Solving</td>
                          <td>Kemampuan karyawan menghadapi dan mengatasi tantangan dalam pekerjaan.</td>
                          <td>Seberapa sering karyawan menyelesaikan tugas meski dalam situasi penuh tekanan, Seberapa cepat dan efektif karyawan menemukan solusi untuk masalah baru & Kualitas dari solusi yang diberikan.</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter3"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter3" placeholder="Tulis poin disini" class="form-control" required>

                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan3" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 4 -->
                        <tr>
                          <td>Lingkup Kerja</td>
                          <td>Inisiatif</td>
                          <td>Tingkat proaktif dalam menyelesaikan tugas dan memberikan ide-ide baru.</td>
                          <td>Frekuensi karyawan menyelesaikan tugas tambahan atau mengidentifikasi pekerjaan yang perlu diselesaikan tanpa diminta, Seberapa cepat karyawan menindaklanjuti tugas-tugas yang penting, Frekuensi karyawan memberikan ide-ide baru yang bermanfaat dan Kualitas dan relevansi ide yang diajukan dalam konteks pekerjaan serta Dampak dari ide-ide yang diimplementasikan terhadap produktivitas tim atau perusahaan.</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter4"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter4" placeholder="Tulis poin disini" class="form-control" required>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan4" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 5 -->
                        <tr>
                          <td>Lingkup Kerja</td>
                          <td>Agility</td>
                          <td>Kemampuan karyawan menyesuaikan diri dengan perubahan lingkungan kerja.</td>
                          <td>Frekuensi keluhan atau resistensi terhadap perubahan, Seberapa cepat karyawan mempelajari proses baru atau menggunakan alat kerja yang baru, Seberapa konsisten karyawan menunjukkan kemampuan beradaptasi seiring dengan perubahan yang terus berlangsung, Seberapa sering karyawan berpartisipasi dalam diskusi tim untuk mengatasi tantangan yang muncul dari perubahan.</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter5"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter5" placeholder="Tulis poin disini" class="form-control" required>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan5" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 6 -->
                        <tr>
                          <td>Sikap & Perilaku</td>
                          <td>Dicipline</td>
                          <td>Ketaatan terhadap aturan perusahaan dan waktu kerja.</td>
                          <td>Frekuensi pelanggaran peraturan perusahaan yang dilakukan, Seberapa sering tidak masuk kerja tanpa keterangan, Seberapa sering terlambat dan waktu kerja tidak sesuai peraturan perusahaan (dilihat dari absensi) serta seberapa efektif memanfaatkan total waktu kerja.</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter6"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter6" placeholder="Tulis poin disini" class="form-control" required>

                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan6" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 7 -->
                        <tr>
                          <td>Sikap & Perilaku</td>
                          <td>Communication</td>
                          <td>Kemampuan berkomunikasi dengan baik dengan rekan kerja, atasan, dan pihak eksternal.</td>
                          <td>Seberapa sering karyawan menyesuaikan gaya komunikasi mereka untuk lawan bicara yang berbeda (formal dengan atasan, lebih kasual dengan rekan kerja, profesional dengan pihak eksternal).</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter7"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter7" placeholder="Tulis poin disini" class="form-control" required>

                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan7" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 8 -->
                        <tr>
                          <td>Sikap & Perilaku</td>
                          <td>Team Work</td>
                          <td>Kemampuan bekerja sama dalam tim dan membangun hubungan yang baik dengan orang lain.</td>
                          <td>Seberapa sering karyawan menunjukkan empati terhadap rekan kerja dalam situasi yang sulit, Seberapa sering rekan kerja atau atasan merasa dapat mengandalkan dan mempercayai karyawan untuk membantu tugas bersama, Seberapa sering karyawan menunjukkan sikap bersedia bekerja sama dengan satu tim atau departemen lain.</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter8"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter8" placeholder="Tulis poin disini" class="form-control" required>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan8" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 9 -->
                        <tr>
                          <td>Sikap & Perilaku</td>
                          <td>Etica</td>
                          <td>Integritas, kejujuran, dan tanggung jawab dalam bekerja..</td>
                          <td>Seberapa sering karyawan memberikan laporan yang jujur tanpa menyembunyikan kesalahan atau kegagalan, Tingkat kepercayaan atasan dan rekan kerja terhadap karyawan dalam menjaga kepentingan perusahaan, Frekuensi karyawan mengakui kesalahan tanpa menyalahkan orang lain, Frekuensi karyawan menyelesaikan tugas tanpa perlu diingatkan atau dipantau secara terus-menerus.</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter9"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter9" placeholder="Tulis poin disini" class="form-control" required>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan9" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 10 -->
                        <tr>
                          <td>Sikap & Perilaku</td>
                          <td>Profesionals</td>
                          <td>Tingkat profesionalisme dalam menjalankan tugas dan mewakili perusahaan.</td>
                          <td>Frekuensi kehadiran tepat waktu, termasuk kehadiran dalam rapat, dan waktu penyelesaian tugas, Seberapa sering karyawan menyelesaikan tugas dengan kualitas yang konsisten sesuai ekspektasi, Tingkat kesopanan dan perilaku profesional dalam interaksi dengan klien, mitra, dan rekan kerja, Seberapa sering karyawan menjaga komunikasi dan hubungan yang baik dengan pihak eksternal, tanpa merusak nama baik perusahaan.</td>
                          <td>                      
                            <div class="mb-3">
                              <!-- <select class="form-select" name="parameter10"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select> -->
                              <input type="text" name="parameter10" placeholder="Tulis poin disini" class="form-control" required>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan10" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                        <!-- 11 -->
                        <tr>
                          <td>Sikap & Perilaku</td>
                          <td>Learning</td>
                          <td>Semangat karyawan untuk terus belajar.</td>
                          <td>Frekuensi karyawan secara sukarela mengajukan/mengikuti pelatihan di luar tuntutan pekerjaan, Jumlah kegiatan pengembangan diri yang dilakukan karyawan, seperti membaca buku, mengikuti webinar, atau menghadiri seminar, Seberapa baik karyawan menunjukkan perubahan positif setelah menerima revisi/feedback.</td>
                          <td>                      
                            <!-- <div class="mb-3">
                              <select class="form-select" name="parameter11"  aria-label="Default select example">
                                <option selected>Pilih Poin</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                            </div> -->
                            <input type="text" name="parameter11" placeholder="Tulis poin disini" class="form-control" required>
                          </td>
                          <td>
                            <div class="mb-3">
                              <textarea class="form-control" name="keterangan11" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Pencapaian Kinerja</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Sejauh mana karyawan mencapai target yang telah di tetapkan</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Target bulanan/semester yang telah ditentukan oleh leader dalam KPI</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter1" class="form-label">Poin</label>
                        <select class="form-select" name="parameter1"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan1" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan1" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Kualitas Kerja</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Sejauh mana karyawan mencapai target yang telah di tetapkan </p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Kualitas hasil kerja dari setiap program yang dibuat/target yang telah ditentukan sudah memenuhi standar atau belum serta melebihi batas waktu pengerjaan atau tidak.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter2" class="form-label">Poin</label>
                        <select class="form-select" name="parameter2"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
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

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Problem Solving</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan karyawan menghadapi dan mengatasi tantangan dalam pekerjaan</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:justify">Seberapa sering karyawan menyelesaikan tugas meski dalam situasi penuh tekanan, Seberapa cepat dan efektif karyawan menemukan solusi untuk masalah baru & Kualitas dari solusi yang diberikan</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter3" class="form-label">Poin</label>
                        <select class="form-select" name="parameter3"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan3" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan3" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Inisiatif</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Tingkat proaktif dalam menyelesaikan tugas dan memberikan ide-ide baru.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Frekuensi karyawan menyelesaikan tugas tambahan atau mengidentifikasi pekerjaan yang perlu diselesaikan tanpa diminta, Seberapa cepat karyawan menindaklanjuti tugas-tugas yang penting, Frekuensi karyawan memberikan ide-ide baru yang bermanfaat dan Kualitas dan relevansi ide yang diajukan dalam konteks pekerjaan serta Dampak dari ide-ide yang diimplementasikan terhadap produktivitas tim atau perusahaan.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter4" class="form-label">Poin</label>
                        <select class="form-select" name="parameter4"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan4" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan4" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>

                    </div>


                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Agility</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan karyawan menyesuaikan diri dengan perubahan lingkungan kerja</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Frekuensi keluhan atau resistensi terhadap perubahan, Seberapa cepat karyawan mempelajari proses baru atau menggunakan alat kerja yang baru, Seberapa konsisten karyawan menunjukkan kemampuan beradaptasi seiring dengan perubahan yang terus berlangsung, Seberapa sering karyawan berpartisipasi dalam diskusi tim untuk mengatasi tantangan yang muncul dari perubahan</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter5" class="form-label">Poin</label>
                        <select class="form-select" name="parameter5"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan5" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan5" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Dicipline</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Ketaatan terhadap aturan perusahaan dan waktu kerja.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Frekuensi pelanggaran peraturan perusahaan yang dilakukan, Seberapa sering tidak masuk kerja tanpa keterangan, Seberapa sering terlambat dan waktu kerja tidak sesuai peraturan perusahaan (dilihat dari absensi) serta seberapa efektif memanfaatkan total waktu kerja.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter6" class="form-label">Poin</label>
                        <select class="form-select" name="parameter6"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan6" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan6" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>

                    </div>


                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Communication</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan berkomunikasi dengan baik dengan rekan kerja, atasan, dan pihak eksternal.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:justify">Seberapa sering karyawan menyesuaikan gaya komunikasi mereka untuk lawan bicara yang berbeda (formal dengan atasan, lebih kasual dengan rekan kerja, profesional dengan pihak eksternal).</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter7" class="form-label">Poin</label>
                        <select class="form-select" name="parameter7"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan7" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan7" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Team Work</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan bekerja sama dalam tim dan membangun hubungan yang baik dengan orang lain.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Seberapa sering karyawan menunjukkan empati terhadap rekan kerja dalam situasi yang sulit, Seberapa sering rekan kerja atau atasan merasa dapat mengandalkan dan mempercayai karyawan untuk membantu tugas bersama, Seberapa sering karyawan menunjukkan sikap bersedia bekerja sama dengan satu tim atau departemen lain.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter4" class="form-label">Poin</label>
                        <select class="form-select" name="parameter4"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan4" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan4" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>

                    </div>


                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Etika</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Integritas, kejujuran, dan tanggung jawab dalam bekerja.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:justify">Seberapa sering karyawan memberikan laporan yang jujur tanpa menyembunyikan kesalahan atau kegagalan, Tingkat kepercayaan atasan dan rekan kerja terhadap karyawan dalam menjaga kepentingan perusahaan, Frekuensi karyawan mengakui kesalahan tanpa menyalahkan orang lain, Frekuensi karyawan menyelesaikan tugas tanpa perlu diingatkan atau dipantau secara terus-menerus.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter8" class="form-label">Poin</label>
                        <select class="form-select" name="parameter8"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan8" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan8" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Profesionals</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Tingkat profesionalisme dalam menjalankan tugas dan mewakili perusahaan.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Frekuensi kehadiran tepat waktu, termasuk kehadiran dalam rapat, dan waktu penyelesaian tugas, Seberapa sering karyawan menyelesaikan tugas dengan kualitas yang konsisten sesuai ekspektasi, Tingkat kesopanan dan perilaku profesional dalam interaksi dengan klien, mitra, dan rekan kerja, Seberapa sering karyawan menjaga komunikasi dan hubungan yang baik dengan pihak eksternal, tanpa merusak nama baik perusahaan.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter9" class="form-label">Poin</label>
                        <select class="form-select" name="parameter9"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan9" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan9" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Learning</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Semangat karyawan untuk terus belajar.</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0" style="text-align:justify">Frekuensi karyawan secara sukarela mengajukan/mengikuti pelatihan di luar tuntutan pekerjaan, Jumlah kegiatan pengembangan diri yang dilakukan karyawan, seperti membaca buku, mengikuti webinar, atau menghadiri seminar, Seberapa baik karyawan menunjukkan perubahan positif setelah menerima revisi/feedback.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter9" class="form-label">Poin</label>
                        <select class="form-select" name="parameter9"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="keterangan9" class="form-label">Penjelasan</label>
                        <textarea class="form-control" name="keterangan9" placeholder="Tulis keterangan disini" id="floatingTextarea"></textarea>
                      </div>

                    </div>


                  </div>
                </div>
              </div>
            </div> -->

            <div class="col-md-12">
              <label for="kelebihan" class="form-label">Hal yang perlu dipertahankan dari yang bersangkutan (Kelebihan)</label>
              <textarea type="text" name="kelebihan" class="form-control tabel-PR"></textarea>
            </div>
            <div class="col-md-12">
              <label for="kekurangan" class="form-label">Hal yang perlu ditingkatkan dari yang bersangkutan (Kekurangan)</label>
              <textarea type="text" name="kekurangan" class="form-control tabel-PR"></textarea>
            </div>
            <div class="col-md-12">
              <label for="masa_akhir" class="form-label">Tujuan Evaluasi</label>
              <select class="form-select" name="masa_akhir">
                <option>--pilih tujuan--</option>
                <option value="Probations">Masa Akhir Probation</option>
                <option value="kontrak">Masa Akhir Kontrak</option>
              </select>
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