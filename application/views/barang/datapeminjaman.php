
<div class="row">
  <div class="col-md-12">
    <div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-end mb-4">
      <button class="btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#AddPeminjamanBarang"><i class="fa-solid fa-plus"></i> Pinjam Barang</button>
    </div>
    <div class="calendar" id='calendar'></div>
    </div>
    </div>
  </div>
</div>
<?php 
if($page != 'Pinjambarang'){ ?>
<div class="row" >
  <div class="card">
    <div class="card-body table-responsive no-padding">
      <table id="dataTable" class="table table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th>Barang</th>
          <th>Peminjam</th>
          <th>Qty</th>
          <th>Mulai Pinjam</th>
          <th class="text-center">Tanggal Kembali</th>
          <th>Status</th>
          <?php
          if($role != ROLE_MANAGER)
          {
          ?>
          <th class="text-center">Actions</th>
          <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        if(!empty($list_data))
        {
          foreach($list_data as $data):
        ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $data->nama_barang ?></td>
          <td><?php echo $data->nama_pegawai ?></td>
          <td><?php echo $data->jumlah_pinjam ?> pcs</td>
          <td><?php echo mediumdate_indo($data->tanggal_mulai).' '.$data->waktu_mulai ?></td>
            <?php if(is_null($data->tanggal_kembali)){?>
              <td class="text-center">
              <button class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#ModalKembali" onclick="detailBarang(<?= $data->id_pinjam_barang?>)">kembali</button>
              </td>
            <?php }else{ ?>
              <td>
              <?php echo mediumdate_indo($data->tanggal_kembali).' '.$data->waktu_kembali ?>
              </td>
            <?php } ?>
          <td>
            <?php
            switch ($data->status_pinjam_barang) {
              case 'N':?>
              <span class="badge bg-danger">dipinjam</span>
              <?php break;?>
              
              <?php case 'I':?>
              <span class="badge bg-success">sudah kembali</span>
              <?php break;?>
            <?php 
            }
            ?>
          </td>
          <?php
          if($role != ROLE_MANAGER)
          {
          ?>
          <td class="text-center">
            <?php if(isset($data->tanggal_kembali)){?>
              <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ModalPenerima" onclick="detailPenerima(<?= $data->id_pinjam_barang?>)"><i class="fa fa-solid fa-eye"></i></button>
            <?php } ?>
            
            <?php
            if($role == ROLE_SUPERADMIN)
            {
            ?>
            <a href="<?= base_url('barang/deletepinjamanbarang/'.$data->id_pinjam_barang) ?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
            <?php } ?>

          </td>
          <?php } ?>
        </tr>
        <?php
          endforeach;
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="AddPeminjamanBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?=base_url('booking/'.$page)?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Booking barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div id="input" style="display:none">
              <div class="d-flex justify-content-end mb-4">
                <button class="btn btn-primary me-2" type="button" onclick="scan()"><i class="fa-solid fa-qrcode"></i> Scan</button>
              </div>
              <div class="col-12">
                <div class="row">
                <div class="col-md-4">
                  <label for="departement_id" class="form-label">Departement</label>
                  <select id="departement_id" onchange="getDivisiByDept()" class="form-select tabel-PR">
                    <option>--pilih departement--</option>
                    <?php foreach($departement as $data){?>
                    <option value=<?= $data->id_departement ?>><?= $data->nama_departement ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="divisi_id" class="form-label">Divisi</label>
                  <select name="divisiByDept" id="divisiByDept" onchange="getBarangByDivisi()" class="form-select tabel-PR">
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="barang_input" class="form-label">Nama Barang</label>
                  <select name="barang_input" id="barang_input"  class="form-select tabel-PR">
                  </select>
                </div> 
                </div>
              </div>
            </div>
            <!-- SCAN BARCODE -->
            <div class="col-md-12" id="scannerbarcode"  style="display:block">
              <div class="d-flex justify-content-end mb-4">
                <button class="btn btn-primary me-2" type="button" onclick="manual()"><i class="fa-solid fa-plus"></i> Manual</button>
              </div>
              <div style="width:100%;" id="reader"></div>
            </div>
            <div class="col-md-12" id="inputbarang" style="display:none">
              <div class="row">
                <div class="col-md-6">
                  <label for="jumlah_barang_tersedia" class="form-label">Nama Barang</label>
                  <input type="hidden" name="barang_scan" id="barang_scan" class="form-control-plaintext tabel-PR" readonly />
                  <input type="text" id="nama_barang" class="form-control-plaintext tabel-PR" readonly />
                </div>
                <div class="col-md-6">
                  <label for="jumlah_barang_tersedia" class="form-label">Stok Barang Tersedia</label>
                  <input type="text" id="jml_barang_tersedia" class="form-control-plaintext tabel-PR" readonly />
                </div>
              </div>
            </div>
            <!-- SCAN BARCODE -->
            <div class="col-md-4">
              <label for="pegawai_id" class="form-label">Nama Karyawan</label>
              <?php if($page == 'Pinjambarang'){?>
              <input type="text" class="form-control-plaintext tabel-PR" value="<?= $name ?>" readonly />
              <?php } else {?>
              <select name="pegawai_id" id="id_pegawai" style="width:100%" class="form-select tabel-PR">
                <?php foreach($pegawai as $p){?>
                  <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
              <?php } ?>
            </div> 
            <div class="col-md-4">
              <label for="jumlah_barang" class="form-label">Jumlah pinjam</label>
              <input type="text" name="jumlah_barang" placeholder="masukkan jumlah disini" class="form-control tabel-PR" required />
            </div>

            <div class="col-md-4">
              <label for="tgl_mulai" class="form-label">Tanggal Pinjam</label>
              <input type="datetime-local" name="tgl_mulai" class="form-control tabel-PR" required />
            </div>         
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Barang Kembali-->
<div class="modal fade" id="ModalKembali" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('barang/pengembalianbarang')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Barang Kembali</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Nama barang</label>
              <input type="hidden" name="id_pinjam_barang" id="id_pinjam_barang"/>
              <input type="hidden" name="id_barang" id="id_barang"/>
              <input type="text" name="nama_barang" id="detail_nama_barang" class="form-control tabel-PR" readonly />
            </div>
            <div class="col-md-12">
              <div class="row">
              <div class="col-md-6">
                <label for="nama_barang" class="form-label">Jumlah Pinjam</label>
                <input type="text" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control tabel-PR" readonly />
              </div>
              <div class="col-md-6">
                <label for="nama_barang" class="form-label">Jumlah Kembali</label>
                <input type="text" name="jml_kembali" class="form-control tabel-PR" required />
              </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="tgl_kembali" class="form-label">tanggal pengembalian</label>
              <input type="datetime-local" name="tgl_kembali" id="tgl_kembali" class="form-control tabel-PR" />
            </div>         
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Barang Kembali-->
<div class="modal fade" id="ModalPenerima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Penerima</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Nama Penerima</label>
              <input type="text" name="name" id="name" class="form-control tabel-PR" readonly />
            </div>         
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/dist/js/html5-qrcode.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'listMonth',
    locale: 'id',
    themeSystem: 'bootstrap5',
    editable : true,
    headerToolbar: {
      left: 'title',
      center: false,
      right: 'prev,next'
    },
    events: "<?= base_url();?>barang/jadwalpinjam",
  });

  calendar.render();
});

function scan(){
  document.getElementById("input").style.display = "none";
  document.getElementById("scannerbarcode").style.display = "block";
}

function manual(){
  document.getElementById("input").style.display = "block";
  document.getElementById("scannerbarcode").style.display = "none";
}

function detailBarang($id){
  $.ajax({
    url:"<?php echo site_url("barang/detailpinjambarang")?>/" + $id,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      document.getElementById("id_pinjam_barang").value = hasil.id_pinjam_barang;
      document.getElementById("detail_nama_barang").value = hasil.nama_barang;
      document.getElementById("jumlah_pinjam").value = hasil.jumlah_pinjam;
    }
  });
}

