<div class="row">
  <?php if($this->uri->segment(1) != 'pegawai'){?>
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addPegawai"><i class="fa fa-plus"></i> Tambah Data</button>
    <a href="<?= base_url('pegawai/excel_pegawai')?>" class="btn btn-primary me-2"><i class="fa fa-download"></i> Export Karyawan</a>
    <?php if($role == ROLE_SUPERADMIN){?>
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#importCsv"><i class="fa fa-file"></i> Import CSV</button>
    <button class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#updateCsv"><i class="fa fa-file"></i> Update from CSV</button>
    <div class="form-group">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#exportUser">
        <i class="fa fa-download"></i> Export User
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exportUser" tabindex="-1" aria-labelledby="filterAbsenTokoLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('user/excel_user')?>" role="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="mb-3">
                <label for="divisi" class="form-label">Departement</label>
                <select class="form-select" id="departement" onchange="getDivisiByDept()" required>
                  <option>--- pilih departement ---</option>
                  <?php foreach($departement as $data){?>
                  <option value=<?= $data->id_departement ?>><?= $data->nama_departement ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="divisi" class="form-label">Divisi</label>
                <select id="divisi" name="divisi" class="form-select" required>
                </select>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Input</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>

  <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA | $role == ROLE_HRBP){?>
  <div class="col-md-12">
    <div class="alert alert-warning" role="alert">
    <h3> Informasi !!!</h3>
    <?php foreach ($mendekati_habis_kontrak as $key) { ?>
      <a style="color:black" href="<?= base_url('pegawai/listMasaKontrak/'.$key->bulan) ?>"><strong><?= $key->pegawai ?> Karyawan</strong> akan habis kontrak pada bulan <strong><?= bulan($key->bulan) ?></strong></a><br>
    <?php } ?>
    </div>
  </div>
  <?php } ?>
  <?php }else{ ?>
    <a href="<?= base_url('bagian/'.$bagian_id)?>" class="mb-4"><i class="fa fa-solid fa-angles-left"></i> kembali</a>
  <?php } ?>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Karyawan</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <?php if($this->uri->segment(1) != 'pegawai'){?>
        <?php if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA){?>
          <div class="flex-fill pegawai-aktif">
            <div class="mb-1 row">
              <label for="no_polisi" class="col-sm-4 col-form-label">Karyawan aktif</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_aktif->total_pegawai?> Orang">
              </div>
            </div>
            <div class="mb-1 row">
              <label for="inputPassword" class="col-sm-4 col-form-label">Laki-Laki</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_aktif->laki?> Orang">
              </div>
            </div>
            <div class="mb-1 row">
              <label for="no_polisi" class="col-sm-4 col-form-label">Perempuan</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" value=": <?= $total_pegawai_aktif->perempuan?> Orang">
              </div>
            </div>
          </div>
        <hr>
        <?php }?>
        <?php } ?>
        <table id="dataTableScrollX" class="table table-hover">
          <thead>
          <tr>
            <th width="3vh">No</th>
            <th width="20vh">Nama Karyawan</th>
            <th width="40px">Usia</th>
            <th class="text-center">Masa Kerja</th>
            <th>Status</th>
            <th class="text-end" width="8vh">Durasi Kontrak</th>
            <th class="text-end" width="8vh">Kuota Cuti</th>
            <th class="text-end" width="12vh">Sisa Cuti Tahun Lalu</th>
            <th class="text-end" width="10vh">Surat Peringatan</th>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
            {
            ?>
            <?php if($this->uri->segment(1) != 'pegawai'){?>
            <th class="text-center" width="10px">#</th>
            <?php } ?>
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
              <span style="font-size:12px">NIK: MRT<?= $data->nip ?></span><br>
              <span style="font-size:12px">AREA: <?= $data->nama_areakerja ?></span>
            </td>
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
            <td><span class="badge <?= ($data->status_pegawai == "tetap" ? 'bg-primary':'bg-info')?>"><?=  ($data->status_pegawai == "tetap" ? 'PKWTT':'PKWT') ?></span></td>
            <td class="text-center"><?= $data->status_pegawai == "tetap" ? '-': $data->durasi_kontrak.' bulan' ?></td>
            <td  class="text-center"><?= $data->kuota_cuti ?></td>
            <td  class="text-center"><?= $data->sisa_cuti ?></td>
            <td  class="text-center">
            <?php switch ($data->tingkat_peringatan) {
              case 3 : ?>
                <span class="badge bg-danger">SP <?= $data->tingkat_peringatan ?></span>
            <?php break; ?>

            <?php case 2 : ?>
              <span class="badge bg-warning">SP <?= $data->tingkat_peringatan ?></span>
            <?php break; ?>

            <?php case 1 : ?>
              <span class="badge bg-success">SP <?= $data->tingkat_peringatan ?></span>
            <?php break; ?>
              
            <?php default: ?>
                -
            <?php break; ?>
            <?php } ?>
            </td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
            {
            ?>
            <?php if($this->uri->segment(1) != 'pegawai'){?>
            <td class="text-center">
            <div class="btn-group">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
              </a>

              <ul class="dropdown-menu">
                <?php if($data->status_pegawai == "kontrak"){?>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addNewKontrak" onclick="perpanjanganKontrak(<?= $data->id_pegawai?>)">Perpanjang Kontrak</a></li>
                <?php } ?>
                <li><a class="dropdown-item suratPeringatan" href="#" data-bs-toggle="modal" data-bs-target="#addNewWarningLetter" onclick="suratPeringatan(<?= $data->id_pegawai?>)">Surat Peringatan</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_pegawai?>)">Edit Data</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editAkun" onclick="editAkun(<?= $data->id_pegawai?>)">Edit Akun</a></li>
                <li><a class="dropdown-item" href="#"  onclick="deletePegawai(<?= $data->id_pegawai?>)">Hapus Data</a></li>
              </ul>
            </div>
            </td>
            <?php }?>
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

<!-- Modal Surat Peringatan-->
<div class="modal fade" id="addNewWarningLetter" tabindex="-1" aria-labelledby="addNewKontrak" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4">Surat Peringatan</h1>
      </div>
      <form action="<?=base_url('pegawai/add_peringatan')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <h1 class="fs-5 mb-2">Histori Surat Peringatan</h1>
          <table id="example1" class="table table-bordered table-striped mb-4">
            <thead>
            <tr>
              <th>Tanggal Surat Peringatan</th>
              <th>Surat Peringatan</th>
            </tr>
            </thead>
            <tbody id="list_peringatan">
            </tbody>
          </table>
          <hr>
          <div class="mb-4 row">
            <label for="tgl_surat_peringatan" class="col-sm-4 col-form-label">Tanggal Surat Peringatan</label>
            <div class="col-sm-8">
              <input type="hidden" name="id_pegawai" id="id_pegawai_sp" class="form-control tabel-PR"/>
              <input type="date" name="tgl_surat_peringatan" id="tgl_surat_peringatan" class="form-control tabel-PR"/>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="tingkat_peringatan" class="col-sm-4 col-form-label">Surat Peringatan Ke</label>
            <div class="col-sm-8">
              <select name="tingkat_peringatan" class="form-select tabel-PR">
                <option value="1"> Peringatan pertama</option>
                <option value="2"> Peringatan kedua</option>
                <option value="3"> Peringatan ketiga</option>
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

<!-- Modal Import Excel-->
<div class="modal fade" id="importCsv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('pegawai/spreadsheet_import')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Import CSV File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <label for="nip" class="form-label">File :</label>
          <input type="file" name="upload_file" id="upload_file" class="form-control">
        </div>
        <div class="d-flex justify-content-between mt-4">
          <div class="p-2">
            <a href="<?=base_url('pegawai/format_excel')?>" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i> unduh template</a>
          </div>
          <div class="p-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Update Excel-->
<div class="modal fade" id="updateCsv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('pegawai/spreadsheet_update_import')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Update CSV File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <label for="nip" class="form-label">File :</label>
          <input type="file" name="upload_file" id="upload_file" class="form-control">
        </div>
        <div class="d-flex justify-content-between mt-4">
          <div class="p-2">
            <a href="<?=base_url('pegawai/format_excel')?>" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i> unduh template</a>
          </div>
          <div class="p-2">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Add pegawai-->
<div class="modal fade" id="addPegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="<?=base_url('pegawai/save')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Informasi Karyawan</h1>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-8">
                <label for="nip" class="form-label">Nomor Induk Karyawan</label>
                <input type="text" name="nip" value="<?= sprintf("%04s", $maxNIP+1) ?>" class="form-control-plaintext tabel-PR" readonly/>
              </div>
              <div class="col-md-10">
                <label for="nama_pegawai" class="form-label">Nama Karyawan</label>
                <input type="text" name="nama_pegawai" placeholder="tulis nama karyawan disini" class="form-control tabel-PR" required/>
              </div>
              <div class="col-md-10">
                <label for="jabatan_id" class="form-label">Jabatan</label>
                <select name="jabatan_id" class="form-select tabel-PR" required>
                  <option>----- pilih jabatan ---</option>
                  <?php foreach($jabatan as $j): ?>
                  <option value="<?= $j->id_jabatan?>"><?=$j->nama_jabatan?></option>
                  <?php endforeach; ?>
                </select>
              </div> 
              <div class="col-md-10">
                <label for="departement_add" class="form-label">Departement</label>
                <select class="form-select tabel-PR" id="departement_add" onchange="getDivisiByDept()">
                  <option>----- pilih Departement ---</option>
                  <?php foreach($departement as $d): ?>
                  <option value="<?= $d->id_departement?>"><?=$d->nama_departement?></option>
                  <?php endforeach; ?>
                </select>
              </div>  
              <div class="col-md-10">
                <label for="divisi_add" class="form-label">Divisi</label>
                <select id="divisi_add" class="form-select tabel-PR" onchange="getBagianByDiv()">
                </select>
              </div>  
              <div class="col-md-10">
                <label for="bagian_id" class="form-label">Bagian</label>
                <select name="bagian_id" class="form-select tabel-PR">
                </select>
              </div>
              <div class="col-md-10">
                <label for="areakerja" class="form-label">Are Kerja</label>
                <select class="form-select tabel-PR" id="areakerja_id">
                  <option>----- pilih Area Kerja ---</option>
                  <?php foreach($areakerja as $a): ?>
                  <option value="<?= $a->id_areakerja?>"><?=$a->nama_areakerja?></option>
                  <?php endforeach; ?>
                </select>
              </div>  
              <div class="col-md-10">
                <label for="status_pegawai" class="form-label">Status Kerja</label>
                <select name="status_pegawai"  id="AddStatus" class="form-select tabel-PR" required>
                  <option>----- pilih status ---</option>
                  <option value="tetap"> PKWTT</option>
                  <option value="kontrak"> PKWT</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" placeholder="tulis tempat lahir disini" class="form-control tabel-PR" required />
              </div> 
              <div class="col-md-10">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control tabel-PR" required />
              </div>
              <div class="col-md-10">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select tabel-PR" required>
                  <option>----- pilih jenis kelamin ---</option>
                  <option value="L"> Laki - laki</option>
                  <option value="P"> Perempuan</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan_terakhir" placeholder="tulis pendidikan terakhir disini" class="form-control tabel-PR" required />
              </div>
              <div class="col-md-10">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" name="jurusan" placeholder="tulis jurusan disini" class="form-control tabel-PR" />
              </div>
              <div class="col-md-10">
                <label for="golongan_darah" class="form-label">Golongan Darah</label>
                <select name="golongan_darah" class="form-select tabel-PR" required>
                  <option>----- pilih golongan darah ---</option>
                  <option value="A"> A</option>
                  <option value="B"> B</option>
                  <option value="AB"> AB</option>
                  <option value="O"> O</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="agama" class="form-label">Agama</label>
                <input type="text" name="agama" placeholder="tulis agama disini" class="form-control tabel-PR" required />
              </div>
              <hr>
              <div class="row">
                <label for="Alamat_ktp" class="form-label">Alamat KTP</label>
              </div>
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-6">
                    <label for="provinsiktp_id" class="form-label">Provinsi</label>
                    <select name="provinsiktp_id" id="provinsiktp_id" onchange="Kabupatenktp()" class="form-select tabel-PR" required>
                      <option>----- pilih Provinsi ---</option>
                      <?php foreach($provinsi as $p): ?>
                      <option value="<?= $p->id?>"><?=$p->name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div> 
                  <div class="col-md-6">
                    <label for="kabupatenktp_id" class="form-label">Kabupaten</label>
                    <select name="kabupatenktp_id" id="kabupatenktp_id" onchange="Kecamatanktp()" class="form-select tabel-PR" required>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="kecamatanktp_id" class="form-label">Kecamatan</label>
                    <select name="kecamatanktp_id" id="kecamatanktp_id" onchange="Kelurahanktp()" class="form-select tabel-PR" required>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="kelurahanktp_id" class="form-label">Kelurahan</label>
                    <select name="kelurahanktp_id" id="kelurahanktp_id" class="form-select tabel-PR" required>
                    </select>
                  </div> 
                </div>
              </div>
              <div class="col-md-5">
                <label for="kodepos_ktp" class="form-label">Kodepos</label>
                <input type="text" name="kodepos_ktp" placeholder="tulis kodepos disini" class="form-control tabel-PR" required />
              </div>
              <div class="col-md-10">
                <label for="Alamat_ktp" class="form-label">Alamat Detail</label>
                <textarea name="alamat_ktp" placeholder="tulis alamat sesuai ktp disini" class="form-control tabel-PR" required rows="3"></textarea>
              </div>
              <hr>
              <div class="row">
                <label for="Alamat_domisili" class="form-label">Alamat domisili</label>
              </div>
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-6">
                    <label for="provinsidomisili_id" class="form-label">Provinsi</label>
                    <select name="provinsidomisili_id" id="provinsidomisili_id" onchange="Kabupatendomisili()" class="form-select tabel-PR" required>
                      <option>----- pilih Provinsi ---</option>
                      <?php foreach($provinsi as $p): ?>
                      <option value="<?= $p->id?>"><?=$p->name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div> 
                  <div class="col-md-6">
                    <label for="kabupatendomisili_id" class="form-label">Kabupaten</label>
                    <select name="kabupatendomisili_id" id="kabupatendomisili_id" onchange="Kecamatandomisili()" class="form-select tabel-PR" required>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="kecamatandomisili_id" class="form-label">Kecamatan</label>
                    <select name="kecamatandomisili_id" id="kecamatandomisili_id" onchange="Kelurahandomisili()" class="form-select tabel-PR" required>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="kelurahandomisili_id" class="form-label">Kelurahan</label>
                    <select name="kelurahandomisili_id" id="kelurahandomisili_id" class="form-select tabel-PR" required>
                    </select>
                  </div> 
                </div>
              </div>
              <div class="col-md-5">
                <label for="kodepos_domisili" class="form-label">Kodepos</label>
                <input type="text" name="kodepos_domisili" placeholder="tulis kodepos disini" class="form-control tabel-PR" required />
              </div>
              <div class="col-md-10">
                <label for="Alamat_domisili" class="form-label">Alamat Detail</label>
                <textarea name="alamat_domisili" placeholder="tulis alamat sesuai domisili disini" class="form-control tabel-PR" required rows="3"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-10">
                <label for="kontak_pegawai" class="form-label">Kontak yang bisa dihibungi</label>
                <input type="text" name="kontak_pegawai" placeholder="tulis kontak disini" class="form-control tabel-PR" required />
              </div> 
              <div class="col-md-10">
                <label for="no_kk" class="form-label">Nomor KK</label>
                <input type="text" name="no_kk" placeholder="tulis nomor KK disini" class="form-control tabel-PR" />
              </div>
              <div class="col-md-10">
                <label for="no_ktp" class="form-label">Nomor KTP</label>
                <input type="text" name="no_ktp" placeholder="tulis nomor KTP disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="no_jamsostek" class="form-label">Nomor Bpjs Kesehatan</label>
                <input type="text" name="no_jamsostek" placeholder="tulis nomor Jamsostek disini" class="form-control tabel-PR" />
              </div>
              <div class="col-md-10">
                <label for="no_npwp" class="form-label">Nomor NPWP</label>
                <input type="text" name="no_npwp" placeholder="tulis Nomor NPWP disini" class="form-control tabel-PR"/>
              </div>
              <div class="col-md-10">
                <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" name="tgl_masuk" class="form-control tabel-PR" required/>
              </div> 
              <div class="col-md-10" id="durasi_kontrak">
                <label for="durasi_kontrak" class="form-label">Durasi Kerja</label>
                <select name="durasi_kontrak" class="form-select tabel-PR" required>
                  <option>----- pilih durasi ---</option>
                  <option value="3"> 3 Bulan</option>
                  <option value="6"> 6 Bulan</option>
                  <option value="12"> 12 Bulan</option>
                </select>
              </div>
              <div class="col-md-10">
                <label for="email_pegawai" class="form-label">Email</label>
                <input type="email" name="email_pegawai" placeholder="tulis Email disini" class="form-control tabel-PR" required/>
              </div>
              <hr>
              <div class="col-md-10">
              <label for="nama_ibu" class="form-label">Informasi Keluarga</label>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="nama_ibu" class="form-label">Nama Ibu</label>
                  <input type="text" name="nama_ibu" placeholder="tulis nama ibu disini" class="form-control tabel-PR"/>
                </div>
                <div class="col-md-5">
                  <label for="nama_ayah" class="form-label">Nama Ayah</label>
                  <input type="text" name="nama_ayah" placeholder="tulis nama ayah disini" class="form-control tabel-PR"/>
                </div>
              </div>
              <div class="col-md-10">
                <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                <select name="status_pernikahan" class="form-select tabel-PR" required>
                  <option>----- pilih status ---</option>
                  <option value="lajang"> Belum Menikah</option>
                  <option value="menikah"> Menikah</option>
                </select>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="nama_pasangan" class="form-label">Nama Pasangan</label>
                  <input type="text" name="nama_pasangan" placeholder="tulis nama pasangan disini" class="form-control tabel-PR" />
                </div>
                <div class="col-md-5">
                  <label for="kontak_pasangan" class="form-label">No. HP</label>
                  <input type="text" name="kontak_pasangan" placeholder="tulis No. HP pasangan disini" class="form-control tabel-PR" />
                </div>
              </div>
              <div class="col-md-10">
                <label for="nama_anak" class="form-label">Nama Anak</label>
                <textarea name="nama_anak" placeholder="tulis nama anak disini" class="form-control tabel-PR"></textarea>
              </div>
              <hr>
              <div class="col-md-10">
                <label for="nama_kontakdarurat1" class="form-label">Kontak Darurat</label>
              </div>
              <div class="col-md-10">
                <label for="nama_kontakdarurat1" class="form-label">Nama Kontak Darurat 1</label>
                <input type="text" name="nama_kontakdarurat1" placeholder="tulis nama pasangan disini" class="form-control tabel-PR" />
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="no_hpdarurat1" class="form-label">No. HP 1</label>
                  <input type="text" name="no_hpdarurat1" placeholder="tulis nama pasangan disini" class="form-control tabel-PR" />
                </div>
                <div class="col-md-5">
                  <label for="hubungan_darurat1" class="form-label">Hubungan Kontak Darurat 1</label>
                  <input type="text" name="hubungan_darurat1" placeholder="tulis No. HP pasangan disini" class="form-control tabel-PR" />
                </div>
              </div>
              <div class="col-md-10">
                <label for="nama_kontakdarurat2" class="form-label">Nama Kontak Darurat 2</label>
                <input type="text" name="nama_kontakdarurat2" placeholder="tulis nama pasangan disini" class="form-control tabel-PR" />
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="no_hpdarurat2" class="form-label">No. HP 2</label>
                  <input type="text" name="no_hpdarurat2" placeholder="tulis nama pasangan disini" class="form-control tabel-PR" />
                </div>
                <div class="col-md-5">
                  <label for="hubungan_darurat2" class="form-label">Hubungan Kontak Darurat 2</label>
                  <input type="text" name="hubungan_darurat2" placeholder="tulis No. HP pasangan disini" class="form-control tabel-PR" />
                </div>
              </div>
              <hr>
              <h1 class="modal-title fs-5" id="titleAddPegawai">Informasi akun</h1>
              <div class="col-md-10">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" placeholder="tulis username disini" class="form-control tabel-PR" required/>
              </div>
              <div class="col-md-10">
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" placeholder="tulis password disini" class="form-control tabel-PR" required/>
              </div>
              <div class="col-md-10">
                <label for="role_id" class="form-label">Role</label>
                <select name="role_id" class="form-select tabel-PR" required>
                  <option>----- pilih Role ---</option>
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
                <label for="nip" class="form-label">Nomor Induk Karyawan</label>
                <input type="text" name="nip" id="nip" class="form-control-plaintext tabel-PR" readonly/>
              </div>
              <div class="col-md-10">
                <label for="nama_pegawai" class="form-label">Nama Karyawan</label>
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
                <label for="departement_id" class="form-label">Departement</label>
                <select name="departement_id" id="departement_id" class="form-select tabel-PR">
                  <?php foreach($departement as $d): ?>
                  <option value="<?= $d->id_departement?>"><?=$d->nama_departement?></option>
                  <?php endforeach; ?>
                </select>
              </div>  
              <div class="col-md-10">
                <label for="divisi_id" class="form-label">Divisi</label>
                <select name="divisi_id" id="divisi_id" class="form-select tabel-PR">
                  <?php foreach($divisi as $d): ?>
                  <option value="<?= $d->id_divisi?>"><?=$d->nama_divisi?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-10">
                <label for="bagian_id" class="form-label">Bagian</label>
                <select name="bagian_id" id="bagian_id" class="form-select tabel-PR">
                  <?php foreach($bagian as $d): ?>
                  <option value="<?= $d->id_bagian?>"><?=$d->nama_bagian?></option>
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
              <div class="row">
                <label for="Alamat_ktp" class="form-label">Alamat KTP</label>
              </div>
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-6">
                    <label for="provinsiktp_id" class="form-label">Provinsi</label>
                    <select name="provinsiktp_id" id="provinsiktp_edit_id" onchange="Kabupatenktp_edit()" class="form-select tabel-PR">
                      <option>----- pilih Provinsi ---</option>
                      <?php foreach($provinsi as $p): ?>
                      <option value="<?= $p->id?>"><?=$p->name?></option>
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
                <textarea name="alamat_ktp" id="alamat_ktp" placeholder="tulis alamat sesuai ktp disini" class="form-control tabel-PR" required rows="3"></textarea>
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
                    <select name="kecamatandomisili_id" id="kecamatandomisili_edit_id" onchange="Kelurahandomisili_edit()" class="form-select tabel-PR">
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
                <textarea name="alamat_domisili" id="alamat_domisili" placeholder="tulis alamat sesuai domisili disini" class="form-control tabel-PR" rows="3"></textarea>
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
                <label for="no_jamsostek" class="form-label">Nomor Bpjs Kesehatan</label>
                <input type="text" name="no_jamsostek" id="no_jamsostek" placeholder="tulis nomor Jamsostek disini" class="form-control tabel-PR"/>
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
              <div class="row">
                <div class="col-md-5">
                  <label for="nama_pasangan" class="form-label">Nama Pasangan</label>
                  <input type="text" name="nama_pasangan" id="nama_pasangan" class="form-control tabel-PR" />
                </div>
                <div class="col-md-5">
                  <label for="kontak_pasangan" class="form-label">No. HP</label>
                  <input type="text" name="kontak_pasangan" id="kontak_pasangan" class="form-control tabel-PR" />
                </div>
              </div>
              <div class="col-md-10">
                <label for="nama_anak" class="form-label">Nama Anak</label>
                <textarea name="nama_anak" id="nama_anak" class="form-control tabel-PR"></textarea>
              </div>
              <div class="col-md-10">
                <h3><strong>Kontak Darurat</strong></h3>
              </div>
              <hr>
              <div class="col-md-10">
                <label for="nama_kontakdarurat1" class="form-label">Nama Kontak Darurat 1</label>
                <input type="text" id="nama_kontakdarurat1" readonly class="form-control" />
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="no_hpdarurat1" class="form-label">No. HP 1</label>
                  <input type="text" id="no_kontakdarurat1" class="form-control" />
                </div>
                <div class="col-md-5">
                  <label for="hubungan_darurat1" class="form-label">Hubungan Kontak Darurat 1</label>
                  <input type="text" id="hubungan_kontakdarurat1" class="form-control" />
                </div>
              </div>
              <div class="col-md-10">
                <label for="nama_kontakdarurat1" class="form-label">Nama Kontak Darurat 2</label>
                <input type="text" id="nama_kontakdarurat2" class="form-control" />
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="no_hpdarurat1" class="form-label">No. HP 2</label>
                  <input type="text" id="no_kontakdarurat2" class="form-control" />
                </div>
                <div class="col-md-5">
                  <label for="hubungan_darurat1" class="form-label">Hubungan Kontak Darurat 2</label>
                  <input type="text" id="hubungan_kontakdarurat2" class="form-control" />
                </div>
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
              <div class="col-md-10">
                <h3><strong>Kontak Darurat</strong></h3>
              </div>
              <hr>
              <div class="col-md-10">
                <label for="nama_kontakdarurat1" class="form-label">Nama Kontak Darurat 1</label>
                <input type="text" id="info_nama_kontakdarurat1" readonly class="form-control-plaintext" />
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="no_hpdarurat1" class="form-label">No. HP 1</label>
                  <input type="text" id="info_no_kontakdarurat1" readonly class="form-control-plaintext" />
                </div>
                <div class="col-md-5">
                  <label for="hubungan_darurat1" class="form-label">Hubungan Kontak Darurat 1</label>
                  <input type="text" id="info_hubungan_kontakdarurat1" readonly class="form-control-plaintext" />
                </div>
              </div>
              <div class="col-md-10">
                <label for="nama_kontakdarurat1" class="form-label">Nama Kontak Darurat 2</label>
                <input type="text" id="info_nama_kontakdarurat2" readonly class="form-control-plaintext" />
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label for="no_hpdarurat1" class="form-label">No. HP 2</label>
                  <input type="text" id="info_no_kontakdarurat2" readonly class="form-control-plaintext" />
                </div>
                <div class="col-md-5">
                  <label for="hubungan_darurat1" class="form-label">Hubungan Kontak Darurat 2</label>
                  <input type="text" id="info_hubungan_kontakdarurat2" readonly class="form-control-plaintext" />
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
        <h1 class="modal-title fs-5" id="titleAddPegawai">Karyawan Non Aktif</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-10">
              <label for="id_pegawai" class="form-label">Nama Karyawan</label>
              <select name="id_pegawai" class="form-select tabel-PR" required>
                <option>----- pilih Karyawan ---</option>
                <?php foreach($list_data as $ld): ?>
                <option value="<?= $ld->id_pegawai?>"><?=$ld->nip?> | <?=$ld->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-10">
              <label for="tgl_selesai" class="col-sm-4 col-form-label">Tanggal Berakhir</label>
              <input type="date" name="tgl_selesai" class="form-control"> 
            </div>
            <div class="col-md-10">
              <label for="alasan" class="col-sm-4 col-form-label">Alasan</label>
              <input type="text" name="alasan" class="form-control"> 
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

  function suratPeringatan($id){
    const id_pegawai = document.getElementById("id_pegawai_sp").value = $id;

    $.ajax({
      url:"<?php echo site_url("pegawai/listSuratPeringatan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){

        const peringatan = hasil;

        console.log(hasil);
        let html = '';
        let i;
        for ( i=0; i < hasil.length ; i++){
          html +=
            '<tr>'+
            '<td>'+hasil[i].datecreated+'</td>'+
            '<td> Peringatan Ke '+hasil[i].tingkat_peringatan+'</td>'+
            '</tr>';
        }

        $("#list_peringatan").html(html);
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
        document.getElementById("departement_id").value = pegawai.departement_id;
        document.getElementById("divisi_id").value = pegawai.divisi_id;
        document.getElementById("bagian_id").value = pegawai.bagian_id;
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
        document.getElementById("nama_kontakdarurat1").value = pegawai.nama_kontakdarurat1;
        document.getElementById("no_kontakdarurat1").value = pegawai.no_hpdarurat1;
        document.getElementById("hubungan_kontakdarurat2").value = pegawai.hubungan_darurat2;
        document.getElementById("nama_kontakdarurat2").value = pegawai.nama_kontakdarurat2;
        document.getElementById("no_kontakdarurat2").value = pegawai.no_hpdarurat2;
        document.getElementById("hubungan_kontakdarurat2").value = pegawai.hubungan_darurat2;
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
        document.getElementById("info_nama_kontakdarurat1").value = pegawai.nama_kontakdarurat1;
        document.getElementById("info_no_kontakdarurat1").value = pegawai.no_hpdarurat1;
        document.getElementById("info_hubungan_kontakdarurat2").value = pegawai.hubungan_darurat2;
        document.getElementById("info_nama_kontakdarurat2").value = pegawai.nama_kontakdarurat2;
        document.getElementById("info_no_kontakdarurat2").value = pegawai.no_hpdarurat2;
        document.getElementById("info_hubungan_kontakdarurat2").value = pegawai.hubungan_darurat2;
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

  function Kabupatenktp(){
    let id = $("#provinsiktp_id").val();
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

        $("#kabupatenktp_id").html(html);
      }
    });
  }

  function Kecamatanktp(){
    let id = $("#kabupatenktp_id").val();
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

        $("#kecamatanktp_id").html(html);
      }
    });
  }

  function Kelurahanktp(){
    let id = $("#kecamatanktp_id").val();
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

        $("#kelurahanktp_id").html(html);
      }
    });
  }

  function Kabupatendomisili(){
    let id = $("#provinsidomisili_id").val();
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

        $("#kabupatendomisili_id").html(html);
      }
    });
  }

  function Kecamatandomisili(){
    let id = $("#kabupatendomisili_id").val();
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

        $("#kecamatandomisili_id").html(html);
      }
    });
  }

  function Kelurahandomisili(){
    let id = $("#kecamatandomisili_id").val();
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

        $("#kelurahandomisili_id").html(html);
      }
    });
  }

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
  
  function getDivisiByDept(){
    let departement = $("#departement_add").val();
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

        $("#divisi_add").html(html);
      }
    });
  }

  function getBagianByDiv(){
    let divisi = $("#divisi_add").val();
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url:"<?php echo site_url("bagian/getBagianByDiv")?>/"+divisi,
      success : function(data){

        let html = ' ';
        let i;

        html += 
            '<option>---pilih bagian---</option>';
        for ( i=0; i < data.length ; i++){
            html += 
            '<option value="'+ data[i].id_bagian +'">'+ data[i].nama_bagian +'</option>';
        }

        $("#bagian_add").html(html);
      }
    });
  }
</script>
