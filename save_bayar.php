<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] == "") {
    header("location:index.php?pesan=gagal");
    exit;
}

include "koneksi.php";

$id_daftar = isset($_POST['id_daftar']) ? mysqli_real_escape_string($connect, $_POST['id_daftar']) : '';
$id_rekam_medis = isset($_POST['id_rekam_medis']) ? mysqli_real_escape_string($connect, $_POST['id_rekam_medis']) : '';
$tanggal_bayar = isset($_POST['tanggal_bayar']) ? mysqli_real_escape_string($connect, $_POST['tanggal_bayar']) : date('Y-m-d');
$biaya_pemeriksaan = isset($_POST['biaya_pemeriksaan']) ? floatval($_POST['biaya_pemeriksaan']) : 0;
$biaya_obat = isset($_POST['biaya_obat']) ? floatval($_POST['biaya_obat']) : 0;
$total_bayar = $biaya_pemeriksaan + $biaya_obat;
$metode_bayar = isset($_POST['metode_bayar']) ? mysqli_real_escape_string($connect, $_POST['metode_bayar']) : 'Tunai';
$status_bayar = 'Lunas';

global $connect;

if (empty($id_daftar)) {
    echo "Data transaksi tidak valid.";
    exit;
}

$query = "INSERT INTO bayar (id_daftar, id_rekam_medis, tanggal_bayar, biaya_pemeriksaan, biaya_obat, total_bayar, metode_bayar, status_bayar)
          VALUES ('$id_daftar', '$id_rekam_medis', '$tanggal_bayar', '$biaya_pemeriksaan', '$biaya_obat', '$total_bayar', '$metode_bayar', '$status_bayar')";

$result = mysqli_query($connect, $query);

if ($result) {
    mysqli_query($connect, "UPDATE daftar SET status_periksa = 'selesai' WHERE id_daftar = '$id_daftar'");
    header("location:manage_pemeriksaan_dokter.php");
    exit;
} else {
    echo "Gagal menyimpan pembayaran: " . mysqli_error($connect);
    echo "<br><a href='bayar.php?id_daftar=" . htmlspecialchars($id_daftar) . "'>Kembali</a>";
}