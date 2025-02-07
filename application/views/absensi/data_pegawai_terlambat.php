<div class="row">
  <div class="card card-primary">
    <div class="card-body table-responsive no-padding">
      <div class="d-flex justify-content-end mb-4">
        <div class="p-2">
          <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddTerlambat">
          Add Karyawan Terlambat
          </button>
        </div>
      </div>
      <table id="dataTable" class="table table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th class="text-center">Nama Karyawan</th>
          <th class="text-center">Tanggal</th>
          <th class="text-center">Jam Masuk</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        if(!empty($list_data))
        {
          foreach($list_data as $ld){
        ?>
          <tr>
            <td><?= $no++?></td>
            <td>
              <strong><?= $ld->nama_pegawai ?></strong>
              <hr class="m-0">
              <span style="font-size:12px"><strong><?= $ld->nama_departement ?>/<?= $ld->nama_divisi ?></strong></span><br>
              <span style="font-size:12px">NIK: MRT<?= $ld->nip ?></span>
            </td>
            <td class="text-center"><?= mediumdate_indo($ld->tgl_terlambat)?></td>
            <td class="text-center"><?= $ld->waktu_terlambat?></td>
          </tr>
          <?php }} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="AddTerlambat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-header">
          <h3>Formulir Keterlambatan Karyawan</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('absensi/simpanKeterlambatan')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="col-md-12">
        <div class="mb-3">
          <label for="pegawai_id" class="col-sm-4 col-form-label">Nama Karyawan</label>
          <select name="pegawai_id" id="pegawai_terlambat" class="form-select"  style="width:100%">
            <option>--- Pilih Pegawai ---</option>
            <?php foreach ($pegawai as $d){ ?>
            <option value="<?=$d->id_pegawai?>"><?= $d->nama_pegawai ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="row">
        <div class="col-md-6">
          <label for="pegawai_id" class="col-sm-4 col-form-label">Tanggal</label>
          <input type="date" class="form-control" name="tgl_terlambat">
        </div>
        <div class="col-md-6">
          <label for="pegawai_id" class="col-sm-4 col-form-label">Jam Masuk</label>
          <input type="time" class="form-control" name="waktu_terlambat">
        </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>