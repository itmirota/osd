<div class="row">
    <div class="card">
      <div class="card-header">
        <h3><strong>Formulir Laporan Kecelakaan Kerja</strong></h3>
      </div>
      <div class="card-body">
        <form class="row g-3" action="<?= base_url('saveKecelakaanKerja')?>" method="POST">
          <div class="row">
            <h5 class="card-title">Informasi Tenaga Kerja</h5>
            <div class="row">
              <div class="col-md-6">
                <label for="pegawai_id" class="form-label">Nama Pegawai</label>
                <select class="form-select" name="pegawai_id" id="pegawai" onchange="getPelapor()">
                  <option selected>pilih pegawai</option>
                  <?php foreach($pegawai as $p):?>
                  <option value="<?= $p->id_pegawai?>"><?= $p->nama_pegawai?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control-plaintext" id="jenis_kelamin" readonly>
              </div>
              <div class="col-md-3">
                <label for="umur" class="form-label">Umur Pegawai</label>
                <input type="text" class="form-control-plaintext" id="umur" readonly>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <label for="alamat_tinggal" class="form-label">Alamat Tempat Tinggal</label>
            <input type="text" class="form-control-plaintext" id="alamat_tinggal" readonly>
          </div>
          <div class="col-md-12">
            <label for="nomor_induk" class="form-label">Nomor Induk</label>
            <input type="text" class="form-control-plaintext" id="nomor_induk" readonly>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="bagian" class="form-label">Bagian/Departement</label>
              <input type="text" class="form-control-plaintext" id="bagian" readonly>
            </div>
            <div class="col-md-6">
              <label for="jabatan" class="form-label">Jabatan</label>
              <input type="text" class="form-control-plaintext" id="jabatan" readonly>
            </div>
          </div>
          <div class="col-md-12">
            <label for="no_hp" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control-plaintext" id="no_hp" readonly>
          </div>
          <div class="row mt-4">
            <h5 class="card-title">Deskripsi Cedera/Insiden</h5>
            <div class="col-md-6">
              <label for="tgl_kejadian" class="form-label">Tanggal dan Waktu Kejadian</label>
              <input type="datetime-local" class="form-control" id="tgl_kejadian">
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="tgl_kejadian" class="form-label">Nama Pelapor</label>
                <input type="text" class="form-control-plaintext" value="<?= $name ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="tgl_kejadian" class="form-label">Jabatan</label>
                <input type="text" class="form-control-plaintext" value="<?= $jabatan_id ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="saksi1" class="form-label">Nama Saksi 1</label>
                <select class="form-select" name="saksi1">
                  <option selected>pilih pegawai</option>
                  <?php foreach($pegawai as $p):?>
                  <option value="<?= $p->id_pegawai?>"><?= $p->nama_pegawai?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="jabatan_saksi1" class="form-label">Jabatan</label>
                <input type="text" class="form-control-plaintext" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="saksi1" class="form-label">Nama Saksi 2</label>
                <select class="form-select" name="saksi2">
                  <option selected>pilih pegawai</option>
                  <?php foreach($pegawai as $p):?>
                  <option value="<?= $p->id_pegawai?>"><?= $p->nama_pegawai?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="jabatan_saksi2" class="form-label">Jabatan</label>
                <input type="text" class="form-control-plaintext" readonly>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>


<script>
  function getPelapor($id){
    let id = $("#pegawai").val();
    $.ajax({
      url:"<?php echo site_url("kecelakaanKerja/getPelapor")?>/" + id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil);
        document.getElementById("jenis_kelamin").value = hasil.jenis_kelamin;
        document.getElementById("umur").value = hasil.umur;
        document.getElementById("alamat_tinggal").value = hasil.alamat_tinggal;
        document.getElementById("nomor_induk").value = hasil.nomor_induk;
        document.getElementById("bagian").value = hasil.bagian;
        document.getElementById("jabatan").value = hasil.jabatan;
        document.getElementById("no_hp").value = hasil.no_hp;
      }
    });
  }
</script>