<style>
  .img-judul{
    width:5vh;
  }

  .text-judul h3, .text-date{
    color:#fff;
    font-weight:bold;
  }

  .text-judul p{
    color:#ddd9d9;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <?php if(empty($name)){?>
    <div class="text-judul mt-2 mb-2">
      <h3 class="m-0">Data Pembelian</h3>
      <p class="m-0">List data pembelian galon</p>
    </div>
    <?php } ?>
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <div class="row">
          <?php if(empty($name)){?>
          <div class="d-flex justify-content-between">
            <div class="p-2">
              <a href="<?= base_url('satpam')?>" class="btn btn-md btn-secondary"><i class="fas fa-arrow-left"></i> kembali</a>
              <a href="<?= base_url('satpam/pembelian')?>" class="btn btn-md btn-warning"><i class="fa-solid fa-arrows-rotate"></i> refresh</a>
            </div>
            <div class="p-2">
            <strong class="me-2">Saldo Rp. <?= $total_saldo ?></strong>
            <strong class="me-2">Sisa Saldo Rp. <?= $sisa_saldo ?></strong>
            <button type="button" data-bs-toggle="modal" data-bs-target="#addPembelian" class="btn btn-md btn-info"><i class="fas fa-plus"></i> Tambah Data</button>
            </div>
          </div>
          <?php }else{ ?>
          <div class="d-flex justify-content-end">
            <div class="p-2">
            <strong class="me-2">Saldo Rp. <?= $total_saldo ?></strong>
            </div>
            <div class="p-2">
            <strong class="me-2">Sisa Saldo Rp. <?= $sisa_saldo ?></strong>
            </div>
          </div>  
          <?php } ?>
        </div>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Pembelian</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <?php if ($role == ROLE_SUPERADMIN){?>
            <th>Aksi</th>
            <?php } ?>

          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
            foreach($list_data as $data):
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= mediumdate_indo($data->tgl_pembelian) ?></td>
            <td><?= $data->jumlah ?></td>
            <td><?= $data->harga ?></td>
            <?php if ($role == ROLE_SUPERADMIN){?>
            <td>
              <button type="button" data-bs-toggle="modal" data-bs-target="#editPembelian"  onclick="editData(<?= $data->id_pembelian?>)" class="btn btn-sm btn-info"><i class="fas fa-pencil"></i></button>
            </td>
            <?php } ?>
          </tr>
          <?php
            endforeach;
          } ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div>
  </div>
</div>


<!-- Modal Add resi -->
<div class="modal fade" id="addPembelian" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pembelian</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('transaksiSatpam/savePembelian')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" readonly class="form-control-plaintext" name="id_paket" id="id_paket">
          <div class="mb-3">
            <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
            <input type="date" class="form-control" name="tgl_pembelian" required>
          </div>
          <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Pembelian</label>
            <input type="text" class="form-control" placeholder="contoh: 2" name="jumlah" required>
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Biaya</label>
            <input type="text" name="harga" placeholder="contoh: 10000" class="form-control tabel-PR" required />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editPembelian" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pembelian</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('transaksiSatpam/updatePembelian')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" readonly class="form-control-plaintext" name="id_pembelian" id="id_pembelian">
          <div class="mb-3">
            <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
            <input type="date" class="form-control" name="tgl_pembelian" id="tgl_pembelian" required>
          </div>
          <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Pembelian</label>
            <input type="text" class="form-control"  name="jumlah" id="jumlah" required>
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Biaya</label>
            <input type="text" name="harga" id="harga" placeholder="contoh: 10000" class="form-control tabel-PR" required />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
function editData($id){
    $.ajax({
      url:"<?php echo site_url("transaksiSatpam/detailPembelian")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("id_pembelian").value = hasil.id_pembelian;
        document.getElementById("jumlah").value = hasil.jumlah;
        document.getElementById("harga").value = hasil.harga;
        document.getElementById("tgl_pembelian").value = hasil.tgl_pembelian;
      }
    });
  }
</script>
