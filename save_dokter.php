<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$nama_dokter        = $_POST['nama_dokter'];
$alamat_dokter      = $_POST['alamat_dokter'];
$nohp_dokter        = $_POST['nohp_dokter'];
$keterangan_dokter  = $_POST['keterangan_dokter'];
$id_poli            = $_POST['id_poli'];
$biaya_periksa      = $_POST['biaya_periksa'];

// Folder upload
$folder = "foto/";

// Jika folder belum ada
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

// Ambil data file
$nama_file = $_FILES['foto_dokter']['name'];
$tmp_file  = $_FILES['foto_dokter']['tmp_name'];
$error     = $_FILES['foto_dokter']['error'];

// Cek apakah file dipilih
if ($error == 0) {

    // Ambil ekstensi file
    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    // Format yang diperbolehkan
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($ext, $allowed)) {

        // Buat nama file baru
        $nama_baru = time() . "_" . rand(100,999) . "." . $ext;

        // Lokasi simpan
        $path_simpan = $folder . $nama_baru;

        // Upload file
        if (move_uploaded_file($tmp_file, $path_simpan)) {

            // Query simpan database
            $query = "INSERT INTO dokter 
            (nama_dokter, alamat_dokter, nohp_dokter, keterangan_dokter, id_poli, biaya_periksa, foto_dokter) 
            VALUES 
            ('$nama_dokter', '$alamat_dokter', '$nohp_dokter', '$keterangan_dokter', '$id_poli', '$biaya_periksa', '$nama_baru')";

            $sql = mysqli_query($connect, $query);

            if ($sql) {
                header("Location: manage_dokter.php");
                exit;
            } else {
                echo "Data gagal disimpan ke database.";
            }

        } else {
            echo "Upload foto gagal.";
        }

    } else {
        echo "Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.";
    }

} else {
    echo "Silakan pilih foto terlebih dahulu.";
}
?>