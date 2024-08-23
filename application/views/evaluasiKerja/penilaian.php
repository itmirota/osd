<div class="d-flex justify-content-center">
<div class="col-md-12">
  <form action="<?= base_url('evaluasiKerja/savePenilaian/'.$id_evaluasi)?>" role="form" method="post" enctype="multipart/form-data">
  <div class="card p-2">
    <div class="card-header">
    <a href="<?= base_url('evaluasiKerja')?>"><i class="fa fa-arrow-left"></i> kembali</a>
    </div>
    <div class="card-body">
        <div class="form-group">
          <div class="row d-flex justify-content-center">
            <div class="col-8">
              <div class="alert alert-info" role="alert">
              <div class="mb-1 row">
                <label for="no_polisi" class="col-sm-4 col-form-label">Nama Pegawai</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value=": <?= $nama_pegawai ?> | <?= $nama_divisi ?>">
                </div>
              </div>
              <div class="mb-1 row">
                <label for="inputPassword" class="col-sm-4 col-form-label">Penilai</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value=": <?= $name ?>">
                </div>
              </div>
              </div>
              <hr>
              <div class="d-flex justify-content-center alert alert-success" role="alert">
              <div class="col-6 m-4">
                <table class="table table-hover">
                  <thead>
                  <tr>
                    <th colspan="2" class="text-center">Norma Penilaian</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>Baik Sekali</td>
                      <td class="text-center">100 | 90</td>
                    </tr>
                    <tr>
                      <td>Baik</td>
                      <td class="text-center">80 | 70</td>
                    </tr>
                    <tr>
                      <td>Kurang</td>
                      <td class="text-center">60 | 50</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              </div>
            <hr>
              <?php foreach ($list_soal as $ls){ ?>
              <div class="col-md-12">
                <label for="jawaban" class="form-label"><?= $ls->soal?></label>
                <div class="col-1">
                  <input type="text" name="jawaban[]" class="form-control tabel-PR" min="50" required>
                </div>
              </div>
              <?php } ?>
              <div class="col-md-12">
                <label for="kelebihan" class="form-label">Hal yang perlu dipertahankan dari yang bersangkutan (Kelebihan)</label>
                <textarea type="text" name="kelebihan" class="form-control tabel-PR"></textarea>
              </div>
              <div class="col-md-12">
                <label for="kekurangan" class="form-label">Hal yang perlu ditingkatkan dari yang bersangkutan (Kekurangan)</label>
                <textarea type="text" name="kekurangan" class="form-control tabel-PR"></textarea>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="card-footer">
      <div class="col-12 d-flex justify-content-end">
      <button class="btn btn-primary"> Simpan</button>
      </div>
    </div>
  </div>
  </form>
</div>
</div>