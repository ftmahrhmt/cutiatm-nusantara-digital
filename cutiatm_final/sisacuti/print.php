<?php
session_start();
if (empty($_SESSION['username'])) { header('Location: ../index.php'); exit; }
if ($_SESSION['username'] === 'admin') { header('Location: ../jadwalcuti/print.php'); exit; }
require '../function/koneksi.php';
include '../function/functionnya.php';
$nik = mysqli_real_escape_string($connect, $_SESSION['username']);
$k = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM karyawan WHERE nik='$nik'"));
$title = 'Laporan Sisa Cuti';
$q = mysqli_query($connect, "SELECT p.*, j.jeniscuti FROM pengajuancuti p LEFT JOIN jeniscuti j ON p.idcuti=j.idcuti WHERE p.nik='$nik' AND LOWER(p.status) IN ('approve','success') ORDER BY p.tanggalmulai DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?php echo $title; ?></title>
<style>
body{font-family:Arial,sans-serif;color:#111827;margin:32px} h1{text-align:center;margin:0 0 6px;font-size:22px} p{text-align:center;margin:0 0 24px;color:#64748b} table{border-collapse:collapse;width:100%;font-size:12px} th,td{border:1px solid #cbd5e1;padding:8px;text-align:left;vertical-align:top} th{background:#f1f5f9;text-transform:uppercase;font-size:11px} .center{text-align:center}.badge{padding:3px 8px;border-radius:12px;background:#eef2ff} @media print{body{margin:16px}.no-print{display:none}}
</style>
</head>
<body>
<div class="no-print" style="text-align:right;margin-bottom:16px"><button onclick="window.print()">Print</button></div>
<h1><?php echo $title; ?></h1>
<p>Nusantara Digital · Dicetak <?php echo date('d/m/Y H:i'); ?></p>

<table style="margin-bottom:18px"><tr><th>NIP</th><td><?php echo e($nik); ?></td><th>Nama</th><td><?php echo e($k ? $k['nama'] : '-'); ?></td><th>Sisa Cuti</th><td><?php echo $k ? (int)$k['sisacuti'] : 0; ?> hari</td></tr></table>
<table>
<thead><tr><th>No</th><th>Jenis</th><th>Mulai</th><th>Selesai</th><th>Lama</th><th>Alasan</th><th>Status</th></tr></thead>
<tbody>
<?php $no=1; if(mysqli_num_rows($q)==0): ?><tr><td colspan="7" class="center">Belum ada riwayat cuti.</td></tr><?php endif; ?>
<?php while($d=mysqli_fetch_array($q)): $selesai=tanggal_selesai_cuti($d['tanggalmulai'],$d['lamacuti']); ?>
<tr><td><?php echo $no++; ?></td><td><?php echo e($d['jeniscuti']?:$d['idcuti']); ?></td><td><?php echo format_tanggal($d['tanggalmulai']); ?></td><td><?php echo format_tanggal($selesai); ?></td><td><?php echo (int)$d['lamacuti']; ?> hari</td><td><?php echo e($d['alasancuti']); ?></td><td><?php echo e($d['status']==='Success'?'Diproses':$d['status']); ?></td></tr>
<?php endwhile; ?>
</tbody></table></body></html>
