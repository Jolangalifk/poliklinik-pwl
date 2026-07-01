<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$nama_obat = $_POST['nama_obat'];
$stok_obat = $_POST['stok_obat'];
$satuan_obat = $_POST['satuan_obat'];
$harga_obat = $_POST['harga_obat'];
$keterangan_obat = $_POST['keterangan_obat'];

// Query simpan database
$query = "INSERT INTO obat (nama_obat, stok_obat, satuan_obat, harga_obat, keterangan_obat) VALUES ('$nama_obat', '$stok_obat', '$satuan_obat', '$harga_obat', '$keterangan_obat')";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_obat.php");
	exit;
} else {
	echo "Data gagal disimpan ke database.";
	echo "<br><a href='tambah_obat.php'>Kembali</a>";
}
?>
