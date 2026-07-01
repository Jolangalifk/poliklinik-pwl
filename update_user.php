<?php
	// Load file koneksi.php
	include "koneksi.php";
	
	// Ambil Data yang Dikirim dari Form
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$level = $_POST['level'];
	
	// Ambil username lama untuk referensi update di tabel pasien/dokter
	$query_old = mysqli_query($connect, "SELECT username FROM user WHERE id='".$id."'");
	if ($query_old && mysqli_num_rows($query_old) > 0) {
		$data_old = mysqli_fetch_assoc($query_old);
		$old_username = $data_old['username'];
	} else {
		$old_username = "";
	}
	
	// Proses update ke Database
	$query = "UPDATE user SET nama='".$nama."', username='".$username."', password='".$password."', level='".$level."' WHERE id='".$id."'";
	$sql = mysqli_query($connect,$query); // Eksekusi/ Jalankan query dari variabel $query
	
	if($sql){ // Cek jika proses update ke database sukses atau tidak
		
		// Jika username diubah, sinkronisasi juga ke tabel pasien / dokter
		if($old_username != "" && $old_username != $username){
			$level_lower = strtolower($level);
			if($level_lower == "pasien"){
				$queryPasien = "UPDATE pasien SET nama_pasien='".$username."' WHERE nama_pasien='".$old_username."'";
				mysqli_query($connect, $queryPasien);
			}
			else if($level_lower == "dokter"){
				$queryDokter = "UPDATE dokter SET nama_dokter='".$username."' WHERE nama_dokter='".$old_username."'";
				mysqli_query($connect, $queryDokter);
			}
		}

		// Jika Sukses, Lakukan :
		header("location: manage_user.php"); // Redirect ke halaman manage_user.php
	}else{
		// Jika Gagal, Lakukan :
		echo "Maaf, Terjadi kesalahan saat mencoba untuk mengupdate data di database.";
		echo "<br><a href='manage_user.php'>Kembali Ke Form</a>";
	}
?>
