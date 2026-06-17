<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$id_poli = $_POST['id_poli'];
$nama_poli = $_POST['nama_poli'];

// Query update database
$query = "UPDATE poli SET nama_poli='$nama_poli' WHERE id_poli='$id_poli'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_poli.php");
	exit;
} else {
	echo "Data gagal diupdate ke database.";
	echo "<br><a href='manage_poli.php'>Kembali</a>";
}
?>
