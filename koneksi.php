<?php 
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
	$host = "localhost"; // Nama hostnya
	$username = "root"; // Username
	$password = ""; // Password (Isi jika menggunakan password)
	$database = "multi_user"; // Nama databasenya$connect = mysqli_connect($host, $username, $password, $database); // Koneksi ke MySQL
	$connect = mysqli_connect($host, $username, $password, $database);

	// Check connection
	if (mysqli_connect_errno()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	}
?>