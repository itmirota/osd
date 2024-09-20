<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <strong>Periode:</strong> <?= mediumdate_indo($periodeAwal).' - '.mediumdate_indo($periodeAkhir)?>
                        
                    </div>
                    <div class="p-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#filterAbsenToko">
                        Filter
                        </button>
                        <a href="<?= base_url('laporan-absen-toko')?>" type="button" class="btn btn-warning">
                        Refresh
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="filterAbsenToko" tabindex="-1" aria-labelledby="filterAbsenTokoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?=base_url('laporan-absen-toko')?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            <input type="month" class="form-control" name="periode">
                          </div>
                          <div class="mb-3">
                          <label for="pegawai" class="form-label">Nama Pegawai</label>
                          <select name="id_pegawai" id="pegawai_id" style="width:100%" class="form-select tabel-PR" required>
                            <option value="0">----- pilih pegawai ---</option>
                            <?php foreach($pegawai as $ld): ?>
                            <option value="<?= $ld->id_pegawai?>"> <?=$ld->nama_pegawai?></option>
                            <?php endforeach; ?>
                          </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Input</button>
                        </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body table-responsive no-padding">
                <table id="dataTable" class="table table-hover">
                    <thead>
                    <tr>
                        <th width="40px">No</th>
                        <th>Nama Karyawan</th>
                        <th class="text-center">Bukti Absen</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($list_data as $ld){?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $ld->nama_pegawai ?></td>
                            <!-- <td class="text-center">
                                <a href="#" class="pop">
                                <img src="<?= base_url('assets/dokumen_absen_toko/'.$ld->bukti_absensi_toko)?>" width="100px" style="border-radius:5px">
                                </a>
                            </td> -->
                            <td  class="text-center">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#absenToko" onclick= "showDokumen(<?= $ld->id_absen_toko ?>)"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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

    <!-- Modal Detail Hasil Cek-->
    <div class="modal fade" id="absenToko" tabindex="-1" aria-labelledby="absenTokoLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="titleAddPegawai">Absen Toko Manual</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-md-12">
                <div id="dokumen">
                </div>
            </div>
            </div>
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

function showDokumen($id){
    $.ajax({
      url:"<?php echo site_url("AbsensiTokoManual/getDokumen")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil)
        const file = "<?= site_url("assets/dokumen_absen_toko")?>/" + hasil.bukti_absensi_toko;
        document.getElementById("dokumen").innerHTML = '<iframe src="'+ file + '" frameborder="0" style="width:100%; height:400px;" "></iframe>';
      }
    });
  };

  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>