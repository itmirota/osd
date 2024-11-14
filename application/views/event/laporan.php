
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportExcel"><i class="fa-solid fa-file-export"></i> Export Excel</a>
  </div>
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body">
        <div class="table-responsive no-padding">
            <table id="dataTable" class="table table-hover">
                <thead>
                <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th class="text-center">Tanggal Registrasi</th>
                <th class="text-center">Jam Kehadiran</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                if(!empty($list_data))
                {
                foreach($list_data as $ld):
                ?>
                <tr>
                    <td><?= $no++?></td>
                    <td>
                    <strong><?= $ld->nama_pegawai?></strong>
                    <hr class="m-0">
                    <span style="font-size:12px"><strong><?= $ld->nama_departement ?>/<?= $ld->nama_divisi ?></strong></span><br>
                    <span style="font-size:12px">NIK: MRT<?= $ld->nip ?></span>
                    </td>
                    <td class="text-center">
                        <span><?= mediumdate_indo(date("Y-m-d",strtotime($ld->datecreated)))?></span><br>
                    </td>
                    <td class="text-center">
                        <span><?= isset($ld->time_attend) ? date("h:i",strtotime($ld->time_attend)) : '-'?></span>
                    </td>
                </tr>
                <?php
                endforeach;
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
<div class="modal fade" id="exportExcel" tabindex="-1" aria-labelledby="exportExcelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exportExcelLabel">Export Excel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-grid gap-2">
          <a href="<?= base_url('DaftarHadir/export_excel')?>" class="btn btn-primary" type="button">Semua Peserta</a>
          <a href="<?= base_url('DaftarHadir/export_excel/1')?>" class="btn btn-primary" type="button">Peserta yang Hadir</a>
        </div>
      </div>
    </div>
  </div>
</div>