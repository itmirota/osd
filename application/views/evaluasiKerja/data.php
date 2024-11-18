
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
      <div class="card-header">
      <div class="d-flex justify-content-between mb-4">
        <button class="btn btn-warning" onclick="refresh()"><i class="fa fa-rotate"></i> Refresh</button>
        <a href="<?= base_url('addJadwalEvaluasi')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
      </div>
      </div>
      <?php } ?>
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal evaluasi</th>
            <th>Nama Peserta</th>
            <th>Bagian</th>
            <th>Tujuan Evaluasi</th>
            <th>Tanggal Habis Kontrak</th>
            <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
            <th class="text-center">Edit</th>
            <th class="text-center">Hasil</th>
            <?php } ?>
            <th class="text-center">Penilaian</th>
          </tr>
          </thead>
          <?php
              $no = 1;
              foreach ($list_data as $ld): ?>
          <tbody>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= mediumdate_indo($ld->date) ?></td>
              <td><?= $ld->nama_peserta ?></td>
              <td><?= $ld->bagian ?></td>
              <td> <?= !empty($ld->tujuan_evaluasi) ? "Masa Akhir ".$ld->tujuan_evaluasi : '' ?></td>
              <td><?= mediumdate_indo($ld->tgl_akhir_kontrak) ?></td>
              <?php if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){ ?>
                <td class="text-center">
                <a href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?=$ld->id_evaluasiKerja?>)" ><i class="fa fa-pencil"></i></a> 
                </td>
                <td class="text-center">
                <a href="<?= base_url('hasilEvaluasi/'.$ld->id_evaluasiKerja)?>"><i class="fa fa-eye"></i></a> 
                </td>
              <?php } ?>
              <td class="text-center">
                <div class="">
                <a href="<?= base_url('penilaian/'.$ld->id_evaluasiKerja)?>" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-pencil"></i> penilaian</a>
                </div>
                <!-- <input type="text" value="<?= base_url('penilaian/'.$ld->id_evaluasiKerja)?>" id="myInput">
                <button class="btn btn-sm btn-primary" onclick="myFunction()">Copy link</button> -->
              </td>

            </tr>
          </tbody>
          <?php endforeach; ?>

        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="addDepartementLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('evaluasiKerja/updateJadwalPenilaian')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="card p-2">
          <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="tgl_evaluasi" class="form-label">Tanggal Evaluasi</label>
                    <input type="hidden" name="id_evaluasiKerja" id="id_evaluasiKerja" class="form-control-plaintext tabel-PR" readonly required />
                    <input type="date" name="tgl_evaluasi" id="tgl_evaluasi" class="form-control tabel-PR" required />
                  </div>
                  <div class="col-md-12">
                    <label for="nama_peserta" class="form-label">Nama Karyawan</label>
                    <input type="text" id="nama_peserta" class="form-control-plaintext tabel-PR" readonly required />
                  </div>
                  <div class="col-md-12">
                    <label for="bagian" class="form-label">Bagian</label>
                    <input type="text" id="bagian" class="form-control-plaintext tabel-PR" readonly required />
                  </div>
                  <!-- <div class="col-md-12">
                    <label for="nama_peserta" class="form-label">Nama Karyawan</label>
                    <select name="id_pegawai" id="id_pegawai" class="form-select tabel-PR" required>
                      <option>----- pilih pegawai ---</option>
                      <?php foreach($pegawai as $ld): ?>
                      <option value="<?= $ld->id_pegawai?>"><?=$ld->nip?> | <?=$ld->nama_pegawai?></option>
                      <?php endforeach; ?>
                    </select>
                  </div> -->
                  <div class="col-md-12">
                    <label for="tujuan_evaluasi" class="form-label">Tujuan Evaluasi</label>
                    <select name="tujuan_evaluasi" id="tujuan_evaluasi" class="form-select tabel-PR">
                      <option >---- Tujuan ---</option>
                      <option value="probation">Masa Akhir Probation</option>
                      <option value="kontrak">Masa Akhir Kontrak</option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label for="tgl_evaluasi" class="form-label">Tanggal Habis Kontrak</label>
                    <input type="date" name="tgl_akhir_kontrak" id="tgl_akhir_kontrak" class="form-control tabel-PR" required />
                  </div>
                </div>
              </div>
          </div>
          <div class="card-footer">
            <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-primary"> Update</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  function editData($id){
    $.ajax({
      url:"<?php echo site_url("evaluasiKerja/detailEvaluasiKerja")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil);
        document.getElementById("id_evaluasiKerja").value = hasil.id_evaluasiKerja;
        document.getElementById("nama_peserta").value = hasil.nama_peserta;
        document.getElementById("bagian").value = hasil.bagian;
        document.getElementById("tujuan_evaluasi").value = hasil.tujuan_evaluasi;
        document.getElementById("tgl_evaluasi").value = hasil.tgl_evaluasi;
        document.getElementById("tgl_akhir_kontrak").value = hasil.tgl_akhir_kontrak;
      }
    });
  }

  function refresh(){
    window.location.reload()
  }

  function myFunction() {
    // Get the text field
    var copyText = document.getElementById("myInput");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
    
    // Alert the copied text
    alert("Copied the text: " + copyText.value);
  }
</script>