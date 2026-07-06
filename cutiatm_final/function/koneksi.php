<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'dbcuti';

$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$connect) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
mysqli_set_charset($connect, 'utf8');

function koneksi_buka() {
    global $connect;
    // sudah terhubung via $connect global
}
function koneksi_tutup() {
    global $connect;
    // opsional: mysqli_close($connect);
}
?>
