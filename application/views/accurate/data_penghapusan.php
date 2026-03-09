<div class="row">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#AddNewPenghapusan"><i class="fa fa-plus"></i> Tambah Data</button>
      </div>
      
      <!-- AddNewPenghapusan -->
      <div class="modal fade" id="AddNewPenghapusan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('simpan-penghapusan')?>" role="form" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="mb-3">
                  <label for="no_dokumen" class="form-label">Nomor Dokumen</label>
                  <input type="text" class="form-control" name="no_dokumen" aria-describedby="no_dokumenHelp">
                </div>
                <div class="mb-3">
                  <label for="alasan" class="form-label">Alasan penghapusan</label>
                  <textarea class="form-control" name="alasan"></textarea>
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
            <th>Nomor Dokumen</th>
            <th>Alasan</th>
            <th>Status</th>
          </tr>
          </thead>

          <?php $no = 1;?>
          <?php foreach ($list_data as $ld){?>
          <tr>
            <td><?= $no ?></td>
            <td><?=$ld->nomor_dokumen?></td>
            <td><?=$ld->alasan?></td>
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