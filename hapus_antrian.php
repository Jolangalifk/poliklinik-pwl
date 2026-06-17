<?php
// Koneksi database
include "koneksi.php";

// Ambil id dari URL
$id_daftar = $_GET['id_daftar'];
$tanggal = $_GET['tanggal'];

// Query hapus database
$query = "DELETE FROM daftar WHERE id_daftar='$id_daftar'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_antrian_daftar_pasien.php?tanggal=$tanggal");
	exit;
} else {
	echo "Data gagal dihapus dari database.";
	echo "<br><a href='manage_antrian_daftar_pasien.php?tanggal=$tanggal'>Kembali</a>";
}
?>
