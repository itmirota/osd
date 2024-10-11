<style>
  #detail_cuti_khusus, #kuota_cuti, #bukti_cuti{
    display:none;
  }
</style>
<div class="container">
<div class="text-judul mt-2 mb-2">
  <h3 class="m-0">Menu Perizinan</h3>
  <p class="m-0">ajukan perizinanmu disini</p>
</div>

<div class="row mt-4">
  <div class="col-md-6">
    <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <img class="img-menu" src="<?= base_url('assets/images/leave.png')?>">
          </div>
          <div class="flex-grow-1 ms-3">
            <h3 class="m-0"><strong>Pengajuan Cuti</strong></h3>
            <p class="m-0" style="font-size:12px">Menu ini digunakan untuk melakukan pengajuan cuti</p>
          </div>
        </div>
      </div>
    </div>
    </a>
  </div>
  <div class="col-md-6">
    <a href="" data-bs-toggle="modal" data-bs-target="#suratTugas">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <img class="img-menu" src="<?= base_url('assets/images/assignment.png')?>">
          </div>
          <div class="flex-grow-1 ms-3">
            <h3 class="m-0"><strong>Pengajuan Penugasan</strong></h3>
            <p class="m-0" style="font-size:12px">Menu ini digunakan untuk melakukan penginputan surat penugasan</p>
          </div>
        </div>
      </div>
    </div>
    </a>
  </div>
  <div class="col-md-6">
    <a href="" data-bs-toggle="modal" data-bs-target="#izinHarian">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <img class="img-menu" src="<?= base_url('assets/images/izin-1.png')?>">
          </div>
          <div class="flex-grow-1 ms-3">
            <h3 class="m-0"><strong>Pengajuan Izin kuang dari 1 Hari</strong></h3>
            <p class="m-0" style="font-size:12px">Menu ini digunakan untuk melakukan izin tidak lebih dari 1 hari</p>
          </div>
        </div>
      </div>
    </div>
    </a>
  </div>
  <div class="col-md-6">
    <a href="" data-bs-toggle="modal" data-bs-target="#suratIzin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <img class="img-menu" src="<?= base_url('assets/images/izin.png')?>">
          </div>
          <div class="flex-grow-1 ms-3">
            <h3 class="m-0"><strong>Pengajuan Izin</strong></h3>
            <p class="m-0" style="font-size:12px">Menu ini digunakan untuk melakukan pengajuan izin satu hai penuh atau lebih</p>
          </div>
        </div>
      </div>
    </div>
    </a>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="text-judul mt-2 mb-4">
      <h3 class="m-0">List Perizinan</h3>
      <p class="m-0">menampilkan histori perizinan</p>
    </div>
    <div class="card">
      <!-- <div class="tab d-flex">
        <div class="flex-fill d-flex justify-content-center">
          <button class="tablinks active" onclick="openTabs(event, 'cuti')" id="defaultOpen">Cuti</button>
        </div>
        <div class="flex-fill d-flex justify-content-center">
          <button class="tablinks" onclick="openTabs(event, 'surat-tugas')">Surat Tugas</button>
        </div>
        <div class="flex-fill d-flex justify-content-center">
          <button class="tablinks" onclick="openTabs(event, 'izin-harian')">Izin kurang dari 1 hari</button>
        </div>
        <div class="flex-fill d-flex justify-content-center">
          <button class="tablinks" onclick="openTabs(event, 'izin')">Izin</button>
        </div>
        <div class="flex-fill d-flex justify-content-center">
          <button class="tablinks" onclick="openTabs(event, 'approval-cuti')">Approval Cuti</button>
        </div>
      </div> -->

      <div class="d-flex justify-content-end">
        <div class="btn-group m-3">
          <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Pilih Jenis Perizinan
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item tablinks active" onclick="openTabs(event, 'cuti')" id="defaultOpen">Cuti</button></li>
            <li><button class="dropdown-item tablinks" onclick="openTabs(event, 'surat-tugas')">Surat Tugas</button></li>
            <li><button class="dropdown-item tablinks" onclick="openTabs(event, 'izin')">Izin</button></li>
          </ul>
        </div>
      </div>

      <div id="cuti" class="tabcontent table-responsive">
        <table class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jenis Cuti</th>
            <th>Durasi</th>
            <th>Pengganti</th>
            <th class="text-center">Status</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if(!empty($list_cuti))
            {
              foreach($list_cuti as $lc):
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= mediumdate_indo($lc->tgl_mulai)?></td>
              <td><?= $lc->jenis_cuti ?></td>
              <td><?= $lc->selisih+1?> hari</td>
              <td><?= $lc->nama_pegawai?></td>
              <td class="text-center">
                <?php
                switch ($lc->approval){
                  case("N,N,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan pengganti</span>
                  <?php break;?>
                  <?php case("Y,N,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan Kabag</span>
                  <?php break;?>
                  <?php case("Y,Y,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan manager</span>
                  <?php break;?>
                  <?php case("Y,Y,Y"):?>
                  <?php case("Y,N,Y"):?>
                    <span class="badge text-bg-success"> approve</span>
                  <?php break;?>
                  <?php default:?>
                    <span class="badge text-bg-danger"> tidak di approve</span>
                  <?php break;?>
                <?php }?>  
                <a href="" onclick="listApproval(<?= $lc->id_cuti?>)" data-bs-toggle="modal" data-bs-target="#listApproval"><i class="fas fa-eye ms-2"></i></a> 
              </td>
            </tr>
            <?php endforeach; }else{?>
              <td colspan="6" class="text-center"> data cuti kosong </td>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div id="surat-tugas" class="tabcontent table-responsive">
        <table class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal Penugasan</th>
            <th>Nama Pegawai</th>
            <th>pemberi Tugas</th>
            <th>Rincian</th>
            <th class="text-center">Approval</th>
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
            <td><?= mediumdate_indo($lt->tgl_tugas)?></td>
            <td><?= $lt->nama_pegawai ?></td>
            <td><?= $lt->penugasan ?></td>
            <td>
              <a href="" class="btn btn-sm btn-info" onclick="rincianTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#rincianTugas">detail <i class="fas fa-eye ms-2"></i></a>
            </td>
            <td class="text-center">
            <?php
              switch ($lt->approval){
                case("N,N,N"):?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan</span>
                <?php break;?>
                <?php case("Y,N,N"):?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan HRD</span>
                  <a href="" onclick="listApprovalTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApprovalTugas"><i class="fas fa-eye ms-2"></i></a> 
                <?php break;?>
                <?php case("Y,Y,N"):?>
                  <?php if ($lt->kendaraan_id > 0){?>
                  <span class="badge text-bg-warning"> Menunggu persetujuan POOL</span>
                  <a href="" onclick="listApprovalTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApprovalTugas"><i class="fas fa-eye ms-2"></i></a>
                  <?php }else{?>
                    <span class="badge text-bg-success"> Approve</span>
                    <a href="" onclick="listApprovalTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApprovalTugas"><i class="fas fa-eye ms-2"></i></a>
                  <?php }?>
                <?php break;?>
                <?php case("Y,Y,Y"):?>
                  <span class="badge text-bg-success"> approve</span>
                  <a href="" onclick="listApprovalTugas(<?= $lt->id_tugas?>)" data-bs-toggle="modal" data-bs-target="#listApprovalTugas"><i class="fas fa-eye ms-2"></i></a>
                <?php break;?>
                <?php default:?>
                  <span class="badge text-bg-danger"> tidak di approve</span>
                <?php break;?>
              <?php }?>
            </td>
            </tr>
            <?php endforeach; }else{?>
              <td colspan="6" class="text-center"> data tugas kosong </td>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div id="izin-harian" class="tabcontent table-responsive">
        <table class="table table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Keperluan</th>
            <th class="text-center">Durasi</th>
            <th class="text-center">Status</th>
          <tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_izinHarian))
          {
            foreach($list_izinHarian as $lip):
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= mediumdate_indo($lip->tgl_izin)?></td>
            <td><?= $lip->keperluan?></td>
            <td class="text-center"><?= $lip->waktu_mulai ?> - <?= $lip->waktu_akhir ?></td>
            <td class="text-center">
              <?php
                switch ($lip->approval){
                  case("N,N,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan atasan</span>
                  <?php break;?>
                  <?php case("Y,N,N"):?>
                    <span class="badge text-bg-warning"> Menunggu persetujuan HRD</span>
                    <a href="" onclick="listApprovalIzinHarian(<?= $lip->id_perizinan_harian?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzinHarian"><i class="fas fa-eye ms-2"></i></a> 
                  <?php break;?>
                  <?php case("Y,Y,Y"):?>
                  <?php case("Y,Y,N"):?>
                  <?php case("Y,N,Y"):?>
                    <span class="badge text-bg-success"> approve</span>
                    <a href="" onclick="listApprovalIzinHarian(<?= $lip->id_perizinan_harian?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzinHarian"><i class="fas fa-eye ms-2"></i></a> 
                  <?php break;?>
                  <?php default:?>
                    <span class="badge text-bg-danger"> tidak di approve</span>
                    <a href="" onclick="listApprovalIzinHarian(<?= $lip->id_perizinan_harian?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzinHarian"><i class="fas fa-eye ms-2"></i></a> 
                  <?php break;?>
                <?php }?> 
            </td>
          </tr>
          <?php endforeach; }else{?>
            <td colspan="5" class="text-center"> data izin kosong </td>
          <?php } ?>
          </tbody>
        </table>
      </div>

      <div id="izin" class="tabcontent table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Akhir</th>
              <th class="text-center">Durasi</th>
              <th>Keperluan</th>
              <th class="text-center">Status</th>
            <tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if(!empty($list_izin))
            {
              foreach($list_izin as $li):
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= mediumdate_indo($li->tgl_mulai)?></td>
              <td><?= mediumdate_indo($li->tgl_akhir)?></td>
              <td class="text-center"><?= $li->selisih?> Hari</td>
              <td><?= $li->keperluan?></td>
              <td class="text-center">
                <?php
                  switch ($li->approval){
                    case("N,N,N"):?>
                      <span class="badge text-bg-warning"> Menunggu persetujuan atasan</span>
                    <?php break;?>
                    <?php case("Y,N,N"):?>
                    <?php case("N,Y,N"):?>
                      <span class="badge text-bg-warning"> Menunggu persetujuan HRD</span>
                      <a href="" onclick="listApprovalIzin(<?= $li->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
                    <?php break;?>
                    <?php case("Y,Y,Y"):?>
                    <?php case("N,Y,Y"):?>
                      <span class="badge text-bg-success"> approve</span>
                      <a href="" onclick="listApprovalIzin(<?= $li->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
                    <?php break;?>
                    <?php default:?>
                      <span class="badge text-bg-danger"> tidak di approve</span>
                      <a href="" onclick="listApprovalIzin(<?= $li->id_izin?>)" data-bs-toggle="modal" data-bs-target="#listApprovalIzin"><i class="fas fa-eye ms-2"></i></a> 
                    <?php break;?>
                  <?php }?> 
              </td>
            </tr>
            <?php endforeach; }else{?>
              <td colspan="5" class="text-center"> data izin kosong </td>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="text-judul mt-2 mb-4">
      <h3 class="m-0">Approval Cuti</h3>
      <p class="m-0">menampilkan list cuti yang membutuhkan persetujuanmu</p>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>No.</th>
              <th>Tanggal Pengajuan</th>
              <th>Nama Karyawan</th>
              <th class="text-center">Action</th>
            <tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            if(!empty($approval_pengganti))
            {
            foreach($approval_pengganti as $ap):
            ?>
            <tr>
              <td><?= $no++?></td>
              <td><?= mediumdate_indo($ap->tgl_mulai)?></td>
              <td><?= $ap->nama_pegawai ?></td>
              <td class="text-center">
              <?php if($ap->approval === "N,N,N"){?>
              <a href="<?= base_url('approvalPengganti/'.$ap->id_cuti.'/Y') ?>" class="btn btn-sm btn-success"><i class="fa fa-check"></i> approve</a>  
              <a href="<?= base_url('approvalPengganti/'.$ap->id_cuti.'/T') ?>" class="btn btn-sm btn-danger"><i class="fa fa-xmark"></i> tolak</a></td>
              <?php }else{?>
              <span class="badge text-bg-success"> <i class="fa fa-check"></i></span>
              <?php } ?>
            <tr>
            <?php endforeach; }else{?>
              <td colspan="5" class="text-center"> data izin kosong </td>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal list approval -->
<div class="modal fade" id="listApproval" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApproval" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApproval">List Approval</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Status Approval</th>
              <th>Tgl Approval</th>
            </tr>
            </thead>
            <tbody id="list_approval">
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal Add Cuti -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pengajuan Cuti</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('perizinan/simpancuti')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                <select id="jenis_cuti" name="jenis_cuti" class="form-select tabel-PR" required>
                  <option>----- pilih Jenis Cuti ---</option>
                  <option value="tahunan">Cuti Tahunan</option>
                  <option value="khusus">Cuti Khusus</option>
                  <option value="pengganti">Cuti Pengganti Hari</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3" id="kuota_cuti">
                <label for="kuota_cuti" class="form-label">Kuota Cuti</label>
                <div class="col-md-12">
                  <input type="text" class="form-control-plaintext" value="<?=$kuota_cuti?>" >
                </div>
              </div>
              <div class="mb-3" id="detail_cuti_khusus">
                <label for="detail_cuti" class="form-label">Detail Cuti Khusus</label>
                <div class="col-md-12">
                  <select name="detail_cuti" class="form-select tabel-PR" required>
                    <option>----- pilih Detail Cuti Khusus ---</option>
                    <option value="melahirkan">Cuti Melahirkan</option>
                    <option value="duka">Cuti Keluarga Meninggal</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tgl_mulai" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tgl_akhir" required>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <textarea class="form-control" name="keperluan" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="pengganti" class="form-label">tugas dan tanggung jawab diserahkan kepada</label>
            <div class="col-md-12">
              <select name="pengganti" class="form-select tabel-PR" required>
                <option>----- pilih Penggati ---</option>
                <?php foreach($pengganti as $p): ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3"  id="bukti_cuti">
            <label for="bukti_cuti" class="form-label">Bukti Cuti</label>
            <input type="file" name="bukti_cuti" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Ajukan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Add Surat Tugas -->
<div class="modal fade" id="suratTugas" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Pengajuan Surat Tugas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('perizinan/simpanSuratTugas')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label for="penugasan_id" class="form-label">Ditugaskan Oleh:</label>
            <select name="penugasan_id" id="penugasan_id" class="form-select tabel-PR" style="width:100%">
              <option readonly>----- pilih pegawai ---</option>
              <?php foreach($pegawai as $p): ?>
              <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="tgl_tugas" class="form-label">Tanggal</label>
            <input type="datetime-local" class="form-control" name="tgl_tugas">
          </div>
          <div class="mb-3">
            <label for="tempat_tugas" class="form-label">Tempat Tugas</label>
            <input type="text" class="form-control" name="tempat_tugas">
          </div>
          <div class="mb-3">
            <label for="rincian_tugas" class="form-label">Rincian Tugas</label>
            <textarea class="form-control" name="rincian_tugas" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="kendaraan_id" class="form-label">Kendaraan</label>
            <select id="jenis_kendaraan" class="form-select tabel-PR" required>
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
          <button type="submit" class="btn btn-success">Ajukan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal list approval Tugas -->
<div class="modal fade" id="listApprovalTugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApproval" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApproval">List Approval</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Status Approval</th>
              <th>Tgl Approval</th>
            </tr>
            </thead>
            <tbody id="list_approval_tugas">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Rincian Tugas -->
<div class="modal fade" id="rincianTugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rincianTugas" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApproval">Rincian Tugas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 row">
          <label for="tempat_tugas" class="col-sm-4 col-form-label">Tempat Tugas</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="tempat_tugas">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="rincian_tugas" class="col-sm-4 col-form-label">Rincian Tugas</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="rincian_tugas">
          </div>
        </div>
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


<!-- Modal Add Izin Kurang dari 1 Hari -->
<div class="modal fade" id="izinHarian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Izin Pribadi Kurang Dari 1 Hari</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('izinHarian/simpan')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="tgl_izin" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tgl_izin">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="waktu_mulai" class="form-label">Waktu Keluar</label>
                <input type="time" class="form-control" name="waktu_mulai">
              </div>
            </div>
            <div class="mb-3">
              <label for="keperluan" class="form-label">Keperluan</label>
              <textarea class="form-control" name="keperluan" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Ajukan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal list approval Izin Kurang dari 1 Hari -->
<div class="modal fade" id="listApprovalIzinHarian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApprovalIzinHarian" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApproval">List Approval</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Status Approval</th>
              <th>Tgl Approval</th>
            </tr>
            </thead>
            <tbody id="list_approval_izinHarian">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Surat Izin -->
<div class="modal fade" id="suratIzin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Formulir Surat Izin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?=base_url('izin/simpan')?>" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-6 mb-3">
              <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
              <input type="date" class="form-control" name="tgl_mulai">
            </div>
            <div class="col-6 mb-3">
              <label for="tgl_akhir" class="form-label">Tanggal AKhir</label>
              <input type="date" class="form-control" name="tgl_akhir">
            </div>
          </div>
          <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <input type="text" class="form-control" name="keperluan">
          </div>
          <div class="mb-3">
            <label for="pemberi_izin" class="form-label">Sudah Menghubungi</label>
            <div class="col-md-12">
              <select name="pemberi_izin" id="pemberi_izin" style="width:100%" class="form-select tabel-PR" required>
                <option readonly>----- pilih Pegawai ---</option>
                <?php foreach($pegawai as $p): ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="bukti_izin" class="form-label">Bukti Izin</label>
            <input type="file" name="bukti_izin" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Ajukan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal list approval Izin -->
<div class="modal fade" id="listApprovalIzin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="listApprovalIzin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="listApproval">List Approval</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Status Approval</th>
              <th>Tgl Approval</th>
            </tr>
            </thead>
            <tbody id="list_approval_izin">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
// CUTI
  function listApproval($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>perizinan/listApproval/" + $id,
      success : function(hasil){ 
        console.log(hasil);

        let html = '';
        let i;
        for ( i=0; i < hasil.length ; i++){


        switch(hasil[i].status_approval) {
          case "Y":
            code = "success"
            status = "disetujui"
            break;
          default:
            code = "danger"
            status = "tidak"
        }

        html +=
        '<tr>'+
        '<td>'+hasil[i].nama_pegawai+'</td>'+
        '<td><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approval+'</td>'+
        '</tr>';
        }

        $("#list_approval").html(html);
        }

    });
  };


// TUGAS 
  function listApprovalTugas($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>suratTugas/listApprovalTugas/" + $id,
      success : function(hasil){ 
        console.log(hasil);

        let html = '';
        let i;
        for ( i=0; i < hasil.length ; i++){


        switch(hasil[i].status_approval) {
          case "Y":
            code = "success"
            status = "disetujui"
            break;
          default:
            code = "danger"
            status = "tidak"
        }

        html +=
        '<tr>'+
        '<td>'+hasil[i].nama_pegawai+'</td>'+
        '<td class="text-center"><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approvalTugas+'</td>'+
        '</tr>';
        }

        $("#list_approval_tugas").html(html);
        }

    });
  };
  
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


        document.getElementById("tempat_tugas").value = hasil.tempat_tugas;
        document.getElementById("rincian_tugas").value = hasil.rincian_tugas;
        document.getElementById("kendaraan_tugas").value = kendaraan;

      }

    });
  };

