<?php
session_start();
ob_start();
if (empty($_SESSION['username'])) { header('Location: ../index.php'); exit; }
if (isset($_GET['doLogout']) && $_GET['doLogout'] === 'true') { session_destroy(); header('Location: ../index.php'); exit; }
if ($_SESSION['username'] !== 'admin') { header('Location: ../cekpengajuancuti/'); exit; }
require '../function/koneksi.php';
include '../function/functionnya.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Proses Cuti — Sistem Cuti Karyawan</title>
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
        <h1><i class="fa-solid fa-gears" style="color:var(--primary);margin-right:10px"></i>Proses Cuti</h1>
        <p>Data karyawan yang cutinya sudah disetujui dan siap diproses</p>
      </div>
      <div class="topbar-actions"><a href="../jadwalcuti/" class="btn btn-outline"><i class="fa-solid fa-calendar-days"></i> Jadwal Cuti</a></div>
    </div>
    <div class="page-body page-wide">
      <div id="proses-alert" class="statusMsg"></div>
      <div class="card">
        <div class="card-header"><h3>Cuti Disetujui / Sedang Berjalan</h3><span class="card-subtitle">Klik Proses untuk mengurangi sisa cuti sesuai lama hari cuti</span></div>
        <div class="card-body" style="padding:0"><div class="table-responsive"><div id="view"><div id="data-proses"></div></div></div></div>
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
