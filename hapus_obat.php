<?php
// Koneksi database
include "koneksi.php";

// Ambil id dari URL
$id = $_GET['id'];

// Query hapus database
$query = "DELETE FROM obat WHERE id_obat='$id'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_obat.php");
	exit;
} else {
	echo "Data gagal dihapus dari database.";
	echo "<br><a href='manage_obat.php'>Kembali</a>";
}
?>
