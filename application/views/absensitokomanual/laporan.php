<div class="row">
    <div class="col-md-12">
        <div class="card">
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
                            <td class="text-center">
                                <a href="#" class="pop">
                                <img src="<?= base_url('assets/dokumen_absen_toko/'.$ld->bukti_absensi_toko)?>" width="200px" style="border-radius:15px">
                                </a>
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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
$(function() {
    $('.pop').on('click', function() {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');   
    });		
});
</script>