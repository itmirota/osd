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
            <!-- <h3><strong>Soft Skill</strong></h3> -->
            <!-- target & bobot 1 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Manajemen Hubungan Pemasok (Supplier Relationship Management - SRM)</label>
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
            <div class="card">
              <div class="card-body">
                <label class="form-label">Analisis Pasar & Sumber (Sourcing Analysis)</label>
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
            </div>
            <!-- target & bobot 2 -->

            <!-- target & bobot 3 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Analisis Biaya & Total Cost of Ownership (TCO)</label>
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
                <label class="form-label">Manajemen Risiko Rantai Pasok</label>
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
                <label class="form-label">Manajemen Kontrak</label>
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
                <label class="form-label">Project Management</label>
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
                <label class="form-label">ERP (Enterprise Resource Planning)</label>
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
                <label class="form-label">Prinsip Lean Manufacturing & Six Sigma</label>
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
                <label class="form-label">Prinsip-prinsip Pembelian Strategis</label>
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

            <!-- target & bobot 10 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Manajemen Rantai Pasok (SCM)</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target10" class="form-label">Target</label>
                    <input type="text" name="target10" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot10" class="form-label">Bobot</label>
                    <input type="text" name="bobot10" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 10 -->

            <!-- target & bobot 11 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Jenis Bahan Baku & Bahan Kemas FMCG</label>
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

            <!-- target & bobot 12 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Analisis Biaya & Struktur Harga Pemasok</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target12" class="form-label">Target</label>
                    <input type="text" name="target12" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot12" class="form-label">Bobot</label>
                    <input type="text" name="bobot12" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 12 -->

            <!-- target & bobot 13 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Hukum Kontrak & Peraturan Perdagangan</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target13" class="form-label">Target</label>
                    <input type="text" name="target13" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot13" class="form-label">Bobot</label>
                    <input type="text" name="bobot13" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 13 -->

            <!-- target & bobot 14 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Manajemen Kualitas Pemasok</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target14" class="form-label">Target</label>
                    <input type="text" name="target14" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot14" class="form-label">Bobot</label>
                    <input type="text" name="bobot14" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 14 -->

            <!-- target & bobot 15 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Procurement Management</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target15" class="form-label">Target</label>
                    <input type="text" name="target15" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot15" class="form-label">Bobot</label>
                    <input type="text" name="bobot15" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 15 -->

            <!-- target & bobot 16 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Achievement and Action</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target16" class="form-label">Target</label>
                    <input type="text" name="target16" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot16" class="form-label">Bobot</label>
                    <input type="text" name="bobot16" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 16 -->

            <!-- target & bobot 17 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Problem Solving</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target17" class="form-label">Target</label>
                    <input type="text" name="target17" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot17" class="form-label">Bobot</label>
                    <input type="text" name="bobot17" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 17 -->

            <!-- target & bobot 18 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Business Orientation</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target18" class="form-label">Target</label>
                    <input type="text" name="target18" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot18" class="form-label">Bobot</label>
                    <input type="text" name="bobot18" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 18 -->

            <!-- target & bobot 19 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Initiative</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target19" class="form-label">Target</label>
                    <input type="text" name="target19" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot19" class="form-label">Bobot</label>
                    <input type="text" name="bobot19" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 19 -->

            <!-- target & bobot 20 -->   
            <div class="card">
              <div class="card-body">
                <label class="form-label">Impact and Influence</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target20" class="form-label">Target</label>
                    <input type="text" name="target20" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot20" class="form-label">Bobot</label>
                    <input type="text" name="bobot20" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            
            <!-- target & bobot 20 -->

            <!-- target & bobot 21 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Relationship Building</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target21" class="form-label">Target</label>
                    <input type="text" name="target21" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot21" class="form-label">Bobot</label>
                    <input type="text" name="bobot21" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 21 -->

            <!-- target & bobot 22 -->
            <div class="card">
              <div class="card-body">
                <label class="form-label">Communication</label>
                <div class="row">
                  <div class="col-md-6">
                    <label for="target22" class="form-label">Target</label>
                    <input type="text" name="target22" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-6">
                    <label for="bobot22" class="form-label">Bobot</label>
                    <input type="text" name="bobot22" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
            </div>
            <!-- target & bobot 22 -->
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