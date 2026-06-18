<?php
session_start();

// Validasi login
if (!isset($_SESSION['level']) || $_SESSION['level'] == "") {
	header("location:index.php?pesan=gagal");
	exit();
}

// Hanya admin yang bisa menambah pasien
if ($_SESSION['level'] != "admin") {
	header("location:manage_pasien.php");
	exit();
}

// Koneksi database
include "koneksi.php";

// Ambil data dari form
$nama_pasien = mysqli_real_escape_string($connect, $_POST['nama_pasien']);
$alamat_pasien = mysqli_real_escape_string($connect, $_POST['alamat_pasien']);
$noktp_pasien = mysqli_real_escape_string($connect, $_POST['noktp_pasien']);
$nohp_pasien = mysqli_real_escape_string($connect, $_POST['nohp_pasien']);
$norm_pasien = mysqli_real_escape_string($connect, $_POST['norm_pasien']);

// Validasi input tidak boleh kosong
if (empty($nama_pasien) || empty($alamat_pasien) || empty($noktp_pasien) || empty($nohp_pasien) || empty($norm_pasien)) {
	echo "Semua field harus diisi!";
	echo "<br><a href='tambah_pasien.php'>Kembali</a>";
	exit();
}

// Query insert data pasien ke database
$query = "INSERT INTO pasien (nama_pasien, alamat_pasien, noktp_pasien, nohp_pasien, norm_pasien) 
		VALUES ('$nama_pasien', '$alamat_pasien', '$noktp_pasien', '$nohp_pasien', '$norm_pasien')";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_pasien.php");
	exit;
} else {
	echo "Data gagal disimpan ke database.";
	echo "<br>Error: " . mysqli_error($connect);
	echo "<br><a href='tambah_pasien.php'>Kembali</a>";
}
?>
