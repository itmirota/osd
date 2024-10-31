
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importCsv"><i class="fa fa-file"></i> Import CSV</button> -->
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addPegawaiNonAktif"><i class="fa fa-plus"></i> Tambah Pegawai Non Aktif</button>
  </div>


  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Pegawai Non Aktif</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <div class="d-flex">
          <div class="flex-fill pegawai-nonaktif">
            <div class="mb-1 row">
              <label for="no_polisi" class="col-sm-4 col-form-label">Pegawai non aktif</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_nonaktif->total_pegawai?> Orang">
              </div>
            </div>
            <div class="mb-1 row">
              <label for="inputPassword" class="col-sm-4 col-form-label">Laki-Laki</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_nonaktif->laki?> Orang">
              </div>
            </div>
            <div class="mb-1 row">
              <label for="no_polisi" class="col-sm-4 col-form-label">Perempuan</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_nonaktif->perempuan?> Orang">
              </div>
            </div>
          </div>
        </div>
        <hr>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th  width="20vh">Nama pegawai</th>
            <th>Tanggal Berakhir</th>
            <th>Alasan</th>
            <th>Status</th>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
            {
            ?>
            <th class="text-center" width="100px">#</th>
            <?php } ?>
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
            <td>
              <a href="" data-bs-toggle="modal" data-bs-target="#detailPegawai" onclick="detailPegawai(<?= $data->id_pegawai?>)"><strong><?= $data->nama_pegawai ?></strong></a>
              <hr class="m-0">
              <span style="font-size:12px"><strong><?= $data->nama_departement ?>/<?= $data->nama_divisi ?></strong></span><br>
              <span style="font-size:12px"><strong>Area: KANTOR</strong></span><br>
              <span style="font-size:12px">NIK: MRT<?= $data->nip ?></span>
            </td>
            <td class="text-center"><?= is_null($data->tgl_keluar) ? '-': mediumdate_indo($data->tgl_keluar) ?></td>
            <td><?= $data->nama_divisi ?></td>
            <td><span class="badge <?= ($data->status_pegawai == "tetap" ? 'bg-primary':'bg-info')?>"><?=  ($data->status_pegawai == "tetap" ? 'PKWTT':'PKWT') ?></span></td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
            {
            ?>
            <td class="text-center">
              <div class="btn-group">
                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>

                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_pegawai?>)">Edit Data</a></li>
                  <li><a class="dropdown-item" href="#" onclick="deletePegawai(<?= $data->id_pegawai?>)">Hapus Data</a></li>
                </ul>
              </div>
            </td>
            <?php } ?>
          </tr>
          <?php
            endforeach;
          }
          ?>
          </tbody>
        </table>       
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('pegawai/updateNonAktif')?>" role="form" id="editRuangan" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-10">
                <label for="tgl_masuk" class="form-label">Tanggal Keluar</label>
                <input type="hidden" name="id_pegawai" id="pegawai_id" class="form-control tabel-PR"/>
                <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control tabel-PR"/>
              </div> 
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

<!-- Modal -->
<div class="modal fade" id="addPegawaiNonAktif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('pegawai/saveNonAktif')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Pegawai Non Aktif</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-10">
              <label for="pegawai" class="form-label">Nama Pegawai</label>
              <select name="id_pegawai" class="form-select tabel-PR" required>
                <option>----- pilih pegawai ---</option>
                <?php foreach($pegawai as $ld): ?>
                <option value="<?= $ld->id_pegawai?>"><?=$ld->nip?> | <?=$ld->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-10">
              <label for="tgl_keluar" class="col-sm-4 col-form-label">Tanggal Berakhir</label>
              <input type="date" name="tgl_keluar" class="form-control"> 
            </div>
            <div class="col-md-10">
              <label for="alasan" class="col-sm-4 col-form-label">Alasan</label>
              <input type="text" name="alasan" placeholder="masukkan alasan disini" class="form-control"> 
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
      url:"<?php echo site_url("pegawai/detailpegawai")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){

        const pegawai = hasil.pegawai;
        const user = hasil.user;
        
        document.getElementById("pegawai_id").value = pegawai.id_pegawai;
        document.getElementById("tgl_keluar").value = pegawai.tgl_keluar;
      }
    });
  }

  function deletePegawai($id){
    Swal.fire({
      title: "Apakah Kamu Yakin?",
      text: "Kamu yakin akan menghapus data ini?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus",
      cancelButtonText: "tidak"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url:"<?php echo site_url("pegawai/delete")?>/" + $id,
          dataType:"JSON",
          type: "get",
          success:function(hasil){
            Swal.fire({
              title: "Data dihapus!",
              text: "Data Pegawai Berhasil dihapus",
              icon: "success"
            });
          }
        });
      }
    });
	}
</script>