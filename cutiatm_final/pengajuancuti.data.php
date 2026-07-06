
<html>
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../css/modern.css" rel="stylesheet" type="text/css">
<?php
// panggil berkas koneksi.php
require '../function/koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
include '../function/functionnya.php';

$nik = $_SESSION['username'];
$nama = $_SESSION['nama'];
?>

<form class="form-horizontal" id="form-pengajuancuti">
     <p class="statusMsg"></p>
        <div class="control-group">
		<label class="control-label" for="idpengajuancuti">Id Pengajuan Cuti</label>
		<div class="controls">
			<input type="text" id="idpengajuancuti" class="input-medium" name="idpengajuancuti" value="">
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="nik">NIK</label>
		<div class="controls">
			<input type="text" id="nik" class="input-medium" name="nik" value="test">
		</div>
	</div>
	
    <div class="control-group">
        
	<label class="control-label" for="nama">Nama</label>
		<div class="controls">
	 
			<input type="text" id="nama" class="input-xlarge" name="nama" value="<?php echo $nama ?>">
		</div>
	    </div>

          <div class="control-group">
                <label class="control-label" for="levelkaryawan">Id Cuti</label>
		<div class="controls">
			<!-- <input type="text" id="levelkaryawan" class="input-xlarge" name="levelkaryawan" value="<?php //echo $levelkaryawan ?>"> -->
                    <select class="input-small" name="levelkaryawan">
				    <option value="Staff">CT000</option>';
                                        
			</select>
		</div>
	  </div>
<div class="control-group">
                <label class="control-label" for="tanggalmasuk">Tanggal Pengajuan Cuti</label>
		<div class="controls">
		<!--	<input type="text" id="tanggalmasuk" class="input-xlarge" name="tanggalmasuk" value="<?php //echo $tglmasuk ?>">
	-->	<input type="text" class="datepicker" name="tanggalmasuk" value="<?php echo $tglmasuk ?>">
                </div>
	  </div>
<div class="control-group">
                <label class="control-label" for="tanggalmasuk">Tanggal Mulai Cuti</label>
		<div class="controls">
		<!--	<input type="text" id="tanggalmasuk" class="input-xlarge" name="tanggalmasuk" value="<?php //echo $tglmasuk ?>">
	-->	<input type="text" class="datepicker" name="tanggalmasuk" value="<?php echo $tglmasuk ?>">
                </div>
	  </div>

           <div class="control-group">
                <label class="control-label" for="lamacuti">Lama Hari</label>
		<div class="controls">
			<input type="text" id="lamacuti" class="input-xlarge" name="lamacuti" value="<?php echo $lamacuti ?>">
		</div>
	  </div>
     
                     <div class="control-group">
                <label class="control-label" for="alasancuti">Alasan Cuti</label>
		<div class="controls">
			<input type="text" id="alasancuti" class="input-xlarge" name="alasancuti" value="<?php echo $alasancuti ?>">
		</div>
	  </div>
     
                <div class="control-group">
                <label class="control-label" for="status">Status</label>
		<div class="controls">
			<input type="text" id="status" class="input-xlarge" name="status" value="<?php echo $status ?>">
		</div>
	  </div>
	 <?php

	// $cek_user=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM pengajuancuti WHERE nik='123123'"));
//if ($cek_user > 0) {

//echo '<input type="hidden" id="sisacuti2" class="input-xlarge" name="sisacuti2" value="1">';
//}
?>
</form>
        
   <script src="aplikasi.js"></script>     
        
<?php 

// tutup koneksi ke database mysql <form method="post" action="<?php echo $_SERVER['PHP_SELF']; 
koneksi_tutup(); 
?>

</html>