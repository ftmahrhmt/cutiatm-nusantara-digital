<?php
session_start();
require '../function/koneksi.php';
koneksi_buka();
include '../function/functionnya.php';

$nik = isset($_SESSION['username']) ? mysqli_real_escape_string($connect, $_SESSION['username']) : '';
$sql = "SELECT p.*, j.jeniscuti
        FROM pengajuancuti p
        LEFT JOIN jeniscuti j ON p.idcuti = j.idcuti
        WHERE p.nik='$nik' AND LOWER(p.status) IN ('approve','success')
        ORDER BY p.tanggalmulai DESC, p.idpengajuancuti DESC";
$result = mysqli_query($connect, $sql);
$rpp = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page <= 0) $page = 1;
$tcount = $result ? mysqli_num_rows($result) : 0;
$tpages = $tcount ? ceil($tcount/$rpp) : 1;
$reload = 'sisacuti.data.php';
$count = 0;
$i = ($page-1) * $rpp;
$no = ($page-1) * $rpp + 1;
?>
<table class="table table-condensed table-bordered table-hover data-table">
<thead>
<tr>
  <th style="width:50px">No</th>
  <th>Jenis Cuti</th>
  <th>Tanggal Mulai</th>
  <th>Tanggal Selesai</th>
  <th>Lama Hari</th>
  <th>Alasan</th>
  <th>Status</th>
</tr>
</thead>
<tbody>
<?php if ($tcount == 0): ?>
<tr><td colspan="7" class="empty-state">Belum ada riwayat cuti yang disetujui/diproses.</td></tr>
<?php endif; ?>
<?php while (($count < $rpp) && ($i < $tcount)):
    mysqli_data_seek($result, $i);
    $data = mysqli_fetch_array($result);
    $tglSelesai = tanggal_selesai_cuti($data['tanggalmulai'], $data['lamacuti']);
?>
<tr>
  <td><?php echo $no++; ?></td>
  <td><?php echo e($data['jeniscuti'] ?: $data['idcuti']); ?></td>
  <td><?php echo format_tanggal($data['tanggalmulai']); ?></td>
  <td><?php echo format_tanggal($tglSelesai); ?></td>
  <td style="text-align:center"><?php echo (int)$data['lamacuti']; ?> hari</td>
  <td><?php echo e($data['alasancuti']); ?></td>
  <td><span class="badge <?php echo status_badge_class($data['status']); ?>"><?php echo e($data['status'] === 'Success' ? 'Diproses' : $data['status']); ?></span></td>
</tr>
<?php $i++; $count++; endwhile; ?>
</tbody>
</table>
<div><?php echo paginate_one($reload, $page, $tpages); ?></div>
<?php koneksi_tutup(); ?>
