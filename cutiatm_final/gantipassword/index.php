<?php
session_start();
ob_start();
if (empty($_SESSION['username'])) { header('Location: ../index.php'); exit; }
if (isset($_GET['doLogout']) && $_GET['doLogout'] === 'true') { session_destroy(); header('Location: ../index.php'); exit; }
require '../function/koneksi.php';
include '../function/functionnya.php';
$username = $_SESSION['username'];
$row      = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM userlogin WHERE username='$username'"));
$password = $row['password'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ganti Password — Sistem Cuti Karyawan Nusantara</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/modern.css">
</head>
<body>
  
<div class="app-layout">
  <?php sidebar_menu(); ?>
  <div class="main-content">
    <div class="topbar">
      <div class="topbar-title">
        <h1><i class="fa-solid fa-key" style="color:var(--warning);margin-right:10px"></i>Ganti Password</h1>
        <p>Ubah password akun Anda</p>
      </div>
    </div>
    <div class="page-body">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
              <i class="fa-solid fa-key"></i> Form Ganti Password
            </h5>
          </div>
          <div class="card-body">

            <div class="alert alert-info mb-3">
              <i class="fa-solid fa-circle-info"></i>
              Masukkan password lama untuk verifikasi, lalu masukkan password baru.
            </div>

            <form id="form-gantipassword">
              <input type="hidden" id="passwordnya" name="passwordnya" value="<?php echo htmlspecialchars($password); ?>">

              <div class="mb-3">
                <label class="form-label">Password Lama</label>
                <input type="password" id="passwordlama" name="passwordlama" class="form-control" placeholder="Password lama">
              </div>

              <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" id="passwordbaru" name="passwordbaru" class="form-control" placeholder="Password baru">
              </div>

              <div class="mb-3">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" id="konfirmasipassword" name="konfirmasipassword" class="form-control" placeholder="Ulangi password baru">
              </div>

              <div class="d-grid">
                <button type="button" id="simpan-gantipassword" class="btn btn-primary">
                  <i class="fa-solid fa-save"></i> Simpan Password
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-1.8.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="aplikasi.js"></script>
</body></html>
<?php ob_flush(); ?>
