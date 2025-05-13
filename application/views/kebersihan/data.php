<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-4">
          <a href="<?= base_url('kebersihan')?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPengirimanPaket"><i class="fa fa-plus"></i> Tambah Data</button>
        </div>
        <div class="table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Perawatan</th>
            <th>Bukti Perawatan</th>
            <th>Detail Perawatan</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
            foreach($list_data as $data):
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo mediumdate_indo($data->date) ?></td>
            <td><?php echo $data->detail_perawatan ?></td>
            <td>
              <img src="<?= base_url('assets/images/kebersihan/'.$data->bukti_perawatan)?>" width="200px"></td>
          </tr>
          <?php
            endforeach;
          } ?>
          </tbody>
        </table>
        </div>
      </div><!-- /.box-body -->
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addPengirimanPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form id="kamera">
          <input type="hidden" class="form-control" name="pegawai_id" id="pegawai_id" value="<?= $pegawai_id?>">
          <input type="hidden" class="form-control" name="ruangan_id" id="ruangan_id" value="<?= $ruangan_id ?>">
          <div class="d-flex justify-content-center mb-4">
            <div id="my_camera">
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="spesifikasi_barang" class="form-label">Detail Perawatan</label>
            <textarea  class="form-control tabel-PR" name="detail_perawatan" id="detail_perawatan" cols="30" rows="5"></textarea>
          </div> 
          <div class="d-grid gap-2 col-10 mx-auto">
            <button type="submit" class="btn btn-success"> Input</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>

<script language="JavaScript">
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 25,
    constraints: {
      facingMode: 'environment'
    }
  });
  Webcam.attach( '#my_camera' );
</script>
<script type="text/javascript">
  $('#kamera').on('submit', function (event) {
    event.preventDefault();

    Webcam.snap( function(data_uri) {
      save(data_uri);
    });

    function save(data_uri){
      let pegawai_id = document.getElementById("pegawai_id").value;
      let ruangan_id = document.getElementById("ruangan_id").value;
      let detail_perawatan = document.getElementById("detail_perawatan").value;
      $.ajax({
        url: '<?php echo site_url("kebersihan/save");?>',
        type: 'POST',
        dataType: 'json',
        data: {pegawai_id:pegawai_id,ruangan_id:ruangan_id,detail_perawatan:detail_perawatan,bukti_perawatan:data_uri},
      })
      .done(function(data) {
        if (data > 0) {
          alert('insert data sukses');
          location.reload();
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
        location.reload();
      });
    }
  });
</script>