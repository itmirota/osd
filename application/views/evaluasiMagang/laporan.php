
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
      <div class="d-flex justify-content-start mb-4">
        <a href="<?= base_url('evaluasiMagang')?>" class="btn btn-warning"><i class="fa fa-angles-left"></i> kembali</a>
      </div>
      </div>
      <div class="card-body table-responsive no-padding">
      <?php foreach ($list_data as $ld): ?>
        <div class="row">
          <div class="col sm-6">
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Nama Peserta</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $ld->nama_peserta?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Divisi</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $ld->bagian?>">
              </div>
            </div>
          </div>
          <div class="col sm-6">
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Nilai</label>
              <div class="col-sm-8">
                <?php
                $nilai = $nilai->total_nilai/COUNT($hasil) 
                ?>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?=  round($nilai,2).'%' ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Kesimpulan</label>
              <div class="col-sm-8">
                <?php 
                switch ($nilai) {
                  case ($nilai <= 100 && $nilai >= 96):?>
                    <span class="badge text-bg-success">A+</span> <span class="badge text-bg-success"> Awesome</span> 
                  <?php  break;
                  case ($nilai <= 95 && $nilai >= 86):?>
                    <span class="badge text-bg-success">A</span> <span class="badge text-bg-success"> Perfect</span> 
                  <?php break;
                  case ($nilai <= 85 && $nilai >= 81) ?>
                    <span class="badge text-bg-success">B+</span> <span class="badge text-bg-success">Sangat Baik</span> 
                  <?php break; 
                  case ($nilai <= 80 && $nilai >= 71) ?>
                    <span class="badge text-bg-success">B</span> <span class="badge text-bg-success">Baik</span> 
                  <?php break; 
                  case ($nilai <= 70 && $nilai >= 61) ?>
                    <span class="badge text-bg-warning">B-</span> <span class="badge text-bg-warning">Cukup</span> 
                  <?php break;
                  case ($nilai <= 60 && $nilai >= 50) ?>
                    <span class="badge text-bg-danger">C</span> <span class="badge text-bg-warning">Kurang</span> 
                  <?php break;
                  default:?>
                    <span class="badge text-bg-danger">Kurang sekali</span>
                  <?php } ?>
              </div>
            </div>            
          </div>
        </div>
      <?php endforeach;?>
      <hr></hr>

      <table class="table table-hover" id="dataTableScrollX">
          <thead>
          <tr>
            <th width="20vh">Nama Penguji</th>
            <th width="20vh">Jabatan dan Bagian</th>
            <th class="text-end">Pemahaman Tugas</th>
            <th class="text-end">Kualitas Pekerjaan</th>
            <th class="text-end">Inisiatif</th>
            <th class="text-end">Penyelesaian Tugas</th>
            <th class="text-end">Kerjasama Tim</th>
            <th class="text-end">Etika Kerja</th>
            <th class="text-end">Etika Komunikasi</th>
            <th class="text-end">Fleksibilitas</th>
            <th class="text-end">Hasil</th>
            <th class="text-end">kelebihan</th>
            <th class="text-end">kekurangan</th>
          </tr>
          </thead>
          <?php
              foreach ($hasil as $h): 
              ?>
          <tbody>
            <tr>
              <td><?= $h->nama_penilai ?></td>
              <td><?= $h->jabatan_bagian ?></td>
              <td class="text-start"><?php 
              $jawaban1 = explode('|',$h->parameter1);
              ?>
              <?= $jawaban1[0] ?>
              <p class="text-secondary-modal">catatan: <?= $jawaban1[1] ?> </p>
              </td>
              <td class="text-start"><?php 
              $jawaban2 = explode('|',$h->parameter2);
              ?>
              <?= $jawaban2[0] ?>
              <p class="text-secondary-modal">catatan: <?= $jawaban2[1] ?> </p>
              </td>
              <td class="text-start"><?php 
              $jawaban3 = explode('|',$h->parameter3);
              ?>
              <?= $jawaban3[0] ?>
              <p class="text-secondary-modal">catatan: <?= $jawaban3[1] ?> </p>
              </td>
              <td class="text-start"><?php 
              $jawaban4 = explode('|',$h->parameter4);
              ?>
              <?= $jawaban4[0] ?>
              <p class="text-secondary-modal">catatan: <?= $jawaban4[1] ?> </p>
              </td>
              <td class="text-start"><?php 
              $jawaban5 = explode('|',$h->parameter5);
              ?>
              <?= $jawaban5[0] ?>
              <p class="text-secondary-modal">catatan: <?= $jawaban5[1] ?> </p>
              </td>
              <td class="text-start"><?php 
              $jawaban6 = explode('|',$h->parameter6);
              ?>
              <?= $jawaban6[0] ?>
              <p class="text-secondary-modal">catatan: <?= $jawaban6[1] ?> </p>
              </td>
              <td class="text-start"><?php 
              $jawaban7 = explode('|',$h->parameter7);
              ?>
              <?= $jawaban7[0] ?>
              <p class="text-secondary-modal">catatan: <?= $jawaban7[1] ?> </p>
              </td>
              <td class="text-start"><?php 
              $jawaban8 = explode('|',$h->parameter8);
              ?>
              <?= $jawaban8[0] ?>
              <p class="text-secondary-modal">catatan: <?= $jawaban8[1] ?> </p>
              </td>
              <td><?= $h->total_nilai ?>%</td>
              <td><?= $h->kelebihan ?></td>
              <td><?= $h->kekurangan ?></td>
            </tr>
          </tbody>
          <?php endforeach; ?>
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