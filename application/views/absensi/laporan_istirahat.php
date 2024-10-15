<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <div class="d-flex justify-content-between">
            <div class="p-2">
                <strong>Periode:</strong>   
            </div>
            <div class="p-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#filterAbsenToko">
                Filter
                </button>
                <a href="<?= base_url('export-excel-istirahat/')?>" type="button" class="btn btn-success me-2">
                Export Excel
                </a>
                <a href="<?= base_url('istirahat')?>" type="button" class="btn btn-warning">
                Refresh
                </a>
            </div>
        </div>
        <table id="dataTable" class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Karyawan</th>
              <th class="text-center">Waktu Keluar</th>
              <th class="text-center">Waktu Masuk</th>
              <?php if($role == ROLE_SUPERADMIN){?>
              <th>#</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if(!empty($list_data))
            {
            foreach($list_data as $ld){
            $selisihkeluar  = strtotime($ld->time_out) - strtotime('12:00:00');  
            $selisihmasuk  = strtotime($ld->time_in) - strtotime($ld->time_out);
            ?>
            <tr>
              <td><?= $no++?></td>
              <td class="text-center"><?= mediumdate_indo($ld->date)?></td>
              <td>
                  <strong class="m-0"><?= $ld->nama_pegawai?></strong>
                  <p class="m-0" style="font-size:12px"><?= $ld->nama_departement?>/<?= $ld->nama_divisi?></p>
              </td>
              <td>
                <a href="#" class="pop">
                <img src="<?= base_url('assets/images/istirahat/'.$ld->bukti_out)?>" width="100px" style="border-radius:10px">
                </a><br>    
                <i class="fa fa-clock"></i> <?= $ld->time_out?>
              </td>
              <td style="color:<?= ($selisihmasuk > 3600 | $selisihmasuk < -3600) ? 'red' : 'green' ?>">
                <?php if (isset($ld->time_in)){ ?>
                <a href="#" class="pop">
                <img src="<?= base_url('assets/images/istirahat/'.$ld->bukti_in)?>" width="100px" style="border-radius:10px">
                </a><br>  
                <i class="fa fa-clock"></i> <?= $ld->time_in?>
                <?php }else{ ?>
                <span class="badge text-bg-secondary">belum absen</span> 
                <?php } ?>
              </td>
              <?php if($role == ROLE_SUPERADMIN){?>
              <td><a href="<?= base_url('absensi/hapusIstirahat/'.$ld->id_absensi_istirahat)?>"><i class="fa fa-trash"></i></a></td>
              <?php }?>
            </tr>
            <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
