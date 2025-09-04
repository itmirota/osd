
<div class="row">
  <div class="d-flex justify-content-between mb-4">
    <a href="<?= base_url('Datapegawai')?>" class="btn btn-warning me-2"><i class="fa fa-arrow-left"></i> Kembali</a>
    <a href="<?= base_url('Datapegawai')?>" class="btn btn-success me-2"><i class="fa fa-download"></i> export</a>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data pegawai habis masa kontrak pada bulan <?= bulan($bulan) ?></h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama pegawai</th>
            <th>Usia</th>
            <th>Masa Kerja</th>
            <th>Dept. | Divisi</th>
            <th class="text-center">Tanggal Selesai</th>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
            {
            ?>
            <th class="text-center" width="10px">#</th>
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
            <td><a href="" data-bs-toggle="modal" data-bs-target="#detailPegawai" onclick="detailPegawai(<?= $data->id_pegawai?>)"><?= $data->nama_pegawai ?></a><hr class="m-0">
            <span style="font-size:12px">NIK: MRT<?= $data->nip ?></span></td>
            <td><?php
              $date1=date_create($data->tgl_lahir);
              $date2=date_create(DATE('Y-m-d'));
              $diff=date_diff($date1,$date2);
              echo $diff->format("%y th");
            ?></td>
            <td><?php
              $date1=date_create($data->tgl_masuk);
              $date2=date_create(DATE('Y-m-d'));
              $diff=date_diff($date1,$date2);
              echo $diff->format("%y th, %m bln");
            ?></td>
            <td><?= $data->nama_divisi ?></td>
            <td class="text-center"><?= isset($data->tgl_selesai) ? mediumdate_indo($data->tgl_selesai) : '-' ?></td>
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
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addNewKontrak" onclick="perpanjanganKontrak(<?= $data->id_pegawai?>)">Perpanjang Kontrak</a></li>
              </ul>
            </div>
            </td>
            <!-- <td class="text-center">
              <?php
              if($data->status_pegawai == "kontrak"){?>
              <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNewKontrak" onclick="perpanjanganKontrak(<?= $data->id_pegawai?>)"><i class="fa fa-plus" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="perpanjang"></i></button>
              <?php } ?>
              <button class="btn btn-sm btn-success " data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_pegawai?>)"><i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edit"></i></button>
              <button class="btn btn-sm btn-danger" onclick="deletePegawai(<?= $data->id_pegawai?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus"><i class="fa fa-trash"></i></button></td> -->
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

