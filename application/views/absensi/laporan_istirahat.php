<div class="row">
    <div class="col-12">
    <div class="card card-primary">
            <div class="card-body table-responsive no-padding">
            <table id="dataTable" class="table table-hover">
                <thead>
                <tr>
                <th>No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Karyawan</th>
                <th class="text-center">Waktu Keluar</th>
                <th class="text-center">Waktu Masuk</th>
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
                    <td class="text-center"><?= $ld->time_out?>
                    </td>
                    <td class="text-center" style="color:<?= ($selisihmasuk > 3600) ? 'red' : 'green' ?>">
                    <?php if (isset($ld->time_in)){ ?>
                    <?= $ld->time_in?>
                    <?php }else{ ?>
                    <span class="badge text-bg-secondary">belum absen</span> 
                    <?php } ?>
                    </td>
                </tr>
                <?php }} ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    </div>
