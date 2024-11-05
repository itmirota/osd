<div class="d-flex mb-4">
  <div class="p-2">
  <a href="<?= base_url('dashboard')?>" class="btn btn-warning">Kembali</a>
  </div>
</div>
<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Data Karyawan Baru Tahun <?=$year?></h3>
    </div><!-- /.box-header -->
    <div class="card-body table-responsive no-padding">
      <table id="dataTable" class="table table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th class="text-center">Nama Karyawan</th>
          <th class="text-center">Departement</th>
          <th class="text-center">Divisi</th>
          <th class="text-center">Tanggal Masuk</th>
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
          <td>
            <strong><?= $data->nama_pegawai ?></strong>
            <hr class="m-0">
            <span style="font-size:12px">NIK: MRT<?= $data->nip ?></span>
          </td>
          <td  class="text-center"><?= $data->nama_departement ?></td>
          <td  class="text-center"><?= $data->nama_divisi ?></td>
          <td  class="text-center"><?= mediumdate_indo($data->tgl_masuk) ?></td>
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