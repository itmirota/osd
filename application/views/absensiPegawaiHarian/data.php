<style>
  .img-judul{
    width:5vh;
  }

  .text-judul h3, .text-date{
    color:#fff;
    font-weight:bold;
  }

  .text-judul p{
    color:#ddd9d9;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <?php if(empty($name)){?>
    <div class="text-judul mt-2 mb-2">
      <h3 class="m-0">Data Absensi Pegawai Lepas Harian</h3>
      <p class="m-0">List data absensi pegawai lepas harian</p>
    </div>
    <?php } ?>
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <div class="row">
          <div class="d-flex justify-content-between">
          <div class="p-2">
            <a href="<?= base_url('PHL/kehadiran')?>" class="btn btn-md btn-info"><i class="fas fa-arrow-left"></i> kembali</a>
          </div>
          <div class="p-2 d-flex justify-align-items-center">
            <strong><?= longdate_indo(DATE("Y-m-d"))?></strong>
          </div>
          </div>
        </div>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Bagian</th>
            <th>Masuk</th>
            <th>Pulang</th>
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
            <td><?= mediumdate_indo($data->date) ?></td>
            <td><?= $data->nama ?></td>
            <td><?= $data->bagian ?></td>
            <td><?= $data->time_in ?></td>
            <td><?= $data->time_out ?></td>
          </tr>
          <?php
            endforeach;
          } ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div>
  </div>
</div>