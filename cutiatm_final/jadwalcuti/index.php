<?php
session_start();
ob_start();
if (empty($_SESSION['username'])) { header('Location: ../index.php'); exit; }
if (isset($_GET['doLogout']) && $_GET['doLogout'] === 'true') { session_destroy(); header('Location: ../index.php'); exit; }
require '../function/koneksi.php';
include '../function/functionnya.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Jadwal Cuti — Sistem Cuti Karyawan</title>
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
        <h1><i class="fa-solid fa-calendar-days" style="color:var(--accent);margin-right:10px"></i>Jadwal Cuti</h1>
        <p>Daftar karyawan yang cutinya sudah disetujui atau sedang berjalan</p>
      </div>
      <div class="topbar-actions"><a href="print.php" target="_blank" class="btn btn-outline"><i class="fa-solid fa-print"></i> Cetak</a></div>
    </div>
    <div class="page-body page-wide">
      <div class="card">
        <div class="card-header"><h3>Jadwal Cuti Karyawan</h3></div>
        <div class="card-body" style="padding:0"><div class="table-responsive"><div id="view"><div id="data-jadwalcuti"></div></div></div></div>
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
