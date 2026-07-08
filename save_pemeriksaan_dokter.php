<?php
	session_start();

	// Load file koneksi.php
	include "koneksi.php";

	// Ambil Data yang Dikirim dari Form
	$id_rekam_medis      = $_POST['id_rekam_medis'];
	$id_daftar           = $_POST['id_daftar'];
	$id_pasien           = $_POST['id_pasien'];
	$id_dokter           = $_POST['id_dokter'];
	$tanggal_pemeriksaan = $_POST['tanggal_pemeriksaan'];
	$keluhan             = mysqli_real_escape_string($connect, $_POST['keluhan']);
	$hasil_diagnosa      = mysqli_real_escape_string($connect, $_POST['hasil_diagnosa']);
	$tindakan            = mysqli_real_escape_string($connect, $_POST['tindakan']);
	$tekanan_darah       = mysqli_real_escape_string($connect, $_POST['tekanan_darah']);
	$berat_badan         = $_POST['berat_badan'];
	$tinggi_badan        = $_POST['tinggi_badan'];
	$id_obat             = $_POST['id_obat'];
	$jumlah              = $_POST['jumlah'];
	$aturan_pakai        = mysqli_real_escape_string($connect, $_POST['aturan_pakai']);
	$tanggal             = date('Y-m-d H:i:s');

	// Jika id_rekam_medis sudah ada, lakukan UPDATE; jika belum, lakukan INSERT
	if (!empty($id_rekam_medis)) {
		// UPDATE rekam medis yang sudah ada
		$result = mysqli_query(
			$connect,
			"UPDATE rekam_medis 
			SET keluhan='$keluhan', hasil_diagnosa='$hasil_diagnosa', tindakan='$tindakan',
			    tekanan_darah='$tekanan_darah', berat_badan='$berat_badan', tinggi_badan='$tinggi_badan',
			    tanggal_pemeriksaan='$tanggal'
			WHERE id_rekam_medis='$id_rekam_medis'"
		);
	} else {
		// INSERT rekam medis baru karena belum ada
		$result = mysqli_query(
			$connect,
			"INSERT INTO rekam_medis (id_daftar, id_pasien, id_dokter, tanggal_pemeriksaan, keluhan, hasil_diagnosa, tindakan, tekanan_darah, berat_badan, tinggi_badan)
			VALUES ('$id_daftar', '$id_pasien', '$id_dokter', '$tanggal', '$keluhan', '$hasil_diagnosa', '$tindakan', '$tekanan_darah', '$berat_badan', '$tinggi_badan')"
		);
		// Ambil id_rekam_medis yang baru diinsert
		$id_rekam_medis = mysqli_insert_id($connect);
	}

	// Simpan detail obat jika obat dipilih
	if (!empty($id_obat)) {
		mysqli_query($connect,
			"INSERT INTO detail_rekam_medis (id_rekam_medis, id_obat, jumlah, aturan_pakai) 
			VALUES ('$id_rekam_medis', '$id_obat', '$jumlah', '$aturan_pakai')"
		);

		// Kurangi stok obat sesuai jumlah yang diresepkan
		mysqli_query($connect,
			"UPDATE obat 
			SET stok_obat = stok_obat - '$jumlah'
			WHERE id_obat = '$id_obat'"
		);
	}

	if ($result) {
		header("location: form_pemeriksaan_dokter.php?id_daftar=$id_daftar"); // Redirect kembali ke form untuk tambah obat lagi
		exit();
	} else {
		// Jika Gagal, Lakukan :
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		echo "<br>" . mysqli_error($connect);
		echo "<br><a href='manage_pemeriksaan_dokter.php'>Kembali Ke Form</a>";
	}
?>