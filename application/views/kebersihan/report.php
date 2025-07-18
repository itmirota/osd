<div class="row mb-4">
  <div class="d-flex justify-content-end">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Export Excel
    </button>
    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#HapusLaporan">
      hapus data
    </button>

    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#filter">
    Filter
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Export Excel</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?=base_url('kebersihan/exportExcel')?>" role="form" id="editbarang" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="row">  
                  <div class="col-md-6">
                    <label for="tgl_pembelian" class="form-label">Dari</label>
                    <input type="date" name="tgl_mulai" id="tgl_pembelian" class="form-control tabel-PR" />
                  </div>  
                  <div class="col-md-6">
                    <label for="tgl_pembelian" class="form-label">Sampai</label>
                    <input type="date" name="tgl_akhir" id="tgl_pembelian" class="form-control tabel-PR" />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Export</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="HapusLaporan" tabindex="-1" aria-labelledby="HapusLaporanLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?=base_url('kebersihan/hapus')?>" role="form" id="editbarang" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="row">  
                  <div class="col-md-6">
                    <label for="tgl_pembelian" class="form-label">Dari</label>
                    <input type="date" name="tgl_mulai" class="form-control tabel-PR" />
                  </div>  
                  <div class="col-md-6">
                    <label for="tgl_pembelian" class="form-label">Sampai</label>
                    <input type="date" name="tgl_akhir" class="form-control tabel-PR" />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="filterLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?=base_url('laporan-kebersihan')?>" role="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="mb-3">
                <label for="periode" class="form-label">Periode</label>
                <input type="month" class="form-control" name="periode">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Input</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
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
              <a href="#" class="pop">
              <img src="<?= base_url('assets/images/kebersihan/'.$data->bukti_perawatan)?>" width="200px">
              </a>
            </td>
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
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">              
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="imagepreview" style="width: 100%;" >
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
$(function() {
    $('.pop').on('click', function() {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');   
    });		
});
</script>