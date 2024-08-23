<div class="d-flex justify-content-center ">
  <div class="col-md-6">
    <div class="card">
      <form action="<?=base_url('ruangan/savelaporan')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="card-header">
        <h1 class="card-title fs-1 mt-2" id="exampleModalLabel">Formulir Laporan Kerusakan</h1>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-center">
          <div class="row">
            <div class="col-md-12" id="scanbarcodeLaporan">
              <div style="width:100%;margin:20px" id="reader"></div>
            </div>
          </div>
        </div>
        <div class="form-group" id="formLaporan">
          <div class="row">
            <div class="col-md-12">
              <label for="ruangan_id" class="form-label">Ruangan</label>
              <select name="ruangan_id" id="ruangan_id" placeholder="ruangan" class="form-select tabel-PR select2">
                <option>--pilih ruangan--</option>
                <?php foreach($ruangan as $data){?>
                <option value=<?= $data->id_ruangan ?>><?= $data->nama_ruangan ?></option>
                <?php } ?>
              </select>
              <input type="hidden" name="ruangan_id" id="ruangan_id" class="form-control tabel-PR" readonly required>
              <input type="text" id="nama_ruangan" class="form-control-plaintext tabel-PR" readonly required>
            </div>
            <div class="col-md-12">

            </div> 
            <div class="col-md-12">
              <label for="keterangan" class="form-label">Keterangan Kerusakan</label>
              <textarea type="text" name="keterangan" placeholder="tuliskan detail kerusakan disini" class="form-control tabel-PR" required></textarea>
            </div>   
            <div class="col-md-12">
              <label for="keterangan" class="form-label">Bukti kerusakan</label>
              <input type="file" name="bukti_kerusakan" placeholder="masukkan keperluan disini" class="form-control tabel-PR" required />
            </div>      
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <a href="<?= base_url($role === ROLE_STAFF ? 'peminjaman' : 'kerusakanRuangan')?>" class="btn btn-secondary me-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/dist/js/html5-qrcode.min.js"></script>
<script>
// QRCODE
let html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

function onScanSuccess(qrCodeMessage) {
  $("#formLaporan").show();
  $("#scanbarcodeLaporan").hide();
  $.ajax({
    url:"<?php echo site_url("ruangan/detailruangan")?>/" + qrCodeMessage,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      document.getElementById("ruangan_id").value = qrCodeMessage;
      document.getElementById("nama_ruangan").value = hasil.nama_ruangan;
    }
  });
}

function onScanError(qrCodeMessage) {
}
</script>