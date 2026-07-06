<?php ob_start(); ?>
<html>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<?php
require '../function/koneksi.php';
koneksi_buka();
include '../function/functionnya.php';

// tampilkan error biar gampang debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// query data
$sql = "SELECT * FROM Pengajuancuti";
$result = mysqli_query($connect, $sql);

// pagination
$rpp = 10;
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
if($page <= 0) $page = 1;

$tcount = mysqli_num_rows($result);
$tpages = ($tcount) ? ceil($tcount/$rpp) : 1;

$i = ($page-1)*$rpp;
$count = 0;
$no = $i + 1;
?>

<table class="table table-condensed table-bordered table-hover">
<thead>
<tr>
    <th>No</th>
    <th>ID Pengajuan</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Tanggal Mulai</th>
    <th>Lama Cuti</th>
    <th>Alasan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php 
while(($count < $rpp) && ($i < $tcount)) {
    mysqli_data_seek($result, $i);
    $data = mysqli_fetch_array($result);
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['idpengajuancuti'] ?? ''; ?></td>
    <td><?php echo $data['nik'] ?? ''; ?></td>
    <td><?php echo $data['nama'] ?? ''; ?></td>
    <td><?php echo $data['tanggalmulai'] ?? ''; ?></td>
    <td><?php echo $data['lamacuti'] ?? ''; ?></td>
    <td><?php echo $data['alasancuti'] ?? ''; ?></td>
    <td><?php echo $data['status'] ?? ''; ?></td>

    <?php 
    $statusnya = $data['status'] ?? '';
    if($statusnya == "Pending"){
    ?>
    <td>
        <a href="#dialog-cekpengajuancuti" 
           id="<?php echo $data['idpengajuancuti']; ?>" 
           class="ubah" data-toggle="modal">
            ✏️
        </a>
        <a href="#" class="hapus">🗑️</a>
    </td>
    <?php } else { ?>
    <td></td>
    <?php } ?>
</tr>

<?php
    $i++;
    $count++;
}
?>
</tbody>
</table>

<div>
<?php echo paginate_one("#data-pengajuancuti", $page, $tpages); ?>
</div>

<?php
koneksi_tutup();
?>

</html>
<?php ob_flush(); ?>