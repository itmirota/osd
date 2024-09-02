
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
          <h3 class="card-title">Data Divisi</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Divisi</th>  
            <th class="text-center">Jumlah Pegawai</th>
            <th class="text-center">Actions</th>
          </tr>
          </thead>
          <?php
          $no = 1;
          $totpegawai = 0;
          if(!empty($list_data))
          {
              foreach($list_data as $data)
              {
          ?>
          <tbody>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $data->nama_divisi ?></td>
            <td class="text-center"><?= $data->jml_pegawai ?> pegawai</td>
            <td class="text-center">
              <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_divisi?>)"><i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edit"></i></button>
              <a href="<?= base_url('deteledivisi/'.$data->id_divisi) ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus"><i class="fa fa-trash"></i></a></td>
          </tr>
          </tbody>
          <?php
            $totpegawai=$totpegawai+$data->jml_pegawai;
              }
          }
          ?>
          <tfoot>
            <td colspan="1"></td>
            <td class="text-end"><strong>Total</strong></td>
            <td class="text-center"><strong><?= $totpegawai ?> pegawai</strong></td>
          </tfoot>
        </table>
        
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addDepartement" tabindex="-1" aria-labelledby="addDepartementLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('divisi/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_divisi" class="form-label">Nama Departement</label>
              <input type="text" name="nama_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
            </div> 
            <div class="col-md-12">
              <label for="kadiv_id" class="form-label">Kepala Departement</label>
              <select class="form-select" name="kadiv_id" id="kadiv_select2" style="width:100%">
                <option readonly>-- kepala departement --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div>  
            <div class="col-md-12">
              <label for="manager_id" class="form-label">Manager</label>
              <select class="form-select" name="manager_id" id="manager_select2"  style="width:100%">
                <option readonly>-- manager departement --</option>
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
      <form action="<?=base_url('divisi/update')?>" role="form" id="editdivisi" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_divisi" class="form-label">Nama Departement</label>
              <input type="hidden" name="id_divisi" id="id_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
              <input type="text" name="nama_divisi" id="nama_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="kadiv_id" class="form-label">Kepala Departement</label>
              <select class="form-select js-example-basic-single js-states" name="kadiv_id" id="kadiv_id" aria-label="Small select example" style="width: 100%">
                <option>-- Kepala departement --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nip?> | <?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div>  
            <div class="col-md-12">
              <label for="manager_id" class="form-label">Manager</label>
              <select class="form-select" name="manager_id" id="manager_id" aria-label="Small select example" style="width: 100%">
                <option>-- Manager departement --</option>
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
      url:"<?php echo site_url("divisi/detaildivisi")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const divisi = hasil.divisi;
        document.getElementById("id_divisi").value = divisi.id_divisi;
        document.getElementById("nama_divisi").value = divisi.nama_divisi;
        document.getElementById("kadiv_id").value = divisi.kadiv_id;
        document.getElementById("manager_id").value = divisi.manager_id;
      }
    });
  }
</script>