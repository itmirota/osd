
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
      <div class="card-header">
      <div class="d-flex justify-content-between mb-4">
        <button class="btn btn-warning" onclick="refresh()"><i class="fa fa-rotate"></i> Refresh</button>
        <a href="<?= base_url('addJadwalEvaluasi')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
      </div>
      </div>
      <?php } ?>
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal evaluasi</th>
            <th>Nama Peserta</th>
            <th>Bagian</th>
            <th>Kategori Evaluasi</th>
            <th>Tujuan Evaluasi</th>
            <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
            <th class="text-center">Edit</th>
            <th class="text-center">Hasil</th>
            <?php } ?>
            <th class="text-center">Penilaian</th>
          </tr>
          </thead>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<script>

  function refresh(){
    window.location.reload()
  }
</script>