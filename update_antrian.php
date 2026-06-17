<?php
// Koneksi database
include "koneksi.php";

// Ambil parameter dari URL
$id_daftar = $_GET['id_daftar'];
$status = $_GET['status'];
$tanggal = $_GET['tanggal'];

// Query update status
$query = "UPDATE daftar SET status_periksa='$status' WHERE id_daftar='$id_daftar'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_antrian_daftar_pasien.php?tanggal=$tanggal");
	exit;
} else {
	echo "Data gagal diperbarui dari database.";
	echo "<br><a href='manage_antrian_daftar_pasien.php?tanggal=$tanggal'>Kembali</a>";
}
?>
