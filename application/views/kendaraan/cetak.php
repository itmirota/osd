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
                <h3 style="margin:0" >Data Kendaraan PT Mirota KSM</h3>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td>
                <p>Data kendaraan roda 4</p>
            </td>
        </tr>
    </table>
    <table class="main-table" border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>No. Polisi</th>
            <th>Merek</th>
            <th>Jenis</th>
            <th>Warna</th>
            <th>Tahun</th>
            <th>Kepemilikan</th>
        </tr>
        <?php
        $no = 1;
        if(!empty($mobil))
        {
            foreach($mobil as $data)
            {
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nomor_polisi ?></td>
            <td><?php echo $data->merek_kendaraan ?></td>
            <td><?php echo $data->jenis_penggunaan ?></td>
            <td><?php echo $data->warna_kendaraan ?></td>
            <td><?php echo $data->tahun ?></td>
            <td><?php echo $data->kepemilikan ?></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>

    <table width="100%">
        <tr>
            <td>
                <p>Data kendaraan roda 2</p>
            </td>
        </tr>
    </table>
    <table class="main-table" border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>No. Polisi</th>
            <th>Merek</th>
            <th>Jenis</th>
            <th>Warna</th>
            <th>Tahun</th>
            <th>Kepemilikan</th>
        </tr>
        <?php
        $no = 1;
        if(!empty($motor))
        {
            foreach($motor as $mtr)
            {
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $mtr->nomor_polisi ?></td>
            <td><?php echo $mtr->merek_kendaraan ?></td>
            <td><?php echo $mtr->jenis_penggunaan ?></td>
            <td><?php echo $mtr->warna_kendaraan ?></td>
            <td><?php echo $mtr->tahun ?></td>
            <td><?php echo $mtr->kepemilikan ?></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
</body>
</html>
