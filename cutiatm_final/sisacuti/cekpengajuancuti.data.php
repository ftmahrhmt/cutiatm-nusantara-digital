<?php ob_start(); ?>
<html>
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/style.css" rel="stylesheet" type="text/css">

<?php
// panggil berkas koneksi.php
require '../function/koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();
include '../function/functionnya.php';
$pagenya = isset($_POST['4']) ? intval($_POST['4']) : 0;
$tpages2 = isset($_POST['pagenya']) ? intval($_POST['pagenya']) : 0;
?>

               
<?php
//session_start();
//$niknya=$_SESSION['username'];


if(isset($keyword)){ // Jika veriabel $keyword ada (user telah mengklik tombol search)
			$param = $keyword;
			
			// Buat query untuk menampilkan data siswa berdasarkan NIS / Nama / Jenis Kelamin / Telp / Alamat
			//$sql = $pdo->prepare("SELECT * FROM siswa WHERE nama LIKE :na");
			//$sql->bindParam(':na', $param);
			
			$sql->execute(); // Eksekusi querynya
			$sql ="SELECT * FROM karyawan where nama ='$nama'";
		echo $nik;
		}else{ // Jika user belum mengklik tombol search
			// Buat query untuk menampilkan semua data 
			
			$sql ="SELECT * FROM Pengajuancuti";
		//$sql ="SELECT * FROM Pengajuancuti inner join karyawan on pengajuancuti.nik = pengajuancuti.nik where karyawan.nama ='$nama'";
			//$sql ="SELECT * FROM karyawan";
		}
?>
		
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr>
	<th style="width:20px">No</th>
                <th style="width:100px">Divisi</th>
                <th style="width:60px">NIP</th>
		<th style="width:200px">Nama Pegawai</th>
		<th style="width:140px">Tanggal Mulai Cuti</th>
		<th style="width:120px">Lama Cuti</th>
                <th style="width:180px">Alasan</th>
                <th style="width:120px">Sisa Cuti</th>
		</tr>
</thead>
<tbody>
	<?php 
		$i = 1;
                $y = 1;
		//$query = mysqli_query($connect, "SELECT * FROM cekpengajuancuti");
		//$sql =  "SELECT * FROM cekpengajuancuti ORDER BY nama";
        $result = mysqli_query($connect, $sql);
        //echo $sql;
        //pagination config start
        $rpp = 10; // jumlah record per halaman
        $reload = "#data-sisacuti";
        
        $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
        if($page<=0) $page = 1;  
        $tcount = mysqli_num_rows($result);
        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
      //  $tpages = isset() ?  : 0;
        $count = 0;
        $i = ($page-1)*$rpp;
        $no_urut = ($page-1)*$rpp;
		// tampilkan data mahasiswa selama masih ada
		//while($data = mysqli_fetch_array($result)) {
                        while(($count<$rpp) && ($i<$tcount)) {
                        mysqli_data_seek($result,$i );
                        $data = mysqli_fetch_array($result);

                        ?>
	<tr>
		<td><?php echo $y++ ?></td>
                <td><?php echo $data['divisi'] ?></td>
		<td><?php echo $data['nik'] ?></td>
		<td><?php echo $data['nama'] ?></td>
		<td><?php echo $data['tanggalmulai'] ?></td>
		<td><?php echo $data['lamacuti'] ?></td>
                <td><?php echo $data['alasancuti'] ?></td>
                <td><?php echo $data['sisacuti'] ?></td>
                <?php
                $statusnya = $data['sisacuti'];
                if($statusnya ==" " ){
                ?>
                <td>
			<a href="#dialog-sisacuti" id="<?php echo $data['divisi'] ?>" class="ubah" data-toggle="modal">
				<i class="icon-pencil"></i>
			</a>
			<a href="#" id="ubah" class="hapus">
				<i class="icon-trash"></i>
			</a>
		</td>
                <?php
                
                }
                
                else{
                ?>
                <td>
		</td>
                    
                <?php    
                }
                ?>
	</tr>
	<?php
		$i++;
                $count++;
                
		}
	?>
</tbody>
</table>
    


 <div> <?php echo paginate_one($reload, $page, $tpages); ?></div>
<?php 

// tutup koneksi ke database mysql <form method="post" action="<?php echo $_SERVER['PHP_SELF']; 
koneksi_tutup(); 
?>

</html>
<?php ob_flush(); ?>