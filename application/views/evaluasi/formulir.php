<div class="d-flex justify-content-center">
<div class="col-md-6">
  <form action="<?= base_url('evaluasiKerja/saveJadwalPenilaian')?>" role="form" method="post" enctype="multipart/form-data">
  <div class="card p-2">
    <div class="card-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="tgl_evaluasi" class="form-label">Tanggal Evaluasi</label>
              <input type="date" name="tgl_evaluasi" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="nama_peserta" class="form-label">Nama Karyawan</label>
              <select name="id_pegawai" class="form-select tabel-PR" required>
                <option>----- pilih pegawai ---</option>
                <?php foreach($pegawai as $ld): ?>
                <option value="<?= $ld->id_pegawai?>"><?=$ld->nip?> | <?=$ld->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="tujuan_evaluasi" class="form-label">Tujuan Evaluasi</label>
              <select name="tujuan_evaluasi" class="form-select tabel-PR">
                <option >---- Tujuan ---</option>
                <option value="probation">Masa Akhir Probation</option>
                <option value="kontrak">Masa Akhir Kontrak</option>
              </select>
            </div>
            <div class="col-md-12 mb-4">
              <label for="tgl_evaluasi" class="form-label">Tanggal Habis Kontrak</label>
              <input type="date" name="tgl_akhir_kontrak" class="form-control tabel-PR" required />
            </div>
            <hr>
            <h3><strong>Soft Skill</strong></h3>
            <!-- target & bobot 1 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Agility</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target1" class="form-label">Target</label>
                    <input type="text" name="target1" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot1" class="form-label">Bobot</label>
                    <input type="text" name="bobot1" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 1 -->

            <!-- target & bobot 2 -->
            <!-- <div class="card">
              <div class="card-body">
                <label class="form-label">Kualitas Kerja</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target2" class="form-label">Target</label>
                    <input type="text" name="target2" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot2" class="form-label">Bobot</label>
                    <input type="text" name="bobot2" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div> -->
            <!-- target & bobot 2 -->

            <!-- target & bobot 3 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Inisiatif</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target3" class="form-label">Target</label>
                    <input type="text" name="target3" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot3" class="form-label">Bobot</label>
                    <input type="text" name="bobot3" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 3 -->
            
            <!-- target & bobot 4 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Problem Solving</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target4" class="form-label">Target</label>
                    <input type="text" name="target4" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot4" class="form-label">Bobot</label>
                    <input type="text" name="bobot4" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 4 -->

            <!-- target & bobot 5 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Profesionals</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target5" class="form-label">Target</label>
                    <input type="text" name="target5" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot5" class="form-label">Bobot</label>
                    <input type="text" name="bobot5" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 5 -->
            
            <!-- target & bobot 6 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Communication</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target6" class="form-label">Target</label>
                    <input type="text" name="target6" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot6" class="form-label">Bobot</label>
                    <input type="text" name="bobot6" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 6 -->
            
            <!-- target & bobot 7 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Team Work</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target7" class="form-label">Target</label>
                    <input type="text" name="target7" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot7" class="form-label">Bobot</label>
                    <input type="text" name="bobot7" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 7 -->
            
            <!-- target & bobot 8 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Etica</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target8" class="form-label">Target</label>
                    <input type="text" name="target8" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot8" class="form-label">Bobot</label>
                    <input type="text" name="bobot8" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 8 -->
            
            <!-- target & bobot 9 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Learning</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target9" class="form-label">Target</label>
                    <input type="text" name="target9" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot9" class="form-label">Bobot</label>
                    <input type="text" name="bobot9" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 9 -->
            <h3><strong>Hard Skill</strong></h3>
            <!-- target & bobot 10 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">TUPOKSI</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target10" class="form-label">deskripsi</label>
                    <input type="text" name="target10" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot10" class="form-label">detail</label>
                    <input type="text" name="bobot10" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 10 -->

            <!-- target & bobot 11 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Achievement & Action</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target11" class="form-label">Target</label>
                    <input type="text" name="target11" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot11" class="form-label">Bobot</label>
                    <input type="text" name="bobot11" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 11 -->

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