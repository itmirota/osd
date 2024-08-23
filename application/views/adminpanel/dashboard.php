<div class="container-fluid p-0">

  <h1 class="h3 mb-3"><strong>Admin</strong> Dashboard</h1>

  <div class="row">
    <div class="col-xl-6 col-xxl-5 d-flex">
      <div class="card card-dashboard d-flex flex-fill">
        <div class="card-body d-flex flex-wrap align-items-center">
            <h1>Hai, Selamat Datang kembali <br><span class="header-dashboard"><?= $name ?></span></h1>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-xxl-5 d-flex">
      <div class="w-100">
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Pengajuan Izin</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="file-text"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3"><?= $CountIzin ?></h1>
                <div class="mb-0">
                  <a href="<?= base_url('izin')?>">lihat pengajuan <i class="fa fa-angles-right"></i></a>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Pengajuan Cuti</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="file-text"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3"><?= $CountCuti ?></h1>
                <div class="mb-0">
                  <a href="<?= base_url('cuti')?>">lihat pengajuan <i class="fa fa-angles-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Pengajuan Tugas</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="file-text"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3"><?= $CountTugas ?></h1>
                <div class="mb-0">
                  <a href="<?= base_url('tugas')?>">lihat pengajuan <i class="fa fa-angles-right"></i></a>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Pengajuan Izin Kurang Dari 1 Hari</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="file-text"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3"><?= $CountIzinHarian ?></h1>
                <div class="mb-0">
                  <a href="<?= base_url('izin-harian')?>">lihat pengajuan <i class="fa fa-angles-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
if($role == ROLE_SUPERADMIN || $role == ROLE_MANAGER || $role == ROLE_ADMIN || $role == ROLE_HRGA){?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data peminjaman barang</h3>
        </div>
        <div class="card-body table-responsive">
        <table id="DashboardBarang" class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Barang</th>
              <th>Peminjam</th>
              <th>Qty</th>
              <th>Mulai Pinjam</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if(!empty($barang))
            {
              foreach($barang as $data):
            ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $data->nama_barang ?></td>
              <td><?php echo $data->nama_pinjam_barang ?></td>
              <td><?php echo $data->jumlah_pinjam ?> pcs</td>
              <td><?php echo mediumdate_indo($data->tanggal_mulai).' '.$data->waktu_mulai ?></td>
            </tr>
            <?php
              endforeach;
            }
            ?>
          </tbody>
        </table>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            <a href="<?php echo base_url('Pinjambarang'); ?>">lihat selengkapnya <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if($role == ROLE_SUPERADMIN || $role == ROLE_MANAGER || $role == ROLE_HRGA){?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data peminjaman ruangan</h3>
        </div>
        <div class="card-body table-responsive">
        <table id="DashboardRuangan" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Ruangan</th>
            <th>Peminjam</th>
            <th>Mulai Pinjam</th>
            <th>Selesai Pinjam</th>
            <th>Agenda</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($ruangan))
          {
            foreach($ruangan as $data):
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nama_ruangan ?></td>
            <td><?php echo $data->nama_pinjam_ruangan ?></td>
            <td><?php echo mediumdate_indo($data->tanggal_mulai).' '.$data->waktu_mulai ?></td>
            <td><?php echo mediumdate_indo($data->tanggal_selesai).' '.$data->waktu_selesai ?></td>
            <td><?php echo $data->keterangan_pinjam ?></td>
          </tr>
          <?php
            endforeach;
          }
          ?>
          </tbody>
        </table>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            <a href="<?php echo base_url('Pinjamruangan'); ?>">lihat selengkapnya <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<?php } ?>
