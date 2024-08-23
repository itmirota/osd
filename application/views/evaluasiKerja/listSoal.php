<div class="d-flex justify-content-end mb-4">
  <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addSoal"><i class="fa fa-plus"></i> Tambah Data</button>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <div class="mb-4">
          <a href="<?= base_url('kategori-soal')?>"><i class="fa fa-arrow-left"></i> kembali</a>
        </div>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Parameter Penilaian</th>
            <th class="text-center">Aksi</th>
          </tr>
          </thead>
          <?php
              $no = 1;
              foreach ($soal as $s): ?>
          <tbody>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $s->soal ?></td>
              <td class="text-center">              
                <a class="btn btn-sm btn-warning"><i class="fas fa-pencil"></i></a>
                <a href="<?= base_url('evaluasiKerja/hapusSoal/'.$s->id_soal.'/'.$id_kategori)?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
          </tbody>
          <?php endforeach; ?>

        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addSoal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('evaluasiKerja/saveSoal/'.$id_kategori)?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-10">
            <label for="soal" class="form-label">Soal</label>
            <input type="text" name="soal" placeholder="tulis soal disini" class="form-control tabel-PR"/>
          </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>