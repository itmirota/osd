
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
            <th>Nama Kategori</th>
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
                <td><a href="<?= base_url('list-soal-evaluasi?k='.$d->id_evaluasi_jenis)?>"><i class="fa fa-eye"></i> lihat</a></td>
                <td class="text-center">
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
      <form action="<?=base_url('evaluasiKerja/saveKategori')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label for="kategori_id" class="form-label">Kategori Evaluasi</label>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Evaluasi <?= $kategori->nama_evaluasi_kategori?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('evaluasiKerja/updateJadwal?page=')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
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
        document.getElementById("jenis_evaluasi").value = hasil.jenis_evaluasi;
        document.getElementById("kategori_nama").value = hasil.kategori;
        document.getElementById("tgl_evaluasi").value = hasil.tgl_evaluasi;
      }
    });
  }
</script>