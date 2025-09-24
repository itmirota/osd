<form action="<?= base_url('assessment/save_penilaian/'.$id_pegawai) ?>" method="post">
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Penilaian Assessment</h3>
    <div class="mb-3 row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Nama Karyawan</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" value=": <?= $pegawai->nama_pegawai ?>">
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="alert alert-primary" role="alert">
    <p>Form ini untuk menilai value HOPE secara 360 derajat. 360 derajat yang dimaksud adalah peers (satu lini), bawahan/ user, dan atasan.</p>

    <p>Silahkan menilai dengan :</p>
    <p>1. Sesuai faktual</p>
    <p>2. Tidak ada intervensi dari person yang di nilai.</p>
    <p>3. Penilaian bersifat RAHASIA.</p>

    <p><strong>Terima kasih!</strong></p>
    </div>
  </div>
</div>
<?php 
$no = 1;
foreach ($kategori as $kategori) {
$soal = $this->assessment_model->getSoalWhere(['kategori' => $kategori->kategori]);  
?>
<!-- value -->
<?php 
$no_value = 1;
$value = $this->assessment_model->getSoalWhere(['kategori' => $kategori->kategori,'jenis_soal' => 'value' ])->result();  
foreach ($value as $v) { ?>
<div class="card">
  <div class="card-body">
    <div class="alert alert-info" role="alert">
    <strong><?= $no ?>. Value <?= $v->kategori ?></strong>
    <p><?= $v->soal ?></p>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <p>Score untuk value <strong><?= $kategori->kategori ?></strong></p>
    <div class="form-group">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jawaban_<?= $v->id_assessment_soal ?>" value="1">
        <label class="form-check-label">1</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jawaban_<?= $v->id_assessment_soal ?>" value="2">
        <label class="form-check-label">2</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jawaban_<?= $v->id_assessment_soal ?>" value="3">
        <label class="form-check-label">3</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jawaban_<?= $v->id_assessment_soal ?>" value="4">
        <label class="form-check-label">4</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jawaban_<?= $v->id_assessment_soal ?>" value="5">
        <label class="form-check-label">5</label>
      </div>
    </div>
  </div>
</div>
<?php 
$no_value++;
} ?>

<div class="card">
  <div class="card-body">
    <div class="alert alert-info" role="alert">
    <strong>Aspek <?= $kategori->kategori ?></strong>
    <p>Jawablah pernyataan di bawah ini sesuai keadaan yang sebenar-benarnya</p>
      <p>STS : Sangat Tidak Setuju</p>
      <p>TS   : Tidak Setuju</p>
      <p>S     : Setuju</p>
      <p>SS   : Sangat Setuju</p>
    </div>
  </div>
</div>
   
<?php 
$no_aspek=1;
$aspek = $this->assessment_model->getSoalWhere(['kategori' => $kategori->kategori,'jenis_soal' => 'aspek' ])->result();  
foreach ($aspek as $s) { ?>
<div class="card">
  <div class="card-body"> 
    <div class="form-group">
      <p><?= $s->soal ?></p>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="jawaban_<?= $s->id_assessment_soal ?>" value="sts">
        <label class="form-check-label">Sangat Tidak Setuju</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="jawaban_<?= $s->id_assessment_soal ?>" value="ts">
        <label class="form-check-label">Tidak Setuju</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="jawaban_<?= $s->id_assessment_soal ?>" value="s">
        <label class="form-check-label">Setuju</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="jawaban_<?= $s->id_assessment_soal ?>" value="ss">
        <label class="form-check-label">Sangat Setuju</label>
      </div>
    </div>
  </div>
</div>
<?php 
$no_aspek++;
} ?>

<!-- value -->
<?php 
$no++;
} ?>
<div class="card">
  <!-- /.card-header -->
  <div class="card-body">
    <input type="hidden" name="id_pegawai" value="<?= $id_pegawai ?>">
    <!-- <?php foreach ($soal_value as $soal) : ?>
      <div class="form-group">
        <label><?= $soal->soal ?></label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jawaban[<?= $soal->id_assessment_soal ?>]" value="sts" required>
          <label class="form-check-label">Sangat Tidak Setuju</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jawaban[<?= $soal->id_assessment_soal ?>]" value="ts">
          <label class="form-check-label">Tidak Setuju</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jawaban[<?= $soal->id_assessment_soal ?>]" value="s">
          <label class="form-check-label">Setuju</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jawaban[<?= $soal->id_assessment_soal ?>]" value="ss">
          <label class="form-check-label">Sangat Setuju</label>
        </div>
      </div>
    <?php endforeach; ?> -->
  </div>
  <!-- /.card-body -->
</div>
  <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
</form>