
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importCsv"><i class="fa fa-file"></i> Import CSV</button> -->
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addPegawaiNonAktif"><i class="fa fa-plus"></i> Tambah Pegawai Non Aktif</button>
    <a href="<?= base_url('pegawai/excel_pegawai_nonAktif')?>" class="btn btn-primary me-2"><i class="fa fa-download"></i> Export Karyawan</a>
  </div>


  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Pegawai Non Aktif</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <div class="d-flex">
          <div class="flex-fill pegawai-nonaktif">
            <div class="mb-1 row">
              <label for="no_polisi" class="col-sm-4 col-form-label">Pegawai non aktif</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_nonaktif->total_pegawai?> Orang">
              </div>
            </div>
            <div class="mb-1 row">
              <label for="inputPassword" class="col-sm-4 col-form-label">Laki-Laki</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_nonaktif->laki?> Orang">
              </div>
            </div>
            <div class="mb-1 row">
              <label for="no_polisi" class="col-sm-4 col-form-label">Perempuan</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_nonaktif->perempuan?> Orang">
              </div>
            </div>
          </div>
        </div>
        <hr>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th  width="20vh">Nama pegawai</th>
            <th>Tanggal Berakhir</th>
            <th>Alasan</th>
            <th>Status</th>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
            {
            ?>
            <th class="text-center" width="100px">#</th>
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
            <td><?= $no++ ?></td>
            <td>
              <a href="" data-bs-toggle="modal" data-bs-target="#detailPegawai" onclick="detailPegawai(<?= $data->id_pegawai?>)"><strong><?= $data->nama_pegawai ?></strong></a>
              <hr class="m-0">
              <span style="font-size:12px"><strong><?= $data->nama_departement ?>/<?= $data->nama_divisi ?></strong></span><br>
              <!-- <span style="font-size:12px"><strong>Area: KANTOR</strong></span><br> -->
              <span style="font-size:12px">NIK: MRT<?= $data->nip ?></span>
            </td>
            <td class="text-center"><?= is_null($data->tgl_keluar) ? '-': mediumdate_indo($data->tgl_keluar) ?></td>
            <td><?= $data->alasan_keluar ?></td>
            <td><span class="badge <?= ($data->status_pegawai == "tetap" ? 'bg-primary':'bg-info')?>"><?=  ($data->status_pegawai == "tetap" ? 'PKWTT':'PKWT') ?></span></td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
            {
            ?>
            <td class="text-center">
              <div class="btn-group">
                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>

                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_pegawai?>)">Edit Data</a></li>
                  <li><a class="dropdown-item" href="#" onclick="deletePegawai(<?= $data->id_pegawai?>)">Hapus Data</a></li>
                </ul>
              </div>
            </td>
            <?php } ?>
          </tr>
          <?php
            endforeach;
          }
          ?>
          </tbody>
        </table>       
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('pegawai/updateNonAktif')?>" role="form" id="editRuangan" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-10">
                <label for="tgl_masuk" class="form-label">Tanggal Keluar</label>
                <input type="hidden" name="id_pegawai" id="pegawai_id" class="form-control tabel-PR"/>
                <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control tabel-PR"/>
              </div> 
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

<!-- Modal -->
<div class="modal fade" id="addPegawaiNonAktif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('pegawai/saveNonAktif')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Pegawai Non Aktif</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-10">
              <label for="pegawai" class="form-label">Nama Pegawai</label>
              <select name="id_pegawai" class="form-select tabel-PR" required>
                <option>----- pilih pegawai ---</option>
                <?php foreach($pegawai as $ld): ?>
                <option value="<?= $ld->id_pegawai?>"><?=$ld->nip?> | <?=$ld->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-10">
              <label for="tgl_keluar" class="col-sm-4 col-form-label">Tanggal Berakhir</label>
              <input type="date" name="tgl_keluar" class="form-control"> 
            </div>
            <div class="col-md-10">
              <label for="alasan" class="col-sm-4 col-form-label">Alasan</label>
              <input type="text" name="alasan" placeholder="masukkan alasan disini" class="form-control"> 
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

