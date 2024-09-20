
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartement"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Departement</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Departement</th>
            <th  class="text-center">Jumlah Divisi</th>
            <th class="text-center">#</th>
          </tr>
          </thead>
          <?php
          $no = 1;
          $totdivisi = 0;
          if(!empty($list_data))
          {
              foreach($list_data as $data)
              {
          ?>
          <tbody>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $data->nama_departement ?></td>
            <td class="text-center"><a href="<?= base_url('divisi/'.$data->id_departement) ?>"><?= $data->jml_divisi ?> divisi<a></td>
            <td class="text-center">
            <div class="btn-group">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_departement?>)">Edit Data</a></li>
                <li><a class="dropdown-item" href="<?= base_url('deletedepartement/'.$data->id_departement) ?>">Hapus Data</a></li>
              </ul>
            </div>
            </td>
          </tr>
          </tbody>
          <?php
            $totdivisi=$totdivisi+$data->jml_divisi;
            }
          }
          ?>
          <tfoot>
          <td colspan="1"></td>
          <td class="text-end"><strong>Total</strong></td>
          <td class="text-center"><strong><?= $totdivisi ?> divisi</strong></td>
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
      <form action="<?=base_url('departement/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_departement" class="form-label">Nama Departement</label>
              <input type="text" name="nama_departement" placeholder="Nama departement" class="form-control tabel-PR" required />
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
      <form action="<?=base_url('departement/update')?>" role="form" id="editdepartement" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_departement" class="form-label">Nama Departement</label>
              <input type="hidden" name="id_departement" id="id_departement" placeholder="Nama departement" class="form-control tabel-PR" required />
              <input type="text" name="nama_departement" id="nama_departement" placeholder="Nama departement" class="form-control tabel-PR" required />
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
      url:"<?php echo site_url("departement/detaildepartement")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const departement = hasil.departement;
        document.getElementById("id_departement").value = departement.id_departement;
        document.getElementById("nama_departement").value = departement.nama_departement;
      }
    });
  }
</script>