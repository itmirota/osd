
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
      <div class="d-flex justify-content-start mb-4">
        <a href="<?= base_url('EvaluasiKerja')?>"><i class="fa fa-arrow-left"></i> kembali</a>
      </div>
      </div>
      <div class="card-body table-responsive no-padding">
        <div class="row">
          <div class="col-12">
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Nama Peserta</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $list_data->nama_pegawai?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Divisi</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $list_data->nama_divisi?>">
              </div>
            </div>
          </div>
        </div>
        <hr>
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="200px">Nama Penilai</th>
              <th width="150px" class="text-center" colspan="<?= $jml_soal ?>">Nilai</th>
              <th class="text-center">kelebihan</th>
              <th class="text-center">kekurangan</th>
              <th width="150px" class="text-center">Total</th>
            </tr>
          </thead>
          <?php
            $totalNilai = 0;
            foreach ($hasil as $h): 
            $jawaban = explode(',',$h->jawaban);
            $total = array_sum($jawaban)/$jml_soal;
            $totalNilai = $totalNilai + $total;
            ?>
          <tbody>
            <tr>
              <td><?= $h->nama_pegawai ?></td>
              <?php foreach(explode(',',$h->jawaban) as $jwb){ ?>
              <td class="text-center"><?= $jwb ?></td>
              <?php } ?>
              <td><?= $h->kelebihan ?></td>
              <td><?= $h->kekurangan ?></td>
              <td class="text-center"><?= $total ?></td>
            </tr>
          </tbody>
          <?php endforeach; 
          $rata_rata = $totalNilai/$jml_penilai;
          ?>
          <tfoot>
            <tr>
              <td class="text-end" colspan="<?= COUNT($jawaban)+3 ?>"><b>Rata - rata</b></td>
              <td class="text-center"><b><?= $rata_rata?></b></td>
            </tr>
            <tr>
              <td class="text-end" colspan="<?= COUNT($jawaban)+3 ?>"><b>Kesimpulan</b></td>
              <td class="text-end">
                <?php 
                  switch ($rata_rata) {
                  case ($rata_rata <= 100 && $rata_rata >= 80):?>
                    <span class="badge text-bg-success">Baik Sekali</span> <span class="badge text-bg-success">Dipertahankan 12 Bulan</span> 
                  <?php  break;
                  case ($rata_rata <= 80 && $rata_rata >= 76):?>
                    <span class="badge text-bg-success">Baik</span> <span class="badge text-bg-info">Dipertahankan 6 Bulan</span> 
                  <?php break;
                  case ($rata_rata <= 75 && $rata_rata >= 61) ?>
                    <span class="badge text-bg-warning">Cukup</span> <span class="badge text-bg-warning">Dipertahankan 3 Bulan</span> 
                  <?php break; 
                  case ($rata_rata <= 60 && $rata_rata >= 51) ?>
                    <span class="badge text-bg-danger">Kurang</span>
                  <?php break; 
                  default:?>
                    <span class="badge text-bg-danger">Kurang sekali</span>
                <?php } ?>
              </td>
            </tr>
          </tfoot>
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