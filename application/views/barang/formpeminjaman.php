<div class="d-flex justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <form action="<?=base_url('SimpanPeminjaman')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="card-header">
        <h1 class="card-title fs-1 mt-2" id="exampleModalLabel">Formulir Booking barang</h1>
      </div>
      <div class="card-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <div class="d-flex flex-wrap">
                <div class="p-2 flex-fill">
                  <label for="nama_peminjam" class="form-label">Nama peminjam</label>
                  <input type="text" name="nama_peminjam" value="<?= ($role == ROLE_STAFF) ? $name :'' ?>" class="form-control tabel-PR" <?= ($role == ROLE_STAFF) ? 'disabled' : '' ?> />
                </div>
                <div class="p-2 flex-fill">
                  <label for="divisi_id" class="form-label">Divisi peminjam</label>
                  <select name="divisi_id" class="form-select tabel-PR" <?= ($role == ROLE_STAFF) ? 'disabled' :'' ?>>
                    <?php if ($role == ROLE_STAFF){?>
                      <option value=<?= $divisi_id ?>><?= $divisiName ?></option>
                    <?php } else { ?>
                      <option>--pilih divisi--</option>
                      <?php foreach($divisi as $data){?>
                      <option value=<?= $data->id_divisi ?>><?= $data->nama_divisi ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div> 
            <div class="col-md-12">
              <label for="divisi" class="form-label">Divisi</label>
              <select id="divisi" class="form-select" onchange="getBarangByDivisi()" required>
                <option>--- pilih divisi ---</option>
                <?php foreach($divisi as $data){?>
                <option value=<?= $data->id_divisi ?>><?= $data->nama_divisi ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <div class="d-flex flex-wrap">
                <div class="p-2 flex-fill">
                  <label for="barang_id" class="form-label">Barang</label>
                  <select name="barang_id" id="barang_id" class="form-select tabel-PR" onchange="CekBarangTersedia()">
                  </select>
                </div>
                <div class="p-2 flex-fill">
                  <label for="jml_barang_tersedia" class="form-label">Stok tersedia</label>
                  <input type="text" id="jml_barang_tersedia" class="form-control tabel-PR" disabled />
                </div>
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="jumlah_barang" class="form-label">Jumlah pinjam</label>
              <input type="text" name="jumlah_barang" placeholder="masukkan jumlah disini" class="form-control tabel-PR" required />
            </div>        
          </div>
          <div class="col-md-12">
            <label for="tgl_mulai" class="form-label">Tanggal Pinjam</label>
            <input type="datetime-local" name="tgl_mulai" class="form-control tabel-PR" required />
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <a href="<?= base_url('peminjaman')?>" class="btn btn-secondary me-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
function getBarangByDivisi(){
  let divisi = $("#divisi").val();
  $.ajax({
    type : "POST",
    dataType : "JSON",
    url:"<?php echo site_url("barang/getbarangByDivisi")?>",
    data : {id_divisi : divisi},
    success : function(data){
      let html = ' ';
      let i;

      html += 
          '<option>---pilih barang---</option>';
      for ( i=0; i < data.length ; i++){
          html += 
          '<option value="'+ data[i].id_barang +'">'+ data[i].nama_barang +'</option>';
      }

      $("#barang_id").html(html);
    }
  });
}

function CekBarangTersedia(){
  let id_barang = document.getElementById("barang_id").value;
  
  $.ajax({
    url:"<?php echo site_url("barang/cekStokBarang")?>/" + id_barang,
    dataType:"JSON",
    type: "GET",
    success:function(hasil){
      document.getElementById("jml_barang_tersedia").value = hasil;
    }
  });
}
</script>