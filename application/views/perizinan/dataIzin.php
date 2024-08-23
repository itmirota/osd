<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th class="text-center">Divisi</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">detail</th>
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
              <td><?= $ld->nama_pegawai?></td>
              <td class="text-center"><?= $ld->nama_divisi?></td>
              <td class="text-center"><?= mediumdate_indo($ld->tgl_mulai)?> - <?= mediumdate_indo($ld->tgl_akhir)?></td>
              <td class="text-center"><a href="" data-bs-toggle="modal" data-bs-target="#detailIzin" onclick="detailIzin(<?=$ld->id_izin?>)"><i class="fa fa-eye"></i></a></td>
              <td class="text-center">
                <?php
                  switch ($ld->approval){
                    case("N,N,N"):?>
                      <span class="badge text-bg-warning"> Menunggu persetujuan atasan</span>
                    <?php break;?>
                    <?php case("Y,N,N"):?>
                    <?php case("N,N,Y"):?>
                      <span class="badge text-bg-warning"> Menunggu persetujuan HRD</span>
                      <a href="" onclick="listApprovalIzin(<?= $ld->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
                    <?php break;?>
                    <?php case("N,Y,Y"):?>
                    <?php case("Y,Y,N"):?>
                      <span class="badge text-bg-success"> approve</span>
                      <a href="" onclick="listApprovalIzin(<?= $ld->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
                    <?php break;?>
                    <?php default:?>
                      <span class="badge text-bg-danger"> tidak di approve</span>
                      <a href="" onclick="listApprovalIzin(<?= $ld->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
                    <?php break;?>
                  <?php }?> 
              </td>
              <td>
              <?php
                switch ($ld->approval){
                  case("N,Y,Y"):
                  case("Y,Y,Y"):?>
                  <?php break;?>
                  <?php default:?>
                    <a href="<?= base_url('approvalIzin/'.$ld->id_izin.'/Y') ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> approve</a> 
                    <a href="<?= base_url('approvalIzin/'.$ld->id_izin.'/T') ?>" class="btn btn-sm btn-danger"><i class="fas fa-xmark"></i> tidak</a>
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

<!-- Modal Detail Izin -->
<div class="modal fade" id="detailIzin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailIzin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="detailIzin">Detail Izin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">
          <label for="floatingEmptyPlaintextInput">Pemberi Izin</label>
          <input type="text" readonly class="form-control-plaintext" id="pemberi_izin">
        </div>
        <div class="form-group mb-3">
          <label for="floatingEmptyPlaintextInput">Keperluan</label>
          <input type="text" readonly class="form-control-plaintext" id="keperluan">
        </div>
        <div class="form-group mb-3">
          <label for="floatingEmptyPlaintextInput">Bukti Izin</label>
          <div class="col-md-12">
          <img id="bukti_izin" width="400">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal list approval -->
<div class="modal fade" id="listApprovalIzin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApprovalIzin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApprovalIzin">List Approval</h1>
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
        '<td><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approval+'</td>'+
        '</tr>';
        }

        $("#list_approval").html(html);
        }

    });
  };

  function detailIzin($id){
    $.ajax({
      url:"<?php echo site_url("izin/detailIzin")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const urlgambar = "<?= site_url("assets/bukti_izin/")?>"+hasil.bukti_izin;

        document.getElementById("pemberi_izin").value = hasil.pemberi_izin;
        document.getElementById("keperluan").value = hasil.keperluan;

        $("#bukti_izin").attr('src',urlgambar);
      }
    });
  }
</script>