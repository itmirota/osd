<div class="d-flex justify-content-center">
<div class="col-md-12">
  <form action="<?= base_url('evaluasiKerja/saveNilai')?>" role="form" method="post" enctype="multipart/form-data">
  <div class="card p-2">
    <div class="card-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12 alert alert-info" role="alert">
                <div class="col-md-12">
                  <label for="nama_peserta" class="form-label">Nama Pegawai</label>
                  <input type="text" name="nama_peserta" class="form-control-plaintext tabel-PR" value="<?= $list_data->nama_pegawai?>" readonly>
                  <input type="hidden" name="evaluasiKerja_id" class="form-control tabel-PR" value="<?= $list_data->id_evaluasi?>" readonly>
                </div>
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
                      <td><strong>poin</strong></td>
                      <td><strong>Score</strong></td>
                    </tr>             
                    <tr>
                      <td>5</td>
                      <td>91 - 100</td>
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
            <!-- SOAL -->
            <?php foreach ($soal_evaluasi as $soal) { ?>
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <h6><?= $soal->parameter ?></h6>
                      <h3><strong><?= $soal->judul ?></strong></h3>
                      <p class="m-0"><strong>Deskripsi:</strong></p>
                      <p class="m-0"><?= $soal->deskripsi ?></p>
                      <p class="m-0"><strong>Aspek Pengukuran:</strong></p>
                      <p class="m-0"  style="text-align:left">1. Frekuensi karyawan menyelesaikan tugas tambahan atau mengidentifikasi pekerjaan yang perlu diselesaikan tanpa diminta</p>
                      <p class="m-0"  style="text-align:left">2. Seberapa cepat karyawan menindaklanjuti tugas-tugas yang penting.</p>
                      <p class="m-0"  style="text-align:left">3. Frekuensi karyawan memberikan ide-ide baru yang bermanfaat.</p>
                      <p class="m-0"  style="text-align:left">4. Kualitas dan relevansi ide yang diajukan dalam konteks pekerjaan.</p>
                      <p class="m-0"  style="text-align:left">5. Dampak dari ide-ide yang diimplementasikan terhadap produktivitas tim atau perusahaan.</p>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="nilai_<?=$soal->id_evaluasi_soal?>" class="form-label">score</label>
                        <input type="text" name="nilai_<?=$soal->id_evaluasi_soal?>" placeholder="contoh 100" class="form-control" required>
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
            <?php }?>
            <!-- SOAL -->
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