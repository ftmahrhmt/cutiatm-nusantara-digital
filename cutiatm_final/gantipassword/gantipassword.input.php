<?php
require '../function/koneksi.php';
session_start();

koneksi_buka();

$password  = $_POST['passwordbaru'];
$username  = $_SESSION['username'];

// JALANKAN QUERY + SIMPAN HASILNYA
$update = mysqli_query($connect, "UPDATE userlogin SET password='$password' WHERE username='$username'");

// CEK HASIL
if($update){
    echo "sukses";
} else {
    echo "gagal";
}

koneksi_tutup();
?>