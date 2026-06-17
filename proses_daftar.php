<?php
	session_start();
	include "koneksi.php";

	// Validasi session login
	if (empty($_SESSION['username'])) {
		echo "
		<script>
			alert('Silakan login terlebih dahulu');
			window.location='index.php';
		</script>
		";
		exit;
	}

	// Validasi dokter dipilih
	if (empty($_GET['id_dokter'])) {
		echo "
		<script>
			alert('Dokter belum dipilih');
			window.location='manage_daftar.php';
		</script>
		";
		exit;
	}

	// Ambil username login
	$username = mysqli_real_escape_string($connect, $_SESSION['username']);
	
	// Cari nama dari tabel user berdasarkan username
	$cariUser = mysqli_query($connect, "SELECT nama FROM user WHERE username='$username'");
	
	if (!$cariUser || mysqli_num_rows($cariUser) == 0) {
		echo "
		<script>
			alert('Data user tidak ditemukan');
			window.location='index.php';
		</script>
		";
		exit;
	}
	
	$dataUser = mysqli_fetch_array($cariUser);
	$nama = $dataUser['nama'];
	
	// Cari id_pasien dari tabel pasien berdasarkan nama_pasien
	$cariPasien = mysqli_query($connect, "SELECT id_pasien FROM pasien WHERE nama_pasien='$nama'");
	
	if (!$cariPasien || mysqli_num_rows($cariPasien) == 0) {
		echo "
		<script>
			alert('Data pasien tidak ditemukan. Silakan lengkapi data pasien terlebih dahulu');
			window.location='manage_pasien.php';
		</script>
		";
		exit;
	}
	
	$pasien = mysqli_fetch_array($cariPasien);
	$id_pasien = $pasien['id_pasien'];

	// Dokter dipilih
	$id_dokter = mysqli_real_escape_string($connect, $_GET['id_dokter']);
	$tanggal = date("Y-m-d");

	// Cek jumlah antrian
	$cek = mysqli_query($connect, "SELECT COUNT(*) jumlah FROM daftar WHERE id_dokter='$id_dokter' AND tanggal_periksa='$tanggal'");
	
	if (!$cek) {
		echo "
		<script>
			alert('Error: " . mysqli_error($connect) . "');
			window.location='manage_daftar.php';
		</script>
		";
		exit;
	}
	
	$data = mysqli_fetch_array($cek);
	$jumlah = $data['jumlah'];

	// Maksimal 10 antrian
	if ($jumlah >= 10) {
		echo "
		<script>
			alert('Maaf antrian penuh. Silakan coba dokter atau hari lain');
			window.location='manage_daftar.php';
		</script>
		";
		exit;
	}

	// Nomor antrian berikutnya
	$nomor = $jumlah + 1;

	// Simpan ke database
	$insert = mysqli_query($connect, "INSERT INTO daftar(id_pasien, id_dokter, tanggal_periksa, nomor_antrian)
	VALUES('$id_pasien', '$id_dokter', '$tanggal', '$nomor')");
	
	if ($insert) {
		$nomor_format = str_pad($nomor, 2, '0', STR_PAD_LEFT);
		echo "
		<script>
			alert('Berhasil daftar. Nomor antrian : A-$nomor_format');
			window.location='manage_antrian_daftar_pasien.php?tanggal=$tanggal';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Gagal melakukan pendaftaran. Error: " . mysqli_error($connect) . "');
			window.location='manage_daftar.php';
		</script>
		";
	}
?>