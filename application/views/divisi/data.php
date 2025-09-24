
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
      <div class="card-body">
        <div class="table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Divisi</th>  
            <th class="text-center">Jumlah Bagian</th>
            <th class="text-center">#</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          $totbagian = 0;
          if(!empty($list_data))
          {
              foreach($list_data as $data)
              {
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $data->nama_divisi ?></td>
            <td class="text-center"><a href="<?= base_url('bagian/'.$data->id_divisi) ?>"><?= $data->jml_bagian ?> bagian </a></td>
            <td class="text-center">
            <div class="btn-group">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_divisi?>)">Edit Data</a></li>
                <li><a class="dropdown-item" href="<?= base_url('deletedivisi/'.$data->id_divisi) ?>">Hapus Data</a></li>
              </ul>
            </div>
            </td>
          </tr>
          <?php
              $totbagian=$totbagian+$data->jml_bagian;
              }
          }
          ?>
          </tbody>

          <tfoot>
            <td colspan="1"></td>
            <td class="text-end"><strong>Total</strong></td>
            <td class="text-center"><strong><?= $totbagian ?> bagian</strong></td>
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
      <form action="<?=base_url('divisi/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_divisi" class="form-label">Nama Divisi</label>
              <input type="text" name="nama_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
            </div> 
            <div class="col-md-12">
              <label for="kadiv_id" class="form-label">Departement</label>
              <select class="form-select" name="departement_id">
                <option readonly>-- departement --</option>
                <?php foreach ($departement as $d){ ?>
                <option value="<?= $d->id_departement?>"><?=$d->nama_departement?></option>
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
              <label for="nama_divisi" class="form-label">Nama Divisi</label>
              <input type="hidden" name="id_divisi" id="id_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
              <input type="text" name="nama_divisi" id="nama_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="departement_id" class="form-label">Departement</label>
              <select class="form-select" name="departement_id" id="departement_id">
                <option readonly>-- departement --</option>
                <?php foreach ($departement as $d){ ?>
                <option value="<?= $d->id_departement?>"><?=$d->nama_departement?></option>
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
        document.getElementById("departement_id").value = divisi.departement_id;
        document.getElementById("nama_divisi").value = divisi.nama_divisi;
        document.getElementById("kadiv_id").value = divisi.kadiv_id;
        document.getElementById("manager_id").value = divisi.manager_id;
      }
    });
  }
</script>