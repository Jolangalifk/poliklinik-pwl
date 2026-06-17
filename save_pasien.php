<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$nama_pasien = $_POST['nama_pasien'];
$alamat_pasien = $_POST['alamat_pasien'];
$noktp_pasien = $_POST['noktp_pasien'];
$nohp_pasien = $_POST['nohp_pasien'];
$norm_pasien = $_POST['norm_pasien'];

// Query simpan database
$query = "INSERT INTO pasien (nama_pasien, alamat_pasien, noktp_pasien, nohp_pasien, norm_pasien) VALUES ('$nama_pasien', '$alamat_pasien', '$noktp_pasien', '$nohp_pasien', '$norm_pasien')";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_pasien.php");
	exit;
} else {
	echo "Data gagal disimpan ke database.";
	echo "<br><a href='tambah_pasien.php'>Kembali</a>";
}
?>
