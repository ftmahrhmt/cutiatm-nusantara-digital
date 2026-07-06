<?php

    include 'class.database.php';

    $id = $_GET['id'];
    $db->where('No_Cuti', $id);
    $cuti = $db->read_once('pengajuan');

    $db->where('Id_Jenis_Cuti', $cuti->Id_Jenis_Cuti);
    $jen = $db->read_once('jenis_cuti');

    $db->where('NIK', $cuti->NIK);
    $log = $db->read_once('login');

    function total_days($date1, $date2) {
        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        return abs($days + 1);
    }

?>
<html>
    <head>
        <title>Cetak Cuti</title>
        <style>
            body {
                background: rgb(204,204,204); 
            }
            page[size="A4"] {
                background: white;
                width: 21cm;
                height: 21cm;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            }
            @media print {
                body, page[size="A4"] {
                    margin: 0;
                    box-shadow: 0;
                }
            }
            table {
                border-spacing: 0;
                border-collapse: collapse;
                margin-top: 15px;
                width: 100%;
            }
            table tr th {
                width: 20%;
            }
            table tr td {
                padding: 2px 4px;
                border-bottom: 1px solid #000;
            }
            #header img, #header p, #header h2 { padding: 0 !important; margin: 0 !important; }
            #header img { float: left; }
            #header h2, #header p { position: relative; left: 20px; }
            #letter { margin: 50px }
            #person { margin-left: 0px; }
            #sig { margin-left: 500px; }
            .clear { clear: both; margin: 0; padding: 0; }
        </style>
    </head>
    <body>
        <page size="A4">
            <div id="letter">
                <br /><br />
                <div id="header">
                    <img src="images/logo.png" width="80" />
                    <h2>Politeknik LP3I Jakarta <br />Kampus Depok</h2>
                    <p>Jalan Margonda Raya no. 254 Depok, Jawa Barat</p>
                </div>
                <div class="clear"></div>
                <hr />
                <center><H2>SURAT KETERANGAN CUTI</H2></center>
                <br />
                <br />
                Perihal: Permohonan <?php echo $jen->Jenis_Cuti ?> <span style="float: right">Jakarta, <?php echo date('d M Y'); ?> </span>
                <br />
                <br />
                <br />
                Yang bertanda tangan di bawah ini
                <div id="person">
                    <table style="text-align: left">
                        <tr>
                            <th>Nama</th>
                            <td><?php echo $log->Nama ?></td>
                        </tr>
                         <tr>
                            <th>Jabatan</th>
                            <td><?php echo $log->NIK ?></td>
                        </tr>
                        <tr>
                            <th>Divisi</th>
                            <td><?php echo $cuti->Divisi ?></td>
                        </tr>
                    </table>
                </div>
                <br />
                Dengan ini dinyatakan bahwa karyawan yang bersangkutan telah mengajukan permohonan Cuti <?php echo $jen->Jenis_Cuti ?> untuk tahun <?php echo date('Y', strtotime($cuti->Tanggal_PengajuanCuti)) ?> selama <?php echo $cuti->Jumlah_HariCuti ?> hari, terhitung tanggal <?php echo date('d F Y', strtotime($cuti->Tanggal_PengajuanCuti)) ?> s.d <?php echo date('d F Y', strtotime($cuti->Tanggal_AkhirCuti)) ?><br />
                <br />
                <br />
                <br />
                <br />
                <div id="sig">
                    Hormat saya,
                    <br />
                    <br />
                    <br />
                    <?php echo $log->Nama ?><br />
                    <?php echo $log->NIK ?>
                </div>
            </div>
        </page>
    </body>
<html>