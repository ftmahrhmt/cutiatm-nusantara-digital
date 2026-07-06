<?php
ob_start();
session_start();
require '../function/koneksi.php';
koneksi_buka();
include '../function/functionnya.php';

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    echo '<div class="empty-state">Akses hanya untuk admin.</div>';
    exit;
}

$sql = "SELECT p.*, k.nama, k.divisi, k.level, k.sisacuti, j.jeniscuti
        FROM pengajuancuti p
        LEFT JOIN karyawan k ON p.nik = k.nik
        LEFT JOIN jeniscuti j ON p.idcuti = j.idcuti
        WHERE LOWER(p.status) = 'pending'
        ORDER BY p.tanggalpengajuan ASC, p.idpengajuancuti ASC";
$result = mysqli_query($connect, $sql);
$rpp    = 10;
$page   = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page <= 0) $page = 1;
$tcount = $result ? mysqli_num_rows($result) : 0;
$tpages = $tcount ? ceil($tcount/$rpp) : 1;
$reload = 'approval.data.php';
$count = 0;
$i = ($page - 1) * $rpp;
$no = ($page - 1) * $rpp + 1;
?>
<table class="table table-condensed table-bordered table-hover data-table">
<thead>
<tr>
  <th style="width:50px">No</th>
  <th style="width:110px">ID</th>
  <th style="width:110px">NIP</th>
  <th>Nama</th>
  <th>Jenis Cuti</th>
  <th>Tgl Mulai</th>
  <th>Lama</th>
  <th>Sisa</th>
  <th>Alasan</th>
  <th style="width:170px">Aksi</th>
</tr>
</thead>
<tbody>
<?php if ($tcount == 0): ?>
<tr><td colspan="10" class="empty-state">Tidak ada pengajuan cuti yang menunggu approval.</td></tr>
<?php endif; ?>
<?php while (($count < $rpp) && ($i < $tcount)):
    mysqli_data_seek($result, $i);
    $data = mysqli_fetch_array($result);
    $cukup = ((int)$data['sisacuti'] >= (int)$data['lamacuti']);
?>
<tr>
  <td><?php echo $no++; ?></td>
  <td><strong><?php echo e($data['idpengajuancuti']); ?></strong></td>
  <td><?php echo e($data['nik']); ?></td>
  <td><?php echo e($data['nama'] ?: '-'); ?><div class="td-muted"><?php echo e(($data['divisi'] ?: '-') . ' · ' . ($data['level'] ?: '-')); ?></div></td>
  <td><?php echo e($data['jeniscuti'] ?: $data['idcuti']); ?></td>
  <td><?php echo format_tanggal($data['tanggalmulai']); ?></td>
  <td style="text-align:center"><?php echo (int)$data['lamacuti']; ?> hari</td>
  <td style="text-align:center"><span class="badge <?php echo $cukup ? 'badge-approve' : 'badge-reject'; ?>"><?php echo (int)$data['sisacuti']; ?> hari</span></td>
  <td><?php echo e($data['alasancuti']); ?></td>
  <td>
    <button type="button" class="btn btn-success btn-sm aksi-approve" data-id="<?php echo e($data['idpengajuancuti']); ?>"><i class="fa-solid fa-check"></i> Approve</button>
    <button type="button" class="btn btn-danger btn-sm aksi-tolak" data-id="<?php echo e($data['idpengajuancuti']); ?>"><i class="fa-solid fa-xmark"></i> Reject</button>
  </td>
</tr>
<?php $i++; $count++; endwhile; ?>
</tbody>
</table>
<div><?php echo paginate_one($reload, $page, $tpages); ?></div>
<?php koneksi_tutup(); ob_flush(); ?>
