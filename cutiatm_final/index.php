<?php
session_start();
ob_start();
require 'function/koneksi.php';

if (isset($_GET['doLogout']) && $_GET['doLogout'] === 'true') {
    session_destroy();
    header('Location: index.php'); exit;
}

$error = '';
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connect, trim($_POST['username']));
    $password = mysqli_real_escape_string($connect, trim($_POST['password']));
    $login = mysqli_query($connect, "SELECT * FROM userlogin WHERE username='$username' AND password='$password'");
    if ($login && mysqli_num_rows($login) > 0) {
        $data = mysqli_fetch_array(mysqli_query($connect,
            "SELECT u.username, k.nama, k.divisi, k.level, k.sisacuti
             FROM userlogin u
             LEFT JOIN karyawan k ON u.username = k.nik
             WHERE u.username='$username'"));
        $_SESSION['username'] = $username;
        $_SESSION['status']   = 'login';
        $_SESSION['nama']     = !empty($data['nama']) ? $data['nama'] : ($username === 'admin' ? 'Administrator' : $username);
        $_SESSION['divisi']   = !empty($data['divisi']) ? $data['divisi'] : '';
        $_SESSION['level']    = !empty($data['level']) ? $data['level'] : '';

        if ($username === 'admin') {
            header('Location: approval/index.php'); exit;
        } elseif ($_SESSION['divisi'] === 'HRD') {
            header('Location: karyawan/index.php'); exit;
        } else {
            header('Location: pengajuancuti/index.php'); exit;
        }
    } else {
        $error = 'Username atau password salah. Silahkan coba lagi.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Sistem Cuti Karyawan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/modern.css">
</head>
<body>
<div class="login-wrapper">
  <div class="login-card">
    <div class="login-logo">
      <div class="logo-icon"><i class="fa-solid fa-calendar-check"></i></div>
      <h1>Sistem Cuti Karyawan</h1>
      <p>Nusantara Digital &mdash; Manajemen Cuti Digital</p>
    </div>
    <?php if ($error): ?>
    <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="form-group">
        <label class="form-label"><i class="fa-solid fa-user" style="margin-right:6px;opacity:.6"></i>Username / NIP</label>
        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
      </div>
      <div class="form-group">
        <label class="form-label"><i class="fa-solid fa-lock" style="margin-right:6px;opacity:.6"></i>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
      </div>
      <button type="submit" name="submit" class="btn-login"><i class="fa-solid fa-arrow-right-to-bracket" style="margin-right:8px"></i>Masuk</button>
    </form>
    <p style="text-align:center;margin-top:24px;color:rgba(255,255,255,.35);font-size:12px;">&copy; <?php echo date('Y'); ?> Nusantara Digital</p>
  </div>
</div>
</body>
</html>
<?php ob_flush(); ?>