<!-- Modal Perpanjangan Kontrak-->
<div class="modal fade" id="addNewKontrak" tabindex="-1" aria-labelledby="addNewKontrak" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Perpanjangan Kontrak</h1>
      </div>
      <form action="<?=base_url('pegawai/perpanjangan_kontrak')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <table id="example1" class="table table-bordered table-striped mb-4">
            <thead>
            <tr>
              <th>Tanggal Perpanjangan</th>
              <th>Dibuat Oleh</th>
            </tr>
            </thead>
            <tbody id="list_perpanjang">
            </tbody>
          </table>
          <hr>
          <div class="mb-4 row">
            <label for="tgl_mulai" class="col-sm-4 col-form-label">Tanggal Kontrak</label>
            <div class="col-sm-8">
              <input type="hidden" name="id_pegawai" id="id_pegawai_kontrak" class="form-control tabel-PR"/>
              <input type="date" name="tgl_kontrak" id="tgl_selesai_kontrak" class="form-control tabel-PR"/>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="durasi_kontrak" class="col-sm-4 col-form-label">Durasi Kontrak</label>
            <div class="col-sm-8">
              <select name="durasi_kontrak" class="form-select tabel-PR">
                <option value="3"> 3 Bulan</option>
                <option value="6"> 6 Bulan</option>
                <option value="12"> 12 Bulan</option>
              </select>
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

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="<?=base_url('pegawai/update')?>" role="form" id="editRuangan" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-10">
                <label for="nip" class="form-label">Nomor Induk Pegawai</label>
                <input type="text" name="nip" id="nip" class="form-control-plaintext tabel-PR" readonly/>
              </div>
              <div class="col-md-10">
                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                <input type="text" name="nama_pegawai" id="nama_pegawai" placeholder="tulis nama pegawai disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="jabatan_id" class="form-label">Jabatan</label>
                <select name="jabatan_id" id="jabatan_id" class="form-select tabel-PR">
                  <?php foreach($jabatan as $j): ?>
                  <option value="<?= $j->id_jabatan?>"><?=$j->nama_jabatan?></option>
                  <?php endforeach; ?>
                </select>
              </div> 
              <div class="col-md-10">
                <label for="divisi_id" class="form-label">Departement</label>
                <select name="divisi_id" id="divisi_id" class="form-select tabel-PR">
                  <?php foreach($divisi as $d): ?>
                  <option value="<?= $d->id_divisi?>"><?=$d->nama_divisi?></option>
                  <?php endforeach; ?>
                </select>
              </div>  
              <div class="col-md-10">
                <label for="status_pegawai" class="form-label">Status Kerja</label>
                <select name="status_pegawai"  id="status_pegawai" class="form-select tabel-PR">
                  <option value="tetap"> PKWTT</option>
                  <option value="kontrak"> PKWT</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="kuota_cuti" class="form-label">Kuota Cuti</label>
                <input type="text" name="kuota_cuti" id="kuota_cuti" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tabel-PR"/>
              </div> 
              <div class="col-md-10">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select tabel-PR" required>
                  <option value="L"> Laki - laki</option>
                  <option value="P"> Perempuan</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" placeholder="tulis pendidikan terakhir disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" placeholder="tulis jurusan disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="golongan_darah" class="form-label">Golongan Darah</label>
                <select name="golongan_darah" id="golongan_darah"  class="form-select tabel-PR">
                  <option value="A"> A</option>
                  <option value="B"> B</option>
                  <option value="AB"> AB</option>
                  <option value="O"> O</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="agama" class="form-label">Agama</label>
                <input type="text" name="agama" id="agama" placeholder="tulis agama disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="Alamat_ktp" class="form-label">Alamat KTP</label>
                <textarea name="alamat_ktp" id="alamat_ktp" placeholder="tulis alamat sesuai ktp disini" class="form-control tabel-PR" rows="3"></textarea>
              </div>
              <div class="col-md-10">
                <label for="alamat_domisili" class="form-label">Alamat Domisili</label>
                <textarea name="alamat_domisili" id="alamat_domisili" placeholder="tulis alamat domisili disini" class="form-control tabel-PR" rows="3"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-10">
                <label for="kontak" class="form-label">Kontak yang bisa dihibungi</label>
                <input type="text" name="kontak_pegawai" id="kontak" placeholder="tulis kontak disini" class="form-control tabel-PR"/>
              </div> 
              <div class="col-md-10">
                <label for="no_kk" class="form-label">Nomor KK</label>
                <input type="text" name="no_kk" id="no_kk" placeholder="tulis nomor KK disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="no_ktp" class="form-label">Nomor KTP</label>
                <input type="text" name="no_ktp" id="no_ktp" placeholder="tulis nomor KTP disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="no_jamsostek" class="form-label">Nomor Jamsostek</label>
                <input type="text" name="no_jamsostek" id="no_jamsostek" placeholder="tulis nomor Jamsostek disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="no_bpjsKesehatan" class="form-label">Nomor Bpjs Kesehatan</label>
                <input type="text" name="no_bpjsKesehatan" id="no_bpjsKesehatan" placeholder="tulis nomor BPJS disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="no_npwp" class="form-label">Nomor NPWP</label>
                <input type="text" name="no_npwp" id="no_npwp" placeholder="tulis NPWP disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control tabel-PR"/>
              </div> 
              <div class="col-md-10">
                <label for="tgl_masuk" class="form-label">Tanggal Selesai Kontrak</label>
                <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control tabel-PR"/>
              </div> 
              <div class="col-md-10">
                <label for="durasi_kontrak" class="form-label">Durasi Kerja</label>
                <select name="durasi_kontrak" id="lama_kontrak" class="form-select tabel-PR">
                  <option value="0"> karyawan tetap</option>
                  <option value="3"> 3 Bulan</option>
                  <option value="6"> 6 Bulan</option>
                  <option value="12"> 12 Bulan</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email_pegawai" id="email_pegawai" placeholder="tulis Email disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" id="nama_ibu" placeholder="tulis nama ibu disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="nama_ayah" class="form-label">Nama ayah</label>
                <input type="text" name="nama_ayah" id="nama_ayah" placeholder="tulis nama ayah disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                <select name="status_pernikahan" id="status_pernikahan" class="form-select tabel-PR">
                  <option value="lajang"> Belum Menikah</option>
                  <option value="menikah"> Menikah</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="nama_pasangan" class="form-label">Nama Pasangan</label>
                <input type="text" name="nama_pasangan" id="nama_pasangan" placeholder="tulis nama pasangan disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="nama_anak" class="form-label">Nama Anak</label>
                <textarea name="nama_anak" id="nama_anak" placeholder="tulis nama anak disini" class="form-control tabel-PR"></textarea>
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

