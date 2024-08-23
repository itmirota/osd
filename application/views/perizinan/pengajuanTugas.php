<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addTugas"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal Penugasan</th>
            <th>Nama Pegawai</th>
            <th>pemberi Tugas</th>
            <th>Rincian</th>
            <th class="text-center">Approval</th>
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
                  <a href="" onclick="listApprovalTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApprovalTugas"><i class="fas fa-eye ms-2"></i></a> 
                <?php break;?>
                <?php case("Y,Y,N"):?>
                  <?php if ($lt->kendaraan_id > 0){?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan POOL</span>
                  <a href="" onclick="listApprovalTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApprovalTugas"><i class="fas fa-eye ms-2"></i></a>
                  <?php }else{?>
                    <span class="badge text-bg-success"> Approve</span>
                    <a href="" onclick="listApprovalTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApprovalTugas"><i class="fas fa-eye ms-2"></i></a>
                  <?php }?>
                <?php break;?>
                <?php case("Y,Y,Y"):?>
                  <span class="badge text-bg-success"> approve</span>
                  <a href="" onclick="listApprovalTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApprovalTugas"><i class="fas fa-eye ms-2"></i></a>
                <?php break;?>
                <?php default:?>
                  <span class="badge text-bg-danger"> tidak di approve</span>
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
<div class="modal fade" id="addTugas" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pengajuan Surat Tugas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('perizinan/simpanSuratTugas')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label for="penugasan_id" class="form-label">Ditugaskan Oleh:</label>
            <select name="penugasan_id" id="penugasan_id" class="form-select tabel-PR" style="width:100%">
              <option readonly>----- pilih pegawai ---</option>
              <?php foreach($pegawai as $p): ?>
              <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="tgl_tugas" class="form-label">Tanggal</label>
            <input type="datetime-local" class="form-control" name="tgl_tugas">
          </div>
          <div class="mb-3">
            <label for="tempat_tugas" class="form-label">Tempat Tugas</label>
            <input type="text" class="form-control" name="tempat_tugas">
          </div>
          <div class="mb-3">
            <label for="rincian_tugas" class="form-label">Rincian Tugas</label>
            <textarea class="form-control" name="rincian_tugas" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="kendaraan_id" class="form-label">Kendaraan</label>
            <select id="jenis_kendaraan" class="form-select tabel-PR" required>
              <option readonly>----- pilih jenis kendaraan ---</option>
              <option value="montor"> Montor</option>
              <option value="mobil"> Mobil</option>
              <option value="0"> Kendaraan Pribadi</option>
            </select>
          </div>
          <div class="mb-3" id="kendaraan">
            <select name="kendaraan_id" id="kendaraan_id" class="form-select tabel-PR">
            </select>
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
<div class="modal fade" id="listApprovalTugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApproval" aria-hidden="true">
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
            <tbody id="list_approval_tugas">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function listApprovalTugas($id){ 
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
        '<td class="text-center"><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approvalTugas+'</td>'+
        '</tr>';
        }

        $("#list_approval_tugas").html(html);
        }

    });
  };
  
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
        document.getElementById("kendaraan_tugas").value = kendaraan;

      }

    });
  };
</script>
