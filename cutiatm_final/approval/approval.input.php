<?php
session_start();
require '../function/koneksi.php';
koneksi_buka();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    exit('Akses ditolak.');
}

// ambil dari POST
if(isset($_POST['approve'])){
    $idpengajuan = $_POST['approve'];
    $statusBaru = 'Approve';
}
else if(isset($_POST['reject'])){
    $idpengajuan = $_POST['reject'];
    $statusBaru = 'Reject';
}
else{
    exit('Request tidak valid');
}

$idpengajuan = mysqli_real_escape_string($connect, trim($idpengajuan));
$approvedBy  = mysqli_real_escape_string($connect, $_SESSION['nama'] ?? 'Administrator');
$tanggalnya  = date('Y-m-d');

// ambil data
$pengajuan = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM pengajuancuti WHERE idpengajuancuti='$idpengajuan'"));
if (!$pengajuan) exit('Data tidak ditemukan');
if (strtolower($pengajuan['status']) !== 'pending') exit('Sudah diproses');

// insert approve log
$maxRow = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(idapprovecuti) as max FROM approvecuti WHERE idapprovecuti LIKE 'AP%'"));
$newID = $maxRow['max'] ? 'AP'.sprintf('%03d', (int)substr($maxRow['max'],2)+1) : 'AP001';

$cek = mysqli_query($connect, "SELECT * FROM approvecuti WHERE idpengajuancuti='$idpengajuan'");
if(mysqli_num_rows($cek) == 0 && $statusBaru == 'Approve'){
    mysqli_query($connect, "INSERT INTO approvecuti 
        (idapprovecuti,idpengajuancuti,tanggalapprove,approveby)
        VALUES('$newID','$idpengajuan','$tanggalnya','$approvedBy')");
}

// update status
$update = mysqli_query($connect, "UPDATE pengajuancuti SET status='$statusBaru' WHERE idpengajuancuti='$idpengajuan'");

echo $update ? 'ok' : mysqli_error($connect);

koneksi_tutup();
?>