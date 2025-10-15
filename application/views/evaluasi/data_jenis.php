
<div class="row">
  <div class="col-md-12">
    <h3><?= $pageHeader ?></h3>
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
      <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
      <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddDataKategori"><i class="fa fa-plus"></i> Tambah Data</button>
      </div>
      <?php } ?>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Jenis Soal</th>
            <th>Soal</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach ($list_data as $d) { ?>
              <tr>
                <td><?= $no?></td>
                <td><?= $d->nama_evaluasi_jenis?></td>
                <td><a href="<?= base_url('soal-evaluasi?j='.$d->id_evaluasi_jenis)?>"><i class="fa fa-eye"></i> lihat</a></td>
                <td class="text-center">
                  <a href="" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#EditDataEvaluasi" onclick="ShowData(<?= $d->id_evaluasi_jenis?>)"><i class="fa fa-edit"></i></a>
                  <a href="<?= base_url('evaluasiKerja/deleteJenis/'.$d->id_evaluasi_jenis)?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            <?php $no++; } ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="AddDataKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Evaluasi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('evaluasiKerja/saveJenis')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label for="jenis_id" class="form-label">Jenis Evaluasi</label>
              <input type="text" class="form-control" name="nama_evaluasi_jenis">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="EditDataEvaluasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis Evaluasi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('evaluasiKerja/updateJenis')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label for="jenis_id" class="form-label">Jenis Evaluasi</label>
              <input type="hidden" class="form-control" name="id_evaluasi_jenis" id="id_evaluasi_jenis">
              <input type="text" class="form-control" name="nama_evaluasi_jenis" id="nama_evaluasi_jenis">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  function refresh(){
    window.location.reload()
  }

  function ShowData($id){
    $.ajax({
      url:"<?php echo site_url("EvaluasiKerja/DataJenisJson")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil);
        document.getElementById("id_evaluasi_jenis").value = hasil.id_evaluasi_jenis;
        document.getElementById("nama_evaluasi_jenis").value = hasil.nama_evaluasi_jenis;
      }
    });
  }
</script>