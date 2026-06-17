<?php
	// Load file koneksi.php
	include "koneksi.php";
	
	// Ambil Data yang Dikirim dari Form
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$level = strtolower($_POST['level']); // Konversi ke lowercase
	
	// Proses simpan ke Database user table
	$query = "INSERT INTO user (nama, username, password, level) VALUES('".$nama."', '".$username."', '".$password."', '".$level."')";
	$sql = mysqli_query($connect,$query); // Eksekusi/ Jalankan query dari variabel $query
	
	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika level adalah pasien, simpan juga ke tabel pasien dengan username
		if($level == "pasien"){
			$queryPasien = "INSERT INTO pasien (nama_pasien) VALUES('".$username."')";
			$sqlPasien = mysqli_query($connect, $queryPasien);
			
			if(!$sqlPasien){
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data pasien ke database.";
				echo "<br><a href='registrasi.php'>Kembali Ke Form</a>";
				exit;
			}
		}
		// Jika level adalah dokter, simpan juga ke tabel dokter
		else if($level == "dokter"){
			$queryDokter = "INSERT INTO dokter (nama_dokter) VALUES('".$username."')";
			$sqlDokter = mysqli_query($connect, $queryDokter);
			
			if(!$sqlDokter){
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data dokter ke database.";
				echo "<br><a href='registrasi.php'>Kembali Ke Form</a>";
				exit;
			}
		}
		// Jika Sukses, Lakukan :
		header("location: index.php"); // Redirect ke halaman index.php
	}else{
	// Jika Gagal, Lakukan :
	echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
	echo "<br><a href='registrasi.php'>Kembali Ke Form</a>";
	}
	?>
