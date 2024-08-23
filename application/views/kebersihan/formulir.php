<div class="row mt-4">
  <div class="d-flex justify-content-center">
    <div class="col-10">
      <div class="card">
        <div class="card-body">
          <form action="<?=base_url('kebersihan/data')?>" role="form" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="kebersihan_id" class="form-label">Staff Kebersihan</label>
              <select name="pegawai_id" id="pegawai_id" placeholder="Ruangan" style="width: 100%" class="form-select select2" required>
                <option>--pilih nama--</option>
                <?php foreach($pegawai as $data){?>
                <option value=<?= $data->id_pegawai ?>><?= $data->nama_pegawai ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>