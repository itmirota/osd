<main class="container">
<div class="card">
  <form action="<?=base_url('pegawai/update')?>" role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="page" value="<?=$page?>"/>
    <div class="card-header">
      <h3 id="examplecardLabel">Formulir Edit Data</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <div class="col-md-10">
              <label for="nip" class="form-label">Nomor Induk Karyawan</label>
              <input type="text" name="nip" id="nip" value="<?=$list_data->nip?>" class="form-control-plaintext tabel-PR" readonly/>
            </div>
            <div class="col-md-10">
              <label for="nama_pegawai" class="form-label">Nama Karyawan</label>
              <input type="text" name="nama_pegawai" value="<?=$list_data->nama_pegawai?>" class="form-control tabel-PR"/>
            </div>
            <div class="col-md-10">
              <label for="jabatan_id" class="form-label">Jabatan</label>
              <select name="jabatan_id" id="jabatan_id" class="form-select tabel-PR" <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?>>
                <?php foreach($jabatan as $j): ?>
                <option value="<?= $j->id_jabatan?>" <?= $list_data->jabatan_id == $j->id_jabatan ? " selected" : ""?>><?=$j->nama_jabatan?></option>
                <?php endforeach; ?>
              </select>
            </div> 
            <div class="col-md-10">
              <label for="departement_id" class="form-label">Departement</label>
              <select name="departement_id" id="departement_id" class="form-select tabel-PR" <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?>>
                <?php foreach($departement as $d): ?>
                <option value="<?= $d->id_departement?>" <?= $list_data->departement_id == $d->id_departement ? " selected" : ""?>
                ><?=$d->nama_departement?></option>
                <?php endforeach; ?>
              </select>
            </div>  
            <div class="col-md-10">
              <label for="divisi_id" class="form-label">Divisi</label>
              <select name="divisi_id" id="divisi_id" class="form-select tabel-PR" <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?>>
                <?php foreach($divisi as $d): ?>
                <option value="<?= $d->id_divisi?>" <?= $list_data->divisi_id == $d->id_divisi ? " selected" : ""?>><?=$d->nama_divisi?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-10">
              <label for="bagian_id" class="form-label">Bagian</label>
              <select name="bagian_id" id="bagian_id" class="form-select tabel-PR" <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?>>
                <?php foreach($bagian as $d): ?>
                <option value="<?= $d->id_bagian?>" <?= $list_data->bagian_id == $d->id_bagian ? " selected" : ""?>
                ><?=$d->nama_bagian?></option>
                <?php endforeach; ?>
              </select>
            </div>    
            <div class="col-md-10">
              <label for="status_pegawai" class="form-label">Status Kerja</label>
              <select name="status_pegawai"  id="status_pegawai" class="form-select tabel-PR" <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?>>
                <option value="tetap" <?= $list_data->status_pegawai == "tetap" ? " selected" : ""?>> PKWTT</option>
                <option value="kontrak"<?= $list_data->status_pegawai == "kontrak" ? " selected" : ""?>> PKWT</option>
              </select>
            </div>
            <div class="col-md-10">
              <label for="kuota_cuti" class="form-label">Kuota Cuti</label>
              <input type="text-plaintext" name="kuota_cuti" id="kuota_cuti" value="<?=$list_data->kuota_cuti?>"
              <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?> class="<?= $this->uri->segment(1) == 'editdata' ? 'form-control-plaintext' : 'form-control'?> tabel-PR"/>
            </div>
            <div class="col-md-10">
              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
              <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tabel-PR" value="<?=$list_data->tempat_lahir?>"/>
            </div> 
            <div class="col-md-10">
              <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control tabel-PR" value="<?=$list_data->tgl_lahir?>"/>
            </div>
            <div class="col-md-10">
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="jenis_kelamin" class="form-select tabel-PR" required>
                <option <?= empty($list_data->jenis_kelamin) ? " selected" : ""?>> pilih jenis kelamin</option>
                <option value="L" <?= $list_data->jenis_kelamin == "L" ? " selected" : ""?>> Laki - laki</option>
                <option value="P" <?= $list_data->jenis_kelamin == "P" ? " selected" : ""?>> Perempuan</option>
              </select>
            </div>
            <div class="col-md-10">
              <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
              <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" value="<?=$list_data->pendidikan_terakhir?>" class="form-control tabel-PR"/>
            </div>
            <div class="col-md-10">
              <label for="jurusan" class="form-label">Jurusan</label>
              <input type="text" name="jurusan" value="<?=$list_data->jurusan?>" class="form-control tabel-PR"/>
            </div>
            <div class="col-md-10">
              <label for="golongan_darah" class="form-label">Golongan Darah</label>
              <select name="golongan_darah" id="golongan_darah"  class="form-select tabel-PR">
                <option <?= empty($list_data->golongan_darah) ? " selected" : ""?>> pilih golongan darah</option>
                <option value="A" <?= $list_data->golongan_darah == "A" ? " selected" : ""?>> AB</option>
                <option value="B" <?= $list_data->golongan_darah == "B" ? " selected" : ""?>> B</option>
                <option value="AB" <?= $list_data->golongan_darah == "AB" ? " selected" : ""?>> AB</option>
                <option value="O" <?= $list_data->golongan_darah == "O" ? " selected" : ""?>> O</option>
              </select>
            </div>
            <div class="col-md-10">
              <label for="agama" class="form-label">Agama</label>
              <input type="text" name="agama" id="agama" value="<?=$list_data->agama?>" placeholder="tulis agama disini" class="form-control tabel-PR"/>
            </div>
            <div class="row mt-3">
              <label for="Alamat_ktp" class="form-label">Alamat KTP</label>
            </div>
            <div class="col-md-10">
              <div class="row">
                <div class="col-md-6">
                  <label for="provinsiktp_id" class="form-label">Provinsi</label>
                  <select name="provinsiktp_id" id="provinsiktp_edit_id" onchange="Kabupatenktp_edit()" class="form-select tabel-PR">
                    <option>----- pilih Provinsi ---</option>
                    <?php foreach($provinsi as $p): ?>
                    <option value="<?= $p->id?>" <?= $list_data->provinsiktp_id == $p->id ? " selected" : ""?>><?=$p->name?></option>
                    <?php endforeach; ?>
                  </select>
                </div> 
                <div class="col-md-6">
                  <label for="kabupatenktp_id" class="form-label">Kabupaten</label>
                  <select name="kabupatenktp_id" id="kabupatenktp_edit_id" onchange="Kecamatanktp_edit()" class="form-select tabel-PR">
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="kecamatanktp_id" class="form-label">Kecamatan</label>
                  <select name="kecamatanktp_id" id="kecamatanktp_edit_id" onchange="Kelurahanktp_edit()" class="form-select tabel-PR">
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="kelurahanktp_id" class="form-label">Kelurahan</label>
                  <select name="kelurahanktp_id" id="kelurahanktp_edit_id" class="form-select tabel-PR">
                  </select>
                </div> 
              </div>
            </div>
            <div class="col-md-5">
              <label for="kodepos_ktp" class="form-label">Kodepos</label>
              <input type="text" name="kodepos_ktp" placeholder="tulis kodepos disini" class="form-control tabel-PR" />
            </div>
            <div class="col-md-10">
              <label for="Alamat_ktp" class="form-label">Alamat Detail</label>
              <textarea name="alamat_ktp" id="alamat_ktp" class="form-control tabel-PR" required rows="3"><?=$list_data->alamat_ktp?></textarea>
            </div>
            <hr>
            <div class="row">
              <label for="Alamat_domisili" class="form-label">Alamat domisili</label>
            </div>
            <div class="col-md-10">
              <div class="row">
                <div class="col-md-6">
                  <label for="provinsidomisili_id" class="form-label">Provinsi</label>
                  <select name="provinsidomisili_id" id="provinsidomisili_edit_id" onchange="Kabupatendomisili_edit()" class="form-select tabel-PR">
                    <option>----- pilih Provinsi ---</option>
                    <?php foreach($provinsi as $p): ?>
                    <option value="<?= $p->id?>"><?=$p->name?></option>
                    <?php endforeach; ?>
                  </select>
                </div> 
                <div class="col-md-6">
                  <label for="kabupatendomisili_id" class="form-label">Kabupaten</label>
                  <select name="kabupatendomisili_id" id="kabupatendomisili_edit_id" onchange="Kecamatandomisili_edit()" class="form-select tabel-PR">
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="kecamatandomisili_id" class="form-label">Kecamatan</label>
                  <select name="kecamatandomisili_id" id="kecamatandomisili_edit_id" onchange="Kelurahandomisili_edit()"class="form-select tabel-PR">
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="kelurahandomisili_id" class="form-label">Kelurahan</label>
                  <select name="kelurahandomisili_id" id="kelurahandomisili_edit_id" class="form-select tabel-PR">
                  </select>
                </div> 
              </div>
            </div>
            <div class="col-md-5">
              <label for="kodepos_domisili" class="form-label">Kodepos</label>
              <input type="text" name="kodepos_domisili" placeholder="tulis kodepos disini" class="form-control tabel-PR" />
            </div>
            <div class="col-md-10">
              <label for="Alamat_domisili" class="form-label">Alamat Detail</label>
              <textarea name="alamat_domisili" id="alamat_domisili" placeholder="tulis alamat sesuai domisili disini" class="form-control tabel-PR" rows="3"><?=$list_data->alamat_domisili?></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="col-md-10">
              <label for="kontak" class="form-label">Kontak yang bisa dihibungi</label>
              <input type="text" name="kontak_pegawai" id="kontak" placeholder="tulis kontak disini" class="form-control tabel-PR" value="<?=$list_data->kontak_pegawai?>"/>
            </div> 
            <div class="col-md-10">
              <label for="no_kk" class="form-label">Nomor KK</label>
              <input type="text" name="no_kk" id="no_kk" placeholder="tulis nomor KK disini" class="form-control tabel-PR" value="<?=$list_data->no_kk?>"/>
            </div>
            <div class="col-md-10">
              <label for="no_ktp" class="form-label">Nomor KTP</label>
              <input type="text" name="no_ktp" id="no_ktp" placeholder="tulis nomor KTP disini" class="form-control tabel-PR" value="<?=$list_data->no_ktp?>"/>
            </div>
            <div class="col-md-10">
              <label for="no_jamsostek" class="form-label">Nomor Bpjs Kesehatan</label>
              <input type="text" name="no_jamsostek" id="no_jamsostek" placeholder="tulis nomor Jamsostek disini" class="form-control tabel-PR" value="<?=$list_data->no_jamsostek?>" />
            </div>
            <div class="col-md-10">
              <label for="no_npwp" class="form-label">Nomor NPWP</label>
              <input type="text" name="no_npwp" id="no_npwp" placeholder="tulis NPWP disini" class="form-control tabel-PR" value="<?=$list_data->no_npwp?>"/>
            </div>
            <div class="col-md-10">
              <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
              <input type="date" name="tgl_masuk" id="tgl_masuk" value="<?=$list_data->tgl_masuk?>" class="form-control tabel-PR" <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?>/>
            </div> 
            <div class="col-md-10">
              <label for="tgl_masuk" class="form-label">Tanggal Selesai Kontrak</label>
              <input type="date" name="tgl_selesai" id="tgl_selesai" value="<?=$list_data->tgl_selesai?>" class="form-control tabel-PR" <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?>/>
            </div> 
            <div class="col-md-10">
              <label for="durasi_kontrak" class="form-label">Durasi Kerja</label>
              <select name="durasi_kontrak" id="lama_kontrak" class="form-select tabel-PR" <?= $this->uri->segment(1) == 'editdata' ? 'disabled' : ''?>>
                <option <?= empty($list_data->durasi_kontrak) ? " selected" : ""?>> pilih durasi</option>
                <option value="0" <?= $list_data->durasi_kontrak == "0" ? " selected" : ""?>> karyawan tetap</option>
                <option value="3" <?= $list_data->durasi_kontrak == "3" ? " selected" : ""?>> 3 Bulan</option>
                <option value="6" <?= $list_data->durasi_kontrak == "6" ? " selected" : ""?>> 6 Bulan</option>
                <option value="12" <?= $list_data->durasi_kontrak == "12" ? " selected" : ""?>> 12 Bulan</option>
              </select>
            </div>
            <div class="col-md-10">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email_pegawai" id="email_pegawai" value="<?=$list_data->email_pegawai?>" class="form-control tabel-PR"/>
            </div>
            <div class="col-md-10">
              <label for="nama_ibu" class="form-label">Nama Ibu</label>
              <input type="text" name="nama_ibu" id="nama_ibu" value="<?=$list_data->nama_ibu?>" class="form-control tabel-PR"/>
            </div>
            <div class="col-md-10">
              <label for="nama_ayah" class="form-label">Nama ayah</label>
              <input type="text" name="nama_ayah" id="nama_ayah" value="<?=$list_data->nama_ayah?>" class="form-control tabel-PR"/>
            </div>
            <div class="col-md-10">
              <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
              <select name="status_pernikahan" id="status_pernikahan" class="form-select tabel-PR">
                <option value="lajang" <?= $list_data->status_pernikahan == "lajang" ? " selected" : ""?>> Belum Menikah</option>
                <option value="menikah" <?= $list_data->status_pernikahan == "menikah" ? " selected" : ""?>> Menikah</option>
              </select>
            </div>
            <div class="row">
              <div class="col-md-5">
                <label for="nama_pasangan" class="form-label">Nama Pasangan</label>
                <input type="text" name="nama_pasangan" id="nama_pasangan" value="<?=$list_data->nama_pasangan?>" class="form-control tabel-PR" />
              </div>
              <div class="col-md-5">
                <label for="kontak_pasangan" class="form-label">No. HP</label>
                <input type="text" name="kontak_pasangan" id="kontak_pasangan" value="<?=$list_data->kontak_pasangan?>" class="form-control tabel-PR" />
              </div>
            </div>
            <div class="col-md-10">
              <label for="nama_anak" class="form-label">Nama Anak (jika lebih dari satu pisahkan dengan koma)</label>
              <textarea name="nama_anak" id="nama_anak" class="form-control tabel-PR"><?=$list_data->nama_anak?></textarea>
            </div>
            <div class="col-md-10">
              <h3><strong>Kontak Darurat</strong></h3>
            </div>
            <hr>
            <div class="col-md-10">
              <label for="nama_kontakdarurat1" class="form-label">Nama Kontak Darurat 1</label>
              <input type="text" id="nama_kontakdarurat1" name="nama_kontakdarurat1" value="<?=$list_data->nama_kontakdarurat1?>" class="form-control" />
            </div>
            <div class="row">
              <div class="col-md-5">
                <label for="no_hpdarurat1" class="form-label">No. HP 1</label>
                <input type="text" id="no_kontakdarurat1" value="<?=$list_data->no_hpdarurat1?>" name="no_hpdarurat1"
                class="form-control" />
              </div>
              <div class="col-md-5">
                <label for="hubungan_darurat1" class="form-label">Hubungan Kontak Darurat 1</label>
                <input type="text" id="hubungan_kontakdarurat1" value="<?=$list_data->hubungan_darurat1?>" name="hubungan_darurat1" class="form-control" />
              </div>
            </div>
            <div class="col-md-10">
              <label for="nama_kontakdarurat1" class="form-label">Nama Kontak Darurat 2</label>
              <input type="text" id="nama_kontakdarurat2" name="nama_kontakdarurat2" value="<?=$list_data->nama_kontakdarurat2?>" class="form-control" />
            </div>
            <div class="row">
              <div class="col-md-5">
                <label for="no_hpdarurat1" class="form-label">No. HP 2</label>
                <input type="text" id="no_kontakdarurat2" value="<?=$list_data->no_hpdarurat2?>" name="no_hpdarurat2" class="form-control" />
              </div>
              <div class="col-md-5">
                <label for="hubungan_darurat1" class="form-label">Hubungan Kontak Darurat 2</label>
                <input type="text" id="hubungan_kontakdarurat2" value="<?=$list_data->hubungan_darurat2?>" name="hubungan_darurat2" class="form-control" />
              </div>
            </div>
          </div>
        </div>    
      </div>

    </div>
    <div class="card-footer d-flex justify-content-end">
      <button type="submit" class="btn btn-lg btn-success">Update</button>
    </div>
  </form>
