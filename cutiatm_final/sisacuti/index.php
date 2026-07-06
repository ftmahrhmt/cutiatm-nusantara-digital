<?php
session_start();
ob_start();
if (empty($_SESSION['username'])) { header('Location: ../index.php'); exit; }
if (isset($_GET['doLogout']) && $_GET['doLogout'] === 'true') { session_destroy(); header('Location: ../index.php'); exit; }
if ($_SESSION['username'] === 'admin') { header('Location: ../jadwalcuti/'); exit; }
require '../function/koneksi.php';
include '../function/functionnya.php';
$nik  = mysqli_real_escape_string($connect, $_SESSION['username']);
$row  = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM karyawan WHERE nik='$nik'"));
$nama     = $row ? $row['nama'] : '-';
$divisi   = $row ? $row['divisi'] : '-';
$sisacuti = $row ? (int)$row['sisacuti'] : 0;
$terpakaiRow = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COALESCE(SUM(lamacuti),0) AS total FROM pengajuancuti WHERE nik='$nik' AND LOWER(status)='success'"));
$terpakai = $terpakaiRow ? (int)$terpakaiRow['total'] : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sisa Cuti — Sistem Cuti Karyawan</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/modern.css">
</head>
<body>
<div class="app-layout">
  <?php sidebar_menu(); ?>
  <div class="main-content">
    <div class="topbar">
      <div class="topbar-title">
        <h1><i class="fa-solid fa-hourglass-half" style="color:var(--warning);margin-right:10px"></i>Sisa Cuti</h1>
        <p>Informasi jatah cuti dan riwayat cuti yang disetujui</p>
      </div>
      <div class="topbar-actions"><a href="print.php" target="_blank" class="btn btn-outline"><i class="fa-solid fa-print"></i> Cetak</a></div>
    </div>
    <div class="page-body page-wide">
      <div class="stats-grid" style="margin-bottom:20px">
        <div class="stat-card"><div class="stat-icon yellow"><i class="fa-solid fa-hourglass-half"></i></div><div class="stat-info"><div class="stat-value"><?php echo $sisacuti; ?></div><div class="stat-label">Hari Cuti Tersisa</div></div></div>
        <div class="stat-card"><div class="stat-icon green"><i class="fa-solid fa-calendar-check"></i></div><div class="stat-info"><div class="stat-value"><?php echo $terpakai; ?></div><div class="stat-label">Hari Cuti Terpakai</div></div></div>
        <div class="stat-card"><div class="stat-icon blue"><i class="fa-solid fa-user"></i></div><div class="stat-info"><div class="stat-value" style="font-size:18px"><?php echo e($nama); ?></div><div class="stat-label"><?php echo e($divisi); ?></div></div></div>
      </div>
      <div class="card">
        <div class="card-header"><h3>Riwayat Cuti Disetujui</h3></div>
        <div class="card-body" style="padding:0"><div class="table-responsive"><div id="view"><div id="data-sisacuti"></div></div></div></div>
      </div>
    </div>
  </div>
</div>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="aplikasi.js"></script>
<script>$(function(){var p=window.location.pathname;$('.sidebar-nav a').each(function(){if(p.indexOf($(this).attr('href').replace('..',''))>-1)$(this).addClass('active');});});</script>
</body></html>
<?php ob_flush(); ?>
