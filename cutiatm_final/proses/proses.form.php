<?php
require '../function/koneksi.php';
koneksi_buka();
include '../function/functionnya.php';
$idpengajuan = mysqli_real_escape_string($connect, isset($_POST['id']) ? $_POST['id'] : '');
$data = mysqli_fetch_array(mysqli_query($connect, "SELECT p.*, k.nama, k.sisacuti, j.jeniscuti FROM pengajuancuti p INNER JOIN karyawan k ON p.nik = k.nik LEFT JOIN jeniscuti j ON p.idcuti=j.idcuti WHERE p.idpengajuancuti='$idpengajuan'"));
?>
<form class="form-horizontal" id="form-proses">
  <?php if (!$data): ?>
  <div class="alert alert-danger">Data cuti tidak ditemukan.</div>
  <?php else: ?>
  <p class="statusMsg"></p>
  <input type="hidden" name="idpengajuan" value="<?php echo e($data['idpengajuancuti']); ?>">
  <div class="form-group"><label>ID Pengajuan</label><input type="text" class="form-control" value="<?php echo e($data['idpengajuancuti']); ?>" readonly></div>
  <div class="form-group"><label>NIP</label><input type="text" class="form-control" value="<?php echo e($data['nik']); ?>" readonly></div>
  <div class="form-group"><label>Nama</label><input type="text" class="form-control" value="<?php echo e($data['nama']); ?>" readonly></div>
  <div class="form-group"><label>Jenis Cuti</label><input type="text" class="form-control" value="<?php echo e($data['jeniscuti'] ?: $data['idcuti']); ?>" readonly></div>
  <div class="form-group"><label>Tanggal Mulai</label><input type="text" class="form-control" value="<?php echo format_tanggal($data['tanggalmulai']); ?>" readonly></div>
  <div class="form-group"><label>Lama Cuti</label><input type="text" class="form-control" value="<?php echo (int)$data['lamacuti']; ?> hari" readonly></div>
  <div class="form-group"><label>Sisa Cuti Saat Ini</label><input type="text" class="form-control" value="<?php echo (int)$data['sisacuti']; ?> hari" readonly></div>
  <?php endif; ?>
</form>
<?php koneksi_tutup(); ?>
