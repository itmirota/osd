
<div class="row">
  <?php if(empty($this->uri->segment(2))){?>
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartement"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <?php }else{ ?> 
    <div class="d-flex justify-content-between mb-4">
      <a href="<?= base_url('Datadepartement')?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartement"><i class="fa fa-plus"></i> Tambah Data</button>
    </div>
  <?php } ?>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Bagian</h3>
      </div><!-- /.box-header -->
      <div class="card-body">
        <div class="table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Bagian</th>  
            <th>Divisi</th>
            <th class="text-center">Jumlah Pegawai</th>
            <th class="text-center">#</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          $totpegawai = 0;
          if(!empty($list_data))
          {
              foreach($list_data as $data)
              {
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $data->nama_bagian ?></td>
            <td><?= $data->nama_divisi ?></td>
            <td class="text-center"><?= $data->jml_pegawai ?> pegawai</td>
            <td class="text-center">
            <div class="btn-group">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_bagian?>)">Edit Data</a></li>
                <li><a class="dropdown-item" href="<?= base_url('deletebagian/'.$data->id_bagian) ?>">Hapus Data</a></li>
              </ul>
            </div>
            </td>
          </tr>
          <?php
            $totpegawai=$totpegawai+$data->jml_pegawai;
              }
          }
          ?>
          </tbody>

          <tfoot>
            <td colspan="4"></td>
            <td class="text-center"><strong><?= $totpegawai ?> pegawai</strong></td>
          </tfoot>
        </table>
        </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addDepartement" tabindex="-1" aria-labelledby="addDepartementLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('bagian/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_bagian" class="form-label">Nama Bagian</label>
              <input type="text" name="nama_bagian" placeholder="Nama Bagian" class="form-control tabel-PR" required />
            </div> 
            <div class="col-md-12">
              <label for="divisi_id" class="form-label">Divisi</label>
              <select class="form-select" name="divisi_id" id="divisi_select2" style="width:100%">
                <option readonly>-- divisi --</option>
                <?php foreach ($divisi as $d){ ?>
                <option value="<?= $d->id_divisi?>"><?=$d->nama_divisi?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="kabag_id" class="form-label">Kepala Bagian</label>
              <select class="form-select" name="kabag_id" id="kabag_select2" style="width:100%">
                <option readonly>-- kepala bagian --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div>  
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

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('bagian/update')?>" role="form" id="editbagian" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_bagian" class="form-label">Nama Bagian</label>
              <input type="hidden" name="id_bagian" id="id_bagian" placeholder="Nama Bagian" class="form-control tabel-PR" required />
              <input type="text" name="nama_bagian" id="nama_bagian" placeholder="Nama Bagian" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="divisi_id" class="form-label">Divisi</label>
              <select class="form-select" name="divisi_id" id="divisi_id">
                <option readonly>-- divisi --</option>
                <?php foreach ($divisi as $d){ ?>
                <option value="<?= $d->id_divisi?>"><?=$d->nama_divisi?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="kabag_id" class="form-label">Kepala Bagian</label>
              <select class="form-select js-example-basic-single js-states" name="kabag_id" id="kabag_id" aria-label="Small select example" style="width: 100%">
                <option value=" ">-- Kepala Bagian --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nip?> | <?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div>       
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


<script>

  function editData($id){
    $.ajax({
      url:"<?php echo site_url("bagian/detailbagian")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const bagian = hasil.bagian;
        document.getElementById("id_bagian").value = bagian.id_bagian;
        document.getElementById("divisi_id").value = bagian.divisi_id;
        document.getElementById("nama_bagian").value = bagian.nama_bagian;
        document.getElementById("kabag_id").value = bagian.kabag_id;
      }
    });
  }
</script>