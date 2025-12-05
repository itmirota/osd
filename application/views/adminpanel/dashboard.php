<div class="container-fluid p-0">

<?php

  if($role == ROLE_SUPERADMIN || $role == ROLE_MANAGER){?>
    <h1 class="h3 mb-3"><strong>Info</strong> Perusahaan</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Karyawan masuk vs keluar <?= DATE('Y')?></h3>
          </div>
          <div class="card-body">
            <!-- <div id="chartContainer" style="height: 250px; width: 100%;"></div> -->
            <div id="chart"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Karyawan</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6 mb-3">
                <label for="disabledTextInput" class="form-label">Karyawan Aktif</label>
                <input type="text" class="form-control-plaintext" value="<?= $CountPegawaiAktif ?> orang">
              </div>
              <div class="col-6 mb-3">
                <label for="disabledTextInput" class="form-label">Karyawan Tidak Aktif</label>
                <input type="text" class="form-control-plaintext" value="<?= $CountPegawaiNonAktif ?> orang">
              </div>
              <div class="col-6 mb-3">
                <label for="disabledTextInput" class="form-label">Penambahan karyawan pada tahun <?= DATE('Y')?></label>
                <input type="text" class="form-control-plaintext" value="<?= $penambahanKaryawan ?> orang">
              </div>
              <div class="col-6 mb-3">
                <label for="disabledTextInput" class="form-label">Pengurangan karyawan pada tahun <?= DATE('Y')?></label>
                <input type="text" class="form-control-plaintext" value="<?= $penguranganKaryawan ?> orang">
              </div>
            </div>
          </div>
      </div>
      <!-- <div class="row">
        <div class="col-md-6">
          <a href="<?= base_url('Datapegawai')?>">
          <div class="card bg-success">
            <div class="card-body">
              <div class="row">
                <div class="col mt-0">
                  <h5 class="card-title text-light">Karyawan Aktif</h5>
                </div>
                <div class="col-auto">
                  <div class="stat bg-light text-success">
                  <i class="fa-solid fa-users"></i>
                  </div>
                </div>
              </div>
              <h1 class="mt-1 text-light"><?= $CountPegawaiAktif ?></h1>
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="<?= base_url('Datapegawainonaktif')?>">
          <div class="card  bg-danger">
            <div class="card-body">
              <div class="row">
                <div class="col mt-0">
                  <h5 class="text-light">Karyawan Non-Aktif</h5>
                </div>
                <div class="col-auto">
                  <div class="stat bg-light text-danger">
                    <i class="fa-solid fa-user-xmark"></i>
                  </div>
                </div>
              </div>
              <h1 class="mt-1 mb-3 text-light"><?= $CountPegawaiNonAktif ?></h1>
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="<?= base_url('pegawai/detailPenambahanKaryawan')?>">
          <div class="card bg-success ">
            <div class="card-body">
              <div class="row">
                <div class="col mt-0">
                  <h5 class="card-title text-light">Penambahan Karyawan <?= DATE('Y') ?></h5>
                </div>

                <div class="col-auto">
                  <div class="stat bg-light text-success">
                    <i class="fa-solid fa-user-plus"></i>
                  </div>
                </div>
              </div>
              <h1 class="mt-1 mb-3 text-light">+<?= $penambahanKaryawan ?></h1>
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-light text-secondary-modal"><strong><?= $penambahanKaryawanByDepartement ?></strong> Departement</p>
                </div>
                <div>
                <p class="text-light text-secondary-modal"><strong><?= $penambahanKaryawanByDivisi ?></strong> Divisi</p>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="<?= base_url('pegawai/detailPenguranganKaryawan')?>">
          <div class="card bg-danger" >
            <div class="card-body">
              <div class="row">
                <div class="col mt-0">
                  <h5 class="card-title text-light">Karyawan Non Aktif Tahun <?= DATE('Y') ?></h5>
                </div>

                <div class="col-auto">
                  <div class="stat bg-light text-danger">
                    <i class="fa-solid fa-user-minus"></i>
                  </div>
                </div>
              </div>
              <h1 class="mt-1 mb-3 text-light">-<?= $penguranganKaryawan ?></h1>
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-light text-secondary-modal"><strong><?= $penguranganKaryawanByDepartement ?></strong> Departement</p>
                </div>
                <div>
                <p class="text-light text-secondary-modal"><strong><?= $penguranganKaryawanByDivisi ?></strong> Divisi</p>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
      </div> -->
    </div>
  <?php } ?>

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
                <h1 class="mt-1 mb-3"><?= isset($CountIzin) ? $CountIzin : 0 ?></h1>
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
                <h1 class="mt-1 mb-3"><?= isset($CountCuti) ? $CountCuti : 0 ?></h1>
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
                <h1 class="mt-1 mb-3"><?= isset($CountTugas) ? $CountTugas : 0 ?></h1>
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
                <h1 class="mt-1 mb-3"><?= isset($CountIzinHarian) ? $CountIzinHarian : 0 ?></h1>
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

