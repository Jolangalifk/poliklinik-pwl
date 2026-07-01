<?php
include("koneksi.php");

$id_dokter = $_POST['id_dokter'];
$nama_dokter = $_POST['nama_dokter'];
$alamat_dokter = $_POST['alamat_dokter'];
$nohp_dokter = $_POST['nohp_dokter'];
$id_poli = $_POST['id_poli'];
$biaya_periksa = $_POST['biaya_periksa'];
$keterangan_dokter = $_POST['keterangan_dokter'];

// Penanganan Foto
if (!empty($_FILES['foto_dokter']['name'])) {
    $foto_dokter = $_FILES['foto_dokter']['name'];
    move_uploaded_file($_FILES['foto_dokter']['tmp_name'], "foto/" . $foto_dokter);

    $query = "UPDATE dokter SET nama_dokter='$nama_dokter',  alamat_dokter='$alamat_dokter',  nohp_dokter='$nohp_dokter',  id_poli='$id_poli', biaya_periksa='$biaya_periksa', keterangan_dokter='$keterangan_dokter',  foto_dokter='$foto_dokter' WHERE id_dokter='$id_dokter'";
} else {
    $query = "UPDATE dokter SET nama_dokter='$nama_dokter',  alamat_dokter='$alamat_dokter',  nohp_dokter='$nohp_dokter',  id_poli='$id_poli', biaya_periksa='$biaya_periksa', keterangan_dokter='$keterangan_dokter' WHERE id_dokter='$id_dokter'";
}

$result = mysqli_query($connect, $query);

if ($result) {
    header("Location: manage_dokter.php");
} else {
    echo "Gagal update: " . mysqli_error($connect);
}
?>