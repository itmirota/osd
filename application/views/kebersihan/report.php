<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body">
        <div class="table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Tanggal Perawatan</th>
            <th>Waktu Perawatan</th>
            <th>Bukti Perawatan</th>
            <th>Detail Perawatan</th>
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
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nama_pegawai ?></td>
            <td><?php echo mediumdate_indo($data->date) ?></td>
            <td><?php echo $data->time ?></td>
            <td><?php echo $data->detail_perawatan ?></td>
            <td>
              <img src="<?= base_url('assets/images/kebersihan/'.$data->bukti_perawatan)?>" width="200px"></td>
          </tr>
          <?php
            endforeach;
          } ?>
          </tbody>
        </table>
        </div>
      </div><!-- /.box-body -->
    </div>
  </div>
</div>