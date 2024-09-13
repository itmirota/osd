<div class="row">
  <div class="d-flex justify-content-between mb-4">
    <a href="<?= base_url('laporanAbsensi')?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartement"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <!-- <table class="table table-hover">
          <thead>
          <tr>
            <th>Nama</th>
            <th class="text-center">Divisi</th>
              <?php 
              $tanggal = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
              for ($i=1; $i < $tanggal+1; $i++) { ?>
                <th>
                  <?php echo $i . " "; ?>
                </th>
              <?php } ?>
          </tr>
          </thead>
          <tbody>
            <?php foreach($list_data as $data): ?>
            <tr>
              <td><?= $data->nama_pegawai?></td>
              <td class="text-center"><?= $data->nama_divisi?></td>
              <?php 
              $tanggal = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
              ?>
              <?php for ($i=1; $i < $tanggal+1; $i++) { 
              // $detail = $this->absensi_model->showReportById($data->pegawai_id);
              // foreach($detail as $detail):?>
              <td>
                <?php
                $date=date_create($data->date);
                $date=date_format($date,"d"); 
                if($date == $i){
                ?>
                <?= 'masuk '.$data->time_in?>
                <hr>
                <?= 'pulang '.(empty($data->time_out) ? ' - ': $data->time_out)?>
                <?php }else{
                  echo $i;
                }?>
              </td>
              <?php } ?>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table> -->


        <table class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
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

