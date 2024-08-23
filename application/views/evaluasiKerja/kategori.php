<div class="d-flex justify-content-end mb-4">
  <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addKategori"><i class="fa fa-plus"></i> Tambah Data</button>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Kategori</th>
            <th class="text-center">Aksi</th>
          </tr>
          </thead>
          <?php
              $no = 1;
              foreach ($kategori as $k): ?>
          <tbody>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $k->nama_kategori ?></td>
              <td class="text-center">              
                <a href="<?= base_url('list-soal/'.$k->id_kategori)?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                <a href="<?= base_url('hapusKategori/'.$k->id_kategori)?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="addKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('evaluasiKerja/saveKategori')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addKategori">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-10">
            <label for="soal" class="form-label">Kategori</label>
            <input type="text" name="kategori" placeholder="tulis kategori disini" class="form-control tabel-PR" required/>
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