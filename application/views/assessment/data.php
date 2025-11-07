<div class="container">
  <?php 
  if ($page == 'PenilaianAssessment'){ ?>
  <div class="row my-3">
    <a href="<?= base_url('dashboardUser')?>"><i class="fa fa-solid fa-angles-left"></i> kembali</a>
  </div>
  <?php } ?>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title">Data Assessment 360</h3>
      <?php if ($page == 'DataAssessment'){ ?>
      <div class="dropdown-start">
        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-solid fa-bars"></i> menu
        </a>

        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="<?= base_url('assessment/list_soal')?>"> tambah soal</a></li>
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_assessment"> tambah assessment</a></li>
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-tambah"> import assessment</a></li>  
        </ul>
      </div>
      <?php } ?>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="table-responsive no-padding">
        <table id="dataTable" class="table table-bordered">
          <thead>
          <tr>
            <th width="5dvh">No</th>
            <th width="50dvh">Nama Pegawai</th>
            <?php if ($page == 'DataAssessment'){ ?>
            <th>Nama Penilai</th>
            <?php } ?>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach($list_data as $ld) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $ld->nama_pegawai ?></td>
                <?php if ($page == 'DataAssessment'){ ?>
                <td><?= $ld->nama_penilai ?></td>
                <?php } ?>
                <td>
                    <?php if ($page != 'DataAssessment'){ ?>
                    <?php if(is_null($ld->nilai)){ ?>
                    <a href="<?= base_url('assessment/penilaian/').$ld->pegawai_id?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-pencil"></i> Penilaian
                    </a>
                    <?php }else{ ?>
                      <span class="badge rounded-pill text-bg-success">Sudah dinilai</span>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($page == 'DataAssessment'){ ?>
                    <a href="<?= base_url('assessment/hasilAssessment/').$ld->id_assessment?>" class="btn btn-primary btn-sm">
                      <i class="fas fa-eye"></i> Hasil
                    </a>
                    <?php } ?>
                </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
  </div>

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Assessment</h4>
        </div>
        <form action="<?= base_url('assessment/spreadsheet_import') ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <a href="http://">export template</a>
            <div class="form-group">
              <label for="pegawai_id">File</label>
              <input type="file" name="upload_file" id="upload_file" class="form-control">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>


  <div class="modal fade" id="add_assessment">        
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Assessment</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="add-assessment" action="<?= base_url('assessment/save')?>" method="post">
          <div class="modal-body">
            <div class="mb-3">
              <label for="pegawai_id" class="form-label">Nama pegawai</label>
              <select name="pegawai_id" id="pegawai_assessment" class="form-select" style="width: 100%" required>
                <option value="">Pilih Pegawai</option>
                <?php foreach ($this->crud_model->lihatdata('tbl_pegawai') as $penilai) { ?>
                  <option value="<?= $penilai->id_pegawai ?>"><?= $penilai->nama_pegawai ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="penilai_id" class="form-label">Nama Penilai</label>
              <select name="penilai_id" id="penilai_assessment"  style="width: 100%" class="form-select" required>
                <option value="">Pilih Penilai</option>
                <?php foreach ($this->crud_model->lihatdata('tbl_pegawai') as $penilai) { ?>
                  <option value="<?= $penilai->id_pegawai ?>"><?= $penilai->nama_pegawai ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="assessment_tingkatan_id" class="form-label">Tingkatan Assessment</label>
              <select name="assessment_tingkatan_id" id="assessment_tingkatan_id" class="form-select" required>
                <option value="">Pilih Tingkatan</option>
                <?php foreach ($this->crud_model->lihatdata('tbl_assessment_tingkatan') as $tingkatan) { ?>
                  <option value="<?= $tingkatan->id_assessment_tingkatan ?>"><?= $tingkatan->nama_assessment_tingkatan ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

