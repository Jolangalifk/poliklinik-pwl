<?php
session_start();
include("koneksi.php");

// Validasi login
if (!isset($_SESSION['level']) || $_SESSION['level'] == "") {
	header("location:index.php?pesan=gagal");
	exit();
}

$level = $_SESSION['username'];
$username = $_SESSION['username'];
$id_pasien = $_GET['id'];

// Validasi akses berdasarkan role
if ($_SESSION['level'] == "pasien") {
	// Pasien hanya bisa menghapus data dirinya sendiri
	$checkQuery = "SELECT nama_pasien FROM pasien WHERE id_pasien='$id_pasien'";
	$checkResult = mysqli_query($connect, $checkQuery);
	$checkData = mysqli_fetch_assoc($checkResult);
	
	// Jika nama pasien tidak sesuai dengan username yang login, redirect
	if (!$checkData || $checkData['nama_pasien'] != $username) {
		header("location:manage_pasien.php");
		exit();
	}
}

// Delete user row from table based on given id
$query = "DELETE FROM pasien WHERE id_pasien=$id_pasien";
$result = mysqli_query($connect, $query);

// Delete user row from table based on given id
$query = "DELETE FROM user WHERE username = '$username'";
$result = mysqli_query($connect, $query);

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:manage_pasien.php");
?>
