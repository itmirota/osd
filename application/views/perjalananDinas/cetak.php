<!DOCTYPE html>
<html>
<head>
    <title>Laporan PDF</title>
    <style>
    html{
        font-size:12px;
    }
    .header{
        width:100%;
        border-collapse:collapse;
    }
    .info-table {
        width:100%;
        border-collapse:collapse;

    }

    .info-table td{
        padding:10px 4px;
        vertical-align:top;
    }

    .main-table{
        margin : 0 0 10% 0;
    }

    .label{
        font-weight:bold;
    }
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td width="20%">
                <img src="<?= $logo_base64 ?>" width="120" alt="" srcset="">
            </td>
            <td width="80%">
                <h2 style="margin:0">PT Mirota KSM</h2>
                <h3 style="margin:0" >FORM PERJALANAN DINAS</h3>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td>
                <p> Demi kepentingan perusahaan, maka ditugaskan kepada:</p>
            </td>
        </tr>
    </table>
    <table class="info-table">
        <tr>
            <td width="20%" class="label">Nama Pegawai</td>
            <td width="30%"><?= $perdin->nama_petugas ?></td>

            <td width="20%" class="label">Tanggal Berangkat</td>
            <td width="30%"><?= mediumdate_indo($perdin->tgl_berangkat)?></td>
        </tr>

        <tr>
            <td class="label">Departemen</td>
            <td><?= $perdin->nama_departement?></td>

            <td class="label">Tanggal Kembali</td>
            <td><?= mediumdate_indo($perdin->tgl_kembali)?></td>
        </tr>

        <tr>
            <td class="label">Jabatan</td>
            <td><?= $perdin->nama_jabatan?></td>

            <td class="label">Nama Trainer</td>
            <td></td>
        </tr>

        <tr>
            <td class="label">Tujuan</td>
            <td><?= $perdin->tujuan?></td>

            <td class="label">Tema Training</td>
            <td></td>
        </tr>

        <tr>
            <td class="label">Pengikut</td>
            <td><?= $perdin->nama_pengikut?></td>

            <td></td>
            <td></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td>
                <p>Rincian tugas perjalanan dinas:</p>
            </td>
        </tr>
    </table>
    <table class="main-table" border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Tanggal</th>  
            <th>Jam</th>
            <th>Ruwndown Perjalanan</th>
            <th>Lokasi</th>
            <th>Tujuan</th>
        </tr>
        <?php
        $no = 1;
        if(!empty($list_data))
        {
            foreach($list_data as $data)
            {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= mediumdate_indo($data->tanggal) ?></td>
            <td><?= $data->waktu ?></td>
            <td><?= $data->keterangan_perjalanan ?></td>
            <td><?= $data->lokasi ?></td>
            <td><?= $data->tujuan ?></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td align="center" width="50%">
                Penerima Tugas,
            </td>

            <td align="center" width="50%">
                Atasan Langsung
            </td>
        </tr>

        <tr>
            <td align="center" height="50">
                <img src="<?=$ttd_penerima?>" width="100%">
            </td>

            <td align="center">
                <img src="" width="100%">
            </td>
        </tr>

        <tr>
            <td align="center">
                <b><?= $perdin->nama_petugas ?></b>
            </td>

            <td align="center">
                <b><?= $perdin->nama_petugas ?></b>
            </td>
        </tr>
    </table>
</body>
</html>
