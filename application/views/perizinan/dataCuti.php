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
            <th class="text-center">Jenis Cuti</th>
            <th class="text-center">Durasi</th>
            <th class="text-center">Detail</th>
            <th class="text-center">Approval</th>
            <?php if ($jabatan_id = 3 | $jabatan_id = 4){?>
            <th class="text-center">Aksi</th>
            <?php }?>
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
            <td><?= $lc->nama_pegawai ?></td>
            <td class="text-center"><?= $lc->nama_divisi?></td>
            <td class="text-center"><span class="badge text-bg-<?= $lc->jenis_cuti == 'tahunan' ? 'primary': ($lc->jenis_cuti == 'khusus' ? 'info':'warning')?>"> <?= $lc->jenis_cuti?></span></td>
            <td class="text-center"><?= $lc->selisih+1?> hari</td>
            <td><a href="" onclick="detailCuti(<?= $lc->id_cuti?>)" data-bs-toggle="modal" data-bs-target="#detailCuti"><i class="fas fa-eye ms-2"></i></a></td>
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
            <?php if ($jabatan_id = 3 | $jabatan_id = 4){?>
            <td>
              <?php if($lc->approval == "Y,N,N" || $lc->approval == "Y,Y,N"){?>
              <a href="<?= base_url('approvalCuti/'.$lc->id_cuti.'/Y') ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> approve</a> 
              <a href="<?= base_url('approvalCuti/'.$lc->id_cuti.'/T') ?>" class="btn btn-sm btn-danger"><i class="fas fa-xmark"></i> tidak</a>
              <?php } ?>
            </td>
            <?php }?>
          </tr>
            <?php endforeach; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Cuti -->
<div class="modal fade" id="addCuti" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pengajuan Cuti</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('perizinan/simpancuti')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
            <div class="col-md-12">
              <select id="jenis_cuti" name="jenis_cuti" class="form-select tabel-PR" required>
                <option readonly>----- pilih Jenis Cuti ---</option>
                <option value="tahunan">Cuti Tahunan</option>
                <option value="khusus">Cuti Khusus</option>
                <option value="pengganti">Cuti Pengganti Hari</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tgl_mulai" placeholder="name@example.com">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tgl_akhir" placeholder="name@example.com">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <textarea class="form-control" name="keperluan" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="pengganti" class="form-label">tugas dan tanggung jawab diserahkan kepada</label>
            <div class="col-md-12">
              <select name="pengganti" class="form-select tabel-PR" required>
                <option readonly>----- pilih Penggati ---</option>
                <?php foreach($pengganti as $p): ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3" id="bukti_cuti">
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

<!-- Modal Detail Izin -->
<div class="modal fade" id="detailCuti" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailCuti" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="detailCuti">Detail Izin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">
          <label for="floatingEmptyPlaintextInput">Tanggal Cuti</label>
          <input type="text" readonly class="form-control-plaintext" id="tgl_cuti">
        </div>
        <div class="form-group mb-3">
          <label for="floatingEmptyPlaintextInput">Pengganti</label>
          <input type="text" readonly class="form-control-plaintext" id="pengganti">
        </div>
        <div class="form-group mb-3">
          <label for="floatingEmptyPlaintextInput">Keperluan</label>
          <input type="text" readonly class="form-control-plaintext" id="keperluan">
        </div>
        <div class="form-group mb-3">
          <label for="floatingEmptyPlaintextInput">Bukti Cuti</label>
          <div class="col-md-12">
          <img id="gambar_bukti_cuti" width="400">
          </div>
        </div>
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

  function detailCuti($id){
    $.ajax({
      url:"<?php echo site_url("perizinan/detailCuti")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const urlgambar = "<?= site_url("assets/bukti_cuti/")?>"+hasil.bukti_cuti;

        const months = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nov","Des"];

        const mulai = new Date(hasil.tgl_mulai);
        const bln_mulai = months[mulai.getMonth()];
        const tgl_mulai = mulai.getDate();
        const thn_mulai = mulai.getFullYear();

        const akhir = new Date(hasil.tgl_akhir);
        const bln_akhir = months[akhir.getMonth()];
        const tgl_akhir = akhir.getDate();
        const thn_akhir = akhir.getFullYear();

        document.getElementById("tgl_cuti").value = tgl_mulai+' '+bln_mulai+' '+thn_mulai+' - '+tgl_akhir+' '+bln_akhir+' '+thn_akhir;
        document.getElementById("pengganti").value = hasil.pengganti;
        document.getElementById("keperluan").value = hasil.keperluan;

        $("#gambar_bukti_cuti").attr('src',urlgambar);
      }
    });
  }
</script>