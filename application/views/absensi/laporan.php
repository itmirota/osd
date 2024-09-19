<div class="row">
  <div class="col-md-12">
    <!-- <div class="card card-primary">
      <div class="card-body">
        <span><strong>periode: <?=$periode?></strong></span>
      <table  id="dataTableScrollX" class="table table-hover">
          <thead>
          <tr>
            <th>Nama</th>
            <th class="text-center">Divisi</th>
              <?php 
              $tanggal = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
              for ($i=1; $i < $tanggal+1; $i++) { ?>
                <th width="100px" class="text-center">
                  <?= $i.' '.medium_bulan(date('m')).' '. date('Y')?>
                </th>
              <?php } ?>
          </tr>
          </thead>
          <tbody>
            <?php foreach($detail_data as $data): ?>
            <tr>
              <td><?= $data->nama_pegawai?></td>
              <td class="text-center"><?= $data->nama_divisi?></td>
              <?php 
              $tanggal = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
              ?>
              <?php for ($i=1; $i < $tanggal+1; $i++) {?>
              <td style="vertical-align: text-top">
                <?php $detail = $this->absensi_model->showReportById($data->pegawai_id);
                foreach($detail as $detail):?>
                <?php
                $date=date_create($detail->date);
                $date=date_format($date,"d"); 
                if($date == $i){
                ?>
                <hr>
                <p style="color:green">masuk <?= $detail->time_in?></p>
                <p style="color:red">keluar <?=(empty($detail->time_out) ? ' - ': $detail->time_out)?></p>
                <hr>
                <?php } ?>
                <?php endforeach;?>
              </td>
              <?php } ?>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div> -->

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

