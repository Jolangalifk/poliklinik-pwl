<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$id_pasien = $_POST['id_pasien'];
$tanggal_periksa = $_POST['tanggal_periksa'];
$keterangan = $_POST['keterangan'];

// Query simpan database
$query = "INSERT INTO periksa (id_pasien, tanggal_periksa, keterangan) VALUES ('$id_pasien', '$tanggal_periksa', '$keterangan')";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_periksa.php");
	exit;
} else {
	echo "Data gagal disimpan ke database.";
	echo "<br><a href='tambah_periksa.php'>Kembali</a>";
}
?>
