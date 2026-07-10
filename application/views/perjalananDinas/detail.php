<style>
   #signature-pad {
      border: 1px solid #ccc;
      width: 500px;
      height: 200px;
   }
</style>

<div class="col-md-12">
   <div class="card card-primary">
   <div class="card-header">
      <div class="row">
         <div class="d-flex justify-content-between">
            <div class="p-2">
               <h3 class="card-title">Detail Perjalanan Dinas</h3>
            </div>
            <div class="p-2">
               <a href="<?= base_url("perjalanan-dinas/cetak/".$perdin->id_perdin)?>" class="btn btn-md btn-success"> Cetak</a>
            </div>
         </div>
         <div class="d-flex flex-column col-md-6">
            <div class="mb-3 row">
               <label for="nama" class="col-sm-4 col-form-label">Nama Pegawai</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= $perdin->nama_petugas?>">
               </div>
            </div>
            <div class="mb-3 row">
               <label for="nama" class="col-sm-4 col-form-label">Departemen</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= $perdin->nama_departement?>">
               </div>
            </div>
            <div class="mb-3 row">
               <label for="nama" class="col-sm-4 col-form-label">Jabatan</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= $perdin->nama_jabatan?>">
               </div>
            </div>
            <div class="mb-3 row">
               <label for="nama" class="col-sm-4 col-form-label">Tujuan</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= $perdin->tujuan?>">
               </div>
            </div>
            <div class="mb-3 row">
               <label for="nama" class="col-sm-4 col-form-label">Pengikut</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= $perdin->nama_pengikut?>">
               </div>
            </div>
         </div>
         <div class="d-flex flex-column col-md-6">
            <div class="mb-3 row">
               <label for="tgl_berangkat" class="col-sm-4 col-form-label">Tanggal Berangkat</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= mediumdate_indo($perdin->tgl_berangkat)?>">
               </div>
            </div>
            <div class="mb-3 row">
               <label for="tgl_kembali" class="col-sm-4 col-form-label">Tanggal Kembali</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= mediumdate_indo($perdin->tgl_kembali)?>">
               </div>
            </div>
            <div class="mb-3 row">
               <label for="nama_trainer" class="col-sm-4 col-form-label">Nama Trainer</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= $perdin->nama_trainer?>">
               </div>
            </div>
            <div class="mb-3 row">
               <label for="tema_training" class="col-sm-4 col-form-label">Tema Training</label>
               <div class="col-sm-6">
               <input type="text" readonly class="form-control-plaintext" value="<?= $perdin->tema_training?>">
               </div>
            </div>
         </div>
      </div>
   </div><!-- /.box-header -->
   <div class="card-body">
      <div class="d-flex flex-row justify-content-between">
         <div class="p-2">
               <h3 class="card-title">Rincian Tugas dalam Perjalanan Dinas</h3>
         </div>
         <div class="p-2">
            <button class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#addDetailPerjalanan">Tambah Data</button>
         </div>
      </div>
      <div class="table-responsive no-padding">
         <table id="dataTable" class="table table-hover">
         <thead>
         <tr>
            <th>No</th>
            <th>Tanggal</th>  
            <th>Jam</th>
            <th>Ruwndown Perjalanan</th>
            <th>Lokasi</th>
            <th>Tujuan</th>
            <th>#</th>
         </tr>
         </thead>
         <tbody>
         <?php
         $no = 1;
         if(!empty($list_data))
         {
               foreach($list_data as $data)
               {
         ?>
         <tr>
            <td><?= $no++ ?></td>
            <td><?= mediumdate_indo($data->tanggal) ?></td>
            <td><?= $data->waktu ?></td>
            <td><?= $data->keterangan_perjalanan ?></td>
            <td><?= $data->lokasi ?></td>
            <td><?= $data->tujuan ?></td>
            <td></td>
         </tr>
         <?php
               }
         }
         ?>
         </tbody>
         </table>
      </div>
      <div class="d-flex flex-row justify-content-between">
         <div class="p-2">
            <form action="<?= base_url('perjalananDinas/save_signature') ?>" method="post">
               <canvas id="signature-pad"></canvas>
               <br><br>
               <button type="button" id="clear">Clear</button>
               <button type="submit">Simpan</button>
               <input type="hidden" name="signature" id="signature">
            </form>
         </div>
         <div class="p-2"></div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addDetailPerjalanan" tabindex="-1" aria-labelledby="addDetailPerjalanantLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('perjalananDinas/saveDetail')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Detail</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <!-- <div class="col-md-12">
              <label for="pegawai_id" class="form-label">Nama Pegawai</label>
              <select class="form-select" name="pegawai_id" id="pegawai_select2" style="width:100%">
                <option readonly>-- pilih pegawai --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div>  -->
            <div class="col-md-12">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="datetime-local" class="form-control" name="tanggal">
              <input type="hidden" class="form-control" name="perdin_id" value="<?= $this->uri->segment(2)?>">
            </div> 
            <div class="col-md-12">
              <label for="keterangan_perjalanan" class="form-label">Keterangan Perjalanan</label>
              <textarea class="form-control" name="keterangan_perjalanan"></textarea>
            </div>    
            <div class="col-md-12">
              <label for="lokasi" class="form-label">Lokasi</label>
              <input type="text" class="form-control" name="lokasi">
            </div> 
            <div class="col-md-12">
              <label for="tujuan" class="form-label">Tujuan</label>
              <input type="text" class="form-control" name="tujuan">
            </div>         
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>

const canvas = document.getElementById('signature-pad');

canvas.width = 500;
canvas.height = 200;

const signaturePad = new SignaturePad(canvas, {
    minWidth: 1,
    maxWidth: 3,
    velocityFilterWeight: 10
});

document.querySelector('form').addEventListener('submit', function() {

    if(signaturePad.isEmpty()){
        alert('Tanda tangan masih kosong');
        event.preventDefault();
        return;
    }

    document.getElementById('signature').value =
        signaturePad.toDataURL('image/png');
});

document.getElementById('clear').addEventListener('click', function(){
    signaturePad.clear();
});

</script>