<div class="row">
  <div class="d-flex justify-content-end">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Export Excel
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Export Excel</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?=base_url('PHL/exportExcel')?>" role="form" id="editbarang" method="post" enctype="multipart/form-data">
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
  </div>
</div>
<div class="row mt-4">
  <div class="card card-primary">
    <?php if(empty($name)){?>
    <div class="d-flex justify-content-between mt-4">
      <div class="p-2">
        <a href="<?= base_url('satpam')?>" class="btn btn-md btn-secondary"><i class="fas fa-arrow-left"></i> kembali</a>
        <a href="<?= base_url('satpam/laporanAbsensiPHL')?>" class="btn btn-md btn-warning"><i class="fa-solid fa-arrows-rotate"></i> refresh</a>
      </div>
      <div class="p-2 d-flex justify-align-items-center">
        <strong><?= longdate_indo(DATE("Y-m-d"))?></strong>
      </div>
    </div>
    <?php }?>
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

