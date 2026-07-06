<?php
require '../function/koneksi.php';
koneksi_buka();

// ambil data dari form
$nik_lama       = isset($_POST['id']) ? $_POST['id'] : 0; // nik lama
$nik_baru       = isset($_POST['nik']) ? $_POST['nik'] : '';
$nama           = isset($_POST['nama']) ? $_POST['nama'] : '';
$divisi         = isset($_POST['divisi']) ? $_POST['divisi'] : '';
$levelkaryawan  = isset($_POST['levelkaryawan']) ? $_POST['levelkaryawan'] : '';
$sisacuti       = isset($_POST['sisacuti']) ? $_POST['sisacuti'] : '';

// ================= DELETE =================
if(isset($_POST['hapus'])){
    $hapus = $_POST['hapus'];

    mysqli_query($connect, "DELETE FROM karyawan WHERE nik='$hapus'");
    mysqli_query($connect, "DELETE FROM userlogin WHERE username='$hapus'");
}

// ================= INSERT / UPDATE =================
else {

    // validasi sederhana
    if($nik_baru != "" && $nama != "" && $divisi != ""){

        // ================= INSERT =================
        if($nik_lama == 0){

            $query1 = "INSERT INTO karyawan 
                       VALUES('$nik_baru','$nama','$divisi','$levelkaryawan','$sisacuti')";
            
            $query2 = "INSERT INTO userlogin 
                       VALUES('$nik_baru','123456')";

            mysqli_query($connect, $query1);
            mysqli_query($connect, $query2);

        } 
        
        // ================= UPDATE =================
        else {

            // update karyawan (TERMASUK NIK)
            $query1 = "UPDATE karyawan SET
                        nik='$nik_baru',
                        nama='$nama',
                        divisi='$divisi',
                        level='$levelkaryawan',
                        sisacuti='$sisacuti'
                       WHERE nik='$nik_lama'";

            // update userlogin
            $query2 = "UPDATE userlogin SET
                        username='$nik_baru'
                       WHERE username='$nik_lama'";

            mysqli_query($connect, $query1);
            mysqli_query($connect, $query2);
        }
    }
}

// tutup koneksi
koneksi_tutup();
?>