<?php if($role == ROLE_SUPERADMIN || $role == ROLE_MANAGER || $role == ROLE_ADMIN || $role == ROLE_HRGA){?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data peminjaman barang</h3>
        </div>
        <div class="card-body table-responsive">
        <table class="table table-hover">
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
        <table class="table table-hover">
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

<!-- CHART.JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="<?=base_url()?>assets/dist/js/jquery.canvasjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
$.ajax({
  type : "GET",
  dataType : "JSON",
  url :  "<?= base_url(); ?>user/getChart2",
  success : result => {

    const Datapenambahan = result.penambahanKaryawan;
    const Datapengurangan = result.penguranganKaryawan;

    let pengurangan = []
    Datapengurangan.map( Datapengurangan => {

      const dateString = Datapengurangan.x;
      // Pisahkan string menjadi bagian-bagian
      const parts = dateString.split('-');

      const year = parseInt(parts[0]);
      const month = parseInt(parts[1]) - 1;
      const day = parseInt(parts[2]); 
      const date = new Date(year, month, day);

      pengurangan.push({ x: date, y: Datapengurangan.y })
    });

    let penambahan = []
    Datapenambahan.map( Datapenambahan => {

      const dateString = Datapenambahan.x;
      // Pisahkan string menjadi bagian-bagian
      const parts = dateString.split('-');

      const year = parseInt(parts[0]);
      const month = parseInt(parts[1]) - 1;
      const day = parseInt(parts[2]); 
      const date = new Date(year, month, day);

      penambahan.push({ x: date, y: Datapenambahan.y })
    });

    const d = new Date(); 
    let year = d.getFullYear();



    var options = {
      exportEnabled: false,
      animationEnabled: true,
      // title:{
      //   text: "karyawan masuk VS keluar "+year
      // },
      // subtitles: [{
      //   text: "Click Legend to Hide or Unhide Data Series"
      // }],
      axisX: {
        title: "bulan"
      },
      axisY: {
        title: "Penambahan Karyawan",
        titleFontColor: "#4F81BC",
        lineColor: "#4F81BC",
        labelFontColor: "#4F81BC",
        interval: 2,
        tickColor: "#4F81BC"
      },
      axisY2: {
        title: "Pengurangan Karyawan",
        titleFontColor: "#C0504E",
        lineColor: "#C0504E",
        labelFontColor: "#C0504E",
        tickColor: "#C0504E",
        interval: 2
      },
      toolTip: {
        shared: true
      },
      legend: {
        cursor: "pointer",
        itemclick: toggleDataSeries
      },
      data: [{
        type: "line",
        name: "penambahan karyawan",
        showInLegend: true,
        xValueFormatString: "MMM YYYY",
        yValueFormatString: "#,##0 orang",
        dataPoints: penambahan
      },
      {
        type: "line",
        name: "pengurangan karyawan",
        axisYType: "secondary",
        showInLegend: true,
        xValueFormatString: "MMM YYYY",
        yValueFormatString: "#,##0 orang",
        dataPoints: pengurangan
      }]
    };
    $("#chartContainer").CanvasJSChart(options);

    function toggleDataSeries(e) {
      if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
      } else {
        e.dataSeries.visible = true;
      }
      e.chart.render();
    }
  }
});
</script>

<script>
$.ajax({
  type : "GET",
  dataType : "JSON",
  url :  "<?= base_url(); ?>user/getChart2",
  success : result => {

    const Datapenambahan = result.penambahanKaryawan;
    const Datapengurangan = result.penguranganKaryawan;

    let pengurangan = []
    Datapengurangan.map( Datapengurangan => {

      const dateString = Datapengurangan.x;
      // Pisahkan string menjadi bagian-bagian
      const parts = dateString.split('-');

      const year = parseInt(parts[0]);
      const month = parseInt(parts[1]) - 1;
      const day = parseInt(parts[2]); 
      const date = new Date(year, month, day);

      pengurangan.push({ x: date, y: Datapengurangan.y })
    });

    let penambahan = []
    Datapenambahan.map( Datapenambahan => {

      const dateString = Datapenambahan.x;
      // Pisahkan string menjadi bagian-bagian
      const parts = dateString.split('-');

      const year = parseInt(parts[0]);
      const month = parseInt(parts[1]) - 1;
      const day = parseInt(parts[2]); 
      const date = new Date(year, month, day);

      penambahan.push({ x: date, y: Datapenambahan.y })
    });
    const options = {
      chart: {
        type: 'line',
        height: 250,
        zoom: {
          enabled: false  
        }
      },
      colors: ['#ff0033', '#0ec244'],
      series: [
        {
        name: 'pengurangan karyawan',
        data: pengurangan
        }, 
        {
        name: 'penambahan karyawan',
        data: penambahan
        }
        
      ], 
      xaxis: {
        type: 'datetime',
      },
      yaxis:{
        tickAmount: 4,
        min: 1
      }

    }

    const chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
  }
});
</script>

