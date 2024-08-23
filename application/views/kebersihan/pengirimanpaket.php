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
<div class="row mt-4">
  <div class="d-flex justify-content-between">
  <div class="p-2">
    <a href="<?= base_url('satpam')?>" class="btn btn-md btn-secondary"><i class="fas fa-arrow-left"></i> kembali</a>
    <a href="<?= base_url('satpam/pengirimanpaket')?>" class="btn btn-md btn-warning"><i class="fa-solid fa-arrows-rotate"></i> refresh</a>
  </div>
  <div class="p-2 d-flex justify-align-items-center">
    <strong class="text-date"><?= longdate_indo(DATE("Y-m-d"))?></strong>
  </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="text-judul mt-2 mb-2">
      <h3 class="m-0">Data Paket</h3>
      <p class="m-0">List data karyawan yang mengirimkan paket</p>
    </div>
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th class="text-center">Tanggal Pengiriman</th>
            <th class="text-center">Nama Pengirim</th>
            <th class="text-center">Nama Penerima</th>
            <th class="text-center">Alamat Penerima</th>
            <th class="text-center">Deskripsi Paket</th>
            <th class="text-center">Ekspedisi</th>
            <th class="text-center">No Resi</th>
            <th class="text-center">Biaya Kirim</th>
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
            <td><?= mediumdate_indo($data->tgl_kirim) ?></td>
            <td><?= $data->nama_pegawai ?></td>
            <td><?= $data->nama_penerima ?></td>
            <td><?= $data->alamat_penerima ?></td>
            <td><?= $data->deskripsi_paket ?></td>
            <td><?= $data->ekspedisi ?></td>
            <td  class="text-center">
              <?php
                if(isset($lt->kendaraan_id)){?>
                  <?= $data->no_resi ?>
                <?php }else{?>
                  <a href="" data-bs-toggle="modal" data-bs-target="#noresi" data-idPaket="<?= $data->id_paket?>" class="btn btn-sm btn-info"> <i class="fas fa-pencil"></i></a>
                <?php }?>
            </td>
            <td><?= $data->biaya_kirim ?></td>
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
<div class="modal fade" id="noresi" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pengajuan Surat Tugas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('satpam/updateResi')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" readonly class="form-control-plaintext" name="id_paket" id="id_paket">
          <div class="mb-3">
            <label for="no_resi" class="form-label">No Resi</label>
            <input type="text" class="form-control" placeholder="masukkan no resi disini" name="no_resi">
          </div>
          <div class="mb-3" id="kendaraan">
            <select name="kendaraan_id" id="kendaraan_id" class="form-select tabel-PR">
            </select>
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
  const noresi = document.getElementById('noresi')
  if (noresi) {
    noresi.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id_paket = button.getAttribute('data-idPaket');
      // If necessary, you could initiate an Ajax request here
      // and then do the updating in a callback.

      // Update the modal's content.
      document.getElementById("id_paket").value = id_paket;
    })
  }
</script>