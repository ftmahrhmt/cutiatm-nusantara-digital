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
  <title>Data Pegawai — Sistem Cuti Karyawan Nusantara</title>
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
        <h1><i class="fa-solid fa-users" style="color:var(--primary);margin-right:10px"></i>Data Pegawai</h1>
        <p>Kelola data karyawan perusahaan</p>
      </div>
      <div class="topbar-actions"><a href="#dialog-karyawan" id="0" class="btn btn-primary tambah" data-toggle="modal"><i class="fa-solid fa-plus"></i> Tambah Pegawai</a><a href="print.php" class="btn btn-outline"><i class="fa-solid fa-print"></i> Cetak</a></div>
    </div>
    <div class="page-body">
      <div class="gruptest"><input type="text" class="search-input" placeholder="Cari pegawai..." id="keyword" style="width:220px"><button class="btn btn-primary btn-sm" id="btn-search"><i class="fa-solid fa-search"></i> Cari</button><a href="" class="btn btn-outline btn-sm"><i class="fa-solid fa-rotate"></i> Refresh</a></div>
      <div class="card">
        <div class="card-header">
          <h3>Daftar Data Pegawai</h3>
        </div>
        <div class="card-body" style="padding:0">
          <div id="view"><div id="data-karyawan"></div></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="dialog-karyawan" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h3 id="myModalLabel">Data Pegawai</h3>
  </div>
  <div class="modal-body"></div>
  <div class="modal-footer">
    <a class="btn btn-outline" data-dismiss="modal">Batal</a>
    <button id="simpan-karyawan" class="btn btn-primary">Simpan</button>
  </div>
</div>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-1.8.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="aplikasi.js"></script>
<script>
$(function(){
  var p = window.location.pathname;
  $('.sidebar-nav a').each(function(){
    if(p.indexOf($(this).attr('href').replace('..','')) > -1) $(this).addClass('active');
  });
});
</script>
</body></html>
<?php ob_flush(); ?>
