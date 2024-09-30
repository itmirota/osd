<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th class="text-center">Divisi</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Kehadiran</th>
            <th class="text-center">Pulang</th>
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
              <td><a href="<?= base_url('absensi/laporanDetail/'.$ld->id_pegawai)?>"><?= $ld->nama_pegawai?></td>
              <td class="text-center"><?= $ld->nama_divisi?></td>
              <td class="text-center"><?= mediumdate_indo($ld->date)?></td>
              <td>
                <a href="#" class="pop">
                <img src="<?= base_url('assets/images/absensi/'.$ld->bukti_absensi_in)?>" width="100px" style="border-radius:10px">
                </a><br>
                <i class="fa fa-clock"></i> <?= $ld->time_in?><br>
                <a href="<?= base_url('cekkoordinat/masuk/'.$ld->pegawai_id)?>"><i class="fa fa-location-dot"></i> <?= !empty($ld->wilayah_in) ? $ld->wilayah_in.','.$ld->kota_in : ' lokasi'?></a>
              </td>
              <td>
                <?php if (isset($ld->time_out)){ ?>
                <a href="#" class="pop">
                <img src="<?= base_url('assets/images/absensi/'.$ld->bukti_absensi_out)?>" width="100px" style="border-radius:10px">
                </a><br>
                <i class="fa fa-clock"></i> <?= $ld->time_out?><br>
                <a href="<?= base_url('cekkoordinat/pulang/'.$ld->pegawai_id)?>"><i class="fa fa-location-dot"></i> <?= !empty($ld->wilayah_out) ? $ld->wilayah_out.','.$ld->kota_out : ' lokasi'?></a>
                <?php }else{ ?>
                <span class="badge text-bg-secondary">belum absen</span> 
                <?php } ?>
              </td>
            </tr>
            <?php
            endforeach;
          }
          ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">              
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="imagepreview" style="width: 100%;" >
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
$(function() {
    $('.pop').on('click', function() {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');   
    });		
});
</script>

