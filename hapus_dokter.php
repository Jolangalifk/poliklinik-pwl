<?php
session_start();
include("koneksi.php");

// Get id from URL to delete that doctor
$id_dokter = $_GET['id_dokter'];
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
$level = $_SESSION['level'];

// Ambil data dokter untuk mendapatkan foto
$queryGetDokter = "SELECT foto_dokter FROM dokter WHERE id_dokter=$id_dokter";
$resultGetDokter = mysqli_query($connect, $queryGetDokter);
$dokterData = mysqli_fetch_assoc($resultGetDokter);
$foto_dokter = $dokterData['foto_dokter'];

// Delete photo file if exists
if($foto_dokter && file_exists("foto/$foto_dokter")) {
	unlink("foto/$foto_dokter");
}

// Delete doctor data
$query = "DELETE FROM dokter WHERE id_dokter=$id_dokter";
$result = mysqli_query($connect, $query);

if($result) {
	header("Location:manage_dokter.php");
} else {
	echo "Error: " . mysqli_error($connect);
}
?>
