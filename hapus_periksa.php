<?php
// Koneksi database
include "koneksi.php";

// Ambil id dari URL
$id = $_GET['id'];

// Query hapus database
$query = "DELETE FROM periksa WHERE id_periksa='$id'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_periksa.php");
	exit;
} else {
	echo "Data gagal dihapus dari database.";
	echo "<br><a href='manage_periksa.php'>Kembali</a>";
}
?>
