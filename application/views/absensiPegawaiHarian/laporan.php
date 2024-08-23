<div class="row mt-4">
  <div class="card card-primary">
    <div class="d-flex justify-content-between mt-4">
      <div class="p-2">
        <a href="<?= base_url('satpam')?>" class="btn btn-md btn-secondary"><i class="fas fa-arrow-left"></i> kembali</a>
        <a href="<?= base_url('satpam/laporanAbsensiPLH')?>" class="btn btn-md btn-warning"><i class="fa-solid fa-arrows-rotate"></i> refresh</a>
      </div>
      <div class="p-2 d-flex justify-align-items-center">
        <strong><?= longdate_indo(DATE("Y-m-d"))?></strong>
      </div>
    </div>
    <div class="card-body table-responsive no-padding">
      <table id="dataTable" class="table table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th class="text-center">Bagian</th>
          <th class="text-center">Tanggal</th>
          <th class="text-center">Absen Masuk</th>
          <th class="text-center">Absen Keluar</th>
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
            <td><?= $ld->nama?></td>
            <td class="text-center"><?= $ld->bagian?></td>
            <td class="text-center"><?= mediumdate_indo($ld->date)?></td>
            </td>
            <td>
              <img src="<?= base_url('assets/images/absensiPegawaiHarian/'.$ld->bukti_absensi_in)?>" width="200px" style="border-radius:15px">
              <p><i class="fas fa-clock"></i> <?= $ld->time_in?></p>
            </td>
            <td>
              <?php if (isset($ld->time_out)){ ?>
              <img src="<?= base_url('assets/images/absensiPegawaiHarian/'.$ld->bukti_absensi_out)?>" width="200px" style="border-radius:15px">
              <p><i class="fas fa-clock"></i> <?= $ld->time_out?></p>
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

