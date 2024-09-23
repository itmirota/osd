<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1>Input data Absen toko</h1>
                <div class="row">
                    <div class="col-md-3">
                        <form action="<?=base_url('AbsensiTokoManual/save')?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="mb-3" id="tgl_awal">
                            <label for="tgl_awal" class="form-label">Tanggal</label>
                            <input type="date" name="tgl_awal" class="form-control" required>
                        </div>
                        <div class="mb-3" id="tgl_akhir">
                            <label for="tgl_akhir" class="form-label">s/d</label>
                            <input type="date" name="tgl_akhir" class="form-control" required>
                        </div>
                        <div class="mb-3" id="dokumen">
                            <label for="dokumen" class="form-label">Bukti Absen</label>
                            <input type="file" name="dokumen" class="form-control" required>
                        </div>
                        <div class=" d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Ajukan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body table-responsive no-padding">
                <table id="dataTable" class="table table-hover">
                    <thead>
                    <tr>
                        <th width="40px">No</th>
                        <th  class="text-center">Bukti Absen</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($list_data as $ld){?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="text-center"><img src="<?= base_url('assets/dokumen_absen_toko/'.$ld->bukti_absensi_toko)?>" width="200px" style="border-radius:15px"></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>