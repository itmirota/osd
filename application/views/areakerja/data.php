
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
          <h3 class="card-title">Data Area Kerja</h3>
      </div><!-- /.box-header -->
      <div class="card-body">
        <div class="table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Area Kerja</th>  
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
            <td><?= $data->nama_areakerja ?></td>
            <td class="text-center">
            <div class="btn-group">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_areakerja?>)">Edit Data</a></li>
                <li><a class="dropdown-item" href="<?= base_url('areakerja/delete/'.$data->id_areakerja) ?>">Hapus Data</a></li>
              </ul>
            </div>
            </td>
          </tr>
          <?php
            }}
          ?>
          </tbody>

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
      <form action="<?=base_url('areakerja/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_areakerja" class="form-label">Area Kerja</label>
              <input type="text" name="nama_areakerja" placeholder="Nama area kerja" class="form-control tabel-PR" required />
            </div>   
            <div class="col-md-12">
              <label for="nama_areakerja" class="form-label">Keterangan</label>
              <textarea class="form-control" name="keterangan" cols="30" rows="3"></textarea>
            </div> 
            <div class="col-md-12">
              <label for="spv_id" class="form-label">SPV Area</label>
              <select class="form-select" name="spv_id" style="width:100%">
                <option value="0">-- SPV Area --</option>
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

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('areakerja/update')?>" role="form" id="editareakerja" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_areakerja" class="form-label">Nama Area Kerja</label>
              <input type="hidden" name="id_areakerja" id="id_areakerja" class="form-control tabel-PR" required />
              <input type="text" name="nama_areakerja" id="nama_areakerja" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="spv_id" class="form-label">SPV Area</label>
              <select class="form-select js-example-basic-single js-states" name="spv_id" id="spv_id" aria-label="Small select example" style="width: 100%">
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
      url:"<?php echo site_url("areakerja/detailareakerja")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const areakerja = hasil.areakerja;

        console.log(areakerja);
        document.getElementById("id_areakerja").value = areakerja.id_areakerja;
        document.getElementById("nama_areakerja").value = areakerja.nama_areakerja;
        document.getElementById("spv_id").value = areakerja.spv_id;
      }
    });
  }
</script>