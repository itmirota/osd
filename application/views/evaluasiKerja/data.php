
<div class="d-flex justify-content-end mb-4">
  <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addJadwal"><i class="fa fa-plus"></i> Tambah Data</button>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal evaluasi</th>
            <th>Waktu evaluasi</th>
            <th>Nama Peserta</th>
            <th>Bagian</th>
            <!-- <th>Tanggal Habis Kontrak</th> -->
            <th class="text-center">Penilaian</th>
          </tr>
          </thead>
          <?php
              $no = 1;
              foreach ($list_data as $ld): ?>
          <tbody>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= mediumdate_indo($ld->date) ?></td>
              <td><?= $ld->time ?></td>
              <td><?= $ld->nama_pegawai ?></td>
              <td><?= $ld->nama_divisi ?></td>
              <!-- <td><?= mediumdate_indo($ld->tgl_selesai) ?></td> -->
              <td class="text-center">              
                <?php if ($role == ROLE_HRBP | $role == ROLE_SUPERADMIN){ ?>
                <a href="<?= base_url('hasilEvaluasi/'.$ld->id_evaluasiKerja)?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                <?php } ?>
                <a href="<?= base_url('penilaian/'.$ld->id_evaluasiKerja)?>" class="btn btn-sm btn-success">penilaian</a>
                <!-- <input type="text" value="<?= base_url('penilaian/'.$ld->id_evaluasiKerja)?>" id="myInput">
                <button class="btn btn-sm btn-primary" onclick="myFunction()">Copy link</button> -->
              </td>
            </tr>
          </tbody>
          <?php endforeach; ?>

        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addJadwal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('evaluasiKerja/saveJadwal')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addKategori">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-12">
            <label for="tgl_evaluasi" class="form-label">Tanggal Evaluasi</label>
            <input type="datetime-local" name="tgl_evaluasi" class="form-control tabel-PR" required />
          </div>
          <div class="col-md-12">
            <label for="nama_peserta" class="form-label">Nama Peserta</label>
            <select name="pegawai_id" id="id_pegawai" class="form-select tabel-PR" style="width:100%" required>
              <option>----- pilih pegawai ---</option>
              <?php foreach($pegawai as $p): ?>
              <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
              <?php endforeach; ?>
            </select>
          </div>  
          <div class="col-md-12">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-select tabel-PR" required>
              <option readonly>----- pilih kategori ---</option>
              <?php foreach($kategori as $k): ?>
              <option value="<?= $k->id_kategori?>"><?=$k->nama_kategori?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-12">
            <label for="penilai" class="form-label">Nama Penilai</label>
            <select name="penilai_id[]" id="penilai" class="form-select tabel-PR" multiple="multiple" style="width:100%">
              <option readonly>----- pilih pegawai ---</option>
              <?php foreach($pegawai as $p): ?>
              <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
              <?php endforeach; ?>
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