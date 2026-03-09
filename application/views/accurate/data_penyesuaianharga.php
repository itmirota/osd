<div class="row">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#AddNewPenyesuaianHarga"><i class="fa fa-plus"></i> Tambah Data</button>
      </div>
      
      <!-- AddNewPenyesuaianHarga -->
      <div class="modal fade" id="AddNewPenyesuaianHarga" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('simpan-penyesuaianharga')?>" role="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" aria-describedby="nama_barangHelp">
              </div>
              <div class="mb-3">
                <label for="harga_baru" class="form-label">Harga Baru</label>
                <input type="text" class="form-control" name="harga_baru" aria-describedby="harga_baruHelp">
              </div>
              <div class="mb-3">
                <label for="mulai_berlaku" class="form-label">Mulai Berlaku</label>
                <input type="date" class="form-control" name="mulai_berlaku" aria-describedby="mulai_berlakuHelp">
              </div>
              <div class="mb-3">
                <label for="dokumen" class="form-label">Memo Internal</label>
                <input class="form-control form-control-sm" name="dokumen" type="file">
                <div id="no_rekeningHelp" class="form-text">upload dalam pdf.</div>
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
            <th>Nama Barang</th>
            <th>Harga Baru</th>
            <th>Tanggal Berlaku</th>
            <th>Dokumen</th>
            <th>Status</th>
          </tr>
          </thead>

          <?php $no = 1;?>
          <?php foreach ($list_data as $ld){?>
          <tr>
            <td><?= $no ?></td>
            <td><?=$ld->nama_barang?></td>
            <td><?=$ld->harga_baru?></td>
            <td><?=mediumdate_indo($ld->mulai_berlaku)?></td>
            <td><a href="#" id="showDokumen" data-bs-toggle="modal" data-bs-target="#absenToko" onclick= "showDokumen(<?= $ld->id_penyesuaian ?>)"><i class="fa fa-solid fa-eye"></i> lihat</a></td>
            <td>
              <p class="m-0">dibuat oleh: <?=$ld->nama_input?></p>
              <p class="m-0">tanggal: <?= mediumdate_indo($ld->tanggal_input).' | '.DATE('H:i',strtotime($ld->waktu_input));?></p>
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


<!-- Modal Detail Hasil Cek-->
<div class="modal fade" id="absenToko" tabindex="-1" aria-labelledby="absenTokoLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="titleAddPegawai">Memo Internal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-md-12">
                <div id="dokumen">
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
function showDokumen($id){
    $.ajax({
      url:"<?php echo site_url("DataAccurate/getDokumenPenyesuaianharga")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil)
        
        const file = "<?= site_url("assets/dokumen_penyesuaianharga")?>/" + hasil.memo_internal;
        
        document.getElementById("dokumen").innerHTML = '<iframe src="'+ file + '" frameborder="0" style="width:100%; height:400px;" "></iframe>';
      }
    });
  };
</script>