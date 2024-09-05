<style>
  #detail_cuti_khusus, #kuota_cuti, #bukti_cuti{
    display:none;
  }
</style>

<div class="row">
  <div class="d-flex justify-content-between mb-4">
    <a href="<?= base_url('approvalPengganti')?>" class="btn btn-info me-2"><i class="fa fa-check"></i> Approval Pengganti</a>
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addCuti"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jenis Cuti</th>
            <th>Durasi</th>
            <th>Pengganti</th>
            <th class="text-center">Status</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if(!empty($list_cuti))
            {
              foreach($list_cuti as $lc):
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= mediumdate_indo($lc->tgl_mulai)?></td>
              <td><?= $lc->jenis_cuti ?></td>
              <td><?= $lc->selisih+1?> hari</td>
              <td><?= $lc->nama_pegawai?></td>
              <td class="text-center">
                <?php
                switch ($lc->approval){
                  case("N,N,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan pengganti</span>
                  <?php break;?>
                  <?php case("Y,N,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan Kabag</span>
                  <?php break;?>
                  <?php case("Y,Y,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan manager</span>
                  <?php break;?>
                  <?php case("Y,Y,Y"):?>
                  <?php case("Y,N,Y"):?>
                    <span class="badge text-bg-success"> approve</span>
                  <?php break;?>
                  <?php default:?>
                    <span class="badge text-bg-danger"> tidak di approve</span>
                  <?php break;?>
                <?php }?>  
                <a href="" onclick="listApproval(<?= $lc->id_cuti?>)" data-bs-toggle="modal" data-bs-target="#listApproval"><i class="fas fa-eye ms-2"></i></a> 
              </td>
            </tr>
            <?php endforeach; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Cuti -->
<div class="modal fade" id="addCuti" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pengajuan Cuti</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('perizinan/simpancuti')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                <select id="jenis_cuti" name="jenis_cuti" class="form-select tabel-PR" required>
                  <option>----- pilih Jenis Cuti ---</option>
                  <option value="tahunan">Cuti Tahunan</option>
                  <option value="khusus">Cuti Khusus</option>
                  <option value="pengganti">Cuti Pengganti Hari</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3" id="kuota_cuti">
                <label for="kuota_cuti" class="form-label">Kuota Cuti</label>
                <div class="col-md-12">
                  <input type="text" class="form-control-plaintext" value="<?=$kuota_cuti?>" >
                </div>
              </div>
              <div class="mb-3" id="detail_cuti_khusus">
                <label for="detail_cuti" class="form-label">Detail Cuti Khusus</label>
                <div class="col-md-12">
                  <select name="detail_cuti" class="form-select tabel-PR" required>
                    <option>----- pilih Detail Cuti Khusus ---</option>
                    <option value="melahirkan">Cuti Melahirkan</option>
                    <option value="duka">Cuti Keluarga Meninggal</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tgl_mulai" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tgl_akhir" required>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <textarea class="form-control" name="keperluan" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="pengganti" class="form-label">tugas dan tanggung jawab diserahkan kepada</label>
            <div class="col-md-12">
              <select name="pengganti" class="form-select tabel-PR" required>
                <option>----- pilih Penggati ---</option>
                <?php foreach($pengganti as $p): ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3"  id="bukti_cuti">
            <label for="bukti_cuti" class="form-label">Bukti Cuti</label>
            <input type="file" name="bukti_cuti" class="form-control" required>
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
            <tfoot>
            </tfoot>
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
      url :  "<?= base_url(); ?>perizinan/listApproval/" + $id,
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
