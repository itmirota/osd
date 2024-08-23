<style>
  .img-judul{
    width:5vh;
  }

  .text-judul h3, .text-date{
    color:#fff;
    font-weight:bold;
  }

  .text-judul p{
    color:#ddd9d9;
  }
</style>
<div class="row mt-4">
  <div class="d-flex justify-content-between">
    <div class="p-2">
      <a href="<?= base_url('satpam')?>" class="btn btn-md btn-secondary"><i class="fas fa-arrow-left"></i> kembali</a>
      <a href="<?= base_url('satpam/perizinan')?>" class="btn btn-md btn-warning"><i class="fa-solid fa-arrows-rotate"></i> refresh</a>
    </div>
    <div class="p-2 d-flex justify-align-items-center">
      <strong class="text-date"><?= longdate_indo(DATE("Y-m-d"))?></strong>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="text-judul mt-2 mb-2">
      <h3 class="m-0">Data Tugas</h3>
      <p class="m-0">List data karyawan yang mendapatkan tugas keluar kantor</p>
    </div>

    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Nama Pegawai</th>
            <th class="text-center">pemberi Tugas</th>
            <th class="text-center">Keperluan</th>
            <th class="text-center">Kendaraan</th>
            <th class="text-center">Waktu Keluar</th>
            <th class="text-center">Waktu Kembali</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_tugas))
          {
            foreach($list_tugas as $lt):
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $lt->nama_pegawai ?> | <?= $lt->nama_divisi ?></td>
            <td><?= $lt->penugasan ?></td>
            <td><?= $lt->rincian_tugas ?></td>
            <td  class="text-center">
              <?php
                if(isset($lt->kendaraan_id)){?>
                  <a href="" onclick="rincianTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal"  data-bs-target="#rincianTugas" class="btn btn-sm btn-primary"> <i class="fas fa-eye"></i></a>
                <?php }else{?>
                <a href="" data-bs-toggle="modal" data-bs-target="#suratTugas" data-idTugas="<?= $lt->id_tugas?>" data-idPegawai="<?= $lt->pegawai_id?>" class="btn btn-sm btn-info"> <i class="fas fa-pencil"></i></a>
                <?php }?>
            </td>
            <td class="text-center"><?= $lt->waktu_tugas?></td>
            <td class="text-center">
              <?php
              switch ($lt->waktu_kembali){
                case(empty($lt->waktu_kembali)):
                  $lt->waktu_kembali;
                break;?>
                <?php default:?>
                <a href="<?= base_url('satpam/saveKembaliTugas/').$lt->id_tugas?>" class="btn btn-sm btn-info"> <i class="fas fa-clock"></i></a>
                <?php break;?>
              <?php }?>
            </td>
          </tr>
            <?php endforeach; } else {?>
          <tr>
            <td class="text-center" colspan="6">tidak ada pegawai yang sedang ditugaskan keluar</td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="text-judul mt-4 mb-2">
      <h3 class="m-0">Data Izin</h3>
      <p class="m-0">List data karyawan yang izin kurang dari 1 hari</p>
    </div>
    <div class="card">
      <div class="card-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Nama Pegawai</th>
            <th>Keperluan</th>
            <th class="text-center">Waktu Keluar</th>
            <th class="text-center">Waktu Kembali</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_izinHarian))
          {
            foreach($list_izinHarian as $ld):
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $ld->nama_pegawai ?> | <?= $ld->nama_divisi ?></td>
            <td><?= $ld->keperluan ?></td>
            <td class="text-center"><?= $ld->waktu_mulai ?></td>
            <td class="text-center">
              <a href="<?= base_url('satpam/saveKembaliIzin/').$ld->id_perizinan_harian?>" class="btn btn-sm btn-info"> <i class="fas fa-clock"></i></a>
            </td>
          </tr>
            <?php endforeach; } else {?>
          <tr>
            <td class="text-center" colspan="6">tidak ada pegawai yang sedang izin keluar</td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<!-- Modal Add Kendaraan -->
<div class="modal fade" id="suratTugas" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pengajuan Surat Tugas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('satpam/pinjamKendaraan')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" readonly class="form-control-plaintext" name="id_tugas" id="id_tugas">
          <input type="hidden" readonly class="form-control-plaintext" name="pegawai_id" id="pegawai_id">
          <div class="mb-3">
            <label for="kendaraan_id" class="form-label">Kendaraan</label>
            <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select tabel-PR" required>
              <option readonly>----- pilih jenis kendaraan ---</option>
              <option value="montor"> Montor</option>
              <option value="mobil"> Mobil</option>
              <option value="0"> Kendaraan Pribadi</option>
            </select>
          </div>
          <div class="mb-3" id="kendaraan">
            <select name="kendaraan_id" id="kendaraan_id" class="form-select tabel-PR">
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Rincian Tugas -->
<div class="modal fade" id="rincianTugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rincianTugas" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApproval">Rincian Kendaraan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 row">
          <label for="kendaraan" class="col-sm-4 col-form-label">Kendaraan</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="kendaraan_tugas">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function rincianTugas($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>suratTugas/rincianTugas/" + $id,
      success : function(hasil){ 
        console.log(hasil);

        kendaraan = hasil.kendaraan_id;
        if(kendaraan == 0){
          kendaraan = "kendaraan pribadi";
        }else{
          kendaraan = hasil.merek_kendaraan+' | '+hasil.nomor_polisi
        };

        document.getElementById("kendaraan_tugas").value = kendaraan;
      }

    });
  };

  const suratTugas = document.getElementById('suratTugas')
  if (suratTugas) {
    suratTugas.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id_tugas = button.getAttribute('data-idTugas');
      const pegawai_id = button.getAttribute('data-idPegawai');
      // If necessary, you could initiate an Ajax request here
      // and then do the updating in a callback.

      // Update the modal's content.
      document.getElementById("id_tugas").value = id_tugas;
      document.getElementById("pegawai_id").value = pegawai_id;

    })
  }
</script>


