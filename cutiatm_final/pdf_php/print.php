<?php ob_start(); ?>
<html>
<head>
	<title>Cetak PDF</title>
	<style>
		table {
			border-collapse:collapse; 
			table-layout:fixed;width: 630px;
		}
		table td {
			word-wrap:break-word;
			width: 20%;
		}
	</style>
</head>
<body>
	
<h1 style="text-align: center;">Data Siswa</h1>
<table border="1" width="100%">
<tr>
	<th>NIK</th>
	<th>Nama</th>
	<th>Jenis Kelamin</th>
	<th>Telepon</th>
	<th>Alamat</th>
</tr>
<?php
// Load file koneksi.php
include "koneksi.php";
 
$query = "SELECT * FROM karyawan"; // Tampilkan semua data gambar
$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
 
if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
    while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
        echo "<tr>";
        echo "<td>".$data['nik']."</td>";
        echo "<td>".$data['nama']."</td>";
        echo "<td>".$data['divisi']."</td>";
        echo "<td>".$data['level']."</td>";
        echo "<td>".$data['sisacuti']."</td>";
        echo "</tr>";
    }
}else{ // Jika data tidak ada
    echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>

</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
        
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Data Siswa.pdf', 'D');
?>
