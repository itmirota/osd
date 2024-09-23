<div class="row">
  <div class="d-flex justify-content-between mb-4">
    <a href="<?= base_url('laporanAbsensi')?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartement"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Kehadiran</th>
            <th class="text-center">Pulang</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
            foreach($list_data as $ld):
          ?>
            <tr>
              <td><?= $no++?></td>
              <td class="text-center"><?= mediumdate_indo($ld->date)?></td>
              <td class="text-center"><?= $ld->time_in?>
              <a href="<?= base_url('cekkoordinat/masuk/'.$ld->pegawai_id)?>"><i class="fa fa-eye"></i></a>
              </td>
              <td class="text-center">
                <?php if (isset($ld->time_out)){ ?>
                <?= $ld->time_out?>
                <a href="<?= base_url('cekkoordinat/pulang/'.$ld->pegawai_id)?>"><i class="fa fa-eye"></i></a>
                <?php }else{ ?>
                <span class="badge text-bg-secondary">belum absen</span> 
                <?php } ?>
              </td>
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

