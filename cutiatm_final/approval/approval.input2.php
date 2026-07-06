<?php
session_start();
require '../function/koneksi.php';
koneksi_buka();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    exit('Akses ditolak. Hanya admin yang dapat menolak cuti.');
}

$idpengajuan = mysqli_real_escape_string($connect, trim(isset($_POST['id']) ? $_POST['id'] : ''));
if ($idpengajuan === '') exit('ID pengajuan tidak valid.');

$pengajuan = mysqli_fetch_assoc(mysqli_query($connect, "SELECT status FROM pengajuancuti WHERE idpengajuancuti='$idpengajuan'"));
if (!$pengajuan) exit('Data pengajuan tidak ditemukan.');
if (strtolower($pengajuan['status']) !== 'pending') exit('Pengajuan ini sudah diproses sebelumnya.');

$update = mysqli_query($connect, "UPDATE pengajuancuti SET status='Tolak' WHERE idpengajuancuti='$idpengajuan'");
echo $update ? 'ok' : mysqli_error($connect);
koneksi_tutup();
?>
