<style>
   #signature-pad {
      border: 1px solid #ccc;
      width: 100%;
      height: 100%;
   }
</style>

<div class="container">
<?php 
if (is_null($signature)){?>
<div class="mt-4 mb-4 p-3 bg-warning-subtle border-start border-warning border-3 rounded-end">
   <div class="d-flex flex-row justify-content-between">
      <div class="p-2">
         <strong>Perhatian!</strong> pengajuan anda akan diproses ketika sudah melengkapi tanda tangan.
      </div>
      <div class="p-2">
         <button  class="btn btn-md btn-warning" data-bs-toggle="modal" data-bs-target="#addTandaTangan">Tanda tangan </button>
      </div>
   </div>
</div>
<?php } else {?>
<div class="mt-4 mb-4 p-3 bg-info-subtle border-start border-info border-3 rounded-end">
   <div class="d-flex flex-row justify-content-between">
      <div class="p-2">
         <strong>Laporan Anda Diajukan!</strong> pengajuan anda menunggu approval dari atasan.
      </div>
      <!-- <div class="p-2">
         <button  class="btn btn-md btn-warning" data-bs-toggle="modal" data-bs-target="#addTandaTangan">Tanda tangan </button>
      </div> -->
   </div>
</div>
<?php } ?>
</div>

<div class="container col-md-12">
   <div class="card card-primary">
   <div class="card-header">
      <div class="row">
         <div class="d-flex justify-content-between">
            <div class="p-2">
               <h3 class="card-title">Detail Perjalanan Dinas</h3>
            </div>
            <div class="p-2">
               <?php if ($this->uri->segment(1) != 'approve-perjalanan-dinas'){?>
               <a href="<?= base_url("perjalanan-dinas/cetak/".$perdin->id_perdin)?>" class="btn btn-md btn-success"> Cetak</a>
               <?php } ?>
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
            <?php if ($this->uri->segment(1) != 'approve-perjalanan-dinas'){?>
            <button class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#addDetailPerjalanan">Tambah Data</button>
            <?php } ?>
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

      <div class="d-flex justify-content-between">
         <div class="p-2">
            <p>Diajukan Oleh:</p>
            <?php if (isset($signature->signature)){?>
            <img src="<?= base_url('assets/images/signature/'.$signature->signature)?>" width=50% alt="" srcset="">
            <p>Diajukan pada tanggal <?=$signature->Datecreated?></p>
            <?php } ?>
         </div>
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

<!-- Modal -->
<div class="modal fade" id="addTandaTangan" tabindex="-1" aria-labelledby="addTandaTangantLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <div class="d-flex flex-wrap justify-content-between">
         <div>
           <h1 class="modal-title fs-5" id="exampleModalLabel">Approval Perjalanan Dinas</h1>
         </div>
         <div>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
        </div>
      </div>
      <div class="modal-body">
         <div class="p-2">
            <form id="form-signature" action="<?= base_url('perjalananDinas/save_signature') ?>" method="post">
               <canvas id="signature-pad"></canvas>
               <br><br>
               <input type="hidden" name="signature" id="signature">
               <input type="hidden" name="perdin_id" value="<?= $perdin->id_perdin ?>">
               <div class="d-flex justify-content-between">
               <button class="btn btn-md btn-secondary" type="button" id="clear">Clear</button>
               <button class="btn btn-md btn-success" type="submit">Simpan</button>
               </div>
            </form>
         </div>
      </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>

let signaturePad;

$('#addTandaTangan').on('shown.bs.modal', function () {

    const canvas = document.getElementById('signature-pad');

    if (!signaturePad) {

        canvas.width = 500;
        canvas.height = 200;

        signaturePad = new SignaturePad(canvas);

    } else {

        signaturePad.clear();

    }

});

$('#form-signature').on('submit', function(e){

    if (!signaturePad || signaturePad.isEmpty()) {

        alert('Silakan tanda tangan terlebih dahulu');
        e.preventDefault();
        return false;
    }

    $('#signature').val(
        signaturePad.toDataURL('image/png')
    );

});

$('#clear').click(function(){

    if (signaturePad) {
        signaturePad.clear();
    }

});

</script>