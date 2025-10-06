
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
      <div class="d-flex justify-content-start mb-4">
        <a href="<?= base_url('EvaluasiKerja')?>" class="btn btn-warning"><i class="fa fa-angles-left"></i> kembali</a>
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
          <?php 
          if(isset($nilai->total_nilai)){
          ?>
          <div class="col sm-6">
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Nilai</label>
              <div class="col-sm-8">
                <?php
                $nilai = $nilai->total_nilai/(COUNT($hasil))
                ?>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?=  round($nilai,2).'%' ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Kesimpulan</label>
              <div class="col-sm-8">
                <?php 
                switch ($nilai) {
                  case ($nilai <= 100 && $nilai >= 91):?>
                    <span class="badge text-bg-success">Baik</span> <span class="badge text-bg-success"> 1 Tahun</span> 
                  <?php  break;
                  case ($nilai <= 90 && $nilai >= 71) ?>
                    <span class="badge text-bg-warning">Cukup</span> <span class="badge text-bg-success"> 6 Bulan</span> 
                  <?php break; 
                  case ($nilai <= 70 && $nilai >= 50) ?>
                    <span class="badge text-bg-danger">Kurang</span> <span class="badge text-bg-warning"> 3 Bulan</span> 
                  <?php break;
                  default:?>
                    <span class="badge text-bg-danger">Kurang sekali</span>
                  <?php } ?>
              </div>
            </div>            
          </div>
          <?php } ?>
        </div>
      <?php endforeach;?>
      <hr></hr>

      <table class="table table-hover" id="dataTableScrollX">
          <thead>
          <tr>
            <th width="20vh">Nama Penguji</th>
            <th width="20vh">Jabatan dan Bagian</th>
            <th class="text-end">WAREHOUSE & LOGICTIC</th>
            <th class="text-end">SUPPLY CHAIN MANAGEMENT</th>
            <th class="text-end">PROJECT MANAGEMENT</th>
            <th class="text-end">INVENTORY CONTROL</th>
            <th class="text-end">REVERSE LOGISTIC MANAGEMENT</th>
            <th class="text-end">WAREHOUSE ADMINISTRATIVE</th>
            <th class="text-end">QUALITY MANAGEMENT</th>
            <th class="text-end">Knowledge of warehouse policies and procedures</th>
            <th class="text-end">5R</th>
            <th class="text-end">Manajemen Rantai Pasok</th>
            <th class="text-end">Inventory Management</th>
            <th class="text-end">Prinsip Lean Manufacturing & Six Sigma</th>
            <th class="text-end">Sistem K3</th>
            <th class="text-end">Jenis Bahan Baku & Bahan Kemas FMCG</th>
            <th class="text-end">Leadership</th>
            <th class="text-end">Achievement and Action</th>
            <th class="text-end">Problem Solving</th>
            <th class="text-end">Business Orientation</th>
            <th class="text-end">Desicion Making</th>
            <th class="text-end">Initiative</th>
            <th class="text-end">Impact and Influence</th>
            <th class="text-end">Relationship Building</th>
            <th class="text-end">Analytical Thinking</th>
            <th class="text-end">Conceptual Thinking</th>
            <th class="text-end">Communication</th>
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
              <?= $jawaban1[0]; ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban1[1]) ? $jawaban1[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban3 = explode('|',$h->parameter3);
              ?>
              <?= $jawaban3[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban3[1]) ? $jawaban3[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban4 = explode('|',$h->parameter4);
              ?>
              <?= $jawaban4[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban4[1]) ? $jawaban4[1] :''  ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban5 = explode('|',$h->parameter5);
              ?>
              <?= $jawaban5[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban5[1]) ? $jawaban5[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban6 = explode('|',$h->parameter6);
              ?>
              <?= $jawaban6[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban6[1]) ? $jawaban6[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban7 = explode('|',$h->parameter7);
              ?>
              <?= $jawaban7[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban7[1]) ? $jawaban7[1] :''?> </p>
              </td>
              
              <td class="text-start"><?php 
              $jawaban8 = explode('|',$h->parameter8);
              ?>
              <?= $jawaban8[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban8[1]) ? $jawaban8[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban9 = explode('|',$h->parameter9);
              ?>
              <?= $jawaban9[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban9[1]) ? $jawaban9[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban10 = explode('|',$h->parameter10);
              ?>
              <?= $jawaban10[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban10[1]) ? $jawaban10[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban11 = explode('|',$h->parameter11);
              ?>
              <?= $jawaban11[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban11[1]) ? $jawaban11[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban12 = explode('|',$h->parameter12);
              ?>
              <?= $jawaban12[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban12[1]) ? $jawaban12[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban13 = explode('|',$h->parameter13);
              ?>
              <?= $jawaban13[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban13[1]) ? $jawaban13[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban14 = explode('|',$h->parameter14);
              ?>
              <?= $jawaban14[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban14[1]) ? $jawaban14[1] :'' ?> </p>
              </td>    

              <td class="text-start"><?php 
              $jawaban15 = explode('|',$h->parameter15);
              ?>
              <?= $jawaban15[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban15[1]) ? $jawaban15[1] :'' ?> </p>
              </td>  

              <td class="text-start"><?php 
              $jawaban16 = explode('|',$h->parameter16);
              ?>
              <?= $jawaban16[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban16[1]) ? $jawaban16[1] :'' ?> </p>
              </td>   

              <td class="text-start"><?php 
              $jawaban17 = explode('|',$h->parameter17);
              ?>
              <?= $jawaban17[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban17[1]) ? $jawaban17[1] :'' ?> </p>
              </td>    

              <td class="text-start"><?php 
              $jawaban18 = explode('|',$h->parameter18);
              ?>
              <?= $jawaban18[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban18[1]) ? $jawaban18[1] :'' ?> </p>
              </td>     

              <td class="text-start"><?php 
              $jawaban19 = explode('|',$h->parameter19);
              ?>
              <?= $jawaban19[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban19[1]) ? $jawaban19[1] :'' ?> </p>
              </td>     

              <td class="text-start"><?php 
              $jawaban20 = explode('|',$h->parameter20);
              ?>
              <?= $jawaban20[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban20[1]) ? $jawaban20[1] :'' ?> </p>
              </td>   

              <td class="text-start"><?php 
              $jawaban21 = explode('|',$h->parameter21);
              ?>
              <?= $jawaban21[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban21[1]) ? $jawaban21[1] :'' ?> </p>
              </td>  

              <td class="text-start"><?php 
              $jawaban22 = explode('|',$h->parameter22);
              ?>
              <?= $jawaban22[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban21[1]) ? $jawaban21[1] :'' ?> </p>
              </td>  

              <td class="text-start"><?php 
              $jawaban23 = explode('|',$h->parameter23);
              ?>
              <?= $jawaban23[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban23[1]) ? $jawaban23[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban24 = explode('|',$h->parameter24);
              ?>
              <?= $jawaban24[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban24[1]) ? $jawaban24[1] :'' ?> </p>
              </td>

              <td class="text-start"><?php 
              $jawaban25 = explode('|',$h->parameter25);
              ?>
              <?= $jawaban25[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban25[1]) ? $jawaban25[1] :'' ?> </p>
              </td>  

              <td class="text-start"><?php 
              $jawaban26 = explode('|',$h->parameter26);
              ?>
              <?= $jawaban26[0] ?>
              <p class="text-secondary-modal">catatan: <?= isset($jawaban26[1]) ? $jawaban26[1] :'' ?> </p>
              </td>                                                                                                                                  
              <td><?= $h->total_nilai ?></td>
              <td><?= $h->kelebihan ?></td>
              <td><?= $h->kekurangan ?></td>
              <!-- <td><?= $h->rekomendasi ?> Bulan</td> -->
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