// Izin Kurang dari 1 hari 
  function listApprovalIzinHarian($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>izinHarian/listApprovalIzin/" + $id,
      success : function(hasil){ 
        console.log(hasil);

        let html = '';
        let i;
        for ( i=0; i < hasil.length ; i++){


        switch(hasil[i].status_approval) {
          case "Y":
            code = "success"
            status = "disetujui"
            break;
          default:
            code = "danger"
            status = "tidak"
        }

        html +=
        '<tr>'+
        '<td>'+hasil[i].nama_pegawai+'</td>'+
        '<td class="text-center"><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approval+'</td>'+
        '</tr>';
        }

        $("#list_approval_izinHarian").html(html);
        }

    });
  };

// Izin
  function listApprovalIzin($id){ 
    $.ajax({
      type : "POST",
      dataType : "JSON",
      url :  "<?= base_url(); ?>izin/listApprovalIzin/" + $id,
      success : function(hasil){ 
        console.log(hasil);

        let html = '';
        let i;
        for ( i=0; i < hasil.length ; i++){


        switch(hasil[i].status_approval) {
          case "Y":
            code = "success"
            status = "disetujui"
            break;
          default:
            code = "danger"
            status = "tidak"
        }

        html +=
        '<tr>'+
        '<td>'+hasil[i].nama_pegawai+'</td>'+
        '<td class="text-center"><span class="badge text-bg-'+code+'">'+status+'</span></td>'+
        '<td>'+hasil[i].tgl_approval+'</td>'+
        '</tr>';
        }

        $("#list_approval_izin").html(html);
        }

    });
  };


// tabs 
  function openTabs(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  document.getElementById("defaultOpen").click();
</script>


