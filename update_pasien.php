<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$id_pasien = $_POST['id_pasien'];
$nama_pasien = $_POST['nama_pasien'];
$alamat_pasien = $_POST['alamat_pasien'];
$noktp_pasien = $_POST['noktp_pasien'];
$nohp_pasien = $_POST['nohp_pasien'];
$norm_pasien = $_POST['norm_pasien'];

// Query update database
$query = "UPDATE pasien SET nama_pasien='$nama_pasien', alamat_pasien='$alamat_pasien', noktp_pasien='$noktp_pasien', nohp_pasien='$nohp_pasien', norm_pasien='$norm_pasien' WHERE id_pasien='$id_pasien'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_pasien.php");
	exit;
} else {
	echo "Data gagal diupdate ke database.";
	echo "<br><a href='manage_pasien.php'>Kembali</a>";
}
?>
