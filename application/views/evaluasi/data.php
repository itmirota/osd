
<div class="row">
  <div class="col-md-12">
    <h3><?= $pageHeader ?></h3>
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
      <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
      <div class="d-flex justify-content-between mb-4">
        <button class="btn btn-warning" onclick="refresh()"><i class="fa fa-rotate"></i> Refresh</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddDataEvaluasi"><i class="fa fa-plus"></i> Tambah Data</button>
      </div>
      <?php } ?>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal evaluasi</th>
            <th>Nama Karyawan</th>
            <!-- <th>Kategori Evaluasi</th> -->
            <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
            <th>Jenis Evaluasi</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Hasil</th>
            <?php } ?>
            <th class="text-center">Penilaian</th>
          </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach ($list_data as $d) { ?>
              <tr>
                <td><?= $no?></td>
                <td><?= mediumdate_indo($d->tgl_evaluasi)?></td>
                <td>
                  <p><?= $d->nama_pegawai?></p>
                </td>
                <!-- <td><?= $d->kategori?></td> -->
                <td><?= $d->nama_jenis?></td>
                <td class="text-center">
                  <a type="button" onclick="ShowData(<?= $d->id_evaluasi?>)" data-bs-toggle="modal" data-bs-target="#EditDataEvaluasi"><i class="fa fa-solid fa-edit"></i></a>
                  <a href="<?= base_url('EvaluasiKerja/deleteJadwal/'.$d->id_evaluasi.'/'.$d->kategori_evaluasi)?>"><i class="fa fa-solid fa-trash"></i></a>
                </td>
                <td class="text-center"><a href="<?= base_url('EvaluasiKerja/Hasil/'.$d->id_evaluasi)?>"><i class="fa fa-solid fa-eye"></i></a></td>
                <td class="text-center"><a href="<?= base_url('penilaian-evaluasi/'.$d->id_evaluasi)?>"><i class="fa fa-solid fa-pencil"></i> mulai</a></td>
              </tr>
            <?php } ?>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Evaluasi <?= $kategori->nama_evaluasi_kategori?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('evaluasiKerja/saveJadwal?page='.$kategori->nama_evaluasi_kategori)?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <label for="kategori_id" class="form-label">Kategori Evaluasi</label>
              <input type="hidden" class="form-control-plaintext" name="kategori_id" readonly value="<?= $kategori->id_evaluasi_kategori?>">
              <input type="text" class="form-control-plaintext" readonly value="<?= $kategori->nama_evaluasi_kategori?>">
          </div>
          <div class="col-md-6">
            <label for="tgl_evaluasi" class="form-label">Tanggal Evaluasi</label>
              <input type="date" class="form-control" name="tgl_evaluasi">
          </div>
        </div>
        <div class="col-md-12">
          <label for="pegawai_id" class="form-label">Nama Pegawai</label>
          <select class="form-select" style="width:100%" id="pegawai_id" name="pegawai_id">
            <option readonly>-- nama pegawai --</option>
            <?php foreach ($karyawan as $p){ ?>
            <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-12">
          <label for="jenis" class="form-label"> Parameter Penilaian</label>
          <select name="jenis_evaluasi" class="form-select tabel-PR">
            <option>----- pilih jenis evaluasi ------</option>
            <?php foreach ($jenis as $key) { ?>
              <option value="<?= $key->id_evaluasi_jenis?>"><?= $key->nama_evaluasi_jenis?></option>
            <?php }?>
          </select>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Evaluasi <?= $kategori->nama_evaluasi_kategori?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('evaluasiKerja/updateJadwal?page='.$kategori->nama_evaluasi_kategori)?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <label for="kategori_id" class="form-label">Kategori Evaluasi</label>id_evaluasi
              <input type="hidden" class="form-control-plaintext" id="kategori_id" name="kategori_id" readonly>
              <input type="hidden" class="form-control-plaintext" id="id_evaluasi"  name="id_evaluasi" readonly>
              <input type="text" class="form-control-plaintext" id="kategori_nama" readonly>
          </div>
          <div class="col-md-6">
            <label for="tgl_evaluasi" class="form-label">Tanggal Evaluasi</label>
              <input type="date" class="form-control" name="tgl_evaluasi" id="tgl_evaluasi">
          </div>
        </div>
        <div class="col-md-12">
          <label for="pegawai_id" class="form-label">Nama Pegawai</label>
          <select class="form-select" style="width:100%" id="pegawai_edit" name="pegawai_id">
            <option readonly>-- nama pegawai --</option>
            <?php foreach ($karyawan as $p){ ?>
            <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-12">
          <label for="jenis" class="form-label"> Parameter Penilaian</label>
          <select name="jenis_evaluasi" id="jenis_evaluasi" class="form-select tabel-PR">
            <option>----- pilih jenis evaluasi ------</option>
            <?php foreach ($jenis as $key) { ?>
              <option value="<?= $key->id_evaluasi_jenis?>"><?= $key->nama_evaluasi_jenis?></option>
            <?php }?>
          </select>
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
      url:"<?php echo site_url("EvaluasiKerja/ShowDataJson")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil);
        document.getElementById("id_evaluasi").value = hasil.id_evaluasi;
        document.getElementById("pegawai_edit").value = hasil.pegawai_id;
        document.getElementById("kategori_id").value = hasil.kategori_evaluasi;
        document.getElementById("jenis_evaluasi").value = hasil.jenis;
        document.getElementById("kategori_nama").value = hasil.kategori;
        document.getElementById("tgl_evaluasi").value = hasil.tgl_evaluasi;
      }
    });
  }
</script>