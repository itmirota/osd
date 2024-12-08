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
            <div class="col-md-12">
              <label for="tgl_evaluasi" class="form-label">Tanggal Habis Kontrak</label>
              <input type="date" name="tgl_akhir_kontrak" class="form-control tabel-PR" required />
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