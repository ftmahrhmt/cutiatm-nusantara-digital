<?php
session_start();
if (empty($_SESSION['username'])) { header('Location: ../index.php'); exit; }
if ($_SESSION['username'] !== 'admin') { header('Location: ../cekpengajuancuti/'); exit; }
require '../function/koneksi.php';
include '../function/functionnya.php';
$title = 'Laporan Approval Cuti Pending';
$sql = "SELECT p.*, k.nama, k.divisi, k.level, j.jeniscuti FROM pengajuancuti p LEFT JOIN karyawan k ON p.nik=k.nik LEFT JOIN jeniscuti j ON p.idcuti=j.idcuti WHERE LOWER(p.status)='pending' ORDER BY p.tanggalpengajuan ASC";
$q = mysqli_query($connect, $sql);
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

<table>
<thead><tr><th>No</th><th>ID</th><th>NIP</th><th>Nama</th><th>Jenis</th><th>Pengajuan</th><th>Mulai</th><th>Lama</th><th>Alasan</th><th>Status</th></tr></thead>
<tbody>
<?php $no=1; if(mysqli_num_rows($q)==0): ?><tr><td colspan="10" class="center">Tidak ada data pending.</td></tr><?php endif; ?>
<?php while($d=mysqli_fetch_array($q)): ?>
<tr><td><?php echo $no++; ?></td><td><?php echo e($d['idpengajuancuti']); ?></td><td><?php echo e($d['nik']); ?></td><td><?php echo e($d['nama']); ?><br><small><?php echo e(($d['divisi']?:'-').' · '.($d['level']?:'-')); ?></small></td><td><?php echo e($d['jeniscuti']?:$d['idcuti']); ?></td><td><?php echo format_tanggal($d['tanggalpengajuan']); ?></td><td><?php echo format_tanggal($d['tanggalmulai']); ?></td><td><?php echo (int)$d['lamacuti']; ?> hari</td><td><?php echo e($d['alasancuti']); ?></td><td><?php echo e($d['status']); ?></td></tr>
<?php endwhile; ?>
</tbody></table></body></html>
