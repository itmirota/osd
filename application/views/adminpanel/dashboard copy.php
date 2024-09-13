<div class="container-fluid p-0">
<?php
if($role == ROLE_SUPERADMIN || $role == ROLE_MANAGER){?>
  <h1 class="h3 mb-3"><strong>Info</strong> Perusahaan</h1>
  <div class="row">
    <div class="col-xl-6 col-xxl-5 d-flex">
      <canvas id="myChart"></canvas>
    </div>
    <div class="col-xl-6 col-xxl-5 d-flex">
      <div class="w-100">
        <div class="row">
          <div class="col-sm-6">
            <a href="<?= base_url('Datapegawai')?>">
            <div class="card bg-success">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title text-light">Karyawan Aktif</h5>
                  </div>
                  <div class="col-auto">
                    <div class="stat bg-light text-primary">
                    <i class="fa-solid fa-users"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3 text-light"><?= $CountPegawaiAktif ?></h1>
              </div>
            </div>
            </a>
            <a href="<?= base_url('Datapegawainonaktif')?>">
            <div class="card  bg-danger">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="text-light">Karyawan Non-Aktif</h5>
                  </div>
                  <div class="col-auto">
                    <div class="stat bg-light text-primary">
                      <i class="fa-solid fa-user-xmark"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3 text-light"><?= $CountPegawaiNonAktif ?></h1>
              </div>
            </div>
            </a>
          </div>
          <div class="col-sm-6">
            <a href="<?= base_url('Datadepartement')?>">
            <div class="card bg-success ">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title text-light">Penambahan Karyawan <?= DATE('Y') ?></h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat bg-light text-primary">
                      <i class="fa-solid fa-user-plus"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3 text-light">+<?= $penambahanKaryawan ?></h1>
              </div>
            </div>
            </a>
            <a href="<?= base_url('Datadivisi')?>">
            <div class="card bg-danger" >
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title text-light">Pengurangan Karyawan <?= DATE('Y') ?></h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat bg-light text-primary">
                      <i class="fa-solid fa-user-minus"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3 text-light">-<?= $penguranganKaryawan ?></h1>
              </div>
            </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>


  <div class="row">
    <div class="col-xl-12 d-flex">
      <div class="w-100">
        <div class="row">
          <div class="col-sm-6">
            <a href="<?= base_url('Datadepartement')?>">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Departement</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="fa-solid fa-people-roof"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3"><?= $CountDepartement ?></h1>
              </div>
            </div>
            </a>
          </div>
          <div class="col-sm-6">
            <a href="<?= base_url('Datadivisi')?>">
            <div class="card" >
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Divisi</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="fa-solid fa-users-line"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3"><?= $CountDivisi ?></h1>
              </div>
            </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script>
  $.ajax({
  type : "GET",
  dataType : "JSON",
  url :  "<?= base_url(); ?>user/getChart",
  success : result => {
    const penambahan = result.penambahanKaryawan;
    const pengurangan = result.penguranganKaryawan;
    chart(penambahan, pengurangan);
  }
  });

  function chart(penambahan, pengurangan){
        // setup 
        const data = {
      datasets: [{
        label: 'Penambahan Karyawan',
        data: penambahan,
        backgroundColor: [
          'rgb(28,187,140,0.2)',
        ],
        borderColor: [
          'rgb(28,187,140,1)',
        ],
        borderWidth: 1
      },
      {
        label: 'Pengurangan Karyawan',
        data: pengurangan,
        backgroundColor: [
          'rgb(220,53,69,0.2)',
        ],
        borderColor: [
          'rgb(220,53,69,1)',
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'line',
      data,
      options: {
        scales: {
          x: {
            type:'time',
            time:{
              unit:'month'
            }
          },
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  }
  </script>

