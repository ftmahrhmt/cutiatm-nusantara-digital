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
        INNER JOIN karyawan k ON p.nik = k.nik
        LEFT JOIN jeniscuti j ON p.idcuti = j.idcuti
        WHERE LOWER(p.status) IN ('approve','success')
        ORDER BY p.tanggalmulai ASC, p.idpengajuancuti ASC";
$result = mysqli_query($connect, $sql);
$rpp = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page <= 0) $page = 1;
$tcount = $result ? mysqli_num_rows($result) : 0;
$tpages = $tcount ? ceil($tcount/$rpp) : 1;
$reload = 'proses.data.php';
$count = 0;
$i = ($page-1) * $rpp;
$no = ($page-1) * $rpp + 1;
?>
<table class="table table-condensed table-bordered table-hover data-table">
<thead>
<tr>
  <th style="width:50px">No</th>
  <th style="width:110px">ID</th>
  <th style="width:110px">NIP</th>
  <th>Nama</th>
  <th>Jenis</th>
  <th>Mulai</th>
  <th>Selesai</th>
  <th>Lama</th>
  <th>Sisa Saat Ini</th>
  <th>Status</th>
  <th style="width:120px">Aksi</th>
</tr>
</thead>
<tbody>
<?php if ($tcount == 0): ?>
<tr><td colspan="11" class="empty-state">Belum ada data cuti yang disetujui untuk diproses.</td></tr>
<?php endif; ?>
<?php while (($count < $rpp) && ($i < $tcount)):
    mysqli_data_seek($result, $i);
    $data = mysqli_fetch_array($result);
    $status = strtolower($data['status']);
    $tglSelesai = tanggal_selesai_cuti($data['tanggalmulai'], $data['lamacuti']);
?>
<tr>
  <td><?php echo $no++; ?></td>
  <td><strong><?php echo e($data['idpengajuancuti']); ?></strong></td>
  <td><?php echo e($data['nik']); ?></td>
  <td><?php echo e($data['nama']); ?><div class="td-muted"><?php echo e(($data['divisi'] ?: '-') . ' · ' . ($data['level'] ?: '-')); ?></div></td>
  <td><?php echo e($data['jeniscuti'] ?: $data['idcuti']); ?></td>
  <td><?php echo format_tanggal($data['tanggalmulai']); ?></td>
  <td><?php echo format_tanggal($tglSelesai); ?></td>
  <td style="text-align:center"><?php echo (int)$data['lamacuti']; ?> hari</td>
  <td style="text-align:center"><?php echo (int)$data['sisacuti']; ?> hari</td>
  <td><span class="badge <?php echo status_badge_class($data['status']); ?>"><?php echo e($data['status'] === 'Success' ? 'Diproses' : $data['status']); ?></span></td>
  <td>
    <?php if ($status === 'approve'): ?>
    <button type="button" class="btn btn-success btn-sm aksi-proses" data-id="<?php echo e($data['idpengajuancuti']); ?>"><i class="fa-solid fa-check"></i> Proses</button>
    <?php else: ?>
    <span class="td-muted">Selesai</span>
    <?php endif; ?>
  </td>
</tr>
<?php $i++; $count++; endwhile; ?>
</tbody>
</table>
<div><?php echo paginate_one($reload, $page, $tpages); ?></div>
<?php koneksi_tutup(); ob_flush(); ?>
