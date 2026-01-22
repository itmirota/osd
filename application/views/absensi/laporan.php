<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <div class="d-flex justify-content-between">
              <div class="p-2">
                  <strong>Periode:</strong> <?= mediumdate_indo($periodeAwal).' - '.mediumdate_indo($periodeAkhir)?>
                  
              </div>
              <div class="p-2">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#filterAbsenToko">
                  Filter
                  </button>
                  <a href="<?= base_url('export-excel-absensi/'.$id.'/'.$periodeAwal.'/'.$periodeAkhir)?>" type="button" class="btn btn-success me-2">
                  Export Excel
                  </a>
                  <a href="<?= base_url('laporanAbsensi')?>" type="button" class="btn btn-warning">
                  Refresh
                  </a>
              </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="filterAbsenToko" tabindex="-1" aria-labelledby="filterAbsenTokoLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="<?=base_url('laporanAbsensi')?>" role="form" method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                      <div class="mb-3">
                          <label for="periode" class="form-label">Periode</label>
                          <input type="month" class="form-control" name="periode">
                      </div>
                      <div class="mb-3">
                      <label for="pegawai" class="form-label">Nama Pegawai</label>
                      <select name="id_pegawai" id="pegawai_id" style="width:100%" class="form-select tabel-PR" required>
                          <option value="0">----- pilih pegawai ---</option>
                          <?php foreach($pegawai as $ld): ?>
                          <option value="<?= $ld->id_pegawai?>"> <?=$ld->nama_pegawai?></option>
                          <?php endforeach; ?>
                      </select>
                      </div>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Input</button>
                      </div>
                      </form>
                  </div>
              </div>
          </div>

          <!-- Modal Export -->
          <div class="modal fade" id="ExportExcel" tabindex="-1" aria-labelledby="ExportExcel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?=base_url('laporanAbsensi')?>" role="form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="mb-3">
                        <label for="periode" class="form-label">Periode</label>
                        <input type="month" class="form-control" name="periode">
                    </div>
                    <div class="mb-3">
                    <label for="pegawai" class="form-label">Nama Pegawai</label>
                    <select name="id_pegawai" id="pegawai_id" style="width:100%" class="form-select tabel-PR" required>
                        <option value="0">----- pilih pegawai ---</option>
                        <?php foreach($pegawai as $ld): ?>
                        <option value="<?= $ld->id_pegawai?>"> <?=$ld->nama_pegawai?></option>
                        <?php endforeach; ?>
                    </select>
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
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th class="text-center">Bagian</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Kehadiran</th>
            <th class="text-center">Pulang</th>
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
              <td class="text-center"><?= $ld->nama_bagian?></td>
              <td class="text-center"><?= mediumdate_indo($ld->date)?></td>
              <td>
                <a href="#" class="pop">
                <img data-src="<?= base_url('assets/images/absensi/'.$ld->bukti_absensi_in)?>" class="lazy-img" width="70px" style="border-radius:10px">
                </a><br>
                <i class="fa fa-clock"></i> <?= $ld->time_in?><br>
                <a href="<?= base_url('cekkoordinat/masuk/'.$ld->pegawai_id)?>"><i class="fa fa-location-dot"></i> <?= !empty($ld->wilayah_in) ? $ld->wilayah_in.','.$ld->kota_in : ' lokasi'?></a>
              </td>
              <td>
                <?php if (isset($ld->time_out)){ ?>
                <a href="#" class="pop">
                <img data-src="<?= base_url('assets/images/absensi/'.$ld->bukti_absensi_in)?>" class="lazy-img" width="70px" style="border-radius:10px">
                </a><br>
                <i class="fa fa-clock"></i> <?= $ld->time_out?><br>
                <a href="<?= base_url('cekkoordinat/pulang/'.$ld->pegawai_id)?>"><i class="fa fa-location-dot"></i> <?= !empty($ld->wilayah_out) ? $ld->wilayah_out.','.$ld->kota_out : ' lokasi'?></a>
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

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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

<script>
document.addEventListener("DOMContentLoaded", function () {
  const imgs = document.querySelectorAll("img.lazy-img");

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.classList.remove("lazy-img");
        obs.unobserve(img);
      }
    });
  });

  imgs.forEach(img => observer.observe(img));
});
</script>

