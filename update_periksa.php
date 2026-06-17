<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$id_periksa = $_POST['id_periksa'];
$id_pasien = $_POST['id_pasien'];
$tanggal_periksa = $_POST['tanggal_periksa'];
$keterangan = $_POST['keterangan'];

// Query update database
$query = "UPDATE periksa SET id_pasien='$id_pasien', tanggal_periksa='$tanggal_periksa', keterangan='$keterangan' WHERE id_periksa='$id_periksa'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_periksa.php");
	exit;
} else {
	echo "Data gagal diupdate ke database.";
	echo "<br><a href='manage_periksa.php'>Kembali</a>";
}
?>
