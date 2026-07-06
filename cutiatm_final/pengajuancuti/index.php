<?php
session_start();
ob_start();
if (empty($_SESSION['username'])) { header('Location: ../index.php'); exit; }
if (isset($_GET['doLogout']) && $_GET['doLogout'] === 'true') { session_destroy(); header('Location: ../index.php'); exit; }
require '../function/koneksi.php';
include '../function/functionnya.php';

if ($_SESSION['username'] === 'admin') { header('Location: ../approval/index.php'); exit; }

$nik  = mysqli_real_escape_string($connect, $_SESSION['username']);
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : $nik;
$row  = mysqli_fetch_assoc(mysqli_query($connect, "SELECT sisacuti FROM karyawan WHERE nik='$nik'"));
$sisacuti = $row ? (int)$row['sisacuti'] : 0;

$idnya  = mysqli_query($connect, "SELECT MAX(idpengajuancuti) as max FROM pengajuancuti WHERE idpengajuancuti LIKE 'PC%'");
$maxRow = mysqli_fetch_array($idnya);
if (!empty($maxRow['max'])) {
    $noUrut = (int) substr($maxRow['max'], 2) + 1;
    $newID  = "PC" . sprintf("%03d", $noUrut);
} else {
    $newID = "PC001";
}
$rs_cuti = mysqli_query($connect, "SELECT * FROM jeniscuti WHERE jeniscuti<>'' ORDER BY idcuti");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Pengajuan Cuti — Sistem Cuti Karyawan</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/modern.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="app-layout">
  <?php sidebar_menu(); ?>
  <div class="main-content">
    <div class="topbar">
      <div class="topbar-title">
        <h1><i class="fa-solid fa-paper-plane" style="color:var(--primary);margin-right:10px"></i>Pengajuan Cuti</h1>
        <p>Ajukan permohonan cuti dan pantau statusnya melalui menu Cek Pengajuan</p>
      </div>
      <div class="topbar-actions">
        <a href="../cekpengajuancuti/" class="btn btn-outline"><i class="fa-solid fa-magnifying-glass"></i> Cek Pengajuan</a>
      </div>
    </div>
    <div class="page-body page-wide">
      <div class="stats-grid" style="margin-bottom:20px">
        <div class="stat-card">
          <div class="stat-icon yellow"><i class="fa-solid fa-hourglass-half"></i></div>
          <div class="stat-info"><div class="stat-value"><?php echo $sisacuti; ?></div><div class="stat-label">Sisa Cuti Saat Ini</div></div>
        </div>
        <div class="stat-card">
          <div class="stat-icon blue"><i class="fa-solid fa-id-card"></i></div>
          <div class="stat-info"><div class="stat-value" style="font-size:18px"><?php echo e($newID); ?></div><div class="stat-label">Nomor Pengajuan Baru</div></div>
        </div>
      </div>
      <div class="card leave-card">
        <div class="card-header">
          <h3>Form Pengajuan Cuti</h3>
          <span style="font-size:12px;color:var(--text-muted)">Isi data dengan lengkap</span>
        </div>
        <div class="card-body">
          <form class="form-horizontal" id="form-pengajuancuti">
            <div class="statusMsg"></div>
            <input type="hidden" name="idpengajuancuti" value="<?php echo e($newID); ?>">
            <div class="form-grid form-grid-2">
              <div class="form-group">
                <label>NIP Karyawan</label>
                <input type="text" class="form-control" name="nik" value="<?php echo e($nik); ?>" readonly>
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo e($nama); ?>" readonly>
              </div>
              <div class="form-group">
                <label>Jenis Cuti</label>
                <select class="form-control" id="idcuti" name="idcuti" required>
                  <?php while($cuti = mysqli_fetch_assoc($rs_cuti)): ?>
                  <option value="<?php echo e($cuti['idcuti']); ?>" data-nama="<?php echo e($cuti['jeniscuti']); ?>"><?php echo e($cuti['jeniscuti']); ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tanggal Pengajuan</label>
                <input type="date" id="tanggalpengajuan" name="tanggalpengajuan" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
              </div>
              <div class="form-group">
                <label>Tanggal Mulai Cuti</label>
                <input type="date" id="tanggalmulai" name="tanggalmulai" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Lama Hari Cuti</label>
                <input type="number" id="lamacuti" name="lamacuti" class="form-control" min="1" max="<?php echo max(1, $sisacuti); ?>" required>
                <small class="form-help">Sistem akan mengurangi sisa cuti setelah cuti diproses admin.</small>
              </div>
            </div>
            <div class="form-group">
              <label>Alasan Cuti</label>
              <textarea class="form-control" name="alasancuti" id="alasancuti" rows="4" placeholder="Tuliskan alasan cuti" required></textarea>
            </div>
            <input type="hidden" name="status" value="Pending">
            <input type="hidden" id="hididecuti" name="hididecuti">
            <div class="mt-3">
              <button type="button" id="form-pengajuancuti-submit" class="btn btn-primary">
  Ajukan Permohonan
</button>
              <button type="reset" class="btn btn-secondary">
               Reset
    </button>
</div>
          </form>
        </div>
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
