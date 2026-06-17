<?php
	// Load file koneksi.php
	include "koneksi.php";
	
	// Ambil Data yang Dikirim dari Form
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$level = $_POST['level'];
	
	// Proses update ke Database
	$query = "UPDATE user SET nama='".$nama."', username='".$username."', password='".$password."', level='".$level."' WHERE id='".$id."'";
	$sql = mysqli_query($connect,$query); // Eksekusi/ Jalankan query dari variabel $query
	
	if($sql){ // Cek jika proses update ke database sukses atau tidak
	// Jika Sukses, Lakukan :
	header("location: manage_user.php"); // Redirect ke halaman manage_user.php
	}else{
	// Jika Gagal, Lakukan :
	echo "Maaf, Terjadi kesalahan saat mencoba untuk mengupdate data di database.";
	echo "<br><a href='index.php'>Kembali Ke Form</a>";
	}
	?>