</div>
</main>

<script>
    function Kabupatenktp_edit(){
    let id = $("#provinsiktp_edit_id").val();
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url:"<?php echo site_url("pegawai/getRegencies")?>/"+id,
      success : function(data){

        let html = ' ';
        let i;

        html += 
            '<option>---pilih Kabupaten---</option>';
        for ( i=0; i < data.length ; i++){
            html += 
            '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
        }

        $("#kabupatenktp_edit_id").html(html);
      }
    });
  }

  function Kecamatanktp_edit(){
    let id = $("#kabupatenktp_edit_id").val();
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url:"<?php echo site_url("pegawai/getDistricts")?>/"+id,
      success : function(data){

        let html = ' ';
        let i;

        html += 
            '<option>---pilih Kecamatan---</option>';
        for ( i=0; i < data.length ; i++){
            html += 
            '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
        }

        $("#kecamatanktp_edit_id").html(html);
      }
    });
  }

  function Kelurahanktp_edit(){
    let id = $("#kecamatanktp_edit_id").val();
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url:"<?php echo site_url("pegawai/getVillages")?>/"+id,
      success : function(data){

        let html = ' ';
        let i;

        html += 
            '<option>---pilih Kelurahan---</option>';
        for ( i=0; i < data.length ; i++){
            html += 
            '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
        }

        $("#kelurahanktp_edit_id").html(html);
      }
    });
  }

  function Kabupatendomisili_edit(){
    let id = $("#provinsidomisili_edit_id").val();
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url:"<?php echo site_url("pegawai/getRegencies")?>/"+id,
      success : function(data){

        let html = ' ';
        let i;

        html += 
            '<option>---pilih Kabupaten---</option>';
        for ( i=0; i < data.length ; i++){
            html += 
            '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
        }

        $("#kabupatendomisili_edit_id").html(html);
      }
    });
  }

  function Kecamatandomisili_edit(){
    let id = $("#kabupatendomisili_edit_id").val();
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url:"<?php echo site_url("pegawai/getDistricts")?>/"+id,
      success : function(data){

        let html = ' ';
        let i;

        html += 
            '<option>---pilih Kecamatan---</option>';
        for ( i=0; i < data.length ; i++){
            html += 
            '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
        }

        $("#kecamatandomisili_edit_id").html(html);
      }
    });
  }

  function Kelurahandomisili_edit(){
    let id = $("#kecamatandomisili_edit_id").val();
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url:"<?php echo site_url("pegawai/getVillages")?>/"+id,
      success : function(data){

        let html = ' ';
        let i;

        html += 
            '<option>---pilih Kelurahan---</option>';
        for ( i=0; i < data.length ; i++){
            html += 
            '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
        }

        $("#kelurahandomisili_edit_id").html(html);
      }
    });
  }
</script>