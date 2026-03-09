<div class="row">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#AddNewBarangJasa"><i class="fa fa-plus"></i> Tambah Data</button>
      </div>
      
      <!-- AddNewBarangJasa -->
      <div class="modal fade" id="AddNewBarangJasa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('simpan-barangjasa')?>" role="form" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="mb-3">
                  <label for="nama_barang" class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" name="nama_barang" aria-describedby="nama_barangHelp">
                </div>
                <div class="mb-3">
                  <label for="kategori_barang" class="form-label">Kategori Customer</label>
                  <select class="form-select" name="kategori_barang" aria-label="Default select example">
                    <option selected>pilih </option>
                    <option value="Barang Jadi">Barang Jadi</option>
                    <option value="Bahan Baku">Bahan Baku</option>
                    <option value="Bahan Kemas">Bahan Kemas</option>
                    <option value="Jasa">Jasa</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="satuan_1" class="form-label">satuan 1</label>
                  <input type="text" class="form-control" name="satuan_1" aria-describedby="satuan_1Help">
                </div>
                <div class="mb-3">
                  <label for="satuan_2" class="form-label">satuan 2(Optional)</label>
                  <input type="text" class="form-control" name="satuan_2" aria-describedby="satuan_2Help">
                </div>
                <div class="mb-3">
                  <label for="satuan_3" class="form-label">satuan 3(Optional)</label>
                  <input type="text" class="form-control" name="satuan_3" aria-describedby="satuan_3Help">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Input</button>
            </div>
            </form>
          </div>
        </div>
      </div>


      <div class="row">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th width="50px">Nama Barang</th>
            <th width="50px">Kategori</th>
            <th>Satuan</th>
            <th>Status</th>
          </tr>
          </thead>

          <?php $no = 1;?>
          <?php foreach ($list_data as $ld){?>
          <tr>
            <td><?= $no ?></td>
            <td><?=$ld->nama_barang?></td>
            <td><?=$ld->kategori_barang?></td>
            <td>
              <p class="m-0">Satuan 1 : <?=$ld->satuan_1?></p>
              <p class="m-0">Satuan 2 : <?=isset($ld->satuan_2) ? $ld->satuan_2 : "-" ?></p>
              <p class="m-0">Satuan 3 : <?=isset($ld->satuan_3) ? $ld->satuan_3 : "-" ?></p>
            </td>
            <td>
              <p class="m-0">dibuat oleh: <?=$ld->nama_input?></p>
              <p class="m-0">tanggal: <b><?= mediumdate_indo($ld->tanggal_input).' | '.DATE('H:i',strtotime($ld->waktu_input));?></b></p>
              <p class="m-0">diproses oleh: <?= isset($ld->userprosess_id) ? $ld->nama_proses : "-"?></p>
              <p class="m-0">tanggal: <?=isset($ld->tanggal_proses) ? mediumdate_indo($ld->tanggal_proses).' | '.DATE('H:i',strtotime($ld->waktu_proses)) : "-"?></p>
            </td>
          </tr>
          <?php $no++ ?>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>