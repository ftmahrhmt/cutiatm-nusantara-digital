<?php
ob_start();
session_start();
require '../function/koneksi.php';
koneksi_buka();
include '../function/functionnya.php';

$username = isset($_SESSION['username']) ? mysqli_real_escape_string($connect, $_SESSION['username']) : '';
$isAdmin  = ($username === 'admin');

$where = $isAdmin ? "1=1" : "p.nik = '$username'";
$sql = "SELECT p.*, k.nama AS namalengkap, k.divisi, k.level, j.jeniscuti
        FROM pengajuancuti p
        LEFT JOIN karyawan k ON p.nik = k.nik
        LEFT JOIN jeniscuti j ON p.idcuti = j.idcuti
        WHERE $where
        ORDER BY p.tanggalpengajuan DESC, p.idpengajuancuti DESC";
$result = mysqli_query($connect, $sql);
$rpp    = 10;
$page   = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page <= 0) $page = 1;
$tcount = $result ? mysqli_num_rows($result) : 0;
$tpages = $tcount ? ceil($tcount / $rpp) : 1;
$reload = 'cekpengajuancuti.data.php';
$count  = 0;
$i      = ($page - 1) * $rpp;
$no     = ($page - 1) * $rpp + 1;
?>
<table class="table table-condensed table-bordered table-hover data-table">
<thead>
<tr>
  <th style="width:50px">No</th>
  <th style="width:110px">ID</th>
  <?php if ($isAdmin): ?><th style="width:110px">NIP</th><?php endif; ?>
  <th>Nama</th>
  <th>Jenis</th>
  <th>Tgl Pengajuan</th>
  <th>Tgl Mulai</th>
  <th>Lama</th>
  <th>Alasan</th>
  <th>Status</th>
</tr>
</thead>
<tbody>
<?php if ($tcount == 0): ?>
<tr><td colspan="<?php echo $isAdmin ? 10 : 9; ?>" class="empty-state">Belum ada data pengajuan cuti.</td></tr>
<?php endif; ?>
<?php while (($count < $rpp) && ($i < $tcount)):
    mysqli_data_seek($result, $i);
    $data = mysqli_fetch_array($result);
    $status = $data['status'];
?>
<tr>
  <td><?php echo $no++; ?></td>
  <td><strong><?php echo e($data['idpengajuancuti']); ?></strong></td>
  <?php if ($isAdmin): ?><td><?php echo e($data['nik']); ?></td><?php endif; ?>
  <td><?php echo e($data['namalengkap'] ?: $data['nik']); ?><div class="td-muted"><?php echo e(trim(($data['divisi'] ?: '') . ' ' . ($data['level'] ?: ''))); ?></div></td>
  <td><?php echo e($data['jeniscuti'] ?: $data['idcuti']); ?></td>
  <td><?php echo format_tanggal($data['tanggalpengajuan']); ?></td>
  <td><?php echo format_tanggal($data['tanggalmulai']); ?></td>
  <td style="text-align:center"><?php echo (int)$data['lamacuti']; ?> hari</td>
  <td><?php echo e($data['alasancuti']); ?></td>
  <td><span class="badge <?php echo status_badge_class($status); ?>"><?php echo e($status); ?></span></td>
</tr>
<?php $i++; $count++; endwhile; ?>
</tbody>
</table>
<div><?php echo paginate_one($reload, $page, $tpages); ?></div>
<?php koneksi_tutup(); ob_flush(); ?>
