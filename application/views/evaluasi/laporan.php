
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
      <div class="d-flex justify-content-start mb-4">
        <a href="<?= base_url('evaluasi/'.$list_data->nama_evaluasi_kategori)?>" class="btn btn-warning"><i class="fa fa-angles-left"></i> kembali</a>
      </div>
      </div>
      <div class="card-body table-responsive no-padding">
        <div class="row">
          <div class="col sm-6">
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Nama Peserta</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?=$list_data->nama_dievaluasi?>">
              </div>
            </div>
            <!-- <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Divisi</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="">
              </div>
            </div> -->
          </div>
        </div>
      <hr></hr>

      <table class="table table-hover" id="dataTableScrollX">
          <thead>
          <tr>
            <th>Nama Penguji</th>
            <?php
            foreach ($soal as $s): 
            ?>
            <th><?=$s->judul?></th>
            <?php endforeach;?>
          </tr>
          </thead>
          <?php
          foreach ($hasil as $h): 
          ?>
          <tbody>
            <tr>
              <td><?= $h->nama_penilai ?></td>
              <?php
              $explode = explode(',',$h->hasil_nilai);
              foreach ($explode as $h_explode){
              $explode_jwb = explode(':',$h_explode);
              ?>
              <td><?= $explode_jwb[1] ?></td>
              <?php } ?>
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