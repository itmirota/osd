<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th class="text-center">Divisi</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Waktu Masuk</th>
            <th class="text-center">Waktu Keluar</th>
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
              <td><a href="<?= base_url('absensi/laporanDetail/'.$ld->id_pegawai)?>"><?= $ld->nama_pegawai?></td>
              <td class="text-center"><?= $ld->nama_divisi?></td>
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

