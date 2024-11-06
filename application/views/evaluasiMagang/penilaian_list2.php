<div class="d-flex justify-content-center">
<div class="col-md-10">
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
                  <input type="hidden" name="evaluasiMagang_id" class="form-control tabel-PR" value="<?= $ld->id_evaluasiMagang?>" readonly>
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
                      <td width="100px"><strong>Poin</strong></td>
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
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Pemahaman Tugas</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Memahami tugas dan tanggung jawab yang diberikan oleh pembimbing</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <li>Keterampilan dalam memahami tugas</li>
                      <li>Mengajukan pertanyaan relevan terkait tugas yang diberikan</li>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter1" class="form-label">Poin</label>
                        <!-- <select class="form-select" name="parameter1"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">50% -</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter1" placeholder="contoh 100" class="form-control" required>
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
            <!-- 2 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Kualitas Pekerjaan</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Hasil kerja sesuai dengan standar yang ditetapkan oleh perusahaan/pembimbing</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <li>Kerapihan hasil kerja</li>
                      <li>Minimnya kesalahan</li>
                      <li>Mematuhi standar kualitas yang diberikan</li>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter2" class="form-label">Poin</label>
                        <!-- <select class="form-select" name="parameter2"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
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
            </div>
            <!-- 3 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Inisiatif</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Mampu mengambil inisiatif dalam menyelesaikan tugas</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <li>Frekuensi dalam mengusulkan solusi yang bermanfaat</li>
                      <li>Proaktif dalam mencari cara kerja yang lebih efisien</li>
                      <li>Tidak menunggu arahan untuk memulai tugas</li>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter3" class="form-label">Poin</label>
                        <!-- <select class="form-select" name="parameter3"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter3" placeholder="contoh 100" class="form-control" required>
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
            <!-- 4 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Penyelesaian Tugas</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan menyelesaikan tugas tepat waktu</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <li>Manajemen waktu yang baik dalam menyelesaikan tugas</li>
                      <li>Dapat menentukan prioritas yang tepat dalam pekerjaan</li>
                      <li>Frekuensi dalam menyelesaikan tugas tepat waktu</li>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter4" class="form-label">Poin</label>
                        <!-- <select class="form-select" name="parameter4"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter4" placeholder="contoh 100" class="form-control" required>
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
            <!-- 5 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Lingkup Kerja</h6>
                      <h3><strong>Kerjasama Tim</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan berkolaborasi dengan tim baik dalam satu divisi atau dengan divisi lain</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <li>Aktif berpartisipasi dalam diskusi tim</li>
                      <li>Aktif dalam membantu tugas rekan tim </li>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter5" class="form-label">Poin</label>
                        <!-- <select class="form-select" name="parameter5"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter5" placeholder="contoh 100" class="form-control" required>

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
            <!-- 6 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Etika Kerja</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Mematuhi aturan dan kebijakan pembimbing/perusahaan</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <li>Frekuensi kehadiran selama periode magang</li>
                      <li>Mematuhi semua kebijakan dan peraturan yang berlaku diperusahaan </li>
                      <li>Menjaga kerahasiaan informasi perusahaan dengan baik</li>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter6" class="form-label">Poin</label>
                        <!-- <select class="form-select" name="parameter6"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter6" placeholder="contoh 100" class="form-control" required>

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
            <!-- 7 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Etika Komunikasi</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Kemampuan berkomunikasi dengan baik dan sesuai etika dengan semua orang di perusahaan</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <li>Menunjukkan sikap sopan dalam interaksi dengan rekan kerja</li>
                      <li>Kemampuan dalam berkomunikasi terkait pekerjaan</li>
                      <li>Kemampuan Public Speaking</li>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter7" class="form-label">Poin</label>
                        <!-- <select class="form-select" name="parameter7"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter7" placeholder="contoh 100" class="form-control" required>

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
            <!-- 8 -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6>Sikap & Perilaku</h6>
                      <h3><strong>Fleksibilitas</strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0">Mampu beradaptasi dengan perubahan yang terjadi dilingkungan kerja</p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <li>Frekuensi kesiapan untuk belajar hal baru</li>
                      <li>Terbuka terhadap umpan balik dan kritik untuk perbaikan diri</li>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="parameter8" class="form-label">Poin</label>
                        <!-- <select class="form-select" name="parameter8"  aria-label="Default select example">
                          <option selected>Pilih Poin</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select> -->
                        <input type="text" name="parameter8" placeholder="contoh 100" class="form-control" required>
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