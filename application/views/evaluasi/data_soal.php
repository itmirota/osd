
<div class="row">
  <div class="col-md-12">
    <h3><?= $pageHeader ?> <?= $jenis->nama_evaluasi_jenis?></h3>
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
      <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
      <div class="d-flex justify-content-between mb-4">
        <a href="<?= base_url('jenis-evaluasi')?>" class="btn btn-secondary"><i class="fa fa-angles-left"></i> Kembali</a>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddDataEvaluasi"><i class="fa fa-plus"></i> Tambah Soal</button>
      </div>
      <?php } ?>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>parameter</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Target</th>
            <th>Bobot</th>
            <th class="text-center">Action</th>
          </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach ($list_data as $d) { ?>
              <tr>
                <td><?= $no?></td>
                <td><?= $d->parameter?></td>
                <td><?= $d->judul?></p></td>
                <td><?= $d->deskripsi?></td>
                <td><?= $d->target?></td>
                <td><?= $d->bobot?></td>
                <td class="text-center">
                  <a href="" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#EditDataEvaluasi" onclick="ShowData(<?= $d->id_evaluasi_soal?>)"><i class="fa fa-edit"></i></a>
                  <a href="<?= base_url('evaluasiKerja/deleteSoal/'.$d->id_evaluasi_soal.'?j='.$d->jenis_evaluasi_id)?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="AddDataEvaluasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Soal <?= $jenis->nama_evaluasi_jenis?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('evaluasiKerja/saveSoal?j='.$jenis->id_evaluasi_jenis)?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="col-md-12">
          <label for="parameter" class="form-label">parameter</label>
            <input type="text" class="form-control" name="parameter" placeholder="isi parameter disini">
        </div>
        <div class="col-md-12">
          <label for="judul" class="form-label">judul</label>
            <input type="text" class="form-control" name="judul"  placeholder="isi judul disini">
        </div>
        <div class="col-md-12">
          <label for="deskripsi" class="form-label">deskripsi</label>
            <input type="text" class="form-control" name="deskripsi"  placeholder="isi deskripsi disini">
        </div>        
        <div class="row">
          <div class="col-md-6">
            <label for="target" class="form-label">Target</label>
              <input type="text" class="form-control" name="target" required>
          </div>
          <div class="col-md-6">
            <label for="bobot" class="form-label">Bobot</label>
              <input type="text" class="form-control" name="bobot" required>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Soal <?= $jenis->nama_evaluasi_jenis?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('evaluasiKerja/updateSoal?j='.$jenis->id_evaluasi_jenis)?>" role="form" method="post" enctype="multipart/form-data">
      <input type="hidden" class="form-control" name="id_evaluasi_soal" id="id_evaluasi_soal">
      <div class="modal-body">
        <div class="col-md-12">
          <label for="parameter" class="form-label">parameter</label>
            <input type="text" class="form-control" name="parameter" id="parameter" placeholder="isi parameter disini">
        </div>
        <div class="col-md-12">
          <label for="judul" class="form-label">judul</label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="isi judul disini">
        </div>
        <div class="col-md-12">
          <label for="deskripsi" class="form-label">deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="isi deskripsi disini">
        </div>        
        <div class="row">
          <div class="col-md-6">
            <label for="target" class="form-label">Target</label>
              <input type="text" class="form-control" name="target" id="target">
          </div>
          <div class="col-md-6">
            <label for="bobot" class="form-label">Bobot</label>
              <input type="text" class="form-control" name="bobot" id="bobot">
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
      url:"<?php echo site_url("EvaluasiKerja/ShowDataSoalJson")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil);
        document.getElementById("id_evaluasi_soal").value = hasil.id_evaluasi_soal;
        // document.getElementById("jenis_evaluasi_id").value = hasil.jenis_evaluasi_id;
        document.getElementById("judul").value = hasil.judul;
        document.getElementById("parameter").value = hasil.parameter;
        document.getElementById("deskripsi").value = hasil.deskripsi;
        document.getElementById("target").value = hasil.target;
        document.getElementById("bobot").value = hasil.bobot;
      }
    });
  }
</script>