<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function status_badge_class($status) {
    $status = strtolower(trim((string)$status));
    if ($status === 'pending') return 'badge-pending';
    if ($status === 'approve' || $status === 'approved' || $status === 'disetujui' || $status === 'diterima') return 'badge-approve';
    if ($status === 'tolak' || $status === 'reject' || $status === 'rejected' || $status === 'ditolak') return 'badge-reject';
    if ($status === 'success' || $status === 'selesai' || $status === 'proses') return 'badge-selesai';
    return 'badge-pending';
}

function format_tanggal($tanggal) {
    if (!$tanggal || $tanggal === '0000-00-00') return '-';
    $ts = strtotime($tanggal);
    if (!$ts) return e($tanggal);
    return date('d/m/Y', $ts);
}

function tanggal_selesai_cuti($tanggal_mulai, $lama_hari) {
    $lama_hari = max(1, (int)$lama_hari);
    $ts = strtotime($tanggal_mulai);
    if (!$ts) return '-';
    $selesai = strtotime('+' . ($lama_hari - 1) . ' days', $ts);
    return date('Y-m-d', $selesai);
}

function paginate_one($reload, $page, $tpages) {
    $page = max(1, (int)$page);
    $tpages = max(1, (int)$tpages);
    $separator = (strpos($reload, '?') === false) ? '?' : '&';
    $base = $reload;
    $out = "<ul class='pagination'>";
    if ($page > 1) {
        $out .= "<li><a class='pagenya' id='1' href='{$base}{$separator}page=1'>&laquo;</a></li>";
        $prev = $page - 1;
        $out .= "<li><a class='pagenya' id='{$prev}' href='{$base}{$separator}page={$prev}'>&lsaquo;</a></li>";
    } else {
        $out .= "<li><span>&laquo;</span></li><li><span>&lsaquo;</span></li>";
    }
    $out .= "<li><span class='current'>Hal {$page} / {$tpages}</span></li>";
    if ($page < $tpages) {
        $next = $page + 1;
        $out .= "<li><a class='pagenya' id='{$next}' href='{$base}{$separator}page={$next}'>&rsaquo;</a></li>";
        $out .= "<li><a class='pagenya' id='{$tpages}' href='{$base}{$separator}page={$tpages}'>&raquo;</a></li>";
    } else {
        $out .= "<li><span>&rsaquo;</span></li><li><span>&raquo;</span></li>";
    }
    $out .= "</ul>";
    return $out;
}

function sidebar_menu() {
    if (session_id() == '') session_start();
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $nama     = isset($_SESSION['nama']) ? $_SESSION['nama'] : $username;
    $divisi   = isset($_SESSION['divisi']) ? $_SESSION['divisi'] : '';
    $level    = isset($_SESSION['level']) ? $_SESSION['level'] : '';
    $initial  = strtoupper(substr($nama ?: $username, 0, 1));
    $isAdmin  = ($username === 'admin');
    $isHRD    = ($divisi === 'HRD');
?>
<div class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon"><i class="fa-solid fa-calendar-check"></i></div>
    <h2>Cuti Karyawan Nusantara</h2>
    <p>Nusantara Digital</p>
  </div>
  <div class="sidebar-user">
    <div class="user-avatar"><?php echo e($initial ?: '?'); ?></div>
    <div class="user-info">
      <div class="user-name"><?php echo e($nama ?: $username); ?></div>
      <div class="user-level"><?php echo e($isAdmin ? 'Administrator' : ($level ?: $divisi)); ?></div>
    </div>
  </div>
  <nav class="sidebar-nav">
    <?php if ($isAdmin || $isHRD): ?>
    <div class="nav-section-title">Master Data</div>
    <a href="../karyawan/"><i class="fa-solid fa-users"></i> Data Pegawai</a>
    <a href="../jeniscuti/"><i class="fa-solid fa-tags"></i> Jenis Cuti</a>
    <?php endif; ?>

    <div class="nav-section-title">Cuti</div>
    <?php if (!$isAdmin): ?>
    <a href="../pengajuancuti/"><i class="fa-solid fa-paper-plane"></i> Pengajuan Cuti</a>
    <?php endif; ?>
    <a href="../cekpengajuancuti/"><i class="fa-solid fa-magnifying-glass"></i> Cek Pengajuan</a>
    <a href="../jadwalcuti/"><i class="fa-solid fa-calendar-days"></i> Jadwal Cuti</a>
    <?php if (!$isAdmin): ?>
    <a href="../sisacuti/"><i class="fa-solid fa-hourglass-half"></i> Sisa Cuti</a>
    <?php endif; ?>

    <?php if ($isAdmin): ?>
    <div class="nav-section-title">Admin</div>
    <a href="../approval/"><i class="fa-solid fa-circle-check"></i> Approval Cuti</a>
    <a href="../proses/"><i class="fa-solid fa-gears"></i> Proses Cuti</a>
    <?php endif; ?>

    <div class="nav-section-title">Akun</div>
    <a href="../gantipassword/"><i class="fa-solid fa-key"></i> Ganti Password</a>
  </nav>
  <div class="sidebar-footer">
    <a href="../index.php?doLogout=true"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
  </div>
</div>
<?php
}
function menunya() { sidebar_menu(); }
?>
