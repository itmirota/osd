
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPerjalananDinas"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Perjalanan Dinas</h3>
      </div><!-- /.box-header -->
      <div class="card-body">
        <div class="table-responsive no-padding">
          <table id="dataTable" class="table table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama Pegawai</th>  
              <th>Tujuan</th>
              <th>Aprroval</th>
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
              <td>
                <strong><p class="m-0">pegawai:</p></strong>
                <p class="m-0"><?= $data->nama_pegawai ?> - <?= $data->nama_jabatan ?></p>
                <p class="m-0"><?= $data->nama_departement ?></p>
              </td>
              <td>
                <p class="m-0"><strong>lokasi tujuan:</strong> <?= $data->tujuan ?></p>
                <p class="m-0"><strong>tanggal berangkat:</strong> <?= mediumdate_indo($data->tgl_berangkat) ?></p>
                <p class="m-0"><strong>tanggal kembali:</strong> <?= mediumdate_indo($data->tgl_kembali) ?></p>
              </td>
              <td></td>
              <td><a href="<?= base_url('perjalanan-dinas/').$data->id_perdin?>">lihat detail</a></td>
            </tr>
            <?php
                }
            }
            ?>
            </tbody>
          </table>
        </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addPerjalananDinas" tabindex="-1" aria-labelledby="addPerjalananDinastLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('perjalananDinas/save')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="pegawai_id" class="form-label">Nama Pegawai</label>
              <select class="form-select" name="pegawai_id" id="pegawai_select2" style="width:100%">
                <option readonly>-- pilih pegawai --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div> 
            <div class="col-md-12">
              <label for="divisi_id" class="form-label">Tujuan Kota</label>
              <input type="text" class="form-control" name="tujuan" placeholder="masukkan tujuan disini">
            </div>
            <div class="col-md-12">
              <label for="nama_bagian" class="form-label">Pengikut</label>
              <select class="form-select" name="pengikut_id" id="pengikut_select2" style="width:100%">
                <option readonly>-- pilih pegawai --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div> 
            <div class="col-md-12">
              <label for="tgl_berangkat" class="form-label">Tanggal Berangkat</label>
              <input type="date" class="form-control" name="tgl_berangkat">
            </div>    
            <div class="col-md-12">
              <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
              <input type="date" class="form-control" name="tgl_kembali">
            </div>  
            <div class="col-md-12">
              <label for="nama_bagian" class="form-label">Alasan Perjalanan</label>
              <select class="form-select" name="alasan_perjalanan" style="width:100%">
                <option readonly>-- pilih alasan --</option>
                <option value="Tugas">Tugas</option>
                <option value="Training">Training</option>
                <option value="Mutasi">Mutasi</option>
              </select>
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

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('bagian/update?id='.$this->uri->segment(2))?>" role="form" id="editbagian" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_bagian" class="form-label">Nama Bagian</label>
              <input type="hidden" name="id_bagian" id="id_bagian" placeholder="Nama Bagian" class="form-control tabel-PR" required />
              <input type="text" name="nama_bagian" id="nama_bagian" placeholder="Nama Bagian" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="divisi_id" class="form-label">Divisi</label>
              <select class="form-select" name="divisi_id" id="divisi_id">
                <option value="0" readonly>-- divisi --</option>
                <?php foreach ($divisi as $d){ ?>
                <option value="<?= $d->id_divisi?>"><?=$d->nama_divisi?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="divisi_id" class="form-label">Departement</label>
              <select class="form-select" name="departement_id" id="departement_id">
                <option value="0" readonly>-- departement --</option>
                <?php foreach ($departement as $d){ ?>
                <option value="<?= $d->id_departement?>"><?=$d->nama_departement?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="kabag_id" class="form-label">Atasan 1</label>
              <select class="form-select js-example-basic-single js-states" name="atasan1" id="atasan1" aria-label="Small select example" style="width: 100%">
                <option value="0">-- Atasan 1 --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nip?> | <?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div>      
            <div class="col-md-12">
              <label for="manager_id" class="form-label">Atasan 2</label>
              <select class="form-select js-example-basic-single js-states" name="atasan2" id="atasan2" aria-label="Small select example" style="width: 100%">
                <option value="0">-- Atasan 2 --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nip?> | <?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
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

<script>

  function editData($id){
    $.ajax({
      url:"<?php echo site_url("bagian/detailbagian")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){

        document.getElementById("id_bagian").value = hasil.id_bagian;
        document.getElementById("nama_bagian").value = hasil.nama_bagian;
        document.getElementById("divisi_id").value = hasil.id_divisi;
        document.getElementById("departement_id").value = hasil.id_departement;
        document.getElementById("atasan1").value = hasil.atasan1;
        const x = document.getElementById("atasan2").value = hasil.atasan2;
        console.log(x);
      }
    });
  }
</script>

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>