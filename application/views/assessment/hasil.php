<div class="card">
  <div class="card-body">
    <?php
    var_dump($hasil->nilai);
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
        belum ada yang memberikan nilai kepada <strong><?= $hasil->nama_pegawai ?></strong>
      </div>
    </tr>
    <?php } ?>
  </div>
</div>