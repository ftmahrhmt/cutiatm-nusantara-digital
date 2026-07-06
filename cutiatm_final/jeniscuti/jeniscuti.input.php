<?php
require '../function/koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();

// proses menghapus data mahasiswa
//if(isset($_POST['ubah'])) {
   
//$idcuti2	= $_POST['idcuti'];
//	$jeniscuti	= $_POST['jeniscuti'];	
	

  //          mysqli_query($connect, "update jeniscuti set jeniscuti ='$jeniscuti' where idcuti ='c12'")  ;
	
//mysqli_query($connect, "DELETE FROM jeniscuti WHERE idcuti=".$_POST['hapus']);
// mysqli_query($connect, "update jeniscuti set nama='bbba' where idcuti ='3434'")  ;       
//}        
if(isset($_POST['hapus'])) {
$idcutinya	= $_POST['hapus'];
mysqli_query($connect, "DELETE FROM jeniscuti WHERE idcuti='$idcutinya'");
//mysqli_query($connect, "DELETE FROM jeniscuti WHERE idcuti='c12'");




} else {
 //   mysqli_query($connect, "DELETE FROM jeniscuti WHERE idcuti=".$_POST['hapus']);
	// deklarasikan variabel
	$idcuti	= $_POST['id'];
        $idcuti2	= $_POST['idcuti'];
	$jeniscuti	= $_POST['jeniscuti'];	
	// validasi agar tidak ada data yang kosong
	//	mysqli_query($connect, "INSERT INTO jeniscuti VALUES('$idcuti2','$jeniscuti')");
	
        
            if($idcuti == "test") {



			mysqli_query($connect, "INSERT INTO jeniscuti VALUES('$idcuti2','$jeniscuti')");
			$idcuti ="";
                	$jeniscuti ="";
                        
                        echo'<a href="#dialog-jeniscuti" id="" class="btn tambah" data-toggle="modal">';
                } else {
              mysqli_query($connect, "update jeniscuti set jeniscuti ='$jeniscuti' where idcuti ='$idcuti2'")  ;
    	
                 
		}
	
}

// tutup koneksi ke database mysql
koneksi_tutup();

?>
