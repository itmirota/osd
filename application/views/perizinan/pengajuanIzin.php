<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addIzin"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Akhir</th>
              <th class="text-center">Durasi</th>
              <th>Keperluan</th>
              <th class="text-center">Status</th>
            <tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if(!empty($list_izin))
            {
              foreach($list_izin as $li):
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= mediumdate_indo($li->tgl_mulai)?></td>
              <td><?= mediumdate_indo($li->tgl_akhir)?></td>
              <td class="text-center"><?= $li->selisih?> Hari</td>
              <td><?= $li->keperluan?></td>
              <td class="text-center">
                <?php
                  switch ($li->approval){
                    case("N,N,N"):?>
                      <span class="badge text-bg-warning"> Menunggu persetujuan atasan</span>
                    <?php break;?>
                    <?php case("Y,N,N"):?>
                    <?php case("N,Y,N"):?>
                      <span class="badge text-bg-warning"> Menunggu persetujuan HRD</span>
                      <a href="" onclick="listApprovalIzin(<?= $li->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
                    <?php break;?>
                    <?php case("Y,Y,Y"):?>
                    <?php case("N,Y,Y"):?>
                      <span class="badge text-bg-success"> approve</span>
                      <a href="" onclick="listApprovalIzin(<?= $li->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
                    <?php break;?>
                    <?php default:?>
                      <span class="badge text-bg-danger"> tidak di approve</span>
                      <a href="" onclick="listApprovalIzin(<?= $li->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
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
<div class="modal fade" id="addIzin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Surat Izin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('izin/simpan')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-6 mb-3">
              <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
              <input type="date" class="form-control" name="tgl_mulai">
            </div>
            <div class="col-6 mb-3">
              <label for="tgl_akhir" class="form-label">Tanggal AKhir</label>
              <input type="date" class="form-control" name="tgl_akhir">
            </div>
          </div>
          <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <input type="text" class="form-control" name="keperluan">
          </div>
          <div class="mb-3">
            <label for="pemberi_izin" class="form-label">Sudah Menghubungi</label>
            <div class="col-md-12">
              <select name="pemberi_izin" id="pemberi_izin" style="width:100%" class="form-select tabel-PR" required>
                <option readonly>----- pilih Pegawai ---</option>
                <?php foreach($pegawai as $p): ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="bukti_izin" class="form-label">Bukti Izin</label>
            <input type="file" name="bukti_izin" class="form-control" required>
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
<div class="modal fade" id="listApprovalIzin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApprovalIzin" aria-hidden="true">
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
            <tbody id="list_approval_izin">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function listApprovalIzin($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>izin/listApprovalIzin/" + $id,
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

        $("#list_approval_izin").html(html);
        }

    });
  };
</script>
