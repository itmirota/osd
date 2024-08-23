<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Nama Pegawai</th>
            <th class="text-center">Divisi</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Durasi</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
            foreach($list_data as $ld):
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $ld->nama_pegawai ?></td>
            <td class="text-center"><?= $ld->nama_divisi ?></td>
            <td><?= mediumdate_indo($ld->tgl_izin)?></td>
            <td><?= $ld->waktu_mulai ?> - <?= $ld->waktu_akhir ?></td>
            <td class="text-center">
            <?php
              switch ($ld->approval){
                case("N,N,N"):?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan atasan</span>
                <?php break;?>
                <?php case("Y,N,N"):?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan HRD</span>
                <?php break;?>
                <?php case("N,Y,Y"):?>
                <?php case("Y,Y,N"):?>
                  <span class="badge text-bg-success"> approve</span>
                <?php break;?>
                <?php default:?>
                  <span class="badge text-bg-danger"> tidak di approve</span>
                <?php break;?>
              <?php }?>  
              <a href="" onclick="listApproval(<?= $ld->id_perizinan_harian?>)" data-bs-toggle="modal" data-bs-target="#listApproval"><i class="fas fa-eye ms-2"></i></a> 
            </td>
            <td>
            <?php 
              switch ($ld->approval){
              case("Y,Y,Y"):
              case("Y,Y,N"):
              case("Y,N,Y"):?>
            <?php break;?>
            <?php default:?>
              <a href="<?= base_url('approvalIzinHarian/'.$ld->id_perizinan_harian.'/Y') ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> approve</a> 
              <a href="<?= base_url('approvalIzinHarian/'.$ld->id_perizinan_harian.'/T') ?>" class="btn btn-sm btn-danger"><i class="fas fa-xmark"></i> tidak</a>
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

<script>
  function listApproval($id){ 
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
        '<td><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approval+'</td>'+
        '</tr>';
        }

        $("#list_approval").html(html);
        }

    });
  };
</script>