function detailPenerima($id){
  $.ajax({
    url:"<?php echo site_url("barang/detailpenerima")?>/" + $id,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      console.log(hasil);
      document.getElementById("name").value = hasil.name;
    }
  });
}

function getDivisiByDept(){
  let departement = $("#departement_id").val();
  $.ajax({
    type : "POST",
    dataType : "JSON",
    url:"<?php echo site_url("divisi/getDivisiByDept")?>/"+departement,
    success : function(data){

      let html = ' ';
      let i;

      html += 
          '<option>---pilih divisi---</option>';
      for ( i=0; i < data.length ; i++){
          html += 
          '<option value="'+ data[i].id_divisi +'">'+ data[i].nama_divisi +'</option>';
      }

      $("#divisiByDept").html(html);
    }
  });
}

function getBarangByDivisi(){
  let divisi = $("#divisiByDept").val();
  $.ajax({
    type : "POST",
    dataType : "JSON",
    url:"<?php echo site_url("barang/getBarangByDivisi")?>/"+divisi,
    success : function(data){
      console.log(data);
      let html = ' ';
      let i;

      html += 
          '<option>---pilih barang---</option>';
      for ( i=0; i < data.length ; i++){
          html += 
          '<option value="'+ data[i].id_barang +'">'+ data[i].nama_barang +' tersedia: '+data[i].stok_barang_normal+' unit</option>';
      }

      $("#barang_input").html(html);
    }
  });
}

let html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

function onScanSuccess(qrCodeMessage) {
  $("#infobarang").show();
  $("#scancekbarang").hide();
  $.ajax({
    url:"<?php echo site_url("barang/detailbarang")?>/" + qrCodeMessage,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      document.getElementById("inputbarang").style.display = "block";
      document.getElementById("scannerbarcode").style.display = "none";

      document.getElementById("barang_scan").value = hasil.id_barang;
      document.getElementById("nama_barang").value = hasil.nama_barang;
      document.getElementById("jml_barang_tersedia").value = hasil.stok_barang_normal;
    }
  });
}

function onScanError(qrCodeMessage) {
}
</script>