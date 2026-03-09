<div class="row">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#AddNewCustomer"><i class="fa fa-plus"></i> Tambah Data</button>
      </div>
      
      <!-- AddNewCustomer -->
      <div class="modal fade" id="AddNewCustomer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('simpan-customer')?>" role="form" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="mb-3">
                  <label for="nama_customer" class="form-label">Nama Customer</label>
                  <input type="text" class="form-control" name="nama_customer" aria-describedby="nama_customerHelp">
                </div>
                <div class="mb-3">
                  <label for="kontak" class="form-label">No Telp Aktif/Whatsapp</label>
                  <input type="text" class="form-control" name="kontak" aria-describedby="kontakHelp">
                  <div id="kontakHelp" class="form-text">isi dengan format 62, contoh 628954010xxxxxx.</div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat Pengiriman</label>
                  <textarea  class="form-control" name="alamat"></textarea>
                </div>
                <div class="mb-3">
                  <label for="kategori" class="form-label">Kategori Customer</label>
                  <select class="form-select" name="kategori" aria-label="Default select example">
                    <option selected>pilih </option>
                    <option value="Retail">Retail</option>
                    <option value="Medical">Medical</option>
                    <option value="DIstributor">DIstributor</option>
                    <option value="Marketplace">Marketplace</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="tipe_pembayaran" class="form-label">Tipe Customer</label>
                  <select class="form-select" name="tipe_pembayaran" aria-label="Default select example">
                    <option selected>pilih </option>
                    <option value="Tempo 30 h">Tempo 30 h</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Konsinyasi">Konsinyasi</option>
                  </select>
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
            <th width="50px">Data Customer</th>
            <th width="50px">Alamat Pengiriman/Penagihan</th>
            <th width="10px">Kategori Customer</th>
            <th>Tipe Customer</th>
            <th>Status</th>
          </tr>
          </thead>

          <?php $no = 1;?>
          <?php foreach ($list_data as $ld){?>
          <tr>
            <td><?= $no ?></td>
            <td>
              <p class="m-0"><?=$ld->nama_customer?></p>
              <p class="m-0"><?=$ld->kontak?></p>
              <p class="m-0"><?=$ld->email?></p>
            </td>
            <td><?=$ld->alamat?></td>
            <td><?=$ld->kategori?></td>
            <td><?=$ld->tipe_pembayaran?></td>
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