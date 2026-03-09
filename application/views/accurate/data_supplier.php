<div class="row">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#AddNewSupplier"><i class="fa fa-plus"></i> Tambah Data</button>
      </div>
      
      <!-- AddNewSupplier -->
      <div class="modal fade" id="AddNewSupplier" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('simpan-supplier')?>" role="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <form action="<?=base_url('simpan-supplier')?>" role="form" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_vendor" class="form-label">Nama Supplier/Vendor</label>
                  <input type="text" class="form-control" name="nama_vendor" aria-describedby="nama_vendorHelp">
                  <div id="nama_vendorHelp" class="form-text">isi dengan format Nama perusahaan, PT contoh : Paragon Corp, PT.</div>
                </div>
                <div class="mb-3">
                  <label for="no_rekening" class="form-label">Data Rekening</label>
                  <input type="text" class="form-control" name="no_rekening" aria-describedby="no_rekeningHelp">
                  <div id="no_rekeningHelp" class="form-text">isi dengan format nama Bank, No. Rekening, Atas Nama.</div>
                </div>
                <div class="mb-3">
                  <label for="no_npwp" class="form-label">Nomor NPWP</label>
                  <input type="text" class="form-control" name="no_npwp" aria-describedby="no_npwpHelp">
                </div>
                <div class="mb-3">
                  <label for="no_rekening" class="form-label">Status Pajak</label>
                  <select class="form-select" name="status_pajak" aria-label="Default select example">
                    <option selected>pilih </option>
                    <option value="PKP">PKP</option>
                    <option value="Non PKP">Non PKP</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="dokumen" class="form-label">Dokumen Terkait</label>
                  <input class="form-control form-control-sm" name="dokumen" type="file">
                  <div id="no_rekeningHelp" class="form-text">upload dalam 1 pdf vendor form, disertai dengan NPWP serta SPPKP jika ada.</div>
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
            <th>Nama Vendor/Supplier</th>
            <th>Data Rekening</th>
            <th>No NPWP</th>
            <th>Status Pajak</th>
            <th>Dokumen</th>
            <th>Status</th>
          </tr>
          </thead>

          <?php $no = 1;?>
          <?php foreach ($list_data as $ld){?>
          <tr>
            <td><?= $no ?></td>
            <td><?=$ld->nama_vendor?></td>
            <td><?=$ld->no_rekening?></td>
            <td><?=$ld->no_npwp?></td>
            <td><?=$ld->status_pajak?></td>
            <td><a href="#" id="showDokumen" data-bs-toggle="modal" data-bs-target="#absenToko" onclick= "showDokumen(<?= $ld->id_supplier ?>)"><i class="fa fa-solid fa-eye"></i> lihat</a></td>
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
            <h1 class="modal-title fs-5" id="titleAddPegawai">Dokumen Pendukung</h1>
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
      url:"<?php echo site_url("DataAccurate/getDokumenSupplier")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil)
        
        const file = "<?= site_url("assets/dokumen_supplier")?>/" + hasil.dokumen;
        
        document.getElementById("dokumen").innerHTML = '<iframe src="'+ file + '" frameborder="0" style="width:100%; height:400px;" "></iframe>';
      }
    });
  };
</script>