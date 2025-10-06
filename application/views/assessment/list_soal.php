<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Data Soal Assessment</h3>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-tambah">
        <i class="fas fa-plus"></i> Tambah Data
      </button>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="dataTable" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Jenis</th>
        <th>Kategori</th>
        <th>Soal</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        foreach($list_data as $ld) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $ld->jenis_soal ?></td>
            <td><?= $ld->kategori ?></td>
            <td><?= $ld->soal ?></td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit" onclick="detailSoal(<?= $ld->id_assessment_soal ?>)">
                    <i class="fas fa-pencil"></i> Edit
                </button>
                <a href="<?= base_url('assessment/delete_soal/'.$ld->id_assessment_soal) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Soal Assessment</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?= base_url('assessment/save_soal') ?>" method="post">
              <div class="modal-body">
                  <div class="form-group">
                      <label for="jenis_soal">Jenis Soal</label>
                      <select class="form-select" id="jenis_soal" name="jenis_soal" required>
                          <option value="">-- Pilih Jenis Soal --</option>
                          <option value="value">value</option>
                          <option value="aspek">aspek</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="kategori">Kategori</label>
                      <select class="form-select" id="kategori" name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="HONESTY">HONESTY</option>
                        <option value="OPEN MINDED">OPEN MINDED</option>
                        <option value="PROFESSIONAL">PROFESSIONAL</option>
                        <option value="EMPATHY">EMPATHY</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="soal">Soal</label>
                      <textarea class="form-control summernote" id="soal" name="soal" rows="3" placeholder="Masukkan Soal" required></textarea>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
        </div>
        <!-- /.modal-content -->
    </div>
  </div>   
          
</div>