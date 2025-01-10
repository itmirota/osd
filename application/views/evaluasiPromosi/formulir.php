<div class="d-flex justify-content-center">
<div class="col-md-6">
  <form action="<?= base_url('evaluasiPromosi/saveJadwalPenilaian')?>" role="form" method="post" enctype="multipart/form-data">
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
              <select name="id_pegawai" class="form-select select2 tabel-PR" required>
                <option>----- pilih pegawai ---</option>
                <?php foreach($pegawai as $ld): ?>
                <option value="<?= $ld->id_pegawai?>"><?=$ld->nama_pegawai?></option>
                <?php endforeach; ?>
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