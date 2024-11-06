<div class="d-flex justify-content-center">
<div class="col-md-6">
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
                  <input type="text" name="nama_penilai" class="form-control tabel-PR" placeholder="masukkan nama anda disini" required />
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
                    <th colspan="2">Norma Penilaian</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                      <td>Baik Sekali</td>
                      <td>100 | 90</td>
                    </tr>
                    <tr>
                      <td>Baik</td>
                      <td>80 | 70</td>
                    </tr>
                    <tr>
                      <td>Kurang</td>
                      <td>60 | 50</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            </div>
            <div class="col-md-12">
              <label for="parameter1" class="form-label">Penyajian Materi Presentasi</label>
              <div class="d-flex">
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter1" value="100">
                    <span class="form-check-label" for="parameter1">
                      100
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter1" value="90">
                    <span class="form-check-label" for="parameter1">
                      90
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter1" value="80">
                    <span class="form-check-label" for="parameter1">
                      80
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter1" value="70">
                    <span class="form-check-label" for="parameter1">
                      70
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter1" value="60">
                    <span class="form-check-label" for="parameter1">
                      60
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter1" value="50">
                    <span class="form-check-label" for="parameter1">
                      50
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="parameter2" class="form-label">Pengetahuan teknis/kerja</label>
              <div class="d-flex">
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter2" value="100">
                    <span class="form-check-label" for="parameter2">
                      100
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter2" value="90">
                    <span class="form-check-label" for="parameter2">
                      90
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter2" value="80">
                    <span class="form-check-label" for="parameter2">
                      80
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter2" value="70">
                    <span class="form-check-label" for="parameter2">
                      70
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter2" value="60">
                    <span class="form-check-label" for="parameter2">
                      60
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter2" value="50">
                    <span class="form-check-label" for="parameter2">
                      50
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="parameter3" class="form-label">Hasil Kerja</label>
              <div class="d-flex">
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter3" value="100">
                    <span class="form-check-label" for="parameter3">
                      100
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter3" value="90">
                    <span class="form-check-label" for="parameter3">
                      90
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter3" value="80">
                    <span class="form-check-label" for="parameter3">
                      80
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter3" value="70">
                    <span class="form-check-label" for="parameter3">
                      70
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter3" value="60">
                    <span class="form-check-label" for="parameter3">
                      60
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter3" value="50">
                    <span class="form-check-label" for="parameter3">
                      50
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="parameter4" class="form-label">Daya Analisa</label>
              <div class="d-flex">
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter4" value="100">
                    <span class="form-check-label" for="parameter4">
                      100
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter4" value="90">
                    <span class="form-check-label" for="parameter4">
                      90
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter4" value="80">
                    <span class="form-check-label" for="parameter4">
                      80
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter4" value="70">
                    <span class="form-check-label" for="parameter4">
                      70
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter4" value="60">
                    <span class="form-check-label" for="parameter4">
                      60
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter4" value="50">
                    <span class="form-check-label" for="parameter4">
                      50
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="parameter5" class="form-label">Inisiatif & Problem Solving</label>
              <div class="d-flex">
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter5" value="100">
                    <span class="form-check-label" for="parameter5">
                      100
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter5" value="90">
                    <span class="form-check-label" for="parameter5">
                      90
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter5" value="80">
                    <span class="form-check-label" for="parameter5">
                      80
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter5" value="70">
                    <span class="form-check-label" for="parameter5">
                      70
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter5" value="60">
                    <span class="form-check-label" for="parameter5">
                      60
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter5" value="50">
                    <span class="form-check-label" for="parameter5">
                      50
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="parameter6" class="form-label">Kemampuan Berkomunikasi</label>
              <div class="d-flex">
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter6" value="100">
                    <span class="form-check-label" for="parameter6">
                      100
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter6" value="90">
                    <span class="form-check-label" for="parameter6">
                      90
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter6" value="80">
                    <span class="form-check-label" for="parameter6">
                      80
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter6" value="70">
                    <span class="form-check-label" for="parameter6">
                      70
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter6" value="60">
                    <span class="form-check-label" for="parameter6">
                      60
                    </span>
                  </div>
                </div>
                <div class="flex-fill mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="parameter6" value="50">
                    <span class="form-check-label" for="parameter6">
                      50
                    </span>
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