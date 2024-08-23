<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addIzinHarian"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable2" class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Keperluan</th>
            <th class="text-center">Durasi</th>
            <th class="text-center">Status</th>
          <tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_izinHarian))
          {
            foreach($list_izinHarian as $lip):
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= mediumdate_indo($lip->tgl_izin)?></td>
            <td><?= $lip->keperluan?></td>
            <td class="text-center"><?= $lip->waktu_mulai ?> - <?= $lip->waktu_akhir ?></td>
            <td class="text-center">
              <?php
                switch ($lip->approval){
                  case("N,N,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan atasan</span>
                  <?php break;?>
                  <?php case("Y,N,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan HRD</span>
                    <a href="" onclick="listApprovalIzinHarian(<?= $lip->id_perizinan_harian?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzinHarian"><i class="fas fa-eye ms-2"></i></a> 
                  <?php break;?>
                  <?php case("Y,Y,Y"):?>
                  <?php case("Y,Y,N"):?>
                  <?php case("Y,N,Y"):?>
                    <span class="badge text-bg-success"> approve</span>
                    <a href="" onclick="listApprovalIzinHarian(<?= $lip->id_perizinan_harian?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzinHarian"><i class="fas fa-eye ms-2"></i></a> 
                  <?php break;?>
                  <?php default:?>
                    <span class="badge text-bg-danger"> tidak di approve</span>
                    <a href="" onclick="listApprovalIzinHarian(<?= $lip->id_perizinan_harian?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzinHarian"><i class="fas fa-eye ms-2"></i></a> 
                  <?php break;?>
                <?php }?> 
            </td>
          </tr>
            <?php endforeach; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Izin -->
<div class="modal fade" id="addIzinHarian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Izin Pribadi Kurang Dari 1 Hari</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('izinHarian/simpan')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="tgl_izin" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tgl_izin">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="waktu_mulai" class="form-label">Waktu Keluar</label>
                <input type="time" class="form-control" name="waktu_mulai">
              </div>
            </div>
            <div class="mb-3">
              <label for="keperluan" class="form-label">Keperluan</label>
              <textarea class="form-control" name="keperluan" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Ajukan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal list approval -->
<div class="modal fade" id="listApprovalIzinHarian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApprovalIzinHarian" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApproval">List Approval</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Status Approval</th>
              <th>Tgl Approval</th>
            </tr>
            </thead>
            <tbody id="list_approval_izinHarian">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function listApprovalIzinHarian($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>izinHarian/listApprovalIzin/" + $id,
      success : function(hasil){ 
        console.log(hasil);

        let html = '';
        let i;
        for ( i=0; i < hasil.length ; i++){


        switch(hasil[i].status_approval) {
          case "Y":
            code = "success"
            status = "disetujui"
            break;
          default:
            code = "danger"
            status = "tidak"
        }

        html +=
        '<tr>'+
        '<td>'+hasil[i].nama_pegawai+'</td>'+
        '<td class="text-center"><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approval+'</td>'+
        '</tr>';
        }

        $("#list_approval_izinHarian").html(html);
        }

    });
  };
</script>
