
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <?php if ($role == ROLE_HRBP | $role == ROLE_SUPERADMIN){ ?>
      <div class="card-header">
      <div class="d-flex justify-content-between mb-4">
        <button class="btn btn-warning" onclick="refresh()"><i class="fa fa-rotate"></i> Refresh</button>
        <a href="<?= base_url('jadwal-evaluasi-magang')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
      </div>
      </div>
      <?php } ?>
      <div class="card-body table-responsive no-padding">
        <table id="DataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal evaluasi</th>
            <th>Nama Peserta</th>
            <th>Bagian</th>
            <th>Tanggal Habis Kontrak</th>
            <th class="text-center">Penilaian</th>
          </tr>
          </thead>
          <?php
              $no = 1;
              foreach ($list_data as $ld): ?>
          <tbody>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= mediumdate_indo($ld->date) ?></td>
              <td><?= $ld->nama_peserta ?></td>
              <td><?= $ld->bagian ?></td>
              <td><?= mediumdate_indo($ld->tgl_akhir_kontrak) ?></td>
              <td class="text-center">
                  <?php if ($role == ROLE_HRBP | $role == ROLE_SUPERADMIN){ ?>
                 <a href="<?= base_url('hasil-evaluasi-magang/'.$ld->id_evaluasiMagang)?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> hasil</a> 
                 <?php } ?>
                <a href="<?= base_url('penilaian-magang/'.$ld->id_evaluasiMagang)?>" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-pencil"></i> penilaian</a>
                <!-- <input type="text" value="<?= base_url('penilaian/'.$ld->id_evaluasiMagang)?>" id="myInput">
                <button class="btn btn-sm btn-primary" onclick="myFunction()">Copy link</button> -->
              </td>

            </tr>
          </tbody>
          <?php endforeach; ?>

        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
<script>
  function refresh(){
    window.location.reload()
  }

  function myFunction() {
    // Get the text field
    var copyText = document.getElementById("myInput");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
    
    // Alert the copied text
    alert("Copied the text: " + copyText.value);
  }
</script>