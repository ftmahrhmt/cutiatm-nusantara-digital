<?php
session_start();
if (empty($_SESSION['username'])) { header('Location: ../index.php'); exit; }
include "../function/koneksi.php";
$sql = mysqli_query($connect, "SELECT * FROM karyawan ORDER BY nama");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Data Pegawai</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 13px; margin: 30px; color: #000; }
    h2   { text-align:center; margin-bottom:4px; font-size:18px; }
    .sub { text-align:center; color:#555; font-size:12px; margin-bottom:20px; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th { background:#1e1b4b; color:#fff; padding:9px 12px; text-align:left; font-size:12px; }
    td { padding:8px 12px; border-bottom:1px solid #ddd; }
    tr:nth-child(even) td { background:#f8f8f8; }
    .aksi { text-align:center; margin-bottom:20px; }
    @media print { .aksi { display:none; } }
  </style>
</head>
<body>
<div class="aksi">
  <button onclick="window.print()" class="btn btn-success" style="background:#16a34a;color:#fff;border:none;padding:9px 24px;border-radius:6px;font-size:14px;cursor:pointer;margin-right:8px">
    🖨 Cetak Laporan
  </button>
  <a href="index.php" style="background:#6b7280;color:#fff;border:none;padding:9px 20px;border-radius:6px;font-size:14px;text-decoration:none">← Kembali</a>
</div>
<h2>Sistem Cuti Karyawan Nusantara</h2>
<p class="sub">Laporan Data Pegawai &mdash; <?php echo date('d/m/Y H:i'); ?></p>
<table>
  <thead>
    <tr><th>No</th><th>NIP</th><th>Nama</th><th>Divisi</th><th>Level</th><th>Sisa Cuti</th></tr>
  </thead>
  <tbody>
    <?php $no=1; while($d = mysqli_fetch_array($sql)): ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo htmlspecialchars($d['nik']); ?></td>
      <td><?php echo htmlspecialchars($d['nama']); ?></td>
      <td><?php echo htmlspecialchars($d['divisi']); ?></td>
      <td><?php echo htmlspecialchars($d['level']); ?></td>
      <td style="text-align:center"><?php echo (int)$d['sisacuti']; ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</body></html>
