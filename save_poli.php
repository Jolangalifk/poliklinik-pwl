<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$nama_poli = $_POST['nama_poli'];

// Query simpan database
$query = "INSERT INTO poli (nama_poli) VALUES ('$nama_poli')";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_poli.php");
	exit;
} else {
	echo "Data gagal disimpan ke database.";
	echo "<br><a href='tambah_poli.php'>Kembali</a>";
}
?>