<!-- Modal Detail Pegawai-->
<div class="modal fade" id="detailPegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pegawai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <div class="mb-3 row">
              <label for="tempat_tglLahir" class="col-sm-4 col-form-label">Tempat, Tanggal Lahir</label>
              <div class="col-sm-8">
                <input type="text" id="tempat_tglLahir" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="shio" class="col-sm-4 col-form-label">Shio</label>
              <div class="col-sm-8">
                <input type="text" id="info_shio" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="zodiak" class="col-sm-4 col-form-label">Zodiak</label>
              <div class="col-sm-8">
                <input type="text" id="info_zodiak" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_weton" class="col-sm-4 col-form-label">Weton</label>
              <div class="col-sm-8">
                <input type="text" id="info_weton" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
              <div class="col-sm-8">
                <input type="text" id="info_jenis_kelamin" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_pendidikan_terakhir" class="col-sm-4 col-form-label">Pendidikan Terakhir</label>
              <div class="col-sm-8">
                <input type="text" id="info_pendidikan_terakhir" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_golongan_darah" class="col-sm-4 col-form-label">Golongan Darah</label>
              <div class="col-sm-8">
                <input type="text" id="info_golongan_darah" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_agama" class="col-sm-4 col-form-label">Agama</label>
              <div class="col-sm-8">
                <input type="text" id="info_agama" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_alamat_ktp" class="col-sm-4 col-form-label">Alamat KTP</label>
              <div class="col-sm-8">
                <textarea type="text" id="info_alamat_ktp" readonly class="form-control-plaintext"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_alamat_domisili" class="col-sm-4 col-form-label">Alamat domisili</label>
              <div class="col-sm-8">
                <textarea type="text" id="info_alamat_domisili" readonly class="form-control-plaintext"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_kontak" class="col-sm-4 col-form-label">Nomor</label>
              <div class="col-sm-8">
                <input type="text" id="info_kontak" readonly class="form-control-plaintext">
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3 row">
              <label for="info_ktp" class="col-sm-4 col-form-label">Nomor KTP</label>
              <div class="col-sm-8">
                <input type="text" id="info_ktp" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_kk" class="col-sm-4 col-form-label">Nomor KK</label>
              <div class="col-sm-8">
                <input type="text" id="info_kk" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_jamsostek" class="col-sm-4 col-form-label">Nomor Jamsostek</label>
              <div class="col-sm-8">
                <input type="text" id="info_jamsostek" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_bpjsKesehatan" class="col-sm-4 col-form-label">Nomor Bpjs Kesehatan</label>
              <div class="col-sm-8">
                <input type="text" id="info_bpjsKesehatan" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_npwp" class="col-sm-4 col-form-label">Nomor NPWP</label>
              <div class="col-sm-8">
                <input type="text" id="info_npwp" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_tgl_masuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
              <div class="col-sm-8">
                <input type="text" id="info_tgl_masuk" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_tgl_masuk" class="col-sm-4 col-form-label">Tanggal Selesai Kontrak</label>
              <div class="col-sm-8">
                <input type="text" id="info_tgl_selesai" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_durasi_kontrak" class="col-sm-4 col-form-label">Durasi Kontrak</label>
              <div class="col-sm-8">
                <input type="text" id="info_durasi_kontrak" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_email" class="col-sm-4 col-form-label">Email</label>
              <div class="col-sm-8">
                <input type="text" id="info_email" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_ibu" class="col-sm-4 col-form-label">Nama Ibu</label>
              <div class="col-sm-8">
                <input type="text" id="info_ibu" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_ayah" class="col-sm-4 col-form-label">Nama ayah</label>
              <div class="col-sm-8">
                <input type="text" id="info_ayah" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_pasangan" class="col-sm-4 col-form-label">Nama Pasangan</label>
              <div class="col-sm-8">
                <input type="text" id="info_pasangan" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_no_pasangan" class="col-sm-4 col-form-label">No. HP Pasangan</label>
              <div class="col-sm-8">
                <input type="text" id="info_no_pasangan" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_anak" class="col-sm-4 col-form-label">Nama anak</label>
              <div class="col-sm-8">
                <textarea id="info_anak" readonly class="form-control-plaintext"></textarea>
              </div>
            </div>
            <hr>
              <div class="col-md-10">
                <label for="nama_kontakdarurat1" class="form-label">Kontak Darurat</label>
              </div>
              <div class="col-md-10">
                <label for="nama_kontakdarurat1" class="form-label">Nama Kontak Darurat 1</label>
                <input type="text" id="info_nama_kontakdarurat1" readonly class="form-control-plaintext" />
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="no_hpdarurat1" class="form-label">No. HP 1</label>
                  <input type="text" id="info_no_hpdarurat1" readonly class="form-control-plaintext" />
                </div>
                <div class="col-md-5">
                  <label for="hubungan_darurat1" class="form-label">Hubungan Kontak Darurat 1</label>
                  <input type="text" id="info_hubungan_darurat1" readonly class="form-control-plaintext" />
                </div>
              </div>
              <div class="col-md-10">
                <label for="nama_kontakdarurat2" class="form-label">Nama Kontak Darurat 2</label>
                <input type="text" id="info_nama_kontakdarurat2" readonly class="form-control-plaintext" />
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function detailPegawai($id){
    $.ajax({
      url:"<?php echo site_url("pegawai/detailpegawai")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){

        const pegawai = hasil.pegawai;

        document.getElementById("tempat_tglLahir").value = pegawai.tempat_lahir+', '+pegawai.tgl_lahir;
        document.getElementById("info_shio").value = pegawai.shio;
        document.getElementById("info_zodiak").value = pegawai.zodiak;
        document.getElementById("info_weton").value = pegawai.weton;
        document.getElementById("info_jenis_kelamin").value = pegawai.jenis_kelamin == 'L' ? 'Laki-laki':'Perempuan';
        document.getElementById("info_pendidikan_terakhir").value = pegawai.pendidikan_terakhir+' '+pegawai.jurusan;
        document.getElementById("info_golongan_darah").value = pegawai.golongan_darah;
        document.getElementById("info_agama").value = pegawai.agama;
        document.getElementById("info_alamat_ktp").value = pegawai.alamat_ktp;
        document.getElementById("info_alamat_domisili").value = pegawai.alamat_domisili;
        document.getElementById("info_kontak").value = pegawai.kontak_pegawai;
        document.getElementById("info_kk").value = pegawai.no_kk;
        document.getElementById("info_ktp").value = pegawai.no_ktp;
        document.getElementById("info_jamsostek").value = pegawai.no_jamsostek;
        document.getElementById("info_bpjsKesehatan").value = pegawai.no_bpjsKesehatan;
        document.getElementById("info_npwp").value = pegawai.no_npwp;
        document.getElementById("info_tgl_masuk").value = pegawai.tgl_masuk;
        document.getElementById("info_tgl_selesai").value = pegawai.tgl_selesai;
        document.getElementById("info_durasi_kontrak").value = pegawai.durasi_kontrak;
        document.getElementById("info_email").value = pegawai.email_pegawai;
        document.getElementById("info_ibu").value = pegawai.nama_ibu;
        document.getElementById("info_ayah").value = pegawai.nama_ayah;
        document.getElementById("info_pasangan").value = pegawai.nama_pasangan;
        document.getElementById("info_anak").value = pegawai.nama_anak;
      }
    });
  }

  function editData($id){
    $.ajax({
      url:"<?php echo site_url("pegawai/detailpegawai")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){

        const pegawai = hasil.pegawai;
        const user = hasil.user;
        
        document.getElementById("pegawai_id").value = pegawai.id_pegawai;
        document.getElementById("tgl_keluar").value = pegawai.tgl_keluar;
      }
    });
  }

  function deletePegawai($id){
    Swal.fire({
      title: "Apakah Kamu Yakin?",
      text: "Kamu yakin akan menghapus data ini?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus",
      cancelButtonText: "tidak"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url:"<?php echo site_url("pegawai/delete")?>/" + $id,
          dataType:"JSON",
          type: "get",
          success:function(hasil){
            Swal.fire({
              title: "Data dihapus!",
              text: "Data Pegawai Berhasil dihapus",
              icon: "success"
            });
          }
        });
      }
    });
	}
</script>