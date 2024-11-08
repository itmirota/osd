
<div class="row" style="margin-top:25vh">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div style="width:100%;" id="reader"></div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body">
        <div class="table-responsive no-padding">
      <table id="DataTable" class="table table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama Karyawan</th>
          <th>Jam Datang</th>
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
            <td><?= $no++?></td>
            <td>
              <strong><?= $ld->nama_pegawai?></strong>
              <hr class="m-0">
              <span style="font-size:12px"><strong><?= $ld->nama_departement ?>/<?= $ld->nama_divisi ?></strong></span><br>
              <span style="font-size:12px">NIK: MRT<?= $ld->nip ?></span>
            </td>
            <td><?= $ld->time_attend?></td>
          </tr>
          <?php
          endforeach;
        }
        ?>
        </tbody>
      </table>
      </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/dist/js/html5-qrcode.min.js"></script>
<script>
// QRCODE
let html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

function onScanSuccess(qrCodeMessage) {
  $.ajax({
    url:"<?php echo site_url("DaftarHadir/updateKehadiran")?>/" + qrCodeMessage,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      window.location.reload();
    }
  });
}

function onScanError(qrCodeMessage) {
}
</script>