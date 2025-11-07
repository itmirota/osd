<div class="row my-3">
  <a href="<?= base_url('DataAssessment')?>"><i class="fa fa-solid fa-angles-left"></i> kembali</a>
</div>
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Hasil Penilaian Assessment</h3>
    <div class="mb-3 row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Nama Karyawan</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" value=": <?= $hasil->nama_pegawai ?>">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Nama Penilai</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" value=": <?= $hasil->nama_penilai ?>">
      </div>
    </div>
  </div>
  <div class="card-body">
    <?php
    if (isset($hasil->nilai)){
    ?> 
    <table id="dataTable" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Soal</th>
        <th>Jawaban</th>
        <!-- <th>Nilai</th>
        <th>Keterangan</th> -->
      </tr>
      </thead>    
      <tbody>
        <?php 
        $no = 1;
        foreach($explode_hasil as $key) : 
          $pisahSoal = explode(':',$key);
          $id = $pisahSoal[0];
          $soal = $this->assessment_model->getSoalById($id);
        ?>
        <tr>
            <td>
              <?= $no ?>
            </td>
            <td><?= $soal->jenis_soal == 'value' ? 'Nilai Value '.$soal->kategori : $soal->soal?></td>
            <td><?=$pisahSoal[1] == 'ss' ?'sangat setuju': ($pisahSoal[1] == 's' ?'setuju': ($pisahSoal[1] == 'ts' ?'tidak setuju':($pisahSoal[1] == 'sts' ?'sangat tidak setuju':$pisahSoal[1])))?></td>
        </tr>
        <?php 
        $no++;
        endforeach ?>
      </tbody>
    </table>
    <?php }else{ ?>
    <tr> 
      <div class="alert alert-primary" role="alert">
        <strong>penilai belum melakukan penilaian</strong>
      </div>
    </tr>
    <?php } ?>
  </div>
</div>