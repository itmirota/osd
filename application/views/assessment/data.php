<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Data Assessment Karyawan Satu Tingkat</h3>
    <div class="p-2">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-tambah">
      <i class="fas fa-plus"></i> Tambah Data
    </button>
    <a class="btn btn-primary" href="<?= base_url('assessment/list_soal')?>"> tambah soal</a>
    </div>

  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="dataTable" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Pegawai</th>
        <!-- <th>Tanggal Assessment</th>
        <th>Nilai</th>
        <th>Keterangan</th> -->
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        foreach($list_data as $ld) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $ld->nama_pegawai ?></td>
            <!-- <td><?= $ld->tgl_assessment ?></td>
            <td><?= $ld->nilai ?></td>
            <td><?= $ld->keterangan ?></td> -->
            <td>
                <?php if(is_null($ld->nilai)){ ?>
                <a href="<?= base_url('assessment/penilaian/').$ld->pegawai_id?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-pencil"></i> Penilaian
                </a>
                <?php }else{ ?>
                  <span class="badge rounded-pill text-bg-success">Sudah dinilai</span>
                <?php } ?>
                <!-- <a href="<?= base_url('assessment/delete/'.$ld->pegawai_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </a> -->
                <a href="<?= base_url('assessment/hasilAssessment/').$ld->pegawai_id?>" class="btn btn-primary btn-sm">
                  <i class="fas fa-eye"></i> Hasil
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
            <h4 class="modal-title">Tambah Data Assessment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('assessment/spreadsheet_import') ?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                  <a href="http://">export template</a>
                  <div class="form-group">
                      <label for="pegawai_id">File</label>
                      <input type="file" name="upload_file" id="upload_file" class="form-control">
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

