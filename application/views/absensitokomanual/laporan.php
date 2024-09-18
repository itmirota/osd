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
                            <td class="text-center"><img id="myImg" src="<?= base_url('assets/dokumen_absen_toko/'.$ld->bukti_absensi_toko)?>" width="200px" style="border-radius:15px"></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
    </div>
</div>