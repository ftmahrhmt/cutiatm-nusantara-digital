<?php
session_start();
require '../function/koneksi.php';
koneksi_buka();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    exit('Akses ditolak. Hanya admin yang dapat memproses cuti.');
}

$idpengajuan = mysqli_real_escape_string($connect, trim(isset($_POST['id']) ? $_POST['id'] : ''));
if ($idpengajuan === '') exit('ID pengajuan tidak valid.');

$q = mysqli_query($connect, "SELECT p.*, k.sisacuti FROM pengajuancuti p INNER JOIN karyawan k ON p.nik = k.nik WHERE p.idpengajuancuti='$idpengajuan'");
$data = mysqli_fetch_assoc($q);
if (!$data) exit('Data cuti tidak ditemukan.');
if (strtolower($data['status']) !== 'approve') exit('Cuti ini tidak bisa diproses karena statusnya bukan Approve.');

$lama = (int)$data['lamacuti'];
$sisa = (int)$data['sisacuti'];
if ($lama <= 0) exit('Lama cuti tidak valid.');
if ($sisa < $lama) exit('Sisa cuti karyawan tidak cukup. Sisa: '.$sisa.' hari, diajukan: '.$lama.' hari.');

$nik = mysqli_real_escape_string($connect, $data['nik']);
$sisaBaru = $sisa - $lama;
$update1 = mysqli_query($connect, "UPDATE karyawan SET sisacuti='$sisaBaru' WHERE nik='$nik'");
$update2 = mysqli_query($connect, "UPDATE pengajuancuti SET status='Success' WHERE idpengajuancuti='$idpengajuan'");

echo ($update1 && $update2) ? 'ok' : mysqli_error($connect);
koneksi_tutup();
?>
