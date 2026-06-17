<?php
// Koneksi database
include "koneksi.php";

// Ambil id dari URL
$id = $_GET['id'];

// Query hapus database
$query = "DELETE FROM poli WHERE id_poli='$id'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_poli.php");
	exit;
} else {
	echo "Data gagal dihapus dari database.";
	echo "<br><a href='manage_poli.php'>Kembali</a>";
}
?>
