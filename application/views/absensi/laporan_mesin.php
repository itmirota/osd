<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <!-- <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addPegawai"><i class="fa fa-plus"></i> Tambah Data</button> -->
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#importCsv"><i class="fa fa-file"></i> Import CSV</button>
    <div class="form-group">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#exportUser">
        <i class="fa fa-download"></i> Export Data
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
                      <select class="form-select" id="departement_id" onchange="getDivisiByDept()" required>
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
  </div>


  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Karyawan</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Dept. | Divisi</th>
            <th>Nama Karyawan</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
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
            <td  class="text-center"><?= $data->departement ?></td>
            <td  class="text-center"><?= $data->nama_pegawai ?></td>
            <td  class="text-center"><?= mediumdate_indo($data->date) ?></td>
            <td  class="text-center"><?= $data->time_in ?></td>
            <td  class="text-center"><?= $data->time_out ?></td>
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
                <?php if($data->status_pegawai == "kontrak"){?>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addNewKontrak" onclick="perpanjanganKontrak(<?= $data->id_absensi_mesin?>)">Perpanjang Kontrak</a></li>
                <?php } ?>
                <li><a class="dropdown-item suratPeringatan" href="#" data-bs-toggle="modal" data-bs-target="#addNewWarningLetter" onclick="suratPeringatan(<?= $data->id_absensi_mesin?>)">Surat Peringatan</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_absensi_mesin?>)">Edit Data</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editAkun" onclick="editAkun(<?= $data->id_absensi_mesin?>)">Edit Akun</a></li>
                <li><a class="dropdown-item" href="#"  onclick="deletePegawai(<?= $data->id_absensi_mesin?>)">Hapus Data</a></li>
              </ul>
            </div>
            </td>
            <!-- <td class="text-center">
              <?php
              if($data->status_pegawai == "kontrak"){?>
              <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNewKontrak" onclick="perpanjanganKontrak(<?= $data->id_absensi_mesin?>)"><i class="fa fa-plus" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="perpanjang"></i></button>
              <?php } ?>
              <button class="btn btn-sm btn-success " data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_absensi_mesin?>)"><i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edit"></i></button>
              <button class="btn btn-sm btn-danger" onclick="deletePegawai(<?= $data->id_absensi_mesin?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus"><i class="fa fa-trash"></i></button></td> -->
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

<!-- Modal Import Excel-->
<div class="modal fade" id="importCsv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('input-absensi-mesin')?>" role="form" method="post" enctype="multipart/form-data">
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
