<?php
// Koneksi database
include "koneksi.php";

// Ambil data dari form
$id_obat = $_POST['id_obat'];
$nama_obat = $_POST['nama_obat'];
$stok_obat = $_POST['stok_obat'];
$satuan_obat = $_POST['satuan_obat'];
$harga_obat = $_POST['harga_obat'];
$keterangan_obat = $_POST['keterangan_obat'];

// Query update database
$query = "UPDATE obat SET nama_obat='$nama_obat', stok_obat='$stok_obat', satuan_obat='$satuan_obat', harga_obat='$harga_obat', keterangan_obat='$keterangan_obat' WHERE id_obat='$id_obat'";

$sql = mysqli_query($connect, $query);

if ($sql) {
	header("Location: manage_obat.php");
	exit;
} else {
	echo "Data gagal diupdate ke database.";
	echo "<br><a href='manage_obat.php'>Kembali</a>";
}
?>
