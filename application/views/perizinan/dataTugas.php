<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal Penugasan</th>
            <th>Nama Pegawai</th>
            <th class="text-center">Divisi</th>
            <th>pemberi Tugas</th>
            <th>Rincian</th>
            <th class="text-center">Approval</th>
            <th class="text-center">Aksi</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_tugas))
          {
            foreach($list_tugas as $lt):
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= mediumdate_indo($lt->tgl_tugas)?></td>
            <td><?= $lt->nama_pegawai ?></td>
            <td class="text-center"><?= $lt->nama_divisi ?></td>
            <td><?= $lt->penugasan ?></td>
            <td>
              <a href="" class="btn btn-sm btn-info" onclick="rincianTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#rincianTugas">detail <i class="fas fa-eye ms-2"></i></a>
            </td>
            <td class="text-center">
            <?php
              switch ($lt->approval){
                case("N,N,N"):?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan</span>
                <?php break;?>
                <?php case("Y,N,N"):?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan HRD</span>
                  <a href="" onclick="listApproval(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApproval"><i class="fas fa-eye ms-2"></i></a> 
                <?php break;?>
                <?php case("Y,Y,N"):?>
                  <?php if ($lt->kendaraan_id > 0){?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan POOL</span>
                  <a href="" onclick="listApproval(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApproval"><i class="fas fa-eye ms-2"></i></a>
                  <?php }else{?>
                    <span class="badge text-bg-success"> Approve</span>
                    <a href="" onclick="listApproval(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApproval"><i class="fas fa-eye ms-2"></i></a>
                  <?php }?>
                <?php break;?>
                <?php case("Y,Y,Y"):?>
                  <span class="badge text-bg-success"> approve</span>
                  <a href="" onclick="listApproval(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApproval"><i class="fas fa-eye ms-2"></i></a>
                <?php break;?>
                <?php default:?>
                  <span class="badge text-bg-danger"> tidak di approve</span>
                <?php break;?>
              <?php }?>
            </td>
            <td>
              <?php if ($lt->kendaraan_id == 0){?>
                <?php
                switch ($lt->approval){
                  case("Y,Y,N"):?>
                  <?php break;?>
                  <?php default:?>
                    <a href="<?= base_url('approvalTugas/'.$lt->id_tugas.'/Y') ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> approve</a> 
                    <a href="<?= base_url('approvalTugas/'.$lt->id_tugas.'/T') ?>" class="btn btn-sm btn-danger"><i class="fas fa-xmark"></i> tidak</a>
                  <?php break;?>
                <?php }?>
              <?php }else{ ?>
                <?php
                switch ($lt->approval){
                  case("Y,Y,Y"):?>
                  <?php break;?>
                  <?php default:?>
                    <a href="<?= base_url('approvalTugas/'.$lt->id_tugas.'/Y') ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> approve</a> 
                    <a href="<?= base_url('approvalTugas/'.$lt->id_tugas.'/T') ?>" class="btn btn-sm btn-danger"><i class="fas fa-xmark"></i> tidak</a>
                  <?php break;?>
                <?php }?>
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

<!-- Modal list approval -->
<div class="modal fade" id="listApproval" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApproval" aria-hidden="true">
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
            <tbody id="list_approval">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Rincian Tugas -->
<div class="modal fade" id="rincianTugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rincianTugas" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApproval">Rincian Tugas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 row">
          <label for="tempat_tugas" class="col-sm-4 col-form-label">Tempat Tugas</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="tempat_tugas">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="rincian_tugas" class="col-sm-4 col-form-label">Rincian Tugas</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="rincian_tugas">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="kendaraan" class="col-sm-4 col-form-label">Kendaraan</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="kendaraan">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    function rincianTugas($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>suratTugas/rincianTugas/" + $id,
      success : function(hasil){ 
        console.log(hasil);

        kendaraan = hasil.kendaraan_id;
        if(kendaraan == 0){
          kendaraan = "kendaraan pribadi";
        }else{
          kendaraan = hasil.merek_kendaraan+' | '+hasil.nomor_polisi
        };

        document.getElementById("tempat_tugas").value = hasil.tempat_tugas;
        document.getElementById("rincian_tugas").value = hasil.rincian_tugas;
        document.getElementById("kendaraan").value = kendaraan;

      }

    });
  };
  function listApproval($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>suratTugas/listApprovalTugas/" + $id,
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
        '<td><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approval+'</td>'+
        '</tr>';
        }

        $("#list_approval").html(html);
        }

    });
  };
</script>