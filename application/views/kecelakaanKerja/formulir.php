<div class="row">
    <div class="card">
      <div class="card-header">
        <h3><strong>Formulir Laporan Kecelakaan Kerja</strong></h3>
      </div>
      <div class="card-body">
        <form class="row g-3" action="<?= base_url('kecelakaanKerja/saveKecelakaanKerja')?>" method="POST">
          <div class="col-12 header-formkecelakaan">
            <h4 class="font-light pt-2">Informasi Tenaga Kerja</h4>
          </div>
          <div class="row">
            <div class="row">
              <div class="col-md-6">
                <label for="pegawai_id" class="form-label">Nama Pegawai</label>
                <select class="form-select select2" name="pegawai_id" id="pegawai" onchange="getPelapor()" required>
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

          <div class="col-12 header-formkecelakaan">
            <h4 class="font-light pt-2">Deskripsi Cedera/Insiden</h4>
          </div>
          <div class="row mt-4">
            <div class="col-md-6">
              <label for="tgl_kejadian" class="form-label">Tanggal dan Waktu Kejadian</label>
              <input type="datetime-local" class="form-control" name="tgl_kejadian">
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="tgl_kejadian" class="form-label">Nama Pelapor</label>
                <input type="text" class="form-control-plaintext" value="<?= $name ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="tgl_kejadian" class="form-label">Jabatan</label>
                <input type="text" class="form-control-plaintext" value="<?= $pelapor->nama_jabatan ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="saksi1" class="form-label">Nama Saksi 1</label>
                <select class="form-select select2" name="saksi1" id="saksi1" onchange="getSaksi1()" required>
                  <option selected>pilih pegawai</option>
                  <?php foreach($pegawai as $p):?>
                  <option value="<?= $p->id_pegawai?>"><?= $p->nama_pegawai?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="jabatan_saksi1" class="form-label">Jabatan</label>
                <input type="text" id="jabatan_saksi1" class="form-control-plaintext" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="saksi1" class="form-label">Nama Saksi 2</label>
                <select class="form-select select2" name="saksi2" id="saksi2"  onchange="getSaksi2()" required>
                  <option selected>pilih pegawai</option>
                  <?php foreach($pegawai as $p):?>
                  <option value="<?= $p->id_pegawai?>"><?= $p->nama_pegawai?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="jabatan_saksi2" class="form-label">Jabatan</label>
                <input type="text" id="jabatan_saksi2" class="form-control-plaintext" readonly>
              </div>
            </div>
          </div>
          <label for="kategori_insiden" class="form-label">Kategori Insiden</label>
          <div class="d-flex align-items-start">
            <div class="col-4 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="kategori_insiden" id="inlineRadio1" value="Situasi Berbahaya">
              <label class="form-check-label m-0" for="inlineRadio1">Near Miss/ Situasi Berbahaya (berpotensi mengakibatkan cedera atau kerugian asset perusahaan)</label>
            </div>
            <div class="col-4 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="kategori_insiden" id="inlineRadio2" value="Lost Time">
              <label class="form-check-label m-0" for="inlineRadio2">Lost Time(absen dari pekerjaan karena cedera)</label>
            </div>
          </div>
          <div class="d-flex align-items-start">
            <div class="col-4 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="kategori_insiden" id="inlineRadio1" value="Situasi Berbahaya">
              <label class="form-check-label m-0" for="inlineRadio1">Frist Aid (membutuhkan pengobatan segera, seperti perban, kompres dingin)</label>
            </div>
            <div class="col-4 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="kategori_insiden" id="inlineRadio2" value="Lost Time">
              <label class="form-check-label m-0" for="inlineRadio2">HealthCare (pengobatan oleh petugas medis)</label>
            </div>
          </div>
          <label for="pengobatan" class="form-label">Pengobatan Cedera</label>
          <div class="d-flex align-items-start">
            <div class="col-4 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pengobatan_cedera" id="inlineRadio1" value="Situasi Berbahaya">
              <label class="form-check-label m-0" for="inlineRadio1">Tidak Ada</label>
            </div>
            <div class="col-4 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pengobatan_cedera" id="inlineRadio2" value="Lost Time">
              <label class="form-check-label m-0" for="inlineRadio2">Perusahaan/Klinik Pertolongan Pertama</label>
            </div>
          </div>
          <div class="d-flex align-items-start">
            <div class="col-4 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pengobatan_cedera" id="inlineRadio1" value="Situasi Berbahaya">
              <label class="form-check-label m-0" for="inlineRadio1">Petugas Medis</label>
            </div>
            <div class="col-4 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pengobatan_cedera" id="inlineRadio2" value="Lost Time">
              <label class="form-check-label m-0" for="inlineRadio2">Rumah Sakit/Pelayanan Darurat</label>
            </div>
          </div>
          <div class="col-md-8">
            <label for="deskripsi_cedera" class="form-label">Deskripsi Cedera</label>
            <input type="text" name="deskripsi_cedera" class="form-control" placeholder="Tuliskan deskripsi cedera disini">
          </div>
          <div class="col-md-8">
            <label for="deskripsi_pertolongan" class="form-label">Deskripsi pertolongan pertama yang diberikan</label>
            <input type="text" name="deskripsi_pertolongan" class="form-control" placeholder="Tuliskan deskripsi pertolongan disini">
          </div>
          <div class="col-12 header-formkecelakaan">
            <h4 class="font-light pt-2">Analisis/Perbaikan Insiden</h4>
          </div>
          <div class="col-md-8">
            <label for="kronologi_kejadian" class="form-label">Kronologi Kejadian/Peristiwa</label>
            <textarea name="kronologi_kejadian" class="form-control" required></textarea>
          </div>
          <div class="col-md-8">
            <label for="penyebab_insiden" class="form-label">Penyebab Insiden/Kecelakaan</label>
            <textarea name="penyebab_insiden" class="form-control" required></textarea>
          </div>
          <div class="col-md-8">
            <label for="akibat_insiden" class="form-label">Akibat Insiden/Kecelakaan</label>
            <textarea name="akibat_insiden" class="form-control" required></textarea>
          </div>
          <div class="col-md-8">
            <label for="langkah_perbaikan" class="form-label">Langkah Perbaikan</label>
            <textarea name="langkah_perbaikan" class="form-control" required></textarea>
          </div>
          <div class="d-flex justify-content-end">
            <button class="btn btn-primary btn-md" type="submit">Simpan</button>
          </div>
        </form>
      </div>
  </div>
</div>


<script>
  function getPelapor(){
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

  function getSaksi1(){
    let id = $("#saksi1").val();
    $.ajax({
      url:"<?php echo site_url("kecelakaanKerja/getSaksi")?>/" + id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil);
        document.getElementById("jabatan_saksi1").value = hasil.jabatan;
      }
    });
  }

  function getSaksi2(){
    let id = $("#saksi2").val();
    $.ajax({
      url:"<?php echo site_url("kecelakaanKerja/getSaksi")?>/" + id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil);
        document.getElementById("jabatan_saksi2").value = hasil.jabatan;
      }
    });
  }
</script>