<!-- Modal Edit-->
<div class="modal fade" id="editAkun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="<?=base_url('User/editUser')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Akun</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <h1 class="modal-title fs-5" id="titleAddPegawai">Informasi akun</h1>
              <div class="col-md-10">
                <label for="username" class="form-label">Username</label>
                <input type="hidden" name="userId" id="userId"  class="form-control tabel-PR"/>
                <input type="text" name="username" id="username" placeholder="tulis username disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="password" class="form-label">Ganti Password</label>
                <input type="text" name="password" placeholder="Ganti Password" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role_id" class="form-select tabel-PR">
                  <?php foreach($list_role as $r): ?>
                  <option value="<?= $r->roleId?>"><?=$r->role?></option>
                  <?php endforeach; ?>
                </select>
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
                <input type="text" id="info_alamat_ktp" readonly class="form-control-plaintext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="info_alamat_domisili" class="col-sm-4 col-form-label">Alamat domisili</label>
              <div class="col-sm-8">
                <input type="text" id="info_alamat_domisili" readonly class="form-control-plaintext">
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
              <label for="info_anak" class="col-sm-4 col-form-label">Nama anak</label>
              <div class="col-sm-8">
                <textarea id="info_anak" readonly class="form-control-plaintext"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
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
              <label for="id_pegawai" class="form-label">Nama Pegawai</label>
              <select name="id_pegawai" class="form-select tabel-PR" required>
                <option>----- pilih pegawai ---</option>
                <?php foreach($list_data as $ld): ?>
                <option value="<?= $ld->id_pegawai?>"><?=$ld->nip?> | <?=$ld->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-10">
              <label for="tgl_selesai" class="col-sm-4 col-form-label">Tanggal Berakhir</label>
              <input type="date" name="tgl_selesai" class="form-control"> 
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

<script>
    function perpanjanganKontrak($id){
    $.ajax({
      url:"<?php echo site_url("pegawai/detailpegawai")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){

        const kontrak = hasil.kontrak;

        console.log(kontrak);
        let html = '';
        let i;
        for ( i=0; i < kontrak.length ; i++){
          html +=
            '<tr>'+
            '<td>'+kontrak[i].tgl_kontrak+'</td>'+
            '<td>'+kontrak[i].nama_pembuat+'</td>'+
            '</tr>';
        }

        $("#list_perpanjang").html(html);

        const pegawai = hasil.pegawai;
        document.getElementById("id_pegawai_kontrak").value = $id;
        document.getElementById("tgl_selesai_kontrak").value = pegawai.tgl_selesai;
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

        document.getElementById("nip").value = pegawai.nip;
        document.getElementById("nama_pegawai").value = pegawai.nama_pegawai;
        document.getElementById("jabatan_id").value = pegawai.jabatan_id;
        document.getElementById("divisi_id").value = pegawai.bagian_id;
        document.getElementById("status_pegawai").value = pegawai.status_pegawai;
        document.getElementById("kuota_cuti").value = pegawai.kuota_cuti;
        document.getElementById("tempat_lahir").value = pegawai.tempat_lahir;
        document.getElementById("tgl_lahir").value = pegawai.tgl_lahir;
        document.getElementById("jenis_kelamin").value = pegawai.jenis_kelamin;
        document.getElementById("pendidikan_terakhir").value = pegawai.pendidikan_terakhir;
        document.getElementById("jurusan").value = pegawai.jurusan;
        document.getElementById("golongan_darah").value = pegawai.golongan_darah;
        document.getElementById("agama").value = pegawai.agama;
        document.getElementById("alamat_ktp").value = pegawai.alamat_ktp;
        document.getElementById("alamat_domisili").value = pegawai.alamat_domisili;
        document.getElementById("kontak").value = pegawai.kontak_pegawai;
        document.getElementById("no_kk").value = pegawai.no_kk;
        document.getElementById("no_ktp").value = pegawai.no_ktp;
        document.getElementById("no_jamsostek").value = pegawai.no_jamsostek;
        document.getElementById("no_bpjsKesehatan").value = pegawai.no_bpjsKesehatan;
        document.getElementById("no_npwp").value = pegawai.no_npwp;
        document.getElementById("tgl_masuk").value = pegawai.tgl_masuk;
        document.getElementById("tgl_selesai").value = pegawai.tgl_selesai;
        document.getElementById("lama_kontrak").value = pegawai.durasi_kontrak;
        document.getElementById("email_pegawai").value = pegawai.email_pegawai;
        document.getElementById("status_pernikahan").value = pegawai.status_pernikahan;
        document.getElementById("nama_ibu").value = pegawai.nama_ibu;
        document.getElementById("nama_ayah").value = pegawai.nama_ayah;
        document.getElementById("nama_pasangan").value = pegawai.nama_pasangan;
        document.getElementById("nama_anak").value = pegawai.nama_anak;
      }
    });
  }

  function editAkun($id){
    $.ajax({
      url:"<?php echo site_url("pegawai/detailpegawai")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const user = hasil.user;

        document.getElementById("userId").value = user.userId;
        document.getElementById("username").value = user.username;
        document.getElementById("role_id").value = user.roleId;
      }
    });
  }

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

      $("#divisi").html(html);
    }
  });
}
</script>
