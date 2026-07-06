
<?php
session_start();
require '../function/koneksi.php';

$idpengajuancuti = mysqli_real_escape_string($connect, trim(isset($_POST['idpengajuancuti']) ? $_POST['idpengajuancuti'] : ''));
$nik             = mysqli_real_escape_string($connect, trim(isset($_POST['nik']) ? $_POST['nik'] : ''));
$idcuti          = mysqli_real_escape_string($connect, trim(isset($_POST['hididecuti']) && $_POST['hididecuti'] !== '' ? $_POST['hididecuti'] : (isset($_POST['idcuti']) ? $_POST['idcuti'] : '')));
$tanggalajuan    = mysqli_real_escape_string($connect, trim(isset($_POST['tanggalpengajuan']) ? $_POST['tanggalpengajuan'] : ''));
$tanggalmulai    = mysqli_real_escape_string($connect, trim(isset($_POST['tanggalmulai']) ? $_POST['tanggalmulai'] : ''));
$lamacuti        = (int)(isset($_POST['lamacuti']) ? $_POST['lamacuti'] : 0);
$alasancuti      = mysqli_real_escape_string($connect, trim(isset($_POST['alasancuti']) ? $_POST['alasancuti'] : ''));
$status          = 'Pending';

if ($nik !== (isset($_SESSION['username']) ? $_SESSION['username'] : $nik)) {
    exit('Data NIP tidak sesuai dengan akun login.');
}
if ($idpengajuancuti === '' || $nik === '' || $idcuti === '' || $tanggalajuan === '' || $tanggalmulai === '' || $lamacuti <= 0 || $alasancuti === '') {
    exit('Semua field wajib diisi.');
}
if (strtotime($tanggalmulai) < strtotime($tanggalajuan)) {
    exit('Tanggal mulai cuti tidak boleh lebih awal dari tanggal pengajuan.');
}

$cekId = mysqli_query($connect, "SELECT idpengajuancuti FROM pengajuancuti WHERE idpengajuancuti='$idpengajuancuti'");
if ($cekId && mysqli_num_rows($cekId) > 0) {
    exit('ID pengajuan sudah dipakai. Silakan refresh halaman.');
}

$karyawan = mysqli_fetch_assoc(mysqli_query($connect, "SELECT sisacuti FROM karyawan WHERE nik='$nik'"));
if (!$karyawan) {
    exit('Data karyawan tidak ditemukan.');
}
if ($lamacuti > (int)$karyawan['sisacuti']) {
    exit('Lama cuti melebihi sisa cuti yang tersedia.');
}

$query = mysqli_query($connect, "
INSERT INTO pengajuancuti
(idpengajuancuti, nik, idcuti, tanggalpengajuan, tanggalmulai, lamacuti, alasancuti, status)
VALUES
('$idpengajuancuti', '$nik', '$idcuti', '$tanggalajuan', '$tanggalmulai', '$lamacuti', '$alasancuti', '$status')
");

if($query){ echo 'sukses'; } else { echo mysqli_error($connect); }
?>
